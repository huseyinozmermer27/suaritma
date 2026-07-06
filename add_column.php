<?php
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->exec('ALTER TABLE customer_reviews ADD COLUMN product_id INT NOT NULL AFTER id');
    echo 'Column added successfully';
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
