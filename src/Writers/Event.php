<?php declare(strict_types = 1);

/**
 * Event.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:VirtualConnector!
 * @subpackage     Writers
 * @since          1.0.0
 *
 * @date           17.10.23
 */

namespace FastyBird\Connector\Virtual\Writers;

use FastyBird\Connector\Virtual\Entities;
use FastyBird\Connector\Virtual\Exceptions;
use FastyBird\Connector\Virtual\Helpers;
use FastyBird\Connector\Virtual\Queue;
use FastyBird\DateTimeFactory;
use FastyBird\Library\Metadata\Documents as MetadataDocuments;
use FastyBird\Module\Devices\Events as DevicesEvents;
use FastyBird\Module\Devices\Exceptions as DevicesExceptions;
use FastyBird\Module\Devices\Models as DevicesModels;
use FastyBird\Module\Devices\Queries as DevicesQueries;
use FastyBird\Module\Devices\Utilities as DevicesUtilities;
use React\EventLoop;
use Symfony\Component\EventDispatcher;

/**
 * Event based properties writer
 *
 * @package        FastyBird:VirtualConnector!
 * @subpackage     Writers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class Event extends Periodic implements Writer, EventDispatcher\EventSubscriberInterface
{

	public const NAME = 'event';

	public function __construct(
		MetadataDocuments\DevicesModule\Connector $connector,
		Helpers\Entity $entityHelper,
		Queue\Queue $queue,
		DevicesModels\Configuration\Devices\Repository $devicesConfigurationRepository,
		DevicesModels\Configuration\Channels\Repository $channelsConfigurationRepository,
		DevicesModels\Configuration\Devices\Properties\Repository $devicesPropertiesConfigurationRepository,
		DevicesModels\Configuration\Channels\Properties\Repository $channelsPropertiesConfigurationRepository,
		DevicesUtilities\DevicePropertiesStates $devicePropertiesStatesManager,
		DevicesUtilities\ChannelPropertiesStates $channelPropertiesStatesManager,
		DateTimeFactory\Factory $dateTimeFactory,
		EventLoop\LoopInterface $eventLoop,
	)
	{
		parent::__construct(
			$connector,
			$entityHelper,
			$queue,
			$devicesConfigurationRepository,
			$channelsConfigurationRepository,
			$devicesPropertiesConfigurationRepository,
			$channelsPropertiesConfigurationRepository,
			$devicePropertiesStatesManager,
			$channelPropertiesStatesManager,
			$dateTimeFactory,
			$eventLoop,
		);
	}

	public static function getSubscribedEvents(): array
	{
		return [
			DevicesEvents\DevicePropertyStateEntityCreated::class => 'stateChanged',
			DevicesEvents\DevicePropertyStateEntityUpdated::class => 'stateChanged',
			DevicesEvents\ChannelPropertyStateEntityCreated::class => 'stateChanged',
			DevicesEvents\ChannelPropertyStateEntityUpdated::class => 'stateChanged',
		];
	}

	/**
	 * @throws DevicesExceptions\InvalidState
	 * @throws Exceptions\Runtime
	 */
	public function stateChanged(
		// phpcs:ignore SlevomatCodingStandard.Files.LineLength.LineTooLong
		DevicesEvents\DevicePropertyStateEntityCreated|DevicesEvents\DevicePropertyStateEntityUpdated|DevicesEvents\ChannelPropertyStateEntityCreated|DevicesEvents\ChannelPropertyStateEntityUpdated $event,
	): void
	{
		$state = $event->getState();

		if ($state->getExpectedValue() === null || $state->getPending() !== true) {
			return;
		}

		if (
			$event instanceof DevicesEvents\DevicePropertyStateEntityCreated
			|| $event instanceof DevicesEvents\DevicePropertyStateEntityUpdated
		) {
			$findDeviceQuery = new DevicesQueries\Configuration\FindDevices();
			$findDeviceQuery->byId($event->getProperty()->getDevice());

			$device = $this->devicesConfigurationRepository->findOneBy($findDeviceQuery);

			if ($device === null) {
				return;
			}
		} else {
			$findChannelQuery = new DevicesQueries\Configuration\FindChannels();
			$findChannelQuery->byId($event->getProperty()->getChannel());

			$channel = $this->channelsConfigurationRepository->findOneBy($findChannelQuery);

			if ($channel === null) {
				return;
			}

			$findDeviceQuery = new DevicesQueries\Configuration\FindDevices();
			$findDeviceQuery->byId($channel->getDevice());

			$device = $this->devicesConfigurationRepository->findOneBy($findDeviceQuery);

			if ($device === null) {
				return;
			}
		}

		if (!$device->getConnector()->equals($this->connector->getId())) {
			return;
		}

		if (
			$event instanceof DevicesEvents\DevicePropertyStateEntityCreated
			|| $event instanceof DevicesEvents\DevicePropertyStateEntityUpdated
		) {
			$this->queue->append(
				$this->entityHelper->create(
					Entities\Messages\WriteDevicePropertyState::class,
					[
						'connector' => $this->connector->getId(),
						'device' => $device->getId(),
						'property' => $event->getProperty()->getId(),
					],
				),
			);

		} else {
			$this->queue->append(
				$this->entityHelper->create(
					Entities\Messages\WriteChannelPropertyState::class,
					[
						'connector' => $this->connector->getId(),
						'device' => $device->getId(),
						'channel' => $event->getProperty()->getChannel(),
						'property' => $event->getProperty()->getId(),
					],
				),
			);
		}
	}

}
