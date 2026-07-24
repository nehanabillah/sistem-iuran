@extends('layouts.app-warga')

@section('content')
<div class="mb-6">
    <a href="{{ route('warga.dashboard') }}" class="inline-flex items-center gap-2 text-[#8C7A6B] hover:text-[#D98359] transition-colors font-bold text-sm bg-white/50 px-4 py-2 rounded-full border border-[#E8D9C5] shadow-sm w-fit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Dasbor
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Pembayaran Otomatis</h1>
        <p class="text-[#8C7A6B] mt-2 font-medium">Selesaikan iuran Anda dengan cepat, aman, dan terverifikasi seketika.</p>
    </div>

    <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 sm:p-12 relative overflow-hidden text-center group">
        <div class="absolute top-0 right-0 w-40 h-40 bg-[#F2E8D9] rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-[#D98359]/5 rounded-tr-full -z-10"></div>

        <div class="inline-flex justify-center items-center bg-[#FDFBF7] border border-[#E8D9C5] p-3 rounded-2xl mb-6 shadow-sm">
            <svg class="w-8 h-8 text-[#D98359]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>

        <p class="text-[#8C7A6B] text-sm font-bold uppercase tracking-wider mb-2">Invoice Tagihan</p>
        <p class="text-xl font-extrabold text-[#2D2620] mb-8">{{ $invoice->invoice_number }}</p>

        <div class="bg-[#FDFBF7] border border-[#E8D9C5] rounded-3xl p-8 mb-10 shadow-inner">
            <p class="text-[#8C7A6B] font-medium mb-2">Total yang harus dibayar</p>
            <h2 class="text-5xl font-extrabold text-[#2D2620]">Rp {{ number_format($invoice->total_tagihan, 0, ',', '.') }}</h2>
        </div>

        <button id="pay-button" class="w-full bg-[#2D2620] text-white font-extrabold text-lg py-4 rounded-2xl hover:bg-[#1A1612] shadow-lg shadow-[#2D2620]/20 transition-all transform hover:-translate-y-1 flex justify-center items-center gap-3">
            Bayar Sekarang (Midtrans)
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </button>

        <p class="mt-6 text-xs font-bold text-[#8C7A6B] flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            Dilindungi oleh sistem pembayaran terenkripsi.
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function (e) {
        e.preventDefault();

        // Memanggil Pop-up Snap Midtrans menggunakan token yang dikirim dari Controller
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pembayaran tagihan Anda berhasil.',
                    confirmButtonColor: '#D98359'
                }).then(() => {
                    window.location.href = "{{ route('warga.dashboard') }}";
                });
            },
            onPending: function(result){
                Swal.fire({
                    icon: 'info',
                    title: 'Menunggu',
                    text: 'Silakan selesaikan pembayaran Anda.',
                    confirmButtonColor: '#D98359'
                });
            },
            onError: function(result){
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Pembayaran gagal diproses.',
                    confirmButtonColor: '#D98359'
                });
            },
            onClose: function(){
                console.log('User menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
</script>
@endpush
