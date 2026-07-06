<?php
require_once __DIR__ . '/includes/db.php';

// sumo.php içeriğine en yakın gerçek içerikleri tanımlıyoruz
$sliders = [
    [
        'title' => 'Sumosu Home Natural',
        'subtitle' => 'YENİ NESİL SU ARITMA',
        'image' => 'en_iyi_su_aritma_cihazi_01.jpg',
        'link' => '/suaritma/collections/su-aritma-cihazlari.php',
        'sort_order' => 1,
        'status' => 1
    ],
    [
        'title' => 'Sağlıklı Bir Yaşam İçin',
        'subtitle' => 'DOĞAL VE SAF SU',
        'image' => 'saglikli-bir-suyun-ozellikleri-nelerdir.jpg',
        'link' => '/suaritma/collections/su-aritma-cihazlari.php',
        'sort_order' => 2,
        'status' => 1
    ]
];

try {
    $db->exec("TRUNCATE TABLE slider");
    $stmt = $db->prepare("INSERT INTO slider (title, subtitle, image, link, sort_order, status) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($sliders as $s) {
        $stmt->execute([$s['title'], $s['subtitle'], $s['image'], $s['link'], $s['sort_order'], $s['status']]);
    }
    echo "<h1>Slider verileri, orijinal tasarıma uygun şekilde güncellendi!</h1>";
    echo "<p><a href='/suaritma/admin/index.php?page=sliders'>Admin Paneline Dön</a> | <a href='/suaritma/index.php'>Ana Sayfaya Git</a></p>";
} catch (PDOException $e) {
    die("Hata: " . $e->getMessage());
}
?>