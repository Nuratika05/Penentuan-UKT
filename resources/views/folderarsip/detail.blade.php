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
                    </table>
                </div>
            </div>
            <div class="card mt-3">
                <h5 class="card-header">Data Kriteria Mahasiswa</h5>
                <div class="card-body">
                    <table class="table table-borderless w-75">
                        @foreach ($penilaianarsip as $data => $nilai)
                                @foreach ($nilai as $data)
                                    <tr>
                                        <th>{{ $data->kriteria }}</th>
                                        <td>:</td>
                                        <td>{{ $data->subkriteria }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            <tr>
                                <th>Foto Tempat Tinggal</th>
                                <td>:</td>
                                <td><a href="{{ asset('fotoarsip/foto_tempat_tinggal/' . $arsip->foto_tempat_tinggal) }}"
                                        data-fancybox="gallery">
                                        <img src="{{ asset('fotoarsip/foto_tempat_tinggal/' . $arsip->foto_tempat_tinggal) }}"
                                            class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                                </td>
                            </tr>

                            <tr>
                                <th>Foto Slip Gaji</th>
                                <td>:</td>
                                <td><a href="{{ asset('fotoarsip/foto_slip_gaji/' . $arsip->foto_slip_gaji) }}"
                                        data-fancybox="gallery">
                                        <img src="{{ asset('fotoarsip/foto_slip_gaji/' . $arsip->foto_slip_gaji) }}"
                                            class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a></td>
                            </tr>
                            <tr>
                                <th>Foto Daya Listrik</th>
                                <td>:</td>
                                <td><a href="{{ asset('fotoarsip/foto_daya_listrik/' . $arsip->foto_daya_listrik) }}"
                                        data-fancybox="gallery">
                                        <img src="{{ asset('fotoarsip/foto_daya_listrik/' . $arsip->foto_daya_listrik) }}"
                                            class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a></td>
                            </tr>
                            <tr>
                                @if ($arsip->foto_kendaraan === null || $arsip->foto_kendaraan === '')
                                @else
                                    <th>Foto Kendaraan</th>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ asset('fotoarsip/foto_kendaraan/' . $arsip->foto_kendaraan) }}"
                                            data-fancybox="gallery">
                                            <img src="{{ asset('fotoarsip/foto_kendaraan/' . $arsip->foto_kendaraan) }}"
                                                class="rounded img-fluid" width="300px" alt="Deskripsi Gambar"></a>
                                    </td>
                                @endif
                            </tr>
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
        <div>
            <button class="btn btn-secondary " type="button" onclick="goBack()">Kembali</button>
        </div>
    </div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }
</script>
