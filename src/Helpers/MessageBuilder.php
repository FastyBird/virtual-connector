<?php declare(strict_types = 1);

/**
 * MessageBuilder.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:VirtualConnector!
 * @subpackage     Helpers
 * @since          1.0.0
 *
 * @date           17.10.23
 */

namespace FastyBird\Connector\Virtual\Helpers;

use FastyBird\Connector\Virtual\Exceptions;
use FastyBird\Connector\Virtual\Queue;
use Orisai\ObjectMapper;

/**
 * Message builder
 *
 * @package        FastyBird:VirtualConnector!
 * @subpackage     Helpers
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
final readonly class MessageBuilder
{

	public function __construct(
		private ObjectMapper\Processing\Processor $processor,
	)
	{
	}

	/**
	 * @template T of Queue\Messages\Message
	 *
	 * @param class-string<T> $message
	 * @param array<mixed> $data
	 *
	 * @throws Exceptions\Runtime
	 */
	public function create(string $message, array $data): Queue\Messages\Message
	{
		try {
			$options = new ObjectMapper\Processing\Options();
			$options->setAllowUnknownFields();

			return $this->processor->process($data, $message, $options);
		} catch (ObjectMapper\Exception\InvalidData $ex) {
			$errorPrinter = new ObjectMapper\Printers\ErrorVisualPrinter(
				new ObjectMapper\Printers\TypeToStringConverter(),
			);

			throw new Exceptions\Runtime('Could not map data to message: ' . $errorPrinter->printError($ex));
		}
	}

}
