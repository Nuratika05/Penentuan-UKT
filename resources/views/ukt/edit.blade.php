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
    .hidden {
        display: none;
    }
    table td {
        padding-left: 12px;
        vertical-align: top;
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
                    <tr>
                        <th>Nama Ayah</th>
                        <td>:</td>
                        <td>
                            @if($berkas->nama_ayah == null || $berkas->nama_ayah == '' )
                            -
                            @else
                            {{ $berkas->nama_ayah }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Ibu</th>
                        <td>:</td>
                        <td>
                            @if($berkas->nama_ibu == null || $berkas->nama_ibu == '' )
                            -
                            @else
                            {{ $berkas->nama_ibu }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Wali</th>
                        <td>:</td>
                        <td>
                            @if($berkas->nama_wali == null || $berkas->nama_wali == '' )
                            -
                            @else
                            {{ $berkas->nama_wali }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Orang Tua/Wali</th>
                        <td>:</td>
                        <td>
                            @if($berkas->pekerjaan_orangtua_wali == null || $berkas->pekerjaan_orangtua_wali == '' )
                            -
                            @else
                            {{ $berkas->pekerjaan_orangtua_wali }}
                            @endif
                        </td>
                    </tr>
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
        <div class="card mt-3"> <h4 class="card-header">foto Lampiran</h4>
            <div class="card-body">
                <table class="table table-borderless w-75">
                    <tr>
                        <th>Foto Kartu Keluarga</th>
                        <td>:</td>
                        <td>
                            @if ($berkas->foto_kartu_keluarga === null || $berkas->foto_kartu_keluarga === '')
                            -
                            @else
                            <a href="{{ asset('foto_kartu_keluarga/' . $berkas->foto_kartu_keluarga) }}"
                                data-fancybox="gallery">
                                <img src="{{ asset('foto_kartu_keluarga/' . $berkas->foto_kartu_keluarga) }}"
                                    class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Foto KTP Orang Tua/Wali</th>
                        <td>:</td>
                        <td>
                            @if ($berkas->foto_KTP_orangtua === null || $berkas->foto_KTP_orangtua === '')
                            -
                            @else
                            <a href="{{ asset('foto_KTP_orangtua/' . $berkas->foto_KTP_orangtua) }}"
                                data-fancybox="gallery">
                                <img src="{{ asset('foto_KTP_orangtua/' . $berkas->foto_KTP_orangtua) }}"
                                    class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                            @endif
                        </td>
                    </tr>
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
                            <th>Foto Bukti Bantuan Pemerintah</th>
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
                                                            <table class="table table-bordered w-120"> <!-- Menambahkan kelas table-bordered untuk garis pada setiap baris -->
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
                    <div class="mb-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah</label>
                        <span class="text-danger" style="font-size: 15px;"><i> *wajib terisi</i></span>
                        <input type="text" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $berkas->nama_ayah) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_ibu" class="form-label">Nama Ibu</label>
                        <span class="text-danger" style="font-size: 15px;"><i> *wajib terisi</i></span>
                        <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $berkas->nama_ibu) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_wali" class="form-label">Nama Wali</label>
                        <span class="text-danger" style="font-size: 15px;"><i> *wajib terisi jika ada</i></span>
                        <input type="text" id="nama_wali" name="nama_wali" value="{{ old('nama_wali', $berkas->nama_wali) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan_orangtua_wali" class="form-label">Pekerjaan Orang Tua/Wali</label>
                        <span class="text-danger" style="font-size: 15px;"><i> *wajib terisi</i></span>
                        <select id="pekerjaan_orangtua_wali" name="pekerjaan_orangtua_wali" onchange="toggleInput(this)" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Petani" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Petani' ? 'selected' : '' }}>Petani</option>
                            <option value="Nelayan" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                            <option value="Guru" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Guru' ? 'selected' : '' }}>Guru</option>
                            <option value="Dokter" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="Polisi" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Polisi' ? 'selected' : '' }}>Polisi</option>
                            <option value="Tentara" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Tentara' ? 'selected' : '' }}>Tentara</option>
                            <option value="Pegawai Negeri" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Pegawai Negeri' ? 'selected' : '' }}>Pegawai Negeri</option>
                            <option value="Wiraswasta" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                            <option value="Karyawan Swasta" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                            <option value="lainnya" {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) != null && !in_array($berkas->pekerjaan_orangtua_wali, ['Petani', 'Nelayan', 'Guru', 'Dokter', 'Polisi', 'Tentara', 'Pegawai Negeri', 'Wiraswasta', 'Karyawan Swasta']) ? 'selected' : '' }}>Lainnya...</option>
                        </select>
                        <input type="text" id="pekerjaan_ortu_lainnya" name="pekerjaan_ortu_lainnya" class="form-control {{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) == 'lainnya' || (old('pekerjaan_orangtua_wali') != null && !in_array(old('pekerjaan_orangtua_wali'), ['Petani', 'Nelayan', 'Guru', 'Dokter', 'Polisi', 'Tentara', 'Pegawai Negeri', 'Wiraswasta', 'Karyawan Swasta'])) ? '' : 'hidden' }}" value="{{ old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali) != null && !in_array(old('pekerjaan_orangtua_wali', $berkas->pekerjaan_orangtua_wali), ['Petani', 'Nelayan', 'Guru', 'Dokter', 'Polisi', 'Tentara', 'Pegawai Negeri', 'Wiraswasta', 'Karyawan Swasta']) ? $berkas->pekerjaan_orangtua_wali : '' }}" placeholder="Masukkan pekerjaan orang tua/wali">
                        @error('pekerjaan_orangtua_wali')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    @foreach ($kriteria as $item)
                        <label for="{{ $item->id }}" class="form-label">{{ $item->nama }}</label><span
                            class="text-danger" style="font-size: 15px;"><i> *wajib terisi</i></span>
                        <select name="kriteria[{{ $item->id }}]" id="{{ $item->id }}"
                            class="form-select kriteria-select" required>
                            @foreach ($subkriteria[$item->id] as $data)
                                <option value="{{ $data->id }}"
                                    {{ old("kriteria.{$item->id}", $penilaian[$item->id]->subkriteria_id) == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama }}
                                </option>
                            @endforeach
                        </select>
                    @endforeach
                    <br>
                    @if ($berkas->foto_kartu_keluarga === null || $berkas->foto_kartu_keluarga === '')
                    <div class="mb-3" id="foto_kartu_keluarga">
                        <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Upload gambar format: jpeg, jpg,
                                png Ukuran max: 2MB</i></span>
                            <input class="form-control @error('foto_kartu_keluarga') is-invalid @enderror" type="file"
                                id="foto_kartu_keluarga" accept=".jpeg, .jpg, .png" name="foto_kartu_keluarga" required>
                            @error('foto_kartu_keluarga')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    @else
                    <div class="mb-3">
                        <label for="foto_kartu_keluarga" class="form-label">Foto Kartu Keluarga</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Abaikan jika tidak ingin
                                merubah gambar</i></span>
                            <input class="form-control @error('foto_kartu_keluarga') is-invalid @enderror" type="file"
                            id="foto_kartu_keluarga" accept=".jpeg, .jpg, .png" name="foto_kartu_keluarga">
                            @if ($berkas->foto_kartu_keluarga)
                                <p class="text-muted">Gambar Lama: {{ $berkas->foto_kartu_keluarga }}</p>
                            @endif
                            @error('foto_kartu_keluarga')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    @endif
                    @if ($berkas->foto_KTP_orangtua === null || $berkas->foto_KTP_orangtua === '')
                    <div class="mb-3">
                        <label for="foto_KTP_orangtua" class="form-label">Foto KTP Orang Tua/Wali</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Upload gambar format: jpeg, jpg,
                                png Ukuran max: 2MB</i></span>
                            <input class="form-control @error('foto_KTP_orangtua') is-invalid @enderror" type="file"
                            id="foto_KTP_orangtua" accept=".jpeg, .jpg, .png" name="foto_KTP_orangtua" required>
                            @error('foto_KTP_orangtua')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    @else
                    <div class="mb-3">
                        <label for="foto_KTP_orangtua" class="form-label">Foto KTP Orang Tua/Wali</label><span
                            class="text-danger" style="font-size: 15px;"><i> *Abaikan jika tidak ingin
                                merubah gambar</i></span>
                            <input class="form-control @error('foto_KTP_orangtua') is-invalid @enderror" type="file"
                            id="foto_KTP_orangtua" accept=".jpeg, .jpg, .png" name="foto_KTP_orangtua">
                            @if ($berkas->foto_KTP_orangtua)
                                <p class="text-muted">Gambar Lama: {{ $berkas->foto_KTP_orangtua }}</p>
                            @endif
                            @error('foto_KTP_orangtua')
                                <div class="invalid-feedback">
                                    {{ $message }}

                                </div>
                            @enderror
                    </div>
                    @endif
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
                        <label for="foto_beasiswa" class="form-label">Foto Bukti Bantuan Pemerintah</label><span
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
<script>
    function toggleInput(select) {
        var input = document.getElementById('pekerjaan_ortu_lainnya');
        if (select.value === 'lainnya' || (select.value !== '' && !['Petani', 'Nelayan', 'Guru', 'Dokter', 'Polisi', 'Tentara', 'Pegawai Negeri', 'Wiraswasta', 'Karyawan Swasta'].includes(select.value))) {
            input.classList.remove('hidden');
            input.required = true;
        } else {
            input.classList.add('hidden');
            input.required = false;
        }
    }

    // Panggil toggleInput saat halaman dimuat ulang
    document.addEventListener('DOMContentLoaded', function() {
        toggleInput(document.getElementById('pekerjaan_orangtua_wali'));
    });
</script>
@endpush

