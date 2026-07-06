<?php
require_once 'admin/config/db.php';
$db = (new Database())->getConnection();
$res = $db->query('SHOW COLUMNS FROM menus');
$cols = $res->fetchAll(PDO::FETCH_COLUMN);
print_r($cols);
?>