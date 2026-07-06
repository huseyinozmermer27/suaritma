<?php
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $stmt = $db->query("SELECT * FROM customer_reviews");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
