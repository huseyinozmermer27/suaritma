<?php
require_once 'admin/config/db.php';
$db = (new Database())->getConnection();

// Video ve Yorum tabloları
$db->exec("CREATE TABLE IF NOT EXISTS videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    youtube_url VARCHAR(255),
    type ENUM('product', 'customer') DEFAULT 'product',
    sort_order INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1
)");

$db->exec("CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100),
    content TEXT,
    rating INT DEFAULT 5,
    sort_order INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1
)");

echo "Database schema updated for videos and reviews.";
?>