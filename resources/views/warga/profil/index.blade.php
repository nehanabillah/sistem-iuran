@extends('layouts.app-warga')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Pengaturan Profil</h1>
    <p class="text-[#8C7A6B] mt-2 font-medium">Kelola informasi identitas dan keamanan akun portal Anda.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <div class="lg:col-span-4 bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#F2E8D9] rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>

        <div class="text-center">
            <div class="w-24 h-24 mx-auto bg-gradient-to-tr from-[#D98359] to-[#E6A175] text-white rounded-[2rem] flex items-center justify-center text-4xl font-extrabold shadow-lg shadow-[#D98359]/20 mb-6 rotate-3 group-hover:rotate-0 transition-transform">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <h2 class="text-2xl font-extrabold text-[#2D2620] mb-1">{{ auth()->user()->name }}</h2>
            <p class="text-[#8C7A6B] font-medium text-sm mb-6">{{ auth()->user()->email }}</p>

            <div class="inline-flex items-center gap-2 bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-2 rounded-xl mb-8 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                <span class="text-xs font-bold text-[#8C7A6B] uppercase tracking-wider">Warga Terverifikasi</span>
            </div>
        </div>

        <div class="space-y-4 border-t border-[#E8D9C5]/50 pt-6">
            <div class="flex justify-between items-center">
                <span class="text-[#8C7A6B] text-sm font-bold">Wilayah RT</span>
                <span class="text-[#2D2620] font-extrabold bg-[#FDFBF7] px-3 py-1 rounded-lg border border-[#E8D9C5]">RT {{ str_pad(auth()->user()->rt, 2, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[#8C7A6B] text-sm font-bold">Blok / Nomor</span>
                <span class="text-[#2D2620] font-extrabold bg-[#FDFBF7] px-3 py-1 rounded-lg border border-[#E8D9C5]">{{ auth()->user()->no_rumah }}</span>
            </div>
        </div>
    </div>

    <div class="lg:col-span-8 space-y-8">

        <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 sm:p-10">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-[#F2E8D9] text-[#D98359] rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold text-[#2D2620]">Informasi Pribadi</h3>
                    <p class="text-[#8C7A6B] text-sm font-medium">Perbarui data diri dan kontak Anda di sini.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('warga.profil.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Nomor WhatsApp</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa', auth()->user()->no_wa) }}" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Blok / Nomor Rumah</label>
                        <input type="text" name="no_rumah" value="{{ old('no_rumah', auth()->user()->no_rumah) }}" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-medium">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-[#E8D9C5] text-[#2D2620] font-extrabold px-6 py-3 rounded-xl hover:bg-[#D98359] hover:text-white transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-[#2D2620] rounded-[2rem] shadow-lg border border-[#4A4036] p-8 sm:p-10 relative overflow-hidden group">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#D98359]/20 rounded-full blur-3xl -z-10 group-hover:bg-[#D98359]/30 transition-colors"></div>

            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-white/10 text-[#D98359] rounded-2xl flex items-center justify-center backdrop-blur-md border border-white/10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold text-white">Keamanan Akun</h3>
                    <p class="text-[#A6988C] text-sm font-medium">Pastikan kata sandi Anda panjang dan unik.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-xs font-extrabold text-[#A6988C] mb-2 uppercase tracking-wider">Password Saat Ini</label>
                        <input type="password" name="current_password" required class="w-full bg-[#1A1612] border border-[#4A4036] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-white font-medium placeholder-[#4A4036]">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-extrabold text-[#A6988C] mb-2 uppercase tracking-wider">Password Baru</label>
                            <input type="password" name="password" required class="w-full bg-[#1A1612] border border-[#4A4036] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-white font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-extrabold text-[#A6988C] mb-2 uppercase tracking-wider">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required class="w-full bg-[#1A1612] border border-[#4A4036] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-white font-medium">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-[#D98359] text-white font-extrabold px-6 py-3 rounded-xl hover:bg-[#C26B43] transition-colors shadow-lg shadow-[#D98359]/20">
                        Perbarui Sandi
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
