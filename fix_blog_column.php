<?php
require_once 'app/Core/includes/db.php';
try {
    $db->exec("ALTER TABLE blog ADD COLUMN content TEXT AFTER description");
    echo "Column 'content' added successfully to 'blog' table.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
