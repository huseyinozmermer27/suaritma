<?php
require 'includes/db.php';
$res = $db->query('DESCRIBE reviews');
print_r($res->fetchAll());
