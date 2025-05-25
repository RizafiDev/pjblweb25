<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['agama', 'jurusan'])->get();
        return view('siswa.index', compact('siswas'));
    }
    public function create()
    {
        $agamas = Agama::all();
        $jurusans = Jurusan::all();
        return view('siswa.create', compact('agamas', 'jurusans'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|unique:siswas,nis',
            'nisn' => 'required|unique:siswas,nisn',
            'kelas' => 'required|string|max:10',
            'jurusan_id' => 'required|exists:jurusans,id',
            'agama_id' => 'required|exists:agamas,id',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

}
