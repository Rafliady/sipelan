@extends('layout')
@section('content')
<div class="container mx-auto px-4 py-8 flex items-center justify-center min-h-[90vh]">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-4xl w-full">
        <div class="md:flex">
            <div class="bg-indigo-600 text-white md:w-1/3 p-8 flex flex-col items-center justify-center text-center">
                <div class="w-32 h-32 rounded-full border-4 border-white/30 overflow-hidden mb-6 shadow-lg bg-white">
                    @if($employee->photo)
                        <img src="{{ asset('storage/'.$employee->photo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-indigo-300"><i class="fas fa-user text-4xl"></i></div>
                    @endif
                </div>
                <h2 class="text-2xl font-bold mb-1">{{ $employee->name }}</h2>
                <p class="text-indigo-200 font-medium mb-6">{{ $employee->position }}</p>
                
                <a href="{{ route('public.list') }}" class="text-sm text-white/70 hover:text-white flex items-center gap-2 border border-white/30 px-4 py-2 rounded-full transition hover:bg-white/10">
                    <i class="fas fa-arrow-left"></i> Ganti Pegawai
                </a>
            </div>

            <div class="p-8 md:p-10 md:w-2/3 bg-slate-50">
                <form action="{{ route('survey.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">

                    <div class="mb-8">
                        <label class="block text-xl font-bold text-slate-800 mb-6 text-center">
                            Bagaimana kinerja pegawai ini menurut Anda?
                        </label>

                        <div class="grid grid-cols-1 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="5" class="peer sr-only" required>
                                <div class="p-4 rounded-xl border-2 border-slate-200 bg-white hover:border-green-500 hover:bg-green-50 peer-checked:bg-green-600 peer-checked:border-green-600 peer-checked:text-white transition flex items-center gap-4 group">
                                    <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-2xl group-hover:scale-110 transition peer-checked:bg-white peer-checked:text-green-600">
                                        <i class="fas fa-smile-beam"></i>
                                    </div>
                                    <span class="text-lg font-bold">Sangat Baik</span>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="4" class="peer sr-only">
                                <div class="p-4 rounded-xl border-2 border-slate-200 bg-white hover:border-blue-500 hover:bg-blue-50 peer-checked:bg-blue-600 peer-checked:border-blue-600 peer-checked:text-white transition flex items-center gap-4 group">
                                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-2xl group-hover:scale-110 transition peer-checked:bg-white peer-checked:text-blue-600">
                                        <i class="fas fa-smile"></i>
                                    </div>
                                    <span class="text-lg font-bold">Baik</span>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="3" class="peer sr-only">
                                <div class="p-4 rounded-xl border-2 border-slate-200 bg-white hover:border-yellow-500 hover:bg-yellow-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-500 peer-checked:text-white transition flex items-center gap-4 group">
                                    <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-2xl group-hover:scale-110 transition peer-checked:bg-white peer-checked:text-yellow-600">
                                        <i class="fas fa-meh"></i>
                                    </div>
                                    <span class="text-lg font-bold">Cukup</span>
                                </div>
                            </label>

                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="2" class="peer sr-only">
                                    <div class="p-4 rounded-xl border-2 border-slate-200 bg-white hover:border-orange-500 hover:bg-orange-50 peer-checked:bg-orange-500 peer-checked:border-orange-500 peer-checked:text-white transition flex flex-col items-center justify-center text-center gap-2 h-full">
                                        <i class="fas fa-frown text-2xl"></i>
                                        <span class="font-bold">Kurang Baik</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="1" class="peer sr-only">
                                    <div class="p-4 rounded-xl border-2 border-slate-200 bg-white hover:border-red-500 hover:bg-red-50 peer-checked:bg-red-600 peer-checked:border-red-600 peer-checked:text-white transition flex flex-col items-center justify-center text-center gap-2 h-full">
                                        <i class="fas fa-angry text-2xl"></i>
                                        <span class="font-bold">Sangat Buruk</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-800 text-white py-4 rounded-xl font-bold text-xl hover:bg-indigo-900 transition shadow-lg transform hover:-translate-y-1">
                        Kirim Penilaian
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection