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
        $dataIds = $request->ids;
        $jumlahDataDiarsipkan = 0;

        foreach ($dataIds as $dataId) {
        $item = Berkas::whereIn('id', $dataId);

        if ($item->foto_tempat_tinggal) {
            $pathAsaltempattinggal = public_path('foto_tempat_tinggal/' . $item->foto_tempat_tinggal);
            $namaFiletempattinggal = pathinfo($pathAsaltempattinggal, PATHINFO_BASENAME);
            $pathTujuantempattinggal = public_path('fotoarsip/foto_tempat_tinggal/' . $namaFiletempattinggal);

            if (File::exists($pathAsaltempattinggal)) {
                File::move($pathAsaltempattinggal, $pathTujuantempattinggal);
            }
        }
        if ($item->foto_daya_listrik) {
            $pathAsaldayalistrik = public_path('foto_daya_listrik/' . $item->foto_daya_listrik);
            $namaFiledayalistrik = pathinfo($pathAsaldayalistrik, PATHINFO_BASENAME);
            $pathTujuandayalistrik = public_path('fotoarsip/foto_daya_listrik/' . $namaFiledayalistrik);

            if (File::exists($pathAsaldayalistrik)) {
                File::move($pathAsaldayalistrik, $pathTujuandayalistrik);
            }
        }
        if ($item->foto_slip_gaji) {
            $pathAsalSlipGaji = public_path('foto_slip_gaji/' . $item->foto_slip_gaji);
            $namaFileSlipGaji = pathinfo($pathAsalSlipGaji, PATHINFO_BASENAME);
            $pathTujuanSlipGaji = public_path('fotoarsip/foto_slip_gaji/' . $namaFileSlipGaji);

            if (File::exists($pathAsalSlipGaji)) {
                File::move($pathAsalSlipGaji, $pathTujuanSlipGaji);
            }
        }

        if ($item->foto_kendaraan) {
            $pathAsalkendaraan = public_path('foto_kendaraan/' . $item->foto_kendaraan);
            $namaFilekendaraan = pathinfo($pathAsalkendaraan, PATHINFO_BASENAME);
            $pathTujuankendaraan = public_path('fotoarsip/foto_kendaraan/' . $namaFilekendaraan);

            if (File::exists($pathAsalkendaraan)) {
                File::move($pathAsalkendaraan, $pathTujuankendaraan);
            }
        }
        if ($item->foto_beasiswa) {
            $pathAsalbeasiswa = public_path('foto_beasiswa/' . $item->foto_beasiswa);
            $namaFilebeasiswa = pathinfo($pathAsalbeasiswa, PATHINFO_BASENAME);
            $pathTujuanbeasiswa = public_path('fotoarsip/foto_beasiswa/' . $namaFilebeasiswa);

            if (File::exists($pathAsalbeasiswa)) {
                File::move($pathAsalbeasiswa, $pathTujuanbeasiswa);
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

        if ($jumlahDataDiarsipkan > 0) {
            return redirect()->back()->with('success', 'Berhasil mengarsipkan ' . $jumlahDataDiarsipkan . ' data.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang diarsipkan.');
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
