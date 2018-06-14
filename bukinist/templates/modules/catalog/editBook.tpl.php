<div class="container">
    <div class="row adminform">
        <div class=" col-lg-6 erclass">
            <ul>
                <h2>Скористейтесь пошуком для знаходження необхідної книги</h2>
                <form action="/catalog/updateBook" method="post" class="edit" enctype="multipart/form-data">
                    <li class="list-group-item">
                        <p class="key">Пошук:</p>
                        <p class="val">
                            <input type="text" name="searchfield" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Автор:</p>
                        <p class="val">
                        <select name="bookslist" class="full-width">
                            <?php
                            foreach ($books as $book)
                                echo '<option value="'.$book['id'].'">'.$book['id'].' - '.$book['author'].' - '.$book['name'].'</option>'
                            ?>
                        </select>
                    </li>
                    <input type="hidden" name="id" value="<?=$book['id']?>">
                    <li class="list-group-item">
                        <p class="key">Автор:</p>
                        <p class="val">
                            <input type="text" name="author" class="full-width">
                        </p>
                    </li>
                    <li class="list-group-item">
                        <p class="key">Назва:</p>
                        <p class="val">
                            <input type="text" name="name" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Ціна:</p>
                        <p class="val">
                            <input type="text" name="price" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Жанри:</p>
                        <p class="val">
                            <input type="text" name="genres" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Кількість:</p>
                        <p class="val">
                            <input type="number" name="amount" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Опис:</p>
                        <p class="val">
                            <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                        </p>
                    </li>


                    <li class="list-group-item">
                        <p class="key">Рік видання:</p>
                        <p class="val">
                            <input type="number" name="year" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Вікове обмеження:</p>
                        <p class="val">
                            <input type="number" name="age" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Кількість сторінок:</p>
                        <p class="val">
                            <input type="number" name="pages" class="full-width">

                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Мова:</p>
                        <p class="val">
                            <input type="text" name="language" class="full-width"><br>
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Фото:</p>
                        <p class="val">
                            <img class="mainimg" src="" alt="">
                        </p>
                    </li>

                    <br>

                    <input type="file" name="img">
                    <br>
                    <br>
                    <input type="submit" value="Оновити" class="btn btn-default" >

                </form>
                <br>
                <form action="/catalog/deleteBook" method="post" class="delete">
                    <input type="hidden" name="id" value="<?=$book['id']?>">
                    <input type="submit" value="Видалити книгу" class="btn btn-default" >
                </form>
            </ul>
    <hr>
    <!-- amount form ook" method="post">
        <input type="hidden" name="action" value="amount">
        search:
        <input type="text" name="searchfield">
        <br>
        <select name="bookslist">
            <?php
    foreach ($books as $book)
        echo '<option value="'.$book['id'].'">'.$book['author'].' - '.$book['name'].'</option>'
    ?>
        </select>
        <br>
        amount<input type="number" name="amount">
        <br>
        <input type="submit">
    </form-->
        </div>
    </div>
</div>
<script>
    $("form.delete").submit(function (ev) {
        ev.preventDefault();
        id = $('input[name="id"]').val();
        $("option[value="+id+"]").remove();
        $.ajax({
            url: '/catalog/deleteBook',
            data: {
                id:id
            },
            type: 'post',
            success: function (res) {

                loadSelectedBook();
            }
        });
        id=$("select[name='bookslist'] option:first-child").val();

    });


</script>
<script src="/templates/modules/catalog/bookSearch.js"></script>