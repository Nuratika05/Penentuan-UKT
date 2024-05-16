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
        margin: 5;
        padding: 5;
    }

    /* Style the container div */
    .card-body {
        margin-bottom: 20px;
    }

    /* Style the heading */
    .card-header {
        color: rgb(15, 14, 14);
        margin: 5;
    }

    /* Style the table headers */
    table th {
        text-align: left;
    }

    /* Style the table cells */
    table td {
        padding-left: 10px;
    }

    /* Style the images */
    .img-fluid {
        max-width: 200px;
        height: auto;
        border-radius: 5px;
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
            @foreach ($penilaianarsip as $data => $nilai)
                @foreach ($nilai as $data)
                    <tr>
                        <td>{{ $data->kriteria }}</td>
                        <td>:</td>
                        <td>{{ $data->subkriteria }}</td>
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td>Foto Tempat Tinggal</td>
                <td>:</td>
                <td><img src="{{ public_path('fotoarsip/foto_tempat_tinggal/' . $arsip->foto_tempat_tinggal) }}"
                        class="img-fluid"></td>
            </tr>
            <tr>
                <td>Foto Slip Gaji</td>
                <td>:</td>
                <td><img src="{{ public_path('fotoarsip/foto_slip_gaji/' . $arsip->foto_slip_gaji) }}"
                        class="img-fluid"></td>
            </tr>
            <tr>
                <td>Foto Daya Listrik</td>
                <td>:</td>
                <td><img src="{{ public_path('fotoarsip/foto_daya_listrik/' . $arsip->foto_daya_listrik) }}"
                        class="img-fluid">
                </td>
            </tr>
            <tr>
                @if ($arsip->foto_kendaraan === null || $arsip->foto_kendaraan === '')
                @else
                    <td>Foto Kendaraan</td>
                    <td>:</td>
                    <td><img src="{{ public_path('fotoarsip/foto_kendaraan/' . $arsip->foto_kendaraan) }}"
                            class="img-fluid"></td>
                @endif
            </tr>
            <tr>
                @if ($arsip->foto_beasiswa === null || $arsip->foto_beasiswa === '')
                @else
                    <td>Foto Bantuan Pemerintah</td>
                    <td>:</td>
                    <td><img src="{{ public_path('fotoarsip/foto_beasiswa/' . $arsip->foto_beasiswa) }}"
                            class="img-fluid"></td>
                @endif
            </tr>
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
    </div>
    </table>
</body>

</html>
