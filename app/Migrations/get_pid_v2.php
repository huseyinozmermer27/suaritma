<?php
require 'includes/db.php';
$stmt = $db->prepare('SELECT id FROM products WHERE slug LIKE ? LIMIT 1');
$stmt->execute(['%sumosu-home-natural%']);
$p = $stmt->fetch();
echo $p ? $p['id'] : '1';
