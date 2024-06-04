<?php
include_once '../config/database.php';
include_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$product->name = $_POST['name'];
$product->description = $_POST['description'];
$product->image = $_POST['image'];
$product->price = $_POST['price'];

if($product->create()) {
    echo "Product was created.";
} else {
    echo "Unable to create product.";
}
?>
