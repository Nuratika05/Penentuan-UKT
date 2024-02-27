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
                        <label for="nama" class="form-label">Nama Golongan</label>
                        <input type="text" name="nama" id="nama" class="form-control" autofocus value="{{ $golongan->nama }}">
                    </div>

                    <div class="mb-3">
                        <label for="jenjang">Jenjang</label>
                        <select name="jenjang" id="jenjang" class="form-select">
                            <option value="D3" {{ $golongan->jenjang == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="D4/S1 Terapan" {{ $golongan->jenjang == 'D4/S1 Terapan' ? 'selected' : '' }}>D4/S1 Terapan</option>
                            <option value="S1 Terapan" {{ $golongan->jenjang == 'S1 Terapan' ? 'selected' : '' }}>S1 Terapan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nilai_minimal" class="form-label">Nilai Minimal</label>
                        <input type="number" name="nilai_minimal" id="nilai_minimal" class="form-control" value={{ $golongan->nilai_minimal }}>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_maksimal" class="form-label">Nilai Maksimal</label>
                        <input type="number" name="nilai_maksimal" id="nilai_maksimal" class="form-control" value={{ $golongan->nilai_maksimal }}>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" value={{ $golongan->nominal }}>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin mengubah data?')">Ubah Data</button>
                    <a class="btn btn-secondary btn-sm" type="button" href="{{ route('golongan.index') }}">Kembali</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

