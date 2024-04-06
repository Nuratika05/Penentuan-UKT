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
                        <select name="nama" id="nama" class="form-select" autofocus required>
                            <option value="">--Pilih Golongan--</option>
                            <option value="Kategori I">Kategori I</option>
                            <option value="Kategori II">Kategori II</option>
                            <option value="Kategori III">Kategori III</option>
                            <option value="Kategori IV">Kategori IV</option>
                            <option value="Kategori V">Kategori V</option>
                            <option value="Kategori VI">Kategori VI</option>
                            <option value="Kategori VII">Kategori VII</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_minimal" class="form-label">Nilai Min</label>
                        <input type="number" name="nilai_minimal" id="nilai_minimal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_maksimal" class="form-label">Nilai Max</label>
                        <input type="number" name="nilai_maksimal" id="nilai_maksimal" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" onClick="return confirm('Yakin data yang dimasukkan sudah benar?')">Tambah</button>
                    <a class="btn btn-secondary btn-sm" type="button" href="{{ route('golongan.index') }}">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

