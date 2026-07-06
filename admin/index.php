<?php
// admin/index.php

require_once 'config/db.php';
require_once 'core/auth.php';
require_once 'core/functions.php';

// Veritabanı bağlantısı
$database = new Database();
$db = $database->getConnection();

// Oturum kontrolü
$auth = new Auth($db);
$auth->requireLogin();

// Sayfa belirleme
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Sayfa belirleme
$allowed_pages = [
    'dashboard', 'products', 'product_add', 'product_edit', 
    'categories', 'category_add', 'category_edit',
    'sliders', 'slider_add', 'slider_edit',
    'menus', 'menu_add', 'menu_edit',
    'blog', 'blog_add', 'blog_edit',
    'product_videos', 'customer_videos', 'customer_reviews', 'video_add', 'video_edit',
    'settings', 'settings_contact', 'settings_features', 'settings_footer_text',
    'settings_marquee', 'settings_logo', 'settings_social',
    'orders', 'comments', 'pages', 'contact_messages', 'iade_talepleri', 'iade_edit', 'ariza_bildirimleri', 'ariza_edit', 'montaj_talepleri', 'montaj_edit'
];
if (!in_array($page, $allowed_pages)) {
    $page = 'dashboard';
}

$page_file = "pages/{$page}.php";

if (!file_exists($page_file)) {
    die("Sayfa bulunamadı: {$page}");
}

// Header dahil et
include 'includes/header.php';

// İçerik sayfasını dahil et
include $page_file;

// Footer dahil et
include 'includes/footer.php';
?>