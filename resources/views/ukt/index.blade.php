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
    </style>
    <div class="row">
        @if (Auth::guard('admin')->check())
            <div class="col-md-6">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data UKT Mahasiswa</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin' && (isset($dataExists) && $dataExists))
                    <a id="search" class="text-align =center"></a><br>
                @endif
            </div>
            <div class="col-md-6 text-end m-auto">
                <div class="col-md-12 mb-5">
                    @if (isset($dataExists) && $dataExists)
                        <a href="{{ route('datauktexport') }}"
                            class="btn btn-outline-success float-end mb-1 btn-sm">Export</a>
                        <a href="{{ route('admin.data-ukt.printukt') }}"
                            class="btn btn-outline-secondary float-end mb-1 btn-sm">Print</a>
                        <!-- Tombol Arsipkan -->
                        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
                            <button id="arsipkan" class="btn btn-outline-secondary float-end mb-1 btn-sm"
                                data-toggle="modal" data-target="#arsipModal" disabled>Arsipkan</button>

                            <!-- Modal Arsip -->
                            <div class="modal fade" id="arsipModal" tabindex="-1" role="dialog"
                                aria-labelledby="arsipModalLabel" aria-hidden="true"
                                style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p style="font-weight: bold;">Jumlah data yang dipilih: <span
                                                    id="jumlahDipilih">0</span></p>
                                            <form action="{{ route('admin.lulus-verifikasi.arsip') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <select name="id_folder" class="form-select" autofocus required>
                                                        <option value="" selected disabled>--Pilih Folder--</option>
                                                        @foreach ($folder as $fol)
                                                            <option value="{{ $fol->id }}">{{ $fol->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <input type="number" id="tahun_angkatan" name="tahun_angkatan"
                                                        class="form-control" placeholder="Masukkan Tahun Angkatan" required>
                                                    <input type="hidden" id="data_ids_input" name="data_ids[]">
                                                </div>
                                                <br>
                                                <button type="submit" id="arsipButton" class="btn btn-primary btn-sm">Arsipkan</button>
                                                <a class=" close btn btn-secondary btn-sm" type="button" data-dismiss="modal" style="color: white;">Kembali</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>
        @endif
    </div>
    </div>
    <div class="card p-4">
        <div class="table-responsive text-nowrap">
            <table class="datatable table py-3">
                <thead>
                    <tr>
                        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin' && (isset($dataExists) && $dataExists))
                            <th><input type="checkbox" id="centang_semua"></th>
                        @endif
                        <th>No</th>
                        <th>No.Pendaftaran</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Jenjang</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th>Verifikator</th>
                        <th>Golongan </th>
                        <th>Nominal</th>
                        <th>Jalur</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($berkas as $item)
                        <tr>
                            @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin' && (isset($dataExists) && $dataExists))
                                <td><input type="checkbox" class="centang_data" value="{{ $item->id }}"></td>
                            @endif
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mahasiswa->id }}</td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>{{ $item->mahasiswa->prodi->nama }}</td>
                            <td>{{ $item->mahasiswa->prodi->jenjang }}</td>
                            <td>{{ $item->mahasiswa->prodi->jurusan->nama }}</td>
                            <td>
                                @if ($item->status == 'Menunggu Verifikasi')
                                    <span class="badge bg-label-warning rounded">{{ $item->status }}</span>
                                @elseif($item->status == 'Belum Lengkap')
                                    <span class="badge bg-label-danger rounded">{{ $item->status }}</span>
                                @else
                                    <span class="badge bg-label-primary rounded">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->admin_id == null)
                                    -
                                @else
                                    {{ $item->admin->nama }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap' || $item->golongan_id == null)
                                    -
                                @else
                                    {{ $item->golongan->nama }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap' || $item->golongan_id == null)
                                    -
                                @else
                                    Rp {{ number_format($item->nominal_ukt, 0, ',', '.') }}
                                @endif
                            </td>
                            <td>{{ $item->mahasiswa->jalur }}</td>
                            <td>
                                @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.data-ukt.edit', $item->id) }}">Verifikasi</a>
                                @elseif ($item->status == 'Lulus Verifikasi')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.data-ukt.edit', $item->id) }}">Detail</a>
                                    <a class="btn btn-xs btn-secondary"
                                        href="{{ route('admin.data-ukt.print', $item->id) }}">Print</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@elseif (Auth::guard('mahasiswa')->check())
    <div class="col-md-6">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data Kriteria Mahasiswa</h4>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>
    @if ($berkas->status == 'Lulus Verifikasi')
        <div class="col-md-12 mb-5">
            <a href="{{ route('data-ukt.print') }}" target="_blank"
                class="btn btn-outline-secondary float-end mb-1 btn-sm">Print</a>
        </div>
    @endif
    <div class="col-md-6 text-end m-auto">
        @if ($berkas->status == 'Belum Lengkap' || $berkas->status == 'Menunggu Verifikasi')
            <a href="{{ route('data-ukt.edit', $berkas->id) }}" class="btn btn-outline-primary float-end mb-1 ">Edit
                Data</a>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless w-75">
                    <tr>
                        <th>Status</th>
                        <td>:</td>
                        <td>
                            @if ($berkas->status == 'Menunggu Verifikasi')
                                <span class="badge bg-label-warning rounded">{{ $berkas->status }}</span>
                            @elseif($berkas->status == 'Belum Lengkap')
                                <span class="badge bg-label-danger rounded">{{ $berkas->status }}</span>
                            @else
                                <span class="badge bg-label-primary rounded">{{ $berkas->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @if ($berkas->status == 'Belum Lengkap')
                        <tr>
                            <th>Keterangan</th>
                            <td>:</td>
                            <td> <span class="text-danger">{{ $berkas->keterangan }} !</span></td>
                    @endif
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless w-75">
                        <tr>
                            @foreach ($penilaians as $data => $nilai)
                                @foreach ($nilai as $data)
                        <tr>
                            <th>{{ $data->kriteria->nama }}</th>
                            <td>:</td>
                            <td>{{ $data->subkriteria->nama }}</td>
                        </tr>
                        @endforeach
                        @endforeach

                        <tr>
                            <th>Foto Tempat Tinggal</th>
                            <td>:</td>
                            <td><img src="{{ asset('foto_tempat_tinggal/' . $berkas->foto_tempat_tinggal) }}"
                                    class="rounded img-fluid" width="250px"></td>
                        </tr>
                        <tr>
                            <th>Foto Slip Gaji</th>
                            <td>:</td>
                            <td><img src="{{ asset('foto_slip_gaji/' . $berkas->foto_slip_gaji) }}"
                                    class="rounded img-fluid" width="250px"></td>
                        </tr>
                        <tr>
                            <th>Foto Daya Listrik</th>
                            <td>:</td>
                            <td><img src="{{ asset('foto_daya_listrik/' . $berkas->foto_daya_listrik) }}"
                                    class="rounded img-fluid" width="250px"></td>
                        </tr>
                        @if ($berkas->foto_kendaraan === null || $berkas->foto_kendaraan === '')
                        @else
                            <tr>
                                <th>Foto Kendaraan</th>
                                <td>:</td>
                                <td><img src="{{ asset('foto_kendaraan/' . $berkas->foto_kendaraan) }}"
                                        class="rounded img-fluid" width="250px"></td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('.datatable').DataTable({});
            table.columns(11).every(function() {
                var column = this;
                var uniqueValues = column.data().unique().sort().toArray();
                var maxWidth = 0;
                $.each(uniqueValues, function(index, value) {
                    var tempSpan = $('<span style="visibility:hidden;white-space:nowrap;">' +
                        value + '</span>').appendTo('body');
                    maxWidth = Math.max(maxWidth, tempSpan.width());
                    tempSpan.remove();
                });

                var select = $(
                        '<select class="form-select" id="jalur_pendaftaran"><option value="" disabled selected>--Pilih Jalur Pendaftaran--</option></select>'
                    )
                    .css('min-width', maxWidth + 'px')
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                        if (val) {
                            $('.centang_data').prop('checked', false);
                            $('.centang_data[data-jalur="' + val + '"]').prop('checked', true);
                            $('#centang_semua').prop('checked', $('.centang_data').length === $(
                                '.centang_data:checked').length);
                            updateJumlahArsipkan();
                        }
                    });

                $.each(uniqueValues, function(index, value) {
                    select.append('<option value="' + value + '">' + value + '</option>');
                });

                $('#search').append(select);
            });

            $('#centang_semua').on('change', function() {
                $('.centang_data').prop('checked', $(this).prop('checked'));
                updateJumlahArsipkan();
            });

            $('.centang_data').on('change', function() {
                var semua_tercentang = true;
                $('.centang_data').each(function() {
                    if (!$(this).prop('checked')) {
                        semua_tercentang = false;
                    }
                });
                $('#centang_semua').prop('checked', semua_tercentang);
                updateJumlahArsipkan();
            });

            $('#arsipkan').on('click', function() {
                var ada_tercentang = $('.centang_data:checked').length > 0;
                if (!ada_tercentang) {
                    // Tidak melakukan apa-apa jika tidak ada data yang dipilih
                    return;
                }
            });

            $('#arsipButton').on('click', function() {
                var data_ids = [];
                $('.centang_data:checked').each(function() {
                    data_ids.push($(this).val());
                });
                $('#data_ids_input').val(data_ids);
            });

            function updateJumlahArsipkan() {
                var jumlah_dipilih = $('.centang_data:checked').length;
                $('#jumlahDipilih').text(jumlah_dipilih);
                $('#arsipkan').prop('disabled', jumlah_dipilih === 0);
            }
        });
    </script>
@endsection
