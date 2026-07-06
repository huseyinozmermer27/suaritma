<?php 
// Oturum başlat ve sepet kontrolü yap
session_start();
include 'includes/header.php'; 

// Dinamik URL Token oluşturma (Simülasyon)
if (!isset($_GET['id'])) {
    $checkout_id = bin2hex(random_bytes(16));
    header("Location: odeme.php?id=$checkout_id");
    exit;
}
?>

<div class="min-h-screen bg-gray-50 py-10">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Sol: Ödeme Formu (1-2-3 Adım) -->
            <div class="lg:col-span-7">
                <h2 class="text-3xl font-extrabold mb-8">Ödeme Bilgileri</h2>
                
                <!-- Adres Formu -->
                <form id="checkout-form" class="space-y-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                            <span class="bg-primary text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span> 
                            İletişim ve Teslimat Bilgileri
                        </h4>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Ad" class="w-full p-3 border rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            <input type="text" placeholder="Soyad" class="w-full p-3 border rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            <input type="text" placeholder="Adres" class="col-span-2 w-full p-3 border rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            <input type="text" placeholder="Şehir" class="w-full p-3 border rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            <input type="text" placeholder="Posta Kodu" class="w-full p-3 border rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                        </div>
                    </div>

                    <!-- Ödeme Yöntemi -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                            <span class="bg-primary text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span> 
                            Ödeme Yöntemi
                        </h4>
                        <div class="space-y-4">
                            <div class="border rounded-lg p-4 flex items-center gap-3">
                                <input type="radio" name="payment" checked class="accent-primary">
                                <span class="font-bold">Kredi Kartı / Banka Kartı</span>
                                <img src="https://sumosuaritma.com/cdn/shop/files/payment-methods.png" class="h-6 ml-auto">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" placeholder="Kart Numarası" class="col-span-2 w-full p-3 border rounded-lg outline-none">
                                <input type="text" placeholder="Son Kullanma (AA/YY)" class="w-full p-3 border rounded-lg outline-none">
                                <input type="text" placeholder="CVV" class="w-full p-3 border rounded-lg outline-none">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:bg-primary/80 transition-all shadow-lg">Ödemeyi Tamamla (₺14.550,00)</button>
                </form>
            </div>

            <!-- Sağ: Sipariş Özeti -->
            <div class="lg:col-span-5">
                <div class="sticky top-24 bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-xl mb-6">Sipariş Özeti</h3>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center gap-4">
                            <img src="https://sumosuaritma.com/cdn/shop/files/home_natural_musluklu_beyaz.webp?v=1774472501&width=100" class="w-16 h-16 rounded-lg border">
                            <div class="flex-grow">
                                <p class="font-bold text-sm">Sumosu Home Natural Pompasız</p>
                                <p class="text-xs text-gray-500">Renk: Beyaz</p>
                            </div>
                            <p class="font-bold">₺14.550,00</p>
                        </div>
                    </div>

                    <div class="border-t pt-4 space-y-2">
                        <div class="flex justify-between text-sm"><span>Ara Toplam</span><span>₺14.550,00</span></div>
                        <div class="flex justify-between text-sm"><span>Kargo</span><span class="text-green-600 font-bold">Ücretsiz</span></div>
                        <div class="flex justify-between text-lg font-bold pt-2 border-t mt-2"><span>Toplam</span><span>₺14.550,00</span></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Ödeme simülasyonu başarılı! Siparişiniz alındı.');
        window.location.href = 'index.php';
    });
</script>

<?php include 'includes/footer.php'; ?>

