<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>БукіністЪ</title>

    <!-- Bootstrap core CSS --><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/templates/css/style.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">БукіністЪ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <a class="nav-link js-scroll-trigger" href='/catalog/list'>Каталог</a>

                <?php

                    if(isset($_SESSION['login']))
                    {
                        if($_SESSION['role']=='admin')
                        {
                            echo '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/catalog/addBook">Додати книгу</a>
                </li>';
                            echo '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/catalog/editBook">Змінити/видалити книгу</a>
                </li>';
                        }

                        echo '<li class="nav-item"><a href="/users/profile" >
                        <span class="nav-link js-scroll-trigger" >Ви авторизовані як <span id="userlogin">'.$_SESSION['login'].'</span></span></a>
                    </li>';
                        echo '<li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/users/logout">Вийти</a>
                    </li>';
                        if(isset($_COOKIE['order']))
                        echo "<li class=\"nav-item\">
                    <a class=\"nav-link js-scroll-trigger\" href='/orders/cart'>Кошик ( <span>".count(json_decode($_COOKIE['order']))."</span> )</a>
                </li>";
                    }
                    else {
                    echo '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/users/login">Увійти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/users/registration">Зареєструватись</a>
                </li>';
                }

                ?>


            </ul>
        </div>
    </div>
</nav>

<?php include($content_view)?>
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Vasylevska 2018</p>
    </div>
    <!-- /.container -->
</footer>


<script src="/templates/modules/catalog/orderController.js"></script>

</body>

</html>
