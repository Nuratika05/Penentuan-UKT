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
            @endif
        </div>
            <div class="col-md-12 mb-8">
                <a href="{{ route('arsip.create') }}" class="btn btn-sm btn-primary">Tambah Folder</a>
            </div>
        </div>
            <div class="card p-4">
                    <table class="table">
                        <tr>
                            <th>Folder</th>
                            <th>Aksi</th>
                        </tr>
                            @foreach ($folder as $fol)
                        <tr>
                            <td>
                                <a href="{{ route('admin.folderArsip') }}"> {{ $fol->nama }} </a></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('arsip.edit', $fol->id) }}">Edit</a>
                                <form action="{{ route('arsip.destroy', $fol->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus folder ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
