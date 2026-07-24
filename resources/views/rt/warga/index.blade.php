@extends('layouts.app-pengurus')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Buku Induk Warga</h1>
    <p class="text-[#8C7A6B] mt-2 font-medium">Kelola data seluruh warga yang terdaftar di wilayah RT Anda.</p>
</div>

<div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-6 sm:p-8 overflow-hidden relative">
    <div class="absolute bottom-0 right-0 w-48 h-48 bg-[#D98359]/5 rounded-tl-full -z-10"></div>

    <div class="overflow-x-auto">
        <table id="wargaTable" class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="border-b border-[#E8D9C5]">
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Blok / Rumah</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Nama Lengkap</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Nomor WA</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-center">Status</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="text-[#2D2620] font-medium text-sm divide-y divide-[#E8D9C5]/50">
                @forelse($wargas as $item)
                <tr class="hover:bg-[#FDFBF7] transition-colors group">
                    <td class="py-4 px-2 font-extrabold text-[#D98359]">{{ $item->no_rumah }}</td>
                    <td class="py-4 px-2 font-bold text-[#2D2620]">
                        {{ $item->name }}
                        <div class="text-[10px] text-[#8C7A6B] mt-0.5">{{ $item->email }}</div>
                    </td>
                    <td class="py-4 px-2 text-[#8C7A6B]">{{ $item->no_wa }}</td>
                    <td class="py-4 px-2 text-center">
                        @if($item->status === 'aktif')
                            <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest border border-green-100">Aktif</span>
                        @else
                            <span class="bg-stone-100 text-stone-500 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest border border-stone-200">Nonaktif</span>
                        @endif
                    </td>
                    <td class="py-4 px-2 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('rt.warga.edit', $item->id) }}" class="bg-[#F2E8D9] text-[#D98359] p-2 rounded-xl hover:bg-[#D98359] hover:text-white transition-colors shadow-sm" title="Edit Data Warga">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('rt.warga.destroy', $item->id) }}" method="POST" class="form-hapus inline-block">
                                @csrf @method('DELETE')
                                <button type="button" class="bg-red-50 text-red-500 p-2 rounded-xl hover:bg-red-100 hover:text-red-700 transition-colors shadow-sm btn-hapus" title="Hapus Permanen">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<style>
    /* Styling DataTables sama seperti halaman sebelumnya */
    .dataTables_wrapper .dataTables_filter input { border: 1px solid #E8D9C5; border-radius: 1rem; padding: 0.5rem 1rem; background-color: #FDFBF7; margin-left: 0.5rem; font-family: 'Plus Jakarta Sans', sans-serif; outline: none; }
    .dataTables_wrapper .dataTables_filter input:focus { border-color: #D98359; box-shadow: 0 0 0 3px rgba(217, 131, 89, 0.1); }
    .dataTables_wrapper .dataTables_length select { border: 1px solid #E8D9C5; border-radius: 0.75rem; padding: 0.25rem 1rem 0.25rem 0.5rem; background-color: #FDFBF7; font-family: 'Plus Jakarta Sans', sans-serif; outline: none; }
    .dataTables_wrapper .dataTables_info { color: #8C7A6B !important; font-size: 0.875rem; padding-top: 1.5rem !important; font-weight: 500;}
    .dataTables_wrapper .dataTables_paginate { padding-top: 1.25rem !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: 1rem !important; border: 1px solid transparent !important; padding: 0.5rem 1rem !important; margin: 0 0.25rem !important; color: #8C7A6B !important; font-weight: 700 !important; font-size: 0.875rem !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: #FDFBF7 !important; border: 1px solid #E8D9C5 !important; color: #2D2620 !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover { background: #D98359 !important; color: white !important; border-color: #D98359 !important; box-shadow: 0 4px 10px rgba(217, 131, 89, 0.2) !important; }
    table.dataTable.no-footer { border-bottom: 1px solid #E8D9C5 !important; }
</style>

<script>
    $(document).ready(function() {
        $('#wargaTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' },
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-6 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-4 gap-4"ip>',
            responsive: true,
            order: [[0, 'asc']], // Urut berdasarkan blok rumah
            columnDefs: [ { orderable: false, targets: [3, 4] } ]
        });

        // SweetAlert Hapus Warga
        $('.btn-hapus').on('click', function() {
            const form = $(this).closest('.form-hapus');
            Swal.fire({
                title: 'Hapus Warga?',
                text: "Awas! Data warga dan seluruh riwayat tagihannya akan terhapus. Sebaiknya ubah statusnya menjadi 'Nonaktif' saja jika warga pindah rumah.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#8C7A6B',
                confirmButtonText: 'Ya, Tetap Hapus',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' }
            }).then((result) => { if (result.isConfirmed) { form.submit(); } });
        });
    });
</script>
@endpush
