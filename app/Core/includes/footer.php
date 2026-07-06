<footer class="bg-white text-gray-900 border-t border-gray-100">
  
          <!-- İkonlu Özellikler Bölümü -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Ücretsiz Kargo -->
            <div class="flex flex-col items-center text-center">
                <div class="mb-4 text-gray-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <h6 class="text-lg font-bold mb-2">Ücretsiz Kargo</h6>
                <p class="text-sm text-gray-600">Tüm ürünlerde 81 ilimize hızlı ve ücretsiz kargo ile teslimat.</p>
            </div>
            <!-- 12 Taksit -->
            <div class="flex flex-col items-center text-center">
                <div class="mb-4 text-gray-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m4 0h1m-7 3h12M3 6h18a1 1 0 011 1v10a1 1 0 01-1 1H3a1 1 0 01-1-1V7a1 1 0 011-1z"></path></svg>
                </div>
                <h6 class="text-lg font-bold mb-2">12 Taksit İmkânı</h6>
                <p class="text-sm text-gray-600">Tüm kredi kartlarına uygun vade oranları ile taksitli ödeme.</p>
            </div>
            <!-- Müşteri Desteği -->
            <div class="flex flex-col items-center text-center">
                <div class="mb-4 text-gray-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636a9 9 0 100 12.728M15 9a3 3 0 100 6M9 12h.01"></path></svg>
                </div>
                <h6 class="text-lg font-bold mb-2">Müşteri Desteği</h6>
                <p class="text-sm text-gray-600">Sorularınız ve destek talepleriniz için ekibimiz hizmetinizde.</p>
            </div>
            <!-- Güvenli Ödeme -->
            <div class="flex flex-col items-center text-center">
                <div class="mb-4 text-gray-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h6 class="text-lg font-bold mb-2">Güvenli Ödeme</h6>
                <p class="text-sm text-gray-600">iyzico ödeme altyapısı sayesinde kredi kartınız güvende.</p>
            </div>
        </div>
    </div>
</section>
<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="col-span-1">
            <h5 class="text-lg font-bold mb-6"><?php echo htmlspecialchars($settings['footer_title'] ?? 'Yardıma mı ihtiyacınız var?'); ?></h5>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                <?php 
                if (!empty($settings['footer_text'])) {
                    echo nl2br(htmlspecialchars($settings['footer_text']));
                } else {
                    echo "Müşteri hizmetlerimize destek@sumosuaritma.com e-posta adresinden ulaşabilir veya 0850 532 58 32 numaralı telefonu arayabilirsiniz.";
                }
                ?>
            </p>
        </div>
        <div class="col-span-1">
            <h5 class="text-lg font-bold mb-6">Ürünler</h5>
            <ul class="space-y-3 text-sm text-gray-600">
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/products/cihazlar.php" class="hover:text-black">Su Arıtma Cihazları</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/products/filtreler.php" class="hover:text-black">Su Arıtma Filtreleri</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/products/aksesuarlar.php" class="hover:text-black">Su Arıtma Yedek Parça ve Aksesuarları</a></li>
            </ul>
        </div>

        <div class="col-span-1">
            <h5 class="text-lg font-bold mb-6">Müşteri Hizmetleri</h5>
            <ul class="space-y-3 text-sm text-gray-600">
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/sik-sorulan-sorular.php" class="hover:text-black">Sık Sorulan Sorular</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/su-aritma-cihazi-yorumlari.php" class="hover:text-black">Müşteri Yorumları</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/montaj-talebi.php" class="hover:text-black">Montaj Talebi</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/ariza-bildirimi.php" class="hover:text-black">Arıza Bildirimi</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/iade-talebi.php" class="hover:text-black">İade Talebi</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/iletisim.php" class="hover:text-black">İletişim</a></li>
            </ul>
        </div>

        <div class="col-span-1">
            <h5 class="text-lg font-bold mb-6">Diğer</h5>
            <ul class="space-y-3 text-sm text-gray-600">
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>app/Migrations/hakkimizda.php" class="hover:text-black">Hakkımızda</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/teslimat-politikasi.php" class="hover:text-black">Teslimat Politikası</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/su-aritma-cihazi-iade-ve-degisim.php" class="hover:text-black">İade ve Değişim Politikası</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/kisisel-verilerin-korunmasi-ve-islenmesi-politikasi.php" class="hover:text-black">Kişisel Verilerin Korunması</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/aydinlatma-metni.php" class="hover:text-black">Aydınlatma Metni</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/kullanim-sartlari.php" class="hover:text-black">Hizmet Şartları</a></li>
                <li><a href="<?php echo str_replace('public/', '', $base_url); ?>views/frontend/pages/mesafeli-satis-sozlesmesi.php" class="hover:text-black">Mesafeli Satış Sözleşmesi</a></li>
            </ul>
        </div>
    </div>
        <div class="mt-12 pt-8 border-t border-gray-100 text-center">
            <img src="<?php echo $base_url; ?>assets/logo/logo_band_color.png" alt="Ödeme Yöntemleri" class="mx-auto h-8 mb-6">
            
            <!-- Sosyal Medya İkonları -->
            <div class="flex justify-center gap-6 mb-6">
                <a href="<?php echo htmlspecialchars($settings['social_facebook'] ?? '#'); ?>" target="_blank" class="text-gray-400 hover:text-blue-600 transition"><i class="fab fa-facebook text-2xl"></i></a>
                <a href="<?php echo htmlspecialchars($settings['social_twitter'] ?? '#'); ?>" target="_blank" class="text-gray-400 hover:text-sky-500 transition"><i class="fab fa-twitter text-2xl"></i></a>
                <a href="<?php echo htmlspecialchars($settings['social_instagram'] ?? '#'); ?>" target="_blank" class="text-gray-400 hover:text-pink-600 transition"><i class="fab fa-instagram text-2xl"></i></a>
                <a href="<?php echo htmlspecialchars($settings['social_youtube'] ?? '#'); ?>" target="_blank" class="text-gray-400 hover:text-red-600 transition"><i class="fab fa-youtube text-2xl"></i></a>
            </div>

            <p class="text-gray-400 text-m"><?php echo htmlspecialchars($settings['footer_copyright'] ?? '© ' . date('Y') . ' Sumosu Su Arıtma Sistemleri. Tüm Hakları Saklıdır.'); ?></p>
        </div>
    </div>
</footer>

<!-- WhatsApp Destek Butonu -->
<?php if (!empty($settings['contact_whatsapp'])): ?>
<a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']); ?>" target="_blank" class="fixed bottom-6 right-6 z-50 bg-[#25D366] text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform duration-300">
    <i class="fab fa-whatsapp text-3xl"></i>
</a>
<?php endif; ?>

<?php include 'chat_widget.php'; ?>

</body>
</html>