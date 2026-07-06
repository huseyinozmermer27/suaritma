<?php
// admin/pages/blog_add.php
global $db;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/blog/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
    }
    
    if ($is_featured) {
        $db->exec("UPDATE blog SET is_featured = 0");
    }
    
    $stmt = $db->prepare("INSERT INTO blog (title, description, content, is_featured, slug, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $content, $is_featured, strtolower(str_replace(' ', '-', $title)), $image]);
    echo "<script>window.location.href='index.php?page=blog';</script>";
    exit;
}
?>
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Yeni Blog Yazısı</h2>
    <form method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow space-y-4">
        <input type="text" name="title" placeholder="Başlık" class="w-full border p-2 rounded" required>
        <label class="block text-sm font-medium">Kısa Açıklama</label>
        <div id="editor_description_container"></div>
        <textarea name="description" id="editor_description" class="hidden"></textarea>
        <label class="block text-sm font-medium mt-4">İçerik</label>
        <div id="editor_content_container"></div>
        <textarea name="content" id="editor_content" class="hidden"></textarea>
        <input type="file" name="image" class="w-full border p-2 rounded">
        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_featured"> Öne çıkan blog yap
        </label>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kaydet</button>
    </form>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    const config = {
        toolbar: { items: ['bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'undo', 'redo'] }
    };
    let editorDescription;
    let editorContent;

    ClassicEditor.create(document.querySelector('#editor_description_container'), config)
        .then(editor => { editorDescription = editor; });

    ClassicEditor.create(document.querySelector('#editor_content_container'), config)
        .then(editor => { editorContent = editor; });

    document.querySelector('form').addEventListener('submit', () => {
        if (editorDescription) document.querySelector('#editor_description').value = editorDescription.getData();
        if (editorContent) document.querySelector('#editor_content').value = editorContent.getData();
    });
</script>
