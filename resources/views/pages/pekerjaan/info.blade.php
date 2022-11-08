@extends('layouts.simple.master')
@section('title', 'Detail')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/rating.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <style>
        #mapid {
            height: 300px;
            z-index: 0;
        }
    </style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Detail</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Detail</li>
    <li class="breadcrumb-item active">Kegiatan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row product-page-main p-0">
            <div class="col-xl-4 xl-cs-65 box-col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="product-slider owl-carousel owl-theme" id="sync1">
                            @foreach ($foto as $f)
                                <div class="item"><img src="{{ $f->path }}" alt=""></div>
                            @endforeach
                        </div>
                        <div class="owl-carousel owl-theme" id="sync2">
                            @foreach ($foto as $f)
                                <div class="item"><img src="{{ $f->path }}" alt=""></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 xl-100 box-col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="product-page-details">
                            <h4>{{ $pekerjaan->nama_pekerjaan }}</h4>
                        </div>
                        <hr>
                        <div>
                            <table class="product-page-width">
                                <tbody>
                                    <tr>
                                        <td> <b>Pagu</b></td>
                                        @php
                                            $pagu = 'Rp' . number_format($pekerjaan->pagu, 2, ',', '.');
                                        @endphp
                                        <td>{{ $pagu ?: 'Data Belum Diinput' }}</td>
                                    </tr>
                                    <tr>
                                        <td> <b>Kontrak</b></td>
                                        @if (!is_null($pekerjaan->detail))
                                            @php
                                                $kontrak = 'Rp' . number_format($pekerjaan->detail->harga_kontrak, 2, ',', '.');
                                            @endphp
                                        @endif
                                        <td>{{ $kontrak ?? 'Nilai Belum Diinput' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Output</b></td>
                                    </tr>
                                    <tr>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    @if ($pekerjaan->output != null)
                                                    @foreach ($pekerjaan->output as $output)
                                                    <th>
                                                        {{ $output->komponen }}
                                                    </th>
                                                @endforeach
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @if ($pekerjaan->output != null)
                                                    @foreach ($pekerjaan->output as $output)
                                                    <td>
                                                        {{ $output->volume }} - {{ $output->satuan }}
                                                    </td>
                                                @endforeach
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </tr>
                                    <tr>
                                        <td><b>Realisasi</b></td>
                                        {{-- <td>{{ $pekerjaan->kec->n_kec }}</td> --}}
                                    </tr>
                                    <tr>
                                        {{-- <td><b>Program</b></td>
                                            <td>{{ $pekerjaan->kegiatan->program }}</td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="m-t-15">
                            <button class="btn btn-success m-r-10" type="button" title="" data-bs-toggle="modal"
                                data-bs-target="#modal-dokumen"> <i class="fa fa-file me-1"></i>Upload Dokumen</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 xl-cs-35 box-col-6">
                <div class="card">
                    <div class="card-body">
                        <!-- side-bar colleps block stat-->
                        <div class="collection-filter-block">
                            <ul class="pro-services">
                                <li>
                                    <div class="media">
                                        <i data-feather="archive"></i>
                                        <div class="media-body">
                                            <h5>Nomor Kontrak </h5>
                                            <p>{{ $pekerjaan->detail->no_spk ?? 'Data Belum Diinput' }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <i data-feather="flag"></i>
                                        <div class="media-body">
                                            <h5>Pelaksana </h5>
                                            <p>{{ $pekerjaan->detail->nama_pelaksana ?? 'Data Belum Diinput' }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <i data-feather="calendar"></i>
                                        <div class="media-body">
                                            <h5>Mulai </h5>
                                            <p>
                                                @if (is_null($pekerjaan->detail))
                                                    Data Belum Diinput
                                                @else
                                                    {{ Carbon\Carbon::parse($pekerjaan->detail->tgl_mulai)->locale('id')->formatLocalized('%A %d %B %Y') ?? 'data belum diinput' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <i data-feather="calendar"></i>
                                        <div class="media-body">
                                            <h5>Selesai </h5>
                                            <p>
                                                @if (is_null($pekerjaan->detail))
                                                    Data Belum Diinput
                                                @else
                                                    {{ Carbon\Carbon::parse($pekerjaan->detail->tgl_selesai)->locale('id')->formatLocalized('%A %d %B %Y') ?? 'data belum diinput' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <i data-feather="clock"></i>
                                        <div class="media-body">
                                            <h5>Masa Pelaksanaan</h5>
                                            <p>{{ $days ?? 'Data Belum Diinput' }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="mapid"></div>
                <div id="map"></div>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Dokumen</h5>
            </div>
            <div class="card-body">
                <ul>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($dokumen as $item)
                        <li>{{ $i++ }}. <a href="{{ $item->path }}">{{ $item->file }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Foto Kegiatan</h5>
            </div>
            <div class="gallery my-gallery card-body row" itemscope="">
                @foreach ($foto as $f)
                    <figure class="col-xl-3 col-md-4 col-6" itemprop="associatedMedia" itemscope="">
                        <a href="{{ $f->path }}" itemprop="contentUrl" data-size="300x300"><img
                                class="img-thumbnail" src="{{ $f->path }}" itemprop="thumbnail"
                                alt="Image description"></a>
                        <figcaption itemprop="caption description">
                            <form action="{{ route('foto.hapus', $f->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <div class="col">
                                    <button class="btn btn-danger w-100" type="submit">Hapus</button>
                                </div>
                            </form>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
            <!-- Root element of PhotoSwipe. Must have class pswp.-->
            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="pswp__bg"></div>
                <div class="pswp__scroll-wrap">
                    <div class="pswp__container">
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                    </div>
                    <div class="pswp__ui pswp__ui--hidden">
                        <div class="pswp__top-bar">
                            <div class="pswp__counter"></div>
                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                            <button class="pswp__button pswp__button--share" title="Share"></button>
                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                            <div class="pswp__preloader">
                                <div class="pswp__preloader__icn">
                                    <div class="pswp__preloader__cut">
                                        <div class="pswp__preloader__donut"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                            <div class="pswp__share-tooltip"></div>
                        </div>
                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                        <div class="pswp__caption">
                            <div class="pswp__caption__center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modal-dokumen" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Dokumen</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="" action="{{ route('dokumen.post') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <input type="text" value="{{ $pekerjaan->id }}" name="pekerjaan_id" hidden>
                                        <input type="text" value="{{ $pekerjaan->nama_pekerjaan }}"
                                            name="nama_pekerjaan" hidden>
                                        <input type="file" name="files[]" multiple class="form-control"
                                            accept="*">
                                        @if ($errors->has('files'))
                                            @foreach ($errors->get('files') as $error)
                                                <div class="invalid-feedback"><a
                                                        class="text-danger">{{ $error }}</a></div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <label for="">Keterangan</label>
                                        <textarea type="text" name="keterangan" class="form-control" id=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modal-output" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Ouput</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="" action="/target/output" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Target Output</label>
                                <div class="form-floating mb-3">
                                    <input type="text" name="pekerjaan_id" value="{{ $pekerjaan->id }}" hidden>
                                    <select name="komponen" id="komponen" class="form-control">
                                        <option value="Tangki Septik Komunal">Tangki Septik Komunal</option>
                                        <option value="Tangki Septik Individual">Tangki Septik Individual</option>
                                        <option value="Sambungan Rumah">Sambungan Rumah</option>
                                    </select>
                                    <label for="floating-input">Komponen</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="volume" type="number" class="form-control" id="floating-input"
                                        autocomplete="off">
                                    <label for="floating-input">Volume</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="satuan" type="text" class="form-control" id="floating-input"
                                        autocomplete="off">
                                    <label for="floating-input">Satuan</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js') }}/map.js"></script>

    <script src="{{ asset('assets/js/rating/jquery.barrating.js') }}"></script>
    <script src="{{ asset('assets/js/rating/rating-script.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/ecommerce.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
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
        var toastMixin = Swal.mixin({
            toast: true,
            icon: 'success',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    <script>
        @foreach ($foto as $data)
            var informasi = `
     <p>{{ $data->keterangan }}</p>
    `
            L.marker([{{ $data->lat }}, {{ $data->long }}])
                .addTo(mapid)
                .bindPopup(informasi);
        @endforeach
    </script>

    <script>
        jQuery(document).ready(function() {
            jQuery($('#program_id, #program')).on('change', function() {
                var kegID = jQuery(this).val();
                if (kegID) {
                    jQuery.ajax({
                        url: '/pekerjaan/kegiatan/rincian/' + kegID,
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

@endsection
