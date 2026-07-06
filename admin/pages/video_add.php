<?php
// admin/pages/video_add.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$type = isset($_GET['type']) ? $_GET['type'] : 'product';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = clean($_POST['title']);
    $description = $_POST['description']; // CKEditor content
    $url = clean($_POST['url']);
    $stmt = $db->prepare("INSERT INTO videos (title, description, youtube_url, type) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $description, $url, $type]);
    redirect('index.php?page=' . ($type == 'product' ? 'product_videos' : 'customer_videos'));
}
?>

<div class="p-6 max-w-4xl">
    <h2 class="text-2xl font-bold mb-6">Yeni Video Ekle</h2>
    <form method="POST" class="bg-white p-6 rounded-xl shadow-sm border">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Video Başlığı</label>
            <input type="text" name="title" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Açıklama</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded" rows="5"></textarea>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">YouTube URL</label>
            <input type="url" name="url" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Kaydet</button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
