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
    <div class="row">
        @if (Auth::guard('admin')->check())
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Detail Data Kriteria Mahasiswa</h4>
            <div class="col-md-12">
                <div class="card">
                    <div class="card mt-3">
                        <h5 class="card-header">Status</h5>
                        <div class="card-body">
                            <table class="table table-borderless w-75">
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        @if ($berkas->status == 'Menunggu Verifikasi')
                                            <span class="badge bg-label-warning rounded">{{ $berkas->status }}</span>
                                        @elseif($berkas->status == 'Belum Lengkap')
                                            <span class="badge bg-label-danger rounded">{{ $berkas->status }}</span>
                                        @else
                                            <span class="badge bg-label-primary rounded">{{ $berkas->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <h5 class="card-header">Profil Mahasiswa</h5>
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
                            </table>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <h5 class="card-header">Data Kriteria Mahasiswa</h5>
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
                            </table>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <h5 class="card-header">Penetapan Golongan UKT</h5>
                        <div class="card-body">
                        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
                            <div class="card-body">
                                <h6>Penetapan Golongan UKT hanya bisa dilakukan oleh Verifikator !</h6>
                        @endif
                        @if (Auth::guard('admin')->check() && Auth::user()->role == 'verifikator')
                            <form action="{{ route('admin.data-ukt.update', $berkas->id) }}" method="POST">
                                @csrf
                                <table class="table table-borderless w-75">
                                    @if ($berkas->status == 'Menunggu Verifikasi' || $berkas->status == 'Belum Lengkap')
                                        <tr>
                                            <th>Prodi/Jenjang</th>
                                            <td>:</td>
                                            <td>{{ $berkas->mahasiswa->prodi->nama }}/{{ $berkas->mahasiswa->prodi->jenjang }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Rekomendasi Golongan</th>
                                            <td>:</td>
                                            <td>{{ $berkas->golongan->nama }} = Rp{{ number_format($berkas->nominal_ukt,0,',','.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ubah Status</th>
                                            <td>:</td>
                                            <td>
                                                <select name="status" class="form-select status " autofocus required id="status">
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
                                        <tr id="keterangan"></tr>
                                        <tr>
                                            <th>Tetapkan Golongan UKT</th>
                                            <td>:</td>
                                            <td>
                                                <select name="nominal_ukt" id="nominal_ukt" class="form-select" required>
                                                    @foreach ($nominalUkts as $nominalUkt)
                                                    <option value="{{ $nominalUkt['nominal_ukt'] }}"
                                                            {{ $berkas->golongan->nama == $nominalUkt['golongan_id'] ? 'selected' : '' }}>
                                                        {{ $nominalUkt['golongan_id'] }} = Rp {{ number_format($nominalUkt['nominal_ukt'], 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Golongan</th>
                                            <td>:</td>
                                            <td style="font-size: 16px">
                                                {{ $berkas->golongan->nama }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nominal</th>
                                            <td>:</td>
                                            <td>Rp{{ number_format($berkas->nominal_ukt,0,',','.') }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                </div>
                <div class="card mt-3">
                    <span class="card-header text-black">Catatan : <br>
                        <ul>
                            <li>Jika status berkas 'MENUNGGU VERIFIKASI' atau 'BELUM LENGKAP' maka Golongan
                                UKT belum ditetapkan!</li>
                            <li>Jika status diubah ke "LULUS VERIFIKASI" maka penetapan golongan UKT akan dimunculkan</li>
                            <li>Jika status berkas diubah menjadi "LULUS VERIFIKASI" dan data sudah disimpan, maka penetapan golongan UKT terverifikasi, dan tidak bisa
                                diubah lagi!</li>
                        </ul>
                    </span>
                </div>
                <div>
                    @if ($berkas->status != 'Lulus Verifikasi')
                        <button required id="status" type="submit" class="btn btn-primary btn-sm"
                            onClick="return confirm('Apakah sudah yakin ?')">Simpan</button>
                    @endif
                    @if ($berkas->status == 'Menunggu Verifikasi')
                        <a class="btn btn-secondary btn-sm" type="button"
                            href="{{ route('admin.menunggu-verifikasi') }}">Kembali</a>
                    @elseif ($berkas->status == 'Belum Lengkap')
                        <a class="btn btn-secondary btn-sm" type="button"
                            href="{{ route('admin.data-belum-lengkap') }}">Kembali</a>
                    @else
                        <a class="btn btn-secondary btn-sm" type="button"
                            href="{{ route('admin.lulus-verifikasi') }}">Kembali</a>
                    @endif
                </div>
        @endif
        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            <div><button class="btn btn-secondary btn-sm" type="button" onclick="goBack()">Kembali</button></div>
        @endif
    </div>
@else
    <h4 class="fw-bold"><span class="text-muted fw-light"></span> Edit Kriteria UKT</h4>
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
                </div>
                <div class="mb-3">
                    <label for="foto_tempat_tinggal" class="form-label">Foto Tempat Tinggal</label><span
                        class="text-danger" style="font-size: 15px;"><i> *Kosongkan jika tidak ingin
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
                    <label for="foto_slip_gaji" class="form-label">Foto Slip Gaji</label><span class="text-danger"
                        style="font-size: 15px;"><i> *Kosongkan jika tidak ingin
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
                    <label for="foto_daya_listrik" class="form-label">Foto Daya Listrik</label><span class="text-danger"
                        style="font-size: 15px;"><i> *Kosongkan jika tidak ingin
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
                @if ($berkas->foto_kendaraan == null)
                    <div class="mb-3" id="foto_kendaraan">
                        <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label><span class="text-danger"
                            style="font-size: 15px;"><i> *Upload gambar format: jpeg, jpg, png Ukuran max: 2MB</i></span>
                        <input class="form-control @error('foto_kendaraan') is-invalid @enderror" type="file"
                            id="foto_kendaraan" accept=".jpeg, .jpg, .png" name="foto_kendaraan">
                        @error('foto_kendaraan')
                            <div class="invalid-feedback">
                                {{ $message }}

                            </div>
                        @enderror
                    </div>
                @else
                    <div class="mb-3" id="foto_kendaraan">
                        <label for="foto_kendaraan" class="form-label">Foto Kendaraan</label><span class="text-danger"
                            style="font-size: 15px;"><i> *Kosongkan jika tidak ingin
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
                <br>
                <button type="submit"
                    class="btn btn-primary btn-sm"onClick="return confirm('Yakin ingin mengubah data?')">Ubah
                    Data
                </button>
                <a class="btn btn-danger btn-sm"onClick="return confirm('Yakin ingin membatalkan perubahan?')"
                    type="button" href="{{ route('mahasiswa.data-ukt') }}">Batal</a>
                </form>
            </div>
        </div>
    </div>
    </div>
    @endif
    </div>
@endsection
@push('js')
    <script {{-- if onchange status belum lengkap append tr textarea keterangan --}}>
        $(document).ready(function() {
            $('#status').on('change', function() {
                if (this.value == 'Belum Lengkap') {
                    $('#keterangan').append(
                        '<th>Keterangan</th><td>:</td><td><textarea name="keterangan" id="keterangan" class="form-control" required></textarea></td>'
                    );
                } else {
                    $('#keterangan').empty();
                }
            });
            // if status belum lengkap append tr textarea keterangan with value
            if ($('#status').val() == 'Belum Lengkap') {
                $('#keterangan').append(
                    '<th>Keterangan</th><td>:</td><td><textarea name="keterangan" id="keterangan" class="form-control" required>{{ $berkas->keterangan }}</textarea></td>'
                );
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Dapatkan elemen select kriteria
            var kriteriaSelect = $('select#3');

            // Dapatkan elemen form kendaraan
            var formKendaraan = $('div#foto_kendaraan');

            // Tangani perubahan pada setiap elemen select
            kriteriaSelect.on('change', function() {
                // Dapatkan nilai opsi yang dipilih
                var selectedValue = $(this).val();

                // Tentukan apakah form kendaraan harus ditampilkan atau disembunyikan
                var isFormVisible = (selectedValue != 17);
                // Tampilkan atau sembunyikan form kendaraan
                formKendaraan.toggle(isFormVisible);

            });
            if (kriteriaSelect.val() == 17) {
                formKendaraan.hide();
            } else {
                formKendaraan.show();
            }
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk menampilkan/menyembunyikan opsi select berdasarkan status yang dipilih
            function toggleGolonganUktSelect() {
                var status = $('#status').val();
                if (status === 'Menunggu Verifikasi' || status === 'Belum Lengkap') {
                    $('#nominal_ukt').closest('tr').hide();
                } else {
                    $('#nominal_ukt').closest('tr').show();
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
@endpush
