<?php
// admin/pages/settings_footer_text.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['footer_title', 'footer_text', 'footer_copyright'];
    foreach ($fields as $field) {
        $value = clean($_POST[$field]);
        $stmt = $db->prepare("INSERT INTO settings (s_key, s_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE s_value = ?");
        $stmt->execute([$field, $value, $value]);
    }
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Footer ayarları başarıyla güncellendi.</div>';
}

$stmt = $db->query("SELECT s_key, s_value FROM settings WHERE s_key IN ('footer_title', 'footer_text', 'footer_copyright')");
$settings = [];
while ($row = $stmt->fetch()) {
    $settings[$row['s_key']] = $row['s_value'];
}
?>

<div class="p-6 max-w-4xl">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Footer İçerik Yönetimi</h2>
        <p class="text-gray-500">Footer'da görünen başlık, kurumsal metin ve telif hakkı bilgilerini buradan düzenleyin.</p>
    </div>

    <?php echo $message; ?>

    <form method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (Örn: Yardıma mı ihtiyacınız var?)</label>
            <input type="text" name="footer_title" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['footer_title'] ?? 'Yardıma mı ihtiyacınız var?'); ?>">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Metin İçeriği</label>
            <textarea name="footer_text" class="w-full h-40 p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Buraya açıklama metninizi girin..."><?php echo htmlspecialchars($settings['footer_text'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Telif Hakkı Metni</label>
            <input type="text" name="footer_copyright" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['footer_copyright'] ?? '© ' . date('Y') . ' Sumosu Su Arıtma Sistemleri. Tüm Hakları Saklıdır.'); ?>">
        </div>
        
        <div class="flex justify-end pt-4 border-t">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl transition shadow-lg text-lg font-semibold">
                Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('site-management').classList.remove('hidden');
    document.getElementById('footer-settings').classList.remove('hidden');
</script>