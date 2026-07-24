@extends('layouts.app-warga')

@section('content')
<div class="mb-6">
    <a href="{{ route('warga.dashboard') }}" class="inline-flex items-center gap-2 text-[#8C7A6B] hover:text-[#D98359] transition-colors font-bold text-sm bg-white/50 px-4 py-2 rounded-full border border-[#E8D9C5] shadow-sm w-fit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Lapor Pembayaran</h1>
        <p class="text-[#8C7A6B] mt-2 font-medium">Invoice: <strong class="text-[#D98359]">{{ $invoice->invoice_number }}</strong></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

        <div class="md:col-span-5 bg-[#2D2620] rounded-[2rem] shadow-lg border border-[#4A4036] p-8 relative overflow-hidden flex flex-col justify-center">
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#D98359]/20 rounded-full blur-3xl -z-10"></div>

            <h3 class="text-white font-extrabold mb-6">Transfer ke Rekening:</h3>

            <div class="space-y-4">
                <div class="bg-[#1A1612] p-4 rounded-2xl border border-[#4A4036]">
                    <p class="text-[#A6988C] text-xs font-bold uppercase tracking-wider mb-1">Bank BCA</p>
                    <p class="text-xl font-extrabold text-white tracking-widest">1234 5678 90</p>
                    <p class="text-[#A6988C] text-xs mt-1">a.n Pengurus Perumahan</p>
                </div>

                <div class="bg-[#1A1612] p-4 rounded-2xl border border-[#4A4036]">
                    <p class="text-[#A6988C] text-xs font-bold uppercase tracking-wider mb-1">Bank Mandiri</p>
                    <p class="text-xl font-extrabold text-white tracking-widest">0987 6543 21</p>
                    <p class="text-[#A6988C] text-xs mt-1">a.n Pengurus Perumahan</p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-[#4A4036]">
                <p class="text-[#A6988C] text-sm font-medium">Nominal Tagihan:</p>
                <p class="text-3xl font-extrabold text-[#D98359]">Rp {{ number_format($invoice->total_tagihan, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="md:col-span-7 bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8">
            <form action="{{ route('warga.tagihan.store-lapor', $invoice->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 h-full flex flex-col justify-between">
                @csrf

                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-[#F2E8D9] text-[#D98359] rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <label class="block text-sm font-extrabold text-[#2D2620]">Unggah Bukti Transfer</label>
                    </div>

                    <div class="relative w-full h-56 border-2 border-dashed border-[#E8D9C5] rounded-[1.5rem] bg-[#FDFBF7] hover:bg-[#F2E8D9]/50 transition-colors flex flex-col items-center justify-center cursor-pointer group" id="dropzone">

                        <div class="text-center transition-opacity" id="upload-prompt">
                            <div class="w-14 h-14 mx-auto bg-white border border-[#E8D9C5] rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-sm">
                                <svg class="w-6 h-6 text-[#D98359]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <p class="text-[#2D2620] font-bold text-sm">Klik untuk memilih foto</p>
                            <p class="text-xs text-[#8C7A6B] font-medium mt-1">Maks. 2MB (JPG, PNG)</p>
                        </div>

                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover rounded-[1.5rem] hidden" alt="Preview Bukti">

                        <input type="file" name="bukti" id="bukti" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                    @error('bukti')<p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="w-full bg-[#D98359] text-white font-extrabold text-lg py-4 rounded-2xl hover:bg-[#C26B43] shadow-lg shadow-[#D98359]/30 transition-all transform hover:-translate-y-1">
                    Kirim Bukti Bayar
                </button>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Logika Preview Gambar
    const inputFoto = document.getElementById('bukti');
    const preview = document.getElementById('image-preview');
    const prompt = document.getElementById('upload-prompt');
    const dropzone = document.getElementById('dropzone');

    inputFoto.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                prompt.classList.add('hidden');
                dropzone.classList.remove('border-dashed', 'border-2', 'bg-[#FDFBF7]');
                dropzone.classList.add('border-0');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
