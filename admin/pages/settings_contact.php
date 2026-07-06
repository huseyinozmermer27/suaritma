<?php
// admin/pages/settings_contact.php
require_once __DIR__ . '/../core/auth.php';

global $db;
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['contact_phone', 'contact_email', 'contact_address', 'contact_whatsapp'];
    foreach ($fields as $field) {
        $val = clean($_POST[$field]);
        $stmt = $db->prepare("INSERT INTO settings (s_key, s_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE s_value = ?");
        $stmt->execute([$field, $val, $val]);
    }
    $success = 'İletişim bilgileri başarıyla güncellendi.';
}

$stmt = $db->query("SELECT s_key, s_value FROM settings WHERE s_key IN ('contact_phone', 'contact_email', 'contact_address', 'contact_whatsapp')");
$settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
?>

<div class="p-6 max-w-2xl">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">İletişim Bilgileri</h2>
    </div>

    <?php if ($success): ?><div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6"><i class="bi bi-check-circle-fill mr-2"></i> <?php echo $success; ?></div><?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
            <input type="text" name="contact_phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['contact_phone'] ?? ''); ?>">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
            <input type="email" name="contact_email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Numarası (Örn: 905001234567)</label>
            <input type="text" name="contact_whatsapp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Adres</label>
            <textarea name="contact_address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" rows="3"><?php echo htmlspecialchars($settings['contact_address'] ?? ''); ?></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg transition shadow-lg">Güncelle</button>
    </form>
</div>
