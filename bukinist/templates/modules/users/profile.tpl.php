
<div class="container">

    <h2>Раді знову бачити тебе, <?=$_SESSION['login']?></h2>

    <ul class="historycash">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Автор</th>
                <th scope="col">Назва</th>
                <th scope="col">Ціна</th>
                <th scope="col">Кількість</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($orders as $item) {
                echo '<tr><td colspan="5" style="text-align: center;">Номер замовлення - '.$item['orderid'].'</td></tr>';
                $i=0;

                foreach ($item['ordered'] as $key=>$t) {
                    $t = (array)$t;

                    echo '<tr>';
                    echo '<th scope="row">' . $i . '</th>
                  
                    <td>'.$t['author'].'</td>
                    <td>'.$t['name'].'</td>
                    <td>'.$t['price'].'</td>
                    <td>' .$t['amount']. '</td>';
                    echo '</tr>';
                    $i++;
                    if($key==count($item['ordered'])-2)
                        break;
                }
            }
            ?>

            </tbody>
        </table>

</div>