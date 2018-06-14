<?php
include('config/database.inc.php');
error_reporting(E_ALL);
set_include_path('core');
spl_autoload_extensions('.inc.php');
spl_autoload_register(function ($className){
    $path = 'core/'.$className.'.inc.php';
    if(is_file($path))
        include($path);
});
spl_autoload_register(function($className)
{
    $parts = explode('_',$className);
    $path = 'modules/'.strtolower(array_shift($parts)).
        '/'.strtolower(array_shift($parts)).'.inc.php';
    if(is_file($path))
        include($path);
});
date_default_timezone_set('Europe/Kiev');
Core::Init();
Core::Run();
Core::Done();
