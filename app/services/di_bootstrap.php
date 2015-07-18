<?php
/**
 * Sets up our dependency injection container and attaches services that can be injected
 * https://docs.phalconphp.com/en/latest/reference/di.html
 */

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;

// Create a DI container
$di = new FactoryDefault();

// Setup the view component
$di->set('view', function(){
    $view = new View();
    $view->setViewsDir('../app/views/');
    return $view;
});

// Setup a base URI so that all generated URIs include the "project1" folder
$di->set('url', function(){
    $url = new UrlProvider();
    $url->setBaseUri('/project1/');
    return $url;
});