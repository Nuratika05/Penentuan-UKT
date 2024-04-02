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

        $arsips = Arsip::where('id_folder', $this->id)->get();
        $exportData = collect();
        foreach ($arsips as $arsip) {
            // Format nominal
            $nominalFormatted = 'Rp '.number_format($arsip->nominal, 0, ',', '.');

            // Tambahkan data arsip yang telah diformat ke dalam koleksi untuk diekspor
            $exportData->push([
                'no_pendaftaran' => $arsip->no_pendaftaran,
                'nama_mahasiswa' => $arsip->nama_mahasiswa,
                'nama_prodi' => $arsip->nama_prodi,
                'jenjang' => $arsip->jenjang,
                'nama_jurusan' => $arsip->nama_jurusan,
                'nama_golongan' => $arsip->nama_golongan,
                'nominal' => $nominalFormatted,
                'tahun_angkatan' => $arsip->tahun_angkatan
            ]);
        }

        // Kembalikan koleksi data yang telah diformat
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
            'Golongan',
            'Nominal',
            'Tahun Angkatan'
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
