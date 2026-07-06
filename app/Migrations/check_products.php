<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db', 'root', '');
$products = $db->query("SELECT id, name, category_id FROM products")->fetchAll(PDO::FETCH_ASSOC);
print_r($products);
?>