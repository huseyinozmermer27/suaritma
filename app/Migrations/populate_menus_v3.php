<?php
require_once __DIR__ . '/admin/config/db.php';
$db = (new Database())->getConnection();

$db->exec("TRUNCATE TABLE menus");

$stmt = $db->prepare("INSERT INTO menus (id, name, link, parent_id, sort_order, location, status) VALUES (?, ?, ?, ?, ?, ?, 1)");

// Ana Menüler
$stmt->execute([1, 'Ürünler', '#', 0, 1, 'header']);
$stmt->execute([2, 'Karşılaştır', '#', 0, 2, 'header']);
$stmt->execute([3, 'Belgelerimiz', '/suaritma/pages/belgelerimiz.php', 0, 3, 'header']);
$stmt->execute([4, 'Müşteri Yorumları', '/suaritma/pages/su-aritma-cihazi-yorumlari.php', 0, 4, 'header']);
$stmt->execute([5, 'Blog', '/suaritma/blogs/sumosu-blog.php', 0, 5, 'header']);
$stmt->execute([6, 'Destek', '#', 0, 6, 'header']);

// Ürünler Alt Menüleri (parent_id: 1)
$stmt->execute([7, 'Cihazlar', '/suaritma/collections/su-aritma-cihazlari.php', 1, 1, 'header']);
$stmt->execute([8, 'Filtreler', '/suaritma/collections/su-aritma-filtreleri.php', 1, 2, 'header']);
$stmt->execute([9, 'Aksesuarlar', '/suaritma/collections/su-aritma-yedek-parcalari-aksesuarlari.php', 1, 3, 'header']);

// Destek Alt Menüleri (parent_id: 6)
$stmt->execute([10, 'Gönderi Takibi', '/suaritma/pages/tracking-page.php', 6, 1, 'header']);
$stmt->execute([11, 'Sık Sorulan Sorular', '/suaritma/pages/sik-sorulan-sorular.php', 6, 2, 'header']);
$stmt->execute([12, 'İade ve Değişim', '/suaritma/pages/su-aritma-cihazi-iade-ve-degisim.php', 6, 3, 'header']);
$stmt->execute([13, 'Montaj Talebi', '/suaritma/pages/montaj-talebi.php', 6, 4, 'header']);
$stmt->execute([14, 'İletişim', '/suaritma/iletisim.php', 6, 5, 'header']);

echo "Tüm header menü hiyerarşisi başarıyla eklendi.";
?>