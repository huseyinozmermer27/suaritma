<?php
// admin/pages/product_add.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$error = ''; $success = '';
$categories = $db->query("SELECT id, name FROM categories WHERE status = 1 ORDER BY name ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean($_POST['name']);
    $category_id = (int)$_POST['category_id'];
    $description = clean($_POST['description']);
    $price = (float)$_POST['price'];
    $discounted_price = (float)$_POST['discounted_price'];
    $discount_percent = (int)$_POST['discount_percent'];
    $stock = (int)$_POST['stock'];
    $slug = !empty($_POST['slug']) ? createSlug($_POST['slug']) : createSlug($name);
    $status = isset($_POST['status']) ? 1 : 0;
    $featured = isset($_POST['featured']) ? 1 : 0;

    try {
        $uploadDir = '../assets/uploads/products/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        
        $images = [null, null, null, null];
        for ($i = 1; $i <= 4; $i++) {
            $inputName = 'image' . $i;
            if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
                $fileName = md5(time() . $i . $_FILES[$inputName]['name']) . '.' . strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
                if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $uploadDir . $fileName)) {
                    $images[$i-1] = $fileName;
                }
            }
        }

        $stmt = $db->prepare("INSERT INTO products (name, category_id, short_description, price, discounted_price, discount_percent, stock_count, slug, status, featured, main_image, image2, image3, image4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $category_id, $description, $price, $discounted_price, $discount_percent, $stock, $slug, $status, $featured, $images[0], $images[1], $images[2], $images[3]]);
        
        $success = 'Ürün başarıyla eklendi.';
    } catch (Exception $e) {
        $error = 'Hata: ' . $e->getMessage();
    }
}
?>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Yeni Ürün Ekle</h2>
    <?php if ($error): ?><div class="bg-red-100 p-4 mb-4 text-red-700"><?php echo $error; ?></div><?php endif; ?>
    <?php if ($success): ?><div class="bg-green-100 p-4 mb-4 text-green-700"><?php echo $success; ?></div><?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow border">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="text" name="name" placeholder="Ürün Adı" class="p-2 border rounded" required>
            <select name="category_id" class="p-2 border rounded">
                <?php foreach ($categories as $cat): ?><option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option><?php endforeach; ?>
            </select>
        </div>
        <textarea name="description" placeholder="Açıklama" class="w-full p-2 border rounded mb-4" rows="4"></textarea>
        
        <div class="grid grid-cols-4 gap-4 mb-4">
            <input type="number" id="price" name="price" placeholder="Fiyat (TL)" class="p-2 border rounded" step="0.01" required>
            <input type="number" id="discount_percent" name="discount_percent" placeholder="İndirim %" class="p-2 border rounded" step="1">
            <input type="number" id="discounted_price" name="discounted_price" placeholder="İndirimli Fiyat" class="p-2 border rounded" step="0.01">
            <input type="number" name="stock" placeholder="Stok" class="p-2 border rounded" value="0">
        </div>
        
        <input type="text" name="slug" placeholder="Slug (URL)" class="w-full p-2 border rounded mb-4">
        
        <div class="flex gap-6 mb-6">
            <label><input type="checkbox" name="status" checked> Aktif</label>
            <label><input type="checkbox" name="featured"> Öne Çıkarılan</label>
        </div>

        <div class="grid grid-cols-4 gap-4 border-t pt-6">
            <?php for ($i = 1; $i <= 4; $i++): ?>
            <div>
                <h3 class="font-bold mb-2">Görsel <?php echo $i; ?></h3>
                <input type="file" name="image<?php echo $i; ?>" class="w-full mb-2 border p-1">
            </div>
            <?php endfor; ?>
        </div>
        <button type="submit" class="mt-6 bg-blue-600 text-white px-8 py-2 rounded">Kaydet</button>
    </form>
</div>

<script>
    const priceInput = document.getElementById('price');
    const percentInput = document.getElementById('discount_percent');
    const discountedInput = document.getElementById('discounted_price');

    // Fiyat veya % değiştiğinde indirimli fiyatı hesapla
    function calcDiscounted() {
        const price = parseFloat(priceInput.value) || 0;
        const percent = parseFloat(percentInput.value) || 0;
        discountedInput.value = (price * (1 - percent / 100)).toFixed(2);
    }

    // İndirimli fiyat değiştiğinde %'yi hesapla
    function calcPercent() {
        const price = parseFloat(priceInput.value) || 0;
        const discounted = parseFloat(discountedInput.value) || 0;
        if (price > 0) {
            percentInput.value = Math.round(((price - discounted) / price) * 100);
        }
    }

    priceInput.addEventListener('input', calcDiscounted);
    percentInput.addEventListener('input', calcDiscounted);
    discountedInput.addEventListener('input', calcPercent);
</script>