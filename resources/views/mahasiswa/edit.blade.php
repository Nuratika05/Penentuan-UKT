@extends('layouts.app')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Data Mahasiswa</h4>
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
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mahasiwa</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ old('nama', $mahasiswa->nama) }}" autofocus required>
                        </div>

                        <div class="mb-3">
                            <label for="id" class="form-label">No.Pendaftaran</label>
                            <input type="text" name="id" id="id"
                                class="form-control @error('id') is-invalid @enderror"
                                value="{{ old('id', $mahasiswa->id) }}" required>
                            @error('id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis kelamin" class="form-select" required>
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">No. Telepon</label>
                            <input type="tel" name="no_telepon" id="no_telepon" class="form-control"
                                value="{{ old('no_telepon', $mahasiswa->no_telepon) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="5" class="form-control" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select name="prodi_id" id="prodi" class="form-select" required>
                                @foreach ($prodis as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('prodi_id', $mahasiswa->prodi_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}-{{ $item->jenjang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jalur" class="form-label">Jalur Pendaftaran</label>
                            <input type="text" name="jalur" id="jalur" class="form-control"
                                value="{{ old('jalur', $mahasiswa->jalur) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label><span class="text-danger"
                                style="font-size: 10px;"><i> *Abaikan jika tidak ingin mengubah password</i></span>
                            <div class="input-group">
                                <input type="password" name="password" id="password" maxlength="8"
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
                        <button type="submit"
                            class="btn btn-primary btn-sm"onClick="return confirm('Yakin ingin mengubah data?')">Ubah
                            Data</button>
                        <a class="btn btn-secondary btn-sm" type="button"
                            href="{{ route('mahasiswa.index') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

@endsection
