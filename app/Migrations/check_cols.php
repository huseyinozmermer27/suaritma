<?php
$db = new PDO('mysql:host=localhost;dbname=suaritma_db', 'root', '');
$columns = $db->query("DESCRIBE videos")->fetchAll(PDO::FETCH_ASSOC);
foreach ($columns as $col) {
    echo $col['Field'] . "\n";
}
?>