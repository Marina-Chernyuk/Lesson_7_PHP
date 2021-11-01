<?php
$mysqli = @new mysqli('localhost', 'root', '123258', 'shop');
if (mysqli_connect_errno()) {
    echo "Подключение невозможно: ".mysqli_connect_error();
}
?>

