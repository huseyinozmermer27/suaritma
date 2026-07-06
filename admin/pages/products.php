<?php
// admin/pages/products.php
global $db;

$message = '';

// Ürün Silme İşlemi
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // Önce resim dosyasını bul ve sil
    $stmt = $db->prepare("SELECT main_image FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    
    if ($product && !empty($product['main_image'])) {
        $filePath = '../assets/uploads/products/' . $product['main_image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Veritabanından sil
    $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
    if ($stmt->execute([$id])) {
        $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">Ürün ve ilgili görsel başarıyla silindi.</div>';
    }
}

// Ürünleri Listele (Kategori adıyla beraber)
$query = "SELECT p.*, c.name as category_name 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id 
          ORDER BY p.id DESC";
$products = $db->query($query)->fetchAll();
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Ürün Yönetimi</h2>
        <a href="index.php?page=product_add" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md">
            <i class="bi bi-plus-lg mr-2"></i> Yeni Ürün Ekle
        </a>
    </div>

    <?php echo $message; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full min-w-[800px] text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">Görsel 1</th>
                    <th class="p-4 font-semibold text-gray-600">Ürün Adı</th>
                    <th class="p-4 font-semibold text-gray-600">Kategori</th>
                    <th class="p-4 font-semibold text-gray-600">Fiyat</th>
                    <th class="p-4 font-semibold text-gray-600">İndirimli Fiyat</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Stok</th>
                    <th class="p-4 font-semibold text-gray-600">Durum</th>
                    <th class="p-4 font-semibold text-gray-600 text-right w-48">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($products as $p): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <?php if ($p['main_image']): ?>
                            <?php 
                                $imagePath = (strpos($p['main_image'], 'http') === 0) 
                                    ? $p['main_image'] 
                                    : '../assets/uploads/products/' . htmlspecialchars($p['main_image']);
                            ?>
                            <img src="<?php echo $imagePath; ?>" class="w-12 h-12 object-cover rounded-lg border">
                        <?php else: ?>
                            <div class="w-12 h-12 bg-gray-100 border rounded-lg flex items-center justify-center">
                                <i class="bi bi-image text-gray-400"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="p-4">
                        <div class="font-medium text-gray-800"><?php echo htmlspecialchars($p['name']); ?></div>
                        <div class="text-xs text-gray-400">Slug: <?php echo htmlspecialchars($p['slug']); ?></div>
                    </td>
                    <td class="p-4 text-gray-600"><?php echo htmlspecialchars($p['category_name'] ?? 'Kategorisiz'); ?></td>
                    <td class="p-4 text-gray-800"><?php echo number_format($p['price'], 2, ',', '.'); ?> TL</td>
                    <td class="p-4 text-gray-800">
                        <?php if (isset($p['discounted_price']) && $p['discounted_price'] > 0): ?>
                            <span class="text-red-600 font-bold"><?php echo number_format($p['discounted_price'], 2, ',', '.'); ?> TL</span>
                        <?php else: ?>
                            <span class="text-gray-400">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4 text-center"><?php echo $p['stock_count']; ?></td>
                    <td class="p-4">
                        <?php if ($p['status']): ?>
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Aktif</span>
                        <?php else: ?>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">Pasif</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4 text-right whitespace-nowrap">
                        <a href="index.php?page=product_edit&id=<?php echo $p['id']; ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 mr-4">
                            <i class="bi bi-pencil mr-1"></i> Düzenle
                        </a>
                        <a href="index.php?page=products&delete=<?php echo $p['id']; ?>" class="inline-flex items-center text-red-600 hover:text-red-800" onclick="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">
                            <i class="bi bi-trash mr-1"></i> Sil
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="8" class="p-8 text-center text-gray-500">Henüz ürün eklenmemiş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('nav-products').classList.add('active');
</script>