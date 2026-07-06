<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_soyad = $_POST['ad_soyad'] ?? '';
    $siparis_no = $_POST['siparis_no'] ?? '';
    $adres = $_POST['adres'] ?? '';
    $telefon = $_POST['telefon'] ?? '';
    $notlar = $_POST['notlar'] ?? '';

    if (empty($ad_soyad) || empty($siparis_no) || empty($adres) || empty($telefon)) {
        echo json_encode(['status' => 'error', 'message' => 'Lütfen gerekli alanları doldurunuz.']);
        exit;
    }

    try {
        $stmt = $db->prepare("INSERT INTO montaj_talepleri (ad_soyad, siparis_no, adres, telefon, notlar) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$ad_soyad, $siparis_no, $adres, $telefon, $notlar]);
        echo json_encode(['status' => 'success', 'message' => 'Montaj talebiniz başarıyla alındı.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Bir hata oluştu: ' . $e->getMessage()]);
    }
}
?>