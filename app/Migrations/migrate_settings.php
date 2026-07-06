<?php
// Veritabanını dahil et
require_once __DIR__ . '/includes/db.php';

try {
    // Mevcut marquee içeriğini bir JSON yapısında tutalım (daha esnek)
    $marquee_items = [
        "Ücretsiz Kargo",
        "100 Gün İade Garantisi",
        "81 İlde Ücretsiz Kurulum"
    ];
    
    $settings = [
        'site_title' => 'Sumosu Su Arıtma Sistemleri',
        'footer_text' => '© 2026 Sumosu Su Arıtma. Tüm hakları saklıdır.',
        'marquee_items' => json_encode($marquee_items),
        'logo' => 'optimal-su-aritma-sistemleri.png'
    ];

    $stmt = $db->prepare("INSERT INTO settings (s_key, s_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE s_value = ?");
    foreach ($settings as $key => $value) {
        $stmt->execute([$key, $value, $value]);
    }

    echo "<h1>Site bilgileri veritabanına aktarıldı.</h1>";
    echo "<a href='/suaritma/admin/index.php?page=settings'>Ayarlar Paneline Git</a>";

} catch (PDOException $e) {
    die("Hata: " . $e->getMessage());
}
