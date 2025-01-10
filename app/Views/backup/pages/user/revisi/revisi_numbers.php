 <?= $this->extend('template/layout'); ?>

 <?= $this->section('content') ?>

 <div class="content-wrapper">
     <div class="container-full">
         <!-- Main content -->
         <section class="content">
             <div class="row">
                 <div class="col-12">
                     <div class="box bg-gradient-primary overflow-hidden pull-up">
                         <div class="box-body pe-0 ps-lg-50 ps-15 py-0">
                             <div class="row align-items-center">
                                 <div class="col-12 col-lg-8">
                                     <h1 class="fs-40 text-white">Number Drawing Pdf</h1>
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
                     <h3>List All Revisi Drawing</h3>
                 </div>
                 <div class="row">
                     <div class="col-12">
                         <div class="box">
                             <div class="box-body">
                                 <div class="table-responsive">
                                     <table id="example125" class="table table-bordered table-separated">
                                         <thead>
                                             <tr>
                                                 <th>No</th>
                                                 <th>Number Drawing</th>
                                                 <th>Nama Penulis</th>
                                                 <th>Nama Drawing</th>
                                                 <th>Tanggal Pengajuan</th>
                                                 <th>Revisi</th>
                                                 <th>Pdf Drawing</th>
                                                 <th>Status</th>
                                                 <th>Aksi</th>
                                                 <th>Update PDF</th>
                                             </tr>
                                         </thead>
                                         <tbody id="user2">
                                             <?php $i = 1; ?>
                                             <?php
                                                $hasMasspro = false; // Inisialisasi variabel pengecekan masspro
                                                foreach ($data as $user) {
                                                    if ($user['status'] == 'masspro') {
                                                        $hasMasspro = true;
                                                        break;
                                                    }
                                                }
                                                ?>
                                             <?php foreach ($data as $user) : ?>
                                                 <tr>
                                                     <td><?= $i++; ?></td>
                                                     <td><?= esc($user['number']); ?></td>
                                                     <td><?= esc($user['nama_penulis']); ?></td>
                                                     <td><?= esc($user['nama_file']); ?></td>
                                                     <td><?= esc($user['created_at']); ?></td>
                                                     <td><?= $user['revisi'] ?? '0'; ?></td>
                                                     <td>
                                                         <button type="button" class="btn btn-link btn-pdf-modal" data-pdf="<?= base_url('uploads/' . $user['pdf_path']); ?>">
                                                             <i class="fa fa-file-pdf-o"></i> Lihat PDF
                                                         </button>
                                                     </td>
                                                     <td>
                                                         <?php
                                                            $statusClass = '';
                                                            $statusLabel = '';
                                                            if ($user['status'] == 'masspro') {
                                                                $statusClass = 'bg-success';
                                                                $statusLabel = 'Masspro';
                                                            } elseif ($user['verifikasi_admin'] == 2) {
                                                                $statusClass = 'bg-danger';
                                                                $statusLabel = 'Rejected';
                                                            } else {
                                                                $statusClass = 'bg-warning';
                                                                $statusLabel = 'Trial';
                                                            }
                                                            ?>
                                                         <span class="badge <?= $statusClass; ?>"><?= $statusLabel; ?></span>
                                                     </td>
                                                     <td>
                                                         <?php
                                                            $buttonClass = '';
                                                            $buttonText = '';
                                                            $href = '';
                                                            if ($user['status'] != 'masspro' && $user['verifikasi_admin'] != 2) {
                                                                $buttonClass = 'btn-success';
                                                                $buttonText = 'Set Masspro';
                                                                $href = base_url('pdf/setStatusMasspro/' . $user['id']);
                                                            } elseif ($user['verifikasi_admin'] == 2 && $user['status'] != 'masspro') {
                                                                $buttonClass = 'btn-danger';
                                                                $buttonText = 'Set Masspro Again';
                                                                $href = base_url('pdf/setStatusMasspro/' . $user['id']);
                                                            } else {
                                                                $buttonClass = 'text-muted';
                                                                $buttonText = 'masspro';
                                                            }
                                                            ?>
                                                         <?php if ($buttonClass !== 'text-muted') : ?>
                                                             <a href="<?= $href; ?>" class="btn <?= $buttonClass; ?>" onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi masspro?')">
                                                                 <?= $buttonText; ?>
                                                             </a>
                                                         <?php else : ?>
                                                             <span class="<?= $buttonClass; ?>"><?= $buttonText; ?></span>
                                                         <?php endif; ?>
                                                     </td>
                                                     <td>
                                                         <?php if ($user['status'] == 'masspro') : ?>
                                                             <button type="button" class="btn btn-info btn-update-pdf" data-id="<?= $user['id']; ?>">
                                                                 Update PDF
                                                             </button>
                                                         <?php else : ?>
                                                             -
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



                 <div class="row">
                     <div class="col-lg-12 col-12" id="form1" style="width: 90%;padding-left: 7%;">
                         <!-- Basic Forms -->
                         <div class="box">
                             <div class="box-header with-border">
                                 <h4 class="box-title">Form Revisi</h4>
                             </div>

                             <form id="revisionForm" enctype="multipart/form-data">
                                 <input type="hidden" name="_method" value="POST" />
                                 <div class="form-group">
                                     <label class="form-label" for="proses_produksi">Proses Produksi:</label>
                                     <input class="form-control" type="text" id="proses_produksi" name="proses_produksi" value="<?= esc($data[0]['proses_produksi']) ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label class="form-label" for="nama_file">Nama File:</label>
                                     <input class="form-control" type="text" id="nama_file" name="nama_file" value="<?= esc($data[0]['nama_file']) ?>" required>
                                 </div>

                                 <div class="form-group">
                                     <label class="form-label" for="pdf_path">Unggah PDF:</label>
                                     <input class="form-control" type="file" id="pdf_path" name="pdf_path" required>
                                 </div>
                                 <div class="form-group">
                                     <label class="form-label" for="pdf_number_string">PDF Number String:</label>
                                     <input class="form-control" type="text" id="pdf_number_string" name="pdf_number_string" value="<?= esc($data[0]['pdf_number_string']) ?>" required>
                                 </div>
                                 <button type="button" class="btn btn-success" id="submitBtn">Simpan Revisi</button>
                             </form>
                         </div>
                     </div>
                 </div>


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

             <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="alertModalLabel">Notif</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body" id="modalMessage">
                             <!-- Message will be inserted here -->
                         </div>
                         <div class="modal-footer">
                             <button type="button" id="modalOk" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="modal modal-right fade" id="modal-right" tabindex="-1">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Upload Drawing</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form id="upload-form">
                                 <input type="hidden" id="id-pdf" name="id_pdf">
                                 <div class="form-group">
                                     <label class="form-label">Upload Drawing:</label>
                                     <input class="form-control" type="file" id="pdf_drawing" name="pdf_drawing" required>
                                 </div>

                             </form>
                         </div>
                         <div class="modal-footer modal-footer-uniform">
                             <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                             <button type="button" id="save-button" class="btn btn-primary float-end">Save changes</button>
                         </div>
                     </div>
                 </div>
             </div>



         </section>
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

         $('.btn-update-pdf').on('click', function() {
             var id = $(this).data('id');
             $('#id-pdf').val(id);
             $('#modal-right').modal('show');
         });

         $('#save-button').on('click', function() {
             $('#modal-right').modal('hide');
             updatePdf(baseUrl);
         });

         function updatePdf(baseUrl) {
             var formData = new FormData($('#upload-form')[0]);
             $.ajax({
                 url: baseUrl + 'pdf/update/' + $('#id-pdf').val(),
                 type: 'POST',
                 data: formData,
                 contentType: false,
                 processData: false,
                 dataType: 'json',
                 success: function(response) {
                     if (response.status === 'success') {
                         showModal(response.message, function() {
                             window.location.reload();
                         });
                     } else {
                         showModal(response.message);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Error:', error);
                 }
             });
         }
         $('#modalOk').click(function() {
             location.reload();
         });

         $('#submitBtn').on('click', function() {
             submitData(baseUrl);
         });

         $('#example125').DataTable({
             "paging": true,
             "lengthChange": true,
             "searching": true,
             "ordering": true,
             "info": true,
             "autoWidth": false
         });
     });

     function submitData(baseUrl) {
         var formData = new FormData($('#revisionForm')[0]);
         $.ajax({
             url: baseUrl + 'pdf/revise/<?= $data[0]['id'] ?>',
             type: 'POST',
             data: formData,
             contentType: false,
             processData: false,
             dataType: 'json',
             success: function(response) {
                 if (response.status === 'success') {
                     showModal(response.message, function() {
                         window.location.reload();
                     });
                 } else {
                     showModal(response.message);
                 }
             },
             error: function(xhr, status, error) {
                 console.error('Error:', error);
             }
         });
     }

     function showModal(message, callback) {
         $('#modalMessage').text(message);
         $('#alertModal').modal('show');

         if (callback) {
             $('#alertModal').on('hidden.bs.modal', function() {
                 callback();
                 $(this).off('hidden.bs.modal'); // Remove the callback to avoid multiple triggers
             });
         }
     }
 </script>

 <?= $this->endSection() ?>