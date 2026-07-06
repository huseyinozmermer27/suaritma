<?php
// admin/pages/menus.php
require_once __DIR__ . '/../core/auth.php';

global $db;

$message = '';

// Menü Silme İşlemi
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    // Silmeden önce alt öğesi var mı kontrol et (basitçe çocukları da silinir veya parent_id 0 yapılır)
    $stmt = $db->prepare("DELETE FROM menus WHERE id = ?");
    if ($stmt->execute([$id])) {
        // Alt öğelerin parent_id'sini temizle
        $db->prepare("UPDATE menus SET parent_id = 0 WHERE parent_id = ?")->execute([$id]);
        $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">Menü öğesi başarıyla silindi.</div>';
    }
}

// Menüleri Hiyerarşik Çek
$all_menus = $db->query("SELECT * FROM menus ORDER BY sort_order ASC, id ASC")->fetchAll();

function buildTree(array $elements, $parentId = 0) {
    $branch = array();
    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildTree($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }
    return $branch;
}

$tree = buildTree($all_menus);
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Menü Yönetimi</h2>
        <a href="index.php?page=menu_add" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md">
            <i class="bi bi-plus-lg mr-2"></i> Yeni Menü Öğesi Ekle
        </a>
    </div>

    <?php echo $message; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full min-w-[700px] text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">Menü Adı</th>
                    <th class="p-4 font-semibold text-gray-600">Link</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Sıra</th>
                    <th class="p-4 font-semibold text-gray-600">Durum</th>
                    <th class="p-4 font-semibold text-gray-600 text-right w-48">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php 
                function renderRow($item, $level = 0) {
                    $padding = $level * 32;
                    echo '<tr class="hover:bg-gray-50 transition">';
                    echo '<td class="p-4 font-medium text-gray-800" style="padding-left: ' . ($padding + 16) . 'px;">';
                    if ($level > 0) echo '<i class="bi bi-arrow-return-right mr-2 text-gray-400"></i>';
                    echo htmlspecialchars($item['name']) . '</td>';
                    echo '<td class="p-4"><code class="bg-gray-100 px-2 py-1 rounded text-sm text-blue-600">' . htmlspecialchars($item['link']) . '</code></td>';
                    echo '<td class="p-4 text-center">' . $item['sort_order'] . '</td>';
                    echo '<td class="p-4">' . ($item['status'] ? '<span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Aktif</span>' : '<span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">Pasif</span>') . '</td>';
                    echo '<td class="p-4 text-right whitespace-nowrap">
                            <a href="index.php?page=menu_edit&id=' . $item['id'] . '" class="text-blue-600 hover:text-blue-800 mr-4"><i class="bi bi-pencil mr-1"></i></a>
                            <a href="index.php?page=menus&delete=' . $item['id'] . '" class="text-red-600 hover:text-red-800" onclick="return confirm(\'Silmek istediğinize emin misiniz?\')"><i class="bi bi-trash mr-1"></i></a>
                          </td>';
                    echo '</tr>';
                    if (isset($item['children'])) {
                        foreach ($item['children'] as $child) {
                            renderRow($child, $level + 1);
                        }
                    }
                }
                
                foreach ($tree as $menu) {
                    renderRow($menu);
                }
                ?>
                <?php if (empty($all_menus)): ?>
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">Henüz menü öğesi eklenmemiş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('nav-menus').classList.add('active');
</script>