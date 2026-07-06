<!-- Chat Widget UI -->
<div id="chat-container" class="fixed bottom-24 right-6 z-50 w-80 hidden">
    <div class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
        <div class="bg-gray-950 text-white p-4 flex justify-between items-center border-b border-gray-850">
            <span class="font-bold text-white">Optimal Destek</span>
            <button onclick="toggleChat()" class="text-gray-400 hover:text-white transition-colors"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div id="chat-messages" class="h-64 overflow-y-auto p-4 bg-gray-950 flex flex-col gap-2"></div>
        <div class="p-3 border-t border-gray-800 bg-gray-900 flex gap-2">
            <input type="text" id="chat-input" placeholder="Mesajınızı yazın..." class="flex-1 p-2 bg-gray-800 border border-gray-700 text-white rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500">
            <button onclick="sendMessage()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">Gönder</button>
        </div>
    </div>
</div>

<!-- Chat Toggle Button -->
<button onclick="toggleChat()" class="fixed bottom-6 right-6 z-50 bg-gray-900 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform duration-300">
    <i class="fa-solid fa-comments text-2xl"></i>
</button>

<script>
    // Sayfa yüklendiğinde geçmişi temizle
    (async () => {
        const formData = new FormData();
        formData.append('action', 'clear');
        await fetch('<?php echo $base_url; ?>chat-handler', { method: 'POST', body: formData });
    })();

    function toggleChat() {
        const chat = document.getElementById('chat-container');
        chat.classList.toggle('hidden');
        if(!chat.classList.contains('hidden')) {
            fetchMessages();
        }
    }

    async function sendMessage() {
        const input = document.getElementById('chat-input');
        if(!input.value.trim()) return;
        
        const message = input.value;
        input.value = '';
        
        const formData = new FormData();
        formData.append('action', 'send');
        formData.append('message', message);
        
        try {
            const res = await fetch('<?php echo $base_url; ?>chat-handler', { method: 'POST', body: formData });
            const result = await res.json();
            
            // Yönlendirme Kontrolü
            try {
                const botData = JSON.parse(result.message);
                if (botData.type === 'redirect') {
                    window.location.href = botData.url;
                    return;
                }
            } catch(e) {}
            
            fetchMessages();
        } catch(e) { console.error('Chat error:', e); }
    }

    async function fetchMessages() {
        const formData = new FormData();
        formData.append('action', 'fetch');
        try {
            const res = await fetch('<?php echo $base_url; ?>chat-handler', { method: 'POST', body: formData });
            const msgs = await res.json();
            
            const container = document.getElementById('chat-messages');
            container.innerHTML = msgs.map(m => `
                <div class="p-2 rounded-lg text-sm ${m.sender === 'customer' ? 'bg-blue-600 text-white self-end' : 'bg-gray-800 text-gray-100 self-start'}">
                    ${m.message}
                </div>
            `).join('');
            container.scrollTop = container.scrollHeight;
        } catch(e) { console.error('Fetch error:', e); }
    }
</script>