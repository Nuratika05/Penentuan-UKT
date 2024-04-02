<?php

namespace App\Http\Controllers;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class ArsipController extends Controller
{
    public function index(){
        $folder = Folder::All();
        return view('folderarsip.index' , compact('folder'));
    }
    public function create(){
        return view('folderarsip.create');
    }
    public function store(Request $request)
    {
        $message = [
            'nama.unique' => 'Nama folder sudah ada. Silakan gunakan nama yang berbeda.'
        ];
        $request->validate([
            'nama' => [
                'required',
                Rule::unique('folders')->ignore($request->id)
            ]
        ],$message);

        Folder::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('arsip.create')->with('success', 'Berhasil Membuat Folder.');
    }
    public function edit($id)
    {
        $folder = Folder::find($id);
        return view ('folderarsip.edit', compact ('folder'));
    }

    public function update(Request $request, $id)
    {
        $message = [
            'nama.unique' => 'Nama folder sudah ada. Silakan gunakan nama yang berbeda.'
        ];
        $request->validate([
            'nama' => [
                'required',
                Rule::unique('folders')->ignore($id)]
            ],$message);

        Folder::find($id)->update($request->all());
        return redirect()->route('arsip.index')->with('success', 'Berhasil Mengubah Folder.');
    }

    public function destroy($id)
    {
        try{

            Folder::find($id)->delete();
            return redirect()->route('arsip.index')->with('success', 'Berhasil Menghapus Folder.');
        }
        catch (QueryException $e) {
            // Periksa apakah pengecualian disebabkan oleh foreign key constraint
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Jika kode error adalah 1451 (foreign key constraint), berikan pesan kesalahan khusus
                return redirect()->route('arsip.index')->with('error', 'Folder tidak dapat dihapus karena sudah ada datanya.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }

    }

}
