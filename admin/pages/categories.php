<?php
// admin/pages/categories.php
global $db;

$message = '';

// Kategori Silme İşlemi
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
    if ($stmt->execute([$id])) {
        $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">Kategori başarıyla silindi.</div>';
    }
}

// Kategorileri Listele
$categories = $db->query("SELECT * FROM categories ORDER BY id DESC")->fetchAll();
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kategoriler</h2>
        <a href="index.php?page=category_add" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md">
            <i class="bi bi-plus-lg mr-2"></i> Yeni Kategori Ekle
        </a>
    </div>

    <?php echo $message; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">ID</th>
                    <th class="p-4 font-semibold text-gray-600">Kategori Adı</th>
                    <th class="p-4 font-semibold text-gray-600">Slug</th>
                    <th class="p-4 font-semibold text-gray-600">Durum</th>
                    <th class="p-4 font-semibold text-gray-600 text-right w-48">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($categories as $cat): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-gray-500"><?php echo $cat['id']; ?></td>
                    <td class="p-4 font-medium text-gray-800"><?php echo htmlspecialchars($cat['name']); ?></td>
                    <td class="p-4"><code class="bg-gray-100 px-2 py-1 rounded text-sm"><?php echo htmlspecialchars($cat['slug']); ?></code></td>
                    <td class="p-4">
                        <?php if ($cat['status']): ?>
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Aktif</span>
                        <?php else: ?>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">Pasif</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4 text-right whitespace-nowrap">
                        <a href="index.php?page=category_edit&id=<?php echo $cat['id']; ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 mr-4">
                            <i class="bi bi-pencil mr-1"></i> Düzenle
                        </a>
                        <a href="index.php?page=categories&delete=<?php echo $cat['id']; ?>" class="inline-flex items-center text-red-600 hover:text-red-800" onclick="return confirm('Bu kategoriyi silmek istediğinize emin misiniz?')">
                            <i class="bi bi-trash mr-1"></i> Sil
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($categories)): ?>
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">Henüz kategori eklenmemiş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('nav-categories').classList.add('active');
</script>