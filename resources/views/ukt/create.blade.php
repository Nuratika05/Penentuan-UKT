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

                            @if (old('foto_tempat_tinggal'))
                                <p class="text-muted">Gambar Lama: {{ old('foto_tempat_tinggal') }}</p>
                            @endif
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

                            @if (old('foto_slip_gaji'))
                                <p class="text-muted">Gambar Lama: {{ old('foto_slip_gaji') }}</p>
                            @endif
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

                            @if (old('foto_daya_listrik'))
                                <p class="text-muted">Gambar Lama: {{ old('foto_daya_listrik') }}</p>
                            @endif
                            @error('foto_daya_listrik')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" id="foto_kendaraan">
                            <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label><span class="text-danger"
                                style="font-size: 15px;"><i> *upload gambar format jpeg.jpg.png uk. max 2 MB</i></span>
                            <input class="form-control @error('foto_kendaraan') is-invalid @enderror" type="file"
                                id="foto_kendaraan" accept=".jpeg, .jpg, .png" name="foto_kendaraan">

                            @if (old('foto_kendaraan'))
                                <p class="text-muted">Gambar Lama: {{ old('foto_kendaraan') }}</p>
                            @endif

                            @error('foto_kendaraan')
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
            // Dapatkan elemen select kriteria
            var kriteriaSelect = $('select#3');

            // Dapatkan elemen form kendaraan
            var formKendaraan = $('div#foto_kendaraan');

            // Tangani perubahan pada setiap elemen select
            kriteriaSelect.change(function() {
                // Dapatkan nilai opsi yang dipilih
                var selectedValue = $(this).val();

                // Tentukan apakah form kendaraan harus ditampilkan atau disembunyikan
                var isFormVisible = (selectedValue != 17);
                // Tampilkan atau sembunyikan form kendaraan
                formKendaraan.toggle(isFormVisible);

            });
        });
    </script>
@endpush
