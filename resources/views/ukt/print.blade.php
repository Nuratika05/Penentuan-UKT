<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berkas->mahasiswa->id }}-{{ $berkas->mahasiswa->nama }}</title>
    <style type="text/css">
    .bodyy {font-family: arial;background-color: #f8f8f8}
    .rangkasurat {width: 700px;margin: 0 auto;background-color: #fff;height: 150px;padding: 1px;}
    .tablee {border-bottom: 5px solid #000;padding: 1px;}
    .tengah {text-align: center;line-height: 1px;}
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
               <td><img src="{{ public_path('logo_politani.png')}}" width="100px"></td>
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
            <h5 class="card-header">II. DATA KRITERIA MAHASISWA</h5>
            @foreach ($penilaians as $data => $nilai)
                @foreach ($nilai as $data)
                    <tr>
                        <td>{{ $data->kriteria->nama }}</td>
                        <td>:</td>
                        <td>{{ $data->subkriteria->nama }}</td>
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td>Foto Tempat Tinggal</td>
                <td>:</td>
                <td><img src="{{ public_path('foto_tempat_tinggal/' . $berkas->foto_tempat_tinggal) }}"
                        class="img-fluid"></td>
            </tr>
            <tr>
                <td>Foto Slip Gaji</td>
                <td>:</td>
                <td><img src="{{ public_path('foto_slip_gaji/' . $berkas->foto_slip_gaji) }}" class="img-fluid"></td>
            </tr>
            <tr>
                <td>Foto Daya Listrik</td>
                <td>:</td>
                <td><img src="{{ public_path('foto_daya_listrik/' . $berkas->foto_daya_listrik) }}" class="img-fluid">
                </td>
            </tr>
            <tr>
                @if ($berkas->foto_kendaraan === null || $berkas->foto_kendaraan === '')
                @else
                <td>Foto Kendaraan</td>
                <td>:</td>
                <td><img src="{{ public_path('foto_kendaraan/' . $berkas->foto_kendaraan) }}" class="img-fluid"></td>
                @endif
            </tr>
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
                        <td>Rp{{ number_format($berkas->nominal_ukt,0,',','.') }}</td>
                    </tr>
         </div>
        </table>
        <br>


{{--    <div style="width: 30%;; text-align:left; float: right;">
            POLITANI Samarinda, <br>
            Yang Bertanda Tangan,
        <br><br><br><br><br>
        <table width='350'>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $berkas->admin->nama }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                @if ($berkas->admin->jurusan_id == null)
                @else
                <td>Ketua Jurusan {{ $berkas->admin->jurusan->nama }}</td>
                @endif
            </tr>
        </div>
        </table>{{--  --}}
</body>
</html>
