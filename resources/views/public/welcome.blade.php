@extends('layout')
@section('content')
<div class="flex-1 flex flex-col items-center justify-center p-4">

    <div class="absolute top-6 right-6">
        <a href="{{ route('login') }}" class="px-4 py-2 rounded-full border border-white/30 text-white hover:bg-white/10 transition backdrop-blur-sm flex items-center gap-2 text-sm font-medium">
            <i class="fas fa-lock"></i> Login Admin
        </a>
    </div>

    <div class="bg-white/95 backdrop-blur-xl p-8 md:p-10 rounded-3xl shadow-2xl w-full max-w-lg border border-white/50">
        <div class="text-center mb-8">
            <img src="{{ asset('storage/img/logo.png') }}" class="w-20 h-20 mx-auto mb-4 drop-shadow-md">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Selamat datang di SiPeLan - Imigrasi Wonosobo</h1>
            <p class="text-slate-500">Silakan isi data diri Anda untuk memulai penilaian pelayanan. Suara Anda membantu kami menjadi lebih baik!</p>
        </div>

        <form action="{{ route('public.enter') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-slate-700 font-bold mb-2 ml-1">Nama Lengkap</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="text" name="name" required 
                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 outline-none transition text-lg" 
                           placeholder="Masukan nama anda...">
                </div>
            </div>
            
            <div>
                <label class="block text-slate-700 font-bold mb-2 ml-1">Nomor HP / WhatsApp</label>
                <div class="relative">
                    <i class="fas fa-phone absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="number" name="phone" required 
                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 outline-none transition text-lg" 
                           placeholder="08xxxxxxxxxx">
                </div>
            </div>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-indigo-500/30 transition transform hover:-translate-y-1 text-lg mt-4">
                Masuk Penilaian Survei <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
    </div>
    
    <p class="text-white/50 text-sm mt-8 text-center">&copy; {{ date('Y') }} SiPeLan Imigrasi Wonosobo. All Rights Reserved.</p>
</div>
@endsection