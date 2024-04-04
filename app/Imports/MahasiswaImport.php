<?php

namespace App\Imports;

use App\Models\MahasiswaTemps;
use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;




 //  use \Maatwebsite\Excel\Concerns\Importable;
/*
    public static $successCount = 0;
    public static $failCount = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    class MahasiswaImport implements ToModel, WithHeadingRow
{
    protected $upload_code;
    public function __construct($upload_code)
    {

        $this->upload_code = $upload_code;

    }
    public function model(array $row)
    {

        $prodiId = Prodi::where('nama', $row['prodi'])->value('id') ?? null;

       return new MahasiswaTemps([
        'id_temps' => $row['no_pendaftaran'] ?? null,
        'nama_temps' => $row['nama'] ?? null,
        'jenis_kelamin_temps' => $row['jenis_kelamin'] ?? null,
        'no_telepon_temps' => $row['no_telepon'] ?? null,
        'alamat_temps' => $row['alamat'] ?? null,
        'prodi_id_temps' => $prodiId,
        'jalur_temps' => $row['jalur'] ?? null,
        'password_temps' => $row['password'] ?? null,
        'status_upload' => 'Draft',
        'upload_code' => $this->upload_code, // Tambahkan tanda koma di sini

    ]);
    }
}
