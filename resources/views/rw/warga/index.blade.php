@extends('layouts.app-pengurus')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Data Warga Global</h1>
    <p class="text-[#8C7A6B] mt-2 font-medium">Monitoring seluruh penduduk dari seluruh RT di wilayah RW Anda.</p>
</div>

<div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-6 sm:p-8 overflow-hidden relative">

    <!-- Ornamen Latar -->
    <div class="absolute bottom-0 right-0 w-48 h-48 bg-[#D98359]/5 rounded-tl-full -z-10"></div>

    <div class="overflow-x-auto">
        <table id="wargaTable" class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="border-b border-[#E8D9C5]">
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">RT</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Nama Warga</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Blok</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Kontak</th>
                </tr>
            </thead>
            <tbody class="text-[#2D2620] font-medium text-sm divide-y divide-[#E8D9C5]/50">
                @foreach($wargas as $item)
                <tr class="hover:bg-[#FDFBF7] transition-colors group">
                    <td class="py-4 px-2 font-extrabold text-[#D98359]">
                        <span class="bg-[#F2E8D9] text-[#D98359] px-3 py-1.5 rounded-xl text-xs">RT {{ str_pad($item->rt, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="py-4 px-2 font-bold text-[#2D2620]">{{ $item->name }}</td>
                    <td class="py-4 px-2 text-[#8C7A6B] font-extrabold">{{ $item->no_rumah }}</td>
                    <td class="py-4 px-2 text-[#8C7A6B]">{{ $item->no_wa }}</td>
                </tr>
                @endforeach
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
    /* Styling DataTables Lofi Minimalis & Seragam */
    .dataTables_wrapper .dataTables_filter input { border: 1px solid #E8D9C5; border-radius: 1rem; padding: 0.5rem 1rem; background-color: #FDFBF7; margin-left: 0.5rem; font-family: 'Plus Jakarta Sans', sans-serif; outline: none; transition: all 0.3s ease; }
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
            order: [[0, 'asc'], [2, 'asc']] // Mengurutkan otomatis berdasarkan RT lalu Blok
        });
    });
</script>
@endpush
