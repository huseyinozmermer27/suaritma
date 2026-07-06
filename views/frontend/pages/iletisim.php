<?php require_once __DIR__ . '/../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid lg:grid-cols-2 gap-16">
            <!-- İletişim Formu -->
            <div>
                <h2 class="text-4xl font-bold text-secondary mb-6">Bize Ulaşın</h2>
                <p class="text-gray-600 mb-8">Sorularınız, önerileriniz veya destek talepleriniz için aşağıdaki formu doldurmanız yeterli. Uzman ekibimiz size en kısa sürede dönüş yapacaktır.</p>
                
                <form id="contact-form" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Ad Soyad <span class="text-red-500">*</span></label>
                            <input type="text" name="ad_soyad" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">E-posta <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Konu <span class="text-red-500">*</span></label>
                        <input type="text" name="konu" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Mesajınız <span class="text-red-500">*</span></label>
                        <textarea name="mesaj" required rows="5" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-black text-white py-4 rounded-xl font-bold hover:bg-gray-800 transition-all text-lg shadow-lg">Mesajı Gönder</button>
                </form>
                <div id="form-message" class="hidden mt-4 p-4 rounded-xl text-center font-semibold"></div>
            </div>

            <!-- İletişim Bilgileri -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-4xl font-bold text-secondary mb-8">İletişim Bilgilerimiz</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <i class="fa-solid fa-location-dot text-primary text-2xl mb-4"></i>
                            <h5 class="font-bold mb-2">Adres</h5>
                            <p class="text-gray-600 text-sm">6251 Sk. No: 8/A Şemikler Meydanı, Karşıyaka/İzmir</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <i class="fa-solid fa-phone text-primary text-2xl mb-4"></i>
                            <h5 class="font-bold mb-2">Telefonlar</h5>
                            <p class="text-gray-600 text-sm">0507 489 71 19<br>0536 326 26 11<br>0232 999 86 32</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <i class="fa-solid fa-envelope text-primary text-2xl mb-4"></i>
                            <h5 class="font-bold mb-2">E-posta</h5>
                            <p class="text-gray-600 text-sm">optimalsuaritma@gmail.com</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <i class="fa-solid fa-clock text-primary text-2xl mb-4"></i>
                            <h5 class="font-bold mb-2">Çalışma Saatleri</h5>
                            <p class="text-gray-600 text-sm">Hafta içi: 09:00 - 18:00</p>
                        </div>
                    </div>
                </div>

                <!-- Harita -->
                <div class="w-full h-[300px] rounded-3xl overflow-hidden shadow-xl bg-gray-200">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3124.6305608759533!2d27.09457637650579!3d38.48780707183063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bbd8b525d88691%3A0x6a2c262a74e57849!2s6251.+Sk.+No%3A8%2FA%2C+38480+Kar%C5%9F%C4%B1yaka%2F%C4%B0zmir!5e0!3m2!1str!2str!4v1715423854124!5m2!1str!2str" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const form = document.getElementById('contact-form');
    const messageBox = document.getElementById('form-message');

    form.querySelectorAll('input, textarea').forEach(el => {
        el.addEventListener('blur', () => {
            if (el.hasAttribute('required') && !el.value) {
                el.classList.add('border-red-500', 'ring-1', 'ring-red-500');
            } else {
                el.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
            }
        });
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        // Basit bir başarılı mesajı (Gerçekte bir endpoint'e POST edilecek)
        messageBox.classList.remove('hidden', 'bg-red-100', 'text-red-800');
        messageBox.classList.add('bg-green-100', 'text-green-800');
        messageBox.textContent = 'Mesajınız başarıyla alındı. Teşekkürler!';
        form.reset();
    });
</script>

<?php require_once __DIR__ . '/../../../app/Core/includes/footer.php'; ?>
