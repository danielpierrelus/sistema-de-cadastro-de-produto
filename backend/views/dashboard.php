<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include_once 'config/database.php';
include_once 'models/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$query = "SELECT COUNT(*) as total_products FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$total_products = $row['total_products'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Dashboard</h1>
        <div class="alert alert-info">
            <strong>Total de Produtos:</strong> <?php echo $total_products; ?>
        </div>
        <a href="products.php" class="btn btn-primary">Gerenciar Produtos</a>
    </div>
</body>
</html>
