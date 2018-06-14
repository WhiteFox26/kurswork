<?php
class Rating_Controller
{
    public function SetRatingAction()
    {
        Core::SetIsAjaxRequest();


        $res = Rating_Model::setRating($_POST['id'],$_POST['userLogin'],$_POST['mark']);


        echo json_encode($res);
    }

    public function GetRatingAction()
    {
        Core::SetIsAjaxRequest();


        $comments = Rating_Model::getRating($_POST['id'],$_POST['userLogin']);

        $res = json_encode($comments);

        echo $res;
    }

}