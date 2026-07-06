<?php
require 'includes/db.php';
$res = $db->query('SHOW TABLES');
foreach($res->fetchAll(PDO::FETCH_COLUMN) as $table) {
    echo $table . PHP_EOL;
}
