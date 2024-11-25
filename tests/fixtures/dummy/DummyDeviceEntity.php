<?php declare(strict_types = 1);

namespace FastyBird\Connector\Virtual\Tests\Fixtures\Dummy;

use Doctrine\ORM\Mapping as ORM;
use FastyBird\Core\Application\Entities\Mapping as ApplicationMapping;
use FastyBird\Module\Devices\Entities as DevicesEntities;

#[ORM\Entity]
#[ApplicationMapping\DiscriminatorEntry(name: self::TYPE)]
class DummyDeviceEntity extends DevicesEntities\Devices\Device
{

	public const TYPE = 'dummy';

	public static function getType(): string
	{
		return self::TYPE;
	}

}
