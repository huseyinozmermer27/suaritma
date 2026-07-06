<?php
require 'includes/db.php';
$stmt = $db->query("SELECT id, name, main_image FROM products WHERE category_id = 1 AND status = 1");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($products as $p) {
    echo "ID: {$p['id']} | Image: {$p['main_image']}\n";
}
?>