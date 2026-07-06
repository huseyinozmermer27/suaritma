<?php
require 'includes/db.php';
$res = $db->query('DESCRIBE pages');
print_r($res->fetchAll());
?>