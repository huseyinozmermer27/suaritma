<?php
// admin/pages/video_edit.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$video = $db->query("SELECT * FROM videos WHERE id = $id")->fetch();

if (!$video) {
    redirect('index.php?page=product_videos');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = clean($_POST['title']);
    $description = $_POST['description'];
    $url = clean($_POST['url']);
    
    $stmt = $db->prepare("UPDATE videos SET title = ?, description = ?, youtube_url = ? WHERE id = ?");
    $stmt->execute([$title, $description, $url, $id]);
    
    redirect('index.php?page=' . ($video['type'] == 'product' ? 'product_videos' : 'customer_videos'));
}
?>

<div class="p-6 max-w-4xl">
    <h2 class="text-2xl font-bold mb-6">Video Düzenle</h2>
    <form method="POST" class="bg-white p-6 rounded-xl shadow-sm border">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Video Başlığı</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($video['title']); ?>" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Açıklama</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded" rows="5"><?php echo $video['description']; ?></textarea>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">YouTube URL</label>
            <input type="url" name="url" value="<?php echo htmlspecialchars($video['youtube_url']); ?>" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Güncelle</button>
        <a href="index.php?page=product_videos" class="ml-4 text-gray-600">İptal</a>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>