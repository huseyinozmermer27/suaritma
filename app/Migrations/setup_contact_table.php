<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db;charset=utf8', 'root', '');
$db->exec("CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
echo "Table contact_messages created successfully.";
?>