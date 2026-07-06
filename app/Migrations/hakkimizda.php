<?php include __DIR__ . '/../Core/includes/header.php'; ?>

<main class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <section class="relative py-24 bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1548839140-29a74b630580?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover opacity-40" alt="Su Arıtma Arka Plan">
        </div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6">Hakkımızda</h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto italic">Sağlıklı Su, Güvenilir Hizmet, Optimal Çözümler</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <img src="https://images.unsplash.com/photo-1548839140-29a74b630580?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full rounded-3xl shadow-2xl" alt="Hakkımızda">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">Optimal Su Arıtma Sistemleri</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">Optimal Evsel ve Endüstriyel Su Arıtma Sistemleri, hem evinizde hem de iş yerlerinizde içilebilir sağlıklı su hizmeti sunan öncü bir su arıtma firmasıdır.</p>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">Su arıtma alanında uzman teknik servis kadrosu ile müşterilerine hızlı ve etkili bir şekilde hizmet sunmaktadır. Kurulduğumuz günden bugüne müşteri memnuniyetini her şeyin önünde tutmak asıl amacımız olmuştur.</p>
                </div>
            </div>

            <!-- Vision/Mission -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-20">
                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-600 text-4xl mb-6">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misyonumuz</h3>
                    <p class="text-gray-600 leading-relaxed">Müşterilerimizin ihtiyaç ve isteklerini anlayarak, özelleştirilmiş teknik destek çözümleri sunarak sağlıklı ve taze suya erişimlerini kolaylaştırmaktır.</p>
                </div>
                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-600 text-4xl mb-6">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Vizyonumuz</h3>
                    <p class="text-gray-600 leading-relaxed">Su arıtma sistemlerinin gücünü kullanarak herkesin temiz içme suyuna erişimi sağlamak.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../Core/includes/footer.php'; ?>
