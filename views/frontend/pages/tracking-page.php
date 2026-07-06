<?php include '../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Başlık Bölümü -->
        <div class="w-full flex justify-center mb-10">
            <h1 class="text-4xl font-bold text-secondary">Gönderi Takip Sayfası</h1>
        </div>
        
        <!-- Arama Formu -->
        <div class="flex justify-center mb-16">
            <div class="w-full max-w-4xl flex flex-col md:flex-row gap-4 items-start">
                <div class="w-full">
                    <input
                        name="order_id"
                        type="text"
                        class="border border-gray-300 rounded-lg p-2 w-full leading-none focus:outline-none focus:ring-1 focus:ring-primary text-base"
                        placeholder="Sipariş numaranızı giriniz."
                    >
                </div>
                <div class="w-full">
                    <input
                        name="email"
                        type="email"
                        class="border border-gray-300 rounded-lg p-2 w-full leading-none focus:outline-none focus:ring-1 focus:ring-primary text-base"
                        placeholder="E-posta adresinizi giriniz"
                    >
                </div>
                <div class="w-full md:w-auto">
                    <button class="bg-black text-white py-2 px-4 rounded-lg w-full md:w-max cursor-pointer font-bold hover:bg-gray-800 transition-colors text-base whitespace-nowrap">
                        Gönderiyi Takip Et
                    </button>
                </div>
            </div>
        </div>

        <!-- Takip Durumu Görünümü (Örnek/Statik) -->
        <div class="mt-16 bg-gray-50 p-8 rounded-2xl border border-gray-100">
            <div class="mb-10">
                <h3 class="text-xl font-bold text-secondary mb-6">#SUM12345 No'lu Gönderi Durumu</h3>
                
                <!-- Durum Çubuğu -->
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-6">
                    <div class="bg-green-500 h-2.5 rounded-full w-2/5"></div>
                </div>
                
                <!-- Durum İkonları ve Etiketleri -->
                <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-green-100 text-green-600 mb-2">
                            <i class="fa-solid fa-box-open text-lg"></i>
                        </div>
                        <span class="text-[10px] md:text-xs font-bold">Gönderime Hazır</span>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-green-100 text-green-600 mb-2">
                            <i class="fa-solid fa-truck-fast text-lg"></i>
                        </div>
                        <span class="text-[10px] md:text-xs font-bold">Yola Çıktı</span>
                    </div>
                    <div class="flex flex-col items-center text-center opacity-40">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 mb-2">
                            <i class="fa-solid fa-route text-lg"></i>
                        </div>
                        <span class="text-[10px] md:text-xs">Taşıma Sürecinde</span>
                    </div>
                    <div class="flex flex-col items-center text-center opacity-40">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 mb-2">
                            <i class="fa-solid fa-warehouse text-lg"></i>
                        </div>
                        <span class="text-[10px] md:text-xs">Dağıtım Merkezinde</span>
                    </div>
                    <div class="flex flex-col items-center text-center opacity-40">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 mb-2">
                            <i class="fa-solid fa-truck-ramp-box text-lg"></i>
                        </div>
                        <span class="text-[10px] md:text-xs">Dağıtıma Çıktı</span>
                    </div>
                    <div class="flex flex-col items-center text-center opacity-40">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 mb-2">
                            <i class="fa-solid fa-house-chimney-check text-lg"></i>
                        </div>
                        <span class="text-[10px] md:text-xs">Teslim Edildi</span>
                    </div>
                </div>
            </div>

            <!-- Bilgi Kartları -->
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-secondary mb-4 flex items-center">
                        <i class="fa-solid fa-location-dot mr-2"></i> Adres Bilgileri
                    </h4>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><span class="font-semibold text-secondary">Müşteri:</span> Ahmet Yılmaz</p>
                        <p><span class="font-semibold text-secondary">Telefon:</span> 05XX XXX XX XX</p>
                        <p><span class="font-semibold text-secondary">Adres:</span> Örnek Mah. Yeni Cad. No:1 D:5</p>
                        <p><span class="font-semibold text-secondary">İl/İlçe:</span> İstanbul / Kadıköy</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-secondary mb-4 flex items-center">
                        <i class="fa-solid fa-box mr-2"></i> Ürün Bilgileri
                    </h4>
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                            <img src="<?php echo $base_url; ?>sumosu.jpg" alt="Ürün" class="object-cover w-full h-full">
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-secondary">Sumosu Elite Su Arıtma Cihazı</p>
                            <p class="text-gray-500">Adet: 1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center text-sm text-gray-500">
            <p>Takip numaranız, siparişiniz kargoya verildiğinde e-posta adresinize gönderilmiştir.</p>
        </div>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>


