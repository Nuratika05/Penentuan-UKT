@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Folder Arsip</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error )
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif
<div class="card">
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
                  <form action="{{ route('arsip.update', $folder->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Folder Arsip</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" autofocus value="{{ $folder->nama }}">
                        @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin mengubah folder?')">Ubah Folder</button>
                    <a class="btn btn-secondary btn-sm" type="button" href="{{ route('arsip.index') }}">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

