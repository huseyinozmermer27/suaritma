<?php
// admin/pages/settings_logo.php
require_once __DIR__ . '/../core/auth.php';

global $db;
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Logo ve Favicon Yükleme İşlemi
    $files = ['logo', 'favicon'];
    foreach ($files as $file) {
        if (isset($_FILES[$file]) && $_FILES[$file]['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION));
            $newFileName = $file . '.' . $ext;
            $destPath = '../assets/logo/' . $newFileName;
            
            if (move_uploaded_file($_FILES[$file]['tmp_name'], $destPath)) {
                $stmt = $db->prepare("INSERT INTO settings (s_key, s_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE s_value = ?");
                $stmt->execute([$file, $newFileName, $newFileName]);
            }
        }
    }
    $success = 'Logo ve Favicon başarıyla güncellendi.';
}

$stmt = $db->query("SELECT s_key, s_value FROM settings WHERE s_key IN ('logo', 'favicon')");
$settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
?>

<div class="p-6 max-w-2xl">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Logo ve Favicon Yönetimi</h2>
    </div>

    <?php if ($success): ?><div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6"><i class="bi bi-check-circle-fill mr-2"></i> <?php echo $success; ?></div><?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Logo</label>
            <?php if (!empty($settings['logo'])): ?>
                <img src="../assets/logo/<?php echo htmlspecialchars($settings['logo']); ?>" class="h-16 mb-2 border rounded p-1 bg-gray-50">
            <?php endif; ?>
            <input type="file" name="logo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Favicon</label>
            <?php if (!empty($settings['favicon'])): ?>
                <img src="../assets/logo/<?php echo htmlspecialchars($settings['favicon']); ?>" class="w-10 h-10 mb-2 border rounded p-1 bg-gray-50">
            <?php endif; ?>
            <input type="file" name="favicon" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg transition shadow-lg">Güncelle</button>
    </form>
</div>
