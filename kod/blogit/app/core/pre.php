<?php

class Settings extends GlobalSettings {
    
    const DB = [ 
        'user' => 'user', 
        'pass' => 'user',
        'dbname' => 'blogit',
        'host' => 'localhost',
		'server' => 'db'
    ];

    const ROOT_PATH = 'C:\xampp\htdocs'; 

    const PATH = [
        'root'        => self::ROOT_PATH,
        'base'        => 'http://localhost/blogit',
        'images'      => self::ROOT_PATH.'/blogit/resources/images',        
        'models'      => self::ROOT_PATH.'/blogit/app/model',
        'controllers' => self::ROOT_PATH.'/blogit/app/controller',
        'view'        => self::ROOT_PATH.'/blogit/app/view',
        'entities'    => self::ROOT_PATH.'/blogit/app/entity',
        'utils'       => self::ROOT_PATH.'/blogit/app/utils',
        'config'      => self::ROOT_PATH.'/blogit/config',
        'core'        => self::ROOT_PATH.'/blogit/app/core',
        '404'         => self::ROOT_PATH.'/blogit/app/view/error/404.php',
        'plugins'     => self::ROOT_PATH.'/blogit/assets/plugins'
    ];

    const SERVER_PATH = 'http://localhost'.self::PATH['base'];
}