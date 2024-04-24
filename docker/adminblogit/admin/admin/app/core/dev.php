<?php

class Settings extends GlobalSettings {
    
    const DB = [ 
        'user' => 'root', 
        'pass' => 'user',
        'dbname' => 'blogit',
        'host' => 'db'
    ];

    const ROOT_PATH = '/var/www/html'; 

    const PATH = [
        'root'        => self::ROOT_PATH,
        'base'        => 'http://localhost/admin',
        'images'      => self::ROOT_PATH.'/admin/resources/images',        
        'models'      => self::ROOT_PATH.'/admin/app/model',
        'controllers' => self::ROOT_PATH.'/admin/app/controller',
        'view'        => self::ROOT_PATH.'/admin/app/view',
        'entities'    => self::ROOT_PATH.'/admin/app/entity',
        'utils'       => self::ROOT_PATH.'/admin/app/utils',
        'config'      => self::ROOT_PATH.'/admin/config',
        'core'        => self::ROOT_PATH.'/admin/app/core',
        '404'         => self::ROOT_PATH.'/admin/app/view/error/404.php',
        'plugins'     => self::ROOT_PATH.'/admin/assets/plugins'
    ];

    const SERVER_PATH = 'http://localhost/admin'.self::PATH['base'];
}