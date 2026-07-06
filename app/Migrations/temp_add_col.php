<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db', 'root', '');
$db->exec("ALTER TABLE videos ADD COLUMN description TEXT AFTER title");
echo "Column added successfully.";
?>