<?php
class Main_View
{
    public static function indexView()
    {
        $tpl = Core::$IndexTpl;
        $tpl->setContentView('templates/index.tpl.php');
    }
}