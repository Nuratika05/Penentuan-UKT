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
        table td {
        vertical-align: top;
    }
    </style>
    <div class="row">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Detail Data UKT Mahasiswa</h4>
        <div class="col-md-12">
            <div class="card mt-3">
                <h5 class="card-header">Profil Mahasiswa</h5>
                <div class="card-body">
                    <table class="table table-borderless w-75">
                        <tr>
                            <th>No.Pendaftaran</th>
                            <td>:</td>
                            <td>{{ $arsip->no_pendaftaran }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $arsip->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>:</td>
                            <td>{{ $arsip->no_telepon }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>:</td>
                            <td>{{ $arsip->alamat }}</td>
                        </tr>
                        <th>Prodi</th>
                        <td>:</td>
                        <td>{{ $arsip->nama_prodi }}</td>
                        </tr>
                        <tr>
                            <th>Jenjang</th>
                            <td>:</td>
                            <td>{{ $arsip->jenjang }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>:</td>
                            <td>{{ $arsip->nama_jurusan }}</td>
                        <tr>
                        <tr>
                            <th>Jalur Pendaftaran</th>
                            <td>:</td>
                            <td>{{ $arsip->jalur }}</td>
                        <tr>
                        <tr>
                            <th>Tahun Angkatan</th>
                            <td>:</td>
                            <td>{{ $arsip->tahun_angkatan }}</td>
                        <tr>
                    </table>
                </div>
            </div>
            <div class="card mt-3">
                <h5 class="card-header">Data Kriteria Mahasiswa</h5>
                <div class="card-body">
                    <table class="table table-borderless w-75">
                        @if ($arsip->nama_ayah == null || $arsip->nama_ayah == '')
                        @else
                        <tr>
                            <th>Nama Ayah</th>
                            <td>:</td>
                            <td>{{ $arsip->nama_ayah }}</td>
                        </tr>
                        @endif
                        @if ($arsip->nama_ibu == null || $arsip->nama_ibu == '')
                        @else
                        <tr>
                            <th>Nama Ibu</th>
                            <td>:</td>
                            <td>{{ $arsip->nama_ibu }}</td>
                        </tr>
                        @endif
                        @if ($arsip->nama_wali == null || $arsip->nama_wali == '')
                        @else
                        <tr>
                            <th>Nama Wali</th>
                            <td>:</td>
                            <td>
                                {{ $arsip->nama_wali }}
                            </td>
                        </tr>
                        @endif
                        @if ($arsip->pekerjaan_orangtua_wali == null ||  $arsip->pekerjaan_orangtua_wali == '')
                        @else
                        <tr>
                            <th>Pekerjaan Orang Tua/Wali</th>
                            <td>:</td>
                            <td>{{ $arsip->pekerjaan_orangtua_wali }}</td>
                        </tr>
                        @endif
                        @foreach ($penilaianarsip as $data => $nilai)
                            @foreach ($nilai as $data)
                                <tr>
                                    <th>{{ $data->kriteria }}</th>
                                    <td>:</td>
                                    <td>{{ $data->subkriteria }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        @if ($arsip->foto_kartu_keluarga == null || $arsip->foto_kartu_keluarga == '')
                        @else
                        <tr>
                            <th>Foto Kartu Keluarga</th>
                            <td>:</td>
                            <td><a href="{{ asset('fotoarsip/foto_kartu_keluarga/' . $arsip->foto_kartu_keluarga) }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('fotoarsip/foto_kartu_keluarga/' . $arsip->foto_kartu_keluarga) }}"
                                        class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                            </td>
                        </tr>
                        @endif
                        @if ($arsip->foto_KTP_orangtua == null || $arsip->foto_KTP_orangtua == '')
                        @else
                        <tr>
                            <th>Foto KTP Orang Tua/Wali</th>
                            <td>:</td>
                            <td><a href="{{ asset('fotoarsip/foto_KTP_orangtua/' . $arsip->foto_KTP_orangtua) }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('fotoarsip/foto_KTP_orangtua/' . $arsip->foto_KTP_orangtua) }}"
                                        class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Foto Tempat Tinggal</th>
                            <td>:</td>
                            <td>
                                @if ($arsip->foto_tempat_tinggal == null || $arsip->foto_tempat_tinggal == '')
                                -
                                @else
                                <a href="{{ asset('fotoarsip/foto_tempat_tinggal/' . $arsip->foto_tempat_tinggal) }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('fotoarsip/foto_tempat_tinggal/' . $arsip->foto_tempat_tinggal) }}"
                                        class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                                    @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Foto Slip Gaji</th>
                            <td>:</td>
                            <td>
                                @if ($arsip->foto_slip_gaji == null || $arsip->foto_slip_gaji == '')
                                -
                                @else
                                <a href="{{ asset('fotoarsip/foto_slip_gaji/' . $arsip->foto_slip_gaji) }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('fotoarsip/foto_slip_gaji/' . $arsip->foto_slip_gaji) }}"
                                        class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Foto Bukti Pembayaran Listrik 3 Bulan Terakhir</th>
                            <td>:</td>
                            <td>
                                @if ($arsip->foto_daya_listrik == null || $arsip->foto_daya_listrik == '')
                                -
                                @else
                                <a href="{{ asset('fotoarsip/foto_daya_listrik/' . $arsip->foto_daya_listrik) }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('fotoarsip/foto_daya_listrik/' . $arsip->foto_daya_listrik) }}"
                                        class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                                @endif
                            </td>
                        </tr>
                        @if ($arsip->foto_kendaraan === null || $arsip->foto_kendaraan === '')
                        @else
                        <tr>
                                <th>Foto Kendaraan</th>
                                <td>:</td>
                                <td>
                                    <a href="{{ asset('fotoarsip/foto_kendaraan/' . $arsip->foto_kendaraan) }}"
                                        data-fancybox="gallery">
                                        <img src="{{ asset('fotoarsip/foto_kendaraan/' . $arsip->foto_kendaraan) }}"
                                            class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                                </td>
                        </tr>
                        @endif
                        @if ($arsip->foto_beasiswa === null || $arsip->foto_beasiswa === '')
                        @else
                        <tr>
                                <th>Foto Bukti Bantuan Pemerintah</th>
                                <td>:</td>
                                <td>
                                    <a href="{{ asset('fotoarsip/foto_beasiswa/' . $arsip->foto_beasiswa) }}"
                                        data-fancybox="gallery">
                                        <img src="{{ asset('fotoarsip/foto_beasiswa/' . $arsip->foto_beasiswa) }}"
                                            class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                                </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="card mt-3">
                <h5 class="card-header">Penetapan Golongan UKT</h5>
                <table class="table table-borderless w-75">
                    <tr>
                        <th>Golongan</th>
                        <td>:</td>
                        <td style="font-size: 16px">
                            {{ $arsip->nama_golongan }}
                        </td>
                    </tr>
                    <tr>
                        <th>Nominal</th>
                        <td>:</td>
                        <td>Rp {{ number_format($arsip->nominal) }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div>
            <button class="btn btn-secondary btn-sm " type="button" onclick="goBack()">Kembali</button>
        </div>
    </div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }
</script>
