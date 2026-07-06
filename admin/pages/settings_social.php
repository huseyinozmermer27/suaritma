<?php
// admin/pages/settings_social.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$message = '';
$social_keys = ['social_facebook', 'social_twitter', 'social_instagram', 'social_youtube'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($social_keys as $key) {
        $value = clean($_POST[$key]);
        $stmt = $db->prepare("INSERT INTO settings (s_key, s_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE s_value = ?");
        $stmt->execute([$key, $value, $value]);
    }
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Sosyal medya ayarları başarıyla güncellendi.</div>';
}

$stmt = $db->query("SELECT s_key, s_value FROM settings WHERE s_key IN ('" . implode("', '", $social_keys) . "')");
$settings = [];
while ($row = $stmt->fetch()) {
    $settings[$row['s_key']] = $row['s_value'];
}
?>

<div class="p-6 max-w-4xl">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Sosyal Medya Ayarları</h2>
        <p class="text-gray-500">Footer bölümünde görünen sosyal medya ikonlarınızın bağlantılarını buradan yönetin.</p>
    </div>

    <?php echo $message; ?>

    <form method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fab fa-facebook text-blue-600 mr-2"></i> Facebook URL
                </label>
                <input type="url" name="social_facebook" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['social_facebook'] ?? ''); ?>" placeholder="https://facebook.com/kullaniciadi">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fab fa-twitter text-sky-500 mr-2"></i> Twitter / X URL
                </label>
                <input type="url" name="social_twitter" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['social_twitter'] ?? ''); ?>" placeholder="https://twitter.com/kullaniciadi">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fab fa-instagram text-pink-600 mr-2"></i> Instagram URL
                </label>
                <input type="url" name="social_instagram" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['social_instagram'] ?? ''); ?>" placeholder="https://instagram.com/kullaniciadi">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fab fa-youtube text-red-600 mr-2"></i> YouTube URL
                </label>
                <input type="url" name="social_youtube" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['social_youtube'] ?? ''); ?>" placeholder="https://youtube.com/channel/...">
            </div>
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
</script>