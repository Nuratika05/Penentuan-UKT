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
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>UKT Mahasiswa</h4>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <a class="btn btn-secondary btn-sm" type="close" href="{{ route('arsip.index') }}">kembali</a><br>
            <br>
        </div>
        <div class="col-md-6 text-end m-auto">
                <div class="col-md-12 mb-5">
                    <a href="#" id="deleteAll" class="btn btn-outline-danger float-end mb-1 btn-sm" >Hapus</a>
                    <a href="{{ route('arsip.export', $folder->id) }}" class="btn btn-outline-success float-end mb-1 btn-sm">Export</a>
                    <a href="{{ route('arsip.printarsip', $folder->id) }}" class="btn btn-outline-secondary float-end mb-1 btn-sm">Print</a>
                </div>
            </div>
        </div>
        <div class="card p-4">
            <div class="table-responsive text-nowrap">
                <table class="datatable table py-3">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="centang_semua"></th>
                            <th>No</th>
                            <th>Folder</th>
                            <th>No.Pendaftaran</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Jenjang</th>
                            <th>Jurusan</th>
                            <th>Jalur</th>
                            <th>Verifikator</th>
                            <th>Angkatan </th>
                            <th>Golongan </th>
                            <th>Nominal </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($arsip as $item)
                            <tr id="arsip_ids{{ $item->id }}">
                                <td><input type="checkbox" class="centang_data" name="ids" value="{{ $item->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->folder->nama }}</td>
                                <td>{{ $item->no_pendaftaran }}</td>
                                <td>{{ $item->nama_mahasiswa }}</td>
                                <td>{{ $item->nama_prodi }}</td>
                                <td>{{ $item->jenjang }}</td>
                                <td>{{ $item->nama_jurusan }}</td>
                                <td>{{ $item->jalur }}</td>
                                <td>{{ $item->admin }}</td>
                                <td>{{ $item->tahun_angkatan }}</td>
                                <td>{{ $item->nama_golongan }}</td>
                                <td>Rp{{ number_format($item->nominal) }}</td>
                                <td>
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('arsip.detail', $item->id) }}">Lihat Detail</a>
                                    <a class="btn btn-xs btn-secondary"
                                        href="{{ route('arsip.print', $item->id) }}">Print</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
                            url: "{{ route('admin.arsipp.hapusarsip') }}",
                            type: "POST",
                            data: {
                                ids: ids,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response){
                            if (response.success) {
                                alert(response.message);
                                $.each(ids, function(key, val){
                                    $('#arsip_ids' + val).remove();
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
