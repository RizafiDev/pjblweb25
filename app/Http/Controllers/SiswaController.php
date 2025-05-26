<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Agama;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['jurusan', 'agama'])->get();
        $jurusans = Jurusan::all();
        $agamas = Agama::all();
        
        return view('siswa.index', compact('siswas', 'jurusans', 'agamas'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $siswas = Siswa::with(['jurusan', 'agama'])
            ->when($query, function ($q) use ($query) {
                return $q->where('nama', 'LIKE', "%{$query}%")
                        ->orWhere('nis', 'LIKE', "%{$query}%")
                        ->orWhere('nisn', 'LIKE', "%{$query}%")
                        ->orWhere('kelas', 'LIKE', "%{$query}%")
                        ->orWhereHas('jurusan', function($q) use ($query) {
                            $q->where('nama_jurusan', 'LIKE', "%{$query}%");
                        })
                        ->orWhereHas('agama', function($q) use ($query) {
                            $q->where('nama_agama', 'LIKE', "%{$query}%");
                        });
            })
            ->get();

        // Jika request AJAX, return partial view
        if ($request->ajax() || $request->has('ajax')) {
            $jurusans = Jurusan::all();
            $agamas = Agama::all();
            return view('siswa.partials.table_rows', compact('siswas', 'jurusans', 'agamas'))->render();
        }

        // Jika bukan AJAX, return full view
        $jurusans = Jurusan::all();
        $agamas = Agama::all();
        return view('siswa.index', compact('siswas', 'jurusans', 'agamas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas',
            'nisn' => 'required|unique:siswas', 
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan_id' => 'required|exists:jurusans,id',
            'agama_id' => 'required|exists:agamas,id',
            'alamat' => 'required',
            'no_telepon' => 'required',
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
            'nis' => 'required|unique:siswas,nis,' . $id,
            'nisn' => 'required|unique:siswas,nisn,' . $id,
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan_id' => 'required|exists:jurusans,id',
            'agama_id' => 'required|exists:agamas,id',
            'alamat' => 'required',
            'no_telepon' => 'required',
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