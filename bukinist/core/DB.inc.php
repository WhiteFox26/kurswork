<?php
class DB
{
    protected $pdo;
    public function __construct($host,$user,$pass,$dbname)
    {
        $this->pdo = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    }

    public function RegisterUser($row)
    {
        $stmt = $this->pdo->prepare('insert into users(login,email,password,token,birthdate) values(:login,:email,:password,:token,:birthdate)');
        $stmt->bindParam(':login',$row['login']);
        $stmt->bindParam(':password',$row['password']);
        $stmt->bindParam(':birthdate',$row['bday']);
        $stmt->bindParam(':token',$row['token']);
        $stmt->bindParam(':email',$row['email']);
        $stmt->execute();
    }

    public function LoginUser($login,$password)
    {
        $stmt = $this->pdo->prepare('select count(*) from users where login=:l and password=:p and status=1');
        $stmt->bindParam(':l',$login);
        $stmt->bindParam(':p',$password);
        $stmt->execute();

        $res = $stmt->fetch();
        return $res[0];
    }

    public function CheckEmail($email)
    {
        $stmt = $this->pdo->prepare('select count(*) from users where email=:email');
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        $res = $stmt->fetch();
        return $res[0];
    }

    public function CheckLogin($login)
    {
        $stmt = $this->pdo->prepare('select count(*) from users where login=:login');
        $stmt->bindParam(':login',$login);
        $stmt->execute();

        $res = $stmt->fetch();
        return $res[0];
    }

    public function ActivateAccount($token)
    {
        $stmt = $this->pdo->prepare('update users set status=1 where token=:token ');
        $stmt->bindParam(':token',$token);
        $stmt->execute();
    }

    public function GetUserRole($login)
    {
        $stmt = $this->pdo->prepare('select role from users where login=:login');
        $stmt->bindParam(':login',$login);
        $stmt->execute();

        $res = $stmt->fetch();
        return $res[0];
    }

    public function AddBook($row)
    {
        $stmt = $this->pdo->prepare('insert into books (author,name,price,genre,description,year, age, pages, language,imageId) values(:author,:name,:price,:genre,:description,:year, :age, :pages, :language, :imageId)');
        $stmt->bindParam(':name',$row['name']);
        $stmt->bindParam(':author',$row['author']);
        $stmt->bindParam(':price',$row['price']);
        $stmt->bindParam(':genre',$row['genres']);
        $stmt->bindParam(':description',$row['description']);
        $stmt->bindParam(':year',$row['year']);
        $stmt->bindParam(':age',$row['age']);
        $stmt->bindParam(':pages',$row['pages']);
        $stmt->bindParam(':language',$row['language']);
        $stmt->bindParam(':imageId',$row['imageId']);
        $stmt->execute();


        $stmt = $this->pdo->prepare('SELECT LAST_INSERT_ID() as id');
        $stmt->execute();
        $bookid = $stmt->fetchAll()[0][0];


        $stmt = $this->pdo->prepare('insert into storage (bookid,amount) values (:bookid,:amount)');
        $stmt->bindParam(':bookid',$bookid);
        $stmt->bindParam(':amount',$row['amount']);
        $stmt->execute();


    }

    public function IncreaseAmount($row)
    {
        $stmt = $this->pdo->prepare('update storage set amount=amount+:amount where bookid=:bookid');
        $stmt->bindParam(':bookid',$row['bookid']);
        $stmt->bindParam(':amount',$row['amount']);
        $stmt->execute();
    }

    public function GetAllBooks($offset,$amount,$genre)
    {
        if(gettype($genre)=='integer')
        {
            $stmt = $this->pdo->prepare('select id,name,author,price,imageid from books limit :limit offset :offset  ');
        }
        else{
            $stmt = $this->pdo->prepare('select id,name,author,price,imageid from books where genre like :genre limit :limit offset :offset  ');
            $temp = '%'.$genre.'%';


            $stmt->bindParam(':genre',$genre);
        }

        $amount = intval($amount);
        $offset = intval($offset);

        $stmt->bindParam(':limit',$amount,PDO::PARAM_INT);
        $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll();




        return $res;
    }

    public function GetAllGenres()
    {
        $stmt = $this->pdo->prepare('SELECT GROUP_CONCAT(genre SEPARATOR \'; \')FROM books ');
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }

    public function UpdateBook($row)
    {
        $stmt = $this->pdo->prepare('update books set author=:author,name=:name,price=:price,
genre=:genre,description=:description, year=:year, age=:age, pages=:pages, language=:language, imageid=:imageid where id=:id');
        $stmt->bindParam(':id',$row['id']);
        $stmt->bindParam(':author',$row['author']);
        $stmt->bindParam(':name',$row['name']);
        $stmt->bindParam(':price',$row['price']);
        $stmt->bindParam(':genre',$row['genres']);
        $stmt->bindParam(':description',$row['description']);
        $stmt->bindParam(':year',$row['year']);
        $stmt->bindParam(':age',$row['age']);
        $stmt->bindParam(':pages',$row['pages']);
        $stmt->bindParam(':language',$row['language']);
        $stmt->bindParam(':imageid',$row['imageId']);

        $stmt->execute();
    }

    public function DeleteBook($id)
    {
        $stmt = $this->pdo->prepare('delete from books where id=:id');
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }

    public function GetAmount($id)
    {
        $stmt = $this->pdo->prepare('SELECT amount from storage where bookid=:id ');
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $res = $stmt->fetchAll()[0];
        return $res;
    }

    public function GetBookById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * from books where id=:bid ');
        $stmt->bindParam(':bid',$id);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }

