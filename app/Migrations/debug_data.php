<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db;charset=utf8', 'root', '');
$stmt = $db->query("SELECT seo_text FROM seo");
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo 'TEXT: ' . $row['seo_text'] . "\n\n";
}
?>