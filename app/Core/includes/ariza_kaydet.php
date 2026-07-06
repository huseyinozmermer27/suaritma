<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_soyad = $_POST['ad_soyad'] ?? '';
    $siparis_no = $_POST['siparis_no'] ?? '';
    $ariza_turu = $_POST['ariza_turu'] ?? '';
    $notlar = $_POST['notlar'] ?? '';

    if (empty($ad_soyad) || empty($siparis_no) || empty($ariza_turu) || empty($notlar)) {
        echo json_encode(['status' => 'error', 'message' => 'Lütfen tüm alanları doldurunuz.']);
        exit;
    }

    try {
        $stmt = $db->prepare("INSERT INTO ariza_bildirimleri (ad_soyad, siparis_no, ariza_turu, notlar) VALUES (?, ?, ?, ?)");
        $stmt->execute([$ad_soyad, $siparis_no, $ariza_turu, $notlar]);
        echo json_encode(['status' => 'success', 'message' => 'Arıza bildiriminiz başarıyla alındı.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Bir hata oluştu: ' . $e->getMessage()]);
    }
}
?>