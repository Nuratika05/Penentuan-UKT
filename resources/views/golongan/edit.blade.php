@extends('layouts.app')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Data Golongan</h4>
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card-body">
                    <form action="{{ route('golongan.update', $golongan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama">Nama Golongan</label>
                            <select name="nama" id="nama" class="form-select" autofocus required>
                                <option value="Kategori I" {{ $golongan->nama == 'Kategori I' ? 'selected' : '' }}>Kategori
                                    I</option>
                                <option value="Kategori II" {{ $golongan->nama == 'Kategori II' ? 'selected' : '' }}>
                                    Kategori II</option>
                                <option value="Kategori III" {{ $golongan->nama == 'Kategori III' ? 'selected' : '' }}>
                                    Kategori III</option>
                                <option value="Kategori IV" {{ $golongan->nama == 'Kategori IV' ? 'selected' : '' }}>
                                    Kategori IV</option>
                                <option value="Kategori V" {{ $golongan->nama == 'Kategori V' ? 'selected' : '' }}>Kategori
                                    V</option>
                                <option value="Kategori VI" {{ $golongan->nama == 'Kategori VI' ? 'selected' : '' }}>
                                    Kategori VI</option>
                                <option value="Kategori VII" {{ $golongan->nama == 'Kategori VII' ? 'selected' : '' }}>
                                    Kategori VII</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nilai_minimal" class="form-label">Nilai Min</label>
                            <input type="number" name="nilai_minimal" id="nilai_minimal" class="form-control" required
                                value={{ $golongan->nilai_minimal }}>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_maksimal" class="form-label">Nilai Max</label>
                            <input type="number" name="nilai_maksimal" id="nilai_maksimal" class="form-control" required
                                value={{ $golongan->nilai_maksimal }}>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"
                            onClick="return confirm('Yakin ingin mengubah data?')">Ubah Data</button>
                        <a class="btn btn-secondary btn-sm" type="button" href="{{ route('golongan.index') }}">Kembali</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
