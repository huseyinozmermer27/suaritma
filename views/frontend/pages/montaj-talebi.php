<?php include '../../../app/Core/includes/header.php'; ?>

<main class="py-16 bg-white min-h-[70vh] flex items-center">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="w-full">
                <img src="<?php echo $base_url; ?>../assets/img/montaj_r.jpg" alt="Montaj Talebi" class="w-full h-auto rounded-3xl shadow-xl">
            </div>

            <div class="w-full">
                <h1 class="text-4xl font-bold text-secondary mb-4">Montaj Talep Formu</h1>
                <p class="text-gray-600 text-lg mb-8">Montaj hizmeti almak için lütfen aşağıdaki bilgileri doldurun.</p>

                <button id="open-form" class="bg-black text-white px-16 py-3 rounded-xl font-bold hover:bg-gray-800 transition-all text-lg mb-6 shadow-md">
                    Montaj Talebi Oluştur
                </button>
            </div>
        </div>
    </div>

    <div id="form-modal" class="fixed inset-0 bg-black bg-opacity-60 hidden z-[100] flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-2xl rounded-2xl p-8 relative shadow-2xl overflow-y-auto max-h-[90vh]">
            <button id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-black">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
            <h2 class="text-2xl font-bold mb-6">Montaj Talep Formu</h2>
            <form id="montaj-form" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Ad Soyad <span class="text-red-500">*</span></label>
                    <input type="text" name="ad_soyad" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Sipariş Numarası <span class="text-red-500">*</span></label>
                    <input type="text" name="siparis_no" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Telefon <span class="text-red-500">*</span></label>
                    <input type="text" name="telefon" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Montaj Adresi <span class="text-red-500">*</span></label>
                    <textarea name="adres" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Notlar</label>
                    <textarea name="notlar" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"></textarea>       
                </div>
                <button type="submit" class="w-full bg-black text-white py-4 rounded-xl font-bold hover:bg-gray-800 transition-all">Talebi Gönder</button>
            </form>
            <div id="form-message" class="hidden mt-4 p-4 rounded-xl text-center font-semibold"></div>
        </div>
    </div>
</main>

<script>
    const openBtn = document.getElementById('open-form');
    const closeBtn = document.getElementById('close-modal');
    const modal = document.getElementById('form-modal');
    const form = document.getElementById('montaj-form');
    const messageBox = document.getElementById('form-message');

    openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const response = await fetch('<?php echo $base_url; ?>../app/Core/includes/montaj_kaydet.php', { method: 'POST', body: formData });
        const result = await response.json();

        messageBox.classList.remove('hidden', 'bg-green-100', 'bg-red-100', 'text-green-800', 'text-red-800');  
        messageBox.classList.add(result.status === 'success' ? 'bg-green-100' : 'bg-red-100', result.status === 'success' ? 'text-green-800' : 'text-red-800');
        messageBox.textContent = result.message;

        if (result.status === 'success') form.reset();
    });
</script>

<?php include '../../../app/Core/includes/footer.php'; ?>


