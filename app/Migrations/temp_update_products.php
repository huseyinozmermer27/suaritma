<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db', 'root', '');
$db->exec("ALTER TABLE products ADD COLUMN discounted_price DECIMAL(10,2) DEFAULT 0, ADD COLUMN discount_percent INT DEFAULT 0, ADD COLUMN featured TINYINT(1) DEFAULT 0");
echo "Columns added successfully.";
?>