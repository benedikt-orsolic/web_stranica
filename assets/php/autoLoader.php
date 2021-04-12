<?php

require_once 'inc/session.inc.php';

spl_autoload_register(function ($className){

    $extension = '.class.php';
    $file = $className . $extension;

    $modelPath      = __DIR__ . '/model/';
    $viewPath       = __DIR__ . '/view/';
    $controllerPath = __DIR__ . '/controller/';
    $adapterPath    = __DIR__ . '/adapter/';

    $model = $modelPath . $file;
    $view  = $viewPath . $file;
    $controller = $controllerPath . $file;
    $adapter = $adapterPath . $file;

    if(file_exists($model)) {
        require_once $model;
        return;
    };

    if(file_exists($view)) {
        require_once $view;
        return;
    };

    if(file_exists($controller)) {
        require_once $controller;
        return;
    };

    if(file_exists($adapter)) {
        require_once $adapter;
        return;
    }

    // Old class path
    $oldPath = __DIR__ . '/../php_class/';
    $filePath = $oldPath . $file;

    if(file_exists($filePath)){
        require_once $filePath;
        return;
    }
});