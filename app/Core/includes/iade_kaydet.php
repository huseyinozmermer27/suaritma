<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_soyad = $_POST['ad_soyad'] ?? '';
    $siparis_no = $_POST['siparis_no'] ?? '';
    $iade_nedeni = $_POST['iade_nedeni'] ?? '';
    $notlar = $_POST['notlar'] ?? '';

    if (empty($ad_soyad) || empty($siparis_no) || empty($iade_nedeni) || empty($notlar)) {
        echo json_encode(['status' => 'error', 'message' => 'Lütfen tüm alanları doldurunuz.']);
        exit;
    }

    try {
        $stmt = $db->prepare("INSERT INTO iade_talepleri (ad_soyad, siparis_no, iade_nedeni, notlar) VALUES (?, ?, ?, ?)");
        $stmt->execute([$ad_soyad, $siparis_no, $iade_nedeni, $notlar]);
        echo json_encode(['status' => 'success', 'message' => 'İade talebiniz başarıyla alındı.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Bir hata oluştu: ' . $e->getMessage()]);
    }
}
?>
