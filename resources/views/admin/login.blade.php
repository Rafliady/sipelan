@extends('layout')
@section('content')
<div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-slate-900">
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1557683316-973673baf926?q=80&w=2000" class="w-full h-full object-cover">
    </div>

    <div class="relative z-10 w-full max-w-md p-6">
        <div class="bg-slate-800/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-slate-700">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-indigo-500 rounded-xl mx-auto flex items-center justify-center mb-4 shadow-lg shadow-indigo-500/50">
                    <i class="fas fa-user-shield text-3xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-white">Admin Portal</h2>
                <p class="text-slate-400 text-sm">Masukan kredensial untuk mengakses panel.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-3 rounded-lg mb-6 text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.auth') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-slate-300 text-sm font-bold mb-2">Username</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-3 text-slate-500"></i>
                        <input type="text" name="username" class="w-full bg-slate-900/50 border border-slate-600 rounded-lg py-2.5 pl-10 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition" placeholder="Username">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-slate-300 text-sm font-bold mb-2">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-3 text-slate-500"></i>
                        <input type="password" name="password" class="w-full bg-slate-900/50 border border-slate-600 rounded-lg py-2.5 pl-10 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition" placeholder="••••••••">
                    </div>
                </div>

                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition shadow-lg shadow-indigo-600/30">
                    MASUK SISTEM
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-slate-500 hover:text-white text-sm transition">
                    &larr; Kembali ke Halaman Survey
                </a>
            </div>
        </div>
    </div>
</div>
@endsection