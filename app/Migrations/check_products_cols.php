<?php
require 'includes/db.php';
$res = $db->query('DESCRIBE products');
print_r($res->fetchAll());
