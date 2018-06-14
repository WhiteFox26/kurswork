<?php
class Users_Controller{

    public function LoginAction($params)
    {
        switch($_SERVER['REQUEST_METHOD'])
        {
            case 'GET':
                Users_View::loginView();
                $temp = array_shift($params);
                if($temp==1)
                    Core::$IndexTpl->setParam('registered',1);
                else
                    Core::$IndexTpl->setParam('registered',0);
                break;
            case 'POST':
                Core::SetIsAjaxRequest();
                $res = Users_Model::LoginUser($_POST['login'],$_POST['password']);

                if($res==1)
                    echo 1;
                else
                    echo -1;
                break;
        }
    }

    public function RegistrationAction()
    {
        switch($_SERVER['REQUEST_METHOD'])
        {
            case 'GET':
                Users_View::registerView();
                break;
            case 'POST':
                Core::SetIsAjaxRequest();
                $res = Users_Model::CheckInputs($_POST);

                echo json_encode($res);
                if(count($res)==0)
                    Users_Model::registerUser($_POST);
                break;
        }
    }

    public function ActivateAction($params)
    {
        $token = array_shift($params);
        Users_Model::ActivateAccount($token);
    }

    public function LogoutAction()
    {
        if(isset($_COOKIE['order']))
        {
        unset($_COOKIE['order']);
        setcookie('order', null, -1, '/');
        }
        session_unset();
        session_destroy();
        header('Location: /users/login/ ');
    }

    public function ProfileAction()
    {
        $orders = Orders_Model::GetAllUserOrders($_SESSION['login']);

        Core::$IndexTpl->setParam('orders',$orders);
        Users_View::ProfileView();

        //  var_dump($orders);die();
    }
}