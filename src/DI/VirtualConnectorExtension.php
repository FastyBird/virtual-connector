<?php declare(strict_types = 1);

/**
 * VirtualConnectorExtension.php
 *
 * @license        More in license.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:VirtualConnector!
 * @subpackage     DI
 * @since          0.1.0
 *
 * @date           25.04.22
 */

namespace FastyBird\VirtualConnector\DI;

use Doctrine\Persistence;
use FastyBird\VirtualConnector\Hydrators;
use FastyBird\VirtualConnector\Schemas;
use Nette;
use Nette\DI;

/**
 * Virtual connector
 *
 * @package        FastyBird:VirtualConnector!
 * @subpackage     DI
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class VirtualConnectorExtension extends DI\CompilerExtension
{

	/**
	 * @param Nette\Configurator $config
	 * @param string $extensionName
	 *
	 * @return void
	 */
	public static function register(
		Nette\Configurator $config,
		string $extensionName = 'fbVirtualConnector'
	): void {
		$config->onCompile[] = function (
			Nette\Configurator $config,
			DI\Compiler $compiler
		) use ($extensionName): void {
			$compiler->addExtension($extensionName, new VirtualConnectorExtension());
		};
	}

	/**
	 * {@inheritDoc}
	 */
	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		// API schemas
		$builder->addDefinition($this->prefix('schemas.connector.virtual'), new DI\Definitions\ServiceDefinition())
			->setType(Schemas\VirtualConnectorSchema::class);

		$builder->addDefinition($this->prefix('schemas.device.virtual'), new DI\Definitions\ServiceDefinition())
			->setType(Schemas\VirtualDeviceSchema::class);

		// API hydrators
		$builder->addDefinition($this->prefix('hydrators.connector.virtual'), new DI\Definitions\ServiceDefinition())
			->setType(Hydrators\VirtualConnectorHydrator::class);

		$builder->addDefinition($this->prefix('hydrators.device.virtual'), new DI\Definitions\ServiceDefinition())
			->setType(Hydrators\VirtualDeviceHydrator::class);
	}

	/**
	 * {@inheritDoc}
	 */
	public function beforeCompile(): void
	{
		parent::beforeCompile();

		$builder = $this->getContainerBuilder();

		/**
		 * Doctrine entities
		 */

		$ormAnnotationDriverService = $builder->getDefinition('nettrineOrmAnnotations.annotationDriver');

		if ($ormAnnotationDriverService instanceof DI\Definitions\ServiceDefinition) {
			$ormAnnotationDriverService->addSetup('addPaths', [[__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Entities']]);
		}

		$ormAnnotationDriverChainService = $builder->getDefinitionByType(Persistence\Mapping\Driver\MappingDriverChain::class);

		if ($ormAnnotationDriverChainService instanceof DI\Definitions\ServiceDefinition) {
			$ormAnnotationDriverChainService->addSetup('addDriver', [
				$ormAnnotationDriverService,
				'FastyBird\VirtualConnector\Entities',
			]);
		}
	}

}
