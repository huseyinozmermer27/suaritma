<?php include '../Core/includes/header.php'; ?>

<main class="bg-gray-50 min-h-screen flex items-center py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8 md:p-12">
                <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Hesap Oluşturun</h2>
                
                <form action="process_register.php" method="POST" class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Ad Soyad</label>
                        <input type="text" id="name" name="name" placeholder="Adınız Soyadınız" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">E-posta Adresi</label>
                        <input type="email" id="email" name="email" placeholder="ornek@email.com" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Şifre</label>
                        <input type="password" id="password" name="password" placeholder="En az 6 karakter" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-2">Şifreyi Onayla</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Şifrenizi tekrar girin" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="termsAgreement" required class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded cursor-pointer">
                        <label for="termsAgreement" class="ml-2 block text-sm text-gray-700 cursor-pointer">Şartları ve Koşulları <a href="#" class="font-bold text-primary hover:text-opacity-80 transition-colors no-underline">kabul ediyorum</a>.</label>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-black text-white py-4 rounded-lg font-bold uppercase tracking-wider hover:bg-gray-800 transform transition-all duration-300 active:scale-95 shadow-lg">Kayıt Ol</button>
                    </div>
                </form>
                
                <div class="mt-8 text-center">
                    <p class="text-gray-600">Zaten bir hesabınız var mı? <a href="login.php" class="font-bold text-primary hover:text-opacity-80 transition-colors no-underline">Giriş Yapın</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../Core/includes/footer.php'; ?>
