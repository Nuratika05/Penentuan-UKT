<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SubkriteriaController extends Controller
{
    public function index()
    {
        $subkriterias = Subkriteria::all();
        return view ('sub-kriteria.index', compact ('subkriterias'));
    }

    public function create()
    {
        $kriterias = Kriteria::all();
        return view ('sub-kriteria.create', compact ('kriterias'));
    }

    public function store(Request $request)
    {
        Subkriteria::create($request->all());
        return redirect()->route('sub-kriteria.create')->with('success', 'Berhasil Menambah Data.');
    }

    public function edit($id)
    {
        $subkriteria = Subkriteria::find($id);
        $kriterias = Kriteria::all();
        return view ('sub-kriteria.edit', compact ('kriterias', 'subkriteria'));
    }

    public function update(Request $request, $id)
    {
        Subkriteria::find($id)->update($request->all());
        return redirect()->route('sub-kriteria.index')->with('success', 'Berhasil Menguba Data.');
    }

    public function destroy($id)
    {
        Subkriteria::find($id)->delete();
        return redirect()->route('sub-kriteria.index')->with('success', 'Berhasil Menghapus Data.');
    }
}
