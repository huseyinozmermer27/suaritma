<?php
// admin/pages/slider_add.php
require_once __DIR__ . '/../core/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $db;
    $title = clean($_POST['title']);
    $subtitle = clean($_POST['subtitle']);
    $link = clean($_POST['link']);
    $sort = (int)$_POST['sort_order'];
    
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = 'slide_' . time() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/slider/' . $image);
    }
    
    $db->prepare("INSERT INTO slider (title, subtitle, image, link, sort_order) VALUES (?, ?, ?, ?, ?)")
       ->execute([$title, $subtitle, $image, $link, $sort]);
    redirect('index.php?page=sliders');
}

$available_links = [
    '/suaritma/index.php' => 'Ana Sayfa',
];

$collection_files = glob(__DIR__ . '/../../collections/*.php');
foreach ($collection_files as $file) {
    $path = str_replace(realpath(__DIR__ . '/../../'), '/suaritma', realpath($file));
    $display_name = ucfirst(str_replace(['-', '.php', '/collections/'], [' ', '', ''], basename($path)));
    $available_links[$path] = 'Koleksiyon: ' . $display_name;
}

$product_files = glob(__DIR__ . '/../../products/*.php');
foreach ($product_files as $file) {
    $path = str_replace(realpath(__DIR__ . '/../../'), '/suaritma', realpath($file));
    $display_name = ucfirst(str_replace(['-', '.php', '/products/'], [' ', '', ''], basename($path)));
    $available_links[$path] = 'Ürün: ' . $display_name;
}

$page_files = glob(__DIR__ . '/../../pages/*.php');
foreach ($page_files as $file) {
    $path = str_replace(realpath(__DIR__ . '/../../'), '/suaritma', realpath($file));
    $display_name = ucfirst(str_replace(['-', '_', '.php', '/pages/', 'i̇ade'], [' ', ' ', '', '', 'iade'], basename($path)));
    $available_links[$path] = 'Sayfa: ' . $display_name;
}
?>
<div class="p-6 max-w-2xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Yeni Slayt Ekle</h2>
        <a href="index.php?page=sliders" class="text-gray-600 hover:text-gray-800 transition">
            <i class="bi bi-arrow-left mr-1"></i> Geri Dön
        </a>
    </div>

    <form method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Başlık</label>
            <input type="text" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Alt Başlık</label>
            <input type="text" name="subtitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Görsel</label>
            <input type="file" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Link</label>
            <select name="link" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">-- Lütfen Seçiniz --</option>
                <?php foreach ($available_links as $link_path => $link_name): ?>
                    <option value="<?php echo htmlspecialchars($link_path); ?>"><?php echo htmlspecialchars($link_name); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Sıralama</label>
            <input type="number" name="sort_order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" value="0">
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg transition shadow-lg">Kaydet</button>
    </form>
</div>

<script>
    document.getElementById('nav-slider').classList.add('active');
</script>