@extends('layouts.simple.master')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
        integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <style>
        #mapid {
            height: 100%;
			z-index: 0;
        }
    </style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Default</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-xl-3 col-lg-6">
           <div class="card o-hidden">
              <div class="bg-primary b-r-4 card-body">
                 <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="database"></i></div>
                    <div class="media-body">
                       <span class="m-0">Paket Pekerjaan</span>
                       <h4 class="mb-0 counter">{{$total_pekerjaan}}</h4>
                       <i class="icon-bg" data-feather="database"></i>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
           <div class="card o-hidden">
              <div class="bg-secondary b-r-4 card-body">
                 <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                    <div class="media-body">
                       <span class="m-0">Total Pagu (Miliar)</span>
                       <h4 class="mb-0 counter">{{number_format($total_pagu / 1000000000,2)}}</h4>
                       <i class="icon-bg" data-feather="shopping-bag"></i>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
           <div class="card o-hidden">
              <div class="bg-primary b-r-4 card-body">
                 <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                    <div class="media-body">
                       <span class="m-0">Rumah</span>
                       <h4 class="mb-0 counter">{{$penerima_manfaat/5}}</h4>
                       <i class="icon-bg" data-feather="message-circle"></i>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
           <div class="card o-hidden">
              <div class="bg-primary b-r-4 card-body">
                 <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                    <div class="media-body">
                       <span class="m-0">Jiwa</span>
                       <h4 class="mb-0 counter">{{$penerima_manfaat}}</h4>
                       <i class="icon-bg" data-feather="user-plus"></i>
                    </div>
                 </div>
              </div>
           </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="container-fluid">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card earning-card">
                <div class="card-body p-0">
                    <div class="row m-0">
                        <div class="col-xl-3 earning-content p-0">
                            <div class="row m-0 chart-left">
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5></h5>
                                </div>
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5>{{ $ipal }}</h5>
                                    <p class="font-roboto">IPAL</p>
                                </div>
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5>{{ $sr }}</h5>
                                    <p class="font-roboto">Sambungan Rumah</p>
                                </div>
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5>{{ $mck }}</h5>
                                    <p class="font-roboto">MCK</p>
                                </div>
                                <div class="col-xl-12 p-0 left-btn"><a class="btn btn-gradient">Ringkasan</a></div>
                            </div>
                        </div>
                        <div class="col-xl-9 p-0">
                            <div class="map-js-height" id="mapid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js')}}"></script>
    <script>
        var map = L.map('mapid').setView([-6.822791260399927, 107.13596866437477], 12);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        @foreach ($foto as $data)
            var informasi = `
        
        @foreach ($data->pekerjaan as $item)
        <div class="row">
            <div class="col-lg-12">
                <a href="/pekerjaan/{{$item->id}}">{{$item->nama_pekerjaan}}</a>
            </div>
        </div>
        @endforeach
    `
            L.marker([{{ $data->lat }}, {{ $data->long }}])
                .addTo(map)
                .bindPopup(informasi);
        @endforeach
    </script>
@endsection
