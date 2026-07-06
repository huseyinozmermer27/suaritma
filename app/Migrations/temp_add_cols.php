<?php
require 'includes/db.php';
try {
    $db->exec("ALTER TABLE products ADD COLUMN image2 VARCHAR(255), ADD COLUMN image3 VARCHAR(255), ADD COLUMN image4 VARCHAR(255)");
    echo "Success";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>