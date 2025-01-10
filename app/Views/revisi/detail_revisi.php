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
                                     <h1 class="fs-40 text-white">Detail Revisi Drawing</h1>
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
                                                 <th>Kategori Drawing</th>
                                                 <th>Dokumen</th>
                                                 <th>aksi</th>
                                                 <!-- <th>Pdf Drawing</th>
                                                 <th>Status</th>
                                                 <th>Aksi</th>
                                                 <th>Update PDF</th> -->
                                             </tr>
                                         </thead>
                                         <tbody id="user2">
                                             <?php $i = 1; ?>

                                             <?php foreach ($data as $user) : ?>
                                                 <tr>
                                                     <td><?= $i++; ?></td>
                                                     <td><?= esc($dokumen[0]['nomor_dokumen']); ?></td>
                                                     <td><?= esc($dokumen[0]['nama_penulis']); ?></td>
                                                     <td><?= esc($dokumen[0]['nama_dokumen']); ?></td>
                                                     <td><?= esc($user['tanggal_revisi']); ?></td>
                                                     <td><?= $user['keterangan_revisi']; ?></td>
                                                     <td><?= esc($dokumen[0]['keterangan_nomor_drawing']); ?></td>
                                                     <td>
                                                         <button type="button" class="btn btn-link btn-pdf-modal" data-pdf="<?= base_url('uploads/revisi/' . $user['file_revisi']); ?>">
                                                             <i class="fa fa-file-pdf-o"></i> Lihat PDF
                                                         </button>
                                                     </td>
                                                     <td>
                                                         <?php if ($user['status_revisi'] == 'masspro' && $user['status_verifikasi_revisi'] == null) : ?>
                                                             sedang di review
                                                         <?php elseif ($user['status_revisi'] == 'masspro' && $user['status_verifikasi_revisi'] != null) : ?>

                                                             Terverifikasi
                                                         <?php elseif ($user['status_revisi'] == '-' && $user['status_verifikasi_revisi'] == 'ditolak') : ?>
                                                             <button type="button" class="btn btn-info btn-update-pdf" data-bs-toggle="modal" data-bs-target="#modal-left" data-id-pdf="<?= $user['revisi_id'] ?>">
                                                                 Update PDF
                                                             </button>


                                                             <a href="#" class="btn btn-danger" data-revisi-id="<?= $user['revisi_id'] ?>" data-bs-toggle="modal" data-bs-target="#setmassproAgainModal">Set Masppro Again</a>

                                                         <?php elseif ($user['status_revisi'] == '-' || $user['status_revisi'] == null) : ?>
                                                             <button type="button" class="btn btn-info btn-update-pdf" data-bs-toggle="modal" data-bs-target="#modal-left" data-id-pdf="<?= $user['revisi_id'] ?>">
                                                                 Update PDF
                                                             </button>


                                                             <a href="#" class="btn btn-warning" data-revisi-id="<?= $user['revisi_id'] ?>" data-bs-toggle="modal" data-bs-target="#setmassproAgainModal">Set Masppro</a>

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
                                 <!-- <input type="hidden" name="_method" value="POST" /> -->
                                 <input type="hidden" name="dokumen_id" id="dokumen_id" value="<?= esc($dokumen[0]['dokumen_id']) ?>">
                                 <div class="form-group">
                                     <label class="form-label" for="nama_file">Nama File:</label>
                                     <input class="form-control" type="text" id="nama_file" name="nama_file" value="<?= esc($dokumen[0]['nama_dokumen']) ?>" required>
                                 </div>

                                 <div class="form-group">
                                     <label class="form-label" for="pdf_path">Unggah PDF:</label>
                                     <input class="form-control" type="file" id="file_revisi" name="file_revisi" required>
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





         </section>
     </div>
 </div>

 <div class="modal fade" id="setmassproAgainModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalLabel">Set masspro again</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form id="form-project">
                     <input type="hidden" id="id_revisi">
                 </form>
                 <label for="delete">Apakah kamu yakin set masspro dokumen ini?</label>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="submit" id="setmassproAgain" class="btn btn-primary">Yes</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal modal-left fade" id="modal-left" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Upload Ulang Drawing</h5>
             </div>
             <div class="modal-body">
                 <form id="upload-ulang-form">
                     <input type="hidden" id="id-pdf" name="id_pdf">
                     <div class="form-group">
                         <label class="form-label">Upload Drawing:</label>
                         <input class="form-control" type="file" id="pdf_drawing" name="pdf_drawing" required>
                     </div>

                 </form>
             </div>
             <div class="modal-footer modal-footer-uniform">
                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                 <button type="button" id="save-ulang-button" class="btn btn-primary float-end">Save changes</button>
             </div>
         </div>
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

         $('#setmassproAgainModal').on('show.bs.modal', function(event) {
             var button = $(event.relatedTarget);

             var id = button.data('revisi-id');
             var modal = $(this);
             modal.find('#id_revisi').val(id);
         });


         $('#setmassproAgain').on('click', function() {

             id_revisi = $('#id_revisi').val();

             $.ajax({
                 url: baseUrl + 'uploader/set/dokumen/masspro/' + id_revisi,
                 type: 'GET',
                 //  data: formData,
                 //  processData: false,
                 //  contentType: false,
                 success: function(response) {
                     $('#setmassproAgainModal').modal('hide');
                     $('#modalok').on('click', function() {
                         location.reload();
                     });
                     showModal(response.message, function() {});
                 },
                 error: function(xhr, status, error) {
                     console.error('Error:', error);
                     showModal('Terjadi kesalahan saat mengirim data.');
                 }
             });
         });


         $('#modal-left').on('show.bs.modal', function(event) {
             var button = $(event.relatedTarget); // Tombol yang memicu modal
             var idpdf = button.data('id-pdf'); // Ekstrak informasi dari atribut data-*
             var modal = $(this);
             modal.find('#id-pdf').val(idpdf); // Set nilai id_perbaikan di dalam form
         });


         $('#save-ulang-button').on('click', function() {
             var formData = new FormData($('#upload-ulang-form')[0]);
             $.ajax({
                 url: baseUrl + 'uploader/pdf/update/revisi/' + $('#id-pdf').val(),
                 type: 'POST',
                 data: formData,
                 contentType: false,
                 processData: false,
                 dataType: 'json',
                 success: function(response) {
                     if (response.status === 'success') {
                         showModal('Data berhasil diperbarui!');
                         $('#modal-left').modal('hide');
                         setTimeout(function() {
                             location.reload();
                         }, 4000);
                     } else {
                         showModal(response.message);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Error:', error);
                 }
             });
         });


     });

     function submitData(baseUrl) {
         var formData = new FormData($('#revisionForm')[0]);
         $.ajax({
             url: baseUrl + 'uploader/input/revisi',
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