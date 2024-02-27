@extends('layouts.app')

@section('content')
<style>
    .alert-success {
    color: #005700; /* Warna hijau tua untuk teks */
    background-color: #DFF0D8; /* Warna latar belakang hijau muda yang sesuai dengan kelas alert-success bawaan Bootstrap */
    border-color: #005700; /* Warna border yang sesuai */
}
</style>
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Tambah Data Golongan</h4>
@if (Session::has('success'))
         <div class="alert alert-success" role="alert">
        {{ Session::get('success') }} </div>
        @endif
<div class="card">
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
                <form action="{{ route('golongan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Golongan</label>
                        <input type="text" name="nama" id="nama" class="form-control" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label for="jenjang">Jenjang</label>
                        <select name="jenjang" id="jenjang" class="form-select" required>
                            <option value="">-- Pilih Jenjang --</option>
                            <option value="D3">D3</option>
                            <option value="D4/S1 Terapan">D4/S1 Terapan</option>
                            <option value="D4/S1 Terapan">S1 Terapan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_minimal" class="form-label">Nilai Minimal</label>
                        <input type="number" name="nilai_minimal" id="nilai_minimal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_maksimal" class="form-label">Nilai Maksimal</label>
                        <input type="number" name="nilai_maksimal" id="nilai_maksimal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm" onClick="return confirm('Yakin data yang dimasukkan sudah benar?')">Tambah</button>
                    <a class="btn btn-secondary btn-sm" type="button" href="{{ route('golongan.index') }}">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

