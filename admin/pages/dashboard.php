<?php
// admin/pages/dashboard.php
global $db;

// Dashboard verilerini çek
$admin_username = $_SESSION['username'] ?? 'Admin';

try {
    $productCount = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
    $categoryCount = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    
    // Check if tables exist before querying
    $orderCount = 0;
    $checkOrders = $db->query("SHOW TABLES LIKE 'orders'")->rowCount() > 0;
    if($checkOrders) {
        $orderCount = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    }

    $commentCount = 0;
    $checkComments = $db->query("SHOW TABLES LIKE 'comments'")->rowCount() > 0;
    if($checkComments) {
        $commentCount = $db->query("SELECT COUNT(*) FROM comments WHERE status = 'pending'")->fetchColumn();
    }
} catch (PDOException $e) {
    $productCount = $categoryCount = $orderCount = $commentCount = 0;
}
?>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Hoş Geldiniz, <?php echo $admin_username; ?></h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Ürünler -->
        <div class="bg-blue-600 text-white p-6 rounded-lg shadow flex justify-between items-center">
            <div>
                <h6 class="text-blue-100 uppercase text-sm">Toplam Ürün</h6>
                <h2 class="text-3xl font-bold"><?php echo $productCount; ?></h2>
            </div>
            <i class="bi bi-box-seam text-4xl opacity-80"></i>
        </div>

        <!-- Kategoriler -->
        <div class="bg-green-600 text-white p-6 rounded-lg shadow flex justify-between items-center">
            <div>
                <h6 class="text-green-100 uppercase text-sm">Kategoriler</h6>
                <h2 class="text-3xl font-bold"><?php echo $categoryCount; ?></h2>
            </div>
            <i class="bi bi-tags text-4xl opacity-80"></i>
        </div>

        <!-- Siparişler -->
        <div class="bg-yellow-500 text-gray-900 p-6 rounded-lg shadow flex justify-between items-center">
            <div>
                <h6 class="text-gray-700 uppercase text-sm">Siparişler</h6>
                <h2 class="text-3xl font-bold"><?php echo $orderCount; ?></h2>
            </div>
            <i class="bi bi-cart3 text-4xl opacity-80"></i>
        </div>

        <!-- Bekleyen Yorumlar -->
        <div class="bg-red-600 text-white p-6 rounded-lg shadow flex justify-between items-center">
            <div>
                <h6 class="text-red-100 uppercase text-sm">Bekleyen Yorum</h6>
                <h2 class="text-3xl font-bold"><?php echo $commentCount; ?></h2>
            </div>
            <i class="bi bi-chat-dots text-4xl opacity-80"></i>
        </div>
    </div>
</div>

<script>
    document.getElementById('nav-home').classList.add('active');
</script>