<?php
require_once __DIR__ . '/../core/auth.php';

$error = '';
$success = '';

// Ayarları çek
$settings = [];
global $db;
$stmt = $db->query("SELECT s_key, s_value FROM settings");
while ($row = $stmt->fetch()) {
    $settings[$row['s_key']] = $row['s_value'];
}
$marquee_items = json_decode($settings['marquee_items'] ?? '[]', true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verileri güncelle
    updateSetting($db, 'site_title', clean($_POST['site_title']));
    updateSetting($db, 'footer_text', clean($_POST['footer_text']));
    updateSetting($db, 'contact_phone', clean($_POST['contact_phone']));
    updateSetting($db, 'contact_email', clean($_POST['contact_email']));
    updateSetting($db, 'contact_address', clean($_POST['contact_address']));
    updateSetting($db, 'contact_whatsapp', clean($_POST['contact_whatsapp']));
    
    // Marquee listesini güncelle (boş olanları filtrele)
    $new_marquee = array_filter($_POST['marquee_item'] ?? []);
    updateSetting($db, 'marquee_items', json_encode(array_values($new_marquee)));

    $success = 'Ayarlar başarıyla kaydedildi.';
    $marquee_items = array_values($new_marquee);
    
    // Güncel ayarları tekrar çek
    $stmt = $db->query("SELECT s_key, s_value FROM settings");
    while ($row = $stmt->fetch()) {
        $settings[$row['s_key']] = $row['s_value'];
    }
}

function updateSetting($db, $key, $value) {
    $stmt = $db->prepare("INSERT INTO settings (s_key, s_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE s_value = ?");
    $stmt->execute([$key, $value, $value]);
}
?>

<div class="container-fluid">
    <h2>Site Ayarları</h2>
    <?php if ($success): ?><div class="alert alert-success"><?php echo $success; ?></div><?php endif; ?>
    
    <form method="POST">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Genel Ayarlar</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Site Başlığı</label>
                            <input type="text" name="site_title" class="form-control" value="<?php echo htmlspecialchars($settings['site_title'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kayan Yazılar (Duyuru Çubuğu)</label>
                            <div id="marquee-list">
                                <?php foreach ($marquee_items as $item): ?>
                                    <div class="input-group mb-2">
                                        <input type="text" name="marquee_item[]" class="form-control" value="<?php echo htmlspecialchars($item); ?>">
                                        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Sil</button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addMarquee()">+ Yeni Yazı Ekle</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">İletişim Bilgileri</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Telefon</label>
                            <input type="text" name="contact_phone" class="form-control" value="<?php echo htmlspecialchars($settings['contact_phone'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-posta</label>
                            <input type="email" name="contact_email" class="form-control" value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">WhatsApp Numarası (Örn: 905001234567)</label>
                            <input type="text" name="contact_whatsapp" class="form-control" value="<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adres</label>
                            <textarea name="contact_address" class="form-control" rows="3"><?php echo htmlspecialchars($settings['contact_address'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 py-2">Tüm Ayarları Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="text-lg font-bold mb-4">Yardıma mı ihtiyacınız var?</h5>
            <p class="text-gray-600 text-sm leading-relaxed">Müşteri hizmetlerimize destek@sumosuaritma.com e-posta adresinden ulaşabilir veya 0850 532 58 32 numaralı telefonu arayabilirsiniz.</p>
        </div>
    </div>
</div>

<script>
function addMarquee() {
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = '<input type="text" name="marquee_item[]" class="form-control" placeholder="Yeni yazı..."><button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Sil</button>';
    document.getElementById('marquee-list').appendChild(div);
}
document.getElementById('nav-settings').classList.add('active');
</script>
<?php include '../includes/footer.php'; ?>
