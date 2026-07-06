<?php
require_once __DIR__ . '/../../../app/Core/includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: /suaritma/index.php");
    exit;
}

$query = $db->prepare("SELECT * FROM products WHERE id = :id AND status = 1 LIMIT 1");
$query->execute(['id' => $id]);
$product = $query->fetch();

if (!$product) {
    header("HTTP/1.1 404 Not Found");
    header("Location: /suaritma/404.php");
    exit;
}

include '../../../app/Core/includes/header.php';

// Resim listesini oluştur
$images = [];
for ($i = 1; $i <= 4; $i++) {
    $colName = ($i == 1) ? 'main_image' : 'image' . $i;
    if (!empty($product[$colName])) {
        $images[] = (strpos($product[$colName], 'http') === 0) 
            ? $product[$colName] 
            : '/suaritma/assets/uploads/products/' . htmlspecialchars($product[$colName]);
    }
}
$mainImg = !empty($images) ? $images[0] : '/suaritma/assets/img/sumosu.jpg';
?>

<main class="py-12 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Sol: Resim Galerisi -->
            <div class="space-y-4">
                <img id="main-product-img" src="<?php echo $mainImg; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-auto rounded-3xl shadow-lg transition-all duration-300">
                <div class="grid grid-cols-4 gap-4">
                    <?php foreach ($images as $index => $img): ?>
                        <img src="<?php echo $img; ?>" class="product-thumb w-full h-24 object-cover rounded-xl cursor-pointer <?php echo ($index == 0) ? 'border-2 border-primary' : 'border border-gray-200'; ?> hover:opacity-80 transition-all">
                    <?php endforeach; ?>
                </div>
            </div>


            <!-- Sağ: Ürün Bilgileri -->
            <div class="space-y-6">
                <!-- Puanlama -->
                <div class="flex items-center gap-4">
                    <div class="text-yellow-400 text-sm">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                    </div>
                    <span class="text-gray-500 font-medium text-sm">(4.0 / 5.0 Değerlendirme)</span>
                </div>

                <h1 class="text-3xl font-extrabold text-secondary"><?php echo htmlspecialchars($product['name'] ?? ''); ?></h1>
                
                <!-- Fiyatlandırma -->
                <div class="flex items-center gap-3">
                    <?php 
                    $price = (float)($product['price'] ?? 0);
                    $discounted = (float)($product['discounted_price'] ?? 0);
                    $hasDiscount = ($discounted > 0 && $discounted < $price);
                    ?>
                    <span class="text-2xl font-bold text-red-600">₺<?php echo number_format($hasDiscount ? $discounted : $price, 2, ',', '.'); ?></span>
                    <?php if ($hasDiscount): ?>
                        <span class="text-lg text-gray-400 line-through">₺<?php echo number_format($price, 2, ',', '.'); ?></span>
                        <span class="bg-red-600 text-white px-2 py-0.5 rounded text-xs font-bold"><?php echo number_format($price - $discounted, 0, ',', '.') . ' TL İNDİRİM'; ?></span>
                    <?php endif; ?>
                </div>

                <!-- Açıklama -->
                <div class="text-gray-600 text-sm space-y-3">
                    <p class="font-semibold text-gray-800"><?php echo htmlspecialchars($product['short_description'] ?? ''); ?></p>
                    <p><?php echo $product['description'] ?? ''; ?></p>
                </div>

                <!-- Onaylı Video Yorumlar -->
                <?php
                $approved_videos = $db->prepare("SELECT * FROM customer_reviews WHERE product_id = :pid AND status = 1 AND video_path IS NOT NULL");
                $approved_videos->execute(['pid' => $product['id']]);
                $videos = $approved_videos->fetchAll();
                if ($videos):
                ?>
                <div class="pt-6 border-t">
                    <h3 class="text-lg font-bold mb-4 text-secondary">Müşteri Deneyim Videoları</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($videos as $v): ?>
                        <div class="rounded-2xl overflow-hidden shadow-md">
                            <video class="w-full h-32 object-cover" controls>
                                <source src="<?php echo $base_url . htmlspecialchars($v['video_path']); ?>" type="video/mp4">
                            </video>
                            <div class="p-2 bg-gray-50 text-[10px] text-gray-600 font-bold truncate">
                                <?php echo htmlspecialchars($v['customer_name'] ?? ''); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Yorum Eylem Bölümü -->
                <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-100">
                    <button onclick="document.getElementById('photoReviewModal').classList.remove('hidden')" 
                            class="flex flex-col items-center justify-center p-4 rounded-2xl bg-gray-50 hover:bg-gray-100 transition-all border border-gray-100 group">
                        <i class="fas fa-camera text-gray-500 mb-2 group-hover:text-black"></i>
                        <span class="text-xs font-bold text-gray-600 group-hover:text-black">Fotoğraflı Yorum</span>
                    </button>
                    <button onclick="document.getElementById('reviewModal').classList.remove('hidden')" 
                            class="flex flex-col items-center justify-center p-4 rounded-2xl bg-blue-50 hover:bg-blue-100 transition-all border border-blue-100 group">
                        <i class="fas fa-video text-blue-500 mb-2 group-hover:text-blue-700"></i>
                        <span class="text-xs font-bold text-blue-600 group-hover:text-blue-800">Videolu Yorum</span>
                    </button>
                </div>
                <p class="text-[11px] text-gray-400 text-center italic">Deneyimlerinizi paylaşarak sonraki alışverişinizde %10 indirim kazanın.</p>

                <!-- Renk Seçimi -->
                <div class="space-y-2 text-sm">
                    <p class="font-bold">Renk Seçeneği:</p>
                    <div class="flex gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="selected_color" value="white" class="sr-only peer" checked>
                            <div class="text-center py-1 px-3 border border-gray-300 rounded-md bg-white text-black peer-checked:ring-1 peer-checked:ring-gray-600 transition-all font-bold text-xs">Beyaz</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="selected_color" value="black" class="sr-only peer">
                            <div class="text-center py-1 px-3 border border-black rounded-md bg-black text-white peer-checked:ring-1 peer-checked:ring-gray-600 transition-all font-bold text-xs">Siyah</div>
                        </label>
                    </div>
                </div>
                
                <p class="text-green-600 font-bold"><i class="fas fa-check-circle"></i> <?php echo ($product['stock_count'] ?? 0) > 0 ? 'Stokta var' : 'Tükendi'; ?></p>

                <!-- Miktar ve Sepet -->
                <form action="/suaritma/app/Migrations/add_to_cart_handler.php" method="POST" class="flex items-center gap-4">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="flex items-center border border-gray-300 rounded-lg text-sm">
                        <button type="button" onclick="changeQty(-1)" class="px-3 py-2 hover:bg-gray-100">-</button>
                        <input type="number" name="quantity" id="qty" value="1" class="w-10 text-center border-x border-gray-300 py-2 outline-none">
                        <button type="button" onclick="changeQty(1)" class="px-3 py-2 hover:bg-gray-100">+</button>
                    </div>
                    <button type="submit" class="flex-grow bg-black text-white py-2.5 rounded-lg font-bold text-sm hover:bg-gray-800 transition-all">Sepete Ekle</button>
                </form>

                <!-- Sıkça Birlikte Alınanlar -->
                <div class="mt-8 pt-6 border-t">
                    <h3 class="text-lg font-bold mb-4">Sıkça Birlikte Alınan Ürünler</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 border rounded-2xl">
                            <input type="checkbox" class="w-5 h-5 accent-primary">
                            <img src="<?php echo $finalImg; ?>" class="w-12 h-12 rounded-lg object-cover">
                            <div class="flex-grow">
                                <p class="font-bold text-sm">Yedek Filtre Seti</p>
                                <p class="text-red-600 font-bold text-sm">₺500,00</p>
                            </div>
                        </div>
                        <button class="w-full bg-black text-white py-2.5 rounded-lg font-bold text-sm hover:bg-gray-800 transition-all">Paketi Sepete Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Fotoğraflı Yorum Modalı -->
