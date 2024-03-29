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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Arsip Data UKT Mahasiswa</h4>
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
            <a href="{{ route('arsip.create') }}" class="btn btn-sm btn-primary">Tambah Folder</a>
        </div>
    </div>
    <div class="card p-4">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Folder</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($folder as $fol)
                        <tr>
                            <td class="menu-icon tf-icons bx bx-folder">
                                <a href="{{ route('admin.folderArsip', ['nama' => $fol->nama]) }}"> {{ $fol->nama }} </a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('arsip.edit', $fol->id) }}">Edit</a>
                                <form action="{{ route('arsip.destroy', $fol->id) }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus folder ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
