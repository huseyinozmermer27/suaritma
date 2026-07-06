<?php include '../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="mb-8">
            <a href="<?php echo $base_url; ?>pages/sik-sorulan-sorular" class="text-primary hover:underline flex items-center gap-2 font-medium">
                <i class="fa-solid fa-arrow-left"></i> Sık Sorulan Sorular'a Dön
            </a>
        </div>

        <article class="prose prose-lg max-w-none">
            <h1 class="text-4xl font-bold text-secondary mb-8">Siparişimin durumu nedir?</h1>
            
            <div class="text-gray-600 space-y-6 leading-relaxed text-lg">
                <p>
                    Siparişinizin durumunu dilediğiniz zaman "Gönderi Takibi" sayfamızdan kontrol edebilirsiniz. 
                    Siparişiniz kargoya verildiğinde size gönderilen takip numarası ile anlık olarak kargonuzun nerede olduğunu görebilirsiniz.
                </p>
                
                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 my-10 text-center">
                    <p class="font-bold text-secondary mb-6">Siparişinizi şimdi takip etmek ister misiniz?</p>
                    <a href="<?php echo $base_url; ?>pages/tracking-page.php" class="inline-block bg-black text-white py-3 px-8 rounded-lg font-bold hover:bg-gray-800 transition-colors">
                        Gönderiyi Takip Et
                    </a>
                </div>

                <p>
                    Ayrıca siparişinizle ilgili her türlü sorunuz için <strong>0850 532 58 32</strong> numaralı telefondan veya 
                    <strong>destek@sumosuaritma.com</strong> adresinden bize ulaşabilirsiniz.
                </p>
            </div>
        </article>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>


