<?php
// Filtreleme
$durum = $_GET['filtre'] ?? 'Hepsi';
$sql = "SELECT * FROM ariza_bildirimleri";
if ($durum !== 'Hepsi') {
    $sql .= " WHERE ariza_durumu = " . $db->quote($durum);
}
$sql .= " ORDER BY id DESC";
$talepler = $db->query($sql)->fetchAll();

$durumlar = ['Hepsi', 'Beklemede', 'Onaylandı', 'Reddedildi', 'Tamamlandı'];
?>

<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Arıza Bildirimleri</h1>
        <div class="flex flex-wrap gap-2">
            <?php foreach ($durumlar as $d): ?>
                <a href="?page=ariza_bildirimleri&filtre=<?php echo $d; ?>" 
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-all <?php echo ($durum == $d) ? 'bg-blue-600 text-white shadow-md' : 'bg-white border text-gray-600 hover:bg-gray-50'; ?>">
                    <?php echo $d; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Müşteri</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Arıza</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">İşlem</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($talepler as $t): 
                    $colors = [
                        'Beklemede' => 'bg-amber-100 text-amber-800',
                        'Onaylandı' => 'bg-blue-100 text-blue-800',
                        'Reddedildi' => 'bg-red-100 text-red-800',
                        'Tamamlandı' => 'bg-emerald-100 text-emerald-800'
                    ];
                    $badgeClass = $colors[$t['ariza_durumu']] ?? 'bg-gray-100 text-gray-800';
                ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-mono text-sm text-gray-500">#<?php echo $t['id']; ?></td>
                    <td class="px-6 py-4 font-medium text-gray-900"><?php echo htmlspecialchars($t['ad_soyad']); ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($t['ariza_turu']); ?></td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full <?php echo $badgeClass; ?>">
                            <?php echo $t['ariza_durumu']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="?page=ariza_edit&id=<?php echo $t['id']; ?>" class="text-blue-600 hover:text-blue-900 font-medium text-sm">Düzenle</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>