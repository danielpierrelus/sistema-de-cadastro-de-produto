# sistema-de-cadastro-de-produto
# sistema-de-cadastro-de-produto
# Sistema de Cadastro de Produtos

## Descrição
Este é um sistema simples de cadastro de produtos com uma tela de Login para a parte administrativa e uma tela para exibir os produtos cadastrados.

## Requisitos
- PHP
- MySQL
- Apache
- Bootstrap (opcional)
- Biblioteca JS de apoio (opcional)

## Como Configurar o Ambiente
1. Instale Apache, MySQL e PHP:
    ```bash
    sudo apt update
    sudo apt install apache2
    sudo apt install mysql-server
    sudo apt install php libapache2-mod-php php-mysql
    ```
2. Clone o repositório do GitHub:
    ```bash
    cd /var/www/html
    sudo git clone https://github.com/seu-usuario/sistema-de-cadastro-de-produto.git
    sudo chown -R www-data:www-data /var/www/html/sistema-de-cadastro-de-produto
    sudo chmod -R 755 /var/www/html/sistema-de-cadastro-de-produto
    ```
3. Configure o banco de dados:
    ```sql
    CREATE DATABASE productdb;

    USE productdb;

    CREATE TABLE products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL
    );

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL
    );
    ```
4. Configure a conexão com o banco de dados em `backend/config/database.php`.
5. Reinicie o Apache:
    ```bash
    sudo service apache2 restart
    ```

## Como Rodar o Projeto
1. Abra o navegador e vá para `http://localhost/sistema-de-cadastro-de-produto/backend/views/login.php` para acessar a parte administrativa.
2. Vá para `http://localhost/sistema-de-cadastro-de-produto/frontend/index.php` para ver a listagem dos produtos no front-end.

## Funcionalidades
- Tela de Login
- Dashboard com a quantidade de produtos cadastrados
- Listagem de produtos com botões de ação (editar e excluir)
- Cadastro de novo produto com nome, descrição, imagem e valor
