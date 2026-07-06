<?php
include 'includes/db.php';
session_start();

// Admin yetki kontrolü (Şimdilik basit tutuyoruz)
// if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }

$action = $_POST['action'] ?? '';

// Admin cevap gönderimi
if ($action === 'reply') {
    $sessionId = $_POST['session_id'];
    $message = $_POST['message'];
    $stmt = $db->prepare("INSERT INTO chat_messages (session_id, sender, message) VALUES (?, 'admin', ?)");
    $stmt->execute([$sessionId, $message]);
    
    // Mesaj okundu ve admin tarafından cevaplandı olarak işaretle
    $stmt = $db->prepare("UPDATE chat_messages SET needs_admin = 0 WHERE session_id = ?");
    $stmt->execute([$sessionId]);
    exit;
}

// Aktif sohbetleri getir
$stmt = $db->query("SELECT session_id, message, created_at FROM chat_messages WHERE needs_admin = 1 GROUP BY session_id ORDER BY created_at DESC");
$pendingChats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sumosu - Destek Yönetim Paneli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex h-screen">
        <!-- Sol Sidebar: Sohbet Listesi -->
        <div class="w-1/3 bg-white border-r flex flex-col">
            <div class="p-6 border-b bg-primary text-white">
                <h1 class="text-xl font-bold">Destek Paneli</h1>
                <p class="text-sm opacity-80">Bekleyen Mesajlar</p>
            </div>
            <div class="flex-grow overflow-y-auto">
                <?php foreach ($pendingChats as $chat): ?>
                <div onclick="loadChat('<?php echo $chat['session_id']; ?>')" class="p-4 border-b hover:bg-gray-50 cursor-pointer transition-colors border-l-4 border-primary bg-blue-50">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-sm text-gray-800">Müşteri #<?php echo substr($chat['session_id'], 0, 8); ?></span>
                        <span class="text-[10px] text-gray-400"><?php echo date('H:i', strtotime($chat['created_at'])); ?></span>
                    </div>
                    <p class="text-xs text-gray-600 truncate"><?php echo $chat['message']; ?></p>
                </div>
                <?php endforeach; ?>
                <?php if (empty($pendingChats)): ?>
                <div class="p-10 text-center text-gray-400">
                    <i class="fas fa-check-circle text-4xl mb-3"></i>
                    <p>Bekleyen mesaj bulunmuyor.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sağ Taraf: Mesajlaşma Alanı -->
        <div class="flex-grow flex flex-col bg-gray-50">
            <div id="chat-header" class="p-6 border-b bg-white flex items-center justify-between shadow-sm">
                <h2 class="text-lg font-bold text-gray-800">Sohbet Detayı</h2>
                <span id="active-session-id" class="text-xs text-gray-400">Bir sohbet seçin</span>
            </div>
            
            <div id="admin-messages" class="flex-grow p-8 overflow-y-auto flex flex-col gap-4">
                <div class="m-auto text-gray-400 text-center">
                    <i class="fas fa-comments text-5xl mb-4"></i>
                    <p>Mesajları görüntülemek için soldan bir kullanıcı seçin.</p>
                </div>
            </div>

            <div class="p-6 bg-white border-t">
                <form id="admin-reply-form" class="flex gap-4">
                    <input type="hidden" id="current-session-id" value="">
                    <input type="text" id="admin-input" placeholder="Cevabınızı yazın..." class="flex-grow border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-primary/20">
                    <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary/90 transition-all">GÖNDER</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function loadChat(sessionId) {
            document.getElementById('current-session-id').value = sessionId;
            document.getElementById('active-session-id').innerText = "Session: " + sessionId;
            
            fetchMessages(sessionId);
        }

        function fetchMessages(sessionId) {
            const formData = new FormData();
            formData.append('action', 'fetch');
            // includes/chat_handler.php session_id'yi PHP session'dan alıyor, admin için ayrı bir handler gerekebilir 
            // veya admin handler'ı session_id parametresi alacak şekilde düzenlenebilir.
            // Şimdilik admin için basit bir fetch API ekliyoruz.
        }

        // Admin Mesaj Gönderme
        document.getElementById('admin-reply-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const sid = document.getElementById('current-session-id').value;
            const msg = document.getElementById('admin-input').value;
            if (!sid || !msg) return;

            const formData = new FormData();
            formData.append('action', 'reply');
            formData.append('session_id', sid);
            formData.append('message', msg);

            fetch('admin_destek.php', {
                method: 'POST',
                body: formData
            }).then(() => {
                document.getElementById('admin-input').value = '';
                // Mesajları yenile
                location.reload(); 
            });
        });
    </script>
</body>
</html>
