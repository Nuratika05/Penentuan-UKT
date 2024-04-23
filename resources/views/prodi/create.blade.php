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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Tambah Data Prodi</h4>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }} </div>
    @endif
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card-body">
                    <form action="{{ route('prodi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Prodi</label>
                            <input type="text" name="nama" id="nama" class="form-control" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan">Jurusan </label>
                            <select name="jurusan_id" id="jurusan" class="form-select" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusans as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenjang">Jenjang</label>
                            <select name="jenjang" id="jenjang" class="form-select" required>
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1 Terapan">S1 Terapan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm" class="btn btn-primary"
                            onClick="return confirm('Yakin data yang dimasukkan sudah benar?')">Tambah</button>
                        <a class="btn btn-secondary btn-sm" type="button" href="{{ route('prodi.index') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
