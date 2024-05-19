@extends('layouts.app')

@section('content')
    <div class="row">
        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4 m-auto text-center">
                            <span class="badge bg-label-primary rounded">
                                <i class="m-0 menu-icon tf-icons bx bx-group bx-lg"></i></span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body px-1">
                                <h5 class="card-title">Jumlah Mahasiswa</h5>
                                <p class="card-text">
                                    {{ $mahasiswa }} <br>
                                    <a href="{{ route('mahasiswa.index') }}"
                                        style="text-decoration:underline; text-blue-600 hover:text-blue-800">Lihat data!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->check())
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4 m-auto text-center">
                            <span class="badge bg-label-danger rounded">
                                <i class="m-0 menu-icon tf-icons bx bx-time bx-lg"></i>
                            </span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body px-1">
                                <h5 class="card-title">Menunggu Verifikasi</h5>
                                <p class="card-text">
                                    {{ $berkas }} <br>
                                    <a href="{{ route('admin.menunggu-verifikasi') }}"
                                        style="text-decoration:underline;
                                    text-blue-600 hover:text-blue-800">Lihat
                                        data!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4 m-auto text-center">
                            <span class="badge bg-label-success rounded"><i
                                    class="m-0 menu-icon tf-icons bx bx-check bx-lg"></i></span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body px-1">
                                <h5 class="card-title">Lulus Verifikasi </a></h5>
                                <p class="card-text">
                                    {{ $berkas_lulus_verifikasi }} <br>
                                    <a href="{{ route('admin.lulus-verifikasi') }}"
                                        style="text-decoration:underline;
                                    text-blue-100 hover:text-blue-100">Lihat
                                        data!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (Auth::guard('mahasiswa')->check())
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">
                        Status Kelengkapan Berkas &nbsp;
                        @if ($berkas == null || $berkas->status == 'Belum Lengkap')
                            <span class="badge bg-danger">Belum Lengkap</span>
                        @elseif($berkas->status == 'Menunggu Verifikasi')
                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                        @else
                            <span class="badge bg-primary">Lulus Verifikasi</span>
                        @endif
                    </h5>
                </div>
            </div>
            <div class="col-md-12 py-3">
                <div class="card">
                    <h5 class="card-header">Profil Mahasiswa</h5>
                    <div class="card-body">
                        <table class="table table-borderless w-75">
                            <tr>
                                <th>No.Pendaftaran</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->no_telepon }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Program Studi</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->prodi->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenjang</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->prodi->jenjang }}</td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->prodi->jurusan->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jalur Pendaftaran</th>
                                <td>:</td>
                                <td>{{ $mahasiswa->jalur }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @if (isset($berkas))
                    @if ($berkas->status == 'Lulus Verifikasi')
                        <div class="card mt-3">
                            <h5 class="card-header">Penetapan UKT</h5>
                            <div class="card-body">
                                <table class="table table-borderless w-50">
                                    <tr>
                                        <th>Golongan</th>
                                        <td>:</td>
                                        <td>{{ $berkas->golongan->nama }}
                                    </tr>
                                    <tr>
                                        <th>Nominal</th>
                                        <td>:</td>
                                        <td>Rp{{ number_format($berkas->nominal_ukt,0,',','.') }}</td>
                                    </tr>
                                </table>
                                <table class="table table-borderless w-50">
                                    <tr>
                                        <td><a href="http://online.sia.politanisamarinda.ac.id/daftar_ulang/" style="text-decoration:underline;
                                            text-blue-100 hover:text-blue-100;font-weight: bold;" target="_blank">Klik Untuk Melakukan Daftar Ulang !</a></td>
                                    <tr>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        @endif
    </div>
@endsection
