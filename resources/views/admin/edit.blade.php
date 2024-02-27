@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Data Admin</h4>
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
                <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" autofocus value="{{ old("nama", $admin->nama) }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{old('email', $admin->email )}}">
                    </div>

                    <div class="mb-3">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-select">
                            <option value="superadmin" {{ old('superadmin', $admin->role ) == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="verifikator" {{ old('verifikator',$admin->role ) == 'verifikator' ? 'selected' : '' }}>Verifikator</option>
                        </select>
                    </div>
                    @if ($admin->jurusan_id === null || $admin->jurusan_id === '')
                    @else
                    <div class="mb-3" id="jurusan_id">
                        <label for="jurusan">Jurusan </label>
                        <select name="jurusan_id" id="jurusan" class="form-select" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach($jurusans as $item)
                            <option value="{{ $item->id }}" {{ old('jurusan_id', $admin->jurusan_id) ==  $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label><span
                        class="text-danger" style="font-size: 10px;"><i> *Kosongkan jika tidak ingin mengubah password</i></span>
                        <input type="password" name="password" id="password" maxlength="20" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin mengubah data?')">Ubah Data</button>
                    <a class="btn btn-secondary btn-sm" type="button" href="{{ route('admin.index') }}">Kembali</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script
    {{-- if onchange status belum lengkap append tr textarea keterangan --}}>
        $(document).ready(function() {
            $('#role').on('change', function() {
                if (this.value == 'verifikator') {
                    $('#jurusan_id').append();
                } else {
                    $('#jurusan_id').empty();
                }
            });
            if ($('#role').val() == 'verifikator') {
                $('#jurusan').append();
            }
        });
    </script>
@endpush
