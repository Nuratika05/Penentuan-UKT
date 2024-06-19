<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berkas->mahasiswa->id }}-{{ $berkas->mahasiswa->nama }}</title>
    <style type="text/css">
        .bodyy {
            font-family: arial;
            background-color: #f8f8f8
        }

        .rangkasurat {
            width: 700px;
            margin: 0 auto;
            background-color: #fff;
            height: 150px;
            padding: 1px;
        }

        .tablee {
            border-bottom: 5px solid #000;
            padding: 1px;
        }

        .tengah {
            text-align: center;
            line-height: 1px;
        }
    </style>
</head>

<style>
    /* Reset some default margin and padding */
    body,
    table {
        margin: 3px; /* Atur margin untuk body dan table */
        padding: 5px; /* Biarkan padding tetap 5px seperti yang sudah diatur */
    }

    /* Style the container div */
    .card-body {
        margin-bottom: 3px;
    }

    /* Style the heading */
    .card-header {
        color: rgb(15, 14, 14);
        margin: 3px; /* Atur margin untuk card-header */
    }

    /* Style the table headers */
    table th {
        text-align: left;
    }

    /* Style the table cells */
    table td {
        padding-left: 12px;
    }

    table p {
        padding-left: 12px;
    }

    /* Style the images */
    .img-fluid {
        width: 75%; /* Atur lebar gambar agar mengisi container */
        height: auto; /* Biarkan tinggi gambar menyesuaikan */
        display: block; /* Memastikan gambar berada di tengah dengan margin: 0 auto */
        margin: 5px auto; /* Atur margin rata untuk gambar */
        text-align: center;
    }

    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden; /* Mengatasi masalah overflow jika terjadi */
        text-align: center;
    }

    /* Style the form */
    form {
        margin-top: 20px;
    }

</style>

<body>
    <div class="rangkasurat">
        <table class="tablee" width="100%">
            <td><img src="{{ public_path('logo_politani.png') }}" width="100px"></td>
            <td class="tengah">
                <h4>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h4>
                <h3>POLITEKNIK PERTANIAN NEGERI SAMARINDA</h3>
                <h5>Kampus Gunung Panjang Jl. Samratulangi Samarinda 75131 Telp. 0541-260421, Fax. 0541-260680</h5>
                <h5>email: info@politanisamarinda.ac.id politanismd@gmail.com, www.politanisamarinda.ac.id </h5>
            </td>
    </div>
    <div>
        <h4 style="text-align:center">DATA UKT MAHASISWA <br>POLITEKNIK PERTANIAN NEGERI SAMARINDA</h4>
        <table class="table table-th w-80" style="text-align: justify">
            <h5 class="card-header">I. DATA MAHASISWA</h5>
            <tr>
                <td>No. Pendaftaran</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->id }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->no_telepon }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->alamat }}</td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->prodi->nama }}</td>
            </tr>
            <tr>
                <td>Jenjang</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->prodi->jenjang }}</td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->prodi->jurusan->nama }}</td>
            </tr>
            <tr>
                <td>Jalur Pendaftaran</td>
                <td>:</td>
                <td>{{ $berkas->mahasiswa->jalur }}</td>
            </tr>
            <br>
            <h5 class="card-header">II. DATA KRITERIA MAHASISWA</h5>
            <tr>
                <td>Nama Ayah</td>
                <td>:</td>
                @if ($berkas->nama_ayah == null || $berkas->nama_ayah == '')
                    -
                @else
                    <td>{{ $berkas->nama_ayah }}</td>
                @endif
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td>
                    @if ($berkas->nama_ibu == null || $berkas->nama_ibu == '')
                        -
                    @else
                        {{ $berkas->nama_ibu }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Nama Wali</td>
                <td>:</td>
                <td>
                    @if ($berkas->nama_wali == null || $berkas->nama_wali == '')
                        -
                    @else
                        {{ $berkas->nama_wali }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Pekerjaan Orang Tua/Wali</td>
                <td>:</td>
                <td>
                    @if ($berkas->pekerjaan_orangtua_wali == null || $berkas->pekerjaan_orangtua_wali == '')
                        -
                    @else
                        {{ $berkas->pekerjaan_orangtua_wali }}
                    @endif
                </td>
            </tr>
            @foreach ($penilaians as $data => $nilai)
                @foreach ($nilai as $data)
                    <tr>
                        <td>{{ $data->kriteria->nama }}</td>
                        <td>:</td>
                        <td>{{ $data->subkriteria->nama }}</td>
                    </tr>
                @endforeach
            @endforeach
            <br>
            <h5 class="card-header">III. GOLONGAN UKT</h5>
            <tr>
                <td>Golongan</td>
                <td>:</td>
                <td>
                    {{ $berkas->golongan->nama }}
                </td>
            </tr>
            <tr>
                <td>Nominal UKT</td>
                <td>:</td>
                <td>Rp{{ number_format($berkas->nominal_ukt, 0, ',', '.') }}</td>
            </tr>
        </table>
        <table class="table table-th w-80" style="text-align: justify">
            <tr>
            <h5 class="card-header">IV. FOTO LAMPIRAN</h5>
                <p>Foto Kartu Keluarga:</p>
                <p
                    @if ($berkas->foto_kartu_keluarga === null || $berkas->foto_kartu_keluarga === '')
                        -
                    @else
                        class="image-container"><img
                            src="{{ public_path('foto_kartu_keluarga/' . $berkas->foto_kartu_keluarga) }}" class="img-fluid">
                    @endif
                </p>
            </tr>
            <tr>
                <p>Foto KTP Orang Tua/Wali:</p>
                <p
                    @if ($berkas->foto_KTP_orangtua === null || $berkas->foto_KTP_orangtua === '')
                        -
                    @else
                        class="image-container"><img
                            src="{{ public_path('foto_KTP_orangtua/' . $berkas->foto_KTP_orangtua) }}" class="img-fluid">
                    @endif
                </p>
            </tr>
            <tr>
                <p>Foto Tempat Tinggal:</p>
                <p class="image-container"><img src="{{ public_path('foto_tempat_tinggal/' . $berkas->foto_tempat_tinggal) }}"
                        class="img-fluid"></p>
            </tr>
            <tr>
                <p>Foto Slip Gaji:</p>
                <p class="image-container"><img src="{{ public_path('foto_slip_gaji/' . $berkas->foto_slip_gaji) }}" class="img-fluid">
                </p>
            </tr>
            <tr>
                <p>Foto Daya Listrik:</p>
                <p class="image-container"><img src="{{ public_path('foto_daya_listrik/' . $berkas->foto_daya_listrik) }}"
                        class="img-fluid">
                </p>
            </tr>
            <tr>
                @if ($berkas->foto_kendaraan === null || $berkas->foto_kendaraan === '')
                @else
                    <p>Foto Kendaraan:</p>
                    <p class="image-container"><img src="{{ public_path('foto_kendaraan/' . $berkas->foto_kendaraan) }}" class="img-fluid">
                    </p>
                @endif
            </tr>
            <tr>
                @if ($berkas->foto_beasiswa === null || $berkas->foto_beasiswa === '')
                @else
                    <p>Foto Bukti Bantuan Pemerintah:</p>
                    <p class="image-container"><img src="{{ public_path('foto_beasiswa/' . $berkas->foto_beasiswa) }}" class="img-fluid">
                    </p>
                @endif
            </tr>
        </table>
    </div>
</body>

</html>
