<?php
namespace App\Exports;

use App\Models\Arsip;
use App\Models\Admin;
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
            $DataArsips = Arsip::where('id_folder', $this->id)
            ->where('admin_id', auth()->user()->id)->get();
        }else{
        $DataArsips = Arsip::where('id_folder', $this->id)->get();
        }
        $exportData = collect();

        foreach ($DataArsips as $item) {
        $nominalFormatted = 'Rp '.number_format($item->nominal, 0, ',', '.');
        $admin = Admin::find($item->admin_id);
        $exportDataRow = [
            'no_pendaftaran' => $item->no_pendaftaran,
            'nama_mahasiswa' => $item->nama_mahasiswa,
            'nama_prodi' => $item->nama_prodi,
            'jenjang' => $item->jenjang,
            'nama_jurusan' => $item->nama_jurusan,
            'verifikator' => $item->admin->nama,
            'nama_golongan' => $item->nama_golongan,
            'nominal' => $nominalFormatted,
            'tahun_angkatan' => $item->tahun_angkatan,
            'jalur' => $item->jalur,
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
            'Golongan',
            'Nominal',
            'Tahun Angkatan',
            'Jalur Pendaftaran',
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
