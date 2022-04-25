<?php declare(strict_types = 1);

namespace Tests\Cases;

use FastyBird\VirtualConnector\Hydrators;
use FastyBird\VirtualConnector\Schemas;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../BaseTestCase.php';

/**
 * @testCase
 */
final class ServicesTest extends BaseTestCase
{

	public function testServicesRegistration(): void
	{
		$container = $this->createContainer();

		Assert::notNull($container->getByType(Hydrators\VirtualConnectorHydrator::class));
		Assert::notNull($container->getByType(Hydrators\VirtualDeviceHydrator::class));

		Assert::notNull($container->getByType(Schemas\VirtualConnectorSchema::class));
		Assert::notNull($container->getByType(Schemas\VirtualDeviceSchema::class));
	}

}

$test_case = new ServicesTest();
$test_case->run();
