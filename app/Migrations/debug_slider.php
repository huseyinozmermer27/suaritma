<?php
require_once 'includes/db.php';
$sliders = $db->query("SELECT * FROM slider")->fetchAll();
echo "<h1>Veritabanındaki Slider Verileri:</h1>";
echo "<pre>";
print_r($sliders);
echo "</pre>";
?>