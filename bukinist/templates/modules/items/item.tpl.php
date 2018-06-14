<!-- Page Content -->
<?php extract($bookInfo)?>
<div class="container">
    <div class="row">
        <!--

        <h1><?=$id?></h1>
        <h1><?=$name?></h1>
        -->
        <input type="hidden" id="bookid" value="<?=$id?>">
        <div class="col-lg-2">

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-8">

            <div class="card mt-4">
                <img class="mainimg adminform" src="/uploads/books/<?=$imageId?>" alt="">

                <div class="card-body">
                    <h3 class="card-title"><?=$name?></h3>
                    <div>
                        <h4><?=$price?> грн.</h4>
                        <button type="button"  value="<?=$id?>" class="btn btn-default btn-md addtocart" >
                            <span class="fas fa-shopping-cart"></span> Додати в кошик
                        </button>
                    </div>
                    <br>
                    <table class="table">
                        <tr>
                            <td>Рік видання</td>
                            <td><?=$year?></td>
                        </tr>
                        <tr>
                            <td>Кількість сторінок</td>
                            <td><?=$pages?></td>
                        </tr>
                        <tr>
                            <td>Мова</td>
                            <td><?=$language?></td>
                        </tr>
                    </table>
                    <p class="card-text"><?=$description?></p>

                    <?php
                        require "templates/modules/rating/stars.tpl.php";
                    ?>
                </div>
            </div>
            <!-- /.card -->




            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Product Reviews
                </div>

                <div class="card-body" id="comment-container">
                    <div>
                        <?php
                        if(isset($_SESSION['login']))
                            echo '<form>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                    <button class="btn btn-dark" id="sendComment">Залишити відгук</button>
                                </form>';
                        ?>
                    </div>


                    <a class="btn btn-dark" id="getMoreComments" style="color:white">Ще коментарі</a>
                </div>
            </div>

            <!--


            -->
            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

    </div>

</div>
<?php
if(isset($_SESSION['login']))
    echo '<script src="/templates/modules/rating/rating.js"></script>';
?>

<script src="/templates/modules/comments/commentsController.js"></script>

<!-- /.container -->

