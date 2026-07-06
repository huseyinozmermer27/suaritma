<?php
require_once 'admin/config/db.php';
$db = (new Database())->getConnection();
$db->exec("ALTER TABLE menus ADD COLUMN location ENUM('header', 'footer') DEFAULT 'header'");
echo "Column added successfully";
?>