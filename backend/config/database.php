<?php
$host = 'localhost';
$db = 'productdb';
$user = 'root';
$pass = 'Daniel90';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    exit;
}
?>
