<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use app\Models\Folder;
use App\Models\Berkas;
use App\Models\Mahasiswa;

use Illuminate\Http\Request;

class FolderArsipController extends Controller
{
    public function index($nama){

        $arsip = Arsip::where('id_folder', $nama)->get();

        // Periksa apakah data arsip ada
        $dataExists = $arsip->isNotEmpty();

        // Teruskan data ke tampilan
        return view('arsip.folder', compact('arsip', 'dataExists'));
    }
    public function edit(Request $request, $id){
        $item = Arsip::all();
        return view('arsip.detail', compact('item'));
    }
    public function arsip(Request $request)
    {

        $berkas = Berkas::findOrFail($request->id);

        // Simpan data arsip ke dalam database
        Arsip::create([
            'id_folder' => $request->id_folder,
            'no_pendaftaran' => $request->no_pendaftaran,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_prodi' => $request->nama_prodi,
            'jenjang' => $request->jenjang,
            'nama_jurusan' => $request->nama_jurusan,
            'nama_golongan' => $request->nama_golongan,
            'nominal' => $request->nominal,
            'tahun_angkatan' => $request->tahun_angkatan,
            /*'foto_slip_gaji' => $request->foto_slip_gaji,
            'foto_tempat_tinggal' => $request->foto_tempat_tinggal,
            'foto_kendaraan' => $request->nominal->foto_kendaraan,
            'foto_daya_listrik' => $request->nominal->foto_daya_listrik,*/

        ]);
        /* $mahasiswa = Mahasiswa::find($berkas->mahasiswa_id);
        $mahasiswa->delete(); */
        $berkas->delete();

        return redirect()->route('admin.data-lengkap')->with('success', 'Data berhasil diarsipkan');
    }

}
