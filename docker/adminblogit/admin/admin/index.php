<?php
declare(strict_types = 1); //strict typing

// ini_set("display_errors", "1");
// ini_set("display_startup_errors", "1");
// error_reporting(E_ALL);

ob_start(); // Rozpoczęcie buforowania wyjścia

require_once ('app/core/settings.php');

if (GlobalSettings::ENVIRONMENT == 'DEV')
    require_once ('app/core/dev.php');
else if (GlobalSettings::ENVIRONMENT == 'PRE')
    require_once ('app/core/pre.php');

require_once (Settings::PATH['core'].'/db.conf.php');
require_once (Settings::PATH['view'].'/layouts/header.php');


if (!isset($_SESSION['username_admin'])){
    $controller = 'login';
    if(!isset($_REQUEST['c'])) {
        require_once (Settings::PATH['controllers']."/$controller.controller.php");
        $controller = ucwords($controller).'Controller';
        $controller = new $controller;
        $controller->index();
    }
    else {
        $action = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';
        $file = Settings::PATH['controllers']."/$controller.controller.php";
        if (!file_exists($file))
            require_once (Settings::PATH['404']);
        require_once ($file);

        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;    
        if (!(method_exists($controller, $action) && is_callable(array($controller, $action))))
            require_once (Settings::PATH['404']);
        call_user_func(array($controller, $action));
    }
}
else{
    $controller = 'home';

    //require_once (Settings::PATH['view'].'/layouts/navbar.php');
    if(!isset($_REQUEST['c'])) {
        require_once (Settings::PATH['controllers']."/$controller.controller.php");
        $controller = ucwords($controller).'Controller';
        $controller = new $controller;
        $controller->index();
    }
    else {
        $controller = strtolower($_REQUEST['c']);
        $action = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';
        $file = Settings::PATH['controllers']."/$controller.controller.php";
        if (!file_exists($file))
            require_once (Settings::PATH['404']);
        require_once ($file);

        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;    
        if (!(method_exists($controller, $action) && is_callable(array($controller, $action))))
            require_once (Settings::PATH['404']);
        call_user_func(array($controller, $action));
    }
}

require_once (Settings::PATH['view']."/layouts/footer.php");