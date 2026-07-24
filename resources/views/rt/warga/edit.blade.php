@extends('layouts.app-pengurus')

@section('content')
<!-- Tombol Kembali -->
<div class="mb-6">
    <a href="{{ route('rt.warga.index') }}" class="inline-flex items-center gap-2 text-[#8C7A6B] hover:text-[#D98359] transition-colors font-bold text-sm bg-white/50 px-4 py-2 rounded-full border border-[#E8D9C5] shadow-sm w-fit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Buku Induk
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Edit Data Warga</h1>
        <p class="text-[#8C7A6B] mt-2 font-medium">Perbarui identitas atau ubah status penagihan iuran warga ini.</p>
    </div>

    <!-- Card Lofi -->
    <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 sm:p-12 relative overflow-hidden group">
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-[#F2E8D9] rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>

        <div class="flex justify-center mb-8">
            <div class="w-16 h-16 bg-[#2D2620] text-white rounded-2xl flex items-center justify-center shadow-lg shadow-[#2D2620]/20">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
        </div>

        <form action="{{ route('rt.warga.update', $warga->id) }}" method="POST" class="space-y-6">
            @csrf @method('PUT')

            <div>
                <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider text-center sm:text-left">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $warga->name) }}" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-bold shadow-sm">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider text-center sm:text-left">Blok / Nomor Rumah</label>
                    <input type="text" name="no_rumah" value="{{ old('no_rumah', $warga->no_rumah) }}" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#D98359] font-extrabold shadow-sm text-center sm:text-left">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider text-center sm:text-left">Status Akun</label>
                    <!-- Custom Select Style -->
                    <select name="status" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-bold shadow-sm cursor-pointer appearance-none">
                        <option value="aktif" {{ $warga->status === 'aktif' ? 'selected' : '' }}>Aktif (Ditagih Iuran)</option>
                        <option value="nonaktif" {{ $warga->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif / Pindah</option>
                    </select>
                </div>
            </div>

            <div class="pt-8 border-t border-[#E8D9C5]/50 text-center">
                <button type="submit" class="w-full bg-[#D98359] text-white font-extrabold text-lg py-4 rounded-2xl hover:bg-[#C26B43] transition-colors shadow-lg shadow-[#D98359]/20 transform hover:-translate-y-1">
                    Simpan Data Warga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
