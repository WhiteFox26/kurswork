<?php

class Core
{
    public static $IndexTpl;
    private static $DB;

    public static function SetMainContent($file)
    {
        self::$IndexTpl->setContentView($file);
    }

    public static function SetIsAjaxRequest()
    {
        self::$IndexTpl->AjaxRequest();
    }

    public static function GetDB()
    {
        return self::$DB;
    }

    public static function Init()
    {
        session_start();
        self::$IndexTpl = new Template('templates/layout.tpl.php');
        self::$IndexTpl->setParam('Title', '');
        self::$IndexTpl->setParam('Content','some content overhere');
        self::$IndexTpl->setContentView('templates/index.tpl.php');
        self::$DB = new DB(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        // db connect
    }

    public static function Run()
    {
        if(isset($_GET['path']) && !empty($_GET['path'])){
            $path = $_GET['path'];
            $pathParts = explode('/',$path);

            $className = ucfirst(array_shift($pathParts).'_Controller');
            $methodShortName = ucfirst(array_shift($pathParts));
            if(empty($methodShortName))
                $methodShortName = 'Index';
            $methodName = $methodShortName.'Action';
        }
        else{
            $className = 'Main_Controller';
            $methodName = 'IndexAction';
            $pathParts = array();
        }


        $error404 = false;
        if(class_exists($className)){
            $controller = new $className();
            if(method_exists($controller,$methodName)){
                $paramsArray = $controller->$methodName($pathParts);
                self::$IndexTpl->setParams($paramsArray);
            }else $error404 = true;
        }else $error404 = true;

        if ($error404)
        {
            $controller = new Main_Controller();
            $res = $controller->Error404Action();
        }
    }

    public static function Done()
    {
            self::$IndexTpl->display();
    }
}