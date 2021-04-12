<?php

spl_autoload_register(function ($className){

    $extension = '.class.php';
    $pathFromRoot = 'assets/php/';
    $file = $className . $extension;

    

    $modelPath      = $pathFromRoot . 'model/';
    $viewPath       = $pathFromRoot . 'view/';
    $controllerPath = $pathFromRoot . 'controller/';

    $model = $modelPath . $file;
    $view  = $viewPath . $file;
    $controller = $controllerPath . $file;

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

    // Old class path
    $oldPath = 'assets/php_class/';
    $filePath = $oldPath . $file;

    echo $filePath . '<br>';

    if(file_exists($filePath)){
        require_once $filePath;
        return;
    }
});