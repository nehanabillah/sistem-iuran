<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Bumi Agung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#FDFBF7] text-[#4A4036] min-h-screen flex items-center justify-center py-12 px-4 relative">

    <!-- Latar Belakang Ornamen -->
    <div class="fixed top-0 right-0 w-[500px] h-[500px] bg-[#D98359]/5 rounded-full blur-3xl -z-10 translate-x-1/3 -translate-y-1/3"></div>
    <div class="fixed bottom-0 left-0 w-[400px] h-[400px] bg-[#8C7A6B]/5 rounded-full blur-3xl -z-10 -translate-x-1/3 translate-y-1/3"></div>

    <!-- Tombol Kembali -->
    <a href="{{ url('/') }}" class="absolute top-6 left-6 flex items-center gap-2 text-[#8C7A6B] hover:text-[#2D2620] transition-colors font-bold bg-white/50 backdrop-blur-md px-4 py-2 rounded-full border border-[#E8D9C5] shadow-sm z-50">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Beranda
    </a>

    <!-- Card Pendaftaran -->
    <div class="w-full max-w-3xl bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 sm:p-12 relative overflow-hidden mt-8 lg:mt-0">

        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex justify-center items-center bg-[#FDFBF7] border border-[#E8D9C5] p-2 rounded-2xl mb-5 shadow-sm">
                <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="w-12 h-12 rounded-xl">
            </div>
            <h2 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Pendaftaran Warga</h2>
            <p class="text-[#8C7A6B] mt-2 font-medium">Lengkapi identitas Anda untuk mendapatkan akses ke Portal Bumi Agung.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Data Pribadi -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: Budi Santoso" class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                        @error('name')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="budi@contoh.com" class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                        @error('email')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Nomor WhatsApp Aktif</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa') }}" required placeholder="081234567890" class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                        @error('no_wa')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Data Alamat & Keamanan -->
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">RT</label>
                            <select name="rt" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-bold cursor-pointer">
                                <option value="" disabled selected>Pilih RT</option>
                                <option value="1" {{ old('rt') == '1' ? 'selected' : '' }}>RT 01</option>
                                <option value="2" {{ old('rt') == '2' ? 'selected' : '' }}>RT 02</option>
                                <option value="3" {{ old('rt') == '3' ? 'selected' : '' }}>RT 03</option>
                                <option value="4" {{ old('rt') == '4' ? 'selected' : '' }}>RT 04</option>
                            </select>
                            @error('rt')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Blok / No</label>
                            <input type="text" name="no_rumah" value="{{ old('no_rumah') }}" required placeholder="A1/12" class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                            @error('no_rumah')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Password</label>
                        <input type="password" name="password" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                        @error('password')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                    </div>
                </div>
            </div>

            <div class="pt-8 mt-8 border-t border-[#E8D9C5]/50 text-center">
                <button type="submit" class="w-full sm:w-2/3 mx-auto bg-[#D98359] text-white font-extrabold text-lg py-4 rounded-2xl hover:bg-[#C26B43] shadow-lg shadow-[#D98359]/30 transition-all transform hover:-translate-y-1 block">
                    Ajukan Pendaftaran Warga
                </button>
                <p class="mt-6 text-[#8C7A6B] font-medium">
                    Sudah memiliki akun? <a href="{{ route('login') }}" class="font-extrabold text-[#2D2620] hover:text-[#D98359] transition-colors relative after:content-[''] after:absolute after:w-full after:h-0.5 after:bg-[#D98359] after:bottom-0 after:left-0 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left">Masuk di sini</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
