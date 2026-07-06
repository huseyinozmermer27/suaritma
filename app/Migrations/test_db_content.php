<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db;charset=utf8', 'root', '');
$stmt = $db->query('SELECT content FROM blog LIMIT 1');
$row = $stmt->fetch();
echo $row['content'];
?>