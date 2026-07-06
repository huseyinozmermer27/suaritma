<?php
require 'includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS customer_reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        customer_name VARCHAR(100) NOT NULL,
        rating INT NOT NULL,
        comment TEXT NOT NULL,
        video_path VARCHAR(255) NULL,
        status TINYINT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $db->exec($sql);
    echo "customer_reviews tablosu hazır.\n";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage() . "\n";
}
