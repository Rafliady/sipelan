<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Assessment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Library PDF

class AdminController extends Controller
{
    // ==========================================
    // 1. DASHBOARD
    // ==========================================
    public function dashboard()
    {
        $totalPegawai = Employee::count();
        $totalSurvey = Assessment::count();
        $surveyBulanIni = Assessment::whereMonth('created_at', Carbon::now()->month)->count();

        // Pegawai Terbaik Bulan Ini
        $topEmployee = Employee::withAvg('assessments', 'rating')
                        ->orderByDesc('assessments_avg_rating')
                        ->first();

        return view('admin.dashboard', compact('totalPegawai', 'totalSurvey', 'surveyBulanIni', 'topEmployee'));
    }

    // ==========================================
    // 2. KELOLA PEGAWAI (CRUD)
    // ==========================================
    public function employeeIndex()
    {
        $employees = Employee::latest()->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function employeeStore(Request $request)
    {
        $request->validate(['name'=>'required', 'position'=>'required']);
        $path = $request->file('photo') ? $request->file('photo')->store('employees', 'public') : null;
        
        Employee::create(['name'=>$request->name, 'position'=>$request->position, 'photo'=>$path]);
        return back()->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function employeeUpdate(Request $request, $id)
    {
        $emp = Employee::findOrFail($id);
        $data = ['name' => $request->name, 'position' => $request->position];

        if ($request->hasFile('photo')) {
            if ($emp->photo) Storage::disk('public')->delete($emp->photo);
            $data['photo'] = $request->file('photo')->store('employees', 'public');
        }

        $emp->update($data);
        return back()->with('success', 'Data pegawai diperbarui');
    }

    public function employeeDestroy($id)
    {
        $emp = Employee::findOrFail($id);
        if ($emp->photo) Storage::disk('public')->delete($emp->photo);
        $emp->delete();
        return back()->with('success', 'Pegawai dihapus');
    }

    // ==========================================
    // 3. RIWAYAT SURVEY
    // ==========================================
    public function historyIndex()
    {
        $assessments = Assessment::with('employee')->latest()->paginate(10);
        return view('admin.history.index', compact('assessments'));
    }

    public function historyUpdate(Request $request, $id)
    {
        $assessment = Assessment::findOrFail($id);
        $assessment->update($request->only(['surveyor_name', 'rating']));
        return back()->with('success', 'Data survey diperbarui.');
    }

    public function historyDestroy($id)
    {
        Assessment::findOrFail($id)->delete();
        return back()->with('success', 'Data survey dihapus.');
    }

    // ==========================================
    // 4. RANKING, AKUMULASI & EXPORT
    // ==========================================
    public function rankingIndex()
    {
        // Fitur Akumulasi: Count (Jumlah Org) & Sum (Total Poin)
        $employees = Employee::withCount('assessments')
                     ->withSum('assessments', 'rating')
                     ->withAvg('assessments', 'rating')
                     ->get()
                     ->sortByDesc('assessments_avg_rating');

        return view('admin.ranking.index', compact('employees'));
    }

    public function rankingReset()
    {
        Assessment::whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year)
                  ->delete();

        return back()->with('success', 'Skor penilaian bulan ini berhasil di-reset.');
    }

    public function exportPdf()
    {
        $employees = Employee::withCount('assessments')
                     ->withSum('assessments', 'rating')
                     ->withAvg('assessments', 'rating')
                     ->get()
                     ->sortByDesc('assessments_avg_rating');

        $pdf = Pdf::loadView('admin.ranking.pdf', compact('employees'));
        return $pdf->download('laporan-ranking-pegawai.pdf');
    }

    public function exportExcel()
    {
        $employees = Employee::withCount('assessments')
                     ->withSum('assessments', 'rating')
                     ->withAvg('assessments', 'rating')
                     ->get()
                     ->sortByDesc('assessments_avg_rating');

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan-ranking.xls");
        
        return view('admin.ranking.excel', compact('employees'));
    }

    // ==========================================
    // 5. PENGATURAN BACKGROUND
    // ==========================================
    public function settingIndex()
    {
        $bg = Setting::where('key', 'bg_image')->first();
        return view('admin.settings.index', compact('bg'));
    }

    public function settingUpdate(Request $request)
    {
        $request->validate(['bg_image' => 'required|image|max:5048']);
        
        $path = $request->file('bg_image')->store('settings', 'public');

        Setting::updateOrCreate(
            ['key' => 'bg_image'],
            ['value' => $path]
        );

        return back()->with('success', 'Background berhasil diubah!');
    }
}