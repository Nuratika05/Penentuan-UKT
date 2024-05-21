@extends('layouts.app')

@section('content')

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
                        @foreach ($kriteria as $item)
                            <div class="mb-3">
                                <label for="{{ $item->id }}" class="form-label">{{ $item->nama }}</label><span
                                    class="text-danger" style="font-size: 15px;"><i> *wajib diisi</i></span>
                                <select name="kriteria[]" id="{{ $item->id }}" class="form-select kriteria-select"
                                    autofocus required>
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
                            <label for="foto_beasiswa" class="form-label">Foto Bantuan Pemerintah</label><span class="text-danger"
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
                        <a class="btn btn-danger btn-sm" type="button"
                            onClick="return confirm('Anda yakin akan membatalkan?')"
                            href="{{ route('mahasiswa.home') }}">Batal</a>
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
@endpush
