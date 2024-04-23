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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Tambah Data Kelompok UKT</h4>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }} </div>
    @endif
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card-body">
                    <form action="{{ route('kelompokUKT.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="prodi_id">Prodi</label>
                            <select name="prodi_id" id="prodi" class="form-select" autofocus required>
                                <option value="">--Pilih Prodi/Jenjang--</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('prodi_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}/{{ $item->jenjang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kategori1" class="form-label">Kategori I</label>
                            <input type="number" name="kategori1" id="kategori1" class="form-control" required
                                value="{{ old('kategori1') }}" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori2" class="form-label">Kategori II</label>
                            <input type="number" name="kategori2" id="kategori2" class="form-control" required
                                value="{{ old('kategori2') }}" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori3" class="form-label">Kategori III</label>
                            <input type="number" name="kategori3" id="kategori3" class="form-control" required
                                value="{{ old('kategori3') }}" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori4" class="form-label">Kategori IV</label>
                            <input type="number" name="kategori4" id="kategori4" class="form-control" required
                                value="{{ old('kategori4') }}" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori5" class="form-label">Kategori V</label>
                            <input type="number" name="kategori5" id="kategori5" class="form-control" required
                                value="{{ old('kategori5') }}" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori6" class="form-label">Kategori VI</label>
                            <input type="number" name="kategori6" id="kategori6" class="form-control" required
                                value="{{ old('kategori6') }}" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori7" class="form-label">Kategori VII</label>
                            <input type="number" name="kategori7" id="kategori7" class="form-control" required
                                value="{{ old('kategori7') }}" autofocus required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm" class="btn btn-primary"
                            onClick="return confirm('Yakin data yang dimasukkan sudah benar?')">Tambah</button>
                        <a class="btn btn-secondary btn-sm" type="button"
                            href="{{ route('kelompokUKT.index') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
