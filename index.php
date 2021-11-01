<?php
session_start();
require("includes/connection.php");
if(isset($_GET['page'])){
    $pages=array("products", "cart");
    if(in_array($_GET['page'], $pages)) {
        $_page=$_GET['page'];
    }else{
        $_page="products";
    }
}else{
    $_page="products";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css" /> 
	 
	<title>Shopping cart</title>
</head>
<body>
	<div id="container">
		<div id="main">
            <?php require($_page.".php"); ?>
		</div>
		<div id="sidebar">
            <h1>Корзина</h1>
            <?php

            if(isset($_SESSION['cart'])){
                $sql="SELECT * FROM products WHERE id IN (";
                foreach($_SESSION['cart'] as $id => $value) {
                    $sql.=$id.",";
                }
                $sql=substr($sql, 0, -1).") ORDER BY name ASC";
                $query=mysqli_query($sql);
                while($row=mysqli_fetch_array($query)){
                    ?>
                    <p><?php echo $row['name'] ?> x <?php echo $_SESSION['cart'][$row['id']]['quantity'] ?></p>
                    <?php
                }
                ?>
                <hr />
                <a href="index.php?page=cart">Перейти в корзину</a>
                <?php
            }else{
                echo "<p>Ваша корзина пуста. Пожалуйста, добавьте товары.</p>";
            }
            ?>
		</div>
	</div>
 
</body> 
</html>
