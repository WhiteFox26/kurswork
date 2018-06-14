<?php
class Users_Model{

    public static function ActivateAccount($token)
    {
        $db =  Core::GetDB();
        $db->ActivateAccount($token);
        header("Location: /users/login/0");
    }

    public static function SendMail($email,$theme,$message)
    {
        $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($email,$theme,$message,$headers);
    }

    public static function registerUser($row)
    {
        $db = Core::GetDB();

        $row['token'] = md5(uniqid());
        $row['password'] = md5($row['password']);

        $db->RegisterUser($row);

        $message = '<a href="http://' . $_SERVER["HTTP_HOST"] . '/users/activate/' . $row['token'] . '">Click here to activate your account<a/> ';
        $message .= "<br/><br/>If you recieved this message by accident just ignore it.";
        $message = wordwrap($message, 70, "\r\n");


        self::sendMail($row['email'],'Account activation', $message);
    }

    public static  function  LoginUser($login, $password)
    {
        $db = Core::GetDB();
        $res = $db->LoginUser($login,md5($password));

        if($res == 1){
            $_SESSION['login']=$login;
            $_SESSION['role']=$db->GetUserRole($login);

         //   $_SESSION['role']=$res['role'];
            return 1;
        }
        else
            return -1;
    }


    public static function CheckInputs($row)
    {
        /*data: {
            login: $("input[name='Username']").val(),
            password: $("input[name='Password']").val(),
            bday: $("input[name='Birthday']").val(),
            email: $("input[name='Email']").val()
        },*/

        $db = Core::GetDB();
        $returnObj = [];

        $res = $db->CheckEmail($row['email']);
        if($res==1)
            $returnObj['email']=-1;

        $res = $db->CheckLogin($row['login']);
        if($res==1)
            $returnObj['login']=-1;

        return $returnObj;

    }

}