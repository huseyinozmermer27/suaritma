<?php
require 'includes/db.php';
try {
    $db->exec("ALTER TABLE product_variants ADD COLUMN image2 VARCHAR(255), ADD COLUMN image3 VARCHAR(255), ADD COLUMN image4 VARCHAR(255)");
    echo "Schema updated successfully.";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>