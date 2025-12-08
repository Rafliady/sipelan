@php
    $bgSetting = \App\Models\Setting::where('key', 'bg_image')->first();
    $bgUrl = $bgSetting && $bgSetting->value ? asset('storage/'.$bgSetting->value) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920';
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 flex min-h-screen">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col fixed h-full z-20 transition-all duration-300">
        <div class="p-6 border-b border-slate-800 flex items-center gap-3">
            <i class="fas fa-chart-pie text-indigo-500 text-2xl"></i>
            <span class="font-bold text-white text-lg">E-Kinerja</span>
        </div>
        
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : '' }}">
                <i class="fas fa-home w-5"></i> Dashboard
            </a>
            <a href="{{ route('admin.employees') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 hover:text-white transition {{ request()->routeIs('admin.employees') ? 'bg-indigo-600 text-white' : '' }}">
                <i class="fas fa-users w-5"></i> Kelola Pegawai
            </a>
            <a href="{{ route('admin.history') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 hover:text-white transition {{ request()->routeIs('admin.history') ? 'bg-indigo-600 text-white' : '' }}">
                <i class="fas fa-history w-5"></i> Riwayat Survey
            </a>
            <a href="{{ route('admin.ranking') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 hover:text-white transition {{ request()->routeIs('admin.ranking') ? 'bg-indigo-600 text-white' : '' }}">
                <i class="fas fa-trophy w-5"></i> Ranking & Skor
            </a>
            <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-600 hover:text-white transition {{ request()->routeIs('admin.settings') ? 'bg-indigo-600 text-white' : '' }}">
    <i class="fas fa-image w-5"></i> Ganti Background
</a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full bg-red-600/20 text-red-500 hover:bg-red-600 hover:text-white py-2 rounded-lg transition flex items-center justify-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8 overflow-y-auto h-screen">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <i class="fas fa-check-circle"></i>
            </div>
        @endif
        
        @yield('content')
    </main>

</body>
</html>