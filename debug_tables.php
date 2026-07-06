<?php
require_once __DIR__ . '/../../app/Core/includes/db.php';

try {
    $stmt = $db->query("DESCRIBE customer_reviews");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($columns);
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
