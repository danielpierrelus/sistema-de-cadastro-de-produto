<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: views/login.php');
    exit;
}

// Conexão com o banco de dados
require_once 'config/database.php';

// Restante do código (ex: carregar dashboard, etc.)

echo "Bem-vindo à página de administração!";
?>
