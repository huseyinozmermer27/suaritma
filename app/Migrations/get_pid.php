<?php
require 'includes/db.php';
$stmt = $db->prepare('SELECT id FROM products WHERE title LIKE ? LIMIT 1');
$stmt->execute(['%Sumo Home Natural%']);
$p = $stmt->fetch();
echo $p ? $p['id'] : '1'; // Default to 1 if not found
