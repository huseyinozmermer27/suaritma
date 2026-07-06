<?php
// admin/pages/product_edit.php
require_once __DIR__ . '/../core/auth.php';
global $db;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) redirect('index.php?page=products');

$categories = $db->query("SELECT id, name FROM categories WHERE status = 1 ORDER BY name ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean($_POST['name']);
    $cat_id = (int)$_POST['category_id'];
    $desc = clean($_POST['description']);
    $price = (float)$_POST['price'];
    $d_price = (float)$_POST['discounted_price'];
    $d_percent = (int)$_POST['discount_percent'];
    $stock = (int)$_POST['stock'];
    $slug = !empty($_POST['slug']) ? createSlug($_POST['slug']) : createSlug($name);
    $status = isset($_POST['status']) ? 1 : 0;
    $featured = isset($_POST['featured']) ? 1 : 0;

    try {
        $uploadDir = '../assets/uploads/products/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        
        $newImages = [
            $product['main_image'] ?? '', 
            $product['image2'] ?? '', 
            $product['image3'] ?? '', 
            $product['image4'] ?? ''
        ];

        for ($i = 1; $i <= 4; $i++) {
            $inputName = 'image' . $i;
            if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
                $fn = md5(time() . $i . $_FILES[$inputName]['name']) . '.' . strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));
                if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $uploadDir . $fn)) {
                    $newImages[$i-1] = $fn;
                }
            }
        }

        $stmt = $db->prepare("UPDATE products SET name=?, category_id=?, description=?, price=?, discounted_price=?, discount_percent=?, stock_count=?, slug=?, status=?, featured=?, main_image=?, image2=?, image3=?, image4=? WHERE id=?");
        $stmt->execute([$name, $cat_id, $desc, $price, $d_price, $d_percent, $stock, $slug, $status, $featured, $newImages[0], $newImages[1], $newImages[2], $newImages[3], $id]);
        
        $success = 'Ürün güncellendi.';
        // Veriyi tekrar çek
        $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
    } catch (Exception $e) { $error = $e->getMessage(); }
}
?>

<div class="p-6">
    <?php if(isset($success)) echo '<div class="bg-green-100 text-green-700 p-4 mb-4 rounded">'.$success.'</div>'; ?>
    <?php if(isset($error)) echo '<div class="bg-red-100 text-red-700 p-4 mb-4 rounded">'.$error.'</div>'; ?>
    <h2 class="text-2xl font-bold mb-6">Ürünü Düzenle</h2>
    <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow border">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" class="p-2 border rounded" required>
            <select name="category_id" class="p-2 border rounded">
                <?php foreach ($categories as $cat): ?><option value="<?php echo $cat['id']; ?>" <?php echo $product['category_id'] == $cat['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat['name']); ?></option><?php endforeach; ?>
            </select>
        </div>
        <textarea name="description" class="w-full p-2 border rounded mb-4" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
        <div class="grid grid-cols-4 gap-4 mb-4">
            <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" class="p-2 border rounded" step="0.01" placeholder="Fiyat">
            <input type="number" id="discount_percent" name="discount_percent" value="<?php echo $product['discount_percent']; ?>" class="p-2 border rounded" placeholder="İndirim %">
            <input type="number" id="discounted_price" name="discounted_price" value="<?php echo $product['discounted_price']; ?>" class="p-2 border rounded" step="0.01" placeholder="İndirimli Fiyat">
            <input type="number" name="stock" value="<?php echo $product['stock_count']; ?>" class="p-2 border rounded" placeholder="Stok">
        </div>
        <input type="text" name="slug" value="<?php echo htmlspecialchars($product['slug']); ?>" class="w-full p-2 border rounded mb-4">
        <div class="flex gap-6 mb-6">
            <label><input type="checkbox" name="status" <?php echo $product['status'] ? 'checked' : ''; ?>> Aktif</label>
            <label><input type="checkbox" name="featured" <?php echo $product['featured'] ? 'checked' : ''; ?>> Öne Çıkarılan</label>
        </div>
        
        <div class="grid grid-cols-4 gap-4 border-t pt-6">
            <?php for ($i = 1; $i <= 4; $i++): $imgCol = ($i == 1) ? 'main_image' : 'image'.$i; ?>
            <div>
                <h3 class="font-bold mb-2">Görsel <?php echo $i; ?></h3>
                <?php if (!empty($product[$imgCol] ?? '')): ?>
                    <img src="../assets/uploads/products/<?php echo htmlspecialchars($product[$imgCol] ?? ''); ?>" class="h-16 mb-2 border rounded">
                <?php endif; ?>
                <input type="file" name="image<?php echo $i; ?>" class="w-full border p-1">
            </div>
            <?php endfor; ?>
        </div>
        <button type="submit" class="mt-6 bg-blue-600 text-white px-8 py-2 rounded">Güncelle</button>
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