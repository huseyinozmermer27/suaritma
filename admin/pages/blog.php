<?php
// admin/pages/blog.php
global $db;
$message = '';
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM blog WHERE id = ?");
    $stmt->execute([$id]);
    $message = '<div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">Blog yazısı silindi.</div>';
}
$blogs = $db->query("SELECT * FROM blog ORDER BY created_at DESC")->fetchAll();
?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Blog Yönetimi</h2>
        <a href="index.php?page=blog_add" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Yeni Yazı Ekle</a>
    </div>
    <?php echo $message; ?>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4">Kapak</th>
                    <th class="p-4">Başlık</th>
                    <th class="p-4">Kısa Açıklama</th>
                    <th class="p-4">Öne Çıkan</th>
                    <th class="p-4">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $b): ?>
                <tr class="border-b">
                    <td class="p-4"><img src="../assets/uploads/blog/<?php echo $b['image']; ?>" class="w-20 rounded"></td>
                    <td class="p-4"><?php echo htmlspecialchars($b['title']); ?></td>
                    <td class="p-4 text-sm text-gray-600"><?php echo htmlspecialchars(mb_substr(strip_tags($b['description']), 0, 50)) . '...'; ?></td>
                    <td class="p-4"><?php echo $b['is_featured'] ? '<span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">ÖNE ÇIKAN</span>' : '-'; ?></td>
                    <td class="p-4">
                        <a href="index.php?page=blog_edit&id=<?php echo $b['id']; ?>" class="text-blue-600">Düzenle</a>
                        <a href="index.php?page=blog&delete=<?php echo $b['id']; ?>" class="text-red-600 ml-4" onclick="return confirm('Silmek istediğine emin misin?')">Sil</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
