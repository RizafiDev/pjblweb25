<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Agama;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalJurusan = Jurusan::count();
        $totalAgama = Agama::count();

        // Analytics: jumlah siswa per tahun dan jenis kelamin
        $siswaPerTahun = Siswa::select(
            DB::raw("YEAR(created_at) as tahun"),
            DB::raw("SUM(CASE WHEN jenis_kelamin = 'L' THEN 1 ELSE 0 END) as laki_laki"),
            DB::raw("SUM(CASE WHEN jenis_kelamin = 'P' THEN 1 ELSE 0 END) as perempuan")
        )
        ->groupBy(DB::raw("YEAR(created_at)"))
        ->orderBy('tahun')
        ->get();

        return view('dashboard', compact('totalSiswa', 'totalJurusan', 'totalAgama', 'siswaPerTahun'));
    }
}