<?php
require_once __DIR__ . '/db.php';

// Tabloyu otomatik oluştur (eğer yoksa)
$db->exec("CREATE TABLE IF NOT EXISTS chat_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) NOT NULL,
    sender VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $sessionId = session_id();

    if ($action === 'send') {
        $message = trim($_POST['message'] ?? '');
        if (empty($message)) exit;

        // Ayarları çek (WhatsApp numarası için)
        $settings = [];
        $stmt = $db->query("SELECT s_key, s_value FROM settings");
        while ($row = $stmt->fetch()) {
            $settings[$row['s_key']] = $row['s_value'];
        }

        $stmt = $db->prepare("INSERT INTO chat_messages (session_id, sender, message) VALUES (?, 'customer', ?)");
        $stmt->execute([$sessionId, $message]);

        $botResponse = getBotResponse($message, $settings);
        
        $stmt = $db->prepare("INSERT INTO chat_messages (session_id, sender, message) VALUES (?, 'bot', ?)");
        $stmt->execute([$sessionId, $botResponse]);
        
        echo json_encode(['sender' => 'bot', 'message' => $botResponse]);
        exit;
    }

    if ($action === 'clear') {
        $stmt = $db->prepare("DELETE FROM chat_messages WHERE session_id = ?");
        $stmt->execute([$sessionId]);
        echo json_encode(['status' => 'cleared']);
        exit;
    }

    if ($action === 'fetch') {
        $stmt = $db->prepare("SELECT * FROM chat_messages WHERE session_id = ? ORDER BY created_at ASC");
        $stmt->execute([$sessionId]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
    }
}

function getBotResponse($msg, $settings) {
    $msg = mb_strtolower($msg, 'UTF-8');
    $waNumber = preg_replace('/[^0-9]/', '', $settings['contact_whatsapp'] ?? '905439541000');
    $waLink = "https://wa.me/$waNumber";

    // 1. WhatsApp Yönlendirme Tetikleyicileri
    $redirectKeywords = ['yönlendir', 'bağla', 'yetkili', 'müşteri temsilcisi', 'canlı destek', 'insan', 'kişi', 'telefon', 'whatsapp'];
    foreach ($redirectKeywords as $keyword) {
        if (strpos($msg, $keyword) !== false) {
            return json_encode(['type' => 'redirect', 'url' => $waLink]);
        }
    }

    // 2. Selamlaşma
    if (strpos($msg, 'merhaba') !== false || strpos($msg, 'selam') !== false || strpos($msg, 'günaydın') !== false || strpos($msg, 'iyi günler') !== false) {
        return "Merhaba! Ben Optimal Dijital Asistan. Size su arıtma sistemlerimiz, filtre değişimi veya servis talepleriniz hakkında bilgi verebilirim. Nasıl yardımcı olabilirim?";
    }

    // 3. Ürün/Model Soruları
    if (strpos($msg, 'fiyat') !== false || strpos($msg, 'ne kadar') !== false || strpos($msg, 'kaç tl') !== false) {
        return "Ürün fiyatlarımız modele ve özelliklere göre değişiklik göstermektedir. Güncel fiyatlarımızı 'Cihazlar' menüsünden inceleyebilir veya size özel teklif için WhatsApp hattımıza bağlanabilirsiniz.";
    }

    if (strpos($msg, 'pompalı') !== false || strpos($msg, 'pompasız') !== false || strpos($msg, 'basınç') !== false) {
        return "Eğer su basıncınız düşükse (4 bar altı), pompalı modellerimiz suyu daha verimli arıtır. Basıncınız normalse pompasız modelleri tercih edebilirsiniz. Sizin bölgenizde su basıncı nasıl?";
    }

    // 4. Montaj/Arıza/Servis
    if (strpos($msg, 'montaj') !== false || strpos($msg, 'kurulum') !== false) {
        return "Yeni aldığınız cihazlar için ücretsiz montaj hizmetimiz mevcuttur. Montaj randevusu oluşturmak için sizi yetkili birime aktarmamı ister misiniz? (Evet yazabilirsiniz)";
    }

    if (strpos($msg, 'arıza') !== false || strpos($msg, 'bozuk') !== false || strpos($msg, 'çalışmıyor') !== false || strpos($msg, 'servis') !== false) {
        return "Yaşadığınız teknik sorun için üzgünüz. Hızlı çözüm üretmemiz için sizi teknik ekibimize yönlendiriyorum. 'Yönlendir' yazarak WhatsApp'a geçebilirsiniz.";
    }

    // 5. Filtre Değişimi
    if (strpos($msg, 'filtre') !== false || strpos($msg, 'değişim') !== false || strpos($msg, 'bakım') !== false) {
        return "Sağlıklı su içmeye devam etmek için ön 3 filtrenin 6 ayda bir, ana filtrelerin ise yılda bir değişmesini öneriyoruz. Filtre setlerimizi web sitemizden sipariş edebilirsiniz.";
    }

    // 6. Onay/Evet (Genellikle yönlendirme öncesi)
    if ($msg === 'evet' || $msg === 'tamam' || $msg === 'olur' || $msg === 'aktar') {
        return json_encode(['type' => 'redirect', 'url' => $waLink]);
    }

    // 7. Fallback
    return "Anlayamadım, ancak size en iyi yardımı WhatsApp üzerinden bir temsilcimiz sağlayabilir. Teknik destek veya detaylı bilgi için 'yönlendir' yazabilir veya WhatsApp butonuna tıklayabilirsiniz.";
}
