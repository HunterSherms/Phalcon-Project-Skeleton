<?php
/**
 * This is our bootstrap file. All requests that are not for static files will be routed through
 * this file.
 */

//Set config variables
foreach(parse_ini_file('../app/config.ini') as $name => $value) {
    define($name, $value);
}

use Phalcon\Loader;
use Phalcon\Mvc\Application;
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
    if(IS_PRODUCTION){ //Show 404 page
        header($_SERVER["SERVER_PROTOCOL"] ." 404 Not Found");
        echo readfile('../app/views/index/page_not_found.phtml');
    }else{ //Show stacktrace
        echo "PhalconException: " . $e->getMessage();
        echo preg_replace('/(#[0-9])/', '<br />', $e->getTraceAsString());
    }
}