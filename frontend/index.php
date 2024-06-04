<?php
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
</head>
<body>
    <div class="container">
        <h1>Produtos</h1>
        <div class="row">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text">R$ <?php echo $row['price']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
