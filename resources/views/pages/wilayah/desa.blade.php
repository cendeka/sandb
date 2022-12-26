@extends('layouts.simple.master')

@section('title', 'Data Kontrak')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
    <h5>{{ $title }}</h5>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Wilayah</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Kecamatan {{ $kecamatan }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table id="example1" class="display">
                                <thead>
                                    <tr>
                                        <th style="width:20%">No</th>
                                        <th>Desa</th>
                                        <th>Luas Wilayah</th>
                                        <th>Jumlah Penduduk</th>
                                        <th>Penduduk Terlayani</th>
                                        <th>Persentase Layanan</th>
                                        <th>MCK</th>
                                        <th>Tangki Septik Individu</th>
                                        <th>Tangki Septik Komunal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        @php
                                            $total_mck = 0;
                                            $total_ts = 0;
                                            $total_tk = 0;
                                            $total_sr = 0;
                                        @endphp
                                        @foreach ($item->kegiatan as $mck)
                                            @foreach ($mck->output as $komponen)
                                                @php
                                                    if ($komponen->komponen == 'MCK') {
                                                        # code...
                                                        $total_mck += $komponen->volume;
                                                    }
                                                    if ($komponen->komponen == 'Tangki Septik') {
                                                        # code...
                                                        $total_ts += $komponen->volume;
                                                    }
                                                    if ($komponen->komponen == 'Tangki Septik Individu') {
                                                        # code...
                                                        $total_tk += $komponen->volume;
                                                    }
                                                    if ($komponen->komponen == 'Sambungan Rumah') {
                                                        # code...
                                                        $total_sr += $komponen->volume;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endforeach
                                        <tr>
                                            <td style="width: 10%">{{ $i++ }}</td>
                                            <td>{{ $item->n_desa }}</td>
                                            <td>{{ $item->luas }} m2</td>
                                            <td>{{ $item->jumlah_penduduk }} Jiwa</td>
                                            <td>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($item->kegiatan as $pekerjaan)
                                                    @if ($pekerjaan->rincian != null)
                                                        @php
                                                            $total += $pekerjaan->rincian->outcome;
                                                        @endphp
                                                    @else
                                                    @endif
                                                @endforeach
                                                {{ $total }}
                                            </td>
                                            <td>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($item->kegiatan as $pekerjaan)
                                                    @if ($pekerjaan->rincian != null)
                                                        @php
                                                            $penduduk_terlayani = $pekerjaan->rincian->outcome;
                                                            $jumlah_penduduk = $item->jumlah_penduduk;
                                                            $persentase = divnum($penduduk_terlayani, $jumlah_penduduk) * 100;
                                                        @endphp
                                                        @php
                                                            $total += $persentase;
                                                        @endphp
                                                    @else
                                                    @endif
                                                @endforeach
                                                {{ number_format($total, 2, ',', '.') }}%
                                            </td>
                                            <td>
                                                {{ $total_mck }}
                                            </td>
                                            <td>
                                                {{ $total_ts }}
                                            </td>
                                            <td>
                                                {{ $total_tk }}
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
            $('#example1_filter input').addClass('form-control form-control-sm'); // <-- add this line
            $('#example1_filter label').addClass('text-muted'); // <-- add this line
        });
    </script>
@endsection
