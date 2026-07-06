<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db', 'root', '');
$categories = $db->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
print_r($categories);
?>