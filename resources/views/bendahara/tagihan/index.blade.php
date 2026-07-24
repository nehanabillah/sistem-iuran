@extends('layouts.app-pengurus')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Manajemen Tagihan</h1>
    <p class="text-[#8C7A6B] mt-2 font-medium">Validasi bukti transfer dan kelola pembayaran tunai iuran warga.</p>
</div>

<!-- Card Tabel Lofi Bento -->
<div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-6 sm:p-8 overflow-hidden relative z-10">

    <!-- Ornamen Latar -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#F2E8D9] rounded-bl-full -z-10 transition-transform hover:scale-105"></div>

    <div class="overflow-x-auto relative">
        <table id="tagihanTable" class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="border-b border-[#E8D9C5]">
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Bulan</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Warga</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Tagihan</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-center">Status</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-center">Aksi (Validasi)</th>
                </tr>
            </thead>
            <tbody class="text-[#2D2620] font-medium text-sm divide-y divide-[#E8D9C5]/50">
                @forelse($invoices as $item)
                <tr class="hover:bg-[#FDFBF7] transition-colors group">
                    <!-- Kolom Bulan & Invoice -->
                    <td class="py-4 px-2">
                        <p class="font-extrabold text-[#2D2620]">{{ \Carbon\Carbon::parse($item->bulan_tagihan)->translatedFormat('F Y') }}</p>
                        <p class="text-[10px] font-bold text-[#8C7A6B] mt-0.5 uppercase tracking-wider">{{ $item->invoice_number }}</p>
                    </td>

                    <!-- Kolom Warga -->
                    <td class="py-4 px-2">
                        <p class="font-bold text-[#2D2620]">{{ $item->user->name }}</p>
                        <p class="text-xs text-[#8C7A6B]">Blok {{ $item->user->no_rumah }} <span class="text-[#D98359] font-bold">• RT {{ str_pad($item->user->rt, 2, '0', STR_PAD_LEFT) }}</span></p>
                    </td>

                    <!-- Kolom Nominal -->
                    <td class="py-4 px-2 font-bold text-[#8C7A6B]">
                        Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}
                    </td>

                    <!-- Kolom Status Lofi -->
                    <td class="py-4 px-2 text-center">
                        @if($item->status === 'paid')
                            <span class="inline-flex items-center gap-1.5 bg-[#FDFBF7] border border-green-200 text-green-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Lunas
                            </span>
                        @elseif($item->status === 'pending')
                            <span class="inline-flex items-center gap-1.5 bg-[#FDFBF7] border border-amber-200 text-amber-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm animate-pulse">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Validasi
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-[#FDFBF7] border border-red-200 text-red-600 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Belum Bayar
                            </span>
                        @endif
                    </td>

                    <!-- Kolom Aksi -->
                    <td class="py-4 px-2 text-center">
                        <div class="flex flex-col items-center justify-center gap-2">
                            @if($item->status === 'pending')

                                <!-- Tombol Cek Bukti -->
                                @if($item->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank" class="w-[140px] text-center bg-[#2D2620] text-white text-xs font-extrabold px-3 py-2 rounded-xl hover:bg-[#1A1612] transition-colors shadow-sm inline-flex justify-center items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat Bukti
                                    </a>
                                @else
                                    <span class="w-[140px] text-center bg-red-50 text-red-500 text-xs font-bold px-3 py-2 rounded-xl border border-red-100">Foto Error</span>
                                @endif

                                <!-- Form Validasi -->
                                <form action="{{ route('bendahara.tagihan.validasi', $item->id) }}" method="POST" class="flex gap-1 w-[140px]">
                                    @csrf
                                    <button type="submit" name="action" value="terima" class="flex-1 bg-[#D98359] text-white text-xs font-bold py-2 rounded-lg hover:bg-[#C26B43] transition-colors" title="Terima">
                                        ✓
                                    </button>
                                    <button type="submit" name="action" value="tolak" class="flex-1 bg-stone-200 text-stone-600 text-xs font-bold py-2 rounded-lg hover:bg-stone-300 transition-colors border border-[#E8D9C5]" title="Tolak">
                                        ✕
                                    </button>
                                </form>

                            @elseif($item->status === 'unpaid')
                                <!-- Form Bayar Tunai -->
                                <form action="{{ route('bendahara.tagihan.tandai-lunas', $item->id) }}" method="POST" class="w-[140px]">
                                    @csrf
                                    <button type="submit" class="w-full bg-[#FDFBF7] border border-[#E8D9C5] text-[#8C7A6B] hover:text-[#D98359] hover:border-[#D98359] text-xs font-extrabold px-3 py-2 rounded-xl transition-all flex justify-center items-center gap-1.5 shadow-sm btn-terima-tunai">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Terima Tunai
                                    </button>
                                </form>
                            @else
                                <span class="text-[#E8D9C5] text-sm font-bold">-</span>
                            @endif
                        </div>
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
    /* Styling DataTables Lofi */
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
    .dataTables_wrapper .dataTables_filter input:focus { border-color: #D98359; box-shadow: 0 0 0 3px rgba(217, 131, 89, 0.1); }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #E8D9C5; border-radius: 0.75rem; padding: 0.25rem 1rem 0.25rem 0.5rem; background-color: #FDFBF7; font-family: 'Plus Jakarta Sans', sans-serif; outline: none;
    }
    .dataTables_wrapper .dataTables_info { color: #8C7A6B !important; font-size: 0.875rem; padding-top: 1.5rem !important; font-weight: 500;}
    .dataTables_wrapper .dataTables_paginate { padding-top: 1.25rem !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 1rem !important; border: 1px solid transparent !important; padding: 0.5rem 1rem !important; margin: 0 0.25rem !important; color: #8C7A6B !important; font-weight: 700 !important; font-size: 0.875rem !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: #FDFBF7 !important; border: 1px solid #E8D9C5 !important; color: #2D2620 !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #D98359 !important; color: white !important; border-color: #D98359 !important; box-shadow: 0 4px 10px rgba(217, 131, 89, 0.2) !important;
    }
    table.dataTable.no-footer { border-bottom: 1px solid #E8D9C5 !important; }
</style>

<script>
    $(document).ready(function() {
        $('#tagihanTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' },
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-6 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-4 gap-4"ip>',
            responsive: true,
            order: [], // Mematikan urutan awal agar mengikuti urutan Controller (Pending di atas)
            columnDefs: [
                { orderable: false, targets: 4 } // Mematikan sorting di kolom Aksi
            ]
        });

        // SweetAlert Confirmation untuk Terima Tunai
        $('.btn-terima-tunai').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            Swal.fire({
                title: 'Terima Uang Tunai?',
                text: "Status tagihan ini akan diubah menjadi Lunas dan akan tercatat di Buku Kas.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D98359',
                cancelButtonColor: '#8C7A6B',
                confirmButtonText: 'Ya, Tandai Lunas',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' }
            }).then((result) => {
                if (result.isConfirmed) { form.submit(); }
            });
        });
    });
</script>
@endpush
