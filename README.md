# Sumosu Su Arıtma Klonu (PHP)

Bu proje, `sumosuaritma.com` web sitesinin minimalist e-ticaret tasarımını ve temel yapısını PHP ile klonlamayı amaçlamaktadır.

## Proje Durumu
Şu ana kadar aşağıdaki ana bileşenler tamamlanmıştır:

*   **Klasör Yapısı:** PHP projesi için gerekli `assets/css`, `assets/js`, `assets/img` ve `includes` klasörleri oluşturuldu.
*   **CSS Stilleri (`assets/css/style.css`):** Sumosu'nun beyaz ağırlıklı, modern ve e-ticaret odaklı tasarımına uygun temel CSS stilleri tanımlandı.
*   **Duyuru Çubuğu (Announcement Bar):** Siyah zemin üzerine beyaz metinli ve kayan (marquee) yapıya geçildi, yazı boyutu ve çubuk yüksekliği artırıldı.
*   **Header & Navigasyon:** Bootstrap bağımlılığı kaldırılarak tamamen özel CSS ile yeniden tasarlandı. Logo en sola, menüler merkeze ve ikonlar en sağa yerleştirildi.
*   **Dropdown Menüler:** "Ürünler" ve "Destek" menülerine aşağı ok ikonları eklendi. Arka planı beyaz olan bu menüler, üzerine gelindiğinde (hover) siyah arka plan ve beyaz yazı rengine dönüşecek şekilde özelleştirildi.
*   **Footer (`includes/footer.php`):**
    *   Şirket bilgileri, hızlı menü ve iletişim bilgilerini içeren kurumsal footer yapısı oluşturuldu.
    *   WhatsApp hızlı destek butonu entegre edildi.
*   **Ana Sayfa (`index.php`):**
    *   **Hero Alanı:** Sumosu tarzı büyük görsel, başlık ve CTA butonları.
    *   **Hizmet Avantajları:** "Neden Biz?" bölümü ile güven veren ikonlu özellikler.
    *   **Ürün Kategorileri:** Görsel ağırlıklı kategori kartları.
    *   **Sosyal Kanıt (Instagram Feed):** Marka güvenilirliğini artırmak için örnek Instagram grid yapısı.
    *   **İletişim CTA:** Doğrudan arama butonu içeren alt bölüm.

## Nasıl Çalıştırılır?

1.  `C:\xampp\htdocs\suaritma` dizinine gidin.
2.  Bir terminal veya komut istemcisi açın.
3.  Aşağıdaki komutu çalıştırarak PHP geliştirme sunucusunu başlatın:
    ```bash
    php -S localhost:8000
    ```
4.  Tarayıcınızı açın ve `http://localhost:8000` adresine gidin.

## Sonraki Adımlar
Projede planlanan diğer bölümler:

*   **Ürün Detay Sayfası (`urun-detay.php`):** Ürün özelliklerinin ve fiyat bilgilerinin sergilendiği sayfa.
*   **Hakkımızda Sayfası (`hakkimizda.php`):** Şirket hikayesi ve misyonu.
*   **İletişim Sayfası (`iletisim.php`):** Detaylı iletişim formu ve harita.
*   **Güven Rozetleri:** Ödeme yöntemleri ve sertifikalar için ikonlar.
*   **Müşteri Yorumları Bölümü:** Gerçek müşteri deneyimlerinin paylaşıldığı slider.
