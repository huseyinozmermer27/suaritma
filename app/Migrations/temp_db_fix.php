<?php
$conn = new mysqli('localhost', 'root', '', 'suaritma_db');
$sql = "ALTER TABLE category_banners ADD COLUMN page_key VARCHAR(50) DEFAULT NULL";
if ($conn->query($sql) === TRUE) {
    echo "Column page_key added successfully";
} else {
    echo "Error adding column: " . $conn->error;
}
$conn->close();
?>
