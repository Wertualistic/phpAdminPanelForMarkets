<?php
include('./connect.php');

$id = $_GET['id'];

$pdoStatement = $pdo->prepare("
    DELETE FROM `menu` WHERE id=$id    
");

$pdoStatementQarz = $pdo->prepare("
    DELETE FROM `qarzlar` WHERE menu_id=$id    
");

if ($pdoStatementQarz->execute()) {
    header('location: qarzlar.php');
}
if ($pdoStatement->execute()) {
    header('location: qarzlar.php');
}
?>