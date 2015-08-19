<?php

namespace Odiseo\Bundle\CoreBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\AbstractResourceExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OdiseoCoreExtension extends AbstractResourceExtension
{
    protected $applicationName = 'odiseo_core';
    protected $configFormat = self::CONFIG_YAML;
    protected $configFiles  = array(
        'services',
        'forms'
    );

    public function load(array $config, ContainerBuilder $container)
    {
        $this->configure(
            $config,
            new Configuration(),
            $container,
            self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS
        );
    }
}
