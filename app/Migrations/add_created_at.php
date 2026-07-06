<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db', 'root', '');
$db->exec("ALTER TABLE videos ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
echo "Column added successfully.";
?>