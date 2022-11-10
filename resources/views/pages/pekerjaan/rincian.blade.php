@extends('layouts.simple.master')

@section('title', 'Data Kontrak')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css') }}">
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
    <h5>Detail Kegiatan</h5>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Detail</li>
    <li class="breadcrumb-item active">Kegiatan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Rincian Kegiatan</h5>
                        <span>Rincian kegiatan output dan outcome</span>
                        <div class="card-header-right">
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#modal-paket"
                                data-bs-original-title="" title=""> <span class="fa fa-edit"></span>
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table id="example1" class="display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        <th>Outcome</th>
                                        <th>Output</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td><a
                                                    href="/pekerjaan/{{ $item->pekerjaan->id }}">{{ $item->pekerjaan->nama_pekerjaan }}</a>
                                                <label
                                                    class="badge badge-success">{{ $item->aspirasi == 1 ? 'Aspirasi' : '' }}</label>
                                            </td>
                                            <td>{{ $item->outcome }} Jiwa</td>
                                            <td>
                                                @foreach ($item->output as $output)
                                                    {{ $output->komponen }} {{ $output->volume }} <br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modal-hapus{{ $item->id }}"><i
                                                                class="fa fa-trash"></i></button>
                                                    </div>
                                                    <div class="col">
                                                        <button class="btn btn-warning btn-edit" data-bs-toggle="modal"
                                                            data-bs-target="#modal-ubah{{ $item->id }}"> <i
                                                                class="fa fa-edit"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modal-paket" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal-content-tambah">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Rincian Kegiatan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-tambah">
                    <form class="needs-validation" novalidate="" action="{{ route('rincian.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="ta">Tahun Anggaran</label>
                                <select id="ta" value="" name="ta" class="form-control select">
                                    <option value="" selected>Pilih Tahun Anggaran</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Program</label>
                                <select id="program_id" name="program_id" class="form-control select" required
                                    style="width: 100%;">
                                    <option selected value="">Pilih Program/Kegiatan/Sub Kegiatan</option>
                                    <optgroup label="Pembangunan MCK">
                                        <option value="1">Pembangunan MCK Komunal</option>
                                        <option value="2">Pembangunan MCK Skala Individu</option>
                                    </optgroup>
                                    <optgroup label="SPALD-T">
                                        <option value="3">Pembangunan IPAL Skala Permukiman minimal 50 KK</option>
                                        <option value="4">Pembangunan IPAL Skala Permukiman kombinasi MCK minimal 50 KK
                                        </option>
                                    </optgroup>
                                    <optgroup label="SPALD-S">
                                        <option value="5">Pembangunan tangki septik komunal (5-10 KK) </option>
                                        <option value="6">Pembangunan tangki septik skala individual perdesaan minimal
                                            50 KK </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pekerjaan_id">Kegiatan</label>
                                <select id="pekerjaan_id" value="" name="pekerjaan_id" class="form-control select"
                                    style="width: 100%;" required>
                                    <option value="">Pilih Kegiatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label">Target Outcome</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <input type="number" name="outcome" class="form-control" placeholder="Jiwa">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label">Target Output</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <table class="table" id="divOutput">
                                        <tr>
                                            <input type="hidden" name="output[0][id]" class="form-control"
                                                    placeholder="Komponen">
                                            <td><input type="text" name="output[0][komponen]" class="form-control"
                                                    placeholder="Komponen"></td>
                                            <td><input type="number" name="output[0][volume]" class="form-control"
                                                    placeholder="Volume"></td>
                                            <td><input type="text" name="output[0][satuan]" class="form-control"
                                                    placeholder="Satuan"></td>
                                            <td><button type="button" name="add" id="tambah-output"
                                                    class="btn btn-outline-primary">Tambah</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach ($data as $d)
        <div class="modal modal-blur fade" id="modal-hapus{{ $d->id }}" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <h3>Apakah anda yakin?</h3>
                        <div class="text-muted">Hapus Rincian Kegiatan {{ $d->pekerjaan->nama_pekerjaan }}</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Batal
                                    </a></div>
                                <form action="{{ route('rincian.destroy', $d->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="col">
                                        <button class="btn btn-danger w-100" type="submit">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($data as $d)
        <div class="modal fade bd-example-modal-lg" id="modal-ubah{{ $d->id }}" role="dialog" tabindex="-1"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" id="modal-content-ubah">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Rincian</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal-ubah">
                        <form class="needs-validation" novalidate="" action="{{ route('rincian.update', $d->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <input type="text" value="{{ $d->id }}" name="id" id="rincianID" hidden>
                                <div class="mb-3">
                                    <label for="tahun_anggaran">Tahun Anggaran</label>
                                    <select id="tahun_anggaran" name="ta" class="form-control select">
                                        <option value="" selected>Pilih Tahun Anggaran</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Program</label>
                                    <select id="program" name="program_id"
                                        class="form-control select2 select2-offscreen selek" required
                                        style="width: 100%;">
                                        @foreach ($program as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $d->pekerjaan->program_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->detail_kegiatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pekerjaan_id">Kegiatan</label>
                                    <select id="kegiatan" value="" name="pekerjaan_id" class="form-control"
                                        required>
                                        <option value="{{ $d->pekerjaan->id }}">{{ $d->pekerjaan->nama_pekerjaan }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <label class="form-label">Target Outcome</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <input id="outcome" type="number" value="{{ $d->outcome }}"
                                                name="outcome" class="form-control" placeholder="Jiwa">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <label class="form-label">Target Output</label> <br><button type="button"
                                                name="add" id="update-output"
                                                class="btn btn-outline-primary">Tambah</button>
                                        </div>
                                        <table class="table" id="komponen">
                                            @foreach ($d->output as $key => $output)
                                                <tr>
                                                        <input type="hidden" name="output[{{ $key }}][id]"
                                                            value="{{ $output->id }}">
                                                    <td><input type="text"
                                                            name="output[{{ $key }}][komponen]"
                                                            class="form-control" placeholder="Komponen"
                                                            value="{{ $output->komponen }}"></td>
                                                    <td><input type="number" name="output[{{ $key }}][volume]"
                                                            class="form-control" placeholder="Volume"
                                                            value="{{ $output->volume }}"></td>
                                                    <td><input type="text" name="output[{{ $key }}][satuan]"
                                                            class="form-control" placeholder="Satuan"
                                                            value="{{ $output->satuan }}"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-danger remove-output-field"
                                                            href="javascript:void(0)"
                                                            onclick="hapus({{ $output->id }})">Hapus</button>
                                                        {{-- <button type="button" name="add" class="btn btn-outline-danger remove-output-field">Hapus</button> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/custom.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <script>
        @if ($errors->any())
            Swal.fire({
                title: 'Error!',
                text: '{{ implode('', $errors->all(':message')) }}',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                ordering: true,
                info: true,
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-dark',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-dark',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-dark',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-dark',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                ]
            });
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery($('#ta, #program_id')).on('change', function() {
                var ta = jQuery('#ta').val();
                var kegID = jQuery('#program_id').val();
                if (kegID) {
                    jQuery.ajax({
                        url: '/pekerjaan/kegiatan/rincian/' + kegID + '/' + ta + '',
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery($('#pekerjaan_id, #kegiatan')).empty();
                            jQuery.each(data, function(key, value) {
                                $($('#pekerjaan_id, #kegiatan')).append(
                                    '<option value="' +
                                    value.id + '">' + value.nama_pekerjaan +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $($('#pekerjaan_id')).empty();
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery($('#tahun_anggaran, #program')).on('change', function() {
                var ta = jQuery('#ta').val();
                var kegID = jQuery('#program').val();
                if (kegID) {
                    jQuery.ajax({
                        url: '/pekerjaan/kegiatan/rincian/' + kegID + '/' + ta + '',
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery($('#kegiatan')).empty();
                            jQuery.each(data, function(key, value) {
                                $($('#kegiatan')).append(
                                    '<option value="' +
                                    value.id + '">' + value.nama_pekerjaan +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $($('#pekerjaan_id')).empty();
                }
            });
        });
    </script>
    <script>
        var i = 0;
        $("#tambah-output, #update-output").click(function() {
            ++i;
            var a = '<tr>' +
                '<input type="hidden" name="output[' + i + '][id]" class="form-control">' +
                ' <td><input type="text" name="output[' + i + '][komponen]" class="form-control"' +
                'placeholder="Komponen"></td>' +
                '<td><input type="number" name="output[' + i + '][volume]" class="form-control"' +
                'placeholder="Volume"></td>' +
                '<td><input type="text" name="output[' + i + '][satuan]" class="form-control"' +
                'placeholder="Satuan"></td>' +
                '<td><button type="button" name="add"' +
                'class="btn btn-outline-danger remove-output-field">Hapus</button></td>' +
                '</tr>'
            $("#divOutput, #komponen").append(a);
        });
        $(document).on('click', '.remove-output-field', function() {
            $(this).parents('tr').remove();
        });
    </script>
    <script>
            function hapus(id) {
            var url = '{{ route('output.destroy') }}';
            var id = id;
            Swal.fire({
                title: "Apakah Anda Yakin ?",
                text: "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Tetap Hapus!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: function(response) {
                            swal.fire({
                                title: 'Hapus Data',
                                text: 'Data Berhasil Dihapus.',
                                icon: 'success',
                                timer: 2000,
                            });
                        }
                    })
                }
            })
        }
    </script>
@endsection
