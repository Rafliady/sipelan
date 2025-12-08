@extends('admin.layout_admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Tampilan</h2>

<div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 max-w-2xl">
    <h3 class="font-bold text-lg mb-4">Ganti Background Halaman Utama</h3>
    
    @if($bg && $bg->value)
        <div class="mb-4">
            <p class="text-sm text-gray-500 mb-2">Background Saat Ini:</p>
            <img src="{{ asset('storage/'.$bg->value) }}" class="w-full h-48 object-cover rounded-lg border">
        </div>
    @else
        <div class="mb-4 p-4 bg-gray-100 rounded text-gray-500 text-sm">
            Belum ada background custom (Menggunakan default).
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Upload Foto Baru (Max 5MB)</label>
            <input type="file" name="bg_image" class="w-full border p-2 rounded bg-gray-50" required accept="image/*">
            <p class="text-xs text-gray-400 mt-1">Disarankan ukuran 1920x1080 pixel.</p>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg">
            <i class="fas fa-save mr-2"></i> Simpan Perubahan
        </button>
    </form>
</div>
@endsection