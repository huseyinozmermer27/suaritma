<?php
// admin/pages/contact_messages.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$message = '';

// Mesaj Silme İşlemi
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->execute([$id]);
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Mesaj başarıyla silindi.</div>';
}

$messages = $db->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Gelen İletişim Mesajları</h2>
    </div>

    <?php echo $message; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">Gönderen</th>
                    <th class="p-4 font-semibold text-gray-600">E-posta</th>
                    <th class="p-4 font-semibold text-gray-600">Mesaj</th>
                    <th class="p-4 font-semibold text-gray-600">Tarih</th>
                    <th class="p-4 font-semibold text-gray-600 text-right">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($messages as $m): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-800"><?php echo htmlspecialchars($m['name']); ?></td>
                    <td class="p-4 text-gray-600 text-sm"><?php echo htmlspecialchars($m['email']); ?></td>
                    <td class="p-4 text-gray-600 text-sm"><?php echo htmlspecialchars(substr($m['message'], 0, 100)) . (strlen($m['message']) > 100 ? '...' : ''); ?></td>
                    <td class="p-4 text-gray-400 text-xs"><?php echo date('d.m.Y H:i', strtotime($m['created_at'])); ?></td>
                    <td class="p-4 text-right">
                        <a href="index.php?page=contact_messages&delete=<?php echo $m['id']; ?>" 
                           class="inline-flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-md text-xs font-bold transition-all duration-200 border border-red-100" 
                           onclick="return confirm('Bu mesajı silmek istediğinize emin misiniz?')">
                            <i class="fas fa-trash-alt"></i> Sil
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="5" class="p-10 text-center text-gray-400 italic">Henüz gelen bir mesaj bulunmamaktadır.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
