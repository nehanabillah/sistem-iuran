@extends('layouts.app-pengurus')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-5">
    <div>
        <div class="inline-flex items-center gap-2 mb-2 px-3 py-1 rounded-full bg-white border border-[#E8D9C5] shadow-sm">
            <span class="w-2 h-2 rounded-full bg-[#D98359]"></span>
            <span class="text-[#8C7A6B] text-[10px] font-bold tracking-wider uppercase">Wilayah RT {{ str_pad(auth()->user()->rt, 2, '0', STR_PAD_LEFT) }}</span>
        </div>
        <h1 class="text-3xl font-extrabold text-[#2D2620] tracking-tight">Dasbor Ketua RT</h1>
        <p class="text-[#8C7A6B] mt-1 font-medium">Pantau kependudukan dan verifikasi warga baru di wilayah Anda.</p>
    </div>
</div>

<!-- Grid Bento Box -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-8">

    <!-- Card 1: Total Warga (Dark Mode Bento) -->
    <div class="md:col-span-12 lg:col-span-6 bg-[#2D2620] rounded-[2rem] shadow-lg border border-[#4A4036] p-8 sm:p-10 relative overflow-hidden flex flex-col justify-between min-h-[200px]">
        <div class="absolute -bottom-16 -right-16 w-56 h-56 bg-[#D98359]/20 rounded-full blur-3xl -z-10"></div>
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center backdrop-blur-md border border-white/10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <h3 class="text-white font-extrabold uppercase tracking-wider text-sm">Populasi Wilayah</h3>
            </div>
        </div>
        <div>
            <p class="text-[#A6988C] text-xs font-medium mb-1">Total Warga Aktif</p>
            <h2 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight">{{ $totalWarga }} <span class="text-xl text-[#A6988C] font-medium">KK</span></h2>
        </div>
    </div>

    <!-- Card 2: Menunggu Persetujuan (Action Needed Bento) -->
    <div class="md:col-span-6 lg:col-span-3 bg-[#F2E8D9] rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 relative overflow-hidden flex flex-col justify-between">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-white text-[#D98359] rounded-xl flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div>
            <p class="text-[#8C7A6B] text-xs font-extrabold uppercase tracking-wider mb-1">Butuh Verifikasi</p>
            <h2 class="text-3xl font-extrabold text-[#D98359]">{{ $wargaPending }} <span class="text-sm text-[#8C7A6B] font-medium">Akun</span></h2>
        </div>
    </div>

    <!-- Card 3: Warga Nonaktif -->
    <div class="md:col-span-6 lg:col-span-3 bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] p-8 relative overflow-hidden flex flex-col justify-between">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-stone-100 text-[#8C7A6B] rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </div>
        </div>
        <div>
            <p class="text-[#8C7A6B] text-xs font-extrabold uppercase tracking-wider mb-1">Nonaktif / Pindah</p>
            <h2 class="text-3xl font-extrabold text-[#2D2620]">{{ $wargaNonaktif }} <span class="text-sm text-[#8C7A6B] font-medium">Akun</span></h2>
        </div>
    </div>
</div>

<!-- List Pendaftar Baru -->
<div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E8D9C5] overflow-hidden">
    <div class="px-6 py-5 border-b border-[#E8D9C5] bg-[#FDFBF7] flex justify-between items-center">
        <h3 class="font-extrabold text-[#2D2620]">Perlu Tindakan Cepat (Warga Baru)</h3>
        <a href="{{ route('rt.approval.index') }}" class="text-xs font-extrabold bg-white border border-[#E8D9C5] text-[#2D2620] px-4 py-2 rounded-xl hover:text-[#D98359] transition-colors shadow-sm">Lihat Semua</a>
    </div>
    <div>
        @if($pendingList->isEmpty())
            <div class="p-10 text-center flex flex-col items-center">
                <div class="w-16 h-16 bg-[#FDFBF7] rounded-full flex items-center justify-center mb-3">
                    <span class="text-2xl">🎉</span>
                </div>
                <p class="text-[#8C7A6B] font-medium">Bagus! Tidak ada pendaftar baru yang menunggu saat ini.</p>
            </div>
        @else
            <ul class="divide-y divide-[#E8D9C5]/50">
                @foreach($pendingList as $item)
                <li class="p-6 hover:bg-[#FDFBF7] transition-colors flex flex-col sm:flex-row justify-between sm:items-center gap-4 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center font-extrabold text-lg shadow-sm">
                            {{ substr($item->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-extrabold text-[#2D2620]">{{ $item->name }}</p>
                            <p class="text-xs font-bold text-[#8C7A6B] mt-0.5">Blok {{ $item->no_rumah }} <span class="text-[#E8D9C5] mx-1">•</span> WA: {{ $item->no_wa }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('rt.approval.approve', $item->id) }}" method="POST" class="w-full sm:w-auto">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full bg-green-50 text-green-600 border border-green-200 px-4 py-2 rounded-xl text-xs font-bold hover:bg-green-500 hover:text-white transition-colors shadow-sm">Setujui</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
