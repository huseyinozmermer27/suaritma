<?php
// Ana sayfa şablonu
require_once '../app/Core/includes/header.php';

// Veritabanı bağlantısı
$db = \App\Core\Database::getInstance()->getConnection();

// Slider'ları çek
$sliders = $db->query("SELECT * FROM slider WHERE status = 1 ORDER BY sort_order ASC")->fetchAll();
$base_url = BASE_URL; 
?>

<!-- Modern Hero Slider -->
<section id="hero-slider" class="relative w-full h-[600px] md:h-[800px] overflow-hidden transition-all duration-1000 z-10">
    <div class="relative w-full h-full">
        <?php foreach ($sliders as $index => $s): ?>
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out flex items-center p-4 md:p-10 hero-slide <?php echo ($index === 0) ? 'active opacity-100' : 'opacity-0'; ?>" style="<?php echo ($index === 0) ? '' : 'visibility: hidden;'; ?>">
            <div class="absolute inset-4 md:inset-10 bg-cover bg-center rounded-3xl z-10" style="background-image: url('<?php echo $base_url; ?>../assets/img/slider/<?php echo htmlspecialchars($s['image']); ?>');"></div>
            <div class="absolute inset-4 md:inset-10 bg-black bg-opacity-40 rounded-3xl z-10"></div>
            <div class="container mx-auto h-full relative z-20 flex items-center">
                <div class="w-full lg:w-8/12 px-8 text-white max-w-lg drop-shadow-lg">
                    <span class="block text-sm font-semibold uppercase tracking-widest mb-4 opacity-90"><?php echo htmlspecialchars($s['subtitle']); ?></span>
                    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-8"><?php echo htmlspecialchars($s['title']); ?></h1>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- Slider Numaralı Butonlar -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex space-x-4 z-30">
        <?php foreach ($sliders as $index => $s): ?>
        <button class="slider-dot w-14 h-14 rounded-full border-2 border-white flex items-center justify-center text-white font-bold transition-all duration-300 hover:bg-white hover:text-black <?php echo ($index === 0) ? 'active bg-white text-black' : 'bg-opacity-20 text-white'; ?>" onclick="showSlide(<?php echo $index; ?>)"><?php echo $index + 1; ?></button>
        <?php endforeach; ?>
    </div>
</section>

<!-- Ürün Kategorileri Bölümü -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-center text-4xl font-extrabold mb-12">Ürün Gruplarımız</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="col-span-1">
                <a href="<?php echo $base_url; ?>../views/frontend/products/cihazlar.php" class="block relative overflow-hidden rounded-xl shadow-md transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform no-underline">
                    <div class="relative overflow-hidden rounded-xl">
                        <img src="https://sumosuaritma.com/cdn/shop/files/su-aritma-cihazi_home-natural_pompasiz-beyaz.jpg?v=1748425156&width=800" class="w-full h-auto object-cover transition-transform duration-600 ease-out hover:scale-110" alt="Su Arıtma Cihazları">
                    </div>
                    <div class="p-6 text-center">
                        <h5 class="text-xl font-bold text-gray-800 mb-2">Su Arıtma Cihazları</h5>
                        <p class="text-gray-600">Mutfağınızın yeni üyesi ile tanışın.</p>
                    </div>
                </a>
            </div>
            <div class="col-span-1">
                <a href="<?php echo $base_url; ?>../views/frontend/products/filtreler.php" class="block relative overflow-hidden rounded-xl shadow-md transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform no-underline">
                    <div class="relative overflow-hidden rounded-xl">
                        <img src="https://sumosuaritma.com/cdn/shop/files/su-aritma-filtre-seti_home-natural.jpg?v=1748425156&width=800" class="w-full h-auto object-cover transition-transform duration-600 ease-out hover:scale-110" alt="Su Arıtma Filtreleri">
                    </div>
                    <div class="p-6 text-center">
                        <h5 class="text-xl font-bold text-gray-800 mb-2">Su Arıtma Filtreleri</h5>
                        <p class="text-gray-600">Sürekli taze su için periyodik değişim.</p>
                    </div>
                </a>
            </div>
            <div class="col-span-1">
                <a href="<?php echo $base_url; ?>../views/frontend/products/aksesuarlar.php" class="block relative overflow-hidden rounded-xl shadow-md transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform no-underline">
                    <div class="relative overflow-hidden rounded-xl">
                        <img src="https://sumosuaritma.com/cdn/shop/files/yikanabilir-tekli-on-filtre_01.webp?v=1767694607&width=800" class="w-full h-auto object-cover transition-transform duration-600 ease-out hover:scale-110" alt="Yedek Parça ve Aksesuarlar">
                    </div>
                    <div class="p-6 text-center">
                        <h5 class="text-xl font-bold text-gray-800 mb-2">Yedek Parça ve Aksesuarlar</h5>
                        <p class="text-gray-600">İhtiyacınız olan her şey burada.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Müşteri Deneyim Videoları -->
