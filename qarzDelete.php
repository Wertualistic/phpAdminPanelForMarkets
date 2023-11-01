<?php
include('./connect.php');

$id = $_GET['id'];

$pdoStatement = $pdo->prepare("
    DELETE FROM `qarzlar` WHERE id=$id    
");

if ($pdoStatement->execute()) {
    header('location: qarzlar.php');
}
?>