<?php
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';
$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$db->exec("CREATE TABLE IF NOT EXISTS seo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    button_text VARCHAR(100),
    target_url VARCHAR(255),
    image_path VARCHAR(255),
    page_key VARCHAR(50),
    seo_text TEXT,
    page_slug VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
echo "Table 'seo' restored.";
?>