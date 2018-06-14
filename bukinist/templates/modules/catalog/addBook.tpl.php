<div class="container">

    <div class="row adminform">

        <div class=" col-lg-6">
            <h3>Додати нову книгу:</h3>
            <form action="/catalog/addBook" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="newbook">
                <ul class="list-group add-form">
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
                        <p class="key">Жанри: (розділіть ';' )</p>
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
                        <p class="key">Рік:</p>
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
                            <input type="text" name="language" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Фото:</p>
                        <p class="val">
                            <input type="file" name="img" >
                        </p>
                    </li>

                </ul>


                <input type="submit" class="btn btn-default" value="Додати книгу">
            </form>

            <!-- amount form -->

        </div>
        <div class="col-lg-6">
            <h3>Додати товар на складі:</h3>
            <ul class="list-group add-form">
                <form action="/catalog/addBook" method="post">
                    <input type="hidden" name="action" value="amount">


                    <li class="list-group-item">
                        <p class="key">Пошук:</p>
                        <p class="val">
                            <input type="text" name="searchfield" class="full-width">
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Книга:</p>
                        <p class="val">
                            <select name="bookslist" class="full-width">
                                <?php
                                foreach ($books as $book)
                                    echo '<option value="'.$book['id'].'">'.$book['author'].' - '.$book['name'].'</option>'
                                ?>
                            </select>
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="key">Кількість:</p>
                        <p class="val">
                            <input type="number" name="amount" class="full-width">
                        </p>
                    </li>

                    <input type="submit" value="Додати товар" class="btn btn-default">
                </form>
            </ul>
        </div>
    </div>
    <br>
</div>

<script>
    $("input[name='searchfield']").focusout(function () {
        var searchString = $(this).val();
        console.log(searchString);
        $("select[name='bookslist'] option").each(function () {
            $(this).removeAttr('selected');
            if($(this).text().toLowerCase().indexOf(searchString.toLowerCase()) >= 0)
            {
                $(this).attr('selected',true);
                id = $(this).val();
            }
        });


    });
</script>