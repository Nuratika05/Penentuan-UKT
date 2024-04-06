<?php

namespace App\Http\Controllers;

use App\Models\KelompokUKT;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class KelompokUKTController extends Controller
{
    public function index(){
        $kelompokUKT = KelompokUKT::all();


        return view('kelompokUKT.index', compact('kelompokUKT'));
    }
    public function create(){
        $prodi = Prodi::all();
        return view('kelompokUKT.create', compact('prodi'));
    }
    public function store(Request $request){

        KelompokUKT::create([
            'prodi_id' => $request->prodi_id,
            'kategori1' => $request->kategori1,
            'kategori2' => $request->kategori2,
            'kategori3' => $request->kategori3,
            'kategori4' => $request->kategori4,
            'kategori5' => $request->kategori5,
            'kategori6' => $request->kategori6,
            'kategori7' => $request->kategori7,
        ]);

        return redirect()->route('kelompokUKT.create')->with('success', 'Berhasil Menambahkan Data.');
    }
    public function edit(KelompokUKT $kelompokUKT){
        $kelompokUKT->find($kelompokUKT);
        $prodi = Prodi::all();
        return view('kelompokUKT.edit', compact('kelompokUKT','prodi'));
    }
    public function update(Request $request, KelompokUKT $kelompokUKT){
        $kelompokUKT->update([
            'prodi_id' => $request->prodi_id,
            'kategori1' => $request->kategori1,
            'kategori2' => $request->kategori2,
            'kategori3' => $request->kategori3,
            'kategori4' => $request->kategori4,
            'kategori5' => $request->kategori5,
            'kategori6' => $request->kategori6,
            'kategori7' => $request->kategori7,
        ]);
        return redirect()->route('kelompokUKT.index')->with('success', 'Berhasil Mengubah Data.');
    }
    public function destroy(KelompokUKT $kelompokUKT){
        try {
            $kelompokUKT->delete();
            return redirect()->route('kelompokUKT.index')->with('success', 'Berhasil Menghapus Data.');
        } catch (QueryException $e) {
            // Periksa apakah pengecualian disebabkan oleh foreign key constraint
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Jika kode error adalah 1451 (foreign key constraint), berikan pesan kesalahan khusus
                return redirect()->route('kelompokUKT.index')->with('error', 'Data tidak dapat dihapus karena terkait dengan data lain.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }

    }
}
