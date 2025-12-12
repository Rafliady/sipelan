@extends('layout')
@section('content')
<nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wide">Responden</p>
                <p class="font-bold text-slate-800 leading-none">{{ session('surveyor')['name'] }}</p>
            </div>
        </div>
        
        <form action="{{ route('public.exit') }}" method="POST">
            @csrf
            <button class="text-red-500 font-bold hover:bg-red-50 px-4 py-2 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i> <span class="hidden md:inline">Selesai / Keluar</span>
            </button>
        </form>
    </div>
</nav>

<div class="container mx-auto px-4 py-10">

    <!-- 🔍 SEARCH BAR -->
    <div class="max-w-xl mx-auto mb-8">
        <form method="GET" id="searchForm">
            <div class="relative">
                <input 
                    type="text" 
                    name="search"
                    placeholder="Cari pegawai..."
                    value="{{ request('search') }}"
                    class="w-full py-3 pl-12 pr-4 rounded-xl shadow-md focus:ring-2 focus:ring-indigo-500 border border-slate-300"
                    oninput="document.getElementById('searchForm').submit();"
                >
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            </div>
        </form>
    </div>

    <div class="text-center mb-10 text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-2">Silakan pilih pegawai yang akan Anda nilai!</h2>
        <p class="text-white/80 text-lg">Klik nama pegawai untuk memberikan penilaian</p>
    </div>

    @if(session('success'))
        <div class="max-w-2xl mx-auto bg-green-500 text-white p-4 rounded-xl shadow-lg mb-8 text-center animate-bounce font-bold">
            <i class="fas fa-check-circle text-2xl mb-1 block"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- GRID CARD -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
        @forelse($employees as $emp)
        <a href="{{ route('public.survey', $emp->id) }}" 
           class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer border border-slate-200 hover:border-indigo-500">

            <!-- FOTO -->
            <div class="relative h-48 overflow-hidden bg-slate-200">
                @if($emp->photo)
                    <img src="{{ asset('storage/' . $emp->photo) }}" 
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                        <i class="fas fa-user text-5xl mb-3"></i>
                        <span class="text-xs">Tidak ada foto</span>
                    </div>
                @endif

                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-3 pt-8">
                    <p class="text-white/90 text-xs font-medium uppercase tracking-wider">{{ $emp->position }}</p>
                </div>
            </div>
            
            <!-- DETAIL -->
            <div class="p-4 text-center">
                <h3 class="text-lg font-bold text-slate-800 mb-3">{{ $emp->name }}</h3>

                <span class="inline-block w-full bg-indigo-100 text-indigo-700 py-2 rounded-lg font-bold group-hover:bg-indigo-600 group-hover:text-white transition duration-300 text-sm">
                    Beri Penilaian
                </span>
            </div>

        </a>
        @empty
            <p class="col-span-full text-center text-white text-lg">Pegawai tidak ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection
