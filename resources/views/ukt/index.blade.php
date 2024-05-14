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
            </div>
            <div class="col-md-6 text-end m-auto">
                <form action="{{ route('admin.data-ukt.hapussemua') }}" method="POST" id="deleteForm">
                    @csrf
                    <input type="hidden" id="data_ids_input" name="ids[]">
                    <button type="submit" id="hapus" class="btn btn-outline-danger float-end  mb-1 btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                </form>
            </div>
    </div>
    <div class="card p-4">
        <div class="table-responsive text-nowrap">
            <table class="datatable table py-3">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="centang_semua"></th>
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
                            <td><input type="checkbox" class="centang_data" name="ids[]" value="{{ $item->id }}"></td>
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
    <div class="col-md-6 text-end m-auto">
        <a href="{{ route('data-ukt.edit', $berkas->id) }}" class="btn btn-outline-primary float-end mb-1 ">Edit
            Data</a>
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
            $('#centang_semua').on('click', function() {
                $('.centang_data').prop('checked', this.checked);
            });

            $('.centang_data').on('click', function() {
                if (!$(this).prop('checked')) {
                    $('#centang_semua').prop('checked', false);
                } else {
                    if ($('.centang_data:checked').length === $('.centang_data').length) {
                        $('#centang_semua').prop('checked', true);
                    }
                }
            });
        });
        $('#hapus').on('click', function(e) {
                e.preventDefault();
                var ids = [];
                $('.centang_data:checked').each(function() {
                    ids.push($(this).val());
                });
                $('#data_ids_input').val(ids);

                if (ids.length === 0) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                    $('#deleteForm').submit(); // Submit formulir setelah mengatur nilai input tersembunyi
                }
    });

</script>
@endsection
