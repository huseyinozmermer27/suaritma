<?php
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    echo "Checking product_reviews data:\n";
    $stmt = $db->query("SELECT * FROM product_reviews LIMIT 5");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