<section class="py-16 bg-white overflow-hidden">
    <div class="container mx-auto px-4 mb-10 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Sizden Gelenler</h2>
    </div>
    <div class="container mx-auto px-4">
        <div class="flex gap-6 overflow-x-auto pb-8 custom-scrollbar">
            <?php
            function getYoutubeId($url) {
                preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                return $matches[1] ?? '';
            }

            $all_videos = $db->query("
                SELECT youtube_url as url, 'youtube' as source, sort_order 
                FROM videos WHERE type = 'customer' AND status = 1 
                UNION ALL 
                SELECT video_path as url, 'uploaded' as source, 0 as sort_order 
                FROM customer_reviews WHERE status = 1 AND video_path IS NOT NULL
                ORDER BY sort_order ASC
            ")->fetchAll();

            foreach ($all_videos as $v):
                if ($v['source'] == 'youtube'):
                    $vid = getYoutubeId($v['url']);
            ?>
            <div class="flex-none w-[260px] h-[400px] relative rounded-3xl overflow-hidden shadow-lg group">
                <iframe class="w-full h-full object-cover" src="https://www.youtube.com/embed/<?php echo $vid; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <?php else: ?>
            <div class="flex-none w-[260px] h-[400px] relative rounded-3xl overflow-hidden shadow-lg group">
                <video class="w-full h-full object-cover" controls>
                    <source src="<?php echo $base_url . $v['url']; ?>" type="video/mp4">
                </video>
            </div>
            <?php endif; endforeach; ?>
        </div>
    </div>
</section>

<!-- Videolu Ürün Tanıtımları -->
<section class="py-20 bg-gradient-to-b from-indigo-500 to-purple-600">
    <div class="container mx-auto px-4 mb-12 text-center">
        <h2 class="text-4xl font-extrabold text-white">Ürün Tanıtım Videoları</h2>
    </div>
    <div class="container mx-auto px-4">
        <div id="video-tanitim-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $product_videos = $db->query("SELECT *, DATE_FORMAT(created_at, '%d.%m.%Y') as formatted_date FROM videos WHERE type = 'product' AND status = 1 ORDER BY sort_order ASC")->fetchAll();

            foreach ($product_videos as $index => $video):
                $hidden_class = ($index >= 8) ? 'hidden' : '';
                $vid = getYoutubeId($video['youtube_url']);
            ?>
                <div class="video-card col-span-1 bg-white rounded-2xl shadow-lg border border-gray-100 flex flex-col <?php echo $hidden_class; ?>">
                    <div class="relative overflow-hidden rounded-t-2xl pb-[56.25%] h-0">
                        <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/<?php echo $vid; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="pt-4 pb-6 pl-8 pr-8 flex-grow flex flex-col">
                        <p class="text-gray-500 text-xs font-bold mb-2"><?php echo $video['formatted_date'] ?? date('d.m.Y'); ?></p>
                        <h5 class="text-xl font-bold text-gray-800 mb-2 leading-tight"><?php echo htmlspecialchars($video['title']); ?></h5>
                        <div class="text-gray-600 text-sm leading-relaxed overflow-hidden description-content" style="max-height: 4.5em;">
                            <?php echo $video['description']; ?>
                        </div>
                        <button class="read-more-btn text-indigo-600 text-xs font-bold mt-2 hover:underline cursor-pointer">Devamını Göster</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-10">
            <button id="show-more-videos" class="inline-flex items-center gap-2 text-white font-bold text-lg hover:text-white/80 transition-colors duration-300 no-underline group">
                Tüm Videoları Görüntüle 
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
</section>

<!-- Yazılı Müşteri Yorumları -->
<section class="py-16 bg-gray-50 overflow-hidden" id="text-carousel-wrapper">
    <div class="container mx-auto px-4 mb-10 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Müşteri Yorumları</h2>
    </div>
    <div class="w-full overflow-hidden pb-8">
        <div class="flex gap-6 animate-marquee-text w-max">
            <?php 
            $yorumlar = $db->query("
                SELECT id, customer_name, content as comment, rating, NULL as image_urls 
                FROM reviews WHERE status = 1 
                UNION ALL 
                SELECT id, customer_name, comment, rating, image_urls 
                FROM product_reviews WHERE status = 1 
                ORDER BY id DESC
            ")->fetchAll();

            if (!empty($yorumlar)):
                foreach ($yorumlar as $y): ?>
                    <div class="flex-none w-[350px] bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition-transform hover:shadow-lg">
                        <?php if (!empty($y['image_urls'])): 
                            $img = explode(',', $y['image_urls'])[0]; ?>
                            <div class="w-full h-40 bg-gray-50 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                                <img src="<?php echo htmlspecialchars(trim($img)); ?>" class="max-w-full max-h-full object-contain" alt="Müşteri Görseli">
                            </div>
                        <?php else: ?>
                            <img src="https://via.placeholder.com/350x200" class="w-full h-40 object-cover rounded-xl mb-4" alt="Müşteri Deneyimi">
                        <?php endif; ?>
                        
                        <div class="text-yellow-400 mb-2 flex">
                            <?php echo str_repeat('★', (int)$y['rating']); ?>
                        </div>
                        <h6 class="font-bold text-lg text-gray-900 mb-2 capitalize">Müşteri Yorumu</h6>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">"<?php echo htmlspecialchars($y['comment']); ?>"</p>
                        <div class="flex flex-col gap-1 mt-6">
                            <div class="flex items-center gap-2">
                                <span class="text-green-500">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M9 12l2 2 4-4"></path>
                                    </svg>
                                </span>
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900 text-sm"><?php echo htmlspecialchars($y['customer_name']); ?></span>
                                    <span class="text-green-600 text-xs font-semibold">Doğrulanmış Müşteri</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; 
            else:
                echo '<p class="text-center text-gray-500">Henüz onaylı yorum bulunmuyor.</p>';
            endif; ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Slider JS
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.slider-dot');
        const heroSlider = document.getElementById('hero-slider');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = (i === index) ? '1' : '0';
                slide.style.visibility = (i === index) ? 'visible' : 'hidden';
                dots[i].classList.toggle('active', i === index);
                dots[i].classList.toggle('bg-white', i === index);
                dots[i].classList.toggle('text-black', i === index);
                dots[i].classList.toggle('bg-opacity-20', i !== index);
                dots[i].classList.toggle('text-white', i !== index);
            });
            currentSlide = index;
        }
        window.showSlide = showSlide; // Expose to global scope
        showSlide(0);
        setInterval(() => {
            showSlide((currentSlide + 1) % slides.length);
        }, 8000);

        // Video göster
        const showMoreBtn = document.getElementById('show-more-videos');
        if (showMoreBtn) {
            showMoreBtn.addEventListener('click', function() {
                document.querySelectorAll('.video-card.hidden').forEach(el => el.classList.remove('hidden'));
                this.style.display = 'none';
            });
        }

        // Açıklama göster/gizle
        document.querySelectorAll('.read-more-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const desc = this.previousElementSibling;
                if (desc.style.maxHeight !== 'none') {
                    desc.style.maxHeight = 'none';
                    this.textContent = 'Daha Az Göster';
                } else {
                    desc.style.maxHeight = '4.5em';
                    this.textContent = 'Devamını Göster';
                }
            });
        });
    });
</script>

<?php
// Footer'ı dahil et
require_once '../app/Core/includes/footer.php';
?>


