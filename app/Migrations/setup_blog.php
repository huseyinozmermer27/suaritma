<?php
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';
$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$db->exec("DROP TABLE IF EXISTS blog");
$db->exec("CREATE TABLE blog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    slug VARCHAR(255) NOT NULL,
    is_featured TINYINT(1) DEFAULT 0,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
echo "Blog table successfully created.";
?>