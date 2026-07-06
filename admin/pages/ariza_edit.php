<?php
$id = $_GET['id'] ?? 0;
$t = $db->query("SELECT * FROM ariza_bildirimleri WHERE id = $id")->fetch();
if (!$t) die("Talep bulunamadı.");
?>

<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Arıza Bildirimi Düzenle <span class="text-gray-500 font-mono">#<?php echo $t['id']; ?></span></h2>
            <a href="?page=ariza_bildirimleri" class="text-sm text-gray-500 hover:text-gray-800">Geri Dön</a>
        </div>
        
        <form action="ariza_islem.php" method="POST" class="p-6 space-y-6">
            <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase">Ad Soyad</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 px-3 py-2 text-gray-600" value="<?php echo htmlspecialchars($t['ad_soyad']); ?>" disabled>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase">Sipariş No</label>
                    <input type="text" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 px-3 py-2 text-gray-600" value="<?php echo htmlspecialchars($t['siparis_no']); ?>" disabled>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase">Arıza Türü</label>
                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 px-3 py-2 text-gray-600" value="<?php echo htmlspecialchars($t['ariza_turu']); ?>" disabled>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase">Müşteri Notu</label>
                <textarea class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 px-3 py-2 text-gray-600" rows="3" disabled><?php echo htmlspecialchars($t['notlar']); ?></textarea>
            </div>

            <hr class="border-gray-200">

            <div>
                <label class="block text-sm font-medium text-gray-700">Arıza Durumu</label>
                <select name="ariza_durumu" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5">
                    <?php foreach(['Beklemede', 'Onaylandı', 'Reddedildi', 'Tamamlandı'] as $s): ?>
                        <option value="<?php echo $s; ?>" <?php echo ($t['ariza_durumu'] == $s) ? 'selected' : ''; ?>><?php echo $s; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Admin Notu</label>
                <textarea name="admin_notu" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5" rows="4"><?php echo htmlspecialchars($t['admin_notu']); ?></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition shadow-sm">
                    Bildirimi Güncelle
                </button>
            </div>
        </form>
    </div>
</div>