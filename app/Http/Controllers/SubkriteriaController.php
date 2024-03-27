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
        try{
        Subkriteria::find($id)->delete();
        return redirect()->route('sub-kriteria.index')->with('success', 'Berhasil Menghapus Data.');
        } catch (QueryException $e) {
            // Periksa apakah pengecualian disebabkan oleh foreign key constraint
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Jika kode error adalah 1451 (foreign key constraint), berikan pesan kesalahan khusus
                return redirect()->route('sub-kriteria.index')->with('error', 'Data tidak dapat dihapus karena terkait dengan data lain.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }
    }
}
