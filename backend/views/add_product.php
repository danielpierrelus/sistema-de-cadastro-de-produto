<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Especificando o caminho absoluto diretamente
        $upload_dir = '/var/www/html/sistema-de-cadastro-de-produto/backend/views/uploads/';
        echo "Upload directory: $upload_dir<br>";
        $image_path = $upload_dir . basename($_FILES['image']['name']);
        echo "Full image path: $image_path<br>";
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

        // Verificar se o arquivo é uma imagem real ou falsa
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            // Verificar se o arquivo já existe
            if (!file_exists($image_path)) {
                // Verificar o tamanho do arquivo
                if ($_FILES['image']['size'] <= 500000) {
                    // Permitir certos formatos de arquivo
                    if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                        // Debugging the file path
                        echo "Trying to move uploaded file to: $image_path<br>";
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                            $image = 'uploads/' . basename($_FILES['image']['name']); // Save relative path
                            echo "Imagem carregada com sucesso: $image_path <br>";
                        } else {
                            echo "Erro ao fazer upload da imagem. Verifique as permissões da pasta de destino.<br>";
                        }
                    } else {
                        echo "Desculpe, apenas arquivos JPG, JPEG, PNG & GIF são permitidos. <br>";
                    }
                } else {
                    echo "Desculpe, o arquivo é muito grande. <br>";
                }
            } else {
                echo "Desculpe, o arquivo já existe. <br>";
            }
        } else {
            echo "O arquivo não é uma imagem. <br>";
        }
    } else {
        echo "Erro no upload do arquivo: " . $_FILES['image']['error'] . "<br>";
    }

    // Debugging outputs
    var_dump($name, $description, $price, $image);

    if ($image) {
        try {
            $stmt = $conn->prepare("INSERT INTO products (name, description, image, price) VALUES (:name, :description, :image, :price)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':price', $price);
            $stmt->execute();

            header("Location: products.php");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Imagem não foi carregada. <br>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f8f9fa;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Adicionar Produto</h2>
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nome do Produto</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Preço</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">Imagem do Produto</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
