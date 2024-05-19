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
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FolderArsipController extends Controller
{
    public function index($id){
        $folder = Folder::findOrFail($id);

        if(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin'){

        $arsip = Arsip::where('id_folder', $id)->get();
        }

        elseif(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
            $verifikatorJurusanId = Auth::guard('admin')->user()->jurusan_id;
            $namaJurusan = Jurusan::where('id', $verifikatorJurusanId)->value('nama');
            $arsip = Arsip::where('id_folder', $id)
                ->where('nama_jurusan', $namaJurusan)
                ->get();
        }
        $dataExists = $arsip->isNotEmpty();
        return view('folderarsip.folder', compact('arsip', 'folder', 'dataExists'));
    }
    public function arsip(Request $request)
    {
        $dataIds = json_decode($request->ids, true);
        if (!is_array($dataIds)) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan dalam pemrosesan data.']);
        }

        $jumlahDataDiarsipkan = 0;

        DB::beginTransaction();

        try {
            foreach ($dataIds as $dataId) {
            $arsipBerkas = Berkas::where('id', $dataId)->get();

            if ($arsipBerkas->isEmpty()) {
                continue;
            }
            foreach ($arsipBerkas as $item) {

                $filePaths = [
                    'foto_tempat_tinggal' => 'foto_tempat_tinggal',
                    'foto_daya_listrik' => 'foto_daya_listrik',
                    'foto_slip_gaji' => 'foto_slip_gaji',
                    'foto_kendaraan' => 'foto_kendaraan',
                    'foto_beasiswa' => 'foto_beasiswa'
                ];

                foreach ($filePaths as $field => $dir) {
                    if ($item->$field) {
                        $sourcePath = public_path($dir . '/' . $item->$field);
                        $destinationPath = public_path('fotoarsip/' . $dir . '/' . $item->$field);

                        if (File::exists($sourcePath)) {
                            File::move($sourcePath, $destinationPath);
                        }
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
                    'admin' => $item->admin->nama,
                    'foto_slip_gaji' => $item->foto_slip_gaji,
                    'foto_tempat_tinggal' => $item->foto_tempat_tinggal,
                    'foto_kendaraan' => $item->foto_kendaraan,
                    'foto_daya_listrik' => $item->foto_daya_listrik,
                    'foto_beasiswa' => $item->foto_beasiswa,

                ]);

                $penilaians = Penilaian::where('mahasiswa_id', $item->mahasiswa_id)->get();
                foreach ($penilaians as $penilaian) {
                    PenilaianArsip::create([
                        'no_pendaftaran' => $penilaian->mahasiswa->id,
                        'kriteria' => $penilaian->kriteria->nama,
                        'subkriteria' => $penilaian->subkriteria->nama,
                    ]);
                }

                $mahasiswaId = $item->mahasiswa->id;
                $item->delete();
                Penilaian::where('mahasiswa_id', $mahasiswaId)->delete();
                Mahasiswa::where('id', $mahasiswaId)->delete();
                $jumlahDataDiarsipkan++;
                }
            }

            if ($jumlahDataDiarsipkan > 0) {
                DB::commit(); // Commit transaksi jika semua langkah berhasil
                return response()->json(['success' => true, 'message' => $jumlahDataDiarsipkan . ' Data berhasil diarsipkan.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Tidak ada data yang diarsipkan.']);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    public function detail($id = null){
            $arsip = Arsip::find($id);
            $penilaianarsip = PenilaianArsip::where('no_pendaftaran', $arsip->no_pendaftaran)->get()->groupBy('no_pendaftaran');
            return view('folderarsip.detail', compact('arsip' , 'penilaianarsip'));

    }
    public function arsipexport($id)
    {
        $DataArsips = Arsip::where('id_folder', $id)->get();
        if ($DataArsips->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data yang diekspor.');
        }
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

    public function printarsip($id)
        {

            $admin = auth()->guard('admin')->user();
            if(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
                $verifikatorJurusanId = Auth::guard('admin')->user()->jurusan_id;
                $namaJurusan = Jurusan::where('id', $verifikatorJurusanId)->value('nama');
                $arsip = Arsip::where('id_folder', $id)
                    ->where('nama_jurusan', $namaJurusan)
                    ->get();
            }
            elseif(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin'){
                $arsip = Arsip::where('id_folder', $id)->get();
            }
            if ($arsip->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data yang tersedia untuk diprint.');
            }
                $pdf = PDF::loadView('folderarsip.printarsip', compact('arsip'));
                $pdf->setBasePath('public_path');
                $pdf->setPaper('F4', 'portrait');
                return $pdf->stream("UKT_Mahasiswa.pdf");
        }

        public function HapusArsip(Request $request)
        {
            $ids = $request->ids;
            $jumlahData = 0;
            $noPendaftarans = Arsip::whereIn('id', $ids)->pluck('no_pendaftaran')->toArray();

            DB::beginTransaction();
            try {
                // Hapus berkas
                $deletedArsip = Arsip::whereIn('id', $ids)->delete();

                if ($deletedArsip) {
                    // Hapus penilaian terkait dengan mahasiswa_id
                    $deletedPenilaianArsip = PenilaianArsip::whereIn('no_pendaftaran', $noPendaftarans)->delete();
                    $remainingPenilaianCount = PenilaianArsip::whereIn('no_pendaftaran', $noPendaftarans)->count();

                    // Pastikan semua penilaian terkait juga terhapus
                    if ($remainingPenilaianCount == 0) {
                        // Komit transaksi jika berhasil
                        DB::commit();
                        $jumlahData = $deletedArsip;
                        return response()->json(['success' => true, 'message' => $jumlahData . ' Data Berhasil Dihapus.']);
                    } else {
                        // Jika penilaian tidak terhapus, rollback transaksi
                        DB::rollBack();
                        return response()->json(['success' => false, 'message' => 'Gagal Menghapus Data Penilaian.']);
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => 'Gagal Menghapus Data.']);
                }
            } catch (\Exception $e) {
                // Rollback transaksi jika ada kesalahan
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
        }

}
