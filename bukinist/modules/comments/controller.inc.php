<?php
class Comments_Controller
{
    public function AddCommentAction()
    {
        Core::SetIsAjaxRequest();
        $res = Comments_Model::addComment($_POST);
        echo json_encode($res);;
    }

    public function GetCommentsToFilmAction()
    {
        Core::SetIsAjaxRequest();
        $comments = Comments_Model::getComments($_POST);
        $res = json_encode($comments);
        echo $res;
    }

}