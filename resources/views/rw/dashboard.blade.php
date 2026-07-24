@extends('layouts.app-pengurus')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Dasbor Eksekutif</h1>
    <p class="text-[#8C7A6B] mt-2 font-medium">Ringkasan finansial dan kependudukan seluruh wilayah RW.</p>
</div>

<!-- Bento Box Statistik -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-[#2D2620] rounded-[2rem] p-8 text-white shadow-lg shadow-[#2D2620]/10 border border-[#4A4036] relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#D98359]/20 rounded-full blur-3xl -z-10"></div>
        <p class="text-[#A6988C] text-xs font-extrabold uppercase tracking-wider mb-2">Total Saldo Kas</p>
        <h3 class="text-2xl font-extrabold">Rp {{ number_format($statistik['saldo'], 0, ',', '.') }}</h3>
    </div>
    <div class="bg-white rounded-[2rem] p-8 border border-[#E8D9C5] shadow-sm">
        <p class="text-[#8C7A6B] text-xs font-extrabold uppercase tracking-wider mb-2">Total Pemasukan</p>
        <h3 class="text-2xl font-extrabold text-green-600">Rp {{ number_format($statistik['pemasukan'], 0, ',', '.') }}</h3>
    </div>
    <div class="bg-white rounded-[2rem] p-8 border border-[#E8D9C5] shadow-sm">
        <p class="text-[#8C7A6B] text-xs font-extrabold uppercase tracking-wider mb-2">Total Pengeluaran</p>
        <h3 class="text-2xl font-extrabold text-red-600">Rp {{ number_format($statistik['pengeluaran'], 0, ',', '.') }}</h3>
    </div>
    <div class="bg-white rounded-[2rem] p-8 border border-[#E8D9C5] shadow-sm">
        <p class="text-[#8C7A6B] text-xs font-extrabold uppercase tracking-wider mb-2">Warga Aktif</p>
        <h3 class="text-2xl font-extrabold text-[#2D2620]">{{ $statistik['warga_aktif'] }}</h3>
    </div>
</div>

<!-- Transaksi Terakhir -->
<div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] overflow-hidden">
    <div class="px-8 py-6 border-b border-[#E8D9C5] bg-[#FDFBF7] flex justify-between items-center">
        <h3 class="font-extrabold text-[#2D2620]">Transaksi Keuangan Terakhir</h3>
    </div>
    <ul class="divide-y divide-[#E8D9C5]/50">
        @forelse($transaksiTerakhir as $transaksi)
        <li class="px-8 py-6 hover:bg-[#FDFBF7] transition-colors flex justify-between items-center">
            <div>
                <p class="font-extrabold text-[#2D2620]">{{ $transaksi->user?->name ?? 'User Tidak Dikenal' }}</p>
                <p class="text-xs font-bold text-[#8C7A6B]">Blok {{ $transaksi->user?->no_rumah ?? '-' }} &bull; {{ $transaksi->invoice_number }}</p>
            </div>
            <div class="text-right">
                <span class="inline-block bg-green-50 text-green-700 text-[10px] font-extrabold uppercase px-2 py-1 rounded-full border border-green-100">Masuk</span>
                <p class="font-extrabold text-[#2D2620] mt-1">Rp {{ number_format($transaksi->total_tagihan, 0, ',', '.') }}</p>
            </div>
        </li>
        @empty
        <li class="p-8 text-center text-[#8C7A6B]">Belum ada transaksi tercatat.</li>
        @endforelse
    </ul>
</div>
@endsection
