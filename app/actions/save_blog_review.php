<?php
// actions/save_blog_review.php
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = trim($_POST['customer_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if (empty($customer_name) || empty($email) || empty($comment)) {
        echo "<script>alert('Lütfen tüm alanları doldurunuz.'); window.history.back();</script>";
        exit;
    }

    try {
        // product_reviews tablosuna ekle
        // status = 0 (Onay bekliyor) olarak kaydediyoruz ki admin panelden onaylansın
        $stmt = $db->prepare("INSERT INTO product_reviews (customer_name, comment, status) VALUES (?, ?, 0)");
        $stmt->execute([$customer_name, $comment]);

        $slug = trim($_POST['slug'] ?? '');
        $redirect_url = $slug ? "../blogs/blog-detail.php?slug=" . $slug : "../index.php";

        echo "<script>alert('Yorumunuz başarıyla gönderildi. Onaylandıktan sonra yayınlanacaktır.'); window.location.href='$redirect_url';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Bir hata oluştu: " . $e->getMessage() . "'); window.history.back();</script>";
    }
} else {
    header("Location: ../index.php");
    exit;
}
?>