<div id="photoReviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-secondary">Fotoğraflı Yorum Yap</h3>
            <button onclick="document.getElementById('photoReviewModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="photoReviewForm" class="p-6 space-y-4">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Adınız Soyadınız</label>
                <input type="text" name="customer_name" required placeholder="Örn: Ahmet Yılmaz" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Puanınız</label>
                <div class="flex gap-2 text-2xl text-yellow-400" id="photoStarRating">
                    <i class="fas fa-star cursor-pointer" data-value="1"></i>
                    <i class="fas fa-star cursor-pointer" data-value="2"></i>
                    <i class="fas fa-star cursor-pointer" data-value="3"></i>
                    <i class="fas fa-star cursor-pointer" data-value="4"></i>
                    <i class="fas fa-star cursor-pointer" data-value="5"></i>
                </div>
                <input type="hidden" name="rating" id="photoRatingInput" value="5">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Yorumunuz</label>
                <textarea name="comment" required placeholder="Ürün hakkındaki deneyiminizi yazın..." class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition-all"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fotoğraflar</label>
                <input type="file" name="images[]" multiple accept="image/*" required class="w-full text-sm">
            </div>

            <button type="submit" class="w-full bg-gray-800 text-white p-3 rounded-xl font-bold hover:bg-black transition-all">Gönder</button>
        </form>
    </div>
