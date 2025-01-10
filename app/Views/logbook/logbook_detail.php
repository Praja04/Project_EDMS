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
                                     <h1 class="fs-40 text-white">Halaman Detail Drawing</h1>
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
                     <h3>List All Logbook Drawing</h3>
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

                                             </tr>
                                         </thead>
                                         <tbody id="user2">
                                             <?php $i = 1; ?>

                                             <?php foreach ($data as $user) : ?>
                                                 <tr>
                                                     <td><?= $i++; ?></td>
                                                     <td><?= esc($user['nomor_dokumen']); ?></td>
                                                     <td><?= esc($user['nama_penulis']); ?></td>
                                                     <td><?= esc($user['nama_dokumen']); ?></td>
                                                     <td><?= esc($user['tanggal_revisi']); ?></td>
                                                     <td><?= $user['keterangan_revisi'] ?></td>
                                                     <td>
                                                         <button type="button" class="btn btn-link btn-pdf-modal" data-pdf="<?= base_url('uploads/revisi/' . $user['file_revisi']); ?>">
                                                             <i class="fa fa-file-pdf-o"></i> Lihat PDF
                                                         </button>
                                                     </td>
                                                     <td>
                                                         <?php if ($user['status_revisi'] == 'masspro') : ?>
                                                             <p class="btn btn-success">masspro</p>
                                                         <?php else : ?>
                                                             <p class="btn btn-warning">belum masspro</p>
                                                         <?php endif; ?>
                                                     </td>


                                                 </tr>
                                             <?php endforeach ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
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




         </section>
     </div>
 </div>
 <script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>
 <script>
     $(document).ready(function() {
         $('.btn-pdf-modal').on('click', function() {
             var pdfUrl = $(this).data('pdf');
             $('#pdfViewer').attr('src', pdfUrl);
             $('#pdfModal').modal('show');
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
 </script>
 <?= $this->endSection() ?>