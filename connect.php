<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'imtihon';
$dsn = "mysql:host=$host; dbname=$dbname";
$pdo = new PDO($dsn, $user, $password);

// if ($pdo) {
//     echo "Ulandi";
// } else {
//     echo "Ulanmadi";
// }