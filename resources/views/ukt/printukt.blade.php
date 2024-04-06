<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKT Mahasiswa</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table-th {
            border: 1px solid black;
            padding: 8px;
        }

        /* Style the table cells */
        .table-td {
            border: 1px solid black;
            padding: 8px;
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
</head>

<body>
    <div class="rangkasurat">
        <table class="tablee" width="100%">
            <tr>
                <td><img src="{{ public_path('logo_politani.png')}}" width="100px"></td>
                <td class="tengah">
                    <h4>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h4>
                    <h3>POLITEKNIK PERTANIAN NEGERI SAMARINDA</h3>
                    <h5>Kampus Gunung Panjang Jl. Samratulangi Samarinda 75131 Telp. 0541-260421, Fax. 0541-260680</h5>
                    <h5>email: info@politanisamarinda.ac.id politanismd@gmail.com, www.politanisamarinda.ac.id </h5>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <h4 style="text-align:center">DATA UKT MAHASISWA <br>POLITEKNIK PERTANIAN NEGERI SAMARINDA</h4>
        <table class="table-th" style="text-align: center">
            <tr>
                <th style="border-right: 1px solid #000;">No</th>
                <th style="border-right: 1px solid #000;">Nomor Pendaftaran</th>
                <th style="border-right: 1px solid #000;">Nama</th>
                <th style="border-right: 1px solid #000;">Prodi</th>
                <th style="border-right: 1px solid #000;">Jenjang</th>
                <th style="border-right: 1px solid #000;">Jurusan</th>
                <th style="border-right: 1px solid #000;">Golongan</th>
                <th>Nominal UKT</th>
            </tr>
            @foreach ($berkas as $id)
            <tr class="table-td">
                <td style="border-right: 1px solid #000;">{{ $loop->iteration }}</td>
                <td style="border-right: 1px solid #000;">{{ $id->mahasiswa->id }}</td>
                <td style="border-right: 1px solid #000;">{{ $id->mahasiswa->nama }}</td>
                <td style="border-right: 1px solid #000;">{{ $id->mahasiswa->prodi->nama }}</td>
                <td style="border-right: 1px solid #000;">{{ $id->mahasiswa->prodi->jenjang }}</td>
                <td style="border-right: 1px solid #000;">{{ $id->mahasiswa->prodi->jurusan->nama }}</td>
                <td style="border-right: 1px solid #000;">{{ $id->golongan->nama }}</td>
                <td style="border-right: 1px solid #000;">Rp{{ number_format ($id->nominal_ukt,0,',','.' )}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
