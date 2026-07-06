<?php
include '../../../app/Core/includes/header.php';
require_once '../includes/db.php';

$slug = $_GET['slug'] ?? '';
$stmt = $db->prepare("SELECT * FROM blog WHERE slug = ? LIMIT 1");
$stmt->execute([$slug]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    echo '<main class="py-20 text-center"><h1 class="text-4xl">404 - Yazı Bulunamadı</h1><a href="sumosu-blog.php" class="text-blue-600 underline">Bloga Dön</a></main>';
    include '../../../app/Core/includes/footer.php';
    exit;
}

// Okuma süresi hesaplama (ortalama 200 kelime/dk)
$wordCount = str_word_count(strip_tags($blog['content']));
$readingTime = ceil($wordCount / 200);

// Diğer popüler bloglar
$related = $db->query("SELECT * FROM blog WHERE id != {$blog['id']} ORDER BY created_at DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        color: #000000 !important;
    }
    .prose h3 { font-size: 1.8rem !important; }
    .prose h4 { font-size: 1.6rem !important; }
    .prose h5, .prose h6 { font-size: 1.4rem !important; }
    
    .prose p, .prose li, .prose span {
        font-size: 0.9rem !important;
        color: #9ca3af !important; /* Lighter gray (text-gray-400) */
        line-height: 1.6 !important;
    }
</style>

<main class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-500 mb-8">
            <a href="../index.php" class="hover:text-blue-600">Anasayfa</a> > 
            <a href="sumosu-blog.php" class="hover:text-blue-600">Blog</a> > 
            <span class="text-gray-900"><?php echo htmlspecialchars($blog['title']); ?></span>
        </nav>

        <!-- Başlık ve Meta -->
        <header class="mb-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-[#062d34] mb-6"><?php echo htmlspecialchars($blog['title']); ?></h1>
            <div class="flex items-center justify-center gap-4 text-sm text-gray-500">
                <span><?php echo date('d M Y', strtotime($blog['created_at'])); ?></span>
                <span>•</span>
                <span><?php echo $readingTime; ?> dk okuma</span>
            </div>
        </header>

        <!-- Kapak Görseli -->
        <img src="../assets/uploads/blog/<?php echo $blog['image']; ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="w-full h-64 md:h-[500px] object-cover rounded-3xl mb-6 shadow-xl">
        
        <!-- Kısa Açıklama (Resim Altı) -->
        <div class="mb-12 text-left max-w-3xl mx-auto">
            <div class="text-lg text-gray-400 font-medium italic italic"><?php echo $blog['description'] ?? ''; ?></div>
        </div>

        <!-- İçerik -->
        <div class="flex flex-col lg:flex-row gap-12">
            <article class="flex-1 bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100">
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <?php echo $blog['content']; ?>
                </div>

                <!-- Yorum Yazma Bölümü -->
                <div class="mt-16 pt-12 border-t border-gray-100">
                    <h3 class="text-2xl font-bold text-[#062d34] mb-6">Yorum Yazın</h3>
                    <form action="../actions/save_blog_review.php" method="POST" class="space-y-4">
                        <input type="hidden" name="slug" value="<?php echo htmlspecialchars($slug); ?>">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ad Soyad</label>
                                <input type="text" name="customer_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none transition" placeholder="Adınızı giriniz">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                                <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none transition" placeholder="eposta@ornek.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mesajınız</label>
                            <textarea name="comment" required rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none transition" placeholder="Yorumunuzu buraya yazın..."></textarea>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors duration-300 shadow-md">
                                Gönder
                            </button>
                        </div>
                    </form>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="lg:w-80 space-y-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-lg mb-6 border-b pb-4">Diğer Yazılar</h4>
                    <div class="space-y-6">
                        <?php foreach($related as $r): ?>
                        <a href="blog-detail.php?slug=<?php echo $r['slug']; ?>" class="block group">
                            <img src="../assets/uploads/blog/<?php echo $r['image']; ?>" class="w-full h-32 object-cover rounded-xl mb-3">
                            <h5 class="font-bold text-[#062d34] group-hover:text-blue-600 transition"><?php echo htmlspecialchars($r['title']); ?></h5>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>


