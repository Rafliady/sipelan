@extends('admin.layout_admin')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Kelola Data Pegawai</h2>
    <button onclick="document.getElementById('modalAdd').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg font-bold shadow transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Pegawai
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
            <tr>
                <th class="p-4 border-b">Foto</th>
                <th class="p-4 border-b">Nama & Jabatan</th>
                <th class="p-4 border-b text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($employees as $emp)
            <tr class="hover:bg-gray-50 transition" x-data="{ openEdit: false }">
                <td class="p-4">
                    @if($emp->photo)
                        <img src="{{ asset('storage/'.$emp->photo) }}" class="w-12 h-12 rounded-full object-cover border border-gray-200">
                    @else
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-lg">
                            {{ substr($emp->name, 0, 1) }}
                        </div>
                    @endif
                </td>
                <td class="p-4">
                    <p class="font-bold text-gray-800">{{ $emp->name }}</p>
                    <p class="text-sm text-gray-500">{{ $emp->position }}</p>

                    <div x-show="openEdit" class="mt-4 p-4 bg-gray-100 rounded-lg border border-gray-200">
                        <form action="{{ route('admin.employees.update', $emp->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="grid grid-cols-2 gap-4 mb-3">
                                <input type="text" name="name" value="{{ $emp->name }}" class="border p-2 rounded" required>
                                <input type="text" name="position" value="{{ $emp->position }}" class="border p-2 rounded" required>
                            </div>
                            <input type="file" name="photo" class="text-sm mb-3">
                            <div class="flex gap-2">
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm">Simpan</button>
                                <button type="button" @click="openEdit = false" class="bg-gray-400 text-white px-3 py-1 rounded text-sm">Batal</button>
                            </div>
                        </form>
                    </div>
                </td>
                <td class="p-4 text-right">
                    <button @click="openEdit = !openEdit" class="text-blue-500 hover:text-blue-700 mx-2" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('admin.employees.destroy', $emp->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus pegawai ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 mx-2" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalAdd" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-2xl">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h3 class="text-xl font-bold">Tambah Pegawai Baru</h3>
            <button onclick="document.getElementById('modalAdd').classList.add('hidden')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Nama Pegawai</label>
                <input type="text" name="name" class="w-full border p-2 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Jabatan</label>
                <input type="text" name="position" class="w-full border p-2 rounded-lg" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-bold mb-1">Foto Profil</label>
                <input type="file" name="photo" class="w-full border p-2 rounded-lg bg-gray-50">
            </div>
            <button class="w-full bg-indigo-600 text-white py-2 rounded-lg font-bold hover:bg-indigo-700">Simpan Pegawai</button>
        </form>
    </div>
</div>
@endsection