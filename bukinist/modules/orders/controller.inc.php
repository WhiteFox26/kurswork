<?php
class Orders_Controller
{
    public function CartAction($params)
    {
        if(!isset($_COOKIE['order']))
        {
            $m = new Main_Controller();
            $m->Error404Action();
            return;
        }
        $arr  =  json_decode($_COOKIE['order']);
        $arr = array_count_values($arr );
        $res = array();
        $i = 0;
        $totalCost = 0;
        foreach ($arr as $key => $value){
            $res[$i] = Catalog_Model::GetBookById($key);
            $res[$i]['amount'] = $value;
            $totalCost += $res[$i]['amount']*intval($res[$i]['price']);
            $i++;
        }
        $res['totalCost'] = $totalCost;

        Core::SetMainContent('templates/modules/orders/cart.tpl.php');
        Core::$IndexTpl->setParam('orderList',$res);
        Core::$IndexTpl->setParam('totalCost',$totalCost);
    }

    public function OrderAction()
    {
        $arr  =  json_decode($_COOKIE['order']);
        $arr = array_count_values($arr );
        $res = array();
        $i = 0;
        $totalCost = 0;
        foreach ($arr as $key => $value){
            $res[$i] = Catalog_Model::GetBookById($key);
            $res[$i]['amount'] = $value;
            $totalCost += $res[$i]['amount']*intval($res[$i]['price']);
            $i++;
        }
        $res['price'] = $totalCost;

        Orders_Model::ConfirmOrder($res);

    }

}