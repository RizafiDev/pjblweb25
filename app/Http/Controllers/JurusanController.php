<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('jurusan.index', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusans',
        ]);

        Jurusan::create($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama_jurusan,'.$id,
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil dihapus.');
    }
}