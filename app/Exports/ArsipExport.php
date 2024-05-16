<?php
namespace App\Exports;

use App\Models\Arsip;
use App\Models\Admin;
use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class ArsipExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
            $verifikatorJurusanId = Auth::guard('admin')->user()->jurusan_id;
            $namaJurusan = Jurusan::where('id', $verifikatorJurusanId)->value('nama');
            $DataArsips = Arsip::where('id_folder', $this->id)
                ->where('nama_jurusan', $namaJurusan)
                ->get();
        }else{
        $DataArsips = Arsip::where('id_folder', $this->id)->get();
        }
        $exportData = collect();

        foreach ($DataArsips as $item) {
        $nominalFormatted = 'Rp '.number_format($item->nominal, 0, ',', '.');
        $exportDataRow = [
            'no_pendaftaran' => $item->no_pendaftaran,
            'nama_mahasiswa' => $item->nama_mahasiswa,
            'nama_prodi' => $item->nama_prodi,
            'jenjang' => $item->jenjang,
            'nama_jurusan' => $item->nama_jurusan,
            'verifikator' => $item->admin,
            'jalur' => $item->jalur,
            'tahun_angkatan' => $item->tahun_angkatan,
            'nama_golongan' => $item->nama_golongan,
            'nominal' => $nominalFormatted,
        ];

        $exportData->push($exportDataRow);
        }

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
            'Verifikator',
            'Jalur Pendaftaran',
            'Tahun Angkatan',
            'Golongan',
            'Nominal',

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
            'A2:J' . ($sheet->getHighestRow()) => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT],
            ],
        ];
    }
}
