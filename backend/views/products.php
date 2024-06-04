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
$query = "SELECT * FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Gerenciar Produtos</h1>
        <a href="add_product.php" class="btn btn-success mb-4">Novo Produto</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><img src="<?php echo '../images/' . $row['image']; ?>" class="table-img" alt="<?php echo $row['name']; ?>"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>R$ <?php echo number_format($row['price'], 2, ',', '.'); ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
