@extends('layouts.app')

@section('content')
<style>
    .golongan {
        background-color: #ebe0e0bb;
        color: #070707;
    }

    .status {
        border-color: #FF0000;
        /* Ganti dengan warna latar belakang yang diinginkan */
    }
</style>
@if (Auth::guard('admin')->check())
<div class="row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Detail Data Kriteria Mahasiswa &nbsp;
        @if ($berkas == null || $berkas->status == 'Belum Lengkap')
            <span class="badge bg-danger">Belum Lengkap</span>
        @elseif($berkas->status == 'Menunggu Verifikasi')
            <span class="badge bg-warning">Menunggu Verifikasi</span>
        @else
            <span class="badge bg-primary">Lulus Verifikasi</span>
        @endif
    </h4>
    <div class="col-md-12">
        <div class="card mt-3"> <h4 class="card-header">Profil Mahasiswa</h4>
            <div class="card-body">
                <table class="table table-borderless w-75">
                    <tr>
                        <th>No.Pendaftaran</th>
                        <td>:</td>
                        <td>{{ $berkas->mahasiswa->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td>{{ $berkas->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>:</td>
                        <td>{{ $berkas->mahasiswa->no_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td>{{ $berkas->mahasiswa->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Prodi</th>
                        <td>:</td>
                        <td>{{ $berkas->mahasiswa->prodi->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jenjang</th>
                        <td>:</td>
                        <td>{{ $berkas->mahasiswa->prodi->jenjang }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>:</td>
                        <td>{{ $berkas->mahasiswa->prodi->jurusan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jalur Pendaftaran</th>
                        <td>:</td>
                        <td>{{ $berkas->mahasiswa->jalur }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card mt-3"> <h4 class="card-header">Data Kriteria Mahasiswa</h4>
            <div class="card-body">
                <table class="table table-borderless w-75">
                    @foreach ($penilaians as $data => $nilai)
                        @foreach ($nilai as $data)
                            <tr>
                                <th>{{ $data->kriteria->nama }}</th>
                                <td>:</td>
                                <td>{{ $data->subkriteria->nama }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card mt-3"> <h4 class="card-header">Lampiran Foto</h4>
            <div class="card-body">
                <table class="table table-borderless w-75">
                    <tr>
                        <th>Foto Tempat Tinggal</th>
                        <td>:</td>
                        <td><a href="{{ asset('foto_tempat_tinggal/' . $berkas->foto_tempat_tinggal) }}"
                                data-fancybox="gallery">
                                <img src="{{ asset('foto_tempat_tinggal/' . $berkas->foto_tempat_tinggal) }}"
                                    class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                        </td>
                    </tr>

                    <tr>
                        <th>Foto Slip Gaji</th>
                        <td>:</td>
                        <td><a href="{{ asset('foto_slip_gaji/' . $berkas->foto_slip_gaji) }}"
                                data-fancybox="gallery">
                                <img src="{{ asset('foto_slip_gaji/' . $berkas->foto_slip_gaji) }}"
                                    class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a></td>
                    </tr>
                    <tr>
                        <th>Foto Daya Listrik</th>
                        <td>:</td>
                        <td><a href="{{ asset('foto_daya_listrik/' . $berkas->foto_daya_listrik) }}"
                                data-fancybox="gallery">
                                <img src="{{ asset('foto_daya_listrik/' . $berkas->foto_daya_listrik) }}"
                                    class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a></td>
                    </tr>
                    <tr>
                        @if ($berkas->foto_kendaraan === null || $berkas->foto_kendaraan === '')
                        @else
                            <th>Foto Kendaraan</th>
                            <td>:</td>
                            <td>
                                <a href="{{ asset('foto_kendaraan/' . $berkas->foto_kendaraan) }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('foto_kendaraan/' . $berkas->foto_kendaraan) }}"
                                        class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        @if ($berkas->foto_beasiswa === null || $berkas->foto_beasiswa === '')
                        @else
                            <th>Foto Bantuan Pemerintah</th>
                            <td>:</td>
                            <td>
                                <a href="{{ asset('foto_beasiswa/' . $berkas->foto_beasiswa) }}" data-fancybox="gallery">
                                    <img src="{{ asset('foto_beasiswa/' . $berkas->foto_beasiswa) }}"
                                        class="rounded img-fluid" width="300px" alt="Deskripsi Gambar">
                                </a>
                            </td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
        <div class="card mt-3"> <h4 class="card-header">Penetapan Golongan UKT</h4>
            @if ($berkas->status != 'Lulus Verifikasi')
                <div class="card-body">
                    @if (Auth::guard('admin')->check() && Auth::user()->role == 'verifikator')
                        <form action="{{ route('admin.data-ukt.update', $berkas->id) }}" method="POST">
                            @csrf
                            <table class="table table-borderless w-100">
                                <tr>
                                    <th>Prodi/Jenjang</th>
                                    <td>:</td>
                                    <td>{{ $berkas->mahasiswa->prodi->nama }}/{{ $berkas->mahasiswa->prodi->jenjang }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Rekomendasi Golongan</th>
                                    <td>:</td>
                                    <td>{{ $berkas->golongan->nama }} =
                                        Rp {{ number_format($berkas->nominal_ukt, 0, ',', '.') }}</td>
                                    <td>

                                        <!-- Tombol Rekomendasi Golongan  -->
                                        <button type="button" class="btn btn-outline-secondary " data-toggle="modal"
                                            data-target="#arsipModal" >Lihat Perhitungan</button>

                                        <!-- Modal Tombol -->
                                        <div class="modal fade" id="arsipModal" tabindex="-1" role="dialog" aria-labelledby="arsipModalLabel"
                                            aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="justify-content: center;">
                                                        <h5 class="modal-title" style="font-weight: bold; text-transform: uppercase; text-align: center; width: 100%;" id="exampleModalLabel">Perhitungan Data Kriteria Mahasiswa</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <table class="table table-bordered w-100"> <!-- Menambahkan kelas table-bordered untuk garis pada setiap baris -->
                                                                <thead>
                                                                    <tr style="background-color: #ece49ce1">
                                                                        <th>No</th>
                                                                        <th>Kriteria</th>
                                                                        <th>Subkriteria</th>
                                                                        <th>Nilai</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php $i = 1; @endphp
                                                                    @foreach ($penilaians as $data => $nilai)
                                                                        @foreach ($nilai as $data)
                                                                        <tr>
                                                                            <td>{{ $i++ }}</td>
                                                                            <td>{{ $data->kriteria->nama }}</td>
                                                                            <td>{{ $data->subkriteria->nama }}</td>
                                                                            <td>{{ $data->subkriteria->nilai }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    @endforeach

                                                                    <tr>
                                                                        <td colspan="3" class="text-right"><b>Total Nilai :</b></td>
                                                                        <td style="background-color: #ece49ce1">{{ $total }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2" class="text-right"><b>Golongan Yang Cocok :</b></td>
                                                                        <td style="background-color: #ece49ce1">{{ $berkas->golongan->nama }}</td>
                                                                        <td>{{ $berkas->golongan->nilai_minimal }}-{{ $berkas->golongan->nilai_maksimal }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="mt-4">
                                                                <span><b>Diketahui :</b></span>
                                                                <div class="row">
                                                                    @foreach ($golongan as $gol)
                                                                    <div class="col-4">
                                                                        <ul>
                                                                            <li>{{ $gol->nama }} : [{{ $gol->nilai_minimal }} - {{ $gol->nilai_maksimal }}]</li>
                                                                        </ul>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Finish Rekomendasi Golongan -->
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ubah Status</th>
                                    <td>:</td>
                                    <td>
                                        <select name="status" class="form-select status " autofocus
                                            required id="status">
                                            <option value="Menunggu Verifikasi"
                                                {{ $berkas->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>
                                                Menunggu Verifikasi</option>
                                            <option value="Belum Lengkap"
                                                {{ $berkas->status == 'Belum Lengkap' ? 'selected' : '' }}>
                                                Belum Lengkap</option>
                                            <option value="Lulus Verifikasi"
                                                {{ $berkas->status == 'Lulus Verifikasi' ? 'selected' : '' }}>
                                                Lulus Verifikasi</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="keterangan-row"></tr>
                                <tr>
                                    <th>Tetapkan Golongan UKT</th>
                                    <td>:</td>
                                    <td>
                                        <select name="golongan_id" id="golongan_id" class="form-select"
                                            required>
                                            @foreach ($golongan as $gol)
                                                <option value="{{ $gol->id }}"
                                                    {{ $berkas->golongan_id == $gol->id ? 'selected' : '' }}>
                                                    {{ $gol->nama }} = Rp
                                                    {{ number_format($nominalUkts[$loop->index]['nominal_ukt'], 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-sm" onClick="return confirm('Apakah sudah yakin?')" >Submit</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="history.back()">Kembali</button>
                            </div>
                        </form>
                    @elseif (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
                        <h6>Penetapan Golongan UKT hanya bisa dilakukan oleh Verifikator !</h6>
                        <div class="mt-3">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="history.back()">Kembali</button>
                        </div>
                    @endif
                </div>
            @else
                <div class="card-body">
                    <table class="table table-borderless w-75">
                        <tr>
                            <th>Golongan</th>
                            <td>:</td>
                            <td style="font-size: 16px">
                                {{ $berkas->golongan->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>Nominal UKT</th>
                            <td>:</td>
                            <td>
                                Rp{{ number_format($berkas->nominal_ukt, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="history.back()">Kembali</button>
                    </div>
                </div>
            @endif
        </div>
        @if (Auth::guard('admin')->check() && Auth::user()->role == 'verifikator' && $berkas->status != "Lulus Verifikasi")
        <div class="col-md-12">
            <div class="card mt-3" style="background-color: #ece49ce1">
                <table class="table table-borderless w-75">
                        <span class="card-header text-black">INFORMASI : <br>
                        <ul>
                            <li>"Rekomendasi Golongan" adalah golongan otomatis berdasarkan perhitungan dari data yang telah diinput mahasiswa, Rekomendasi golongan telah disesuaikan dengan prodi mahasiswa. Ini akan mempermudah dalam penetapan UKT</li>
                            <li>"Ubah Status" untuk verifikasi status berkas mahasiswa</li>
                            <li>Jika status diubah menjadi "Belum Lengkap", maka kolom input "Keterangan" akan muncul untuk memberikan catatan kesalahan</li>
                            <li>Jika status diubah menjadi "Lulus Verifikasi", maka kolom "Penetapan Golongan UKT" akan muncul. Tetapkan golongan UKT mahasiswa pada kolom tersebut. Golongan UKT dapat disesuaikan dengan Rekomendasi Golongan atau memilih ulang</li>
                            <li>Jika status diubah menjadi "Lulus Verifikasi", maka golongan UKT akan tersimpan dan tidak bisa diubah lagi</li>
                        </ul>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Mahasiswa -->
@else
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Kriteria UKT </h4>
    <span>Mohon untuk melengkapi data berikut dengan benar dan pastikan tidak ada data yang kosong sebelum di
        simpan!</span>
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
        <div class="col-md-8">
            <div class="card-body">
                <form action="{{ route('data-ukt.update', $berkas->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @foreach ($kriteria as $item)
                        <label for="{{ $item->id }}" class="form-label">{{ $item->nama }}</label><span
                            class="text-danger" style="font-size: 15px;"><i> *wajib terisi</i></span>
                        <select name="kriteria[{{ $item->id }}]" id="{{ $item->id }}"
                            class="form-select kriteria-select">
                            @foreach ($subkriteria[$item->id] as $data)
                                <option value="{{ $data->id }}"
                                    {{ old("kriteria.{$item->id}", $penilaian[$item->id]->subkriteria_id) == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama }}
                                </option>
                            @endforeach
                        </select>
                    @endforeach
                    <br>
                    <div class="mb-3">
                        <label for="foto_tempat_tinggal" class="form-label">Foto Tempat Tinggal</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Abaikan jika tidak ingin
                                merubah gambar</i></span>
                            <input class="form-control @error('foto_tempat_tinggal') is-invalid @enderror" type="file"
                            id="foto_tempat_tinggal" accept=".jpeg, .jpg, .png" name="foto_tempat_tinggal">
                            @if ($berkas->foto_tempat_tinggal)
                                <p class="text-muted">Gambar Lama: {{ $berkas->foto_tempat_tinggal }}</p>
                            @endif
                            @error('foto_tempat_tinggal')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto_slip_gaji" class="form-label">Foto Slip Gaji</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Abaikan jika tidak ingin
                                merubah gambar</i></span>
                            <input class="form-control @error('foto_slip_gaji') is-invalid @enderror" type="file"
                                id="foto_slip_gaji" accept=".jpeg, .jpg, .png" name="foto_slip_gaji">
                            @if ($berkas->foto_slip_gaji)
                                <p class="text-muted">Gambar Lama: {{ $berkas->foto_slip_gaji }}</p>
                            @endif
                            @error('foto_slip_gaji')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto_daya_listrik" class="form-label">Foto Daya Listrik</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Abaikan jika tidak ingin
                                merubah gambar</i></span>
                            <input class="form-control @error('foto_daya_listrik') is-invalid @enderror" type="file"
                                id="foto_daya_listrik" accept=".jpeg, .jpg, .png" name="foto_daya_listrik">
                            @if ($berkas->foto_daya_listrik)
                                <p class="text-muted">Gambar Lama: {{ $berkas->foto_daya_listrik }}</p>
                            @endif
                            @error('foto_daya_listrik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    @if ($berkas->foto_kendaraan === null || $berkas->foto_kendaraan === '')
                    <div class="mb-3" id="foto_kendaraan">
                        <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Upload gambar format: jpeg, jpg,
                                png Ukuran max: 2MB</i></span>
                            <input class="form-control @error('foto_kendaraan') is-invalid @enderror" type="file"
                                id="foto_kendaraan" accept=".jpeg, .jpg, .png" name="foto_kendaraan">
                            @error('foto_kendaraan')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    <img id="preview_foto_kendaraan" src="" class="rounded img-fluid" width="250px">
                    @else
                    <div class="mb-3" id="foto_kendaraan">
                        <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Abaikan jika tidak ingin
                                merubah gambar</i></span>
                            <input class="form-control @error('foto_kendaraan') is-invalid @enderror" type="file"
                                id="foto_kendaraan" accept=".jpeg, .jpg, .png" name="foto_kendaraan">
                            @if ($berkas->foto_kendaraan)
                                <p class="text-muted">Gambar Lama: {{ $berkas->foto_kendaraan }}</p>
                            @endif
                            @error('foto_kendaraan')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    @endif
                    @if ($berkas->foto_beasiswa === null || $berkas->foto_beasiswa === '')
                    <div class="mb-3" id="foto_beasiswa_container">
                        <label for="foto_beasiswa" class="form-label">Foto Bantuan Pemerintah</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Upload gambar format: jpeg, jpg, png
                                Ukuran max: 2MB</i></span>
                            <input class="form-control @error('foto_beasiswa') is-invalid @enderror" type="file"
                                id="foto_beasiswa" accept=".jpeg, .jpg, .png" name="foto_beasiswa">
                            @error('foto_beasiswa')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    <img id="preview_foto_beasiswa" src="" class="rounded img-fluid" width="250px">
                    @else
                    <div class="mb-3" id="foto_beasiswa_container">
                        <label for="foto_beasiswa" class="form-label">Foto Bantuan Pemerintah</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Abaikan jika tidak ingin
                                merubah gambar</i></span>
                        <input class="form-control @error('foto_beasiswa') is-invalid @enderror" type="file"
                            id="foto_beasiswa" accept=".jpeg, .jpg, .png" name="foto_beasiswa">
                        @if ($berkas->foto_beasiswa)
                            <p class="text-muted">Gambar Lama: {{ $berkas->foto_beasiswa }}</p>
                        @endif
                        @error('foto_beasiswa')
                            <div class="invalid-feedback">
                                {{ $message }}

                            </div>
                        @enderror
                    </div>
                    @endif
                    <br>
                    <button type="submit"
                        class="btn btn-primary btn-sm"onClick="return confirm('Yakin ingin mengubah data?')">Ubah Data
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="history.back()">Kembali</button>
                </form>
            </div>
        </div>
    </div>
@endif
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        function toggleGolonganUktSelect() {
            var status = $('#status').val();
            if (status === 'Menunggu Verifikasi' || status === 'Belum Lengkap') {
                $('#golongan_id').closest('tr').hide();
            } else {
                $('#golongan_id').closest('tr').show();
            }
        }

        // Panggil fungsi toggle saat dokumen pertama kali dimuat
        toggleGolonganUktSelect();

        // Panggil fungsi toggle saat status berubah
        $('#status').change(function() {
            toggleGolonganUktSelect();
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#status').on('change', function() {
            if (this.value === 'Belum Lengkap') {
                $('#keterangan-row').append(
                    '<th>Keterangan</th><td>:</td><td><textarea name="keterangan" id="keterangan" class="form-control" required></textarea></td>'
                );
            } else {
                $('#keterangan-row').empty();
            }
        });

        // Append textarea if status is 'Belum Lengkap' on document ready
        if ($('#status').val() === 'Belum Lengkap') {
            $('#keterangan-row').append(
                '<th>Keterangan</th><td>:</td><td><textarea name="keterangan" id="keterangan" class="form-control" required>{{ $berkas->keterangan }}</textarea></td>'
            );
        }
    });
    </script>
    <script>
    $(document).ready(function() {
        var kriteriaSelect = $('select#3');
        var formKendaraan = $('div#foto_kendaraan');

        function toggleFormVisibility() {
            var selectedValue = kriteriaSelect.val();
            var isFormVisible = (selectedValue != 17 && selectedValue != 'tidak ada kendaraan');
            formKendaraan.toggle(isFormVisible);

            if (!isFormVisible) {
                $('#foto_kendaraan').val(''); // Hapus nilai input file
                $('#preview_foto_kendaraan').attr('src', ''); // Hapus pratinjau gambar
            }
        }

        kriteriaSelect.on('change', function() {
            toggleFormVisibility();
        });

        if (kriteriaSelect.val() == 'tidak ada kendaraan') {
            formKendaraan.hide();
        }

        toggleFormVisibility();
    });
    </script>
    <script>

    $(document).ready(function() {
        var kriteriaSelect = $('select#9');
        var formBeasiswa = $('div#foto_beasiswa_container');

        function toggleFormVisibility() {
            var selectedValue = kriteriaSelect.val();
            var isFormVisible = (selectedValue != 71 && selectedValue != "Tidak Terima");
            formBeasiswa.toggle(isFormVisible);

            if (!isFormVisible) {
                $('#foto_beasiswa_container').val(''); // Hapus nilai input file
                $('#preview_foto_beasiswa').attr('src', ''); // Hapus pratinjau gambar
            }
        }

        kriteriaSelect.on('change', function() {
            toggleFormVisibility();
        });

        if (kriteriaSelect.val() == 'Tidak Terima') {
            formBeasiswa.hide();
        }

        toggleFormVisibility();
    });
</script>
<script>

    function goBack() {
        window.history.back();
    }

</script>
@endpush

