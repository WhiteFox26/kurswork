<?php
class Users_View
{
    public static function loginView()
    {
        Core::SetMainContent('templates/modules/users/login.tpl.php');

    }

    public static function registerView()
    {
        Core::SetMainContent('templates/modules/users/registration.tpl.php');


    }

    public static function ProfileView()
    {
        Core::SetMainContent('templates/modules/users/profile.tpl.php');
    }
}