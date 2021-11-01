<?php

if(isset($_POST['submit'])){
    foreach($_POST['quantity'] as $key => $val) {
        if($val==0) {
            unset($_SESSION['cart'][$key]);
        }else{
            $_SESSION['cart'][$key]['quantity']=$val;
        }
    }
}
?>

<h1>Просмотр корзины</h1>
<a href="index.php?page=products">Вернитесь на страницу товаров</a>
<form method="post" action="index.php?page=cart">

    <table>

        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Цена товаров</th>
        </tr>

        <?php

        $sql="SELECT * FROM products WHERE id IN (";

        foreach($_SESSION['cart'] as $id => $value) {
            $sql.=$id.",";
        }

        $sql=substr($sql, 0, -1).") ORDER BY name ASC";
        $query=mysqli_query($sql); // mysqli_query — выполняет запрос к базе данных
        $totalprice=0;
        // mysqli_fetch_array — Выбирает одну строку из результирующего набора
        // и помещает её в ассоциативный массив, обычный массив или в оба
        while($row=mysqli_fetch_array($query)){
            $subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price'];
            $totalprice+=$subtotal;
            ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><input type="text" name="quantity[<?php echo $row['id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id']]['quantity'] ?>" /></td>
                <td><?php echo $row['price'] ?>$</td>
                <td><?php echo $_SESSION['cart'][$row['id']]['quantity']*$row['price'] ?>$</td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="4">Total Price: <?php echo $totalprice ?></td>
        </tr>

    </table>
    <br />
    <button type="submit" name="submit">Обновить корзину</button>
</form>
<br />
<p>Чтобы удалить товар, установите его количество равным 0. </p>
