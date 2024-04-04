<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MahasiswaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()

    {
        $mahasiswaData = Mahasiswa::select('id', 'nama', 'jenis_kelamin', 'no_telepon', 'alamat', 'prodi_id', 'jalur')
            ->get();

        $mahasiswaData = $mahasiswaData->map(function ($mahasiswa) {
            $prodiNama = Prodi::where('id', $mahasiswa->prodi_id)->value('nama');
            $jalur = $mahasiswa->jalur; // Simpan data jalur sebelum menghapus
            unset($mahasiswa->prodi_id); // Menghilangkan kolom prodi_id
            unset($mahasiswa->jalur); // Menghapus kolom jalur sementara

            $mahasiswa['nama_prodi'] = $prodiNama;
            $mahasiswa['jalur'] = $jalur; // Kembalikan data jalur yang disimpan sebelumnya
            return $mahasiswa;
        });

        return $mahasiswaData;
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'Nama',
            'Jenis Kelamin',
            'No Telepon',
            'Alamat',
            'Prodi',
            'Jalur Pendaftaran',
            'Password',
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
            'A2:H' . ($sheet->getHighestRow()) => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT],
            ],
        ];
    }
}
