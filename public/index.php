<?php
/**
 * This is our bootstrap file. All requests that are not for static files will be routed through
 * this file.
 */

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {

    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
        '../app/services/'
    ))->register();

    // Setup our dependency injection container
    include '../app/services/di_bootstrap.php';

    // Handle the request
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    error_log("Exception caught in bootstrap file: ".$e->getMessage());
    echo "PhalconException: ", $e->getMessage();
}