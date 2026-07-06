<?php
// Yapılandırma ve Yardımcı Fonksiyonları Dahil Et
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

// Veritabanı Bilgileri (XAMPP Varsayılan)
$host = 'localhost';
$dbname = 'suaritma_db';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Veritabanı Bağlantı Hatası: " . $e->getMessage());
}
?>
