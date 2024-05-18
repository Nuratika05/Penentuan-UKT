@extends('layouts.app')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Data Admin</h4>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
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
                            <input type="text" name="nama" id="nama" class="form-control" autofocus
                                value="{{ old('nama', $admin->nama) }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $admin->email) }}">
                        </div>

                        <div class="mb-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="superadmin"
                                    {{ old('superadmin', $admin->role) == 'superadmin' ? 'selected' : '' }}>Super Admin
                                </option>
                                <option value="verifikator"
                                    {{ old('verifikator', $admin->role) == 'verifikator' ? 'selected' : '' }}>Verifikator
                                </option>
                            </select>
                        </div>
                        <div class="mb-3" id="jurusan_id">
                            <label for="jurusan">Jurusan </label>
                            <select name="jurusan_id" id="jurusan" class="form-select" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusans as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('jurusan_id', $admin->jurusan_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label><span class="text-danger"
                                style="font-size: 10px;"><i> *Abaikan jika tidak ingin mengubah password</i></span>
                            <div class="input-group">
                                <input type="password" name="password" id="password" maxlength="40"
                                    class="form-control @error('password') is-invalid @enderror">
                                <button type="button" id="showPasswordBtn" class="btn btn-outline-secondary"><i
                                        id="showPasswordIcon" class="bx bx-hide"></i></button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm"
                            onClick="return confirm('Yakin ingin mengubah data?')">Ubah Data</button>
                        <a class="btn btn-secondary btn-sm" type="button" href="{{ route('admin.index') }}">Kembali</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script {{-- if onchange status belum lengkap append tr textarea keterangan --}}>
        if ($('#role').val() == 'superadmin') {
            $('#jurusan_id').hide();
        }

        // Atur event listener untuk perubahan pada select dengan id 'role'
        $('#role').on('change', function() {
            // Periksa nilai yang dipilih pada select 'role'
            if (this.value == 'superadmin') {
                // Jika role adalah superadmin, sembunyikan kolom jurusan
                $('#jurusan_id').hide();
            } else {
                // Jika role bukan superadmin, tampilkan kolom jurusan
                $('#jurusan_id').show();
            }
        });
    </script>
    <script>
        document.getElementById('showPasswordBtn').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var passwordIcon = document.getElementById('showPasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bx-hide');
                passwordIcon.classList.add('bx-show');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bx-show');
                passwordIcon.classList.add('bx-hide');
            }
        });
    </script>
@endpush
