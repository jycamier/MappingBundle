<?php

namespace Eheuje\MappingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class EheujeMappingExtension extends Extension
{
    /**
     * {@inheritDoc}
     * @throws \Symfony\Component\DependencyInjection\Exception\BadMethodCallException
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config as $mappingName => $mappingConfig) {
            $this->createMappingNameServices($mappingName, $mappingConfig, $container);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        $loader->load('services.yml');
    }

    /**
     * @param string           $mappingName
     * @param array            $mappingConfig
     * @param ContainerBuilder $container
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\BadMethodCallException
     */
    protected function createMappingNameServices($mappingName, array $mappingConfig, ContainerBuilder $container)
    {
        $definition = new Definition(
            $mappingConfig['class'],
            [
                $mappingName,
                $mappingConfig,
            ]
        );
        $container->setDefinition('eheuje_mapping.'.$mappingName, $definition);
    }
}
