@extends('admin.layout_admin')
@section('content')
<div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Laporan & Ranking</h2>
        <p class="text-gray-500 text-sm">Data akumulasi poin dan export laporan.</p>
    </div>
    
    <div class="flex gap-2">
        <a href="{{ route('admin.ranking.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-700 shadow flex items-center gap-2">
            <i class="fas fa-file-pdf"></i> Download PDF
        </a>
        <a href="{{ route('admin.ranking.excel') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-green-700 shadow flex items-center gap-2">
            <i class="fas fa-file-excel"></i> Download Excel
        </a>
        
        <form action="{{ route('admin.ranking.reset') }}" method="POST" onsubmit="return confirm('Reset skor bulan ini?')">
            @csrf @method('DELETE')
            <button class="bg-gray-200 text-gray-700 border hover:bg-gray-300 px-4 py-2 rounded-lg font-bold transition">
                <i class="fas fa-sync-alt"></i> Reset
            </button>
        </form>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-800 text-white">
            <tr>
                <th class="p-4">Rank</th>
                <th class="p-4">Pegawai</th>
                <th class="p-4 text-center">Jml Responden</th>
                <th class="p-4 text-center">Total Poin (Akumulasi)</th>
                <th class="p-4 text-center">Rata-Rata</th>
                <th class="p-4 text-center">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($employees as $emp)
            <tr class="hover:bg-gray-50">
                <td class="p-4 font-bold text-gray-400">#{{ $loop->iteration }}</td>
                <td class="p-4">
                    <div class="font-bold text-gray-800">{{ $emp->name }}</div>
                    <div class="text-xs text-gray-500">{{ $emp->position }}</div>
                </td>
                <td class="p-4 text-center">{{ $emp->assessments_count }} Org</td>
                <td class="p-4 text-center font-bold text-indigo-600">{{ $emp->assessments_sum_rating ?? 0 }}</td>
                <td class="p-4 text-center font-bold text-xl">{{ number_format($emp->assessments_avg_rating, 1) }}</td>
                <td class="p-4 text-center">
                   @if($emp->assessments_avg_rating >= 4) <span class="text-green-600 font-bold">Baik</span>
                   @elseif($emp->assessments_avg_rating >= 3) <span class="text-blue-600 font-bold">Cukup</span>
                   @else <span class="text-red-600 font-bold">Kurang</span>
                   @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection