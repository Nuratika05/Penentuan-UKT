<?php

namespace App\Observers;

use App\Models\Mahasiswa;
use App\Models\Berkas;
use App\Models\KelompokUkt;
use App\Models\Golongan;

class MahasiswaObserver
{
    /**
     * Handle the Mahasiswa "created" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function created(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Handle the Mahasiswa "updated" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function updating(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->isDirty('prodi_id')) {

            $prodiId = $mahasiswa->prodi_id;
            $kelompokUkt = KelompokUkt::where('prodi_id', $prodiId)->first();

            if ($kelompokUkt) {
                $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
                if ($berkas) {
                // Ambil nama golongan
                    $dataGolongan = Golongan::find($berkas->golongan_id);
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

                        // Update berkas dengan golongan_id dan nominal_ukt
                        $berkas->update([
                            'nominal_ukt' => $nominalUkt,
                        ]);
                    }
                }
            }
        }
    }
    /**
     * Handle the Mahasiswa "deleted" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function deleted(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Handle the Mahasiswa "restored" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function restored(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Handle the Mahasiswa "force deleted" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function forceDeleted(Mahasiswa $mahasiswa)
    {
        //
    }
}
