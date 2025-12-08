@extends('layout')
@section('content')
<nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wide">Surveyor</p>
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
    <div class="text-center mb-10 text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-2"> Silahkan Pilih Pegawai yang ingin Anda nilai?</h2>
        <p class="text-white/80 text-lg">Silahkan Pilih salah satu pegawai di bawah ini.</p>
    </div>

    @if(session('success'))
        <div class="max-w-2xl mx-auto bg-green-500 text-white p-4 rounded-xl shadow-lg mb-8 text-center animate-bounce font-bold">
            <i class="fas fa-check-circle text-2xl mb-1 block"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($employees as $emp)
        <a href="{{ route('public.survey', $emp->id) }}" class="group bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer border-2 border-transparent hover:border-indigo-500">
            <div class="relative h-64 overflow-hidden bg-slate-200">
                @if($emp->photo)
                    <img src="{{ asset('storage/' . $emp->photo) }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                        <i class="fas fa-user text-6xl mb-4"></i>
                        <span class="text-sm">Tidak ada foto</span>
                    </div>
                @endif
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 pt-10">
                    <p class="text-white/90 text-sm font-medium uppercase tracking-wider">{{ $emp->position }}</p>
                </div>
            </div>
            
            <div class="p-5 text-center">
                <h3 class="text-xl font-bold text-slate-800 mb-4">{{ $emp->name }}</h3>
                <span class="inline-block w-full bg-indigo-100 text-indigo-700 py-3 rounded-xl font-bold group-hover:bg-indigo-600 group-hover:text-white transition duration-300">
                    Beri Penilaian
                </span>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection