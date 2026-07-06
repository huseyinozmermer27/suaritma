<?php include '../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-3xl">
        <h1 class="text-4xl font-bold text-secondary mb-12 text-center">Belgelerimiz ve Sertifikalarımız</h1>
        
        <div class="space-y-12">
            <?php
            // Sertifika verileri
            $certificates = [
                ['name' => 'CE Sertifikası', 'desc' => 'Ürünlerimizin Avrupa Birliği standartlarına uygunluğunu ve yüksek güvenlik seviyesini belgeleyen sertifikadır.', 'img' => 'ce.png'],
                ['name' => 'SGS Sertifikası', 'desc' => 'Dünya çapında kabul gören SGS denetimlerinde, ürün kalitemiz ve üretim süreçlerimiz onaylanmıştır.', 'img' => 'sgs.png'],
                ['name' => 'NSF Belgesi', 'desc' => 'Su arıtma sistemlerinde hijyen ve performans standartlarının uluslararası düzeyde kanıtı olan NSF sertifikasına sahibiz.', 'img' => 'nsf.png'],
                ['name' => 'WQA Belgesi', 'desc' => 'Water Quality Association tarafından verilen, su kalitesi ve cihaz performansındaki mükemmeliyetin belgesidir.', 'img' => 'wqa.png'],
                ['name' => 'FDA Belgesi', 'desc' => 'Cihazlarımızda kullanılan tüm malzemelerin insan sağlığına uygun, güvenli materyaller olduğunu teyit eden FDA onaylıdır.', 'img' => 'fda.png'],
            ];

            foreach ($certificates as $cert):
            ?>
            <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
                <h3 class="text-2xl font-bold mb-6 text-primary"><?php echo $cert['name']; ?></h3>
                <div class="mb-6 flex justify-center">
                    <!-- Resimler için uygun yolu BASE_URL ile belirleyelim -->
                    <img src="<?php echo BASE_URL; ?>../assets/img/certificates/<?php echo $cert['img']; ?>" 
                         alt="<?php echo $cert['name']; ?>" 
                         class="h-40 object-contain"
                         onerror="this.src='https://via.placeholder.com/200x150?text=Sertifika+Görseli'">
                </div>
                <p class="text-gray-600 text-lg"><?php echo $cert['desc']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>
