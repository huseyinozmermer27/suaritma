<?php
// admin/pages/customer_videos.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$message = '';

// Onaylama/Reddetme İşlemi
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $source = $_GET['source'];
    $new_status = isset($_GET['status']) ? (int)$_GET['status'] : 0;
    
    if ($source == 'youtube') {
        $stmt = $db->prepare("UPDATE videos SET status = ? WHERE id = ?");
    } else {
        $stmt = $db->prepare("UPDATE customer_reviews SET status = ? WHERE id = ?");
    }
    $stmt->execute([$new_status, $id]);
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Video durumu güncellendi.</div>';
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $source = $_GET['source'];
    
    if ($source == 'youtube') {
        $stmt = $db->prepare("DELETE FROM videos WHERE id = ?");
        $stmt->execute([$id]);
    } else {
        $stmt = $db->prepare("SELECT video_path FROM customer_reviews WHERE id = ?");
        $stmt->execute([$id]);
        $review = $stmt->fetch();
        if ($review && !empty($review['video_path'])) {
            @unlink(__DIR__ . '/../../' . $review['video_path']);
        }
        $stmt = $db->prepare("DELETE FROM customer_reviews WHERE id = ?");
        $stmt->execute([$id]);
    }
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Video başarıyla silindi.</div>';
}

// Tüm videoları birleştir
$all_videos = $db->query("
    SELECT id, title as name, youtube_url as url, 'youtube' as source, status 
    FROM videos WHERE type = 'customer'
    UNION ALL 
    SELECT id, customer_name as name, video_path as url, 'uploaded' as source, status 
    FROM customer_reviews WHERE video_path IS NOT NULL
    ORDER BY id DESC
")->fetchAll();
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Müşteri Deneyim Videoları</h2>
    </div>

    <?php echo $message; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">İsim / Başlık</th>
                    <th class="p-4 font-semibold text-gray-600">Kaynak / URL</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Durum</th>
                    <th class="p-4 font-semibold text-gray-600 text-right">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($all_videos as $v): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-800"><?php echo htmlspecialchars($v['name']); ?></td>
                    <td class="p-4 text-blue-600 text-sm"><?php echo htmlspecialchars($v['url']); ?></td>
                    <td class="p-4 text-center">
                        <?php if ($v['status']): ?>
                            <a href="index.php?page=customer_videos&toggle=<?php echo $v['id']; ?>&source=<?php echo $v['source']; ?>&status=0" class="text-green-600 hover:text-green-800 font-bold">Onaylı</a>
                        <?php else: ?>
                            <a href="index.php?page=customer_videos&toggle=<?php echo $v['id']; ?>&source=<?php echo $v['source']; ?>&status=1" class="text-orange-600 hover:text-orange-800 font-bold">Bekliyor</a>
                        <?php endif; ?>
                    </td>
                    <td class="p-4 text-right">
                        <a href="index.php?page=customer_videos&delete=<?php echo $v['id']; ?>&source=<?php echo $v['source']; ?>" 
                           class="inline-flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-md text-xs font-bold transition-all duration-200 border border-red-100" 
                           onclick="return confirm('Bu videoyu kalıcı olarak silmek istediğinize emin misiniz?')">
                            <i class="fas fa-trash-alt"></i> Sil
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
