<?php
require_once __DIR__ . '/admin/config/db.php';
$db = (new Database())->getConnection();

// Kategori ID'lerini bul (varsayımsal, gerçek ID'ler veritabanına göre değişebilir)
$catCihazlar = 1;
$catFiltreler = 2;
$catAksesuarlar = 3;

$products = [
    // Cihazlar (su-aritma-cihazlari.php)
    ['name' => 'Sumosu Home Natural Pompasız', 'price' => 12350, 'stock_count' => 50, 'main_image' => 'https://sumosuaritma.com/cdn/shop/files/home_natural_musluklu_beyaz.webp', 'category_id' => $catCihazlar],
    ['name' => 'Sumosu Home Natural Pompalı', 'price' => 15550, 'stock_count' => 30, 'main_image' => 'https://sumosuaritma.com/cdn/shop/files/home_natural_pompali_musluklu_beyaz.webp', 'category_id' => $catCihazlar],
    ['name' => 'Sumosu Home Alkali Pompasız', 'price' => 12350, 'stock_count' => 40, 'main_image' => 'https://sumosuaritma.com/cdn/shop/files/home_alkali_musluklu_beyaz.webp', 'category_id' => $catCihazlar],
    ['name' => 'Sumosu Home Alkali Pompalı', 'price' => 15550, 'stock_count' => 20, 'main_image' => 'https://sumosuaritma.com/cdn/shop/files/home_alkali_pompali_musluklu_beyaz.webp', 'category_id' => $catCihazlar],
    
    // Aksesuarlar (su-aritma-yedek-parcalari-aksesuarlari.php - varsayılan olarak Aksesuarlar)
    ['name' => 'Ekstra Ürün 1', 'price' => 10000, 'stock_count' => 100, 'main_image' => 'https://sumosuaritma.com/cdn/shop/files/home_natural_musluklu_beyaz.webp', 'category_id' => $catAksesuarlar]
];

$db->exec("SET FOREIGN_KEY_CHECKS = 0; TRUNCATE TABLE products; SET FOREIGN_KEY_CHECKS = 1;");

$stmt = $db->prepare("INSERT INTO products (name, slug, price, stock_count, main_image, category_id, status) VALUES (?, ?, ?, ?, ?, ?, 1)");

foreach ($products as $p) {
    $slug = createSlug($p['name']);
    $stmt->execute([$p['name'], $slug, $p['price'], $p['stock_count'], $p['main_image'], $p['category_id']]);
}

function createSlug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    return strtolower(trim($text, '-'));
}

echo "Ürünler başarıyla eklendi.";
?>