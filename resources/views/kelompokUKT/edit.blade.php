@extends('layouts.app')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Data Kelompok UKT</h4>
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card-body">
                    <form action="{{ route('kelompokUKT.update', $kelompokUKT->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="prodi_id">Prodi</label>
                            <select name="prodi_id" id="prodi_id" class="form-select" autofocus required>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $kelompokUKT->prodi_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}/{{ $item->jenjang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kategori1" class="form-label">Kategori I</label>
                            <input type="number" name="kategori1" id="kategori1" class="form-control"
                                value="{{ $kelompokUKT->kategori1 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori2" class="form-label">Kategori II</label>
                            <input type="number" name="kategori2" id="kategori2" class="form-control"
                                value="{{ $kelompokUKT->kategori2 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori3" class="form-label">Kategori III</label>
                            <input type="number" name="kategori3" id="kategori3" class="form-control"
                                value="{{ $kelompokUKT->kategori3 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori4" class="form-label">Kategori IV</label>
                            <input type="number" name="kategori4" id="kategori4" class="form-control"
                                value="{{ $kelompokUKT->kategori4 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori5" class="form-label">Kategori V</label>
                            <input type="number" name="kategori5" id="kategori5" class="form-control"
                                value="{{ $kelompokUKT->kategori5 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori6" class="form-label">Kategori VI</label>
                            <input type="number" name="kategori6" id="kategori6" class="form-control"
                                value="{{ $kelompokUKT->kategori6 }}" required>

                            <div class="mb-3">
                                <label for="kategori7" class="form-label">Kategori VII</label>
                                <input type="number" name="kategori7" id="kategori7" class="form-control"
                                    value="{{ $kelompokUKT->kategori7 }}" required>
                            </div>
                            <button type="submit"
                                class="btn btn-primary btn-sm"onClick="return confirm('Yakin ingin mengubah data?')">Ubah
                                Data</button>
                            <a class="btn btn-secondary btn-sm" type="button"
                                href="{{ route('kelompokUKT.index') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
