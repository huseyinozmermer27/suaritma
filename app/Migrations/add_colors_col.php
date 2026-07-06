<?php
require 'includes/db.php';
try {
    $db->exec("ALTER TABLE products ADD COLUMN colors VARCHAR(255)");
    echo "Success";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>