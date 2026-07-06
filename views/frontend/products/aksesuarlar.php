<?php
// Aksesuarlar sayfası
require_once __DIR__ . '/../../../app/Core/includes/header.php';
require_once __DIR__ . '/../../../app/Core/includes/db.php';

// Filtreleme mantığı
$where = ["category_id = 7"];
$params = [];

if (isset($_GET['in_stock']) && $_GET['in_stock'] == '1') {
    $where[] = "stock_count > 0";
}
if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
    $where[] = "price >= :min_price";
    $params['min_price'] = $_GET['min_price'];
}
if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
    $where[] = "price <= :max_price";
    $params['max_price'] = $_GET['max_price'];
}

$sort = "id ASC";
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'best-selling': $sort = "sales_count DESC"; break;
        case 'title-asc': $sort = "name ASC"; break;
        case 'title-desc': $sort = "name DESC"; break;
        case 'price-asc': $sort = "price ASC"; break;
        case 'price-desc': $sort = "price DESC"; break;
    }
}

$sql = "SELECT * FROM products WHERE " . implode(' AND ', $where) . " ORDER BY " . $sort;
$stmt = $db->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

<!-- Banner Alanı -->
<section class="relative bg-primary text-white py-48 bg-cover bg-center" style="background-image: url('<?php echo $base_url; ?>../views/frontend/products/en-iyi-su-aritma-filtreleri-sumosuda.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    
    <div class="container mx-auto px-4 relative z-10 h-full flex items-center">
        <div class="md:w-1/2">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 whitespace-nowrap">Su Arıtma Yedek Parçaları ve Aksesuarları</h1>
            <p class="text-lg text-gray-200">Arıtma sisteminizi tamamlayacak yardımcı ekipmanlar.</p>
        </div>
    </div>

    <!-- En Çok Satanlar Kutusu (Banner Sağ Altı) -->
    <div class="absolute bottom-6 right-6 z-20 bg-white text-gray-900 p-6 rounded-2xl shadow-xl max-w-xs">
        <h3 class="text-xl font-bold mb-4 text-primary">En Çok Satan Ürün</h3>
        <?php
        $bestSeller = $db->query("SELECT * FROM products WHERE category_id = 7 ORDER BY sales_count DESC LIMIT 1")->fetch();
        if ($bestSeller): ?>
            <a href="<?php echo $base_url; ?>../views/frontend/products/urun-detay.php?id=<?php echo $bestSeller['id']; ?>" class="flex items-center gap-3">
                <img src="<?php echo $base_url . '../assets/uploads/products/' . htmlspecialchars($bestSeller['main_image']); ?>" class="w-16 h-16 rounded object-cover">
                <div>
                    <p class="font-bold text-sm leading-tight"><?php echo htmlspecialchars($bestSeller['name']); ?></p>
                    <p class="text-primary font-bold text-xs">₺<?php echo number_format($bestSeller['price'], 2, ',', '.'); ?></p>
                </div>
            </a>
        <?php endif; ?>
    </div>
</section>

<main class="container mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Kalıcı Filtre Paneli -->
        <div id="filter-panel" class="bg-gray-200 p-6 rounded-lg shadow-inner w-full md:w-64 h-fit sticky top-24">
            <h2 class="text-lg font-bold mb-4">Filtreler</h2>
            <form method="GET" class="flex flex-col gap-6">
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="in_stock" value="1" <?php echo isset($_GET['in_stock']) ? 'checked' : ''; ?> class="w-5 h-5">
                        <span class="font-semibold text-gray-700">Yalnızca Stoktakiler</span>
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fiyat Aralığı (TL)</label>
                    <div class="flex flex-col gap-2">
                        <input type="number" name="min_price" placeholder="Min" value="<?php echo $_GET['min_price'] ?? ''; ?>" class="border p-2 rounded w-full">
                        <input type="number" name="max_price" placeholder="Max" value="<?php echo $_GET['max_price'] ?? ''; ?>" class="border p-2 rounded w-full">
                    </div>
                </div>
                <div>
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-secondary transition w-full">Uygula</button>
                </div>
            </form>
        </div>

        <!-- Ürün Kartları Listesi -->
        <section class="flex-1">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Ürünler</h2>
                <select onchange="window.location.href='?sort='+this.value" class="border rounded-md px-4 py-2 bg-white text-gray-700 outline-none">
                    <option value="manual">Sıralama Seçin</option>
                    <option value="best-selling">En çok satan</option>
                    <option value="title-asc">Alfabetik (A-Z)</option>
                    <option value="title-desc">Alfabetik (Z-A)</option>
                    <option value="price-asc">Fiyat (Düşükten Yükseğe)</option>
                    <option value="price-desc">Fiyat (Yüksekten Düşüğe)</option>
                </select>
            </div>

            <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($products as $index => $product): ?>
                    <a href="<?php echo $base_url; ?>../views/frontend/products/urun-detay.php?id=<?php echo $product['id']; ?>" class="product-item group relative border rounded-lg p-4 shadow-sm hover:shadow-lg transition bg-white block">
                        <div class="relative overflow-hidden mb-4 rounded">
                            <!-- İndirim Etiketi -->
                            <?php if (isset($product['discounted_price']) && $product['discounted_price'] > 0 && $product['discounted_price'] < $product['price']): ?>
                                <?php $savedAmount = $product['price'] - $product['discounted_price']; ?>
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-[11px] font-bold px-2.5 py-1.5 rounded shadow z-10">
                                    <?php echo number_format($savedAmount, 0, ',', '.'); ?> TL Tasarruf Edin
                                </div>
                            <?php endif; ?>

                            <img src="<?php echo $base_url . '../assets/uploads/products/' . htmlspecialchars($product['main_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="w-full h-64 object-cover rounded">

                            <!-- Hızlı Ekle Butonu -->
                            <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                <form action="/suaritma/app/Migrations/add_to_cart_handler.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-primary text-white text-xs font-bold px-4 py-2 rounded shadow hover:bg-secondary transition-colors">Hızlı Ekle</button>
                                </form>
                            </div>
                        </div>
                        <h2 class="text-lg font-semibold mb-2"><?php echo htmlspecialchars($product['name']); ?></h2>

                        <div class="flex items-center justify-between mt-2">
                            <div class="flex flex-col gap-1">
                                <?php if (isset($product['discounted_price']) && $product['discounted_price'] > 0 && $product['discounted_price'] < $product['price']): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-red-600 font-bold text-lg"><?php echo number_format($product['discounted_price'], 2, ',', '.'); ?> TL</span>
                                        <span class="text-gray-400 line-through text-xs"><?php echo number_format($product['price'], 2, ',', '.'); ?> TL</span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-950 font-bold text-lg"><?php echo number_format($product['price'], 2, ',', '.'); ?> TL</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <?php if (count($products) > 6): ?>
            <div class="text-center mt-10">
                <button id="load-more" class="bg-gray-800 text-white px-8 py-3 rounded hover:bg-gray-900 transition">Devamını Göster</button>
            </div>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
    document.getElementById('load-more')?.addEventListener('click', function() {
        document.querySelectorAll('.product-item.hidden').forEach((el, index) => {
            if (index < 3) el.classList.remove('hidden');
        });
        if (document.querySelectorAll('.product-item.hidden').length === 0) {
            this.style.display = 'none';
        }
    });
</script>

<?php require_once __DIR__ . '/../../../app/Core/includes/footer.php'; ?>
