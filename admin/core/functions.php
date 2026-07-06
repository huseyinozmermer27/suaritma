<?php
// admin/core/functions.php

// Güvenli veri temizleme fonksiyonu
function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// SEO uyumlu URL oluşturma
function createSlug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

// Hata ve başarı mesajlarını yönetme (örnek)
function set_message($message, $type = 'success') {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['message'] = ['text' => $message, 'type' => $type];
}

function redirect($url) {
    if (!headers_sent()) {
        header("Location: $url");
    } else {
        echo "<script>window.location.href='$url';</script>";
    }
    exit;
}

function get_message() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return "<div class='alert alert-{$message['type']}'>{$message['text']}</div>";
    }
    return '';
}
?>