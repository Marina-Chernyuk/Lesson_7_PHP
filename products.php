<?php

if(isset($_GET['action']) && $_GET['action']=="add"){
    $id=intval($_GET['id']);
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity']++;
    }else{
        $sql_s="SELECT * FROM products 
				WHERE id={$id}";
        $query_s=mysqli_query($sql_s);
        if(mysqli_num_rows($query_s)!=0){
            $row_s=mysqli_fetch_array($query_s);

            $_SESSION['cart'][$row_s['id']]=array(
                "quantity" => 1,
                "price" => $row_s['price']
            );
        }else{
            $message="Этот id продукта недействителен!";
        }
    }
}
?>
<h1>Список товаров</h1>
<?php
if(isset($message)){
    echo "<h2>$message</h2>";
}
?>
<table>
    <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Действие</th>
    </tr>

    <?php

    $sql="SELECT * FROM products ORDER BY name ASC";
    $query=mysqli_query($sql);

    while ($row=mysqli_fetch_array($query)) {

        ?>
        <tr>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><?php echo $row['price'] ?>$</td>
            <td><a href="index.php?page=products&action=add&id=<?php echo $row['id'] ?>">Добавить в корзину</a></td>
        </tr>
        <?php
    }
    ?>
</table>
