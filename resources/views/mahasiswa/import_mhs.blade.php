@extends('layouts.app')
@section('content')
    <style>
        .alert-success {
            color: #005700;
            /* Warna hijau tua untuk teks */
            background-color: #DFF0D8;
            /* Warna latar belakang hijau muda yang sesuai dengan kelas alert-success bawaan Bootstrap */
            border-color: #005700;
            /* Warna border yang sesuai */
        }

        #search {
            max-width: 80%;
            float: left;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            /* Pastikan tabel memiliki lebar 100% */
        }
    </style>
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Import Data Excel Mahasiswa</h4>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @elseif (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('mahasiswaimportup') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row row-sm mb-4">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="input-group file-browser">
                            <input class="form-control" type="file" id="excel_upload" accept=".xlsx, .xls" name="excel_upload" required>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-sm" type="submit">Upload File Excel</button>
                <a class="btn btn-secondary btn-sm" type="button" href="{{ route('mahasiswa.index') }}">Kembali</a>
            </form>
        </div>
    </div>
    <br>
    @if (count($mhs_temps) > 0)
        <div class="row">
            <div class="col-md-12">
                @if ($mhs_temps->where('check', 'Valid')->count() != null)
                    <a class="btn btn-outline-primary float-end mb-1 btn-sm "onClick="return confirm('Semua data yang disimpan hanya data Valid. Apakah sudah yakin?')"
                        href="{{ route('mahasiswaimportsave') }}">Simpan<i class="bx bx-share"></i>
                    </a>
                @endif
                <a class="btn btn-outline-danger mb-1 float-end btn-sm"
                    onClick="return confirm('Yakin akan menghapus import?')"
                    href="{{ route('mahasiswaimportbatal') }}">
                    Hapus</i>
                </a>
                <div id="search" class="text-align =center">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="card p-4">
                    <div class="table-responsive text-nowrap">
                        <table class="datatable table py-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pendaftaran</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
                                    <th>Prodi</th>
                                    <th>Jalur</th>
                                    <th>Password</th>
                                    <th>Validasi</th>
                                    <th>Pesan Kesalahan</th>
                                    <th>Status Upload</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @php
                                    $row = 1;
                                @endphp
                                @foreach ($mhs_temps as $bt)
                                @php
                                    // Decode JSON string to array
                                    $eror_location = json_decode($bt->eror_location, true);
                                    $hasError = !empty($eror_location);
                                @endphp
                                    <tr>
                                        <td {!! $hasError ? "style='background-color: rgb(255, 0, 0); color: white; font-weight: bold'" : '' !!}>{{ $loop->iteration }}</td>
                                        <td {!! in_array('(NO PENDAFTARAN TIDAK BOLEH KOSONG)', $eror_location) || in_array('(DUPLIKAT DATA)', $eror_location) || in_array('(NO PENDAFTARAN SUDAH DIGUNAKAN)', $eror_location) ? "style='background-color: rgb(255, 0, 0); color: white;font-weight: bold'" : '' !!}>{{ $bt->id_temps }}</td>
                                        <td {!! in_array('(NAMA TIDAK BOLEH KOSONG)', $eror_location) ? "style='background-color: rgb(255, 0, 0); color: white; font-weight: bold;'" : '' !!}>{{ $bt->nama_temps }}</td>
                                        <td {!! in_array('(JENIS KELAMIN TIDAK BOLEH KOSONG)', $eror_location) || in_array('(JENIS KELAMIN TIDAK VALID)', $eror_location) ? "style='background-color: rgb(255, 0, 0); color: white;'" : '' !!}>{{ $bt->jenis_kelamin_temps }}</td>
                                        <td {!! in_array('(NO TELEPON TIDAK BOLEH KOSONG)', $eror_location) || in_array('(NO TELEPON HARUS ANGKA)', $eror_location) ? "style='background-color: rgb(255, 0, 0); color: white;'" : '' !!}>{{ $bt->no_telepon_temps }}</td>
                                        <td {!! in_array('(ALAMAT TIDAK BOLEH KOSONG)', $eror_location) ? "style='background-color:rgb(255, 0, 0); color: white;'" : '' !!}>{{ $bt->alamat_temps }}</td>
                                        <td {!! in_array('(PRODI TIDAK BOLEH KOSONG)', $eror_location) || in_array('(PRODI TIDAK VALID)', $eror_location) ? "style='background-color: rgb(255, 0, 0); color: white;'" : '' !!}>{{ $bt->prodi_id_temps }}</td>
                                        <td {!! in_array('(JALUR TIDAK BOLEH KOSONG)', $eror_location) ? "style='background-color: rgba(255, 0, 0, 0.945); color: white;'" : '' !!}>{{ $bt->jalur_temps }}</td>
                                        <td {!! in_array('(PASSWORD TIDAK BOLEH KOSONG)', $eror_location) || in_array('(PASSWORD HARUS 8 ANGKA)', $eror_location) ? "style='background-color: rgb(255, 0, 0); color: white;'" : '' !!}>{{ $bt->password_temps }}</td>
                                        <td>{{ $bt->check }}</td>
                                        <td>{{ $bt->eror_location }}</td>
                                        <td>{{ $bt->status_upload }}</td>
                                    </tr>
                                    @php
                                        $row++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
        </form>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('.datatable').DataTable({});
            table.columns(9).every(function() {
                var column = this;
                var select = $(
                        '<select class="form-select"><option value="" selected>--Tampilkan Semua Data--</option></select>'
                    )
                    .appendTo($('#search').empty())
                    .appendTo($('#search').empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                select.append('<option value="Valid">Valid</option>')
                    .append('<option value="Tidak Valid">Tidak Valid</option>');
            });
        });
    </script>
@endsection
