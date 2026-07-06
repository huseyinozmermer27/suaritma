<?php
require_once 'admin/config/db.php';
$db = (new Database())->getConnection();
$res = $db->query('SHOW COLUMNS FROM products');
$cols = $res->fetchAll(PDO::FETCH_COLUMN);
print_r($cols);
?>