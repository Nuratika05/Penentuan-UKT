<?php

namespace App\Exports;

use App\Models\Admin;
use App\Models\Berkas;
use App\Models\Mahasiswa;
use App\Models\Golongan;
use Illuminate\Support\Facades\Auth;
use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataUktExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        if(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
            $Data = Berkas::where('status', 'Lulus Verifikasi')
            ->where('admin_id', auth()->user()->id)
            ->get();
        }else{
        $Data = Berkas::where('status', 'Lulus Verifikasi')
        ->get();
        }

        $Data = $Data->map(function ($DataUKT) {
            $mahasiswa = Mahasiswa::find($DataUKT->mahasiswa_id);
            $admin = Admin::find($DataUKT->admin_id);
            $golongan = Golongan::find($DataUKT->golongan_id);
            $prodi = Prodi::find($mahasiswa->prodi_id);
            $nominalFormatted = 'Rp '. number_format($DataUKT->nominal_ukt, 0, ',', '.');

            $exportData = [
                'no_pendaftaran' => $mahasiswa->id,
                'nama' => $mahasiswa->nama,
                'prodi' => $prodi->nama,
                'jenjang' => $prodi->jenjang,
                'jurusan' => $prodi->jurusan->nama,
                'verifikator' => $admin->nama,
                'golongan' => $golongan->nama,
                'nominal' => $nominalFormatted,
                'jalur' => $mahasiswa->jalur,
            ];

            return $exportData;
        });

        return $Data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'Nama',
            'Prodi',
            'Jenjang',
            'Jurusan',
            'Verifikator',
            'Golongan',
            'Nominal',
            'Jalur Pendaftaran',
        ];
    }
    public function map($row): array
{
    return [

        $row->no_pendaftaran,
        $row->nama,
        $row->prodi,
        $row->jenjang,
        $row->jurusan,
        $row->verifikator,
        $row->golongan,
        $row->nominal,
        $row->jalur,
    ];
}

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk judul kolom (headings)
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ],
             // Style untuk data
            'A2:I' . ($sheet->getHighestRow()) => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT],
            ],
        ];
    }
}
