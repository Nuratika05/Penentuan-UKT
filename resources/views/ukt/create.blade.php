@extends('layouts.app')

@section('content')
<style>
    .hidden {
        display: none;
    }
</style>
    <h4 class="fw-bold"><span class="text-muted fw-light"></span> Tambah Data Kriteria UKT</h4>
    <span>Mohon untuk melengkapi data berikut dengan benar dan pastikan tidak ada data yang kosong sebelum di simpan!</span>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card-body">
                    <form action="{{ route('data-ukt.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_ayah" name="nama_ayah" class="form-label">Nama Ayah</label><span
                            class="text-danger" style="font-size: 15px;"><i> *wajib diisi</i></span>
                            <input type="text" id="nama_ayah" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" name="nama_ibu" class="form-label">Nama Ibu</label><span
                            class="text-danger" style="font-size: 15px;"><i> *wajib diisi</i></span>
                            <input type="text" id="nama_ibu" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_wali" name="nama_wali" class="form-label">Nama Wali</label><span
                            class="text-danger" style="font-size: 15px;"><i> *wajib diisi jika ada</i></span>
                            <input type="text" id="nama_wali" name="nama_wali" class="form-control" value="{{ old('nama_wali') }}">
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_orangtua_wali" class="form-label">Pekerjaan Orang Tua/Wali</label>
                            <span class="text-danger" style="font-size: 15px;"><i> *wajib diisi</i></span>
                            <select id="pekerjaan_orangtua_wali" name="pekerjaan_orangtua_wali" onchange="toggleInput(this)" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="Petani" {{ old('pekerjaan_orangtua_wali') == 'Petani' ? 'selected' : '' }}>Petani</option>
                                <option value="Nelayan" {{ old('pekerjaan_orangtua_wali') == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                                <option value="Guru" {{ old('pekerjaan_orangtua_wali') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                <option value="Dokter" {{ old('pekerjaan_orangtua_wali') == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                                <option value="Polisi" {{ old('pekerjaan_orangtua_wali') == 'Polisi' ? 'selected' : '' }}>Polisi</option>
                                <option value="Tentara" {{ old('pekerjaan_orangtua_wali') == 'Tentara' ? 'selected' : '' }}>Tentara</option>
                                <option value="Pegawai Negeri" {{ old('pekerjaan_orangtua_wali') == 'Pegawai Negeri' ? 'selected' : '' }}>Pegawai Negeri</option>
                                <option value="Wiraswasta" {{ old('pekerjaan_orangtua_wali') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                <option value="Karyawan Swasta" {{ old('pekerjaan_orangtua_wali') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                <option value="lainnya" {{ old('pekerjaan_orangtua_wali') == 'lainnya' ? 'selected' : '' }}>Lainnya...</option>
                            </select>
                            <input type="text" id="pekerjaan_ortu_lainnya" name="pekerjaan_ortu_lainnya" class="form-control {{ $errors->has('pekerjaan_ortu_lainnya') ? 'is-invalid' : '' }} {{ old('pekerjaan_orangtua_wali') == 'lainnya' ? '' : 'hidden' }}" value="{{ old('pekerjaan_ortu_lainnya') }}" placeholder="Masukkan pekerjaan orang tua/wali">
                            @if ($errors->has('pekerjaan_ortu_lainnya'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pekerjaan_ortu_lainnya') }}
                                </div>
                            @endif
                        </div>
                        @foreach ($kriteria as $item)
                            <div class="mb-3">
                                <label for="{{ $item->id }}" class="form-label">{{ $item->nama }}</label><span
                                    class="text-danger" style="font-size: 15px;"><i> *wajib diisi</i></span>
                                <select name="kriteria[]" id="{{ $item->id }}" class="form-select kriteria-select"
                                    required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($subkriteria[$item->id] as $data)
                                        <option value="{{ $data->id }}"
                                            {{ in_array($data->id, old('kriteria') ?: []) ? 'selected' : '' }}>
                                            {{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        <div class="mb-3">
                            <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label><span
                                class="text-danger" style="font-size: 15px;"><i> *upload gambar format jpeg.jpg.png uk. max
                                    2 MB</i></span>
                            <input class="form-control  @error('foto_kartu_keluarga') is-invalid @enderror" type="file"
                                id="foto_kartu_keluarga" accept=".jpeg, .jpg, .png" name="foto_kartu_keluarga" required>

                            @error('foto_kartu_keluarga')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto_KTP_orangtua" class="form-label">Foto KTP Orang Tua/Wali</label><span
                                class="text-danger" style="font-size: 15px;"><i> *upload gambar format jpeg.jpg.png uk. max
                                    2 MB</i></span>
                            <input class="form-control  @error('foto_KTP_orangtua') is-invalid @enderror" type="file"
                                id="foto_KTP_orangtua" accept=".jpeg, .jpg, .png" name="foto_KTP_orangtua" required>

                            @error('foto_KTP_orangtua')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto_tempat_tinggal" class="form-label">Foto Tempat Tinggal</label><span
                                class="text-danger" style="font-size: 15px;"><i> *upload gambar format jpeg.jpg.png uk. max
                                    2 MB</i></span>
                            <input class="form-control  @error('foto_tempat_tinggal') is-invalid @enderror" type="file"
                                id="foto_tempat_tinggal" accept=".jpeg, .jpg, .png" name="foto_tempat_tinggal" required>

                            @error('foto_tempat_tinggal')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto_slip_gaji" class="form-label">Foto Slip Gaji</label><span class="text-danger"
                                style="font-size: 15px;"><i> *upload gambar format jpeg.jpg.png uk. max 2 MB</i></span>
                            <input class="form-control  @error('foto_slip_gaji') is-invalid @enderror" type="file"
                                id="foto_slip_gaji" accept=".jpeg, .jpg, .png" name="foto_slip_gaji" required>

                            @error('foto_slip_gaji')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto_daya_listrik" class="form-label">Foto Daya Listrik</label><span
                                class="text-danger" style="font-size: 15px;"><i> *upload gambar format jpeg.jpg.png uk. max
                                    2 MB</i></span>
                            <input class="form-control @error('foto_daya_listrik') is-invalid @enderror" type="file"
                                id="foto_daya_listrik" accept=".jpeg, .jpg, .png" name="foto_daya_listrik" required>

                            @error('foto_daya_listrik')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                        <br>
                        <div class="mb-3" id="foto_kendaraan_container">
                            <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label><span class="text-danger"
                                style="font-size: 15px;"><i> *upload gambar format jpeg.jpg.png uk. max 2 MB</i></span>
                            <input class="form-control @error('foto_kendaraan') is-invalid @enderror" type="file"
                                id="foto_kendaraan" accept=".jpeg, .jpg, .png" name="foto_kendaraan">

                            @error('foto_kendaraan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" id="foto_beasiswa_container">
                            <label for="foto_beasiswa" class="form-label">Foto Bukti Bantuan Pemerintah</label><span class="text-danger"
                                style="font-size: 15px;"><i> *upload gambar format jpeg.jpg.png uk. max 2 MB</i></span>
                            <input class="form-control @error('foto_beasiswa') is-invalid @enderror" type="file"
                                id="foto_beasiswa" accept=".jpeg, .jpg, .png" name="foto_beasiswa" >

                            @error('foto_beasiswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm"
                            onClick="return confirm('Anda yakin dengan semua data yang anda selesaikan?')">Simpan</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="history.back()">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
        var kriteriaSelect3 = $('select#3');
        var kriteriaSelect9 = $('select#9');

        var formKendaraan = $('#foto_kendaraan_container');
        var formBeasiswa = $('#foto_beasiswa_container');

        // Fungsi untuk menyembunyikan form foto kendaraan jika opsi "Tidak Ada Kendaraan" dipilih
        function hideKendaraanForm() {
            var selectedValue = kriteriaSelect3.val();
            var isFormVisible = (selectedValue != 17 && selectedValue != 'tidak ada kendaraan' );
            formKendaraan.toggle(isFormVisible);
            if (!isFormVisible) {
                $('#foto_kendaraan').val('');
            }
        }

        // Fungsi untuk menyembunyikan form foto beasiswa jika opsi "Tidak Ada Beasiswa" dipilih
        function hideBeasiswaForm() {
            var selectedValue = kriteriaSelect9.val();
            var isFormVisible = (selectedValue != 71 && selectedValue != 'Tidak Terima');
            formBeasiswa.toggle(isFormVisible);
            if (!isFormVisible) {
                $('#foto_beasiswa').val('');
            }
        }

        // Panggil fungsi untuk menyembunyikan form saat dokumen siap
        hideKendaraanForm();
        hideBeasiswaForm();

        // Tangani perubahan pada input kriteria
        kriteriaSelect3.change(function() {
            hideKendaraanForm();
        });

        kriteriaSelect9.change(function() {
            hideBeasiswaForm();
        });
    });
    </script>
    <script>
        function toggleInput(select) {
            var inputField = document.getElementById('pekerjaan_ortu_lainnya');
            if (select.value === 'lainnya') {
                inputField.classList.remove('hidden');
            } else {
                inputField.classList.add('hidden');
            }
        }

        // Panggil fungsi toggleInput saat halaman dimuat ulang untuk memastikan keadaan input yang benar
        toggleInput(document.getElementById('pekerjaan_orangtua_wali'));
    </script>
@endpush
