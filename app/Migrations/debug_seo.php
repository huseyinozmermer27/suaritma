<?php
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';
$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$stmt = $db->query("SELECT * FROM seo");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>