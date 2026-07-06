<?php
// admin/pages/category_add.php
require_once __DIR__ . '/../core/auth.php';

global $db;
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean($_POST['name']);
    $status = isset($_POST['status']) ? 1 : 0;
    $slug = !empty($_POST['slug']) ? createSlug($_POST['slug']) : createSlug($name);

    if (!empty($name)) {
        $check = $db->prepare("SELECT id FROM categories WHERE slug = ?");
        $check->execute([$slug]);
        if ($check->rowCount() > 0) {
            $slug .= '-' . rand(10, 99);
        }

        $stmt = $db->prepare("INSERT INTO categories (name, slug, status) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $slug, $status])) {
            $success = 'Kategori başarıyla eklendi.';
        } else {
            $error = 'Bir hata oluştu.';
        }
    } else {
        $error = 'Lütfen kategori adını girin.';
    }
}
?>

<div class="p-6 max-w-2xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Yeni Kategori Ekle</h2>
        <a href="index.php?page=categories" class="text-gray-600 hover:text-gray-800 transition">
            <i class="bi bi-arrow-left mr-1"></i> Geri Dön
        </a>
    </div>

    <?php if ($error): ?><div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4"><?php echo $error; ?></div><?php endif; ?>
    <?php if ($success): ?><div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4"><?php echo $success; ?></div><?php endif; ?>

    <form method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Adı</label>
            <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required placeholder="Örn: Ev Tipi Su Arıtma">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
            <input type="text" name="slug" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="orn-kategori-adi">
        </div>
        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="status" class="w-5 h-5 text-blue-600 rounded" checked>
                <span class="ml-2 text-gray-700">Aktif Kategori</span>
            </label>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg transition shadow-lg">Kaydet</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('nav-categories').classList.add('active');
</script>