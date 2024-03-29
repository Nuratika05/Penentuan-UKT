<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\MahasiswaTemps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\MahasiswaImport;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{

    public function index()
    {
        $mahasiswa = Mahasiswa::all();
      //  dd($mahasiswas);
        return view ('mahasiswa.index', compact ('mahasiswa'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view ('mahasiswa.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Mahasiswa::rules());
        $request->validate(Mahasiswa::rules(), Mahasiswa::$messages);

        try {
      //      dd($request->id);
      //dd($request->all());
        Mahasiswa::create([

            'id' => $request->id,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'prodi_id' => $request->prodi_id,
            'password' => Hash::make($request->password),

        ]);

        return redirect()->route('mahasiswa.create')->with('success', 'Berhasil Menambahkan Data.');
        } catch (QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            // Kode 1062 adalah kode untuk kesalahan unik (duplicate key)
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal Menambahkan Data. Nomor Pendaftaran Sudah Ada.')->withErrors($validator)->withInput();
        }elseif ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {
            // Tangani jenis kesalahan lain jika diperlukan
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal Menambahkan Data. Terjadi Kesalahan.')->withErrors($validator)->withInput();
        }

        }
    }


    public function edit(mahasiswa $mahasiswa)
    {
        $mahasiswa->find($mahasiswa);
        $prodis = Prodi::all();
        return view ('mahasiswa.edit', compact ('mahasiswa','prodis'));
    }

    public function update(Request $request, mahasiswa $mahasiswa)
    {
        $validator = Validator::make($request->all(), Mahasiswa::rules($mahasiswa->id));
        $request->validate(Mahasiswa::rules($mahasiswa->id), Mahasiswa::$messages);
        if ($validator->fails()) {
            // Handle kegagalan validasi di sini
        }

        try {
        if ($request->password == '') {
        $mahasiswa->update([
            'id' => $request->id,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'prodi_id' => $request->prodi_id,

        ]);

        }else{

        $mahasiswa->update([
            'id' => $request->id,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'prodi_id' => $request->prodi_id,
            'password' => Hash::make($request->password),
        ]);

    }
        return redirect()->route('mahasiswa.index')->with('success', 'Berhasil Mengubah Data.');
    }catch (QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            // Kode 1062 adalah kode untuk kesalahan unik (duplicate key)
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal Mengubah Data. Nomor Pendaftaran Sudah Ada.');
        } else {
            // Tangani jenis kesalahan lain jika diperlukan
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal Mengubah Data. Terjadi Kesalahan.');
        }
    }
    }

    public function destroy(mahasiswa $mahasiswa)
    {
        try {
            $mahasiswa->delete();
            return redirect()->route('mahasiswa.index')->with('success', 'Berhasil Menghapus Data.');
        } catch (QueryException $e) {
            // Periksa apakah pengecualian disebabkan oleh foreign key constraint
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Jika kode error adalah 1451 (foreign key constraint), berikan pesan kesalahan khusus
                return redirect()->route('mahasiswa.index')->with('error', 'Data tidak dapat dihapus karena terkait dengan data lain.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }

    }

    public function mahasiswaexport(){
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

   public function mahasiswaimport()
   {
            $mhs_temps = MahasiswaTemps::all();
            return view('mahasiswa.import_mhs', ['mhs_temps' => $mhs_temps]);
    }
    /**
     * import_mhs
     *
     * @param  mixed $request
     * @return void
     */
   public function mahasiswaupload(Request $request): ?\Illuminate\Http\RedirectResponse
    {
        try {
                $file = $request->file('excel_upload');
                $upload_code = uniqid();
                session(['upload_code' => $upload_code]);
                Excel::import(new MahasiswaImport($upload_code), $file, 'Xlsx');
                $excel = MahasiswaTemps::where('upload_code', '=', $upload_code)->get()->toArray();
                foreach ($excel as $d) {
                    $mhs_temps = MahasiswaTemps::find($d['code_temps']);
                    $check = "True";
                    $error_location = array();
                    //A

                    $duplicateDataMahasiswaTemps = MahasiswaTemps::where('id_temps', '=', $d['id_temps'])
                    ->where('upload_code', '!=', $upload_code)
                    ->first();
                    if ($duplicateDataMahasiswaTemps != null) {
                        $check = "False";
                        array_push($error_location, "DUPLICATE DATA ");
                    }
                    $duplicateDataMahasiswa = Mahasiswa::where('id', '=', $d['id_temps'])->first();
                    if ($duplicateDataMahasiswa != null) {
                        $check = "False";
                        array_push($error_location, "NO PENDAFTARAN SUDAH DIGUNAKAN " );
                    }
                    if ($d['id_temps'] == null) {
                        $check = "False";
                        array_push($error_location, "NO PENDAFTARAN TIDAK BOLEH KOSONG ");
                    }

                    //B
                    if ($d['nama_temps'] == null) {
                        $check = "False";
                        array_push($error_location, "NAMA TIDAK BOLEH KOSONG ");
                    }

                    //C
                    if (!in_array($d['jenis_kelamin_temps'], ['Laki-laki', 'Perempuan'])) {
                        $check = "False";
                        array_push($error_location, "JENIS KELAMIN TIDAK VALID " );
                    }

                    //D
                    if (!is_numeric($d['no_telepon_temps'])) {
                        $check = "False";
                        array_push($error_location, "NO TELEPON HARUS ANGKA ");
                    }

                    //E
                    if ($d['alamat_temps'] == null) {
                        $check = "False";
                        array_push($error_location, "ALAMAT TIDAK BOLEH KOSONG " );
                    }

                    //F
                    $prodi = Prodi::where('nama', '=', $d['prodi_id_temps'])->first();
                    if ($prodi != null) {
                        $check = "False";
                        array_push($error_location, "PRODI TIDAK VALID ");
                    }

                    //G
                    if (preg_match('/^[0-9]{8}$/', $d['password_temps']) == false) {
                        $check = "False";
                        array_push($error_location, "PASSWORD HARUS TERDIRI DARI 8 ANGKA ");
                    }



                    $mhs_temps->eror_location = $error_location ?? [];
                    $mhs_temps->check = $check;
                    $mhs_temps->save();
                }

            return redirect()->route('mahasiswaimport')->with('success', 'Data Excel Berhasil di Upload!');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return redirect()->route('mahasiswaimport')->with('error', 'Data Excel Gagal di Upload, Pastikan Tabel Excel Benar dan Tidak Ada Data Yang Kosong');
        }
    }

    public function importsave(Request $request)
    {
            try
            {
                $mhs_temps = MahasiswaTemps::where('check', 'True')->get();
                $successCount = 0;
                foreach ($mhs_temps as $bt) {
                    Mahasiswa::insert([
                        'id' => $bt->id_temps,
                        'nama' => $bt->nama_temps,
                        'jenis_kelamin' => $bt->jenis_kelamin_temps,
                        'no_telepon' => $bt->no_telepon_temps,
                        'alamat' => $bt->alamat_temps,
                        'prodi_id' => $bt->prodi_id_temps,
                        'password' => Hash::make($request->password_temps),
                        'created_at' => now(),
                    ]);
                    $successCount++;
                }

                MahasiswaTemps::where('check', 'True')->delete();

                $successMessage = $successCount > 0 ? "Berhasil Mengirim $successCount Data ke Data Mahasiswa!" : "Tidak ada data yang dikirim.";
                return redirect()->route('mahasiswaimport')->with('success', $successMessage);

            }catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    // Kode 1062 adalah kode untuk kesalahan unik (duplicate key)
                    return redirect()->route('mahasiswaimport')->with('error', 'Gagal Megirim Data. Nomor Pendaftaran Sudah Ada di Data Mahasiswa.')->withInput();
                } else {
                    // Tangani jenis kesalahan lain jika diperlukan
                    return redirect()->route('mahasiswaimport')->with('error', 'Gagal Mengirim Data. Terjadi Kesalahan.')->withInput();
                }
            }

    }

     public function importbatal(Request $request)
    {
            try {
                MahasiswaTemps::truncate();

                return redirect()->route('mahasiswaimport')->with('Success', 'Berhasil Menghapus Data');

            } catch (\Throwable $th) {
                return redirect()->route('mahasiswaimport')->with('Error', 'Gagal Menghapus Data')->withInput();
            }
    }
}

