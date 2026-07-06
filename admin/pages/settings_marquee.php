<?php
// admin/pages/settings_marquee.php
require_once __DIR__ . '/../core/auth.php';

global $db;
$success = '';

// Mevcut ayarları çek
$stmt = $db->query("SELECT s_value FROM settings WHERE s_key = 'marquee_items'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$marquee_items = json_decode($row['s_value'] ?? '[]', true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_marquee = array_filter($_POST['marquee_item'] ?? []);
    $json_marquee = json_encode(array_values($new_marquee), JSON_UNESCAPED_UNICODE);
    
    $stmt = $db->prepare("INSERT INTO settings (s_key, s_value) VALUES ('marquee_items', ?) ON DUPLICATE KEY UPDATE s_value = ?");
    $stmt->execute([$json_marquee, $json_marquee]);
    
    $success = 'Kayan yazılar başarıyla güncellendi.';
    $marquee_items = array_values($new_marquee);
}
?>

<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kayan Yazı Yönetimi</h2>
        <p class="text-gray-500 text-sm mt-1">Site üst kısmında dönen duyuru yazılarını buradan ekleyebilir, silebilir veya güncelleyebilirsiniz.</p>
    </div>

    <?php if ($success): ?>
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 shadow-sm">
            <i class="bi bi-check-circle-fill mr-2"></i> <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div id="marquee-list" class="space-y-3 mb-6">
            <?php if (!empty($marquee_items)): foreach ($marquee_items as $item): ?>
                <div class="flex gap-2">
                    <input type="text" name="marquee_item[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($item); ?>" required>
                    <button type="button" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg transition" onclick="this.parentElement.remove()">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            <?php endforeach; endif; ?>
        </div>

        <div class="flex gap-4">
            <button type="button" class="flex items-center text-blue-600 hover:text-blue-800 font-medium px-4 py-2" onclick="addMarquee()">
                <i class="bi bi-plus-circle mr-2"></i> Yeni Yazı Ekle
            </button>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg transition shadow-lg ml-auto">
                Kaydet
            </button>
        </div>
    </form>
</div>

<script>
function addMarquee() {
    const list = document.getElementById('marquee-list');
    const div = document.createElement('div');
    div.className = 'flex gap-2';
    div.innerHTML = `
        <input type="text" name="marquee_item[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Yeni duyuru metni..." required>
        <button type="button" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg transition" onclick="this.parentElement.remove()">
            <i class="bi bi-trash"></i>
        </button>
    `;
    list.appendChild(div);
}
</script>