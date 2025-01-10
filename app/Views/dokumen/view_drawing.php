<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box no-shadow mb-0 bg-transparent">
                        <div class="box-header no-border px-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="box bg-gradient-primary overflow-hidden pull-up">
                                        <div class="box-body pe-0 ps-lg-50 ps-15 py-0">
                                            <div class="row align-items-center">
                                                <div class="col-12 col-lg-8">
                                                    <h1 class="fs-40 text-white">Dokumen Drawing</h1>
                                                    <p class="text-white mb-0 fs-20">
                                                        PT.Century Batteries Indonesia
                                                    </p>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <img src="<?= base_url() ?>assets\images\custom-15.svg" alt="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3>List All Drawing</h3>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="box">
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Produksi</label>
                                                                <select class="form-select" id="filter-select" style="width: 100px; align-items:right">
                                                                    <option value="">Semua</option>
                                                                    <option value="Produksi 1">Produksi 1</option>
                                                                    <option value="Produksi 2">Produksi 2</option>
                                                                    <option value="Other">Other</option>
                                                                    <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Proses</label>
                                                                <select class="form-select" id="filter-select2" style="width: 100px; align-items:right">
                                                                    <option value="">Semua</option>
                                                                    <option value="Lead Part" data-type="Produksi 1" data-proses="Lead Part">Lead Part</option>
                                                                    <option value="Grid Casting" data-type="Produksi 1" data-proses="Grid Casting">Grid Casting</option>
                                                                    <option value="Lead Powder Pasting" data-type="Produksi 1" data-proses="Lead Powder Pasting">Lead Powder Pasting</option>
                                                                    <option value="Formation Drying Charging" data-type="Produksi 1" data-proses="Formation Drying Charging">Formation Drying Charging</option>
                                                                    <option value="Assembly" data-type="Produksi 2" data-proses="Assembly">Assembly</option>
                                                                    <option value="Wet" data-type="Produksi 2" data-proses="Wet">Wet</option>
                                                                    <option value="MCB" data-type="Produksi 2" data-proses="MCB">MCB</option>
                                                                    <option value="Telecom" data-type="Produksi 2" data-proses="Telecom">Telecom</option>
                                                                    <option value="Wide Strip & Punch Grid" data-type="Produksi 1" data-proses="Wide Strip & Punch Grid">Wide Strip & Punch Grid</option>
                                                                    <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Sub Proses</label>
                                                                <select class="form-select" id="filter-select3" style="width: 100px; align-items:right">
                                                                    <option value="">Semua</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Type Sub Proses</label>
                                                                <select class="form-select" id="filter-select4" style="width: 100px; align-items:right">
                                                                    <option value="">Semua</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button id="reset-button" class="btn btn-secondary mt-2">Reset Filter</button>
                                                        </div>
                                                    </div><br><br>
                                                    <table id="example122" class="table table-bordered table-separated">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Dokumen</th>
                                                                <th>Proses</th>
                                                                <th>Nomor Dokumen</th>
                                                                <th>Kategori</th>
                                                                <th>Status</th>
                                                                <th>File</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($dokumen as $index => $doc) : ?>
                                                                <tr>
                                                                    <td><?= $index + 1 ?></td>
                                                                    <td><?= $doc['nama_dokumen'] ?></td>
                                                                    <td><?php if ($doc['proses'] > 0 && $doc['proses'] < 5 || $doc['proses'] == 9) {
                                                                            echo "Produksi 1";
                                                                        } else if ($doc['proses'] > 4 && $doc['proses'] < 9) {
                                                                            echo "Produksi 2";
                                                                        } else {
                                                                            echo "Other";
                                                                        } ?></td>
                                                                    <td><?= $doc['nomor_dokumen'] ?></td>
                                                                    <td><?= $doc['keterangan_nomor_drawing'] ?></td>
                                                                    <td><?= $doc['status_verifikasi'] ?? $doc['status'] ?></td>
                                                                    <td>
                                                                        <?php if ($doc['file_path']) : ?>
                                                                            <button type="button" class="btn btn-link btn-pdf-modal" data-pdf="<?= base_url('uploads/revisi/' . $doc['file_revisi']); ?>">
                                                                                <i class="fa fa-file-pdf-o"></i> Lihat PDF
                                                                            </button>
                                                                        <?php else : ?>
                                                                            Belum tersedia
                                                                        <?php endif; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk menampilkan PDF -->
                <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <embed id="pdfViewer" src="" type="application/pdf" width="100%" height="600px">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>
