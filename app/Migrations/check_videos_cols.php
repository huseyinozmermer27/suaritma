<?php
require 'includes/db.php';
$res = $db->query('DESCRIBE videos');
print_r($res->fetchAll());
