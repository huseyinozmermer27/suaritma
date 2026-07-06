<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

$product_id = (int)($_POST['product_id'] ?? 0);
$name = trim($_POST['customer_name'] ?? '');
$rating = (int)($_POST['rating'] ?? 5);
$comment = trim($_POST['comment'] ?? '');
$uploaded_files = [];

if (!$name || !$comment || !isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
    echo json_encode(['success' => false, 'message' => 'Lütfen tüm alanları doldurun ve en az bir fotoğraf yükleyin.']);
    exit;
}

if (isset($_FILES['images'])) {
    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
            $fileName = md5(time() . $_FILES['images']['name'][$key]) . '.jpg';
            $dest = __DIR__ . '/../assets/uploads/reviews/' . $fileName;
            if (move_uploaded_file($tmpName, $dest)) {
                $uploaded_files[] = 'assets/uploads/reviews/' . $fileName;
            }
        }
    }
}

$stmt = $db->prepare("INSERT INTO product_reviews (product_id, customer_name, rating, comment, image_urls) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$product_id, $name, $rating, $comment, implode(',', $uploaded_files)]);
echo json_encode(['success' => true]);
