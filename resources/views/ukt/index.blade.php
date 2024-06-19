@extends('layouts.app')

@section('content')
<style>
    .alert-success {
        color: #005700;
        /* Warna hijau tua untuk teks */
        background-color: #DFF0D8;
        /* Warna latar belakang hijau muda yang sesuai dengan kelas alert-success bawaan Bootstrap */
        border-color: #005700;
        /* Warna border yang sesuai */
    }
</style>
@if (Auth::guard('admin')->check())
<div class="row">
    <div class="col-md-6">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Data UKT Mahasiswa</h4>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @elseif (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
    </div>
    <div class="col-md-6 text-end m-auto">
        <div class="col-md-12 mb-5">
            <a href="#" id="deleteAll" class="btn btn-outline-danger float-end mb-1 btn-sm">Hapus</a>
        </div>
    </div>
    <div class="card p-4">
        <div class="table-responsive text-nowrap">
            <table class="datatable table py-3">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="centang_semua"></th>
                        <th>No</th>
                        <th>No.Pendaftaran</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Jenjang</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th>Jalur</th>
                        <th>Verifikator</th>
                        <th>Golongan </th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($berkas as $item)
                        <tr id="dataukt_ids{{ $item->id }}">
                            <td><input type="checkbox" class="centang_data" name="ids" value="{{ $item->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mahasiswa->id }}</td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>{{ $item->mahasiswa->prodi->nama }}</td>
                            <td>{{ $item->mahasiswa->prodi->jenjang }}</td>
                            <td>{{ $item->mahasiswa->prodi->jurusan->nama }}</td>
                            <td>
                                @if ($item->status == 'Menunggu Verifikasi')
                                    <span class="badge bg-label-warning rounded">{{ $item->status }}</span>
                                @elseif($item->status == 'Belum Lengkap')
                                    <span class="badge bg-label-danger rounded">{{ $item->status }}</span>
                                @else
                                    <span class="badge bg-label-primary rounded">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>{{ $item->mahasiswa->jalur }}</td>
                            <td>
                                @if ($item->admin_id == null)
                                    -
                                @else
                                    {{ $item->admin->nama }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap' || $item->golongan_id == null)
                                    -
                                @else
                                    {{ $item->golongan->nama }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap' || $item->golongan_id == null)
                                    -
                                @else
                                    Rp {{ number_format($item->nominal_ukt, 0, ',', '.') }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'Menunggu Verifikasi' || $item->status == 'Belum Lengkap')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.data-ukt.edit', $item->id) }}">Lihat Detail</a>
                                @elseif ($item->status == 'Lulus Verifikasi')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.data-ukt.edit', $item->id) }}">Lihat Detail</a>
                                    <a class="btn btn-xs btn-secondary"
                                        href="{{ route('admin.data-ukt.print', $item->id) }}">Print</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif (Auth::guard('mahasiswa')->check())
<div class="row">
    <div class="col-md-8">
        <h4 class="fw-bold py-3 mb-4"></span> Data Kriteria Mahasiswa &nbsp;
            @if ($berkas == null || $berkas->status == 'Belum Lengkap')
                <span class="badge bg-danger">Belum Lengkap</span>
            @elseif($berkas->status == 'Menunggu Verifikasi')
                <span class="badge bg-warning">Menunggu Verifikasi</span>
            @else
                <span class="badge bg-primary">Lulus Verifikasi</span>
            @endif</h4>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>
    <div class="col-md-4 text-end m-auto">
        <a href="{{ route('data-ukt.edit', $berkas->id) }}" class="btn btn-outline-primary float-end mb-1 ">Edit
            Data
        </a>
        @if ($berkas->status == "Lulus Verifikasi")
        <a class="btn btn-outline-secondary float-end mb-1 "
            href="{{ route('data-ukt.print', $berkas->id) }}">Print</a>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card">
            @if ($berkas->status == 'Belum Lengkap')
            <div class="card-body">
                <div class="card mt-3" style="background-color: #ece49ce1">
                    <table class="table table-borderless w-75">
                            <span class="card-header text-black">KETERANGAN : <br>
                            <span class="text-danger">{{ $berkas->keterangan }} !</span>
                    </table>
                </div>
            </div>
            @endif
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
                            @if ($berkas->pekerjaan_orangtua_wali === null || $berkas->pekerjaan_orangtua_wali === '')
                            -
                            @else
                            {{ $berkas->pekerjaan_orangtua_wali }}
                            @endif
                        </td>
                    </tr>
                    <tr>
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
                        <th>Foto Kartu Keluarga</th>
                        <td>:</td>
                        <td>
                            @if ($berkas->foto_kartu_keluarga === null || $berkas->foto_kartu_keluarga === '')
                            -
                            @else
                            <img src="{{ asset('foto_kartu_keluarga/' . $berkas->foto_kartu_keluarga) }}"
                                class="rounded img-fluid" width="250px">

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
                            <img src="{{ asset('foto_KTP_orangtua/' . $berkas->foto_KTP_orangtua) }}"
                                class="rounded img-fluid" width="250px">
                            @endif
                            </td>
                    </tr>
                    <tr>
                        <th>Foto Tempat Tinggal</th>
                        <td>:</td>
                        <td><img src="{{ asset('foto_tempat_tinggal/' . $berkas->foto_tempat_tinggal) }}"
                                class="rounded img-fluid" width="250px"></td>
                    </tr>
                    <tr>
                        <th>Foto Slip Gaji</th>
                        <td>:</td>
                        <td><img src="{{ asset('foto_slip_gaji/' . $berkas->foto_slip_gaji) }}"
                                class="rounded img-fluid" width="250px"></td>
                    </tr>
                    <tr>
                        <th>Foto Daya Listrik</th>
                        <td>:</td>
                        <td><img src="{{ asset('foto_daya_listrik/' . $berkas->foto_daya_listrik) }}"
                                class="rounded img-fluid" width="250px"></td>
                    </tr>
                    @if ($berkas->foto_kendaraan === null || $berkas->foto_kendaraan === '')
                    @else
                        <tr>
                            <th>Foto Kendaraan</th>
                            <td>:</td>
                            <td><img src="{{ asset('foto_kendaraan/' . $berkas->foto_kendaraan) }}"
                                    class="rounded img-fluid" width="250px"></td>
                        </tr>
                    @endif
                    @if ($berkas->foto_beasiswa === null || $berkas->foto_beasiswa === '')
                    @else
                        <tr>
                            <th>Foto Bukti Bantuan Pemerintah</th>
                            <td>:</td>
                            <td><img src="{{ asset('foto_beasiswa/' . $berkas->foto_beasiswa) }}"
                                    class="rounded img-fluid" width="250px"></td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(function(e) {
        $("#centang_semua").click(function() {
            $('.centang_data').prop('checked', $(this).prop('checked'));
        });
        $('#deleteAll').click(function(e){
            e.preventDefault();
            var ids = [];
            $('input:checkbox[name=ids]:checked').each(function(){
                ids.push($(this).val());
            });

            if(ids.length > 0){
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: "{{ route('admin.data-ukt.hapussemua') }}",
                        type: "POST",
                        data: {
                            ids: ids,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response){
                        if (response.success) {
                            alert(response.message);
                            $.each(ids, function(key, val){
                                $('#dataukt_ids' + val).remove();
                            });
                            window.location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseJSON.message);
                    }
                });
            }
        } else {
            alert('Tidak ada data yang dipilih.');
        }
    });
});
</script>
@endsection
