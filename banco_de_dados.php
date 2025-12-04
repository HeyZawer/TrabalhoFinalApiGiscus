<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost'); // Geralmente 'localhost'
define('DB_NAME', 'banco_de_dados'); 
define('DB_USER', 'root'); 
define('DB_PASS', '');

// Opções do PDO para otimizar a conexão e reportar erros
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
    PDO::ATTR_EMULATE_PREPARES   => false,                  
];

try {
    // Cria uma nova instância do PDO para conectar ao banco
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}