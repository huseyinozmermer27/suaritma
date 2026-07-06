<?php
header('Content-Type: text/html; charset=UTF-8');
// Proje kök dizini (Config dosyasından BASE_URL'i kullanıyoruz)
require_once __DIR__ . '/../../../config/config.php';
$base_url = BASE_URL; // http://localhost/suaritma/public/

// Veritabanını dahil et
require_once __DIR__ . '/db.php';

// Ayarları çek
$settings = [];
$stmt = $db->query("SELECT s_key, s_value FROM settings");
while ($row = $stmt->fetch()) {
    $settings[$row['s_key']] = $row['s_value'];
}
$marquee_items = json_decode($settings['marquee_items'] ?? '[]', true);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($settings['site_title'] ?? 'Sumosu Su Arıtma'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { theme: { extend: { colors: { primary: '#0088b5', secondary: '#062d34' } } } }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- Kayan Yazı -->
<div class="bg-black text-white py-3 text-sm font-medium tracking-wider overflow-hidden relative z-30 w-full">
    <div class="marquee-container w-full overflow-hidden flex">
        <div class="marquee-inner flex whitespace-nowrap animate-marquee-scroll">
            <?php for($i=0; $i<3; $i++): // 3 kere tekrarla ki boşluk kalmasın ?>
                <?php foreach ($marquee_items as $item): ?>
                    <span class="inline-block px-8"><?php echo htmlspecialchars($item); ?></span>
                    <span class="mx-5 font-bold">•</span>
                <?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>
</div>

<style>
    @keyframes marquee-scroll { 
        0% { transform: translateX(0); } 
        100% { transform: translateX(-33.33%); } 
    }
    .animate-marquee-scroll { 
        animation: marquee-scroll 20s linear infinite; 
    }
</style>


<header class="bg-white shadow-sm sticky top-0 z-20 transition-all duration-300">
    <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between py-5">
            <a href="<?php echo $base_url; ?>">
                <img src="<?php echo $base_url; ?>../assets/logo/optimal-su-aritma-sistemleri.png" class="h-12 w-auto">
            </a>

            <!-- STATİK MENÜ -->
            <ul class="flex list-none m-0 p-0 flex-grow justify-center items-center gap-2">
                <!-- Ürünler -->
                <li class="relative group">
                    <a href="javascript:void(0)" class="text-gray-700 no-underline text-sm lg:text-base font-medium py-4 px-4 hover:text-gray-900 flex items-center">
                        Ürünler <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    <ul class="absolute top-[90%] left-0 bg-white min-w-[200px] shadow-lg p-3 pt-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all rounded-md z-50">
                        <li><a href="<?php echo $base_url; ?>../views/frontend/products/cihazlar.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">Cihazlar</a></li>
                        <li><a href="<?php echo $base_url; ?>../views/frontend/products/filtreler.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">Filtreler</a></li>
                        <li><a href="<?php echo $base_url; ?>../views/frontend/products/aksesuarlar.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">Aksesuarlar</a></li>
                    </ul>
                </li>
                <!-- Karşılaştırma -->
                <li><a href="<?php echo $base_url; ?>../views/frontend/pages/pompali-mi-pompasiz-mi.php" class="text-gray-700 no-underline text-sm lg:text-base font-medium py-4 px-4 hover:text-gray-900">Karşılaştırma</a></li>
                <!-- 100 Gün İade -->
                <li><a href="<?php echo $base_url; ?>../views/frontend/pages/su-aritma-cihazi-iade-ve-degisim.php" class="text-gray-700 no-underline text-sm lg:text-base font-medium py-4 px-4 hover:text-gray-900">100 Gün İade</a></li>
                <!-- Müşteri Yorumları -->
                <li><a href="<?php echo $base_url; ?>../views/frontend/pages/su-aritma-cihazi-yorumlari.php" class="text-gray-700 no-underline text-sm lg:text-base font-medium py-4 px-4 hover:text-gray-900">Müşteri Yorumları</a></li>
                <!-- Blog -->
                <li><a href="<?php echo $base_url; ?>../views/frontend/blogs/blog.php" class="text-gray-700 no-underline text-sm lg:text-base font-medium py-4 px-4 hover:text-gray-900">Blog</a></li>
                <!-- Destek -->
                <li class="relative group">
                    <a href="javascript:void(0)" class="text-gray-700 no-underline text-sm lg:text-base font-medium py-4 px-4 hover:text-gray-900 flex items-center">
                        Destek <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    <ul class="absolute top-[90%] left-0 bg-white min-w-[200px] shadow-lg p-3 pt-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all rounded-md z-50">
                        <li><a href="<?php echo $base_url; ?>../views/frontend/pages/tracking-page.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">Gönderi Takibi</a></li>
                        <li><a href="<?php echo $base_url; ?>../views/frontend/pages/sik-sorulan-sorular.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">SSS</a></li>
                        <li><a href="<?php echo $base_url; ?>../views/frontend/pages/montaj-talebi.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">Montaj</a></li>
                        <li><a href="<?php echo $base_url; ?>../views/frontend/pages/ariza-bildirimi.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">Arıza</a></li>
                        <li><a href="<?php echo $base_url; ?>../views/frontend/pages/iade-talebi.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">İade</a></li>
                        <li><a href="<?php echo $base_url; ?>../views/frontend/pages/iletisim.php" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded text-sm">İletişim</a></li>
                    </ul>
                </li>
            </ul>

            <!-- İkonlar -->
            <div class="flex gap-5 items-center">
                <button id="search-btn" class="text-gray-700 text-lg hover:text-gray-900 transition-colors"><i class="fas fa-search"></i></button>
                <a href="<?php echo $base_url; ?>../app/Migrations/login.php" class="text-gray-700 text-lg hover:text-gray-900 transition-colors"><i class="fas fa-user"></i></a>
                <a href="<?php echo $base_url; ?>../app/Migrations/sepet.php" class="text-gray-700 text-lg hover:text-gray-900 transition-colors"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </nav>
    </div>
    
    <!-- Modern Arama Çubuğu -->
    <div id="search-bar" class="bg-white border-b border-gray-200 max-h-0 overflow-hidden transition-all duration-300 ease-in-out shadow-sm">
        <div class="container mx-auto px-4 py-3">
            <form action="<?php echo $base_url; ?>../index.php" method="GET" class="max-w-3xl mx-auto">
                <input type="text" name="s" placeholder="Ürünlerde arayın..." class="w-full p-2.5 rounded-md border-2 border-primary focus:border-secondary outline-none text-sm bg-white">
            </form>
        </div>
    </div>
</header>

<script>
    const searchBtn = document.getElementById('search-btn');
    const searchBar = document.getElementById('search-bar');

    searchBtn.addEventListener('click', () => {
        if (searchBar.style.maxHeight && searchBar.style.maxHeight !== '0px') {
            searchBar.style.maxHeight = '0px';
        } else {
            searchBar.style.maxHeight = searchBar.scrollHeight + "px";
        }
    });
</script>
