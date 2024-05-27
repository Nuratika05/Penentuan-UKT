@extends('layouts.app')

@section('content')
    <div class="row">
        @if (Auth::guard('admin')->check())
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4 m-auto text-center">
                            <span class="badge bg-label-warning rounded">
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
                            <span class="badge bg-label-danger rounded">
                                <i class="m-0 menu-icon tf-icons bx bx-error-circle bx-lg"></i>
                            </span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body px-1">
                                <h5 class="card-title">Belum Lengkap</h5>
                                <p class="card-text">
                                    {{ $berkas_belum_lengkap }} <br>
                                    <a href="{{ route('admin.data-belum-lengkap') }}"
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
                                class="m-0 menu-icon tf-icons bx bx-check bx-lg"></i>
                            </span>
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
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="card-body px-1 text-center">
                            <h5 class="card-title">Link Daftar Ulang</h5>
                                @php
                                    $allLinksEmpty = true;
                                @endphp
                                @foreach ($link as $item)
                                    @if($item->url != null && $item->url != '')
                                        @php
                                            $allLinksEmpty = false;
                                        @endphp
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#linkModal">
                                            Lihat link!
                                        </button>
                                    @endif
                                @endforeach
                                @if($allLinksEmpty)
                                <p>Belum ada Link</p>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addLinkModal">
                                    Tambah Link!
                                </button>
                                @endif

                                <!-- Modal Lihat Link -->
                                <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="addLinkModalLabel"
                                    aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($link as $item)
                                                    @if ($item->isActive)
                                                        <h6><a href="{{ $item->url }}" class="link-url">{{ $item->url }}</a></h6>
                                                        <h6>Aktif dari ({{ \Carbon\Carbon::parse($item->tanggal_aktif)->format('d-m-Y') }}) sampai ({{ \Carbon\Carbon::parse($item->tanggal_mati)->format('d-m-Y') }})</h6>
                                                    @else
                                                        <h6 class="link-url">{{ $item->url }}</a></h6>
                                                        <h6>Aktif dari ({{ \Carbon\Carbon::parse($item->tanggal_aktif)->format('d-m-Y') }}) sampai ({{ \Carbon\Carbon::parse($item->tanggal_mati)->format('d-m-Y') }})</h6>
                                                    @endif
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLinkModal{{ $item->id }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('links.destroy', $item->id) }}" method="POST" style="display: inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus link ini?')">Hapus</button>
                                                    </form>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- modal tambah -->
                        <div class="modal fade @if(session('modal') == 'addLinkModal') show @endif" id="addLinkModal" tabindex="-1" role="dialog" aria-labelledby="addLinkModalLabel"
                            aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addLinkModalLabel">Buat Link Daftar Ulang</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('links.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3" autocomplete="off">
                                                <label for="url" class="form-label">Link URL</label>
                                                <div class="input-group">
                                                    <input type="text" name="url" id="url"
                                                        class="form-control @error('url') is-invalid @enderror" required>
                                                </div>
                                                @error('url')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3" autocomplete="off">
                                                <label for="tanggal_aktif" class="form-label">Tanggal Aktif</label>
                                                <div class="input-group">
                                                    <input type="date" name="tanggal_aktif" id="tanggal_aktif"
                                                        class="form-control @error('tanggal_aktif') is-invalid @enderror" required>
                                                </div>
                                                @error('tanggal_aktif')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3" autocomplete="off">
                                                <label for="tanggal_mati" class="form-label">Tanggal Mati </label> <span
                                                class="text-danger" style="font-size: 15px;"><i> *boleh dikosongkan</i></span>
                                                <div class="input-group">
                                                    <input type="date" name="tanggal_mati" id="tanggal_mati"
                                                        class="form-control @error('tanggal_mati') is-invalid @enderror">
                                                </div>
                                                @error('tanggal_mati')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                onClick="return confirm('Yakin link yang dimasukkan sudah benar?')">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        @foreach ($link as $item)
                        <div class="modal fade @if(session('modal') == 'editLinkModal'.$item->id) show @endif" id="editLinkModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editLinkModalLabel"
                            aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editLinkModalLabel">Edit Link Daftar Ulang</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('links.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="url" class="form-label">Link URL</label>
                                                <input type="text" name="url" id="url" class="form-control"
                                                    value="{{ old('url', $item->url) }}" required>
                                                @error('url')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_aktif" class="form-label">Tanggal Aktif</label>
                                                <input type="date" name="tanggal_aktif" id="tanggal_aktif" class="form-control"
                                                    value="{{ old('tanggal_aktif', $item->tanggal_aktif) }}" required>
                                                @error('tanggal_aktif')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_mati" class="form-label">Tanggal Mati </label><span
                                                class="text-danger" style="font-size: 15px;"><i> *boleh dikosongkan</i></span>
                                                <input type="date" name="tanggal_mati" id="tanggal_mati" class="form-control"
                                                    value="{{ old('tanggal_mati', $item->tanggal_mati) }}">
                                                @error('tanggal_mati')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                class="btn btn-primary btn-sm"onClick="return confirm('Yakin ingin mengubah data?')">Ubah
                                                Link</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        @elseif (Auth::guard('mahasiswa')->check())
            <div class="col-md-12">
                    <h4 class="fw-bold py-3 mb-4">
                        Status Kelengkapan Berkas &nbsp;
                        @if ($berkas == null || $berkas->status == 'Belum Lengkap')
                            <span class="badge bg-danger">Belum Lengkap</span>
                        @elseif($berkas->status == 'Menunggu Verifikasi')
                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                        @else
                            <span class="badge bg-primary">Lulus Verifikasi</span>
                        @endif
                    </h4>
            </div>
            <div class="col-md-12 py-3">
                <div class="card">
                    <h4 class="card-header" style="">Profil Mahasiswa</h4>
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
                            <h4 class="card-header">Penetapan UKT</h4>
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
                                @if ($links->isEmpty())
                                @else
                                <table class="table table-borderless w-50">
                                    @foreach ($links as $link)
                                        @if (!empty($link->url))
                                        <tr>
                                            <td>
                                                @if ($link->isActive)
                                                    <a href="{{ $link->url }}" style="text-decoration:underline; color: blue;">Klik Untuk Melakukan Daftar Ulang</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </table>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        @endif
    </div>
@endsection

