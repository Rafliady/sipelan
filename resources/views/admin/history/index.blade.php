@extends('admin.layout_admin')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Masuk Data Responden</h2>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-500 text-sm">
            <tr>
                <th class="p-4">Tanggal</th>
                <th class="p-4">Responden</th>
                <th class="p-4">Pegawai Dinilai</th>
                <th class="p-4 text-center">Skor (1-5)</th>
                <th class="p-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($assessments as $data)
            <tr class="hover:bg-gray-50" x-data="{ editMode: false }">
                <td class="p-4 text-gray-500 text-sm">
                    {{ $data->created_at->format('d M Y, H:i') }}
                </td>
                <td class="p-4">
                    <div x-show="!editMode">
                        <div class="font-bold">{{ $data->surveyor_name }}</div>
                        <div class="text-xs text-gray-400">{{ $data->surveyor_phone }}</div>
                    </div>
                    <div x-show="editMode">
                        <form action="{{ route('admin.history.update', $data->id) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="text" name="surveyor_name" value="{{ $data->surveyor_name }}" class="border text-xs p-1 rounded w-full mb-1">
                            <input type="number" name="rating" min="1" max="5" value="{{ $data->rating }}" class="border text-xs p-1 rounded w-12 text-center">
                            <button class="text-xs bg-green-500 text-white px-2 py-1 rounded">Save</button>
                        </form>
                    </div>
                </td>
                <td class="p-4">{{ $data->employee->name }}</td>
                <td class="p-4 text-center">
                    <span class="inline-block w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 font-bold leading-8 text-center text-sm">
                        {{ $data->rating }}
                    </span>
                </td>
                <td class="p-4 text-right">
                    <button @click="editMode = !editMode" class="text-blue-500 hover:text-blue-700 mx-1"><i class="fas fa-edit"></i></button>
                    <form action="{{ route('admin.history.destroy', $data->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data survey ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 mx-1"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">
        {{ $assessments->links() }}
    </div>
</div>
@endsection