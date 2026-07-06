<?php include '../../../app/Core/includes/header.php'; ?>

<main>
    <!-- Header Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center max-w-4xl">
            <h1 class="text-4xl md:text-5xl font-bold text-[#062d34] mb-6">Su Arıtma Cihazı Yorumları</h1>
            <div class="prose prose-lg mx-auto text-[#062d34]">
                <p>Aileniz için en iyi su arıtma cihazını seçmek için gerçek kullanıcı yorumlarını duymaya ihtiyacınız olabilir diye düşündük.</p>
                <p>İşte Sumosu kullanıcılarının su arıtma cihazı hakkındaki yorumları burada.</p>
            </div>
        </div>
    </section>

    <!-- Video Yorumlar Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <h2 class="text-3xl font-bold text-[#062d34] mb-8">Sizden Gelenler</h2>
            
            <div class="flex overflow-x-auto gap-6 pb-8 custom-scrollbar">
                <?php
                function getYoutubeId($url) {
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    return $matches[1] ?? '';
                }
                
                // Hem YouTube hem Yüklenen Videoları birleştir
                $all_videos = $db->query("
                    SELECT youtube_url as url, 'youtube' as source, sort_order 
                    FROM videos WHERE type = 'customer' AND status = 1 
                    UNION ALL 
                    SELECT video_path as url, 'uploaded' as source, 0 as sort_order 
                    FROM customer_reviews WHERE status = 1 AND video_path IS NOT NULL
                    ORDER BY sort_order ASC
                ")->fetchAll();
                
                if (!empty($all_videos)):
                    foreach($all_videos as $v):
                        if ($v['source'] == 'youtube'):
                            $vid = getYoutubeId($v['url']);
                ?>
                <div class="flex-none w-[260px] h-[460px] bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                    <iframe src="https://www.youtube.com/embed/<?php echo $vid; ?>" 
                            class="w-full h-full" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                </div>
                <?php else: ?>
                <div class="flex-none w-[260px] h-[460px] bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                    <video class="w-full h-full object-cover" controls>
                        <source src="<?php echo $base_url . $v['url']; ?>" type="video/mp4">
                    </video>
                </div>
                <?php endif; 
                    endforeach; 
                else:
                    echo '<p class="text-gray-500">Henüz video eklenmemiş.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Tum Degerlendirmeler Widget -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="bg-white shadow-lg p-8 rounded-2xl border border-gray-100">
                <div class="flex flex-col md:flex-row gap-8 items-center justify-center">
                    <!-- Sol: Özet -->
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#062d34] mb-1">4.91</div>
                        <div class="flex justify-center text-yellow-400 text-xl mb-1">★★★★★</div>
                        <p class="text-gray-500 text-sm font-medium">1834 yorum üzerinden</p>
                    </div>
                    <!-- Sağ: Çubuklar -->
                    <div class="w-full md:w-80 space-y-2">
                        <?php 
                        $ratings = [5 => 96, 4 => 3, 3 => 1, 2 => 0, 1 => 0];
                        foreach($ratings as $star => $percent): ?>
                        <div class="flex items-center gap-3">
                            <div class="flex text-yellow-400 w-24 text-xs"><?php echo str_repeat('★', $star); ?></div>
                            <div class="flex-grow h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-[#00beba]" style="width: <?php echo $percent; ?>%"></div>
                            </div>
                            <div class="w-10 text-xs text-gray-600 font-bold"><?php echo $percent; ?>%</div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Müşteri Yorumları -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Değerlendirme Özeti -->
        <div class="mb-12 border-b border-gray-200 pb-6 text-center">
            <h2 class="text-3xl font-bold text-[#062d34] mb-4">Tüm Değerlendirmeler</h2>
            <div class="flex flex-col items-center gap-2">
                <div class="text-4xl font-bold text-[#062d34]">4.9</div>
                <div class="flex justify-center text-yellow-400 text-xl">★★★★★</div>
                <p class="text-gray-500 text-sm font-medium">Veritabanındaki gerçek müşteri yorumları</p>
            </div>
        </div>

        <!-- Müşteri Yorumları Carousel -->
        <div class="flex overflow-x-auto gap-6 pb-8 custom-scrollbar">
            <?php
            // Hem düz yorumları hem de fotoğraflı yorumları birleştiriyoruz
            $reviews = $db->query("
                SELECT customer_name, content as comment, rating, NULL as image_urls, 'text' as type 
                FROM reviews WHERE status = 1 
                UNION ALL 
                SELECT customer_name, comment, rating, image_urls, 'photo' as type 
                FROM product_reviews WHERE status = 1 
                ORDER BY rating DESC
            ")->fetchAll();
            
            foreach($reviews as $rev):
                $initial = mb_substr($rev['customer_name'], 0, 1, 'UTF-8');
            ?>
            <div class="flex-none w-[300px] min-h-[350px] bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col gap-4 transition-transform hover:shadow-lg">
                <!-- Header: Avatar, İsim, Tarih -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl uppercase shadow-inner">
                        <?php echo htmlspecialchars($initial); ?>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1">
                            <h4 class="font-bold text-gray-900"><?php echo htmlspecialchars($rev['customer_name']); ?></h4>
                            <span class="text-green-500"><i class="fas fa-check-circle text-xs"></i></span>
                        </div>
                        <span class="text-xs text-gray-400">Doğrulanmış Müşteri</span>
                    </div>
                </div>

                <!-- Yıldızlar -->
                <div class="flex text-orange-400 text-sm">
                    <?php 
                    $rating = (int)$rev['rating'];
                    echo str_repeat('<i class="fas fa-star"></i>', $rating);
                    echo str_repeat('<i class="far fa-star"></i>', 5 - $rating);
                    ?>
                </div>

                <!-- Yorum İçeriği -->
                <p class="text-gray-600 text-sm leading-relaxed flex-grow">"<?php echo htmlspecialchars($rev['comment']); ?>"</p>

                <!-- Resim Galerisi (Sadece resim verisi varsa göster) -->
                <?php if (!empty($rev['image_urls'])): 
                    $images = explode(',', $rev['image_urls']);
                ?>
                <div class="grid grid-cols-3 gap-2 mt-2">
                    <?php foreach ($images as $img): ?>
                        <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                            <img src="<?php echo $base_url . htmlspecialchars(trim($img)); ?>" class="max-w-full max-h-full object-contain">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</main>

<style>
.custom-scrollbar::-webkit-scrollbar {
    height: 8px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #062d34;
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #0088b5;
}
</style>

<?php include '../../../app/Core/includes/footer.php'; ?>


