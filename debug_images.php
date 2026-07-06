<?php
require_once 'app/Core/includes/db.php';
try {
    $stmt = $db->query("SELECT id, name, main_image FROM products LIMIT 5");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($products);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
