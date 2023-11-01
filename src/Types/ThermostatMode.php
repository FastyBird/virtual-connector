<?php declare(strict_types = 1);

/**
 * ThermostatMode.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:VirtualConnector!
 * @subpackage     Types
 * @since          1.0.0
 *
 * @date           15.10.22
 */

namespace FastyBird\Connector\Virtual\Types;

use Consistence;
use function strval;

/**
 * Thermostat device preset modes types
 *
 * @package        FastyBird:VirtualConnector!
 * @subpackage     Types
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class ThermostatMode extends Consistence\Enum\Enum
{

	public const AUTO = 'auto';

	public const MANUAL = 'manual';

	public const AWAY = 'away';

	public const ECO = 'eco';

	public const HOME = 'home';

	public const COMFORT = 'comfort';

	public const SLEEP = 'sleep';

	public const ANTI_FREEZE = 'anti_freeze';

	public function getValue(): string
	{
		return strval(parent::getValue());
	}

	public function __toString(): string
	{
		return self::getValue();
	}

}
