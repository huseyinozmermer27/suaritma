<?php
require_once 'app/Core/includes/db.php';
try {
    $stmt = $db->query("DESCRIBE blog");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($columns);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
