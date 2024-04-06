@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Data Sub Kriteria</h4>
<div class="card">
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
                <form action="{{ route('sub-kriteria.update', $subkriteria->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kriteria">Kriteria</label>
                        <select name="kriteria_id" id="kriteria" class="form-select">
                            @foreach($kriterias as $item)
                                <option value="{{ $item->id }}" {{ $subkriteria->kriteria_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Sub Kriteria</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $subkriteria->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <input type="number" name="nilai" id="nilai" class="form-control" value="{{$subkriteria->nilai}}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"onClick="return confirm('Yakin ingin mengubah data?')">Ubah Data</button>
                    <a class="btn btn-secondary btn-sm" type="button" href="{{ route('sub-kriteria.index') }}">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

