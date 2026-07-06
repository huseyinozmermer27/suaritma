<?php include '../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="mb-8">
            <a href="<?php echo $base_url; ?>pages/sik-sorulan-sorular" class="text-primary hover:underline flex items-center gap-2 font-medium">
                <i class="fa-solid fa-arrow-left"></i> Sık Sorulan Sorular'a Dön
            </a>
        </div>

        <article class="prose prose-lg max-w-none">
            <h1 class="text-4xl font-bold text-secondary mb-8">Ürün ne zaman elime ulaşır?</h1>
            
            <div class="text-gray-600 space-y-6 leading-relaxed text-lg">
                <p>
                    Sumosu olarak siparişlerinizi mümkün olan en hızlı şekilde hazırlayıp kargoya teslim ediyoruz.
                </p>
                
                <p>
                    Siparişiniz onaylandıktan sonra <strong>1-3 iş günü içerisinde</strong> kargoya verilmektedir. Kargo firmasının teslimat süresi, adresinizin mesafesine bağlı olarak genellikle <strong>1-4 iş günü</strong> içerisinde adresinize ulaşmaktadır.
                </p>

                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 my-8">
                    <p class="font-bold text-secondary mb-2">Süreç Nasıl İşler?</p>
                    <ul class="list-decimal list-inside space-y-2">
                        <li>Siparişin alınması ve onaylanması.</li>
                        <li>Ürünün özenle paketlenmesi.</li>
                        <li>Kargo firmasına teslimat ve takip numarasının paylaşılması.</li>
                    </ul>
                </div>
            </div>
        </article>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>


