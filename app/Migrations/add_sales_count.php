<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db', 'root', '');
try {
    $db->exec("ALTER TABLE products ADD COLUMN sales_count INT DEFAULT 0");
    echo "Column added successfully.";
} catch (Exception $e) {
    echo "Column already exists or error: " . $e->getMessage();
}
?>