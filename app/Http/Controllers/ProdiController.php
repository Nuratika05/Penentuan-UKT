<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProdiController extends Controller
{

    public function index()
    {
        $prodis = Prodi::all();
        return view ('prodi.index', compact ('prodis'));
    }


    public function create()
    {
        $jurusans = Jurusan::all();
        return view ('prodi.create', compact('jurusans'));
    }


    public function store(Request $request)
    {
        Prodi::create([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
            'jenjang' => $request->jenjang
        ]);

        return redirect()->route('prodi.create')->with('success', 'Berhasil Menambahkan Data.');
    }

    public function edit(prodi $prodi)
    {
        $prodi->find($prodi);
        $jurusans = Jurusan::all();
        return view ('prodi.edit', compact ('prodi', 'jurusans'));
    }

    public function update(Request $request, prodi $prodi)
    {
        $prodi->update([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
            'jenjang' => $request->jenjang
        ]);
        return redirect()->route('prodi.index')->with('success', 'Berhasil Mengubah Data.');
    }

    public function destroy(prodi $prodi)
    {


        try {
            $prodi->delete();
            return redirect()->route('prodi.index')->with('success', 'Berhasil Menghapus Data.');
        } catch (QueryException $e) {
            // Periksa apakah pengecualian disebabkan oleh foreign key constraint
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Jika kode error adalah 1451 (foreign key constraint), berikan pesan kesalahan khusus
                return redirect()->route('prodi.index')->with('error', 'Data tidak dapat dihapus karena terkait dengan data lain.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }
    }
}
