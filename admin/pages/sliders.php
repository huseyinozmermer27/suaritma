<?php
// admin/pages/sliders.php
global $db;

if (isset($_GET['delete'])) {
    $stmt = $db->prepare("SELECT image FROM slider WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    $slider = $stmt->fetch();
    if ($slider && !empty($slider['image']) && file_exists('../assets/img/slider/' . $slider['image'])) {
        unlink('../assets/img/slider/' . $slider['image']);
    }
    $db->prepare("DELETE FROM slider WHERE id = ?")->execute([$_GET['delete']]);
    redirect('index.php?page=sliders');
}

$sliders = $db->query("SELECT * FROM slider ORDER BY sort_order ASC")->fetchAll();
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Hero Slider Yönetimi</h2>
        <a href="index.php?page=slider_add" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md">
            <i class="bi bi-plus-lg mr-2"></i> Yeni Slayt Ekle
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">Görsel</th>
                    <th class="p-4 font-semibold text-gray-600">Başlık</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Sıra</th>
                    <th class="p-4 font-semibold text-gray-600 text-right">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($sliders as $s): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <img src="../assets/img/slider/<?php echo htmlspecialchars($s['image']); ?>" class="w-24 h-16 object-cover rounded-lg border">
                    </td>
                    <td class="p-4 font-medium text-gray-800"><?php echo htmlspecialchars($s['title']); ?></td>
                    <td class="p-4 text-center"><?php echo $s['sort_order']; ?></td>
                    <td class="p-4 text-right">
                        <a href="index.php?page=slider_edit&id=<?php echo $s['id']; ?>" class="text-blue-600 hover:text-blue-800 mr-3">
                            <i class="bi bi-pencil"></i> Düzenle
                        </a>
                        <a href="index.php?page=sliders&delete=<?php echo $s['id']; ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Bu slaytı silmek istediğinize emin misiniz?')">
                            <i class="bi bi-trash"></i> Sil
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($sliders)): ?>
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Henüz slayt eklenmemiş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('nav-slider').classList.add('active');
</script>