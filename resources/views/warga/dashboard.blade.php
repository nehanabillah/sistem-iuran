@extends('layouts.app-warga')

@section('content')
<div class="space-y-8">

    <!-- Bagian Sambutan -->
    <div>
        <h2 class="text-2xl font-bold text-stone-700">Halo, {{ $user->name }}! 🌿</h2>
        <p class="text-stone-500 mt-1 font-medium">Rumah: {{ $user->no_rumah }} | RT 0{{ $user->rt }}</p>
    </div>

    <!-- Kartu Total Tunggakan -->
    <div class="bg-[#d4a373] rounded-3xl p-6 sm:p-8 text-white shadow-lg relative overflow-hidden">
        <!-- Elemen dekoratif -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
        <div class="absolute right-20 -bottom-10 w-24 h-24 bg-white opacity-10 rounded-full"></div>

        <p class="text-white/90 font-medium mb-2 text-sm sm:text-base">Total Tagihan Belum Dibayar</p>
        <h3 class="text-4xl sm:text-5xl font-bold tracking-tight">Rp {{ number_format($totalTunggakan, 0, ',', '.') }}</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Kolom Kiri: Tagihan Aktif -->
        <div>
            <h4 class="text-lg font-bold text-stone-700 mb-4 flex items-center gap-2">
                Menunggu Pembayaran
            </h4>

            @if($tagihanBelumDibayar->isEmpty())
                <div class="bg-[#fffaf4] border border-stone-200 rounded-2xl p-8 text-center shadow-sm">
                    <p class="text-stone-500 font-medium">Hore! Tidak ada tagihan yang tertunggak. 🎉</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($tagihanBelumDibayar as $tagihan)
                    <div class="flex items-center justify-between p-5 bg-white border border-stone-100 rounded-2xl shadow-sm hover:shadow-md transition">
                        <div>
                            <p class="font-bold text-stone-700">Iuran {{ \Carbon\Carbon::parse($tagihan->bulan_tagihan)->translatedFormat('F Y') }}</p>
                            <p class="text-xs text-stone-400 mt-1">Inv: {{ $tagihan->invoice_number }}</p>
                        </div>
                        <div class="flex flex-col sm:flex-row items-end sm:items-center gap-3">
                            <span class="font-bold text-stone-600">Rp {{ number_format($tagihan->total_tagihan, 0, ',', '.') }}</span>

                            <div class="flex gap-2 mt-3 sm:mt-0">
                                <!-- Tombol Bayar Online (Midtrans) -->
                                <a href="{{ route('warga.tagihan.bayar', $tagihan->id) }}" class="px-4 py-2 bg-[#d4a373] text-white text-sm font-semibold rounded-xl hover:bg-[#c8986b] transition inline-block text-center shadow-sm">
                                    Bayar Online
                                </a>

                                <!-- Tombol Lapor Manual (Upload Bukti) -->
                                <a href="{{ route('warga.tagihan.lapor', $tagihan->id) }}" class="px-4 py-2 bg-stone-100 text-stone-600 border border-stone-200 text-sm font-semibold rounded-xl hover:bg-stone-200 transition inline-block text-center shadow-sm">
                                    Lapor Transfer
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Kolom Kanan: Riwayat Pembayaran -->
        <div>
            <h4 class="text-lg font-bold text-stone-700 mb-4">Riwayat Terakhir</h4>

            @if($riwayatPembayaran->isEmpty())
                <div class="bg-transparent border border-dashed border-stone-300 rounded-2xl p-6 text-center">
                    <p class="text-stone-400 text-sm">Belum ada riwayat pembayaran.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($riwayatPembayaran as $riwayat)
                    <div class="flex items-center justify-between p-4 bg-[#fffaf4] border border-stone-200 rounded-2xl">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-lg">
                                ✓
                            </div>
                            <div>
                                <p class="font-bold text-stone-700 text-sm">Iuran {{ \Carbon\Carbon::parse($riwayat->bulan_tagihan)->translatedFormat('F Y') }}</p>
                                <p class="text-xs text-stone-400 mt-0.5">{{ \Carbon\Carbon::parse($riwayat->paid_at)->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <span class="font-bold text-stone-500 text-sm">Rp {{ number_format($riwayat->total_tagihan, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
