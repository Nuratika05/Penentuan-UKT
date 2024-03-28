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
                @endif
            </div>
            <div class="col-md-6 text-end m-auto">
                <div class="col-md-12 mb-5">
                    @if (isset($dataExists) && $dataExists)
                        <a href="{{ route('datauktexport') }}" class="btn btn-sm btn-success"
                            onClick="return confirm('Yakin akan melakukan export?')">Export</a>
                            @if (Auth::guard('admin')->check() && Auth::user()->role == 'verifikator')
                        <a href="{{ route('admin.data-ukt.printukt') }}" class="btn btn-sm btn-secondary">Print</a>
                    @endif
                        <!-- Tombol Arsipkan -->
                        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
                          <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#arsipModal">Arsipkan</button>

                        <!-- Modal Arsip -->
                        <div class="modal fade" id="arsipModal" tabindex="-1" role="dialog" aria-labelledby="arsipModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="arsipModalLabel">Pilih Folder Arsip</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.data-ukt.arsip') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Pilih Folder:</label>
                                                <select name="id" class="form-control">
                                                    @foreach ($folder as $fol)
                                                        <option value="{{ $fol->id }}">{{ $fol->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="id" value="#">
                                            <button type="submit" class="btn btn-primary">Arsipkan</button>
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
                                <th>No</th>
                                <th>No.Pendaftaran</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Jurusan</th>
                                <th>Status</th>
                                <th>Verifikator</th>
                                <th>Golongan </th>
                                <th>Nominal </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($berkas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->id }}</td>
                                    <td>{{ $item->mahasiswa->nama }}</td>
                                    <td>{{ $item->mahasiswa->prodi->nama }}</td>
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
                                            {{ $item->golongan->nama }} - {{ $item->mahasiswa->prodi->jenjang }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap' || $item->golongan_id == null)
                                            -
                                        @else
                                            Rp{{ number_format($item->golongan->nominal) }}
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.data-ukt.edit', $item->id) }}">Detail</a>
                                        @if ($item->status == 'Lengkap')
                                            <a class="btn btn-sm btn-secondary"
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
            @if ($berkas->status == 'Lengkap')
                <div class="col-md-12 mb-5">
                    <a href="{{ route('data-ukt.print') }}" target="_blank" class="btn btn-secondary">Print</a>
                </div>
            @endif
            <div class="col-md-6 text-end m-auto">
                @if ($berkas->status == 'Belum Lengkap' || $berkas->status == 'Menunggu Verifikasi')
                    <a href="{{ route('data-ukt.edit', $berkas->id) }}" class="btn btn-primary">Edit Kriteria</a>
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
                                    {{-- @php
                        dd($penilaians->first()->first()->subkriteria->nama);
                    @endphp --}}
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
            <td><img src="{{ asset('foto_tempat_tinggal/' . $berkas->foto_tempat_tinggal) }}" class="rounded img-fluid"
                    width="250px"></td>
        </tr>
        <tr>
            <th>Foto Slip Gaji</th>
            <td>:</td>
            <td><img src="{{ asset('foto_slip_gaji/' . $berkas->foto_slip_gaji) }}" class="rounded img-fluid"
                    width="250px"></td>
        </tr>
        <tr>
            <th>Foto Daya Listrik</th>
            <td>:</td>
            <td><img src="{{ asset('foto_daya_listrik/' . $berkas->foto_daya_listrik) }}" class="rounded img-fluid"
                    width="250px"></td>
        </tr>
        @if ($berkas->foto_kendaraan === null || $berkas->foto_kendaraan === '')
        @else
            <tr>
                <th>Foto Kendaraan</th>
                <td>:</td>
                <td><img src="{{ asset('foto_kendaraan/' . $berkas->foto_kendaraan) }}" class="rounded img-fluid"
                        width="250px"></td>
            </tr>
        @endif
        </table>
    </div>
    </div>
    </div>
    @endif
    </div>
@endsection
