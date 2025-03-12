<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $arsip->no_pendaftaran }}-{{ $arsip->nama_mahasiswa }}</title>
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
        vertical-align: top;
    }

    table p {
        padding-left: 12px;
    }

    /* Style the images */
    .img-fluid {
        width: 60%; /* Atur lebar gambar agar mengisi container */
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
        <table class="table table-th w-80">
            <h5 class="card-header">I. DATA MAHASISWA</h5>
            <tr>
                <td>No. Pendaftaran</td>
                <td>:</td>
                <td>{{ $arsip->no_pendaftaran }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $arsip->nama_mahasiswa }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $arsip->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td>{{ $arsip->no_telepon }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $arsip->alamat }}</td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>:</td>
                <td>{{ $arsip->nama_prodi }}</td>
            </tr>
            <tr>
                <td>Jenjang</td>
                <td>:</td>
                <td>{{ $arsip->jenjang }}</td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>{{ $arsip->nama_jurusan }}</td>
            </tr>
            <tr>
                <td>Jalur Pendaftaran</td>
                <td>:</td>
                <td>{{ $arsip->jalur }}</td>
            </tr>
            <tr>
                <td>Tahun Angkatan</td>
                <td>:</td>
                <td>{{ $arsip->tahun_angkatan }}</td>
            </tr>
            <h5 class="card-header">II. DATA KRITERIA MAHASISWA</h5>
            @if ($arsip->nama_ayah == null || $arsip->nama_ayah == '')
            @else
            <tr>
                <td>Nama Ayah</td>
                <td>:</td>
                <td>
                    {{ $arsip->nama_ayah }}
                </td>
            </tr>
            @endif
            @if ($arsip->nama_ibu == null || $arsip->nama_ibu == '')
            @else
            <tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td>
                    {{ $arsip->nama_ibu }}
                </td>
            </tr>
            @endif
            @if ($arsip->nama_wali == null || $arsip->nama_wali == '')
            @else
            <tr>
                <td>Nama Wali</td>
                <td>:</td>
                <td>
                    {{ $arsip->nama_wali }}
                </td>
            </tr>
            @endif
            @if ($arsip->pekerjaan_orangtua_wali  == null || $arsip->pekerjaan_orangtua_wali  == '')
            @else
            <tr>
                <td>Pekerjaan Orang Tua/Wali</td>
                <td>:</td>
                <td>
                    {{ $arsip->pekerjaan_orangtua_wali }}
                </td>
            </tr>
            @endif
            @foreach ($penilaianarsip as $data => $nilai)
                @foreach ($nilai as $data)
                    <tr>
                        <td>{{ $data->kriteria }}</td>
                        <td>:</td>
                        <td>{{ $data->subkriteria }}</td>
                    </tr>
                @endforeach
            @endforeach
            <h5 class="card-header">III. GOLONGAN UKT</h5>
            <tr>
                <td>Golongan</td>
                <td>:</td>
                <td>
                    {{ $arsip->nama_golongan }}

                </td>
            </tr>
            <tr>
                <td>Nominal</td>
                <td>:</td>
                <td>Rp{{ number_format($arsip->nominal) }}</td>
            </tr>
        </table>
        <table class="table table-th w-80" style="text-align: justify">
            <tr>
                <h5 class="card-header">IV. FOTO LAMPIRAN</h5>
                @if ($arsip->foto_kartu_keluarga === null || $arsip->foto_kartu_keluarga === '')
                @else
                <p>Foto Kartu Keluarga:</p>
                <p class="image-container"><img src="{{ public_path('fotoarsip/foto_kartu_keluarga/' . $arsip->foto_kartu_keluarga) }}"
                        class="img-fluid">
                </p>
                @endif
            </tr>
            @if ($arsip->foto_KTP_orangtua === null || $arsip->foto_KTP_orangtua === '')
            @else
            <tr>
                <p>Foto KTP Orang Tua/Wali:</p>
                <p class="image-container"><img src="{{ public_path('fotoarsip/foto_KTP_orangtua/' . $arsip->foto_KTP_orangtua) }}"
                        class="img-fluid">
                </p>
            </tr>
            @endif
            <tr>
                <p>Foto Tempat Tinggal:</p>
                <p class="image-container"><img src="{{ public_path('fotoarsip/foto_tempat_tinggal/' . $arsip->foto_tempat_tinggal) }}"
                        class="img-fluid"></>
            </tr>
            <tr>
                <p>Foto Slip Gaji:</p>
                <p class="image-container"><img src="{{ public_path('fotoarsip/foto_slip_gaji/' . $arsip->foto_slip_gaji) }}"
                        class="img-fluid"></>
            </tr>
            <tr>
                <p>Foto Bukti Pembayaran Listrik 3 Bulan Terakhir:</p>
                <p class="image-container"><img src="{{ public_path('fotoarsip/foto_daya_listrik/' . $arsip->foto_daya_listrik) }}"
                        class="img-fluid">
                </>
            </tr>
            @if ($arsip->foto_kendaraan === null || $arsip->foto_kendaraan === '')
            @else
            <tr>
                    <p>Foto Kendaraan:</p>
                    <p class="image-container"><img src="{{ public_path('fotoarsip/foto_kendaraan/' . $arsip->foto_kendaraan) }}"
                            class="img-fluid"></>
            </tr>
            @endif
            <tr>
                @if ($arsip->foto_beasiswa === null || $arsip->foto_beasiswa === '')
                @else
                    <p>Foto Bukti Bantuan Pemerintah:</p>
                    <p class="image-container"><img src="{{ public_path('fotoarsip/foto_beasiswa/' . $arsip->foto_beasiswa) }}"
                            class="img-fluid"></>
                @endif
            </tr>
        </table>
    </div>
</body>

</html>
