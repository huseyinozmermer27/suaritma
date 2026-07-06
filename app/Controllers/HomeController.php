<?php
// Ana sayfa Controller'ı
namespace App\Controllers;

class HomeController
{
    public function index()
    {
        // Veritabanı bağlantısını Singleton'dan al
        $db = \App\Core\Database::getInstance()->getConnection();
        
        // Gerekli verileri çek (Örn: Slider)
        // Not: Eski sistemdeki $db değişkenini burada kullanabiliriz.
        // Ancak eski sistemde $db doğrudan includes/db.php'den geliyordu.
        // Singleton yapımızda DB'yi böyle alıyoruz.
        
        require_once '../views/frontend/main-page.php';
    }
}
