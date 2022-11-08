@extends('layouts.simple.master')

@section('title', 'Data Foto Kegiatan')

@section('css')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/photoswipe.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin="" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>
<style>
    #map {
        height: 300px;
        z-index: 0;
    }

    #mapid {
        height: 300px;
        z-index: 0;
    }
</style>
<script src="{{ asset('js') }}/getloc.js"></script>
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Kegiatan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Dokumentasi Foto Kegiatan</h5>
                        <div class="card-header-right">
                            <a class="btn btn-primary m-r-10" type="button" title="" data-bs-toggle="modal"
                            data-bs-target="#modal-foto"> <i class="fa fa-camera me-1"></i> Upload Foto</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="my-gallery row grid gallery-with-description" id="aniimated-thumbnials" itemscope="">
                            @foreach ($foto as $item)
                                <figure class="grid-item col-xl-3 col-sm-6" itemprop="associatedMedia" itemscope="">
                                    <a href="{{ $item->path }}" itemprop="contentUrl" data-size="1600x950">
                                        <img class="img-thumbnail" src="{{ $item->path }}" itemprop="thumbnail"
                                            alt="Image description">
                                        <div class="caption">
                                            @foreach ($item->pekerjaan as $pekerjaan)
                                                <a
                                                    href="/pekerjaan/{{ $pekerjaan->id }}">{{ $pekerjaan->nama_pekerjaan }}</a>
                                            @endforeach
                                        </div>
                                    </a>
                                    <figcaption itemprop="caption description">
                                        @foreach ($item->pekerjaan as $pekerjaan)
                                            <a href="/pekerjaan/{{ $pekerjaan->id }}">{{ $pekerjaan->nama_pekerjaan }}</a>
                                        @endforeach
                                    </figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                    <!-- Root element of PhotoSwipe. Must have class pswp.-->
                    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                        <!--
              Background of PhotoSwipe.
              It's a separate element, as animating opacity is faster than rgba().
              -->
                        <div class="pswp__bg"></div>
                        <!-- Slides wrapper with overflow:hidden.-->
                        <div class="pswp__scroll-wrap">
                            <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
                            <!-- don't modify these 3 pswp__item elements, data is added later on.-->
                            <div class="pswp__container">
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                            </div>
                            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                            <div class="pswp__ui pswp__ui--hidden">
                                <div class="pswp__top-bar">
                                    <!-- Controls are self-explanatory. Order can be changed.-->
                                    <div class="pswp__counter"></div>
                                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                    <button class="pswp__button pswp__button--share" title="Share"></button>
                                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                                    <!-- element will get class pswp__preloader--active when preloader is running-->
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
                                <button class="pswp__button pswp__button--arrow--left"
                                    title="Previous (arrow left)"></button>
                                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                                <div class="pswp__caption">
                                    <div class="pswp__caption__center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modal-foto" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Foto</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" action="{{ route('foto.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="mb-3">
                                        <label for="tahun_anggaran">Tahun Anggaran</label>
                                        <select id="tahun_anggaran" name="ta" class="form-control select" >
                                            <option value="" selected>Pilih Tahun Anggaran</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Program</label>
                                        <select id="program_id" name="program_id" class="form-control select" required
                                            style="width: 100%;">
                                            <option selected disabled value="">Pilih Program/Kegiatan/Sub Kegiatan</option>
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
                                    <input type="file" name="images[]" multiple class="form-control"
                                        accept="image/*">
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
                                <label for="">Koordinat</label>
                                <div id="map"></div>
                                <div style="display: none" id="mapid"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <button id="clickMe" class="btn btn-primary btn-toast" type="button">Dapatkan
                                Koordinat</button>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" id="lat" name="lat" class="form-control"
                                    placeholder="Latitude">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="long" name="long" class="form-control"
                                    placeholder="Longtitude">
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
                        <br>
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
    <!-- Plugins JS start-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js') }}/map.js"></script>
    <script id="menu" src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/isotope.pkgd.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
    <script src="{{asset('assets/js/masonry-gallery.js')}}"></script>
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

        document.querySelector(".btn-toast").addEventListener('click', function() {
            Swal.fire({
                toast: true,
                html: '<ul id="status" class="progressing">' +
                    '</ul>',
                icon: 'info',
                title: 'Mencari titik Koordinat... (Izinkan Akses Data Lokasi)',
                position: 'top-end',
                showConfirmButton: false,
                timer: 12000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery($('#tahun_anggaran, #program_id')).on('change', function() {
                var ta = jQuery('#tahun_anggaran').val();
                var kegID = jQuery('#program_id').val();
                if (kegID) {
                    jQuery.ajax({
                        url: '/pekerjaan/kegiatan/rincian/'+kegID+'/'+ta+'',
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
