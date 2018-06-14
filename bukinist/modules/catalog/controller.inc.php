<?php
class Catalog_Controller
{
    public function ListAction()
    {
        $genres = Catalog_Model::GetAllGenres();

        Core::$IndexTpl->setParam('genres',$genres);
        Catalog_View::listView();
    }

    public function AddBookAction()
    {
        $hasRights = true;
        if(!isset($_SESSION['role']))
        {
            $hasRights=false;
        }
        else
            if($_SESSION['role']!='admin')
                $hasRights=false;

        if(!$hasRights)
        {
            $mc = new Main_Controller();
            $mc->Error404Action();
            return;
        }


        switch($_SERVER['REQUEST_METHOD'])
        {
            case 'GET':
                Catalog_View::AddBookView();
                $books = Catalog_Model::GetAllBooks(0,100000,0);
                Core::$IndexTpl->setParam('books',$books);
                break;
            case 'POST':

                $books = Catalog_Model::GetAllBooks(0,100000,0);
                Core::$IndexTpl->setParam('books',$books);
                switch ($_POST['action'])
                {

                    case 'newbook':
                        Catalog_Model::AddBook($_POST,$_FILES);


                        break;
                    case 'amount':

                        //Catalog_Model::GetAllBooks();
                        Catalog_Model::IncreaseAmount($_POST);
                        break;

                }

                Catalog_View::AddBookView();
                break;
        }
    }

    public function EditBookAction()
    {
        $hasRights = true;
        if(!isset($_SESSION['role']))
        {
            $hasRights=false;
        }
        else
            if($_SESSION['role']!='admin')
                $hasRights=false;

        if(!$hasRights)
        {
            $mc = new Main_Controller();
            $mc->Error404Action();
            return;
        }

        Catalog_View::EditBookView();
        $books = Catalog_Model::GetAllBooks(0,100000,0);
        Core::$IndexTpl->setParam('books',$books);
    }

    public function UpdateBookAction()
    {
        Catalog_Model::UpdateBook($_POST,$_FILES);

        header('Location: /catalog/editBook');
    }

    public function GetBooksAction()
    {
        Core::SetIsAjaxRequest();

        if(!isset($_POST['genre']))
            $books = Catalog_Model::GetAllBooks($_POST['offset'],$_POST['amount'],0);
        else
        {
            $_POST['genre'] = "%".ucfirst($_POST['genre'])."%";

            $books = Catalog_Model::GetAllBooks($_POST['offset'],$_POST['amount'],$_POST['genre']);
        }
        $res = json_encode($books);

        echo $res;
    }

    public function ViewAction($params)
    {
        $id = array_shift($params);

        $bookInfo = Catalog_Model::GetBookById($id);

        if($bookInfo['amount']==null){
            $mc = new Main_Controller();
            $mc->Error404Action();
            return;
        }

        if(isset($_SESSION['login']))
            $temp = Rating_Model::GetRating($bookInfo['id'],$_SESSION['login']);
        else
            $temp = Rating_Model::GetRating($bookInfo['id'],'');

        if(isset($_SESSION['login']))
            $bookInfo['userMark']= $temp['userRating'];

        $bookInfo['avgMark'] = $temp['avgMark'];
        $bookInfo['userMark']= $temp['userRating'];

        Catalog_View::BookInfoView();
        Core::$IndexTpl->setParam('bookInfo',$bookInfo);

    }

    public function GetBookAction()
    {
        Core::SetIsAjaxRequest();
        $hasRights = true;
        if(!isset($_SESSION['role']))
        {
            $hasRights=false;
        }
        else
            if($_SESSION['role']!='admin')
                $hasRights=false;

        if(!$hasRights)
        {
            $mc = new Main_Controller();
            $mc->Error404Action();
            return;
        }


        $res = Catalog_Model::GetBookById($_POST['id']);
        echo json_encode($res);
    }

    public function DeleteBookAction()
    {
        Core::SetIsAjaxRequest();
        Catalog_Model::DeleteBook($_POST['id']);
    }
}