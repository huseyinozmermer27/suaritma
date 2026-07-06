<?php
// admin/pages/settings_features.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['id'];
    $titles = $_POST['title'];
    $descriptions = $_POST['description'];
    $icons = $_POST['icon'];
    
    foreach ($ids as $key => $id) {
        $stmt = $db->prepare("UPDATE features SET title = ?, description = ?, icon = ? WHERE id = ?");
        $stmt->execute([$titles[$key], $descriptions[$key], $icons[$key], $id]);
    }
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Özellikler başarıyla güncellendi.</div>';
}

$features = $db->query("SELECT * FROM features ORDER BY id ASC")->fetchAll();
?>

<div class="p-6">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">İkonlu Özellikler Yönetimi</h2>
        <p class="text-gray-500">Footer bölümünde görünen ikonlu özellikleri buradan düzenleyebilirsiniz.</p>
    </div>

    <?php echo $message; ?>

    <form method="POST" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($features as $feature): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <input type="hidden" name="id[]" value="<?php echo $feature['id']; ?>">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                        <i class="bi bi-<?php echo htmlspecialchars($feature['icon']); ?>"></i>
                    </div>
                    <input type="text" name="title[]" class="w-full text-lg font-bold border-none outline-none focus:ring-0" value="<?php echo htmlspecialchars($feature['title']); ?>">
                </div>
                <div class="mb-4">
                    <label class="text-xs text-gray-400 uppercase tracking-wide">Açıklama</label>
                    <textarea name="description[]" class="w-full mt-1 p-2 border rounded-lg text-sm" rows="3"><?php echo htmlspecialchars($feature['description']); ?></textarea>
                </div>
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide">İkon Adı (Bootstrap Icons)</label>
                    <input type="text" name="icon[]" class="w-full mt-1 p-2 border rounded-lg text-sm" value="<?php echo htmlspecialchars($feature['icon']); ?>">
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl transition shadow-lg text-lg font-semibold">
                Tüm Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('site-management').classList.remove('hidden');
    document.getElementById('footer-settings').classList.remove('hidden');
</script>