<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class KriteriaController extends Controller
{

    public function index()
    {
        $kriterias = Kriteria::all();
        return view ('kriteria.index', compact ('kriterias'));
    }

    public function create()
    {
        return view ('kriteria.create');
    }

    public function store(Request $request)
    {
        Kriteria::create($request->all());
        return redirect()->route('kriteria.create')->with('success', 'Berhasil Menambahkan Data.');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view ('kriteria.edit', compact ('kriteria'));
    }

    public function update(Request $request, $id)
    {
        Kriteria::find($id)->update($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Berhasil Mengubah Data.');
    }

    public function destroy($id)
    {
        Kriteria::find($id)->delete();
        return redirect()->route('kriteria.index')->with('success', 'Berhasil Menghapus Data.');
    }

    public function getSubKriteria($id)
    {
        $subkriteria = Subkriteria::where('kriteria_id', $id)->get();
        return response()->json($subkriteria);
    }
}
