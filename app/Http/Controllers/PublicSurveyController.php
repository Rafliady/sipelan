<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PublicSurveyController extends Controller
{
    // 1. Halaman Depan (Input Data Diri)
    public function index() {
        return view('public.welcome');
    }

    // 2. Proses Masuk (Simpan sesi)
    public function enter(Request $request) {
        $request->validate(['name' => 'required', 'phone' => 'required']);
        Session::put('surveyor', [
            'name' => $request->name,
            'phone' => $request->phone
        ]);
        return redirect()->route('public.list');
    }

    // 3. Daftar Pegawai + FITUR SEARCH
    public function list(Request $request) {
        if (!Session::has('surveyor')) return redirect()->route('home');

        // Ambil keyword search (jika ada)
        $search = $request->search;

        // Filter berdasarkan nama atau posisi
        $employees = Employee::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
        })->get();

        return view('public.list', compact('employees'));
    }

    // 4. Form Survey
    public function showSurvey($id) {
        if (!Session::has('surveyor')) return redirect()->route('home');
        $employee = Employee::findOrFail($id);
        return view('public.survey', compact('employee'));
    }

    // 5. Simpan Survey
    public function storeSurvey(Request $request) {
        $surveyor = Session::get('surveyor');

        Assessment::create([
            'employee_id' => $request->employee_id,
            'surveyor_name' => $surveyor['name'],
            'surveyor_phone' => $surveyor['phone'],
            'rating' => $request->rating, // Simpan satu nilai ini
        ]);

        return redirect()->route('public.list')->with('success', 'Berhasil! Penilaian Anda sudah tersimpan. Lanjutkan memilih pegawai lainnya, atau tekan selesai jika sudah selesai melakukan penilaian');
    }

    // 6. Keluar / Ganti Orang
    public function exit() {
        Session::forget('surveyor');
        return redirect()->route('home');
    }
}
