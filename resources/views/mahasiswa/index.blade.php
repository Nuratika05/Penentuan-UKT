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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data Mahasiswa</h4>
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
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            <a href="{{ route('mahasiswaimport') }}" class="btn btn-success btn-sm">Import</a>
            <a href="{{ route('mahasiswaexport') }}" class="btn btn-sm btn-warning" onClick="return confirm('Yakin akan melakukan export?')">Export</a>
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
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Prodi </th>
                        <th>Jenjang</th>
                        <th>Jurusan </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($mahasiswa as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->no_telepon }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->prodi->nama }}</td>
                            <td>{{ $item->prodi->jenjang }}</td>
                            <td>{{ $item->prodi->jurusan->nama }}</td>
                            {{-- @php dd($item); // Gunakan dd() di luar tag HTML untuk debugging
                            @endphp --}}
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('mahasiswa.edit', $item->id) }}">Edit</a>
                                <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


