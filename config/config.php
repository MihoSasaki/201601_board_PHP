<?php

ini_set('display_errors',1);

define('DB_DATABASE','messageboard');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','YUIyui15');
define('PDO_DSN','mysql:dbhost=localhost;dbname=' . DB_DATABASE);

define('SITE_URL', '../localhost/messageboard/' );

require_once (__DIR__.'/../lib/functions.php');


require_once ( __DIR__.'/autoload.php');

session_start();