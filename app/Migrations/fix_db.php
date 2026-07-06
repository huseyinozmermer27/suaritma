<?php
// Otomatik veritabanı kurucu - EKSİK TABLOLARI TAMAMLAYICI
require_once __DIR__ . '/includes/db.php';

try {
    $db->exec("
    CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        total_amount DECIMAL(10, 2) NOT NULL,
        status ENUM('pending', 'processing', 'shipped', 'completed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    echo "<h1>Eksik tablolar başarıyla oluşturuldu.</h1>";
    echo "<p><a href='/suaritma/admin/index.php'>Dashboard'a Git</a></p>";

} catch (PDOException $e) {
    die("Hata: " . $e->getMessage());
}
