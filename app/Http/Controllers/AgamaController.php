<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    public function index()
    {
        $agamas = Agama::all();
        return view('agama.index', compact('agamas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_agama' => 'required|string|max:255|unique:agamas',
        ]);

        Agama::create($request->all());

        return redirect()->route('agama.index')->with('success', 'Data agama berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_agama' => 'required|string|max:255|unique:agamas,nama_agama,'.$id,
        ]);

        $agama = Agama::findOrFail($id);
        $agama->update($request->all());

        return redirect()->route('agama.index')->with('success', 'Data agama berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $agama = Agama::findOrFail($id);
        $agama->delete();

        return redirect()->route('agama.index')->with('success', 'Data agama berhasil dihapus.');
    }
}