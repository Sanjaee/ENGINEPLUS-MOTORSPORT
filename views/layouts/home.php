<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("layouts/head.php") ?>
</head>

<body class="text-left">
	<div class="app-admin-wrap layout-sidebar-large">

		<!-- NAV BAR  -->
		<?php $this->load->view("layouts/navbar.php") ?>

		<?php $this->load->view("layouts/sidebar.php") ?>

		<!-- LEFT SIDE END -->

		<div class="main-content-wrap sidenav-open d-flex flex-column">

			<div class="main-content">
				


				<?php $this->load->view($content); ?>


			</div>
			<div class="flex-grow-1"></div>
			<div class="app-footer">

				<!-- FOOTER  -->
				<?php $this->load->view("layouts/footer.php") ?>

			</div>

		</div>


	</div>


	<!-- Wrapper -->

	<!-- Logout Modal-->
	<?php $this->load->view('layouts/modal'); ?>


</body>

</html>
