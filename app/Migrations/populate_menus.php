<?php
require_once __DIR__ . '/includes/db.php';

$menus = [
    ['name' => 'Ürünler', 'link' => '#', 'parent_id' => 0, 'sort_order' => 1],
    ['name' => 'Cihazlar', 'link' => '/suaritma/collections/su-aritma-cihazlari.php', 'parent_id' => 1, 'sort_order' => 1],
    ['name' => 'Filtreler', 'link' => '/suaritma/collections/su-aritma-filtreleri.php', 'parent_id' => 1, 'sort_order' => 2],
    ['name' => 'Aksesuarlar', 'link' => '/suaritma/collections/su-aritma-yedek-parcalari-aksesuarlari.php', 'parent_id' => 1, 'sort_order' => 3],
    ['name' => 'Karşılaştır', 'link' => '/suaritma/pages/pompali-mi-pompasiz-mi.php', 'parent_id' => 0, 'sort_order' => 2],
    ['name' => 'Belgelerimiz', 'link' => '/suaritma/pages/su-aritma-cihazi-iade-ve-degisim.php', 'parent_id' => 0, 'sort_order' => 3],
    ['name' => 'Müşteri Yorumları', 'link' => '/suaritma/pages/su-aritma-cihazi-yorumlari.php', 'parent_id' => 0, 'sort_order' => 4],
    ['name' => 'Blog', 'link' => '/suaritma/blogs/sumosu-blog.php', 'parent_id' => 0, 'sort_order' => 5],
    ['name' => 'Destek', 'link' => '#', 'parent_id' => 0, 'sort_order' => 6],
    ['name' => 'Gönderi Takibi', 'link' => '/suaritma/pages/tracking-page.php', 'parent_id' => 9, 'sort_order' => 1],
    ['name' => 'SSS', 'link' => '/suaritma/pages/sik-sorulan-sorular.php', 'parent_id' => 9, 'sort_order' => 2],
    ['name' => 'İade ve Değişim', 'link' => '/suaritma/pages/su-aritma-cihazi-iade-ve-degisim.php', 'parent_id' => 9, 'sort_order' => 3],
    ['name' => 'Montaj Talebi', 'link' => '/suaritma/pages/montaj-talebi.php', 'parent_id' => 9, 'sort_order' => 4],
    ['name' => 'İletişim', 'link' => '/suaritma/iletisim.php', 'parent_id' => 9, 'sort_order' => 5]
];

try {
    $db->exec("TRUNCATE TABLE menus");
    $stmt = $db->prepare("INSERT INTO menus (name, link, parent_id, sort_order, status) VALUES (?, ?, ?, ?, 1)");
    foreach ($menus as $m) {
        $stmt->execute([$m['name'], $m['link'], $m['parent_id'], $m['sort_order']]);
    }
    echo "<h1>Menüler başarıyla eklendi.</h1>";
    echo "<a href='/suaritma/admin/index.php?page=menus'>Menü Yönetimine Dön</a>";
} catch (PDOException $e) {
    die("Hata: " . $e->getMessage());
}
