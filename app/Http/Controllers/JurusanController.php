<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class JurusanController extends Controller
{

    public function index()
    {
        $jurusans = Jurusan::all();
        return view ('jurusan.index', compact ('jurusans'));
    }

    public function create()
    {
        return view ('jurusan.create');
    }

    public function store(Request $request)
    {
        Jurusan::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('jurusan.create')->with('success', 'Berhasil Menambahkan Data.');
    }

    public function edit(jurusan $jurusan)
    {
        $jurusan->find($jurusan);
        return view ('jurusan.edit', compact ('jurusan'));
    }


    public function update(Request $request, jurusan $jurusan)
    {
        $jurusan->update([
            'nama' => $request->nama
        ]);
        return redirect()->route('jurusan.index')->with('success', 'Berhasil Mengubah Data.');
    }

    public function destroy(jurusan $jurusan)
    {


        try {
            $jurusan->delete();
            return redirect()->route('jurusan.index')->with('success', 'Berhasil Menghapus Data.');
        } catch (QueryException $e) {
            // Periksa apakah pengecualian disebabkan oleh foreign key constraint
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Jika kode error adalah 1451 (foreign key constraint), berikan pesan kesalahan khusus
                return redirect()->route('jurusan.index')->with('error', 'Data tidak dapat dihapus karena terkait dengan data lain.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }

    }
}
