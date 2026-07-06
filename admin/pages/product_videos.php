<?php
// admin/pages/product_videos.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$message = '';
if (isset($_GET['delete'])) {
    $stmt = $db->prepare("DELETE FROM videos WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Video silindi.</div>';
}

$videos = $db->query("SELECT * FROM videos WHERE type = 'product' ORDER BY sort_order ASC")->fetchAll();
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Ürün Videoları</h2>
        <a href="index.php?page=video_add&type=product" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md">
            <i class="bi bi-plus-lg mr-2"></i> Yeni Video Ekle
        </a>
    </div>

    <?php echo $message; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">Başlık</th>
                    <th class="p-4 font-semibold text-gray-600">YouTube URL</th>
                    <th class="p-4 font-semibold text-gray-600 text-right">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($videos as $v): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium text-gray-800"><?php echo htmlspecialchars($v['title']); ?></td>
                    <td class="p-4 text-blue-600"><?php echo htmlspecialchars($v['youtube_url']); ?></td>
                    <td class="p-4 text-right">
                        <a href="index.php?page=video_edit&id=<?php echo $v['id']; ?>" class="text-blue-600 mr-3"><i class="bi bi-pencil"></i></a>
                        <a href="index.php?page=product_videos&delete=<?php echo $v['id']; ?>" class="text-red-600"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
