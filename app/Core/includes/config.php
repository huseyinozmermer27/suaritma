<?php
// Site Genel Ayarları
if (!defined('BASE_URL')) define('BASE_URL', 'http://localhost/suaritma/public/'); // Sitenin yüklü olduğu URL
if (!defined('SITE_TITLE')) define('SITE_TITLE', 'Optimal Su Arıtma Sistemleri');

// Klasör Yolları
if (!defined('ROOT_PATH')) define('ROOT_PATH', dirname(__DIR__));
if (!defined('UPLOADS_PATH')) define('UPLOADS_PATH', BASE_URL . 'assets/img/');

// Hata Raporlama (Geliştirme aşamasında açık, canlıda kapatılmalı)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
