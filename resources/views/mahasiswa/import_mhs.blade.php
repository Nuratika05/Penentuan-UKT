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
                            <input class="form-control" type="file" id="excel_upload" name="excel_upload" required>
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
                    <a class="btn btn-outline-primary float-end mb-1 "onClick="return confirm('Apakah sudah yakin?')"
                        href="{{ route('mahasiswaimportsave') }}">Kirim<i class="bx bx-share"></i>
                    </a>
                @endif
                <a class="btn btn-outline-danger mb-1 float-end"
                    onClick="return confirm('Yakin akan menghapus data import?')"
                    href="{{ route('mahasiswaimportbatal') }}">
                    Hapus Import</i>
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
                                    <tr {!! $bt->check == 'Tidak Valid' ? "style='background-color : goldenrod'" : '' !!}>
                                        <td>{{ $loop->iteration }}</td>
                                        <td {!! str_contains($bt->eror_location, 'A' . $row) ? "style='background-color: red'" : '' !!}>{{ $bt->id_temps }}</td>
                                        <td {!! str_contains($bt->eror_location, 'B' . $row) ? "style='background-color: red'" : '' !!}>{{ $bt->nama_temps }}</td>
                                        <td {!! str_contains($bt->eror_location, 'C' . $row) ? "style='background-color: red'" : '' !!}>{{ $bt->jenis_kelamin_temps }}</td>
                                        <td {!! str_contains($bt->eror_location, 'D' . $row) ? "style='background-color: red'" : '' !!}>{{ $bt->no_telepon_temps }}</td>
                                        <td {!! str_contains($bt->eror_location, 'E' . $row) ? "style='background-color: red'" : '' !!}>{{ $bt->alamat_temps }}</td>
                                        <td {!! str_contains($bt->eror_location, 'F' . $row) ? "style='background-color: red'" : '' !!}>{{ $bt->prodi->nama }}</td>
                                        <td {!! str_contains($bt->eror_location, 'G' . $row) ? "style='background-color: red'" : '' !!}>{{ $bt->password_temps }}</td>
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
        var table = $('.datatable').DataTable({
            // Pengaturan lainnya (jika diperlukan)
        });

        // Menambahkan dropdown filter ke kolom dengan indeks 4 (kolom "Check" diindeks sebagai 4)
        table.columns(8).every(function() {
            var column = this;
            var select = $(
                    '<select class="form-select"><option value="" disabled selected>--Pilih Validasi Data--</option></select>'
                    )
                .appendTo($('#search').empty())
                .appendTo($('#search').empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                });

            // Menambahkan opsi true dan false ke dropdown
            select.append('<option value="Valid">Valid</option>')
                .append('<option value="Tidak Valid">Tidak Valid</option>');
        });
    });
</script>
@endsection
