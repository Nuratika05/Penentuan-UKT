<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class GolonganController extends Controller
{

    public function index()
    {
        $golongan = Golongan::all();
        return view('golongan.index', compact('golongan'));
    }


    public function create()
    {
        return view('golongan.create');
    }

    public function store(Request $request)
    {
        Golongan::create([
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'nilai_minimal' => $request->nilai_minimal,
            'nilai_maksimal' => $request->nilai_maksimal,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('golongan.create')->with('success', 'Berhasil Menambahkan Data.');
    }

    public function edit(golongan $golongan)
    {
        $golongan->find($golongan);
        return view ('golongan.edit', compact ('golongan'));
    }

    public function update(Request $request, golongan $golongan)
    {
        $golongan->update([
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'nilai_minimal' => $request->nilai_minimal,
            'nilai_maksimal' => $request->nilai_maksimal,
            'nominal' => $request->nominal,
        ]);
        return redirect()->route('golongan.index')->with('success', 'Berhasil Mengubah Data.');
    }

    public function destroy(golongan $golongan)
    {
        try {
            $golongan->delete();
            return redirect()->route('golongan.index')->with('success', 'Berhasil Menghapus Data.');
        } catch (QueryException $e) {
            // Periksa apakah pengecualian disebabkan oleh foreign key constraint
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Jika kode error adalah 1451 (foreign key constraint), berikan pesan kesalahan khusus
                return redirect()->route('golongan.index')->with('error', 'Data tidak dapat dihapus karena terkait dengan data lain.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }
    }
}
