<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Su Arıtma</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <style>
        .variant-container { display: flex; gap: 10px; margin-top: 20px; }
        .variant-item { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .variant-image { width: 100px; height: 100px; object-fit: contain; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        
        <div class="product-info">
            <p><?php echo $product['description'] ?? 'Ürün açıklaması bulunmamaktadır.'; ?></p>
        </div>

        <?php if (!empty($product['variants'])): ?>
            <h3>Renk Seçenekleri</h3>
            <div class="variant-container">
                <?php foreach ($product['variants'] as $variant): ?>
                    <div class="variant-item">
                        <img src="<?php echo BASE_URL; ?>assets/img/products/<?php echo htmlspecialchars($variant['image']); ?>" 
                             alt="<?php echo htmlspecialchars($variant['color']); ?>" 
                             class="variant-image">
                        <p><?php echo htmlspecialchars($variant['color']); ?></p>
                        <small><?php echo htmlspecialchars($variant['title']); ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>


