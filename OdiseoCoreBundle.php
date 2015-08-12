<?php

namespace Odiseo\Bundle\CoreBundle;

use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use Sylius\Bundle\ResourceBundle\ResourceBundleInterface;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;

class OdiseoCoreBundle extends AbstractResourceBundle
{
    protected $mappingFormat = ResourceBundleInterface::MAPPING_YAML;

    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
        );
    }
    
    /*protected function getModelNamespace()
    {
        return 'Odiseo\Bundle\CoreBundle\Model';
    }*/
}