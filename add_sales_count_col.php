<?php
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->exec('ALTER TABLE products ADD COLUMN sales_count INT DEFAULT 0');
    echo 'Column sales_count added successfully';
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
