<?php
// admin/pages/menu_edit.php
require_once __DIR__ . '/../core/auth.php';

global $db;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';
$success = '';

// Menü öğesini çek
$stmt = $db->prepare("SELECT * FROM menus WHERE id = ?");
$stmt->execute([$id]);
$menu = $stmt->fetch();

if (!$menu) {
    redirect('index.php?page=menus');
}

// Parent seçenekleri için mevcut ana menüleri çek (kendisi hariç)
$parentMenus = $db->query("SELECT id, name FROM menus WHERE parent_id = 0 AND id != $id ORDER BY sort_order ASC, name ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean($_POST['name']);
    $link = clean($_POST['link']);
    $parent_id = (int)$_POST['parent_id'];
    $sort_order = (int)$_POST['sort_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    if (empty($name)) {
        $error = 'Lütfen menü adı alanını doldurun.';
    } else {
        $stmt = $db->prepare("UPDATE menus SET name = ?, link = ?, parent_id = ?, sort_order = ?, status = ? WHERE id = ?");
        if ($stmt->execute([$name, $link, $parent_id, $sort_order, $status, $id])) {
            $success = 'Menü öğesi başarıyla güncellendi.';
            $stmt = $db->prepare("SELECT * FROM menus WHERE id = ?");
            $stmt->execute([$id]);
            $menu = $stmt->fetch();
        } else {
            $error = 'Bir hata oluştu.';
        }
    }
}
?>

<div class="p-6 max-w-2xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Menü Öğesini Düzenle</h2>
        <a href="index.php?page=menus" class="text-gray-600 hover:text-gray-800 transition">
            <i class="bi bi-arrow-left mr-1"></i> Geri Dön
        </a>
    </div>

    <?php if ($error): ?><div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4"><?php echo $error; ?></div><?php endif; ?>
    <?php if ($success): ?><div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4"><?php echo $success; ?></div><?php endif; ?>

    <form method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Menü Adı</label>
            <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required value="<?php echo htmlspecialchars($menu['name']); ?>">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Menü Linki</label>
            <input type="text" name="link" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo htmlspecialchars($menu['link']); ?>">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Üst Menü</label>
            <select name="parent_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="0" <?php echo ($menu['parent_id'] == 0) ? 'selected' : ''; ?>>Ana Menü Öğesi</option>
                <?php foreach ($parentMenus as $pMenu): ?>
                    <option value="<?php echo $pMenu['id']; ?>" <?php echo ($menu['parent_id'] == $pMenu['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($pMenu['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Sıralama</label>
            <input type="number" name="sort_order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="<?php echo $menu['sort_order']; ?>">
        </div>
        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="status" class="w-5 h-5 text-blue-600 rounded" <?php echo $menu['status'] ? 'checked' : ''; ?>>
                <span class="ml-2 text-gray-700">Aktif</span>
            </label>
            <button type="submit" class="bg-blue-600 hover:text-blue-700 text-white px-8 py-2 rounded-lg transition shadow-lg">Güncelle</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('nav-menus').classList.add('active');
</script>