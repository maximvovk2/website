<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
 Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/yiibooster');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$database = include 'database.php';
$import = include 'import.php';

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'My Web Application',
//    'language' => 'ru',

    // preloading component
    'preload' => array(
        'log',
        'bootstrap'
    ),

    // autoloading model and component classes
    'import'=> $import,

    'modules'=>array(
        // uncomment the following to enable the Gii tool
        'admin' => array(
            'preload' => array('bootstrap'),
            'components' => array(
                'bootstrap' => array(
                    'class' => 'bootstrap.components.Bootstrap',
                ),
            ),
        ),
        'gii' => array(
            'class'=>'system.gii.GiiModule',
            'password'=>'qwerty',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
        ),
    ),

    // application components
    'components'=>array(
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class' => 'AuthUser',
        ),

        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                'gii'=>'gii',
                'gii/<controller:\w+>'=>'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
                '/' => 'site/index',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//                'contactus' => 'contactus/index',
//                'successstories' => 'successstories/index',
                'expertise' => 'expertise/index',
                'Expertise' => 'expertise/index',
                'admin' => 'admin/default/index',
                '<module:\w+>/<controller:\w+>'=>'<module>/<controller>/index',
//                '<module:\w+>/<action:\w+>'=>'<module>/default/<action>',

                '<page:\w+>' => 'staticpages/index',
                'images/' => 'images/',
                'documents/' => 'documents/',

            ),
        ),

        'db'=> $database,
      		
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
    ),
);
