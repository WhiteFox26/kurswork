<div id="<?=$id?>">
    <?php
    echo '<input class=bookmark type="hidden" value="'.$avgMark.'">';

    for($i = 0;$i < 5;$i++)
    {
        if($i< $avgMark)
            echo '<span class="fa fa-star fa-2x checked"></span>';
        else
            echo '<span class="fa fa-star fa-2x "></span>';
    }
    ?>
    <?php
    if(isset($_SESSION['login']))
        echo '<span class="marks">Ваша оцінка: <?=$userMark?></span>';
    ?>
    <!--<span class="fa fa-star checked"></span>
    <span class="fa fa-star"></span>-->
</div>