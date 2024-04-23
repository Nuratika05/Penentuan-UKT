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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Tambah Data Sub Kriteria</h4>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }} </div>
    @endif
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card-body">
                    <form action="{{ route('sub-kriteria.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kriteria">Kriteria</label>
                            <select name="kriteria_id" id="kriteria" class="form-select" autofocus required>
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach ($kriterias as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Sub Kriteria</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" name="nilai" id="nilai" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"
                            onClick="return confirm('Yakin data yang dimasukkan sudah benar?')">Tambah</button>
                        <a class="btn btn-secondary btn-sm" type="button"
                            href="{{ route('sub-kriteria.index') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
