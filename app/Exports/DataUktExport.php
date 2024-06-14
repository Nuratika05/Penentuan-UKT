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
            $verifikatorJurusanId = Auth::guard('admin')->user()->jurusan_id;
            $Data = Berkas::where('status', 'Lulus Verifikasi')
            ->whereHas('admin', function ($query) use ($verifikatorJurusanId) {
                $query->where('jurusan_id', $verifikatorJurusanId);
            })
            ->get();
        }else{
        $Data = Berkas::where('status', 'Lulus Verifikasi')
        ->get();
        }
        $exportData = collect();

        foreach ($Data as $berkas) {

            $exportDataRow = [
                'no_pendaftaran' => $berkas->mahasiswa->id,
                'nama' => $berkas->mahasiswa->nama,
                'prodi' => $berkas->mahasiswa->prodi->nama,
                'jenjang' => $berkas->mahasiswa->prodi->jenjang,
                'jurusan' => $berkas->mahasiswa->prodi->jurusan->nama,
                'jalur' => $berkas->mahasiswa->jalur,
                'verifikator' => $berkas->admin->nama,
                'golongan' => $berkas->golongan->nama,
                'nominal' => $berkas->nominal_ukt,
            ];
            $exportData->push($exportDataRow);
        };

        return $exportData;
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
            'Jalur Pendaftaran',
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
        $row->jurusan,
        $row->jalur,
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
            'A2:I' . ($sheet->getHighestRow()) => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT],
            ],
        ];
    }
}
