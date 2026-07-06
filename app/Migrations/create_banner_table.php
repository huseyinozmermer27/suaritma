<?php
require 'includes/db.php';
$db->exec("CREATE TABLE IF NOT EXISTS category_banners (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(255), 
    description TEXT, 
    button_text VARCHAR(100), 
    target_url VARCHAR(255), 
    image_path VARCHAR(255), 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
echo "Table created successfully.";
?>