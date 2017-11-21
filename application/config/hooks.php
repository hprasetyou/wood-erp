<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Common\Config\ConfigurationManager;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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

   $defaultLogger = new Logger('defaultLogger');
   $defaultLogger->pushHandler(new StreamHandler('application/logs/propel_error.log', Logger::WARNING));
   Propel::getServiceContainer()->setLogger('defaultLogger', $defaultLogger);
   $queryLogger = new Logger('default');
   $queryLogger->pushHandler(new StreamHandler('application/logs/propel_default.log'));
   Propel::getServiceContainer()->setLogger('default', $queryLogger);
    // Add the connection manager to the service container
   $serviceContainer = Propel::getServiceContainer();
   $serviceContainer->setAdapterClass('default', 'mysql');
   $serviceContainer->setConnectionManager('default', $manager);
   $serviceContainer->setDefaultDatasource('default');

};
