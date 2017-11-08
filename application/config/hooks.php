<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Common\Config\ConfigurationManager;


/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_system'] = function() {
    // Load the configuration file
   $configManager = new ConfigurationManager('./propel.php' );

    // Set up the connection manager
   $manager = new ConnectionManagerSingle();
   $manager->setConfiguration( $configManager->getConnectionParametersArray()[ 'default' ] );
   $manager->setName('default');

    // Add the connection manager to the service container
   $serviceContainer = Propel::getServiceContainer();
   $serviceContainer->setAdapterClass('default', 'mysql');
   $serviceContainer->setConnectionManager('default', $manager);
   $serviceContainer->setDefaultDatasource('default');

};
