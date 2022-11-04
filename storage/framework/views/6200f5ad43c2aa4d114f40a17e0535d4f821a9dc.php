

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/animate.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/chartist.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/date-picker.css')); ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
        integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <style>
        #mapid {
            height: 300px;
			z-index: 0;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h3>Dashboard</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Default</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                                    <h5><?php echo e($pagu); ?></h5>
                                    <p class="font-roboto">Jumlah Alokasi Pagu</p>
                                    <?php echo e(Cookie::get('body')); ?>

                                </div>
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5><?php echo e($total_pekerjaan); ?> Paket Pekerjaan</h5>
                                    <p class="font-roboto">Jumlah Kegiatan</p>
                                </div>
                                <div class="col-xl-12 p-0 left_side_earning">
                                    <h5><?php echo e($penerima_manfaat); ?> Jiwa</h5>
                                    <p class="font-roboto">Jumlah Penerima Manfaat</p>
                                </div>
                                <div class="col-xl-12 p-0 left-btn"><a class="btn btn-gradient">Ringkasan</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="map-js-height" id="mapid"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/chart/chartist/chartist.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/knob/knob.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/knob/knob-chart.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/apex-chart/apex-chart.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/apex-chart/stock-prices.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/notify/index.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead/handlebars.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead/typeahead.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead/typeahead.custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead-search/handlebars.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/typeahead-search/typeahead-custom.js')); ?>"></script>

    <script>
        var map = L.map('mapid').setView([-6.822791260399927, 107.13596866437477], 12);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        <?php $__currentLoopData = $foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            var informasi = `
        
        <?php $__currentLoopData = $data->pekerjaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-lg-12">
                <?php echo e($item->nama_pekerjaan); ?>

            </div>
            <div class="col-lg-12">
                <img src="<?php echo e($data->path); ?>" style="height:50px; width="50px;">    
            </div>
            <div class="col-lg-4">
            <a href="/pekerjaan/<?php echo e($item->id); ?>">Detail</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    `
            L.marker([<?php echo e($data->lat); ?>, <?php echo e($data->long); ?>])
                .addTo(map)
                .bindPopup(informasi);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\repo\sandb\resources\views/pages/dashboard.blade.php ENDPATH**/ ?>