@extends('layouts.app-pengurus')

@section('content')
<!-- Header Dasbor & Tombol Aksi -->
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-5">
    <div>
        <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Buku Kas & Keuangan</h1>
        <p class="text-[#8C7A6B] mt-2 font-medium">Ringkasan arus kas dan status iuran warga Perumahan Bumi Agung.</p>
    </div>

    <a href="{{ route('bendahara.laporan.pdf') }}" target="_blank" class="inline-flex items-center justify-center gap-2 bg-[#2D2620] text-white px-6 py-3.5 rounded-2xl font-extrabold hover:bg-[#D98359] hover:-translate-y-1 transition-all shadow-lg shadow-[#2D2620]/20 shrink-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Cetak Laporan PDF
    </a>
</div>

<!-- Grid Bento Box Asimetris -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">

    <!-- Card 1: Saldo Kas (Bento Besar - Dark Mode) -->
    <div class="md:col-span-12 lg:col-span-6 bg-[#2D2620] rounded-[2rem] shadow-lg border border-[#4A4036] p-8 sm:p-10 relative overflow-hidden group flex flex-col justify-between min-h-[220px]">
        <!-- Ornamen Latar -->
        <div class="absolute -bottom-16 -right-16 w-56 h-56 bg-[#D98359]/20 rounded-full blur-3xl -z-10 transition-colors group-hover:bg-[#D98359]/30"></div>

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-white/10 text-white rounded-2xl flex items-center justify-center backdrop-blur-md border border-white/10">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
            </div>
            <div>
                <h3 class="text-white font-extrabold uppercase tracking-wider text-sm">Saldo Kas Saat Ini</h3>
                <p class="text-[#A6988C] text-xs font-medium mt-1">Total Dana Tersedia</p>
            </div>
        </div>

        <div>
            <h2 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight">Rp {{ number_format($saldo, 0, ',', '.') }}</h2>
        </div>
    </div>

    <!-- Card 2: Pemasukan (Bento Kecil - White Lofi) -->
    <div class="md:col-span-6 lg:col-span-3 bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 relative overflow-hidden flex flex-col justify-between">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center border border-green-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <h3 class="text-[#8C7A6B] font-extrabold uppercase tracking-wider text-xs">Pemasukan</h3>
        </div>

        <div>
            <p class="text-[#8C7A6B] text-xs font-medium mb-1">Total Iuran Terkumpul</p>
            <h2 class="text-2xl font-extrabold text-[#2D2620]">Rp {{ number_format($pemasukan, 0, ',', '.') }}</h2>
        </div>
    </div>

    <!-- Card 3: Tunggakan (Bento Kecil - White Lofi) -->
    <div class="md:col-span-6 lg:col-span-3 bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 relative overflow-hidden flex flex-col justify-between">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center border border-red-100 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-[#8C7A6B] font-extrabold uppercase tracking-wider text-xs">Tunggakan</h3>
        </div>

        <div>
            <p class="text-[#8C7A6B] text-xs font-medium mb-1">Total Belum Dibayar</p>
            <h2 class="text-2xl font-extrabold text-[#2D2620]">Rp {{ number_format($tunggakan, 0, ',', '.') }}</h2>
        </div>
    </div>

</div>
@endsection
