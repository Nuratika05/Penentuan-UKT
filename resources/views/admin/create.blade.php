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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Tambah Data Admin</h4>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }} </div>
    @endif
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
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <div class="mb-3" autocomplete="off">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ old('nama') }}" autofocus required>
                        </div>

                        <div class="mb-3" autocomplete="off">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3" autocomplete="off">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-select" value="{{ old('role') }}" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin
                                </option>
                                <option value="verifikator" {{ old('role') == 'verifikator' ? 'selected' : '' }}>Verifikator
                                </option>
                            </select>
                        </div>
                        <div class="mb-3" id="jurusan_id">
                            <label for="jurusan">Jurusan </label>
                            <select name="jurusan_id" id="jurusan" class="form-select" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusans as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('jurusan_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" autocomplete="off">
                            <label for="password" class="form-label">Password</label>
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
                            onClick="return confirm('Yakin data yang dimasukkan sudah benar?')">Tambah</button>
                        <a class="btn btn-secondary btn-sm" type="button" href="{{ route('admin.index') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script {{-- if onchange status belum lengkap append tr textarea keterangan --}}>
        $(document).ready(function() {
            $('#role').on('change', function() {
                if (this.value == 'verifikator') {
                    $('#jurusan_id').show();
                } else {
                    $('#jurusan_id').hide();
                }
            });
            if ($('#role').val() == 'verifikator') {
                $('#jurusan').show();
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
