<?php
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Geçersiz istek.']);
    exit;
}

$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$name = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 5;
$comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

if (empty($name) || empty($comment)) {
    echo json_encode(['success' => false, 'message' => 'Lütfen tüm alanları doldurun.']);
    exit;
}

$video_path = null;

if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['video']['tmp_name'];
    $fileName = $_FILES['video']['name'];
    $fileSize = $_FILES['video']['size'];
    $fileType = $_FILES['video']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Kontroller
    $allowedExtensions = ['mp4', 'mov', 'avi', 'wmv', 'mkv'];
    $maxSize = 20 * 1024 * 1024; // 20MB

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo json_encode(['success' => false, 'message' => 'Sadece MP4, MOV, AVI, WMV ve MKV formatları desteklenir.']);
        exit;
    }

    if ($fileSize > $maxSize) {
        echo json_encode(['success' => false, 'message' => 'Video boyutu maksimum 20MB olmalıdır.']);
        exit;
    }

    // Benzersiz isim ve yükleme
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $uploadFileDir = __DIR__ . '/../assets/uploads/reviews/';
    $dest_path = $uploadFileDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $video_path = 'assets/uploads/reviews/' . $newFileName;
    } else {
        echo json_encode(['success' => false, 'message' => 'Video yüklenirken bir hata oluştu.']);
        exit;
    }
}

try {
    $stmt = $db->prepare("INSERT INTO customer_reviews (product_id, customer_name, rating, comment, video_path, status) VALUES (?, ?, ?, ?, ?, 0)");
    $stmt->execute([$product_id, $name, $rating, $comment, $video_path]);
    
    echo json_encode(['success' => true, 'message' => 'Yorumunuz onaya gönderildi. Teşekkür ederiz!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Veritabanı hatası: ' . $e->getMessage()]);
}
