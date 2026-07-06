<?php
require_once __DIR__ . '/includes/db.php';
try {
    $db->exec("CREATE TABLE IF NOT EXISTS slider (
        id INT AUTO_INCREMENT PRIMARY KEY, 
        title VARCHAR(255), 
        subtitle VARCHAR(255), 
        image VARCHAR(255), 
        link VARCHAR(255), 
        sort_order INT DEFAULT 0, 
        status TINYINT(1) DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    echo "Slider tablosu oluşturuldu.";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>