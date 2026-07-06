<?php include '../../../app/Core/includes/header.php'; 
require_once '../../../app/Core/includes/db.php';

// Öne çıkan blog
$featured = $db->query("SELECT * FROM blog WHERE is_featured = 1 ORDER BY created_at DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);

// Diğer bloglar
$blogs = $db->query("SELECT * FROM blog WHERE is_featured = 0 ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-6xl font-bold text-[#062d34] mb-4">Sumosu Blog</h1>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
            <p class="text-gray-500 mt-6 max-w-2xl mx-auto text-lg">Su arıtma sistemleri, sağlık ve yaşam kaliteniz hakkında en güncel bilgileri uzman ekibimizden öğrenin.</p>
        </div>
        
        <?php if ($featured): ?>
        <!-- Öne Çıkan Blog -->
        <article class="group bg-white rounded-[2rem] overflow-hidden shadow-xl border border-gray-100 mb-20 flex flex-col md:flex-row hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
            <div class="md:w-1/2 overflow-hidden">
            <a href="blog-detail.php?slug=<?php echo $featured['slug']; ?>" class="block h-full">
                <img src="/suaritma/assets/uploads/blog/<?php echo $featured['image']; ?>" alt="<?php echo htmlspecialchars($featured['title']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            </a>
            </div>
            <div class="md:w-1/2 p-8 md:p-16 flex flex-col justify-center">
                <div class="mb-4">
                    <span class="bg-blue-100 text-blue-600 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Öne Çıkan Yazı</span>
                </div>
                <a href="blog-detail.php?slug=<?php echo $featured['slug']; ?>">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#062d34] mb-6 leading-tight group-hover:text-primary transition-colors duration-300"><?php echo htmlspecialchars($featured['title']); ?></h2>
                </a>
                <p class="text-gray-600 text-lg mb-8 line-clamp-3 leading-relaxed">
                    <?php echo strip_tags($featured['description'] ?? ''); ?>
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm font-medium"><?php echo date('d M Y', strtotime($featured['created_at'])); ?></span>
                    <a href="blog-detail.php?slug=<?php echo $featured['slug']; ?>" class="inline-flex items-center text-primary font-bold hover:gap-2 transition-all duration-300">
                        Devamını Oku <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
        </article>
        <?php endif; ?>

        <!-- Diğer Bloglar (3'lü Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php foreach($blogs as $blog): ?>
            <article class="group bg-white rounded-[2rem] overflow-hidden shadow-md border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col">
                <div class="relative overflow-hidden aspect-video">
                    <a href="blog-detail.php?slug=<?php echo $blog['slug']; ?>">
                        <img src="/suaritma/assets/uploads/blog/<?php echo $blog['image']; ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </a>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="flex-grow">
                        <a href="blog-detail.php?slug=<?php echo $blog['slug']; ?>">
                            <h3 class="text-xl font-bold text-[#062d34] mb-3 group-hover:text-primary transition-colors duration-300 leading-snug"><?php echo htmlspecialchars($blog['title']); ?></h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2 leading-relaxed">
                            <?php echo strip_tags($blog['description'] ?? ''); ?>
                        </p>
                    </div>
                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                        <span class="text-gray-400 text-xs font-medium"><?php echo date('d M Y', strtotime($blog['created_at'])); ?></span>
                        <a href="blog-detail.php?slug=<?php echo $blog['slug']; ?>" class="text-primary text-xs font-bold hover:underline">Okuyun &rarr;</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>



