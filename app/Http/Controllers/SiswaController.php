<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Agama;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with(['jurusan', 'agama'])->orderBy('id', 'asc');
        
        // Search functionality
        if ($request->filled('query')) {
            $search = $request->input('query');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nis', 'LIKE', "%{$search}%")
                  ->orWhere('nisn', 'LIKE', "%{$search}%")
                  ->orWhere('kelas', 'LIKE', "%{$search}%")
                  ->orWhereHas('jurusan', function($q) use ($search) {
                      $q->where('nama_jurusan', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('agama', function($q) use ($search) {
                      $q->where('nama_agama', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Apply filters
        if ($request->filled('kelas_filter')) {
            $query->where('kelas', $request->kelas_filter);
        }
        
        if ($request->filled('jurusan_filter')) {
            $query->where('jurusan_id', $request->jurusan_filter);
        }
        
        if ($request->filled('agama_filter')) {
            $query->where('agama_id', $request->agama_filter);
        }
        
        if ($request->filled('gender_filter')) {
            $query->where('jenis_kelamin', $request->gender_filter);
        }
        
        // Handle pagination
        $perPage = $request->get('per_page', 10);
        if ($perPage === 'all') {
            $siswas = $query->get();
            $isAll = true;
        } else {
            $siswas = $query->paginate((int)$perPage)->appends($request->query());
            $isAll = false;
        }
        
        $jurusans = Jurusan::all();
        $agamas = Agama::all();
        
        // Return JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'table' => view('siswa.partials.table', compact('siswas'))->render(),
                'pagination' => $isAll ? '' : view('siswa.partials.pagination', compact('siswas'))->render(),
                'count' => $isAll ? count($siswas) : $siswas->total()
            ]);
        }
        
        return view('siswa.index', compact('siswas', 'jurusans', 'agamas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas|max:20',
            'nisn' => 'required|unique:siswas|max:20',
            'nama' => 'required|max:100',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan_id' => 'required|exists:jurusans,id',
            'agama_id' => 'required|exists:agamas,id',
            'alamat' => 'required',
            'no_telepon' => 'required|max:20',
            'jenis_kelamin' => 'required|in:l,p',
            'tanggal_lahir' => 'required|date'
        ]);

        Siswa::create($request->all());

        return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        $request->validate([
            'nis' => 'required|unique:siswas,nis,'.$id.'|max:20',
            'nisn' => 'required|unique:siswas,nisn,'.$id.'|max:20',
            'nama' => 'required|max:100',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan_id' => 'required|exists:jurusans,id',
            'agama_id' => 'required|exists:agamas,id',
            'alamat' => 'required',
            'no_telepon' => 'required|max:20',
            'jenis_kelamin' => 'required|in:l,p',
            'tanggal_lahir' => 'required|date'
        ]);

        $siswa->update($request->all());

        return redirect()->back()->with('success', 'Data siswa berhasil diupdate');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->back()->with('success', 'Data siswa berhasil dihapus');
    }
}