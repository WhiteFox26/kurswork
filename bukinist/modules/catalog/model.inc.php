<?php
class Catalog_Model{

    public static function AddBook($row,$files)
    {
        if(isset($files['img']) && $files['img']['size']!=0) {
            $poster = $files['img'];
            $row['imageId'] = uniqid() . '.' . explode('/', $poster['type'])[1];
            $target = 'uploads/books/' . $row['imageId'];
            move_uploaded_file($poster['tmp_name'], $target);
        }
        $db = Core::GetDB();

        $res = $db->AddBook($row);
    }

    public static function IncreaseAmount($row)
    {
        $db = Core::GetDB();

        $res = $db->IncreaseAmount($row);

    }

    public static function GetAllBooks($offset,$amount,$genre)
    {
        $db = Core::GetDB();

        $res = $db->GetAllBooks($offset,$amount,$genre);
        foreach ($res as $key => $book)
        {
            if(isset($_SESSION['login']))
                $ulogin = $_SESSION['login'];
            else
                $ulogin='';
            $temp = Rating_Model::GetRating($book['id'],$ulogin);
            $res[$key]['avgMark'] = $temp['avgMark'];
            if(isset($_SESSION['login']))
                $res[$key]['userMark']= $temp['userRating'];
            $res[$key]['imageid']=$book['imageid'];
        }


        return $res;
    }

    public static function UpdateBook($row,$files)
    {
        if(isset($files['img']) && $files['img']['size']!=0)
        {
            $poster = $files['img'];
            $row['imageId'] = uniqid().'.'.explode('/',$poster['type'])[1];
            $target = 'uploads/books/'.$row['imageId'];
            move_uploaded_file($poster['tmp_name'],$target);
        }
        $db = Core::GetDB();

        $res = $db->UpdateBook($row);
    }

    public static function DeleteBook($id)
    {
        $db = Core::GetDB();

        $res = $db->DeleteBook($id);

    }

    public static function GetAllGenres()
    {
        $db = Core::GetDB();

        $res = $db->GetAllGenres();


        $res = array_map('ucfirst', explode('; ',$res[0][0]));
        $res = array_unique($res);

        return $res;

    }

    public static function GetBookById($id)
    {
        $db = Core::GetDB();

        $res = $db->GetBookById($id)[0];

        $res['amount'] = $db->GetAmount($id)[0];

        return $res;
    }
}
/**
 * Created by PhpStorm.
 * User: WhiteFox
 * Date: 07.06.2018
 * Time: 13:05
 */