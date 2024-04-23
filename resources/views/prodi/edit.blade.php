@extends('layouts.app')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Data Prodi</h4>
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card-body">
                    <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Prodi</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ $prodi->nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="jurusan">Jurusan </label>
                            <select name="jurusan_id" id="jurusan" class="form-select">
                                @foreach ($jurusans as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $prodi->jurusan_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenjang">Jenjang</label>
                            <select name="jenjang" id="jenjang" class="form-select">
                                <option value="D3" {{ $prodi->jenjang == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ $prodi->jenjang == 'D4' ? 'selected' : '' }}>D4</option>
                                <option value="S1 Terapan" {{ $prodi->jenjang == 'S1 Terapan' ? 'selected' : '' }}>S1
                                    Terapan</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="btn btn-primary btn-sm"onClick="return confirm('Yakin ingin mengubah data?')">Ubah
                            Data</button>
                        <a class="btn btn-secondary btn-sm" type="button" href="{{ route('prodi.index') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
