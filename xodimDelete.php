<?php
include('./connect.php');

$id = $_GET['id'];

$pdoStatement = $pdo->prepare("
    DELETE FROM `xodimlar` WHERE id=$id    
");

if ($pdoStatement->execute()) {
    header('location: xodimlar.php');
}
?>