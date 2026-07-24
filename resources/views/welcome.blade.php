<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Kependudukan & Iuran - Perumahan Bumi Agung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDFBF7; /* Warna Lofi Paper/Krem Lembut */
        }
        /* Menyembunyikan marker default pada tag details/summary */
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body class="text-[#4A4036] antialiased selection:bg-[#E8D9C5] selection:text-[#2D2620] flex flex-col min-h-screen overflow-x-hidden">

    <!-- Floating Pill Navbar -->
    <div class="fixed top-4 inset-x-0 z-50 flex justify-center px-4">
        <nav class="w-full max-w-5xl bg-white/70 backdrop-blur-lg border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-full px-4 py-3 flex justify-between items-center transition-all">
            <!-- Logo & Nama -->
            <div class="flex items-center gap-3 pl-2">
                <img src="{{ asset('logo.jpeg') }}" alt="Logo Bumi Agung" class="h-10 w-10 object-cover rounded-full shadow-sm">
                <div>
                    <h1 class="font-bold text-base text-[#2D2620] leading-none">Bumi Agung</h1>
                    <p class="text-[10px] text-[#8C7A6B] font-bold tracking-widest mt-0.5 uppercase">Portal Warga</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center gap-2 sm:gap-4 pr-1">
                <a href="{{ route('login') }}" class="text-sm font-bold text-[#8C7A6B] hover:text-[#2D2620] transition-colors hidden sm:block">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm font-bold bg-[#D98359] text-white px-6 py-2.5 rounded-full hover:bg-[#C26B43] shadow-md shadow-[#D98359]/20 transition-all transform hover:scale-105">
                    Daftar Akun
                </a>
            </div>
        </nav>
    </div>

    <!-- Hero Section -->
    <main class="flex-grow pt-32 pb-16 lg:pt-40 lg:pb-24 relative">
        <!-- Dekorasi Latar Belakang Cincin Lembut -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-gradient-to-b from-[#F2E8D9]/50 to-transparent rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <!-- Teks Hero (Kiri) - Lebar 5 kolom -->
                <div class="lg:col-span-5 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full bg-white border border-[#E8D9C5] shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-[#8C7A6B] text-xs font-bold tracking-wider uppercase">Sistem Aktif 24/7</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#2D2620] tracking-tight mb-6 leading-[1.1]">
                        Rumah Nyaman, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D98359] to-[#E6A175]">Iuran Aman.</span>
                    </h2>
                    <p class="mt-4 text-lg text-[#8C7A6B] mb-10 leading-relaxed">
                        Tinggalkan cara lama. Cek tagihan, setor bukti transfer, dan pantau kas RT/RW secara transparan dari mana saja.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start items-center gap-4">
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold rounded-2xl text-white bg-[#2D2620] hover:bg-[#1A1612] shadow-xl shadow-[#2D2620]/10 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            Buka Dasbor
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>

                    <!-- Mini Statistik (Social Proof) -->
                    <div class="mt-12 grid grid-cols-3 gap-4 border-t border-[#E8D9C5] pt-8">
                        <div>
                            <p class="text-2xl font-extrabold text-[#2D2620]">100%</p>
                            <p class="text-xs text-[#8C7A6B] font-medium">Transparan</p>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-[#2D2620]">0</p>
                            <p class="text-xs text-[#8C7A6B] font-medium">Biaya Admin</p>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-[#2D2620]">24/7</p>
                            <p class="text-xs text-[#8C7A6B] font-medium">Akses Data</p>
                        </div>
                    </div>
                </div>

                <!-- Carousel Gambar (Kanan) - Lebar 7 kolom -->
                <div class="lg:col-span-7 relative group">
                    <!-- Ornamen Lofi Belakang Gambar -->
                    <div class="absolute -inset-2 bg-gradient-to-tr from-[#D98359]/20 to-[#E8D9C5]/40 rounded-[2.5rem] transform rotate-2 group-hover:rotate-1 transition-transform duration-500 -z-10"></div>

                    <div class="relative w-full rounded-[2rem] overflow-hidden shadow-2xl border-4 border-white bg-white" id="hero-carousel">
                        <!-- Images Track -->
                        <div class="flex transition-transform duration-700 ease-out h-[350px] sm:h-[500px]" id="carousel-track">
                            <!-- Slide 1 -->
                            <div class="w-full flex-shrink-0 relative">
                                <img src="{{ asset('corosel3.jpeg') }}" alt="Kegiatan RT RW Bumi Agung" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#2D2620]/80 via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-8">
                                    <span class="bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full mb-3 inline-block border border-white/20">Kegiatan Rutin</span>
                                    <p class="text-white font-bold text-lg sm:text-xl leading-snug">Ramah Tamah RT/RW dengan Anggota DPRD Kota Batam.</p>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="w-full flex-shrink-0 relative">
                                <img src="{{ asset('corosel1.png') }}" alt="Suasana Bumi Agung 1" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#2D2620]/80 via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-8">
                                    <span class="bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full mb-3 inline-block border border-white/20">Fasilitas</span>
                                    <p class="text-white font-bold text-lg sm:text-xl leading-snug">Kenyamanan dan Keamanan Lingkungan Bumi Agung.</p>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="w-full flex-shrink-0 relative">
                                <img src="{{ asset('corosel2.png') }}" alt="Suasana Bumi Agung 2" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#2D2620]/80 via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-8">
                                    <span class="bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full mb-3 inline-block border border-white/20">Lingkungan</span>
                                    <p class="text-white font-bold text-lg sm:text-xl leading-snug">Fasilitas dan Ruang Terbuka Hijau Perumahan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Navigasi Lofi -->
                        <button id="prev-btn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white backdrop-blur-md text-[#2D2620] p-3 rounded-2xl shadow-lg opacity-0 group-hover:opacity-100 transition-all transform hover:scale-105 border border-white/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button id="next-btn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white backdrop-blur-md text-[#2D2620] p-3 rounded-2xl shadow-lg opacity-0 group-hover:opacity-100 transition-all transform hover:scale-105 border border-white/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </button>

                        <!-- Titik Indikator -->
                        <div class="absolute bottom-6 left-8 flex gap-2">
                            <div class="w-8 h-1.5 rounded-full bg-white cursor-pointer dot transition-all duration-300 shadow-sm" data-index="0"></div>
                            <div class="w-4 h-1.5 rounded-full bg-white/40 hover:bg-white/70 cursor-pointer dot transition-all duration-300 shadow-sm" data-index="1"></div>
                            <div class="w-4 h-1.5 rounded-full bg-white/40 hover:bg-white/70 cursor-pointer dot transition-all duration-300 shadow-sm" data-index="2"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Bento Grid Features Section -->
    <section class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h3 class="text-3xl font-extrabold text-[#2D2620]">Satu Aplikasi,<br>Banyak Solusi.</h3>
            </div>

            <!-- Grid Layout ala Bento Box -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Box 1 (Besar) -->
                <div class="md:col-span-2 bg-white rounded-[2rem] p-8 border border-[#E8D9C5] shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-[#F2E8D9] text-[#D98359] rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-2xl text-[#2D2620] mb-3">Notifikasi WhatsApp Otomatis</h4>
                    <p class="text-[#8C7A6B] leading-relaxed max-w-md">Tidak perlu mengecek aplikasi setiap saat. Begitu pembayaran iuran Anda divalidasi oleh Bendahara, struk digital akan langsung dikirimkan ke WhatsApp Anda.</p>
                </div>

                <!-- Box 2 (Kecil) -->
                <div class="bg-[#2D2620] rounded-[2rem] p-8 shadow-sm relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 bg-white/10 text-[#D98359] rounded-2xl flex items-center justify-center mb-6 backdrop-blur-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-xl text-white mb-3">Validasi Data Ketat</h4>
                    <p class="text-[#A6988C] text-sm leading-relaxed">Hanya warga terverifikasi oleh RT yang dapat mengakses data.</p>
                </div>

                <!-- Box 3 (Kecil) -->
                <div class="bg-[#F2E8D9] rounded-[2rem] p-8 shadow-sm">
                    <h4 class="font-bold text-xl text-[#2D2620] mb-3">Laporan PDF</h4>
                    <p class="text-[#8C7A6B] text-sm leading-relaxed mb-6">Unduh rekapitulasi keuangan bulanan dengan format siap cetak.</p>
                    <div class="h-24 bg-white rounded-xl border border-white/50 opacity-70 flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#D98359]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                </div>

                <!-- Box 4 (Besar) -->
                <div class="md:col-span-2 bg-white rounded-[2rem] p-8 border border-[#E8D9C5] shadow-sm flex flex-col justify-center">
                    <h4 class="font-bold text-2xl text-[#2D2620] mb-3">Arus Kas Terpusat</h4>
                    <p class="text-[#8C7A6B] leading-relaxed">Pantau secara langsung dari mana uang masuk dan ke mana uang digunakan untuk operasional perumahan. Tata kelola modern untuk perumahan yang lebih baik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section (Akordion Tanpa JS) -->
    <section class="py-20 bg-white border-t border-[#E8D9C5]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-extrabold text-[#2D2620]">Pertanyaan Umum</h3>
            </div>

            <div class="space-y-4">
                <details class="group bg-[#FDFBF7] p-6 rounded-2xl border border-[#E8D9C5] cursor-pointer hover:border-[#D98359] transition-colors">
                    <summary class="font-bold text-lg text-[#2D2620] flex justify-between items-center">
                        Mengapa akun saya tidak langsung aktif setelah mendaftar?
                        <span class="transition group-open:rotate-180 text-[#D98359]">
                            <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                        </span>
                    </summary>
                    <p class="mt-4 text-[#8C7A6B] leading-relaxed border-t border-[#E8D9C5] pt-4">Demi menjaga keamanan data dan privasi warga, setiap akun baru harus divalidasi oleh Ketua RT masing-masing untuk memastikan bahwa pendaftar benar-benar merupakan warga perumahan Bumi Agung.</p>
                </details>

                <details class="group bg-[#FDFBF7] p-6 rounded-2xl border border-[#E8D9C5] cursor-pointer hover:border-[#D98359] transition-colors">
                    <summary class="font-bold text-lg text-[#2D2620] flex justify-between items-center">
                        Bagaimana cara membayar iuran melalui aplikasi ini?
                        <span class="transition group-open:rotate-180 text-[#D98359]">
                            <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                        </span>
                    </summary>
                    <p class="mt-4 text-[#8C7A6B] leading-relaxed border-t border-[#E8D9C5] pt-4">Anda cukup mentransfer dana ke rekening RT/RW yang tertera di Dasbor Anda, lalu mengunggah foto/screenshot bukti transfer tersebut. Bendahara akan mengecek dan mengubah status tagihan Anda menjadi Lunas.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1A1612] text-[#A6988C] py-12 rounded-t-[3rem] mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-4">
                <img src="{{ asset('logo.jpeg') }}" alt="Logo Footer" class="h-12 w-12 object-cover rounded-2xl opacity-80 border border-[#A6988C]/20">
                <div>
                    <h4 class="text-white font-bold text-lg leading-tight">Bumi Agung</h4>
                    <span class="text-xs tracking-wider">SISTEM INFORMASI TERPADU</span>
                </div>
            </div>
            <div class="text-sm font-medium">
                © {{ date('Y') }} Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <!-- Script Carousel -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.getElementById('carousel-track');
            const slides = track.children;
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const dots = document.querySelectorAll('.dot');

            let currentIndex = 0;
            const totalSlides = slides.length;
            let autoPlayInterval;

            function updateCarousel() {
                track.style.transform = `translateX(-${currentIndex * 100}%)`;

                dots.forEach((dot, index) => {
                    if(index === currentIndex) {
                        dot.classList.remove('w-4', 'bg-white/40');
                        dot.classList.add('w-8', 'bg-white');
                    } else {
                        dot.classList.remove('w-8', 'bg-white');
                        dot.classList.add('w-4', 'bg-white/40');
                    }
                });
            }

            function nextSlide() { currentIndex = (currentIndex + 1) % totalSlides; updateCarousel(); }
            function prevSlide() { currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; updateCarousel(); }

            nextBtn.addEventListener('click', () => { nextSlide(); resetAutoPlay(); });
            prevBtn.addEventListener('click', () => { prevSlide(); resetAutoPlay(); });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => { currentIndex = index; updateCarousel(); resetAutoPlay(); });
            });

            function startAutoPlay() { autoPlayInterval = setInterval(nextSlide, 5000); }
            function resetAutoPlay() { clearInterval(autoPlayInterval); startAutoPlay(); }

            startAutoPlay();
        });
    </script>
</body>
</html>
