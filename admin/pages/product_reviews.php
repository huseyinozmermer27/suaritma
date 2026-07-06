<?php
require_once __DIR__ . '/../core/auth.php';
global $db;

if (isset($_GET['toggle'])) {
    $stmt = $db->prepare("UPDATE product_reviews SET status = ? WHERE id = ?");
    $stmt->execute([(int)$_GET['status'], (int)$_GET['toggle']]);
}
if (isset($_GET['delete'])) {
    $stmt = $db->prepare("DELETE FROM product_reviews WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
}

$reviews = $db->query("SELECT * FROM product_reviews ORDER BY id DESC")->fetchAll();
?>
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Fotoğraflı Yorum Yönetimi</h2>
    <table class="w-full bg-white rounded-lg shadow">
        <tr class="bg-gray-50 border-b">
            <th class="p-4">Müşteri</th><th class="p-4">Yorum</th><th class="p-4">Durum</th><th class="p-4">İşlemler</th>
        </tr>
        <?php foreach ($reviews as $r): ?>
        <tr class="border-b">
            <td class="p-4"><?php echo htmlspecialchars($r['customer_name']); ?></td>
            <td class="p-4"><?php echo htmlspecialchars($r['comment']); ?></td>
            <td class="p-4">
                <a href="?page=product_reviews&toggle=<?php echo $r['id']; ?>&status=<?php echo $r['status'] ? 0 : 1; ?>" 
                   class="<?php echo $r['status'] ? 'text-green-600' : 'text-red-600'; ?> font-bold">
                   <?php echo $r['status'] ? 'Onaylı' : 'Bekliyor'; ?>
                </a>
            </td>
            <td class="p-4">
                <a href="?page=product_reviews&delete=<?php echo $r['id']; ?>" class="text-red-600 font-bold">Sil</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
