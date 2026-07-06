<?php
require_once 'includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS ariza_bildirimleri (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ad_soyad VARCHAR(255) NOT NULL,
        siparis_no VARCHAR(100) NOT NULL,
        ariza_turu VARCHAR(100) NOT NULL,
        notlar TEXT,
        ariza_durumu VARCHAR(50) DEFAULT 'Beklemede',
        admin_notu TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $db->exec($sql);
    echo "Tablo başarıyla oluşturuldu.";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>