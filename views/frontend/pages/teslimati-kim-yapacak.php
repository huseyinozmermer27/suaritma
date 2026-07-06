<?php include '../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="mb-8">
            <a href="<?php echo $base_url; ?>pages/sik-sorulan-sorular" class="text-primary hover:underline flex items-center gap-2 font-medium">
                <i class="fa-solid fa-arrow-left"></i> Sık Sorulan Sorular'a Dön
            </a>
        </div>

        <article class="prose prose-lg max-w-none">
            <h1 class="text-4xl font-bold text-secondary mb-8">Teslimatı kim yapacak?</h1>
            
            <div class="text-gray-600 space-y-6 leading-relaxed text-lg">
                <p>
                    Sumosu olarak siparişlerinizin güvenli ve hızlı bir şekilde size ulaşması için Türkiye'nin önde gelen kargo firmaları ile çalışıyoruz.
                </p>
                
                <p>
                    Siparişleriniz genellikle <strong>Yurtiçi Kargo</strong> veya <strong>Aras Kargo</strong> güvencesiyle adresinize teslim edilmektedir. 
                    Büyük hacimli gönderilerde ise özel lojistik firmaları tercih edilebilir.
                </p>

                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 my-8">
                    <p class="text-blue-800 font-medium italic">
                        "Tüm gönderilerimiz ücretsiz kargo avantajıyla kapınıza kadar getirilmektedir."
                    </p>
                </div>

                <p>
                    Kargonuz yola çıktığında tarafınıza SMS ve e-posta yoluyla bilgilendirme yapılacak ve takip numaranız paylaşılacaktır.
                </p>
            </div>
        </article>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>


