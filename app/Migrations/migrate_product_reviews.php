<?php
require 'includes/db.php';
try {
    $sql = "CREATE TABLE IF NOT EXISTS product_reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        customer_name VARCHAR(100) NOT NULL,
        rating INT DEFAULT 5,
        comment TEXT NOT NULL,
        image_urls TEXT NULL,
        status TINYINT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $db->exec($sql);
    echo "product_reviews tablosu hazır.";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
