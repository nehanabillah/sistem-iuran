<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Bumi Agung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#FDFBF7] text-[#4A4036] min-h-screen flex items-center justify-center p-4">

    <!-- Tombol Kembali -->
    <a href="{{ url('/') }}" class="absolute top-6 left-6 lg:fixed flex items-center gap-2 text-[#8C7A6B] hover:text-[#2D2620] transition-colors font-bold bg-white/50 backdrop-blur-md px-4 py-2 rounded-full border border-[#E8D9C5] shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Beranda
    </a>

    <!-- Card Login -->
    <div class="w-full max-w-4xl bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] overflow-hidden flex flex-col md:flex-row mt-12 md:mt-0 relative z-10">

        <!-- Sisi Kiri (Gambar & Sambutan) -->
        <div class="md:w-1/2 bg-[#2D2620] p-10 flex-col justify-between relative overflow-hidden hidden md:flex">
            <!-- Ornamen Dekorasi -->
            <div class="absolute -inset-4 bg-gradient-to-tr from-[#D98359]/30 to-transparent rounded-full blur-2xl transform translate-x-1/4 translate-y-1/4 opacity-50"></div>

            <div class="relative z-10">
                <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="w-14 h-14 rounded-2xl mb-8 shadow-lg border border-white/10 opacity-90">
                <h2 class="text-4xl font-extrabold text-white leading-tight mb-4">Selamat<br>Datang<br>Kembali.</h2>
                <p class="text-[#A6988C] font-medium leading-relaxed">Silakan masuk untuk mengakses dasbor kependudukan dan mengelola administrasi Anda.</p>
            </div>
            <div class="relative z-10 text-sm font-bold text-[#8C7A6B]">
                © {{ date('Y') }} Bumi Agung
            </div>
        </div>

        <!-- Sisi Kanan (Formulir) -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
            <!-- Header Mobile -->
            <div class="md:hidden flex items-center gap-3 mb-8">
                <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="w-10 h-10 rounded-xl">
                <h2 class="text-xl font-extrabold text-[#2D2620]">Bumi Agung</h2>
            </div>

            <div class="mb-8">
                <h3 class="text-3xl font-extrabold text-[#2D2620] mb-2">Masuk Akun</h3>
                <p class="text-[#8C7A6B] font-medium">Gunakan email yang telah terdaftar.</p>
            </div>

            <!-- Pesan Error / Status -->
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-2xl text-sm font-bold flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wide">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                    @error('email')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-extrabold text-[#8C7A6B] uppercase tracking-wide">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-extrabold text-[#D98359] hover:text-[#C26B43] transition-colors">Lupa Password?</a>
                        @endif
                    </div>
                    <input type="password" name="password" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                    @error('password')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center pt-2">
                    <input type="checkbox" name="remember" id="remember" class="w-5 h-5 rounded-md border-[#E8D9C5] text-[#D98359] focus:ring-[#D98359]">
                    <label for="remember" class="ml-3 text-sm font-bold text-[#8C7A6B] cursor-pointer">Ingat sesi saya</label>
                </div>

                <button type="submit" class="w-full bg-[#2D2620] text-white font-extrabold text-lg py-4 rounded-2xl hover:bg-[#1A1612] shadow-lg shadow-[#2D2620]/20 transition-all transform hover:-translate-y-1 mt-4">
                    Masuk Dasbor
                </button>
            </form>

            <p class="mt-8 text-center text-[#8C7A6B] font-medium">
                Belum punya akun? <a href="{{ route('register') }}" class="font-extrabold text-[#D98359] hover:text-[#2D2620] transition-colors relative after:content-[''] after:absolute after:w-full after:h-0.5 after:bg-[#D98359] after:bottom-0 after:left-0 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left">Daftar Warga Baru</a>
            </p>
        </div>
    </div>
</body>
</html>
