<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - Bumi Agung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#FDFBF7] text-[#4A4036] min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-[#D98359]/10 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-[#8C7A6B]/10 rounded-full blur-3xl -z-10"></div>

    <a href="{{ route('login') }}" class="absolute top-6 left-6 flex items-center gap-2 text-[#8C7A6B] hover:text-[#2D2620] transition-colors font-bold bg-white/50 backdrop-blur-md px-4 py-2 rounded-full border border-[#E8D9C5] shadow-sm z-50">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Login
    </a>

    <div class="w-full max-w-lg bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 sm:p-12 relative z-10 text-center">

        <div class="inline-flex justify-center items-center bg-[#FDFBF7] border border-[#E8D9C5] p-4 rounded-2xl mb-6 shadow-sm">
            <svg class="w-8 h-8 text-[#D98359]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
        </div>

        <h2 class="text-3xl font-extrabold text-[#2D2620] mb-3 tracking-tight">Lupa Password?</h2>

        <p class="text-[#8C7A6B] text-sm leading-relaxed mb-8 font-medium">
            Jangan khawatir. Masukkan alamat email yang terhubung dengan akun Anda, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
        </p>

        @if (session('status'))
            <div class="mb-6 bg-[#FDFBF7] border border-green-200 text-green-700 px-4 py-3 rounded-2xl text-sm font-bold flex items-center justify-center gap-2">
                <svg class="w-5 h-5 shrink-0 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="text-left space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider text-center sm:text-left">Alamat Email Terdaftar</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="budi@contoh.com" class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium text-center sm:text-left">
                @error('email')
                    <p class="text-red-500 text-xs font-bold mt-2 text-center sm:text-left">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2 text-center">
                <button type="submit" class="w-full bg-[#2D2620] text-white font-extrabold text-base py-4 rounded-2xl hover:bg-[#1A1612] shadow-lg shadow-[#2D2620]/20 transition-all transform hover:-translate-y-1">
                    Kirim Tautan Reset
                </button>
            </div>
        </form>
    </div>
</body>
</html>
