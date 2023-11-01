<?php declare(strict_types = 1);

namespace FastyBird\Connector\Virtual\Tests\Fixtures\Dummy;

use Doctrine\ORM\Mapping as ORM;
use FastyBird\Module\Devices\Entities as DevicesEntities;

/**
 * @ORM\Entity
 */
class DummyConnectorEntity extends DevicesEntities\Connectors\Connector
{

	public const CONNECTOR_TYPE = 'dummy';

	public function getType(): string
	{
		return 'dummy';
	}

	public function getDiscriminatorName(): string
	{
		return 'dummy';
	}

}
