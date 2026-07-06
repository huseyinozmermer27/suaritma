<?php include '../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white min-h-[70vh] flex items-center">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Sol: Görsel -->
            <div class="w-full">
                <img src="<?php echo $base_url; ?>../assets/img/iade_r.jpg" alt="İade Talebi" class="w-full h-auto rounded-3xl shadow-xl">
            </div>

            <!-- Sağ: İçerik -->
            <div class="w-full">
                <h1 class="text-4xl font-bold text-secondary mb-4">İade Talep Formu</h1>
                <p class="text-gray-600 text-lg mb-8">Ürün iade sürecinizi başlatmak için lütfen aşağıdaki bilgileri doldurun.</p>
                
                <button id="open-form" class="bg-black text-white px-16 py-3 rounded-xl font-bold hover:bg-gray-800 transition-all text-lg mb-6 shadow-md">
                    İadeyi Başlat
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="form-modal" class="fixed inset-0 bg-black bg-opacity-60 hidden z-[100] flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-2xl rounded-2xl p-8 relative shadow-2xl overflow-y-auto max-h-[90vh]">
            <button id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-black">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
            <h2 class="text-2xl font-bold mb-6">İade Talep Formu</h2>
            <form id="iade-form" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Ad Soyad <span class="text-red-500">*</span></label>
                    <input type="text" name="ad_soyad" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Sipariş Numarası <span class="text-red-500">*</span></label>
                    <input type="text" name="siparis_no" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">İade Nedeni <span class="text-red-500">*</span></label>
                    <select name="iade_nedeni" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                        <option value="">Seçiniz</option>
                        <option value="Ürün Hasarlı">Ürün Hasarlı</option>
                        <option value="Yanlış Ürün">Yanlış Ürün</option>
                        <option value="Cayma Hakkı">Cayma Hakkı</option>
                        <option value="Diğer">Diğer</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Açıklama / Notlar <span class="text-red-500">*</span></label>
                    <textarea name="notlar" required placeholder="İade sebebinizi detaylıca belirtiniz..." class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all"></textarea>
                </div>
                <button type="submit" class="w-full bg-black text-white py-4 rounded-xl font-bold hover:bg-gray-800 transition-all">İade Talebi Gönder</button>
            </form>
            <div id="form-message" class="hidden mt-4 p-4 rounded-xl text-center font-semibold"></div>
        </div>
    </div>
</main>

<script>
    const openBtn = document.getElementById('open-form');
    const closeBtn = document.getElementById('close-modal');
    const modal = document.getElementById('form-modal');
    const form = document.getElementById('iade-form');
    const messageBox = document.getElementById('form-message');

    openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

    form.querySelectorAll('input, textarea, select').forEach(el => {
        el.addEventListener('blur', () => {
            if (el.hasAttribute('required') && !el.value) {
                el.classList.add('border-red-500', 'ring-1', 'ring-red-500');
            } else {
                el.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
            }
        });
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500', 'ring-1', 'ring-red-500'));
        
        let isValid = true;
        form.querySelectorAll('[required]').forEach(el => {
            if (!el.value) {
                el.classList.add('border-red-500', 'ring-1', 'ring-red-500');
                isValid = false;
            }
        });

        if (!isValid) {
            messageBox.classList.remove('hidden', 'bg-green-100', 'text-green-800');
            messageBox.classList.add('bg-red-100', 'text-red-800');
            messageBox.textContent = 'Lütfen tüm alanları eksiksiz doldurunuz.';
            return;
        }
        
        const formData = new FormData(form);
        const response = await fetch('<?php echo $base_url; ?>../app/Core/includes/iade_kaydet.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        
        messageBox.classList.remove('hidden', 'bg-green-100', 'bg-red-100', 'text-green-800', 'text-red-800');
        messageBox.classList.add(result.status === 'success' ? 'bg-green-100' : 'bg-red-100', result.status === 'success' ? 'text-green-800' : 'text-red-800');
        messageBox.textContent = result.message;
        
        if (result.status === 'success') form.reset();
    });
</script>

<?php include '../../../app/Core/includes/footer.php'; ?>


