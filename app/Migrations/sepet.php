<?php 
session_start();
require_once '../Core/includes/db.php';
include '../Core/includes/header.php'; 

$cartItems = $_SESSION['cart'] ?? [];
$total = 0;
?>

<main class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-extrabold mb-8 text-gray-900">Sepetim</h2>
        
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Sepet Ürün Listesi -->
            <div class="lg:w-2/3">
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-500 border-b border-gray-100 uppercase text-xs tracking-wider">
                                    <th class="pb-4 font-semibold">Ürün</th>
                                    <th class="pb-4 font-semibold">Fiyat</th>
                                    <th class="pb-4 font-semibold">Adet</th>
                                    <th class="pb-4 font-semibold">Toplam</th>
                                    <th class="pb-4 font-semibold">İşlem</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($cartItems as $pid => $item): 
                                    $stmt = $db->prepare("SELECT main_image FROM products WHERE id = :id");
                                    $stmt->execute(['id' => $pid]);
                                    $productData = $stmt->fetch();
                                    $image = !empty($productData['main_image']) ? '/suaritma/assets/uploads/products/' . htmlspecialchars($productData['main_image']) : '/suaritma/assets/img/products/default.jpg';
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $total += $itemTotal;
                                ?>
                                <tr>
                                    <td class="py-6">
                                        <div class="flex items-center">
                                            <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="w-20 h-20 rounded-lg shadow-sm mr-4 object-cover">
                                            <span class="font-bold text-gray-800"><?php echo htmlspecialchars($item['name']); ?></span>
                                        </div>
                                    </td>
                                    <td class="py-6 text-gray-700">₺<?php echo number_format($item['price'], 2, ',', '.'); ?></td>
                                    <td class="py-6"><?php echo $item['quantity']; ?></td>
                                    <td class="py-6 text-gray-800 font-semibold">₺<?php echo number_format($itemTotal, 2, ',', '.'); ?></td>
                                    <td class="py-6 pl-4">
                                        <a href="remove_from_cart.php?id=<?php echo $pid; ?>" class="text-red-500 hover:text-red-700 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1H9a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sepet Özet -->
            <div class="lg:w-1/3">
                <div class="bg-gray-100 p-8 rounded-2xl shadow-inner border border-gray-200">
                    <h4 class="text-xl font-bold mb-6 text-gray-900">Sipariş Özeti</h4>
                    <div class="flex justify-between mb-4">
                        <span class="text-gray-600">Toplam</span>
                        <span class="text-2xl font-extrabold text-primary">₺<?php echo number_format($total, 2, ',', '.'); ?></span>
                    </div>
                    <div class="border-t border-gray-300 pt-6">
                        <a href="odeme.php" class="block w-full bg-black text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-gray-800 transition-colors duration-300 mb-4">Ödemeye Geç</a>
                        <a href="/suaritma/index.php" class="block w-full text-center text-gray-600 hover:text-gray-900 transition-colors underline text-sm">Alışverişe Devam Et</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../Core/includes/footer.php'; ?>
