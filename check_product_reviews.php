<?php
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $stmt = $db->query("SHOW TABLES LIKE 'product_reviews'");
    $table = $stmt->fetch();
    if ($table) {
        echo "Table exists\n";
        $stmt = $db->query("DESCRIBE product_reviews");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($columns as $col) {
            echo $col['Field'] . "\n";
        }
    } else {
        echo "Table does not exist\n";
    }
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
