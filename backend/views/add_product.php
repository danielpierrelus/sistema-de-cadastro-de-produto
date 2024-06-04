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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product($db);
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->image = $_FILES['image']['name'];
    $product->price = $_POST['price'];

    if ($product->create()) {
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $_FILES['image']['name']);
        header('Location: products.php');
    } else {
        $error = "Erro ao adicionar produto";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Novo Produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Novo Produto</h1>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Preço:</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    </div>
</body>
</html>

