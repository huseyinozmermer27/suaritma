<?php

/**
 * XSS Koruması için veriyi temizler
 */
function clean($data) {
    if (is_array($data)) {
        return array_map('clean', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * URL uyumlu slug oluşturur
 */
function slugify($text) {
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
    $text = strtolower(str_replace($find, $replace, $text));
    $text = preg_replace("@[^A-Za-z0-9\-_\.\s]@i", ' ', $text);
    $text = trim(preg_replace('/\s\s+/', ' ', $text));
    $text = str_replace(' ', '-', $text);
    $text = preg_replace('/\-\-+/', '-', $text);
    return $text;
}

/**
 * Başarı mesajı döndürür
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * JSON formatında çıktı verir (API ihtiyaçları için)
 */
function responseJson($status, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}
?>
