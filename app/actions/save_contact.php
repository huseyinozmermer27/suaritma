<?php
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('Lütfen tüm alanları doldurunuz.'); window.history.back();</script>";
        exit;
    }

    try {
        $stmt = $db->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);
        echo "<script>alert('Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.'); window.location.href='../iletisim.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Bir hata oluştu: " . $e->getMessage() . "'); window.history.back();</script>";
    }
} else {
    header("Location: ../iletisim.php");
    exit;
}
?>