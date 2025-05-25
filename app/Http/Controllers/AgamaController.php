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

    public function create()
    {
        return view('agama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kode_agama' => 'required|string|unique:agamas,kode_agama',
        ]);

        Agama::create($request->all());

        return redirect()->route('agama.index')->with('success', 'Data agama berhasil ditambahkan.');
    }
}
