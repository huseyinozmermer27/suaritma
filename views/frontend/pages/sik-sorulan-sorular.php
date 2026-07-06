<?php include '../../../app/Core/includes/header.php'; ?>

    <style>
        .hover-underline-left-to-right {
            position: relative;
            display: block;
        }
        .hover-underline-left-to-right::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #4b5563;
            transition: width 0.3s ease;
        }
        .hover-underline-left-to-right:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="font-sans text-gray-900 bg-white m-0 p-0 overflow-x-hidden">

<main class="py-16 bg-white min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Başlık Bölümü -->
        <div class="text-center mb-16 px-4">
            <h1 class="text-4xl font-bold text-secondary mb-4">Sık Sorulan Sorular</h1>
            <p class="text-base text-gray-600 max-w-2xl mx-auto">
                En sık sorulan soruları sizin için derledik. Merak ettiğiniz soruların cevabını aşağıda bulabilir veya bir soru da siz sorabilirsiniz.
            </p>
        </div>

        <div class="space-y-16">
            <!-- Alışveriş Kategorisi -->
            <div class="grid md:grid-cols-5 gap-8 items-start pt-8 border-t border-gray-100">
                <div class="md:col-span-2 text-left">
                    <h2 class="text-2xl font-bold text-secondary mb-3">Alışveriş</h2>
                    <p class="text-gray-500 text-sm">Mağazadaki alışveriş deneyiminiz ve ödeme sürecinizle ilgili tüm sorular.</p>
                </div>
                <div class="md:col-span-3 space-y-1">
                    <a href="siparisimin-durumu-nedir.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Siparişimin durumu nedir?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="alisveris-yapabilecegim-bir-bayiniz-var-mi.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Alışveriş yapabileceğim bir bayiniz var mı?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="taksitli-alisveris-yapabilir-miyim.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Taksitli alışveriş yapabilir miyim?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="kapida-odeme-secenegi-var-mi.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Kapıda ödeme seçeneği var mı?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="siparis-icin-hesap-olusturmam-gerekiyor-mu.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Sipariş için hesap oluşturmam gerekiyor mu?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Teslimat ve Montaj Kategorisi -->
            <div class="grid md:grid-cols-5 gap-8 items-start pt-8 border-t border-gray-100">
                <div class="md:col-span-2 text-left">
                    <h2 class="text-2xl font-bold text-secondary mb-3">Teslimat ve Montaj</h2>
                    <p class="text-gray-500 text-sm">Siparişinizin teslimatı ve su arıtma cihazınızın montajı ile ilgili tüm sorular.</p>
                </div>
                <div class="md:col-span-3 space-y-1">
                    <a href="teslimati-kim-yapacak.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Teslimatı kim yapacak?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="cihazin-montajini-kim-yapacak.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Cihazın montajını kim yapacak?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="urun-ne-zaman-elime-ulasir.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Ürün ne zaman elime ulaşır?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="kargo-ucreti-odeyecek-miyim.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Kargo ücreti ödeyecek miyim?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="montaj-icin-ucret-odeyecek-miyim.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Montaj için ücret ödeyecek miyim?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- İade Kategorisi -->
            <div class="grid md:grid-cols-5 gap-8 items-start pt-8 border-t border-gray-100 pb-12">
                <div class="md:col-span-2 text-left">
                    <h2 class="text-2xl font-bold text-secondary mb-3">İade</h2>
                    <p class="text-gray-500 text-sm">İade süreçleriyle ilgili tüm sorular.</p>
                </div>
                <div class="md:col-span-3 space-y-1">
                    <a href="su-aritma-cihazindan-memnun-kalmazsam-iade-edebilir-miyim.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">Su arıtma cihazından memnun kalmazsam iade edebilir miyim?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                    <a href="iade-surecinde-para-kesintisi-yapiyor-musunuz.php" class="py-4 border-b border-gray-200 transition-all group hover-underline-left-to-right">
                        <div class="flex justify-between items-center">
                            <span class="text-base text-gray-800 transition-colors">İade sürecinde para kesintisi yapıyor musunuz?</span>
                            <i class="fa-solid fa-chevron-right text-gray-400 transition-all"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../../../app/Core/includes/footer.php'; ?>


