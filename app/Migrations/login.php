<?php include '../Core/includes/header.php'; ?>

<main class="bg-gray-50 min-h-screen flex items-center py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8 md:p-12">
                <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Hesabınıza Giriş Yapın</h2>
                
                <form action="process_login.php" method="POST" class="space-y-6">
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
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="rememberMe" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded cursor-pointer">
                            <label for="rememberMe" class="ml-2 block text-sm text-gray-700 cursor-pointer">Beni Hatırla</label>
                        </div>
                        <a href="forgot-password.php" class="text-sm font-medium text-primary hover:text-opacity-80 transition-colors no-underline">Şifremi Unuttum?</a>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-black text-white py-4 rounded-lg font-bold uppercase tracking-wider hover:bg-gray-800 transform transition-all duration-300 active:scale-95 shadow-lg">Giriş Yap</button>
                    </div>
                </form>
                
                <div class="mt-8 text-center">
                    <p class="text-gray-600">Hesabınız yok mu? <a href="register.php" class="font-bold text-primary hover:text-opacity-80 transition-colors no-underline">Kayıt Olun</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../Core/includes/footer.php'; ?>
