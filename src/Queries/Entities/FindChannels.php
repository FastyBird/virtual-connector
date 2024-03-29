<?php declare(strict_types = 1);

/**
 * FindChannels.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:VirtualConnector!
 * @subpackage     Queries
 * @since          1.0.0
 *
 * @date           20.10.23
 */

namespace FastyBird\Connector\Virtual\Queries\Entities;

use FastyBird\Connector\Virtual\Entities;
use FastyBird\Module\Devices\Queries as DevicesQueries;

/**
 * Find device channels entities query
 *
 * @template T of Entities\Channels\Channel
 * @extends  DevicesQueries\Entities\FindChannels<T>
 *
 * @package        FastyBird:VirtualConnector!
 * @subpackage     Queries
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class FindChannels extends DevicesQueries\Entities\FindChannels
{

}
