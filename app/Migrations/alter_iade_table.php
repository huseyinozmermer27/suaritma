<?php
require_once __DIR__ . '/../Core/includes/db.php';

try {
    $sql = "ALTER TABLE iade_talepleri 
            ADD COLUMN iade_durumu VARCHAR(50) DEFAULT 'Beklemede',
            ADD COLUMN admin_notu TEXT;";
    $db->exec($sql);
    echo "Sütunlar başarıyla eklendi.";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>