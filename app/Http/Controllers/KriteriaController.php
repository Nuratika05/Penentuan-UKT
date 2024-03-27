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
        try{
        Kriteria::find($id)->delete();
        return redirect()->route('kriteria.index')->with('success', 'Berhasil Menghapus Data.');

        } catch (QueryException $e) {
            // Periksa apakah pengecualian disebabkan oleh foreign key constraint
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Jika kode error adalah 1451 (foreign key constraint), berikan pesan kesalahan khusus
                return redirect()->route('kriteria.index')->with('error', 'Data tidak dapat dihapus karena terkait dengan data lain.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }
    }

    public function getSubKriteria($id)
    {
        $subkriteria = Subkriteria::where('kriteria_id', $id)->get();
        return response()->json($subkriteria);
    }
}
