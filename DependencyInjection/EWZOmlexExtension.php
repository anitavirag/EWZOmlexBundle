<?php

namespace EWZ\Bundle\OmlexBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

/**
 * EWZOmlexExtension.
 */
class EWZOmlexExtension extends Extension
{
    /**
     * Loads the omlex configuration.
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('omlex.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['providers'])) {
            $container->getDefinition('omlex.oembed')->replaceArgument('providers', $config['providers']);
        }
    }
}
