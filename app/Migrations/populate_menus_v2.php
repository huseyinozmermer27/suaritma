<?php
require_once __DIR__ . '/admin/config/db.php';
$db = (new Database())->getConnection();

// Menüleri temizle ve yeniden oluştur (isteğe bağlı, şimdilik temizleyip ekliyoruz)
$db->exec("TRUNCATE TABLE menus");

$menus = [
    ['name' => 'Ürünler', 'link' => '/suaritma/collections/su-aritma-cihazlari.php', 'sort_order' => 1, 'location' => 'header'],
    ['name' => 'Karşılaştır', 'link' => '#', 'sort_order' => 2, 'location' => 'header'],
    ['name' => 'Belgelerimiz', 'link' => '/suaritma/pages/belgelerimiz.php', 'sort_order' => 3, 'location' => 'header'],
    ['name' => 'Müşteri Yorumları', 'link' => '/suaritma/pages/su-aritma-cihazi-yorumlari.php', 'sort_order' => 4, 'location' => 'header'],
    ['name' => 'Blog', 'link' => '/suaritma/blogs/sumosu-blog.php', 'sort_order' => 5, 'location' => 'header'],
    ['name' => 'Destek', 'link' => '/suaritma/pages/sik-sorulan-sorular.php', 'sort_order' => 6, 'location' => 'header'],
];

$stmt = $db->prepare("INSERT INTO menus (name, link, sort_order, location, status) VALUES (?, ?, ?, ?, 1)");

foreach ($menus as $menu) {
    $stmt->execute([$menu['name'], $menu['link'], $menu['sort_order'], $menu['location']]);
}

echo "Header menüleri başarıyla eklendi.";
?>