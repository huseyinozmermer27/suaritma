<?php
require_once 'C:\xampp\htdocs\suaritma\app\Core\includes\db.php';
try {
    $db->exec("ALTER TABLE slider ADD COLUMN link VARCHAR(255) AFTER image");
    echo "Column 'link' added successfully.";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
