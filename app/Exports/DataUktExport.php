<?php

namespace App\Exports;

use App\Models\Admin;
use App\Models\Berkas;
use App\Models\Mahasiswa;
use App\Models\Golongan; // Perbaikan pada namespace
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
        $Data = Berkas::where('status', 'Lengkap')
        ->select('mahasiswa_id', 'admin_id', 'golongan_id')
        ->get();

        $Data = $Data->map(function ($DataUKT) {
            $mahasiswa = Mahasiswa::find($DataUKT->mahasiswa_id);
            $admin = Admin::find($DataUKT->admin_id);
            $golongan = Golongan::find($DataUKT->golongan_id);
            $prodi = Prodi::find($mahasiswa->prodi_id);
            $nominalFormatted = number_format($golongan->nominal, 0, ',', '.');

            $exportData = [
                'no_pendaftaran' => $mahasiswa->id,
                'nama' => $mahasiswa->nama,
                'prodi' => $prodi->nama,
                'jenjang' => $prodi->jenjang,
                'verifikator' => $admin->nama,
                'golongan' => $golongan->nama,
                'nominal' => 'Rp ' . $nominalFormatted,
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
            'Verifikator',
            'Golongan',
            'Nominal',
        ];
    }
    public function map($row): array
{
    return [

        $row->no_pendaftaran,
        $row->nama,
        $row->prodi,
        $row->jenjang,
        $row->verifikator,
        $row->golongan,
        $row->nominal,
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
            'A2:F' . ($sheet->getHighestRow()) => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT],
            ],
        ];
    }
}