</div>
<script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>
<script>
    const baseUrl = "<?= base_url() ?>";
    $(document).ready(function() {
        $('.btn-pdf-modal').on('click', function() {
            var pdfUrl = $(this).data('pdf');
            $('#pdfViewer').attr('src', pdfUrl);
            $('#pdfModal').modal('show');
        });


        handleProsesChange(baseUrl);
        handleItemChange(baseUrl);
        var table = $('#example122').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        // Handle filter changes
        $('#filter-select, #filter-select2, #filter-select3, #filter-select4').on('change', function() {
            filterTable();
        });

        $('#reset-button').on('click', function() {
            resetFilters();
        });

        function filterTable() {
            const produksi = $('#filter-select').val();
            const proses = $('#filter-select2').val();
            const subProses = $('#filter-select3').val();
            const typeSubProses = $('#filter-select4').val();

            // Filter by Produksi
            table.column(2).search(produksi ? '^' + produksi + '$' : '', true, false);

            // Filter by Proses, Sub Proses, and Type Sub Proses in Column 4
            let searchValue = '';
            if (proses) {
                searchValue += `(?=.*${proses})`; // Ensure 'proses' is in the text
            }
            if (subProses) {
                searchValue += `(?=.*${subProses})`; // Ensure 'subProses' is in the text
            }
            if (typeSubProses) {
                searchValue += `(?=.*${typeSubProses})`; // Ensure 'typeSubProses' is in the text
            }

            table.column(4).search(searchValue ? searchValue : '', true, false);

            table.draw();
        }




        function resetFilters() {
            $('#filter-select').val('');
            $('#filter-select2').val('');
            $('#filter-select3').val('');
            $('#filter-select4').val('');
            filterTable();
        }
    })


    function handleProsesChange(baseUrl) {
        $('#filter-select2').on('change', function() {
            const proses = $(this).find('option:selected');
            var selected_sub = proses.data('proses');
            updateSubProses(baseUrl, selected_sub);
            console.log($('#nama_file').val());
        });
    }

    function updateSubProses(baseUrl, selected_sub) {
        if (!selected_sub) return;

        $.ajax({
            url: baseUrl + 'dokumen/sub/proses',
            type: 'GET',
            data: {
                proses: selected_sub
            },
            success: function(response) {
                console.log(response);
                const sub_proses = $('#filter-select3');
                sub_proses.empty();
                sub_proses.append('<option value="">Semua</option>');
                if (response.error) {
                    console.error(response.error);
                    return;
                }

                response.forEach(function(item) {
                    const option = $('<option></option>')
                        .val(item.nama_sub_proses)
                        .text(item.nama_sub_proses)
                        .data('no_subProses', item.no_sub_proses);
                    sub_proses.append(option);
                });

                // Tambahkan opsi 'Other'
                const otherOption = $('<option></option>')
                    .val('Other')
                    .text('Other')
                    .data('no_subProses', '00');
                sub_proses.append(otherOption);
            },
            error: function(xhr, status, error) {
                console.error('Error in AJAX request:', status, error);
            }
        });
    }

    function handleItemChange(baseUrl) {
        $('#filter-select3').on('change', function() {
            var selectedOption2 = $(this).find('option:selected');
            var selectedOption = $('#filter-select2').find('option:selected');
            var data = selectedOption.data('proses');
            var selected_type = selectedOption2.val();
            if (selected_type == 'Connector' || selected_type == 'Pole' || selected_type == 'Bushing') {
                updateTypeProses2(baseUrl, selected_type);
            } else {
                updateTypeProses(baseUrl, data);
            }
        });
    }

    function updateTypeProses(baseUrl, selected_type) {
        if (!selected_type) return;

        $.ajax({
            url: baseUrl + 'dokumen/type/sub',
            type: 'GET',
            data: {
                typesub: selected_type
            },
            success: function(response) {
                console.log(response);
                const type_sub = $('#filter-select4');
                type_sub.empty();
                type_sub.append('<option value="">Semua</option>');
                if (response.error) {
                    console.error(response.error);
                    return;
                }

                const otherOption = $('<option></option>')
                    .val('Other')
                    .text('Other')
                    .data('no_type', '00');
                type_sub.append(otherOption);
                response.forEach(function(item) {
                    const option = $('<option></option>')
                        .val(item.nama_type_sub_proses)
                        .text(item.nama_type_sub_proses)
                        .data('no_type', item.no_type);
                    type_sub.append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error in AJAX request:', status, error);
            }
        });
    }

    function updateTypeProses2(baseUrl, selected_type) {
        if (!selected_type) return;

        $.ajax({
            url: baseUrl + 'dokumen/type/sub2',
            type: 'GET',
            data: {
                subProses: selected_type
            },
            success: function(response) {
                console.log(response);
                const type_sub = $('#filter-select4');
                type_sub.empty();
                type_sub.append('<option value="">Semua</option>');
                if (response.error) {
                    console.error(response.error);
                    return;
                }

                // Tambahkan opsi 'Other'
                const otherOption = $('<option></option>')
                    .val('Other')
                    .text('Other')
                    .data('no_type', '00');
                type_sub.append(otherOption);

                response.forEach(function(item) {
                    const option = $('<option></option>')
                        .val(item.nama_type_sub_proses)
                        .text(item.nama_type_sub_proses)
                        .data('no_type', item.no_type);
                    type_sub.append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error in AJAX request:', status, error);
            }
        });
    }
</script>

<?= $this->endSection() ?>