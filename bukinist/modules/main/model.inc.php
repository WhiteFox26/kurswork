<?php
class Main_Model
{
    public static function getCurrentMoviesPreview()
    {
        $db = new DB(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $res = $db->GetCurrentMoviesPreview();

        foreach ($res as $key => $item){
            $temp = $db->GetSessionsByMovieId($item['id']);

            foreach ($temp as $kkey => $val) {
                if(!isset($res[$key]['sessions'][$val['date']]))
                    $res[$key]['sessions'][$val['date']] = array();
            }

            foreach ($temp as $kkey => $val){
                array_push($res[$key]['sessions'][$val['date']],array("time"=> $val['time'],'id'=>$val['id']));

            }
            //$res[$key]['sessions'] = $db->GetSessionsByMovieId($item['id']);
        }
        return $res;
    }
}