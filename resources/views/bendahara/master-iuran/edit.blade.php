@extends('layouts.app-pengurus')

@section('content')
<!-- Tombol Kembali -->
<div class="mb-6">
    <a href="{{ route('bendahara.master-iuran.index') }}" class="inline-flex items-center gap-2 text-[#8C7A6B] hover:text-[#D98359] transition-colors font-bold text-sm bg-white/50 px-4 py-2 rounded-full border border-[#E8D9C5] shadow-sm w-fit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Iuran
    </a>
</div>

<div class="max-w-2xl mx-auto">

    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Edit Master Iuran</h1>
        <p class="text-[#8C7A6B] mt-2 font-medium">Perbarui nominal atau status dari komponen tagihan ini.</p>
    </div>

    <!-- Card Lofi -->
    <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 sm:p-12 relative overflow-hidden group">
        <!-- Ornamen Lofi -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-[#F2E8D9] rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>

        <div class="flex justify-center mb-8">
            <div class="w-16 h-16 bg-[#2D2620] text-white rounded-2xl flex items-center justify-center shadow-lg shadow-[#2D2620]/20">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </div>
        </div>

        <form action="{{ route('bendahara.master-iuran.update', $masterIuran->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider text-center sm:text-left">Nama Komponen Iuran</label>
                <input type="text" name="nama_iuran" value="{{ old('nama_iuran', $masterIuran->nama_iuran) }}" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-bold shadow-sm">
            </div>

            <div>
                <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider text-center sm:text-left">Nominal (Rp)</label>
                <input type="number" name="nominal" value="{{ old('nominal', $masterIuran->nominal) }}" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-extrabold shadow-sm">
            </div>

            <!-- Custom Checkbox Lofi (Toggle Switch) -->
            <div class="flex items-center justify-center sm:justify-start pt-2">
                <label class="flex items-center cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1" {{ $masterIuran->is_active ? 'checked' : '' }} class="peer sr-only">
                        <div class="block w-12 h-7 bg-[#E8D9C5] rounded-full peer-checked:bg-[#D98359] transition-colors"></div>
                        <div class="dot absolute left-1 top-1 bg-white w-5 h-5 rounded-full transition-transform peer-checked:translate-x-5 shadow-sm"></div>
                    </div>
                    <div class="ml-4 text-sm font-extrabold text-[#8C7A6B] group-hover:text-[#2D2620] transition-colors">Aktifkan untuk tagihan bulan depan</div>
                </label>
            </div>

            <div class="pt-8 border-t border-[#E8D9C5]/50 text-center">
                <button type="submit" class="w-full bg-[#D98359] text-white font-extrabold text-lg py-4 rounded-2xl hover:bg-[#C26B43] transition-colors shadow-lg shadow-[#D98359]/20 transform hover:-translate-y-1">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
