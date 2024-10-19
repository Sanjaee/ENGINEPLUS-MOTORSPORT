<div class="main-header" style="background-color: #003473;">
&emsp;&nbsp;
	<div class="menu-toggle">
		<div style="background-color: #fff;"></div>
		<div style="background-color: #fff;"></div>
		<div style="background-color: #fff;"></div>
	</div>

	<a class="navbar-brand" href="<?php echo base_url(); ?>">
    <img src="<?php echo base_url(); ?>assets/img/logocloudx.png" width="180" height="50"/>
    <!-- <i style="color:#fff;">City Trans Utama</i> -->
    </a>

	<div class="d-flex align-items-center"></div>
	<div style="margin: auto"></div>

	<div class="header-part-right">
		<div class="dropdown">
			<div class="user col align-self-end ">
				<i class="fas fa-user-circle text-white header-icon" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
				<span style="color: white;">Hallo, <?php echo $this->session->userdata('myusername'); ?></span>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="#logoutModal" data-toggle="modal">Log Out</a>
				</div>
			</div>
		</div>
	</div>
</div>