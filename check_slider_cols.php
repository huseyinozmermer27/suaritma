<?php
require_once 'C:\xampp\htdocs\suaritma\app\Core\includes\db.php';
$res = $db->query('DESCRIBE slider');
foreach($res as $row) {
    echo $row['Field'] . PHP_EOL;
}
?>
