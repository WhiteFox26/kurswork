<?php
class Main_Controller
{
    public function IndexAction()
    {
        Main_View::indexView();
    }

    public function Error404Action()
    {
        Core::$IndexTpl->setContentView('templates/error404.tpl');
    }

}