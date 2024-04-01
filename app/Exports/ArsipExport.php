<?php
namespace App\Exports;

use App\Models\Arsip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

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

        return Arsip::select('no_pendaftaran', 'nama_mahasiswa', 'nama_prodi', 'jenjang', 'nama_jurusan', 'nama_golongan', 'nominal', 'tahun_angkatan')
            ->where('id_folder', $this->id)
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'no_pendaftaran',
            'nama_mahasiswa',
            'nama_prodi',
            'jenjang',
            'nama_jurusan',
            'nama_golongan',
            'nominal (Rp)',
            'tahun_angkatan'
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
            'A2:G' . ($sheet->getHighestRow()) => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT],
            ],
        ];
    }
}
