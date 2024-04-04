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
                <a class="btn btn-secondary btn-sm" type="close" href="{{ route('arsip.index') }}">kembali</a><br>
                <br>
            </div>
            <div class="col-md-6 text-end m-auto">
                <div class="col-md-12 mb-5">
                    <a href="{{ route('arsip.export', $folder->id)}}" class="btn btn-outline-success float-end mb-1 btn-sm"
                        onClick="return confirm('Yakin akan melakukan export?')">Export</a>
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
                                <th>Jenjang</th>
                                <th>Jurusan</th>
                                <th>Golongan </th>
                                <th>Nominal </th>
                                <th>Angkatan </th>
                                <th>Jalur Pendaftaran</th>
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
                                    <td>{{ $item->jenjang }}</td>
                                    <td>{{ $item->nama_jurusan }}</td>
                                    <td>{{ $item->nama_golongan }}</td>
                                    <td>Rp{{ number_format($item->nominal) }}</td>
                                    <td>{{ $item->tahun_angkatan }}</td>
                                    <td>{{ $item->jalur }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('arsip.detail', $item->id) }}">Detail</a>
                                            <a class="btn btn-xs btn-secondary"
                                                href="{{ route('arsip.print', $item->id) }}">Print</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection
