<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../backend/config/database.php';
include_once '../backend/models/Product.php';

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
    <title>Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table-img {
            height: 100px;
            width: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Produtos</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><img src="<?php echo '../images/' . $row['image']; ?>" class="table-img" alt="<?php echo $row['name']; ?>"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>R$ <?php echo number_format($row['price'], 2, ',', '.'); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