</div>

<!-- Video Yorum Modalı -->
<div id="reviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-secondary">Deneyimini Paylaş</h3>
            <button onclick="document.getElementById('reviewModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="reviewForm" class="p-6 space-y-4">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Adınız Soyadınız</label>
                <input type="text" name="customer_name" required class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Örn: Ahmet Yılmaz">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Puanınız</label>
                <div class="flex gap-2 text-2xl text-yellow-400" id="starRating">
                    <i class="fas fa-star cursor-pointer" data-value="1"></i>
                    <i class="fas fa-star cursor-pointer" data-value="2"></i>
                    <i class="fas fa-star cursor-pointer" data-value="3"></i>
                    <i class="fas fa-star cursor-pointer" data-value="4"></i>
                    <i class="fas fa-star cursor-pointer" data-value="5"></i>
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="5">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Yorumunuz</label>
                <textarea name="comment" required rows="3" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Ürün hakkındaki deneyiminizi yazın..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Video Yükle (Max 20MB)</label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-blue-500 transition-all cursor-pointer relative" id="dropZone">
                    <input type="file" name="video" id="videoInput" accept="video/*" class="absolute inset-0 opacity-0 cursor-pointer">
                    <div id="fileInfo" class="space-y-1">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                        <p class="text-xs text-gray-500">Videoyu buraya sürükleyin veya tıklayın</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg flex items-center justify-center gap-2">
                <i class="fas fa-paper-plane"></i> Gönder ve İndirim Kazan
            </button>
        </form>
    </div>
</div>

<script>
    // Resim değişimi - Thumbnail tıklama
    document.querySelectorAll('.product-thumb').forEach(thumb => {
        thumb.addEventListener('click', function() {
            console.log('Thumbnail clicked:', this.src);
            document.getElementById('main-product-img').src = this.src;
            document.querySelectorAll('.product-thumb').forEach(t => t.classList.remove('border-primary', 'border-2'));
            this.classList.add('border-primary', 'border-2');
        });
    });

    // Miktar kontrolü
    function changeQty(delta) {
        const input = document.getElementById('qty');
        let val = parseInt(input.value) + delta;
        if(val < 1) val = 1;
        input.value = val;
    }
</script>

<?php include '../../../app/Core/includes/footer.php'; ?>


