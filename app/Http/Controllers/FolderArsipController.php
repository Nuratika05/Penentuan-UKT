<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Berkas;
use App\Exports\ArsipExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PenilaianArsip;
use App\Models\Penilaian;
use App\Models\Mahasiswa;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

use Illuminate\Http\Request;

class FolderArsipController extends Controller
{
    public function index($id){
        $admin = auth()->guard('admin')->user();
        $folder = Folder::findOrFail($id);

        if(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin'){

        $arsip = Arsip::where('id_folder', $id)->get();
        // Periksa apakah data arsip ada
        }

        elseif(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
            $arsip = Arsip::where('id_folder', $id)
            ->where(function ($query) use ($admin) {
                $query->whereHas('admin', function ($q) use ($admin) {
                    $q->where('nama_jurusan', $admin->jurusan->nama);
                });
            })
            ->get();
        }
        $dataExists = $arsip->isNotEmpty();
        // Teruskan data ke tampilan
        return view('folderarsip.folder', compact('arsip', 'folder', 'dataExists'));
    }
    /*public function edit(Request $request, $id){
        $item = Arsip::all();
        return view('folderarsip.detail', compact('item'));
    }*/
    public function arsip(Request $request)
    {

        $berkas = Berkas::where('status', 'Lulus Verifikasi')->get();

        foreach ($berkas as $item) {
        $mahasiswaId = $item->mahasiswa_id;
        //foto_tempat_tinggal
        if ($item->foto_tempat_tinggal) {
            $pathAsaltempattinggal = public_path('foto_tempat_tinggal/' . $item->foto_tempat_tinggal);
            $namaFiletempattinggal = pathinfo($pathAsaltempattinggal, PATHINFO_BASENAME);
            $pathTujuantempattinggal = public_path('fotoarsip/foto_tempat_tinggal/' . $namaFiletempattinggal);

            // Memeriksa apakah file foto_slip_gaji ada sebelum mencoba memindahkannya
            if (File::exists($pathAsaltempattinggal)) {
                File::move($pathAsaltempattinggal, $pathTujuantempattinggal);
            }
        }
        //foto_daya_listrik
        if ($item->foto_daya_listrik) {
            $pathAsaldayalistrik = public_path('foto_daya_listrik/' . $item->foto_daya_listrik);
            $namaFiledayalistrik = pathinfo($pathAsaldayalistrik, PATHINFO_BASENAME);
            $pathTujuandayalistrik = public_path('fotoarsip/foto_daya_listrik/' . $namaFiledayalistrik);

            // Memeriksa apakah file foto_slip_gaji ada sebelum mencoba memindahkannya
            if (File::exists($pathAsaldayalistrik)) {
                File::move($pathAsaldayalistrik, $pathTujuandayalistrik);
            }
        }
        //foto_slip_gaji
        if ($item->foto_slip_gaji) {
            $pathAsalSlipGaji = public_path('foto_slip_gaji/' . $item->foto_slip_gaji);
            $namaFileSlipGaji = pathinfo($pathAsalSlipGaji, PATHINFO_BASENAME);
            $pathTujuanSlipGaji = public_path('fotoarsip/foto_slip_gaji/' . $namaFileSlipGaji);

            // Memeriksa apakah file foto_slip_gaji ada sebelum mencoba memindahkannya
            if (File::exists($pathAsalSlipGaji)) {
                File::move($pathAsalSlipGaji, $pathTujuanSlipGaji);
            }
        }

        // Memeriksa apakah file kendaraan ada
        if ($item->foto_kendaraan) {
            $pathAsalkendaraan = public_path('foto_kendaraan/' . $item->foto_kendaraan);
            $namaFilekendaraan = pathinfo($pathAsalkendaraan, PATHINFO_BASENAME);
            $pathTujuankendaraan = public_path('fotoarsip/foto_kendaraan/' . $namaFilekendaraan);

            // Memeriksa apakah file foto_slip_gaji ada sebelum mencoba memindahkannya
            if (File::exists($pathAsalkendaraan)) {
                File::move($pathAsalkendaraan, $pathTujuankendaraan);
            }
        }

        Arsip::create([
            'id_folder' => $request->id_folder,
            'no_pendaftaran' => $item->mahasiswa->id,
            'nama_mahasiswa' => $item->mahasiswa->nama,
            'no_telepon' => $item->mahasiswa->no_telepon,
            'alamat' => $item->mahasiswa->alamat,
            'jenis_kelamin' => $item->mahasiswa->jenis_kelamin,
            'nama_prodi' => $item->mahasiswa->prodi->nama,
            'jenjang' => $item->mahasiswa->prodi->jenjang,
            'nama_jurusan' => $item->mahasiswa->prodi->jurusan->nama,
            'nama_golongan' => $item->golongan->nama,
            'nominal' => $item->nominal_ukt,
            'tahun_angkatan' => $request->tahun_angkatan,
            'jalur' => $item->mahasiswa->jalur,
            'admin_id' => $item->admin_id,
            'foto_slip_gaji' => $item->foto_slip_gaji,
            'foto_tempat_tinggal' => $item->foto_tempat_tinggal,
            'foto_kendaraan' => $item->foto_kendaraan,
            'foto_daya_listrik' => $item->foto_daya_listrik,

        ]);

        $penilaians = Penilaian::where('mahasiswa_id', $mahasiswaId)->get();
        foreach ($penilaians as $penilaian) {
        PenilaianArsip::create([
            'no_pendaftaran' => $penilaian->mahasiswa->id,
            'kriteria' => $penilaian->kriteria->nama,
            'subkriteria' => $penilaian->subkriteria->nama,
        ]);
        }

        $item->delete();
        $idsToDelete = $berkas->pluck('mahasiswa_id');
        Penilaian::whereIn('mahasiswa_id', $idsToDelete)->delete();
        Mahasiswa::whereIn('id', $idsToDelete)->delete();
    }
        return redirect()->back()->with('success', 'Semua Data berhasil diarsipkan');
    }
    public function detail($id = null){
            $arsip = Arsip::find($id);
            $penilaianarsip = PenilaianArsip::where('no_pendaftaran', $arsip->no_pendaftaran)->get()->groupBy('no_pendaftaran');
            return view('folderarsip.detail', compact('arsip' , 'penilaianarsip'));

    }
    public function arsipexport($id)
    {

        // Ekspor data menggunakan Laravel Excel
        return Excel::download(new ArsipExport($id), 'UKT Mahasiswa.xlsx');
    }

    public function print($id = null){
        $arsip = Arsip::find($id);
        $penilaianarsip = PenilaianArsip::where('no_pendaftaran', $arsip->no_pendaftaran)->get()->groupBy('no_pendaftaran');
        $pdf = PDF::loadView('folderarsip.print', compact('arsip', 'penilaianarsip'));
        $pdf->setBasePath('public_path');
        $pdf->setPaper('F4', 'portrait');
        return $pdf->stream("UKT_Mahasiswa.pdf");
    }
}
