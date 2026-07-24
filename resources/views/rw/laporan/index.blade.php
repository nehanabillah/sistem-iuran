@extends('layouts.app-pengurus')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-sm border border-[#E8D9C5]">
    <h2 class="text-xl font-extrabold mb-6">Data Pembayaran Warga</h2>

    <table class="w-full">
        <thead>
            <tr class="text-xs text-[#8C7A6B] uppercase border-b border-[#E8D9C5]">
                <th class="pb-3 text-left">Warga</th>
                <th class="pb-3 text-left">Status</th>
                <th class="pb-3 text-left">Bukti Transfer</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#E8D9C5]/50">
            @foreach($invoices as $invoice)
            <tr>
                <td class="py-4 font-bold">{{ $invoice->user?->name ?? 'Warga Tidak Ditemukan / Dihapus' }}</td>
                <td class="py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold
                        {{ $invoice->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                        {{ strtoupper($invoice->status) }}
                    </span>
                </td>
                <td class="py-4">
                    @if($invoice->bukti_pembayaran)
                        <!-- INI KUNCI TAMPILAN GAMBAR -->
                        <a href="{{ asset('storage/' . $invoice->bukti_pembayaran) }}" target="_blank">
                            <img src="{{ asset('storage/' . $invoice->bukti_pembayaran) }}"
                                 class="w-16 h-16 object-cover rounded-lg border border-[#E8D9C5] hover:scale-110 transition-transform"
                                 alt="Bukti">
                        </a>
                    @else
                        <span class="text-xs text-gray-400">Belum ada</span>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
