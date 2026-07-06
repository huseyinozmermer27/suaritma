<?php include '../../../app/Core/includes/header.php'; ?>
<main class="container mx-auto py-20">
    <h1 class="text-4xl font-bold mb-8 text-center">Pompalı mı Pompasız mı?</h1>
    <div class="prose max-w-4xl mx-auto text-justify">
        <p>Hangi modeli seçeceğinize karar verirken, önce musluğunuzdan akan suyu göz önünde bulundurun:</p>
        <ul class="list-disc pl-6 mb-6">
            <li>Musluğunuzdan akan şebeke suyu basıncı düşük mü?</li>
            <li>Suyun tazyiğinden yana bir şikayetiniz var mı?</li>
            <li>Elinizi yıkarken, duş alırken veya bulaşık yıkarken suyun zayıflığı sizi rahatsız ediyor mu?</li>
        </ul>
        <p>Eğer bu sorulara yanıtınız evetse, elektriksiz su arıtma cihazı evinizde çalışmayabilir. Elektrikli su arıtma cihazımızın içerisinde bulunan pompa, düşük olan şebeke suyu basıncınızı yükseltir ve cihazın çalışmasını sağlar.</p>
        <p><strong>Bu durumda size pompalı su arıtma cihazımızı öneririz.</strong></p>
        <p><strong>Şebeke suyunuzda basınç problemi yoksa ve suyunuzun akışından memnunsanız pompasız su arıtma cihazımızı almanızı öneririz.</strong></p>
    </div>
    
    <!-- Hangi Sumosu Bölümü -->
    <div class="py-20 bg-gray-50 mt-16">
        <div class="container mx-auto px-4 max-w-4xl text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Size en uygun Sumosu hangisi?</h2>
            <p class="text-lg text-gray-700 mb-12">Tüm özellikleriyle pompalı ve pompasız modelleri karşılaştırın.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Ürün Kartı 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
                    <img src="https://sumosuaritma.com/cdn/shop/files/home_natural_musluklu_beyaz.webp" alt="Pompasız Model" class="w-32 h-32 object-contain mb-4">
                    <h3 class="font-bold text-lg mb-2">Sumosu Home Natural Pompasız</h3>
                    <p class="text-gray-600 text-sm text-center mb-4">Şebeke suyu basıncı yeterli olan evler için ideal, elektriksiz ve sessiz çalışma performansı sunar.</p>
                </div>
                <!-- Ürün Kartı 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
                    <img src="https://sumosuaritma.com/cdn/shop/files/home_natural_pompali_musluklu_beyaz.webp" alt="Pompalı Model" class="w-32 h-32 object-contain mb-4">
                    <h3 class="font-bold text-lg mb-2">Sumosu Home Natural Pompalı</h3>
                    <p class="text-gray-600 text-sm text-center mb-4">Düşük şebeke suyu basıncı olan yerlerde, entegre pompası sayesinde suyu yüksek tazyikle arıtır.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Karşılaştırma Tablosu -->
    <div class="py-12 bg-white">
        <div class="container mx-auto px-4 max-w-5xl">
            <h2 class="text-3xl font-bold text-center mb-12">Teknik Özellikler Karşılaştırması</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-4 font-bold text-gray-900">Özellik</th>
                            <th class="py-4 font-bold text-gray-900">Sumosu Home Natural Pompasız</th>
                            <th class="py-4 font-bold text-gray-900">Sumosu Home Natural Pompalı</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr>
                            <td class="py-4 font-bold text-gray-700">Güç Kaynağı</td>
                            <td class="py-4 text-gray-600">Şebeke suyu basıncı ile çalışır. Elektrik gerektirmez.</td>
                            <td class="py-4 text-gray-600">Şebeke suyu basıncı düşük olan evlerde elektrik enerjisi ile çalışır.</td>
                        </tr>
                        <tr>
                            <td class="py-4 font-bold text-gray-700">Dahili Pompa Ünitesi</td>
                            <td class="py-4 text-gray-600">Yok</td>
                            <td class="py-4 text-gray-600">Var</td>
                        </tr>
                        <tr>
                            <td class="py-4 font-bold text-gray-700">Arıtma Kapasitesi</td>
                            <td class="py-4 text-gray-600">Günlük 180 - 270 litre arası (Şebeke suyu basıncına bağlı)</td>
                            <td class="py-4 text-gray-600">Günlük 270 litre</td>
                        </tr>
                        <tr>
                            <td class="py-4 font-bold text-gray-700">Tank Dolum Süresi</td>
                            <td class="py-4 text-gray-600">~60 - 90 dakika arası (Şebeke suyu basıncına bağlı)</td>
                            <td class="py-4 text-gray-600">~60 dakika</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Müşteri Hikayesi Bölümü -->
    <div class="py-16 bg-white overflow-hidden">
        <div class="container mx-auto px-4 max-w-4xl">
            <div id="testimonial-carousel" class="relative">
                <!-- Hikaye 1 -->
                <div class="testimonial-slide text-center transition-opacity duration-500">
                    <div class="text-4xl text-gray-300 mb-6"><i class="fas fa-quote-left"></i></div>
                    <p class="text-xl md:text-2xl text-gray-800 italic mb-8">"Suyumuzun basıncı düşük olmasına rağmen belki çalışır diye düşünerek pompasız aldım ama çalışmadı. Sumosu'dan Harici Pompa alıp cihazı sonradan pompalıya dönüştürdüm. Şimdi canavar gibi."</p>
                    <p class="font-bold text-gray-900">Pompasız Model ve Harici Pompa Kullanıcısı</p>
                </div>
                
                <!-- Navigasyon Okları -->
                <button class="absolute top-1/2 -left-4 md:-left-12 transform -translate-y-1/2 text-gray-400 hover:text-black transition">
                    <i class="fas fa-chevron-left text-3xl"></i>
                </button>
                <button class="absolute top-1/2 -right-4 md:-right-12 transform -translate-y-1/2 text-gray-400 hover:text-black transition">
                    <i class="fas fa-chevron-right text-3xl"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Pompalı Dönüşüm Bilgilendirme -->
    <div class="py-16 bg-gray-900 text-white text-center">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="text-3xl font-bold mb-6">Pompasız su arıtma cihazını sonradan pompalı hale getirmek çok basit.</h2>
            <p class="text-lg text-gray-300">Eğer başlangıçta pompasız model tercih ettiyseniz ve sonradan basınçla ilgili bir sorun yaşarsanız, endişelenmenize gerek yok. Cihazınızı Sumosu'dan temin edeceğiniz bir harici pompa kitiyle çok kısa sürede pompalı modele dönüştürebilir, su basıncınızı ideal seviyeye yükseltebilirsiniz.</p>
        </div>
    </div>
    
    <!-- Uzman Desteği Bölümü -->
    <div class="py-16 bg-blue-50 text-center">
        <div class="container mx-auto px-4">
            <p class="text-2xl font-bold text-blue-900 mb-6">Her 10 Sumosu kullanıcısından 9'u pompasız model kullanıyor.</p>
            <p class="text-gray-700 mb-6">Karar veremiyor musunuz?</p>
            <a href="https://wa.me/8505325832" target="_blank" class="inline-block bg-green-600 text-white px-8 py-3 rounded-full font-bold hover:bg-green-700 transition">
                <i class="fab fa-whatsapp mr-2"></i> Bir uzmanla WhatsApp'ta sohbet edin.
            </a>
        </div>
    </div>
</main>
<?php include '../../../app/Core/includes/footer.php'; ?>

