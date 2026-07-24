@extends('layouts.app-pengurus')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Pengaturan Iuran</h1>
    <p class="text-[#8C7A6B] mt-2 font-medium">Kelola komponen tagihan yang akan ditagihkan secara otomatis ke warga.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Kolom Kiri: Form Input Komponen (Lebar 4) -->
    <div class="lg:col-span-4 bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 sticky top-28 overflow-hidden group">
        <!-- Ornamen Lofi -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#F2E8D9] rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>

        <div class="flex items-center gap-3 mb-6 border-b border-[#E8D9C5] pb-4">
            <div class="w-10 h-10 bg-[#2D2620] text-white rounded-xl flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <h2 class="text-lg font-extrabold text-[#2D2620]">Tambah Komponen</h2>
        </div>

        <form action="{{ route('bendahara.master-iuran.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Nama Komponen Iuran</label>
                <input type="text" name="nama_iuran" placeholder="Contoh: Uang Keamanan" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-bold shadow-sm">
            </div>

            <div>
                <label class="block text-xs font-extrabold text-[#8C7A6B] mb-2 uppercase tracking-wider">Nominal (Rp)</label>
                <input type="number" name="nominal" placeholder="Contoh: 100000" required class="w-full bg-[#FDFBF7] border border-[#E8D9C5] px-4 py-3.5 rounded-2xl focus:ring-4 focus:ring-[#D98359]/20 focus:border-[#D98359] outline-none transition-all text-[#2D2620] font-extrabold shadow-sm">
            </div>

            <!-- Custom Checkbox Lofi -->
            <label class="flex items-center cursor-pointer group pt-2">
                <div class="relative">
                    <input type="checkbox" name="is_active" value="1" checked class="peer sr-only">
                    <div class="block w-10 h-6 bg-[#E8D9C5] rounded-full peer-checked:bg-[#D98359] transition-colors"></div>
                    <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform peer-checked:translate-x-4"></div>
                </div>
                <div class="ml-3 text-sm font-extrabold text-[#8C7A6B] group-hover:text-[#2D2620] transition-colors">Status Aktif (Ditagihkan)</div>
            </label>

            <div class="pt-4 border-t border-[#E8D9C5]/50">
                <button type="submit" class="w-full bg-[#D98359] text-white font-extrabold py-4 rounded-2xl hover:bg-[#C26B43] transition-colors shadow-lg shadow-[#D98359]/20 transform hover:-translate-y-1">
                    Simpan Komponen
                </button>
            </div>
        </form>
    </div>

    <!-- Kolom Kanan: Tabel Komponen dengan DataTables (Lebar 8) -->
    <div class="lg:col-span-8 bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-6 sm:p-8">
        <h3 class="text-xl font-extrabold text-[#2D2620] mb-6">Daftar Komponen Saat Ini</h3>

        <div class="overflow-x-auto">
            <table id="iuranTable" class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="border-b border-[#E8D9C5]">
                        <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider">Nama Komponen</th>
                        <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-right">Nominal</th>
                        <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-center">Status</th>
                        <th class="pb-4 px-2 text-xs font-extrabold text-[#8C7A6B] uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#2D2620] font-medium text-sm divide-y divide-[#E8D9C5]/50">
                    @forelse($iurans as $item)
                    <tr class="hover:bg-[#FDFBF7] transition-colors group">
                        <td class="py-4 px-2 font-extrabold text-[#2D2620]">
                            {{ $item->nama_iuran }}
                        </td>
                        <td class="py-4 px-2 font-extrabold text-[#D98359] text-right">
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="py-4 px-2 text-center">
                            @if($item->is_active)
                                <span class="inline-flex items-center gap-1.5 bg-green-50 border border-green-200 text-green-700 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-stone-100 border border-stone-200 text-stone-500 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-stone-400"></span> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-2 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Tombol Edit Lofi -->
                                <a href="{{ route('bendahara.master-iuran.edit', $item->id) }}" class="bg-[#F2E8D9] text-[#D98359] p-2 rounded-xl hover:bg-[#D98359] hover:text-white transition-colors shadow-sm" title="Edit Komponen">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>

                                <!-- Tombol Hapus Aman -->
                                <form action="{{ route('bendahara.master-iuran.destroy', $item->id) }}" method="POST" class="form-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="bg-red-50 text-red-500 p-2 rounded-xl hover:bg-red-100 hover:text-red-700 transition-colors shadow-sm btn-hapus" title="Hapus Komponen">
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
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<style>
    /* Styling DataTables Lofi */
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
        $('#iuranTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' },
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-6 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-4 gap-4"ip>',
            responsive: true,
            columnDefs: [ { orderable: false, targets: [2, 3] } ] // Matikan urutan di kolom status dan aksi
        });

        // SweetAlert untuk Hapus Komponen Iuran
        $('.btn-hapus').on('click', function() {
            const form = $(this).closest('.form-hapus');
            Swal.fire({
                title: 'Hapus Komponen Iuran?',
                text: "Jika dihapus, komponen ini tidak akan disertakan lagi pada tagihan warga di bulan berikutnya.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444', // Merah peringatan
                cancelButtonColor: '#8C7A6B',
                confirmButtonText: 'Ya, Hapus Komponen!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' }
            }).then((result) => {
                if (result.isConfirmed) { form.submit(); }
            });
        });
    });
</script>
@endpush
