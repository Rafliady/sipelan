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

    // 3. Daftar Pegawai
    public function list() {
        if (!Session::has('surveyor')) return redirect()->route('home');
        $employees = Employee::all();
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

        return redirect()->route('public.list')->with('success', 'Penilaian berhasil dikirim!');
    }

    // 6. Keluar / Ganti Orang
    public function exit() {
        Session::forget('surveyor');
        return redirect()->route('home');
    }
}
