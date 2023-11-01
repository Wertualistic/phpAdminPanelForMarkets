<?php
include('./connect.php');

$id = $_GET['id'];

$pdoStatement = $pdo->prepare("
    DELETE FROM `menu1` WHERE id=$id    
");

$pdoStatementQarz = $pdo->prepare("
    DELETE FROM `xodimlar` WHERE menu_id=$id    
");

if ($pdoStatementQarz->execute()) {
    header('location: xodimlar.php');
}

if ($pdoStatement->execute()) {
    header('location: xodimlar.php');
}
?>