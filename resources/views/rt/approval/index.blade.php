@extends('layouts.app-pengurus')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Verifikasi Pendaftar</h1>
    <p class="text-[#8C7A6B] mt-2 font-medium">Periksa identitas warga yang baru mendaftar. Pastikan data blok rumah sesuai sebelum menyetujui.</p>
</div>

<div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-6 sm:p-8 overflow-hidden relative">
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#F2E8D9] rounded-bl-full -z-10 transition-transform hover:scale-105"></div>

    <div class="overflow-x-auto">
        <table id="approvalTable" class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="border-b border-[#E8D9C5]">
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Tgl Daftar</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Nama Lengkap</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Blok/Rumah</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Nomor WA</th>
                    <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-center">Aksi Verifikasi</th>
                </tr>
            </thead>
            <tbody class="text-[#2D2620] font-medium text-sm divide-y divide-[#E8D9C5]/50">
                @forelse($pendingWarga as $item)
                <tr class="hover:bg-[#FDFBF7] transition-colors">
                    <td class="py-4 px-2 text-[#8C7A6B] font-bold">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="py-4 px-2 font-extrabold text-[#2D2620]">{{ $item->name }}</td>
                    <td class="py-4 px-2 font-bold text-[#D98359]">{{ $item->no_rumah }}</td>
                    <td class="py-4 px-2 text-[#8C7A6B]">{{ $item->no_wa }}</td>
                    <td class="py-4 px-2 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <!-- Terima -->
                            <form action="{{ route('rt.approval.approve', $item->id) }}" method="POST" class="form-terima inline-block">
                                @csrf @method('PATCH')
                                <button type="button" class="bg-green-50 text-green-600 border border-green-200 px-4 py-2 rounded-xl text-xs font-bold hover:bg-green-500 hover:text-white transition-colors shadow-sm btn-terima">Terima</button>
                            </form>
                            <!-- Tolak -->
                            <form action="{{ route('rt.approval.reject', $item->id) }}" method="POST" class="form-tolak inline-block">
                                @csrf @method('DELETE')
                                <button type="button" class="bg-red-50 text-red-500 border border-red-100 px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-500 hover:text-white transition-colors shadow-sm btn-tolak">Tolak & Hapus</button>
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
    /* Styling DataTables Lofi Minimal */
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
        $('#approvalTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' },
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-6 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-4 gap-4"ip>',
            responsive: true,
            order: [[0, 'desc']], // Urutkan tgl daftar terbaru
            columnDefs: [ { orderable: false, targets: 4 } ]
        });

        // SweetAlert Terima
        $('.btn-terima').on('click', function() {
            const form = $(this).closest('.form-terima');
            Swal.fire({
                title: 'Setujui Warga?',
                text: "Akun ini akan diaktifkan dan dimasukkan ke dalam penagihan iuran otomatis bulan depan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10B981',
                cancelButtonColor: '#8C7A6B',
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' }
            }).then((result) => { if (result.isConfirmed) { form.submit(); } });
        });

        // SweetAlert Tolak
        $('.btn-tolak').on('click', function() {
            const form = $(this).closest('.form-tolak');
            Swal.fire({
                title: 'Tolak & Hapus Data?',
                text: "Data pendaftaran akun ini akan dihapus secara permanen dari sistem.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#8C7A6B',
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' }
            }).then((result) => { if (result.isConfirmed) { form.submit(); } });
        });
    });
</script>
@endpush
