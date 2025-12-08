@extends('admin.layout_admin')
@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-500">Ringkasan performa penilaian kinerja pegawai.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xl">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Pegawai</p>
            <h3 class="text-2xl font-bold">{{ $totalPegawai }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl">
            <i class="fas fa-poll"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Survey</p>
            <h3 class="text-2xl font-bold">{{ $totalSurvey }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Masuk Bulan Ini</p>
            <h3 class="text-2xl font-bold">{{ $surveyBulanIni }}</h3>
        </div>
    </div>

    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 rounded-2xl shadow-lg text-white">
        <p class="text-xs text-indigo-200 uppercase tracking-wider mb-1">Star of the Month</p>
        @if($topEmployee)
            <h3 class="text-xl font-bold truncate">{{ $topEmployee->name }}</h3>
            <div class="flex items-center gap-2 mt-2">
                <i class="fas fa-star text-yellow-300"></i>
                <span class="font-bold text-2xl">{{ number_format($topEmployee->assessments_avg_rating, 1) }}</span>
            </div>
        @else
            <h3 class="font-bold">-</h3>
            <span class="text-sm opacity-70">Belum ada data</span>
        @endif
    </div>
</div>
@endsection