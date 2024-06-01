<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Golongan;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Prodi;
use App\Models\Folder;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DataUktExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\KelompokUKT;
use Illuminate\Support\Facades\Storage;



class DataUktController extends Controller
{
    public function index()
    {
        if(Auth::guard('mahasiswa')->check())
        {
            $mahasiswa = auth()->guard('mahasiswa')->user();
            $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
            $penilaians = Penilaian::get()->where('mahasiswa_id', $mahasiswa->id)->groupBy('mahasiswa_id');
            $kriteria = Kriteria::all();
            if($berkas == null){
                return redirect()->route('data-ukt.create');
            } else {
                return view('ukt.index', compact('berkas', 'penilaians', 'kriteria'));
            }
        }
        elseif(Auth::guard('admin')->check()){
            $admin = auth()->guard('admin')->user();

            if(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            {
                $berkas = Berkas::all();
            }
            elseif(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator')
            {
                $berkas = Berkas::with(['admin', 'mahasiswa.prodi'])
                ->where(function ($query) use ($admin) {
                    $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    })
                    ->orWhereHas('admin', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    });
                })
                ->get();
            }

                return view('ukt.index', compact('berkas'));
        }

    }

    public function verif(){
        if(Auth::guard('mahasiswa')->check())
        {
            $mahasiswa = auth()->guard('mahasiswa')->user();
            $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
            $penilaians = Penilaian::get()->where('mahasiswa_id', $mahasiswa->id)->groupBy('mahasiswa_id');
            $kriteria = Kriteria::all();
            if($berkas == null){
                return redirect()->route('data-ukt.create');
            } else {
                return view('ukt.index', compact('berkas', 'penilaians', 'kriteria'));
            }
        }
        elseif(Auth::guard('admin')->check())
        {
            $admin = auth()->guard('admin')->user();
            if(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin'){
                $berkas = Berkas::where('status', 'Menunggu Verifikasi')->get();
            }
            elseif(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
                $berkas = Berkas::with(['admin', 'mahasiswa.prodi'])
                ->where('status', 'Menunggu Verifikasi')
                ->where(function ($query) use ($admin) {
                    $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    })
                    ->orWhereHas('admin', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    });
                })
                ->get();
            }
            return view('ukt.index', compact('berkas'));
        }
    }
    public function LulusVerifikasi(){
        if(Auth::guard('mahasiswa')->check())
        {
            $mahasiswa = auth()->guard('mahasiswa')->user();
            $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
            $penilaians = Penilaian::get()->where('mahasiswa_id', $mahasiswa->id)->groupBy('mahasiswa_id');
            $kriteria = Kriteria::all();
            if($berkas == null){
                return redirect()->route('data-ukt.create');
            } else {
                return view('ukt.index', compact('berkas', 'penilaians', 'kriteria'));
            }
        }
        elseif(Auth::guard('admin')->check()){
            $admin = auth()->guard('admin')->user();
            $folder = Folder::all();
            if(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            {
                $berkas = Berkas::where('status', 'Lulus Verifikasi')->get();
                $dataExists = $berkas->isNotEmpty();

            }
            elseif(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
                $berkas = Berkas::with(['admin', 'mahasiswa.prodi'])
                ->where('status', 'Lulus Verifikasi')
                ->where(function ($query) use ($admin) {
                    $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    })
                    ->orWhereHas('admin', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    });
                })
                ->get();
            }
                $dataExists = $berkas->isNotEmpty();
                return view('ukt.indexlulus', compact('berkas', 'dataExists' , 'folder'));
        }
    }
    public function tidaklengkap(){
        if(Auth::guard('mahasiswa')->check())
        {
            $mahasiswa = auth()->guard('mahasiswa')->user();
            $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
            $penilaians = Penilaian::get()->where('mahasiswa_id', $mahasiswa->id)->groupBy('mahasiswa_id');
            $kriteria = Kriteria::all();
            if($berkas == null){
                return redirect()->route('data-ukt.create');
            } else {
                return view('ukt.index', compact('berkas', 'penilaians', 'kriteria'));
            }
        }
        elseif(Auth::guard('admin')->check()){
            $admin = auth()->guard('admin')->user();
            if(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            {
                $berkas = Berkas::where('status', 'Belum Lengkap')->get();
            }

            elseif(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
                $berkas = Berkas::with(['admin', 'mahasiswa.prodi'])
                ->where('status', 'Belum Lengkap')
                ->where(function ($query) use ($admin) {
                    $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    })
                    ->orWhereHas('admin', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    });
                })

                ->get();
            }
                return view('ukt.index', compact('berkas'));

        }
    }

    public function create()
    {
        $kriteria = Kriteria::all();
        $subkriteria = [];
        foreach ($kriteria as $item) {
            $subkriteria[$item->id] = Subkriteria::where('kriteria_id', $item->id)->get();
        }
        return view('ukt.create', compact('kriteria' , 'subkriteria'));
    }
    public function store(Request $request)
    {
        $message = [
            'foto_tempat_tinggal.required' => 'Foto Tempat Tinggal tidak boleh kosong',
            'foto_tempat_tinggal.image' => 'Foto Tempat Tinggal harus dalam format Gambar',
            'foto_tempat_tinggal.mimes' => 'Foto Tempat Tinggal format: JPG,JPEG,PNG',
            'foto_tempat_tinggal.max' => 'Foto Tempat Tinggal: Ukuran Maksimal 2 MB',
            'foto_slip_gaji.required' => 'Foto Slip Gaji tidak boleh kosong',
            'foto_slip_gaji.image' => 'Foto Slip Gaji harus dalam format gambar',
            'foto_slip_gaji.mimes' => 'Foto Slip Gaji format: JPG,JPEG,PNG',
            'foto_slip_gaji.max' => 'Foto Slip Gaji: Ukuran Maksimal 2 MB',
            'foto_daya_listrik.image' => 'Foto Daya Listrik harus dalam format gambar',
            'foto_daya_listrik.mimes' => 'Foto Daya Listrik format: JPG,JPEG,PNG',
            'foto_daya_listrik.required' => 'Foto Daya Listrik tidak boleh kosong',
            'foto_daya_listrik.max' => 'Foto Daya Listrik: Ukuran Maksimal 2 MB',
            'foto_kendaraan.required' => 'Foto Kendaraan tidak boleh kosong',
            'foto_kendaraan.image' => 'Foto Kendaraan harus dalam format gambar',
            'foto_kendaraan.mimes' => 'Foto Kendaraan format: JPG,JPEG,PNG',
            'foto_kendaraan.max' => 'Foto Kendaraan: Ukuran Maksimal 2 MB',
            'foto_beasiswa.required' => 'Foto Beasiswa tidak boleh kosong',
            'foto_beasiswa.image' => 'Foto Beasiswa harus dalam format gambar',
            'foto_beasiswa.mimes' => 'Foto Beasiswa format: JPG,JPEG,PNG',
            'foto_beasiswa.max' => 'Foto Beasiswa: Ukuran Maksimal 2 MB',
        ];

        $validatedData = $request->validate([

            'foto_tempat_tinggal' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_slip_gaji'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_daya_listrik'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kendaraan' => $request->has('foto_kendaraan') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable',
            'foto_beasiswa' => $request->has('foto_beasiswa') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable',
        ],$message);

        DB::beginTransaction();

        try
        {

            $mahasiswa = auth()->guard('mahasiswa')->user();
            $existingPenilaian = Penilaian::where('mahasiswa_id', $mahasiswa->id)->exists();

            if (!$existingPenilaian) {
                $dataPenilaian = [];
                foreach ($request->kriteria as $key => $value) {
                    $subkriteria = Subkriteria::findOrFail($value);

                    if ($subkriteria) {
                        $dataPenilaian[] = [
                            'mahasiswa_id' => $mahasiswa->id,
                            'kriteria_id' => $subkriteria->kriteria_id,
                            'subkriteria_id' => $subkriteria->id,
                        ];
                    }
                }
                // Masukkan data penilaian jika ada
                if (!empty($dataPenilaian)) {
                    Penilaian::insert($dataPenilaian);
                }
            }
        $nilai = Penilaian::where('mahasiswa_id', $mahasiswa->id)->get();
        $total = 0;
        foreach($nilai as $key => $value)
        {
            // jumlahkan nilai subkriteria
            $total += $value->subkriteria->nilai;
        }
        $prodi_id = $mahasiswa->prodi_id;
        $kelompokUkt = KelompokUKT::where('prodi_id', $prodi_id)->first();
        if ($kelompokUkt) {
            // Ambil golongan berdasarkan perhitungan
            $dataGolongan = Golongan::where('nilai_minimal', '<=', $total)
                ->where('nilai_maksimal', '>=', $total)
                ->first();

            // Pastikan data golongan ditemukan
            if ($dataGolongan) {
                // Ambil nama golongan
                $namaGolongan = $dataGolongan->nama;

                // Membuat pemetaan antara nama golongan dari tabel Golongan dengan nama kolom di tabel KelompokUKT
                $pemetaanKolom = [
                    'Kategori I' => 'kategori1',
                    'Kategori II' => 'kategori2',
                    'Kategori III' => 'kategori3',
                    'Kategori IV' => 'kategori4',
                    'Kategori V' => 'kategori5',
                    'Kategori VI' => 'kategori6',
                    'Kategori VII' => 'kategori7',
                ];

                if (array_key_exists($namaGolongan, $pemetaanKolom)) {
                    $namaKolom = $pemetaanKolom[$namaGolongan];
                    $nominalUkt = $kelompokUkt->$namaKolom;
                } else {
                }
            } else {
            }
        } else {
            $nominalUkt = null;
        }
        $tempFilePaths = [];

        if ($request->hasFile('foto_tempat_tinggal')) {
            $foto_tempat_tinggal = $request->file('foto_tempat_tinggal');
            $file_tempat_tinggal = date('YmdHis').'_'.$foto_tempat_tinggal->getClientOriginalName();
            $path = public_path('foto_tempat_tinggal');
            $foto_tempat_tinggal->move($path, $file_tempat_tinggal);
            $tempFilePaths['foto_tempat_tinggal'] = $file_tempat_tinggal;
        }


        if ($request->hasFile('foto_kendaraan')) {
            $foto_kendaraan = $request->file('foto_kendaraan');
            $file_kendaraan = date('YmdHis').'_'.$foto_kendaraan->getClientOriginalName();
            $path = public_path('foto_kendaraan');
            $foto_kendaraan->move($path, $file_kendaraan);
            $tempFilePaths['foto_kendaraan'] = $file_kendaraan;
        }
        else{
            $file_kendaraan = null;
        }

        if ($request->hasFile('foto_slip_gaji')) {
            $foto_slip_gaji = $request->file('foto_slip_gaji');
            $file_slip_gaji = date('YmdHis').'_'.$foto_slip_gaji->getClientOriginalName();
            $path = public_path('foto_slip_gaji');
            $foto_slip_gaji->move($path, $file_slip_gaji);
            $tempFilePaths['foto_slip_gaji'] = $file_slip_gaji;
        }

        if ($request->hasFile('foto_daya_listrik')) {
            $foto_daya_listrik = $request->file('foto_daya_listrik');
            $file_listrik = date('YmdHis').'_'.$foto_daya_listrik->getClientOriginalName();
            $path = public_path('foto_daya_listrik');
            $foto_daya_listrik->move($path, $file_listrik);
            $tempFilePaths['foto_daya_listrik'] = $file_listrik;
        }

        if ($request->hasFile('foto_beasiswa')) {
            $foto_beasiswa = $request->file('foto_beasiswa');
            $file_beasiswa = date('YmdHis').'_'.$foto_beasiswa->getClientOriginalName();
            $path = public_path('foto_beasiswa');
            $foto_beasiswa->move($path, $file_beasiswa);
            $tempFilePaths['foto_beasiswa'] = $file_beasiswa;
            }
            else{
                $file_beasiswa = null;
            }

        Berkas::create([
            'mahasiswa_id' => $mahasiswa->id,
            'foto_slip_gaji' => $tempFilePaths['foto_slip_gaji'] ?? null,
            'foto_tempat_tinggal' => $tempFilePaths['foto_tempat_tinggal'] ?? null,
            'foto_daya_listrik' => $tempFilePaths['foto_daya_listrik'] ?? null,
            'foto_kendaraan' => $tempFilePaths['foto_kendaraan'] ?? null,
            'foto_beasiswa' => $tempFilePaths['foto_beasiswa'] ?? null,
            'status' => 'Menunggu Verifikasi',
            'golongan_id' => $dataGolongan->id,
            'nominal_ukt' => $nominalUkt,
        ]);

        session()->put('temp_file_paths', $tempFilePaths);

        DB::commit();
            return redirect()->route('mahasiswa.data-ukt')->with('success', 'Data-UKT berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
}

    public function edit(Request $request, $id)
    {

        if(Auth::guard('mahasiswa')->check())
        {
            $mahasiswa = auth()->guard('mahasiswa')->user();

            $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
            $kriteria = Kriteria::all();
            $subkriteria = [];
            foreach ($kriteria as $item) {
                $subkriteria[$item->id] = Subkriteria::where('kriteria_id', $item->id)->get();
            }
            $penilaian = Penilaian::whereIn('kriteria_id', $kriteria->pluck('id'))
            ->where('mahasiswa_id', $mahasiswa->id)
            ->get()
            ->keyBy('kriteria_id');
            return view('ukt.edit', compact('berkas', 'kriteria' , 'subkriteria', 'penilaian'));
        }

        if(Auth::guard('admin')->check())
        {
            $berkas = Berkas::find($id);
            $mahasiswa = $berkas->mahasiswa;
            $prodi_id = $mahasiswa->prodi_id;

            $nilai = Penilaian::where('mahasiswa_id', $mahasiswa->id)->get();
            $total = 0;
            foreach($nilai as $key => $value)
            {
                // jumlahkan nilai subkriteria
                $total += $value->subkriteria->nilai;
            }

            $golongan = Golongan::all();
            $nominalUkts = [];

            if ($prodi_id) {
                $kelompokUkt = KelompokUKT::where('prodi_id', $prodi_id)->first();
                if ($kelompokUkt) {
                        $pemetaanKolom = [
                            'Kategori I' => 'kategori1',
                            'Kategori II' => 'kategori2',
                            'Kategori III' => 'kategori3',
                            'Kategori IV' => 'kategori4',
                            'Kategori V' => 'kategori5',
                            'Kategori VI' => 'kategori6',
                            'Kategori VII' => 'kategori7',
                        ];

                        foreach ($golongan as $gol) {
                            $namaGolongan = $gol->nama;
                            $namaKolom = $pemetaanKolom[$namaGolongan];
                            $nilaiKategori = $kelompokUkt->$namaKolom;
                            $nominalUkts[] = [
                                'golongan_id' => $namaGolongan,
                                'nominal_ukt' => $nilaiKategori,
                            ];
                        }
                }
            }
            $penilaians = Penilaian::get()->where('mahasiswa_id', $mahasiswa->id)->groupBy('mahasiswa_id');
            $prodis = Prodi::all();
            $kriteria = Kriteria::all();
            return view('ukt.edit', compact('berkas','nominalUkts', 'golongan', 'penilaians', 'kriteria', 'prodis', 'kelompokUkt', 'total'));
        }
    }
      public function update(Request $request, $id)
    {

        if(Auth::guard('mahasiswa')->check())
        {
            $messages = [
                'foto_tempat_tinggal.required' => 'Foto Tempat Tinggal tidak boleh kosong',
                'foto_tempat_tinggal.image' => 'Foto Tempat Tinggal harus dalam format Gambar',
                'foto_tempat_tinggal.mimes' => 'Foto Tempat Tinggal format: JPG,JPEG,PNG',
                'foto_tempat_tinggal.max' => 'Foto Tempat Tinggal: Ukuran Maksimal 2 MB',
                'foto_slip_gaji.required' => 'Foto Slip Gaji tidak boleh kosong',
                'foto_slip_gaji.image' => 'Foto Slip Gaji harus dalam format gambar',
                'foto_slip_gaji.mimes' => 'Foto Slip Gaji format: JPG,JPEG,PNG',
                'foto_slip_gaji.max' => 'Foto Slip Gaji: Ukuran Maksimal 2 MB',
                'foto_daya_listrik.image' => 'Foto Daya Listrik harus dalam format gambar',
                'foto_daya_listrik.mimes' => 'Foto Daya Listrik format: JPG,JPEG,PNG',
                'foto_daya_listrik.required' => 'Foto Daya Listrik tidak boleh kosong',
                'foto_daya_listrik.max' => 'Foto Daya Listrik: Ukuran Maksimal 2 MB',
                'foto_kendaraan.required' => 'Foto Kendaraan tidak boleh kosong',
                'foto_kendaraan.image' => 'Foto Kendaraan harus dalam format gambar',
                'foto_kendaraan.mimes' => 'Foto Kendaraan format: JPG,JPEG,PNG',
                'foto_kendaraan.max' => 'Foto Kendaraan: Ukuran Maksimal 2 MB',
                'foto_beasiswa.required' => 'Foto Beasiswa tidak boleh kosong',
                'foto_beasiswa.image' => 'Foto Beasiswa harus dalam format gambar',
                'foto_beasiswa.mimes' => 'Foto Beasiswa format: JPG,JPEG,PNG',
                'foto_beasiswa.max' => 'Foto Beasiswa: Ukuran Maksimal 2 MB',
            ];
            $request->validate([
                'foto_tempat_tinggal' => $request->has('foto_tempat_tinggal') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable',
                'foto_kendaraan'=> $request->has('foto_kendaraan') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable',
                'foto_beasiswa'=> $request->has('foto_beasiswa') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable',
                'foto_slip_gaji'=> $request->has('foto_slip_gaji') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable',
                'foto_daya_listrik'=>$request->has('foto_daya_listrik') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable',
            ],$messages);

            try
            {
            // dd($request->all());
            $mahasiswa = auth()->guard('mahasiswa')->user();
            $validatedData['mahasiswa']=auth()->user()->id;
            $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();

            $dataPenilaian = [];

            foreach ($request->kriteria as $key => $value)
            {
                $subkriteria = Subkriteria::where('id', $value)->first();
                    // Periksa jika kriteria adalah untuk foto kendaraan
                if ($key == 'Kendaraan' && $value == 'tidak ada kendaraan' || $value == '17' ) {
                    // Hapus foto kendaraan dari database dan filesystem jika ada
                    if (!is_null($berkas->foto_kendaraan)) {
                        $filePath = public_path('foto_kendaraan/' . $berkas->foto_kendaraan);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                        $berkas->foto_kendaraan = null; // Atur foto_kendaraan menjadi null di database
                    }
                }
                if ($key == 'Penerimaan Bantuan dari Pemerintah' && $value == 'Tidak Terima' || $value == '71') {
                    // Hapus foto kendaraan dari database dan filesystem jika ada
                    if (!is_null($berkas->foto_beasiswa)) {
                        $filePath = public_path('foto_beasiswa/' . $berkas->foto_beasiswa);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                        $berkas->foto_beasiswa = null; // Atur foto_beasiswa menjadi null di database
                    }
                }

                // Cek apakah data penilaian sudah ada untuk kriteria dan mahasiswa tertentu
                $existingPenilaian = Penilaian::where('mahasiswa_id', $mahasiswa->id)
                    ->where('kriteria_id', $subkriteria->kriteria_id)
                    ->first();

                if ($existingPenilaian)
                {
                    // Jika data sudah ada, lakukan pembaruan
                    $existingPenilaian->update([
                        'subkriteria_id' => $subkriteria->id,
                    ]);
                } else
                {
                    // Jika data belum ada, tambahkan ke dalam array untuk disimpan nanti
                    $dataPenilaian[] = [
                        'mahasiswa_id' => $mahasiswa->id,
                        'kriteria_id' => $subkriteria->kriteria_id,
                        'subkriteria_id' => $subkriteria->id,
                    ];
                }
            }

            // Simpan data baru jika ada
            if (!empty($dataPenilaian))
            {
                Penilaian::insert($dataPenilaian);
            }

            $nilai = Penilaian::where('mahasiswa_id', $mahasiswa->id)->get();
            $total = 0;
            foreach($nilai as $key => $value)
            {
            $total += $value->subkriteria->nilai;
            }

            $prodi_id = $mahasiswa->prodi_id;
            $kelompokUkt = KelompokUKT::where('prodi_id', $prodi_id)->first();
            if ($kelompokUkt) {
                $dataGolongan = Golongan::where('nilai_minimal', '<=', $total)
                ->where('nilai_maksimal', '>=', $total)
                ->first();

            if ($dataGolongan) {
                $namaGolongan = $dataGolongan->nama;
                $pemetaanKolom = [
                    'Kategori I' => 'kategori1',
                    'Kategori II' => 'kategori2',
                    'Kategori III' => 'kategori3',
                    'Kategori IV' => 'kategori4',
                    'Kategori V' => 'kategori5',
                    'Kategori VI' => 'kategori6',
                    'Kategori VII' => 'kategori7',
                ];
                if (array_key_exists($namaGolongan, $pemetaanKolom)) {
                    $namaKolom = $pemetaanKolom[$namaGolongan];
                    $nominalUkt = $kelompokUkt->$namaKolom;
                } else {
                  $nominalUkt = null;
                }
            } else {
            }
        } else {
            $nominalUkt = null;
        }

                $input['status'] = "Menunggu Verifikasi";
                $input['golongan_id'] = $dataGolongan->id;
                $input['nominal_ukt'] = $nominalUkt;


                unset($input['kriteria']);
                // Jika input tempat tinggal ada filenya
                foreach (['foto_tempat_tinggal', 'foto_kendaraan', 'foto_slip_gaji', 'foto_daya_listrik', 'foto_beasiswa']as $imageField) {
                    if ($request->hasFile($imageField)) {
                        if (!is_null($berkas->$imageField)) {
                        // Hapus gambar sebelumnya
                        $path = public_path($imageField.'/'.$berkas->$imageField);
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }

                        // Insert Gambar Baru
                        $filename = date('YmdHis').'_'.$request->file($imageField)->getClientOriginalName();
                        $Newpath = public_path($imageField);
                        $request->file($imageField)->move($Newpath, $filename);

                        // Update the $input array with the new filename
                        $input[$imageField] = $filename;

                }
            }

                $berkas->update($input);

                    return redirect()->route('mahasiswa.data-ukt')->with('success', 'Berhasil Mengubah Data.');
                } catch (\Exception $e) {
                    // Tangkap kesalahan dan tampilkan pesan kesalahan
                    return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
                }
        }

        if(Auth::guard('admin')->check())
        {
            $berkas = Berkas::find($id);
            $mahasiswa = $berkas->mahasiswa;
            $prodi_id = $mahasiswa->prodi_id;
            $dataGolongan = Golongan::all();
            $kelompokUkt = KelompokUKT::where('prodi_id', $prodi_id)->first();
            if ($kelompokUkt && $dataGolongan->isNotEmpty()) {
                $namaGolongan = $dataGolongan->where('id', $request->golongan_id)->pluck('nama')->first();
                $pemetaanKolom = [
                    'Kategori I' => 'kategori1',
                    'Kategori II' => 'kategori2',
                    'Kategori III' => 'kategori3',
                    'Kategori IV' => 'kategori4',
                    'Kategori V' => 'kategori5',
                    'Kategori VI' => 'kategori6',
                    'Kategori VII' => 'kategori7',
                ];
                if (array_key_exists($namaGolongan, $pemetaanKolom)) {
                    $namaKolom = $pemetaanKolom[$namaGolongan];
                    $nominalUkt = $kelompokUkt->$namaKolom;
                }
            }
            $updateData = [
                'status' => $request->status,
                'admin_id' => auth()->guard('admin')->user()->id,
            ];
            if ($request->status === "Lulus Verifikasi") {
                $updateData['golongan_id'] = $request->golongan_id;
                $updateData['nominal_ukt'] = $nominalUkt;
                $updateData['keterangan'] = null;

            } elseif ($request->status === "Belum Lengkap") {
                $updateData['keterangan'] = $request->keterangan;
            }

            $berkas->update($updateData);

            return redirect()->route('admin.data-ukt')->with('success', 'Berhasil Verifikasi Data.');
        }
    }

    public function print($id = null)
    {
        if(Auth::guard('mahasiswa')->check())
            {
                $mahasiswa = auth()->guard('mahasiswa')->user();
                $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
                $penilaians = Penilaian::get()->where('mahasiswa_id', $mahasiswa->id)->groupBy('mahasiswa_id');
                $kriteria = Kriteria::all();
                if($berkas == null){
                    return redirect()->route('data-ukt.create');
                } else {
                    $pdf = PDF::loadView('ukt.print', compact('berkas', 'penilaians', 'kriteria'));
                    $pdf->setBasePath('public_path');
                    $pdf->setPaper('A4', 'portrait');
                    return $pdf->stream("UKT_Mahasiswa.pdf");
                }

            } else
            {
                $berkas = Berkas::find($id);
                $mahasiswa = $berkas->mahasiswa;
                $penilaians = Penilaian::where('mahasiswa_id', $mahasiswa->id)->get()->groupBy('mahasiswa_id');
                $kriteria = Kriteria::all();
                $pdf = PDF::loadView('ukt.print', compact('berkas', 'penilaians', 'kriteria'));
                $pdf->setBasePath('public_path');
                $pdf->setPaper('F4', 'portrait');
                return $pdf->stream("UKT_Mahasiswa.pdf");
            }
        }
        public function datauktexport(){
            return Excel::download(new DataUktExport, 'Data_Ukt.xlsx');
        }

        public function printukt()
        {
            $admin = auth()->guard('admin')->user();
            if(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
                $berkas = Berkas::with(['admin', 'mahasiswa.prodi'])
                ->where('status', 'Lulus Verifikasi')
                ->where(function ($query) use ($admin) {
                    $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    })
                    ->orWhereHas('admin', function ($q) use ($admin) {
                        $q->where('jurusan_id', $admin->jurusan_id);
                    });
                })
                ->get();
            }
            elseif(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin'){
                $berkas = Berkas::where('status', 'Lulus Verifikasi')->get();
            }
            if ($berkas->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data yang tersedia untuk diprint.');
            }
                $pdf = PDF::loadView('ukt.printukt', compact('berkas'));
                $pdf->setBasePath('public_path');
                $pdf->setPaper('F4', 'portrait');
                return $pdf->stream("UKT_Mahasiswa.pdf");
        }


        public function HapusSemua(Request $request)
        {
            $ids = $request->ids;
            $jumlahData = 0;

            // Ambil mahasiswa_id terkait dengan berkas yang akan dihapus
            $mahasiswaIds = Berkas::whereIn('id', $ids)->pluck('mahasiswa_id')->toArray();

            // Mulai transaksi
            DB::beginTransaction();
            try {
                // Ambil data berkas yang akan dihapus
                $berkas = Berkas::whereIn('id', $ids)->get();
                $filePaths = [];
                // Kumpulkan path file yang akan dihapus
                foreach ($berkas as $berkasItem) {
                    if ($berkasItem->foto_tempat_tinggal) {
                        $filePaths[] = public_path('foto_tempat_tinggal/' . $berkasItem->foto_tempat_tinggal);
                    }
                    if ($berkasItem->foto_kendaraan) {
                        $filePaths[] = public_path('foto_kendaraan/' . $berkasItem->foto_kendaraan);
                    }
                    if ($berkasItem->foto_slip_gaji) {
                        $filePaths[] = public_path('foto_slip_gaji/' . $berkasItem->foto_slip_gaji);
                    }
                    if ($berkasItem->foto_daya_listrik) {
                        $filePaths[] = public_path('foto_daya_listrik/' . $berkasItem->foto_daya_listrik);
                    }
                    if ($berkasItem->foto_beasiswa) {
                        $filePaths[] = public_path('foto_beasiswa/' . $berkasItem->foto_beasiswa);
                    }
                }
                $deletedBerkas = Berkas::whereIn('id', $ids)->delete();

                if ($deletedBerkas) {
                    // Hapus penilaian terkait dengan mahasiswa_id
                    $deletedPenilaian = Penilaian::whereIn('mahasiswa_id', $mahasiswaIds)->delete();
                    $remainingPenilaianCount = Penilaian::whereIn('mahasiswa_id', $mahasiswaIds)->count();

                    // Pastikan semua penilaian terkait juga terhapus
                    if ($remainingPenilaianCount == 0) {

                        foreach ($filePaths as $filePath) {
                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }
                        }
                        // Komit transaksi jika berhasil
                        DB::commit();
                        $jumlahData = $deletedBerkas;
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