    public function GetRating($bookid,$userlogin)
    {
        $stmt = $this->pdo->prepare('select avg(mark) as avgMark from marks where bookid=:bookid');
        $stmt->bindParam(':bookid',$bookid);
        $stmt->execute();
        $res = [];
        $res['avgMark'] = round( $stmt->fetchAll()[0][0]);

        if($userlogin!=null && $userlogin!=''){
            $stmt = $this->pdo->prepare('select id from users where login=:login');
            $stmt->bindParam(':login',$userlogin);
            $stmt->execute();
            $userid = $stmt->fetchAll()[0]['id'];

            if($userid!=null && $userid!=0)
            {
                $stmt = $this->pdo->prepare('select mark from marks  where bookid=:bookid and userid=:userid');
                $stmt->bindParam(':userid',$userid);
                $stmt->bindParam(':bookid',$bookid);
                $stmt->execute();
                $m =  $stmt->fetchAll();
                if(count($m)>0)
                    $res['userRating'] = intval($m[0][0]);
                else
                    $res['userRating'] = 0;
            }
        }
        return $res;
    }

    public function setRating($bookid, $userlogin, $rating)
    {
        $stmt = $this->pdo->prepare('select id from users where login=:login');
        $stmt->bindParam(':login', $userlogin);
        $stmt->execute();
        $userid = $stmt->fetchAll()[0]['id'];

        $stmt = $this->pdo->prepare('select count(*) from marks where bookid=:bookid and userid=:userid');
        $stmt->bindParam(':bookid', $bookid);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $res = $stmt->fetchAll();

        if ($res[0][0] == 0){

            $stmt = $this->pdo->prepare('insert into marks(bookid,userid,mark) values(:bookid,:userid,:mark)');
            $stmt->bindParam(':bookid',$bookid);
            $stmt->bindParam(':userid',$userid);
            $stmt->bindParam(':mark',$rating);
            $stmt->execute();
        }
        else{

            $stmt = $this->pdo->prepare('update marks set mark=:mark where bookid=:bookid and userid=:userid');
            $stmt->bindParam(':bookid',$bookid);
            $stmt->bindParam(':userid',$userid);
            $stmt->bindParam(':mark',$rating);
            $stmt->execute();

        }

        return $stmt->errorInfo();
    }

    public function GetUserIdByLogin($login)
    {
        $stmt = $this->pdo->prepare('select id from users where login=:login');
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $userid = $stmt->fetchAll();
        return $userid;
    }

    public function ConfirmOrder($row)
    {
        $stmt = $this->pdo->prepare('insert into orders(userid,ordered,price,date) values(:userid,:ordered,:price,:date)');
        $stmt->bindParam(':userid',$row['userid']);
        $stmt->bindParam(':ordered',$row['ordered']);
        $stmt->bindParam(':price',$row['price']);
        $stmt->bindParam(':date',$row['date']);
        $stmt->execute();
        var_dump($stmt->errorInfo());
    }

    public function GetAllUserOrders($id)
    {
        $stmt = $this->pdo->prepare('select * from orders where userid=:userid');
        $stmt->bindParam(':userid', $id);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res ;
    }

    public function AddComment($row)
    {
        $userid = $this->GetUserIdByLogin($row['userLogin'])[0][0];


        $stmt = $this->pdo->prepare('insert into comments(userid,bookid,content,datetime) values(:userid,:bookid,:content,:datetime)');
        $stmt->bindParam(':userid',$userid);
        $stmt->bindParam(':bookid',$row['id']);
        $stmt->bindParam(':content',$row['content']);
        $stmt->bindParam(':datetime',$row['datetime']);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }

    public function GetComments($row)
    {//select * from comments inner join films on films.id = comments.filmid where filmid = 0 limit 1 OFFSET 1
        $stmt = $this->pdo->prepare('select comments.id,comments.userid,comments.content,DATE_FORMAT(comments.datetime, \'%d.%m.%Y %H:%i:%s\') as datetime,users.login from comments 
                               inner join books on books.id = comments.bookid
                               inner join users on users.id = comments.userid
                               where bookid=:bookid order by DATE_FORMAT(comments.datetime, \'%d.%m.%Y %H:%i:%s\') desc  limit :limit offset :offset ');
        $id = intval($row['id']);
        $limit = intval($row['commentsN']);
        $offset = intval($row['offset']);
        $stmt->bindParam(':bookid',$id);
        $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
        $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll();

        return $res;
    }

}
