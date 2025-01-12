<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar position-relative">
		<div class="multinav">
			<div class="multinav-scroll" style="height: 100%;">
				<!-- sidebar menu-->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">Menu</li>
					<?php if (session()->get('role') == 'uploader') : ?>
						<li>
							<a href="<?= base_url('dokumen/drawing') ?>">
								<i class="mdi mdi-publish"><span class="path1"></span><span class="path2"></span></i>
								<span>View Drawing</span>
								<span class="pull-right-container">
							</a>

						</li>
						<li class="treeview">
							<a href="#">
								<i class="mdi mdi-file-multiple"><span class="path1"></span><span class="path2"></span></i>
								<span>Generate & Upload</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('uploader/penomoran') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Penomoran Drawing</a></li>
								<li><a href="<?= base_url('uploader/upload') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Upload PDF</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="mdi mdi-book-multiple"><span class="path1"></span><span class="path2"></span></i>
								<span>Revisi</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('uploader/revisi') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Revisi Drawing</a></li>

							</ul>
						</li>


					<?php elseif (session()->get('role') == 'admin') : ?>
						<li>
							<a href="<?= base_url('dokumen/drawing') ?>">
								<i class="mdi mdi-publish"><span class="path1"></span><span class="path2"></span></i>
								<span>View Drawing</span>
								<span class="pull-right-container">
							</a>

						</li>
						<li>
							<a href="<?= base_url('admin/dokumen/unverified') ?>"><i class="mdi mdi-verified"><span class="path1"></span><span class="path2"></span></i>Verifikasi <span id="notif_verifikasi"></a>

						</li>

						<!-- <li class="treeview">
							<a href="#">
								<i class="mdi mdi-publish"><span class="path1"></span><span class="path2"></span></i>
								<span>Publish & Trial</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('publish') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Drawing Published</a></li>
								<li><a href="<?= base_url('trial/drawing') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Drawing Trial</a></li>
							</ul>
						</li> -->
						<li class="treeview">
							<a href="#">
								<i class="mdi mdi-book-multiple"><span class="path1"></span><span class="path2"></span></i>
								<span>Log Book</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('admin/logbook') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Log Book Drawing</a></li>
							</ul>
						</li>


					<?php elseif (session()->get('role') == 'kasi') : ?>

						<li>
							<a href="<?= base_url('dokumen/drawing') ?>">
								<i class="mdi mdi-publish"><span class="path1"></span><span class="path2"></span></i>
								<span>View Drawing</span>
								<span class="pull-right-container">
							</a>

						</li>
						<li>
							<a href="<?= base_url('admin/dokumen/unverified') ?>"><i class="mdi mdi-verified"><span class="path1"></span><span class="path2"></span></i>Verifikasi <span id="notif_verifikasi"></a>

						</li>

						<!-- <li class="treeview">
							<a href="#">
								<i class="mdi mdi-publish"><span class="path1"></span><span class="path2"></span></i>
								<span>Publish & Trial</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('publish') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Drawing Published</a></li>
								<li><a href="<?= base_url('trial/drawing') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Drawing Trial</a></li>
							</ul>
						</li> -->
						<li class="treeview">
							<a href="#">
								<i class="mdi mdi-book-multiple"><span class="path1"></span><span class="path2"></span></i>
								<span>Log Book</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('admin/logbook') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Log Book Drawing</a></li>
							</ul>
						</li>

					<?php elseif (session()->get('role') == 'reader_pce') : ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>View Drawing</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('listpdf') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Drawing Publish</a></li>
								<li><a href="<?= base_url('trial/drawing') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Drawing Trial</a></li>
							</ul>
						</li>

					<?php else : ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>View Drawing</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('listpdf') ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Drawing</a></li>
							</ul>
						</li>
					<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</section>

</aside>

<script src="<?= base_url() ?>/assets/js/jquery-3.7.1.min.js" type="text/javascript"></script>
<?php if (session()->get('role') == 'admin') : ?>
	<!-- <script>
		$(document).ready(function() {

			$.ajax({
				url: '<?= base_url() ?>total/masspro',
				type: 'GET',
				success: function(response) {
					const data = response.massproCount;

					if (data != 0) {
						$('#verifikasi').html('<i class="si-info si"></i>').css('color', 'red');
						$('#notif_verifikasi').text(data).css('color', 'red');

					} else {
						$('#verifikasi').removeAttr('id');
						$('#notif_verifikasi').removeAttr('id');

					}

				},
				error: function(error) {
					console.log('Error fetching data:', error);
				}
			});
			

		}); -->
	</script>
<?php else : ?>
	<script>

	</script>
<?php endif; ?>