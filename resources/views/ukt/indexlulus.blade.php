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
            @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
                <a id="search" class="text-align =center"></a><br>
            @endif
        </div>
        <div class="col-md-6 text-end m-auto">
            <div class="col-md-12 mb-5">
                <a href="#" id="deleteAll" class="btn btn-outline-danger float-end mb-1 btn-sm">Hapus</a>
                <a href="{{ route('datauktexport') }}" class="btn btn-outline-success float-end mb-1 btn-sm">Export</a>
                <a href="{{ route('admin.data-ukt.printukt') }}" class="btn btn-outline-secondary float-end mb-1 btn-sm">Print</a>
                <!-- Tombol Arsipkan -->
                @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
                    <button id="arsipkan" class="btn btn-outline-secondary float-end mb-1 btn-sm" data-toggle="modal"
                        data-target="#arsipModal" >Arsipkan</button>

                    <!-- Modal Arsip -->
                    <div class="modal fade" id="arsipModal" tabindex="-1" role="dialog" aria-labelledby="arsipModalLabel"
                        aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form id="arsipForm">
                                        @csrf

                                    <p style="font-weight: bold;">Jumlah data yang dipilih: <span id="jumlahDipilih">0</span></p>
                                        <div class="form-group">
                                            <select name="id_folder" class="form-select" autofocus required>
                                                <option value="" selected disabled>--Pilih Folder--</option>
                                                @foreach ($folder as $fol)
                                                    <option value="{{ $fol->id }}">{{ $fol->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="number" id="tahun_angkatan" name="tahun_angkatan"
                                                class="form-control" placeholder="Masukkan Tahun Angkatan" required>
                                        </div>
                                        <br>
                                        <button type="submit" id="arsipButton"
                                            class="btn btn-primary btn-sm">Arsipkan</button>
                                        <a class=" close btn btn-secondary btn-sm" type="button" data-dismiss="modal"
                                            style="color: white;">Kembali</a>
                                    </id=>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
                                <a class="btn btn-xs btn-primary"
                                    href="{{ route('admin.data-ukt.edit', $item->id) }}">Lihat Detail</a>
                                <a class="btn btn-xs btn-secondary"
                                    href="{{ route('admin.data-ukt.print', $item->id) }}">Print</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        $(document).ready(function() {
            var table = $('.datatable').DataTable({});
            table.columns(8).every(function() {
                var column = this;
                var uniqueValues = column.data().unique().sort().toArray();
                var maxWidth = 0;
                $.each(uniqueValues, function(index, value) {
                    var tempSpan = $('<span style="visibility:hidden;white-space:nowrap;">' +
                        value + '</span>').appendTo('body');
                    maxWidth = Math.max(maxWidth, tempSpan.width());
                    tempSpan.remove();
                });

                var select = $(
                        '<select class="form-select" id="jalur_pendaftaran"><option value=""  selected>--Pilih Jalur Pendaftaran--</option></select>'
                    )
                    .css('min-width', maxWidth + 'px')
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                        if (val) {
                            $('.centang_data').prop('checked', false);
                            $('.centang_data[data-jalur="' + val + '"]').prop('checked', true);
                            $('#centang_semua').prop('checked', $('.centang_data').length === $(
                                '.centang_data:checked').length);
                            updateJumlahArsipkan();
                        }
                    });

                $.each(uniqueValues, function(index, value) {
                    select.append('<option value="' + value + '">' + value + '</option>');
                });

                $('#search').append(select);
            });

            $('#centang_semua').on('change', function() {
                $('.centang_data').prop('checked', $(this).prop('checked'));
                updateJumlahArsipkan();
            });

            $('.centang_data').on('change', function() {
                var semua_tercentang = true;
                $('.centang_data').each(function() {
                    if (!$(this).prop('checked')) {
                        semua_tercentang = false;
                    }
                });
                $('#centang_semua').prop('checked', semua_tercentang);
                updateJumlahArsipkan();
            });

            $('#arsipkan').click(function() {
                var jumlahDipilih = $('input[type="checkbox"]:checked').length;
                $('#jumlahDipilih').text(jumlahDipilih);
            });

            $('#arsipForm').submit(function(e) {
                e.preventDefault();
                var ids = [];
                $('input:checkbox[name=ids]:checked').each(function() {
                    ids.push($(this).val());
                });

                if(ids.length > 0){
                    if (confirm('Apakah Anda yakin ingin mengarsipkan data ini?')) {
                        var formData = new FormData(this);
                        formData.append('ids', JSON.stringify(ids));

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('admin.lulus-verifikasi.arsip') }}",
                            processData: false,  // Set false jika Anda menggunakan FormData
                            contentType: false,
                            data: formData,
                            success: function(response) {
                                $('#arsipModal').modal('hide');
                                if (response.success) {
                                        alert(response.message);
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
