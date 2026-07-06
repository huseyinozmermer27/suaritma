<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli - Optimal Su Arıtma</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #1f2937; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #4b5563; border-radius: 3px; }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 h-screen text-white fixed flex flex-col">
        <div class="p-6">
            <a href="index.php" class="text-2xl font-bold">Optimal Admin</a>
        </div>
        
        <div class="flex-1 overflow-y-auto p-4 custom-scrollbar">
            <nav class="space-y-2">
                <a href="index.php?page=dashboard" class="flex items-center p-2 hover:bg-gray-800 rounded transition"><i class="bi bi-speedometer2 mr-3"></i> Dashboard</a>
                
                <!-- Ürün Yönetimi -->
                <div>
                    <button onclick="toggleAccordion('urun-menu')" class="w-full flex items-center justify-between p-2 hover:bg-gray-800 rounded transition text-gray-300">
                        <span class="flex items-center"><i class="bi bi-box-seam mr-3"></i> Ürün Yönetimi</span>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>
                    <div id="urun-menu" class="hidden mt-2 space-y-1 border-l border-gray-700 ml-3 pl-3">
                        <a href="index.php?page=products" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Tüm Ürünler</a>
                        <a href="index.php?page=product_add" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Ürün Ekle</a>
                        <a href="index.php?page=categories" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Kategoriler</a>
                        <a href="index.php?page=blog" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Blog Yönetimi</a>
                    </div>
                </div>

                <a href="index.php?page=orders" class="flex items-center p-2 hover:bg-gray-800 rounded transition"><i class="bi bi-cart3 mr-3"></i> Siparişler</a>
                
                <!-- İçerik & Kurumsal -->
                <div>
                    <button onclick="toggleAccordion('icerik-menu')" class="w-full flex items-center justify-between p-2 hover:bg-gray-800 rounded transition text-gray-300">
                        <span class="flex items-center"><i class="bi bi-file-earmark-text mr-3"></i> İçerik & Kurumsal</span>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>
                    <div id="icerik-menu" class="hidden mt-2 space-y-1 border-l border-gray-700 ml-3 pl-3">
                        <a href="index.php?page=pages" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Sayfalar</a>
                        <a href="index.php?page=contact_messages" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">İletişim Mesajları</a>
                        <a href="index.php?page=blog" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Blog Yönetimi</a>
                        <a href="index.php?page=iade_talepleri" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">İade Talebi</a>
                        <a href="index.php?page=ariza_bildirimleri" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Arıza Bildirimi</a>
                        <a href="index.php?page=montaj_talepleri" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Montaj Talebi</a>
                    </div>
                </div>

                <!-- Hukuki Metinler -->
                <div>
                    <button onclick="toggleAccordion('hukuki-menu')" class="w-full flex items-center justify-between p-2 hover:bg-gray-800 rounded transition text-gray-300">
                        <span class="flex items-center"><i class="bi bi-shield-check mr-3"></i> Hukuki Metinler</span>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>
                    <div id="hukuki-menu" class="hidden mt-2 space-y-1 border-l border-gray-700 ml-3 pl-3">
                        <a href="index.php?page=page_edit&id=teslimat" class="block p-2 text-xs text-gray-400 hover:text-blue-400 transition">Teslimat Politikası</a>
                        <a href="index.php?page=page_edit&id=iade" class="block p-2 text-xs text-gray-400 hover:text-blue-400 transition">İade ve Değişim</a>
                        <a href="index.php?page=page_edit&id=kvkk" class="block p-2 text-xs text-gray-400 hover:text-blue-400 transition">KVKK</a>
                        <a href="index.php?page=page_edit&id=aydinlatma" class="block p-2 text-xs text-gray-400 hover:text-blue-400 transition">Aydınlatma Metni</a>
                        <a href="index.php?page=page_edit&id=sartlar" class="block p-2 text-xs text-gray-400 hover:text-blue-400 transition">Hizmet Şartları</a>
                        <a href="index.php?page=page_edit&id=sozlesme" class="block p-2 text-xs text-gray-400 hover:text-blue-400 transition">Mesafeli Satış Söz.</a>
                    </div>
                </div>

                <!-- Yorumlar -->
                <div>
                    <button onclick="toggleAccordion('yorumlar-menu')" class="w-full flex items-center justify-between p-2 hover:bg-gray-800 rounded transition text-gray-300">
                        <span class="flex items-center"><i class="bi bi-chat-dots mr-3"></i> Yorumlar</span>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>
                    <div id="yorumlar-menu" class="hidden mt-2 space-y-1 border-l border-gray-700 ml-3 pl-3">
                        <a href="index.php?page=product_videos" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Ürün Videoları</a>
                        <a href="index.php?page=customer_videos" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Müşteri Videoları</a>
                        <a href="index.php?page=customer_reviews" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Müşteri Yorumları</a>
                    </div>
                </div>

                <a href="index.php?page=sliders" class="flex items-center p-2 hover:bg-gray-800 rounded transition"><i class="bi bi-images mr-3"></i> Slider Yönetimi</a>
                
                <!-- Site Yönetimi -->
                <div>
                    <button onclick="toggleAccordion('site-management')" class="w-full flex items-center justify-between p-2 hover:bg-gray-800 rounded transition text-gray-300">
                        <span class="flex items-center"><i class="bi bi-gear mr-3"></i> Site Yönetimi</span>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>
                    <div id="site-management" class="hidden mt-2 space-y-1 border-l border-gray-700 ml-3 pl-3">
                        <a href="index.php?page=settings_marquee" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Header Ayarları</a>
                        <a href="index.php?page=menus" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Menü Yönetimi</a>
                        <a href="index.php?page=settings_footer_text" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Footer Ayarları</a>
                        <a href="index.php?page=settings_social" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Sosyal Medya</a>
                        <a href="index.php?page=settings_compare" class="block p-2 text-sm text-gray-400 hover:text-blue-400 transition">Karşılaştırma Ayarları</a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="p-4 border-t border-gray-800">
            <a href="logout.php" class="flex items-center p-2 bg-red-900/30 hover:bg-red-800 rounded text-red-300 transition">
                <i class="bi bi-box-arrow-right mr-3"></i> Çıkış Yap
            </a>
        </div>
    </aside>

    <!-- Content -->
    <main class="ml-64 p-8 w-full min-h-screen">
        <script>
            function toggleAccordion(id) {
                const el = document.getElementById(id);
                el.classList.toggle('hidden');
            }
        </script>
