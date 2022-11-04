

<?php $__env->startSection('title', 'Data Kontrak'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/sweetalert2.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <h5>Detail Kegiatan</h5>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Detail</li>
    <li class="breadcrumb-item active">Kegiatan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Rincian Kegiatan</h5>
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
                                    <?php
                                        $i = 1;
                                    ?>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($i++); ?></td>
                                            <td><a
                                                    href="/pekerjaan/<?php echo e($item->pekerjaan->id); ?>"><?php echo e($item->pekerjaan->nama_pekerjaan); ?></a>
                                                <label
                                                    class="badge badge-success"><?php echo e($item->aspirasi == 1 ? 'Aspirasi' : ''); ?></label>
                                            </td>
                                            <td><?php echo e($item->outcome); ?> Jiwa</td>
                                            <td>
                                                <?php if($item->output != null): ?>
                                                    <?php $__currentLoopData = $item->output; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <b><?php echo e($p['komponen']); ?></b>: <?php echo e($p['volume']); ?>

                                                        <?php echo e($p['satuan']); ?><br />
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <p>Belum Diinput</p>
                                                <?php endif; ?>
                                            </td>


                                            <td>
                                                <div class="card-body btn-showcase">
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modal-hapus<?php echo e($item->id); ?>"><i
                                                            class="fa fa-trash"></i></button>
                                                    <button class="btn btn-warning btn-edit" data-bs-toggle="modal"
                                                        data-bs-target="#modal-ubah" id="edit-item"
                                                        data-id="<?php echo e($item->id); ?>"><i class="fa fa-edit"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <h5 class="modal-title">Tambah Data Rincian Kegiatan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-tambah">
                    <form class="needs-validation" novalidate="" action="<?php echo e(route('rincian.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
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
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal modal-blur fade" id="modal-hapus<?php echo e($d->id); ?>" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <h3>Apakah anda yakin?</h3>
                        <div class="text-muted">Hapus Paket Pekerjaan <?php echo e($d->pekerjaan->nama_pekerjaan); ?></div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Batal
                                    </a></div>
                                <form action="<?php echo e(route('rincian.destroy', $d->id)); ?>" method="post">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bd-example-modal-lg" id="modal-ubah" role="dialog" tabindex="-1"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal-content-ubah">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kontrak</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-ubah">
                    <form class="needs-validation" novalidate="" action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Program</label>
                                <select id="program" name="program_id"
                                    class="form-control select2 select2-offscreen selek" required style="width: 100%;">
                                    <option selected disabled value="">Pilih Program/Kegiatan/Sub Kegiatan</option>
                                    <optgroup label="Pembangunan MCK">
                                        <option value="1">Pembangunan MCK Komunal</option>
                                        <option value="2">Pembangunan MCK Skala Individu</option>
                                    </optgroup>
                                    <optgroup label="SPALD-T">
                                        <option value="3">Pembangunan IPAL Skala Permukiman minimal 50 KK</option>
                                        <option value="4">Pembangunan IPAL Skala Permukiman kombinasi MCK minimal 50
                                            KK
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
                                <select id="kegiatan" value="" name="pekerjaan_id"
                                    class="form-control select2 select2-offscreen selek" style="width: 100%;" required>
                                    <option value="">Pilih Kegiatan</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label">Nama Pelaksana</label>
                                        <input id="pelaksana" name="nama_pelaksana" type="text" class="form-control"
                                            required="">
                                        <div class="invalid-feedback"><a class="text-danger">Nomor SPK Invalid!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <label class="form-label">Data Pelaksana</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <input id="alamat" name="alamat_pelaksana" type="text"
                                            class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">NPWP</label>
                                        <input id="npwp" name="npwp_pelaksana" type="text" class="form-control"
                                            required="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="media mb-2">
                                        <label class="col-form-label m-r-10">Aspirasi</label>
                                        <div class="media-body text-end icon-state switch-outline">
                                            <label class="switch">
                                                <input name="aspirasi" id="aspirasi" type="checkbox"
                                                    value="1"><span class="switch-state bg-primary"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tahap Pelaksanaan</label>
                                        <select class="form-controle" name="tahap" id="tahap_pelaksanaan">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3" tabindex="0" id="currency">
                                        <label class="form-label">Keterangan</label>
                                        <div class="input-group input-group-flat">
                                            <textarea id="keterangan" class="form-control" name="keterangan" id=""></textarea>
                                        </div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
    <script>
        <?php if($errors->any()): ?>
            Swal.fire({
                title: 'Error!',
                text: '<?php echo e(implode('', $errors->all(':message'))); ?>',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        <?php endif; ?>
    </script>
    <script>
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            console.log(id);

            $.ajax({
                type: "GET",
                url: "<?php echo e(url('edit/rincian')); ?>",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('form').attr('action', 'rincian/' + res.id);
                    $('#pelaksana').val(res.nama_pelaksana);
                    $('#npwp').val(res.npwp_pelaksana);
                    $('#alamat').val(res.alamat_pelaksana);
                    $('#aspirasi').prop('checked', res.aspirasi);
                    $('#tahap_pelaksanaan').val(res.tahap);
                    $('#keterangan').val(res.keterangan);
                    $("#program").val(res.pekerjaan.kegiatan.id);
                    var $newOption = $("<option selected='selected'></option>").val(res.pekerjaan.id)
                        .text(res.pekerjaan.nama_pekerjaan)
                    $("#kegiatan").append($newOption);
                }
            });
        })
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
            $('#example1_filter input').addClass('form-control form-control-sm'); // <-- add this line
            $('#example1_filter label').addClass('text-muted'); // <-- add this line
        });
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
    <script>
        $("#tambah-output").click(function() {
            var i = 0;
            ++i;
            var a = '<tr>' +
                ' <td><input type="text" name="output['+i+'][komponen]" class="form-control"' +
                'placeholder="Komponen"></td>' +
                '<td><input type="number" name="output['+i+'][volume]" class="form-control"' +
                'placeholder="Volume"></td>' +
                '<td><input type="text" name="output['+i+'][satuan]" class="form-control"' +
                'placeholder="Satuan"></td>' +
                '<td><button type="button" name="add"' +
                'class="btn btn-outline-danger remove-output-field">Hapus</button></td>' +
                '</tr>'
            $("#divOutput").append(a);
        });
        $(document).on('click', '.remove-output-field', function() {
            $(this).parents('tr').remove();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\repo\sandb\resources\views/pages/pekerjaan/paket.blade.php ENDPATH**/ ?>