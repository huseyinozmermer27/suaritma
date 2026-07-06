<?php
require_once 'app/Core/includes/db.php';
try {
    $stmt = $db->query("SELECT * FROM products WHERE id = 1");
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($product);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
