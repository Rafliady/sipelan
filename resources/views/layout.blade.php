@php
    $bgSetting = \App\Models\Setting::where('key', 'bg_image')->first();
    $defaultImage = 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920';
    
    if ($bgSetting && $bgSetting->value) {
        $bgUrl = asset('storage/' . $bgSetting->value);
    } else {
        $bgUrl = $defaultImage;
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Pegawai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased relative min-h-screen flex flex-col">
    
    <div class="fixed inset-0 z-0">
        <img src="{{ $bgUrl }}" class="w-full h-full object-cover opacity-100">
        
        <div class="absolute inset-0 bg-black/20"></div>
    </div>

    <div class="relative z-10 flex-1 flex flex-col">
        @yield('content')
    </div>

</body>
</html>