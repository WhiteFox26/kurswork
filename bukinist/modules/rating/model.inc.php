<?php
class Rating_Model
{
    public static function GetRating($id,$userlogin)
    {
        $db = Core::GetDB();

        $res = $db->GetRating($id,$userlogin);

        return $res;
    }

    public static function SetRating($id,$userlogin,$mark)
    {
        $db = Core::GetDB();

        $res = $db->SetRating($id,$userlogin,$mark);

        return $res;
    }
}