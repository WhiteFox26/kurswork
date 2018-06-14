<div class="bglib">
<div class = "container">

    <div class="wrapper slimform">
        <?php
        if($registered==1)
            echo '<span style="text-align: center">Підтверддіть реєстрацію на Вашій пошті</span>';
        ?>
        <form action="/users/login" method="post" name="Login_Form" class="form-signin">
            <h3 class="form-signin-heading">Раді бачити Вас знову! Будь-ласка, авторизуйтесь:</h3>
            <hr class="colorgraph"><br>

            <input type="text" class="form-control" name="Username" placeholder="Логін" required="" autofocus="" />
            <input type="password" class="form-control" name="Password" placeholder="Пароль" required=""/>
            <input type="button" class="btn btn-default btn-block btcolor" value="Увійти" id="loginButton">

        </form>
    </div>
</div>
</div>
<script src="/templates/modules/users/loginChecker.js"></script>