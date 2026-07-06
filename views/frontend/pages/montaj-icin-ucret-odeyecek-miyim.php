<?php include '../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="mb-8">
            <a href="<?php echo $base_url; ?>pages/sik-sorulan-sorular" class="text-primary hover:underline flex items-center gap-2 font-medium">
                <i class="fa-solid fa-arrow-left"></i> Sık Sorulan Sorular'a Dön
            </a>
        </div>

        <article class="prose prose-lg max-w-none">
            <h1 class="text-4xl font-bold text-secondary mb-8">Montaj için ücret ödeyecek miyim?</h1>
            
            <div class="text-gray-600 space-y-6 leading-relaxed text-lg">
                <p>
                    Hayır, Sumosu Su Arıtma olarak cihazlarınızın montajı için herhangi bir ücret talep etmiyoruz.
                </p>
                
                <p>
                    Türkiye'nin 81 ilinde geçerli olan <strong>ücretsiz kurulum</strong> hizmetimiz kapsamında, yetkili servis ekiplerimiz cihazınızı ücretsiz olarak kurmaktadır.
                </p>

                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 my-8">
                    <p class="font-bold text-secondary mb-2">Kurulum Kapsamı:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Cihazın yerinde montajı.</li>
                        <li>Bağlantı kontrollerinin yapılması.</li>
                        <li>Sistemin çalışır durumda teslim edilmesi.</li>
                    </ul>
                </div>
            </div>
        </article>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>


