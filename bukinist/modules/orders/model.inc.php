<?php
class Orders_Model
{
    public static function ConfirmOrder($res)
    {
        $db = Core::GetDB();

        $save['ordered'] = json_encode($res);
        $save['date'] =  date("Y-m-d");
        $save['userid'] =  $db->GetUserIdByLogin($_SESSION['login'])[0][0];
        $save['price'] = $res['price'];
        $db->ConfirmOrder($save);

    }

    public static function GetAllUserOrders($res)
    {
        $db = Core::GetDB();

        $userid =  $db->GetUserIdByLogin($_SESSION['login'])[0][0];

        $res = $db->GetAllUserOrders($userid);
        $arr = [];
        $i = 0;
        foreach ($res as $item)
        {
            $arr[$i] = [];
            $arr[$i]['ordered'] = (array)json_decode($item['ordered']);
            $arr[$i]['date'] = $item['date'];
            $arr[$i]['orderid'] = $item['id'];

            $i++;
        }

        return $arr;
    }
}