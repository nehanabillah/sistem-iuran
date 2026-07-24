<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Warga - Bumi Agung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDFBF7; /* Warna Lofi Kertas */
        }
    </style>
</head>
<body class="text-[#4A4036] antialiased selection:bg-[#E8D9C5] selection:text-[#2D2620] flex flex-col min-h-screen">

    <nav class="sticky top-0 z-50 bg-[#FDFBF7]/80 backdrop-blur-md border-b border-[#E8D9C5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center gap-3 mr-8">
                        <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-10 w-10 rounded-xl shadow-sm border border-[#E8D9C5] object-cover">
                        <div class="hidden sm:block">
                            <h1 class="font-bold text-lg text-[#2D2620] leading-none">Bumi Agung</h1>
                            <p class="text-[10px] text-[#8C7A6B] font-bold tracking-widest mt-0.5 uppercase">Ruang Warga</p>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:space-x-8">
                        <a href="{{ route('warga.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('warga.dashboard') ? 'border-[#D98359] text-[#2D2620]' : 'border-transparent text-[#8C7A6B] hover:text-[#2D2620] hover:border-[#E8D9C5]' }} text-sm font-bold transition-colors">
                            Beranda
                        </a>
                        <a href="{{ route('warga.riwayat.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('warga.riwayat.*') ? 'border-[#D98359] text-[#2D2620]' : 'border-transparent text-[#8C7A6B] hover:text-[#2D2620] hover:border-[#E8D9C5]' }} text-sm font-bold transition-colors">
                            Riwayat Pembayaran
                        </a>
                        <a href="{{ route('warga.profil') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('warga.profil') ? 'border-[#D98359] text-[#2D2620]' : 'border-transparent text-[#8C7A6B] hover:text-[#2D2620] hover:border-[#E8D9C5]' }} text-sm font-bold transition-colors">
                            Pengaturan Profil
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex flex-col items-end mr-2">
                        <span class="text-sm font-extrabold text-[#2D2620]">{{ auth()->user()->name }}</span>
                        <span class="text-[10px] font-extrabold text-[#D98359] bg-[#D98359]/10 px-2.5 py-0.5 rounded-full mt-1 border border-[#D98359]/20">Blok {{ auth()->user()->no_rumah }}</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white border border-[#E8D9C5] p-2.5 rounded-xl text-[#8C7A6B] hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all shadow-sm group" title="Keluar">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="sm:hidden border-t border-[#E8D9C5] bg-[#FDFBF7]/90 backdrop-blur-md pb-3 pt-2 px-4 flex gap-2 overflow-x-auto no-scrollbar">
            <a href="{{ route('warga.dashboard') }}" class="whitespace-nowrap px-4 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('warga.dashboard') ? 'bg-[#D98359] text-white shadow-md shadow-[#D98359]/20' : 'bg-white border border-[#E8D9C5] text-[#8C7A6B]' }}">Beranda</a>
            <a href="{{ route('warga.riwayat.index') }}" class="whitespace-nowrap px-4 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('warga.riwayat.*') ? 'bg-[#D98359] text-white shadow-md shadow-[#D98359]/20' : 'bg-white border border-[#E8D9C5] text-[#8C7A6B]' }}">Riwayat</a>
            <a href="{{ route('warga.profil') }}" class="whitespace-nowrap px-4 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('warga.profil') ? 'bg-[#D98359] text-white shadow-md shadow-[#D98359]/20' : 'bg-white border border-[#E8D9C5] text-[#8C7A6B]' }}">Profil</a>
        </div>
    </nav>

    <main class="flex-grow py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <footer class="mt-auto py-6 border-t border-[#E8D9C5] bg-white text-center">
        <p class="text-xs font-bold text-[#8C7A6B] tracking-wide uppercase">
            © {{ date('Y') }} Warga Bumi Agung • Wilayah RT {{ str_pad(auth()->user()->rt, 2, '0', STR_PAD_LEFT) }}
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const toastConfig = {
            customClass: {
                popup: 'rounded-[1.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-[#E8D9C5] bg-[#FDFBF7]',
                title: 'text-[#2D2620] font-extrabold font-["Plus_Jakarta_Sans"] mt-2',
                htmlContainer: 'text-[#8C7A6B] font-medium font-["Plus_Jakarta_Sans"]',
                confirmButton: 'bg-[#D98359] text-white font-extrabold rounded-xl px-6 py-3 hover:bg-[#C26B43] outline-none w-full mt-4',
            }
        };

        @if(session('success'))
            Swal.fire({
                ...toastConfig,
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                iconColor: '#10B981' // Warna hijau lembut
            });
        @endif

        @if(session('error'))
            Swal.fire({
                ...toastConfig,
                icon: 'error',
                title: 'Perhatian',
                text: '{{ session('error') }}',
                confirmButtonText: 'Saya Mengerti',
                iconColor: '#EF4444' // Warna merah lembut
            });
        @endif
    </script>

    @stack('scripts')

</body>
</html>
