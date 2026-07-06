<?php
// admin/pages/customer_reviews.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$message = '';

// Onaylama/Reddetme İşlemi
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $new_status = isset($_GET['status']) ? (int)$_GET['status'] : 0;
    $stmt = $db->prepare("UPDATE product_reviews SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $id]);
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Yorum durumu güncellendi.</div>';
}

// Silme İşlemi
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    // Fotoğrafları sil
    $stmt = $db->prepare("SELECT image_urls FROM product_reviews WHERE id = ?");
    $stmt->execute([$id]);
    $review = $stmt->fetch();
    if ($review && !empty($review['image_urls'])) {
        $images = explode(',', $review['image_urls']);
        foreach ($images as $img) {
            @unlink(__DIR__ . '/../../' . trim($img));
        }
    }
    
    $stmt = $db->prepare("DELETE FROM product_reviews WHERE id = ?");
    $stmt->execute([$id]);
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">Yorum ve fotoğraflar başarıyla silindi.</div>';
}

$reviews = $db->query("SELECT * FROM product_reviews ORDER BY id DESC")->fetchAll();
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Müşteri Yorumları (Fotoğraflı)</h2>
    </div>

    <?php echo $message; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">Müşteri</th>
                    <th class="p-4 font-semibold text-gray-600">Yorum</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Fotoğraflar</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Durum</th>
                    <th class="p-4 font-semibold text-gray-600 text-right">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($reviews as $r): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-800"><?php echo htmlspecialchars($r['customer_name']); ?></td>
                    <td class="p-4 text-gray-600 text-sm"><?php echo htmlspecialchars(substr($r['comment'], 0, 80)) . '...'; ?></td>
                    <td class="p-4 text-center">
                        <?php if (!empty($r['image_urls'])): 
                            $imgs = explode(',', $r['image_urls']);
                            foreach($imgs as $img): ?>
                                <a href="../<?php echo trim($img); ?>" target="_blank" class="inline-block m-1">
                                    <img src="../<?php echo trim($img); ?>" class="w-12 h-12 object-cover rounded shadow">
                                </a>
                            <?php endforeach;
                        endif; ?>
                    </td>
                    <td class="p-4 text-center">
                        <?php if ($r['status']): ?>
                            <a href="index.php?page=customer_reviews&toggle=<?php echo $r['id']; ?>&status=0" class="text-green-600 hover:text-green-800 font-bold">Onaylı</a>
                        <?php else: ?>
                            <a href="index.php?page=customer_reviews&toggle=<?php echo $r['id']; ?>&status=1" class="text-orange-600 hover:text-orange-800 font-bold">Bekliyor</a>
                        <?php endif; ?>
                    </td>
                    <td class="p-4 text-right">
                        <a href="index.php?page=customer_reviews&delete=<?php echo $r['id']; ?>" 
                           class="inline-flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-md text-xs font-bold transition-all duration-200 border border-red-100" 
                           onclick="return confirm('Bu yorumu ve varsa bağlı fotoğrafları kalıcı olarak silmek istediğinize emin misiniz?')">
                            <i class="fas fa-trash-alt"></i> Sil
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
