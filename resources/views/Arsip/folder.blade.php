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
            <div class="col-md-6">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Data Mahasiswa</h4>
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
                        <a href="{{ route('admin.data-ukt.printukt') }}" class="btn btn-sm btn-secondary">Print</a>
                    @endif
                </div>
            </div>
            <div class="card p-4">
                <div class="table-responsive text-nowrap">
                    <table class="datatable table py-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Folder</th>
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
                              @foreach ($arsip as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->folder->nama }}</td>
                                    <td>{{ $item->no_pendaftaran }}</td>
                                    <td>{{ $item->nama_mahasiswa }}</td>
                                    <td>{{ $item->nama_prodi }}</td>
                                    <td>{{ $item->nama_jurusan }}</td>
                                    <td>
                                        @if ($item->status == 'Menunggu Verifikasi')
                                            <span class="badge bg-label-warning rounded">{{ $item->status }}</span>
                                        @elseif ($item->status == 'Belum Lengkap')
                                            <span class="badge bg-label-danger rounded">{{ $item->status }}</span>
                                        @else
                                            <span class="badge bg-label-primary rounded">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->admin == null)
                                            -
                                        @else
                                            {{ $item->admin }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap' || $item->golongan_id == null)
                                            -
                                        @else
                                            {{ $item->nama_golongan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap' || $item->nama_golongan == null)
                                            -
                                        @else
                                            Rp{{ number_format($item->nominal) }}
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="#">Detail</a>
                                        @if ($item->status == 'Lengkap')
                                            <a class="btn btn-sm btn-secondary"
                                                href="#">Print</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection
