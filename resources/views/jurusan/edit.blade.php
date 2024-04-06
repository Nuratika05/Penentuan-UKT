@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Data Jurusan</h4>
<div class="card">
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
                <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Jurusan</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $jurusan->nama }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin mengubah data?')">Ubah Data</button>
                    <a class="btn btn-secondary btn-sm" type="button" href="{{ route('jurusan.index') }}">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

