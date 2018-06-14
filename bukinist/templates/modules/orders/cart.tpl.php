<div class="container" style="margin-top:100px">
    <form action="/orders/order" method="post">
        <?php
        $i = 0;
        foreach ($orderList as $key => $item) { // hz naschet

            if($i==$key){
            echo '<div class="col-lg-5   form-signin cartst" data-id="'.$item['id'].'">';
            echo "<p class='form-control'>".$item['name']."</p>";
            echo "<p class='form-control'>".$item['author']."</p>";
            echo "<p class='price'>".$item['price']."</p>";
            echo "<input data-id='".$item['id']."'  class='form-control' name='".$item['id']."amount' value='".$item['amount']."'>";
            echo '</div>';
            }
            $i++;
        }


        echo '<div class = "">';
        echo '<div class="form-signint cartst col-lg-12">';
        echo '<p class="total-cost" style="text-align: center">Загальна вартість: '.$totalCost.' грн.</p>';
        echo '<input type="address" value="м.Житомир вул. Вокзальна 34, кв.21" class="full-width">';
        echo '<br>';
        echo '<input type="submit" class="btn btn-default btn-block" value="Оформити замовлення">';
        echo '</div>';
        echo '</div>';

        ?>

    </form>
</div>
</div>
<script>
    $("form input").focusout(function () {
        var cost = 0;
        $("form input[data-id]").each(function () {
            var price = $('p.price',$(this).parent()).text();

            var amount = +$(this).val();
            cost += price*amount;
        });
        $("p.total-cost").text(cost+' грн.')
    });

    $("form").submit(function (ev) {
        console.log(1);
        ev.preventDefault();
        var arr = [];
        $("div input",this).each(function () {
            for(var i=0;i<$(this).val();i++)
                arr.push($(this).attr('data-id'));
        });
        setCookie('order',JSON.stringify(arr),1000);

        $.ajax({
            url: '/orders/order',
            data: {
            },
            type: 'post',
            success: function (res) {

                console.log(res);
                deleteCookie('order');
                document.location.href="/users/profile";
            }
        });
    });

    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value+";path=/";

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }

    function deleteCookie(name) {
        setCookie   (name, "", {
            expires: -1
        })
    }
</script>