<?php
class Comments_Model
{
    public static function AddComment($row)
    {
        $db = Core::GetDB();

        $datetime = explode(' ',$row['datetime']);

        $date = explode('.',$datetime[0]);
        $row['datetime'] = $date[2].'-'.$date[1].'-'.$date[0].' '.$datetime[1];//+


        $db->AddComment($row);

    }

    public static function getComments($row)
    {
        $db = Core::GetDB();

        $res = $db->GetComments($row);


        return  $res;
    }
}