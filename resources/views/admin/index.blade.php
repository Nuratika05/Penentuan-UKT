@extends('layouts.app')

@section('content')
<style>
    .alert-success {
    color: #005700; /* Warna hijau tua untuk teks */
    background-color: #DFF0D8; /* Warna latar belakang hijau muda yang sesuai dengan kelas alert-success bawaan Bootstrap */
    border-color: #005700; /* Warna border yang sesuai */
}
</style>
<div class="row">
    <div class="col-md-6">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data Admin</h4>
        @if (Session::has('success'))
         <div class="alert alert-success" role="alert">
        {{ Session::get('success') }} </div>
        @elseif (Session::has('error'))
         <div class="alert alert-danger" role="alert">
        {{ Session::get('error') }}</div>
        @endif
    </div>
    <div class="col-md-6 text-end m-auto">
        <a href="{{ route('admin.create') }}" class="btn btn-outline-primary float-end mb-1 btn-sm">Tambah Data</a>
    </div>
</div>
<div class="card p-4">
    <div class="table-responsive text-nowrap">
        <table class="datatable table py-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($admin as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role }}</td>
                    <td>
                    @if ( $item->jurusan_id === null || $item->jurusan_id === '')
                    -
                    @else
                    {{ $item->jurusan->nama }}
                    @endif
                    </td>
                    <td>
                        <a class="btn btn-xs btn-warning" href="{{ route('admin.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('admin.destroy', $item->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
