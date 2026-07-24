@extends('layouts.app-warga')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Riwayat Pembayaran</h1>
        <p class="text-[#8C7A6B] mt-2 font-medium">Pantau semua transaksi dan status iuran bulanan Anda di sini.</p>
    </div>
</div>

<!-- Card Tabel Bento/Lofi -->
<div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-6 sm:p-8 overflow-hidden relative z-10">

    <!-- Ornamen Latar -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#F2E8D9] rounded-full blur-3xl -z-10 translate-x-1/2 -translate-y-1/2 opacity-50"></div>

    <div class="overflow-x-auto relative">
        <table id="riwayatTable" class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="border-b border-[#E8D9C5]">
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">No</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Bulan Tagihan</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Nominal</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Tanggal Bayar</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-[#2D2620] font-medium text-sm divide-y divide-[#E8D9C5]/50">
                <!-- UBAH $tagihans MENJADI $riwayat DI SINI -->
                @forelse($riwayat as $index => $item)
                    <tr class="hover:bg-[#FDFBF7] transition-colors group">
                        <td class="py-4 px-2 font-bold text-[#8C7A6B]">{{ $index + 1 }}</td>
                        <td class="py-4 px-2 font-extrabold text-[#2D2620]">{{ \Carbon\Carbon::parse($item->bulan ?? $item->created_at)->translatedFormat('F Y') }}</td>
                        <td class="py-4 px-2">Rp {{ number_format($item->total_tagihan ?? $item->nominal, 0, ',', '.') }}</td>
                        <td class="py-4 px-2 text-[#8C7A6B]">
                            {{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->translatedFormat('d M Y') : '-' }}
                        </td>
                        <td class="py-4 px-2 text-center">
                            @if($item->status === 'paid' || $item->status === 'lunas')
                                <div class="flex items-center justify-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 bg-[#FDFBF7] border border-green-200 text-green-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Lunas
                                    </span>
                                    <!-- Tombol Cetak PDF -->
                                    <!-- Pastikan menggunakan route() dengan nama yang sudah didaftarkan -->
                                    <a href="{{ route('warga.riwayat.cetak', $item->id) }}" target="_blank" class="bg-[#2D2620] text-white p-1.5 rounded-xl hover:bg-[#D98359] hover:-translate-y-0.5 transition-all shadow-sm" title="Cetak Kuitansi PDF">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </a>
                                </div>
                            @elseif($item->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 bg-[#FDFBF7] border border-amber-200 text-amber-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu Verifikasi
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-[#FDFBF7] border border-red-200 text-red-600 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Belum Bayar
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<!-- jQuery & DataTables CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<style>
    /*
      Sihir CSS untuk menyulap DataTables kaku
      menjadi Estetika Lofi/Bento!
    */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #E8D9C5;
        border-radius: 1rem;
        padding: 0.5rem 1rem;
        background-color: #FDFBF7;
        margin-left: 0.5rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none;
        transition: all 0.3s ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #D98359;
        box-shadow: 0 0 0 3px rgba(217, 131, 89, 0.1);
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #E8D9C5;
        border-radius: 0.75rem;
        padding: 0.25rem 1rem 0.25rem 0.5rem;
        background-color: #FDFBF7;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none;
    }
    .dataTables_wrapper .dataTables_info {
        color: #8C7A6B !important;
        font-size: 0.875rem;
        padding-top: 1.5rem !important;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 1.25rem !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 1rem !important;
        border: 1px solid transparent !important;
        padding: 0.5rem 1rem !important;
        margin: 0 0.25rem !important;
        color: #8C7A6B !important;
        font-weight: 700 !important;
        font-size: 0.875rem !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #FDFBF7 !important;
        border: 1px solid #E8D9C5 !important;
        color: #2D2620 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #D98359 !important;
        color: white !important;
        border-color: #D98359 !important;
        box-shadow: 0 4px 10px rgba(217, 131, 89, 0.2) !important;
    }
    table.dataTable.no-footer {
        border-bottom: 1px solid #E8D9C5 !important;
    }
</style>

<script>
    $(document).ready(function() {
        $('#riwayatTable').DataTable({
            // Menerjemahkan DataTables ke Bahasa Indonesia
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
            // Konfigurasi Tata Letak DOM
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-6 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-4 gap-4"ip>',
            responsive: true,
            order: [[1, 'desc']], // Urutkan berdasarkan bulan tagihan terbaru
            columnDefs: [
                { orderable: false, targets: 4 } // Mematikan sorting di kolom status
            ]
        });
    });
</script>
@endpush
