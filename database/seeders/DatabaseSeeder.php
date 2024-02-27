<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Golongan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'nama' => 'Super Admin',
            'role' => 'superadmin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
        ]);
        Jurusan::factory()->create([
            'nama' => 'Perkebunan',
        ]);
        Jurusan::factory()->create([
            'nama' => 'Manajemen Hutan',
        ]);
        Jurusan::factory()->create([
            'nama' => 'Teknik dan Informatika',
        ]);
        Jurusan::factory()->create([
            'nama' => 'Teknologi Hasil Hutan',
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '1',
            'nama' => 'Teknologi Hasil Perkebunan',
            'jenjang' => 'D3'
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '1',
            'nama' => 'Budidaya Tanaman Perkebunan',
            'jenjang' => 'D3'
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '1',
            'nama' => 'Pengelolaan Perkebunan',
            'jenjang' => 'D4'
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '2',
            'nama' => 'Pengelolaan Hutan',
            'jenjang' => 'D3'
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '2',
            'nama' => 'Pengelolaan Lingkungan',
            'jenjang' => 'D3'
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '3',
            'nama' => 'Teknologi Geomatika',
            'jenjang' => 'D4'
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '3',
            'nama' => 'Teknologi Rekayasa Perangkat Lunak',
            'jenjang' => 'D4'
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '4',
            'nama' => 'Pengolahan Hasil Hutan',
            'jenjang' => 'D3'
        ]);
        Prodi::factory()->create([
            'jurusan_id' => '4',
            'nama' => 'Rekayasa Kayu',
            'jenjang' => 'D4'
        ]);
        Golongan::factory()->create([
            'nama' => 'K1',
            'jenjang' => 'D3',
            'nominal' => '0'
        ]);
        Golongan::factory()->create([
            'nama' => 'K2',
            'jenjang' => 'D3',
            'nominal' => '500000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K3',
            'jenjang' => 'D3',
            'nominal' => '750000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K4',
            'jenjang' => 'D3',
            'nominal' => '1000000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K5',
            'jenjang' => 'D3',
            'nominal' => '1250000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K6',
            'jenjang' => 'D3',
            'nominal' => '1500000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K7',
            'jenjang' => 'D3',
            'nominal' => '2400000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K1',
            'jenjang' => 'D4',
            'nominal' => '500000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K2',
            'jenjang' => 'D4',
            'nominal' => '750000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K3',
            'jenjang' => 'D4',
            'nominal' => '1000000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K4',
            'jenjang' => 'D4',
            'nominal' => '1250000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K5',
            'jenjang' => 'D4',
            'nominal' => '1500000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K6',
            'jenjang' => 'D4',
            'nominal' => '2400000'
        ]);
        Golongan::factory()->create([
            'nama' => 'K7',
            'jenjang' => 'D4',
            'nominal' => '3500000'
        ]);
        // \App\Models\Mahasiswa::factory(30)->create();
    }
}
