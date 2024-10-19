<div class="side-content-wrap">
  	<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
  		<ul class="navigation-left">
  			<li class="nav-item" data-item="entryspk">
  				<a class="nav-item-hold" href="#">
  					<i class="fas fa-book fa-lg"></i>
  					<span class="nav-text">Entry WO</span>
  				</a>
  				<div class="triangle"></div>
  			</li>
  			<li class="nav-item" data-item="sparepart">
  				<a class="nav-item-hold" href="#">
  					<i class="fas fa-tools fa-lg"></i>
  					<span class="nav-text">Sparepart</span>
  				</a>
  				<div class="triangle"></div>
  			</li>
  			<li class="nav-item" data-item="invoice">
  				<a class="nav-item-hold" href="#">
  					<i class="fas fa-receipt fa-lg"></i>
  					<span class="nav-text">Invoice & Faktur Pajak</span>
  				</a>
  				<div class="triangle"></div>
  			</li>
  			<li class="nav-item" data-item="finance">
  				<a class="nav-item-hold" href="#">
  					<i class="fas fa-dollar fa-lg"></i>
  					<span class="nav-text">Finance</span>
  				</a>
  				<div class="triangle"></div>
  			</li>

  			<li class="nav-item" data-item="report&konfigurasi">
  				<a class="nav-item-hold" href="#">
  					<i class="fas fa-clipboard fa-lg"></i>
  					<span class="nav-text">Report</span>
  				</a>
  				<div class="triangle"></div>
  			</li>
  			<li class="nav-item" data-item="masterdata">
  				<a class="nav-item-hold" href="#">
  					<i class="fas fa-edit fa-lg"></i>
  					<span class="nav-text">Master Data</span>
  				</a>
  				<div class="triangle"></div>
  			</li>
  		</ul>
  	</div>

<!-- Submenu Dashboards-->
  	<div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
		
		<?php $grup = $this->session->userdata('mygrup');
		
		$headspk = 'Entry_SPK';

		$headpart = 'Sparepart';

		$headpartbeli = 'PembelianPart';

		$headpartcounter = 'PartCounter';

		$headtransfer = 'TransferPart';

		$headfaktur = 'Faktur';

		$headFp = 'FakturPajak';

		$headfinance = 'Finance';

		$headkonfig = 'Master_Konfigurasi';

		$headmaintenance = 'Master_Maintenance';

		$headsetup = 'Master_Setup';

		$headreport = 'Report';

		$dataspk = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headspk."' AND grup = '".$grup."' order by pos")->result();

		$datapart = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headpart."' AND grup = '".$grup."' order by pos")->result();

		$headpartbeli = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headpartbeli."' AND grup = '".$grup."' order by pos")->result();

		$headpartcounter = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headpartcounter."' AND grup = '".$grup."' order by pos")->result();

		$headtransfer = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headtransfer."' AND grup = '".$grup."' order by pos")->result();

		$datafaktur = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headfaktur."' AND grup = '".$grup."' order by pos")->result();

		$datafinance = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headfinance."' AND grup = '".$grup."' order by pos")->result();

		$datakonfig = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headkonfig."' AND grup = '".$grup."' order by pos")->result();

		$datamaintenance = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headmaintenance."' AND grup = '".$grup."' order by pos")->result();

		$datasetup = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headsetup."' AND grup = '".$grup."' order by pos")->result();

		$datareport = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headreport."' AND grup = '".$grup."' order by pos")->result();

		$datafp = $this->db->query("SELECT * FROM Stpm_menu WHERE head = '".$headFp."' AND grup = '".$grup."' order by pos")->result();

		?>
<!-- Entry SPK -->
  		<ul class="childNav" data-parent="entryspk">

			<?php foreach ($dataspk as $value): ?>

				<li class="nav-item">

					<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
						<i class="nav-icon i-Clock-3"></i>
						<span class="item-name"><?php echo $value->menu ?></span>
					</a>
				</li>
				
			<?php endforeach ?>
		</ul>

<!-- Sparepart -->
  		<!-- <ul class="childNav" data-parent="sparepart">

			<?php foreach ($datapart as $value): ?>

				<li class="nav-item">
					<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
						<i class="nav-icon i-Clock-3"></i>
						<span class="item-name"><?php echo $value->menu ?></span>
					</a>
				</li>
			<?php endforeach ?>
            
  		</ul> -->

		<ul class="childNav" data-parent="sparepart">
			<li class="nav-item" data-toggle="collapse" data-target="#sparepart">
				<a href="#">
  					<i class="nav-icon fa fa-cog"></i>
  					<span class="item-name">Spareparts</span>
  				</a>

				<div id="sparepart" class="collapse">
					<ul>
						<?php foreach ($datapart as $value): ?>
							<li class="nav-item">
								<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
									<i class="nav-icon i-Clock-3"></i>
									<span class="item-name"><?php echo $value->menu ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				
				</div>

			</li>

			<li class="nav-item" data-toggle="collapse" data-target="#pembelian">
				<a href="#">
  					<i class="nav-icon fa fa-cogs"></i>
  					<span class="item-name">Pembelian Parts</span>
  				</a>

				<div id="pembelian" class="collapse">
					<ul>
						<?php foreach ($headpartbeli as $value): ?>
							<li class="nav-item">
								<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
									<i class="nav-icon i-Clock-3"></i>
									<span class="item-name"><?php echo $value->menu ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				
				</div>

			</li>

			<li class="nav-item" data-toggle="collapse" data-target="#partcounter">
				<a href="#">
  					<i class="nav-icon fa fa-wrench"></i>
  					<span class="item-name">Part Counter</span>
  				</a>

				<div id="partcounter" class="collapse">
					<ul>
						<?php foreach ($headpartcounter as $value): ?>
							<li class="nav-item">
								<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
									<i class="nav-icon i-Clock-3"></i>
									<span class="item-name"><?php echo $value->menu ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				
				</div>

			</li>


			<li class="nav-item" data-toggle="collapse" data-target="#transfer">
				<a href="#">
  					<i class="nav-icon fa fa-address-card"></i>
  					<span class="item-name">Transfer Part</span>
  				</a>

				<div id="transfer" class="collapse">
					<ul>
						<?php foreach ($headtransfer as $value): ?>
							<li class="nav-item">
								<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
									<i class="nav-icon i-Clock-3"></i>
									<span class="item-name"><?php echo $value->menu ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				
				</div>

			</li>
		</ul>

<!-- Faktur -->
  		<ul class="childNav" data-parent="invoice">

			<?php foreach ($datafaktur as $value): ?>

				<li class="nav-item">

					<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
						<i class="nav-icon i-Clock-3"></i>
						<span class="item-name"><?php echo $value->menu ?></span>
					</a>
				</li>

			<?php endforeach ?>

			<li class="nav-item" data-toggle="collapse" data-target="#fakturpajak">
				<a href="#">
					<i class="nav-icon fa fa-cogs"></i>
					<span class="item-name">Faktur Pajak</span>
				</a>

				<div id="fakturpajak" class="collapse">
					<ul>
						<?php foreach ($datafp as $value) : ?>
							<li class="nav-item">
								<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
									<i class="nav-icon i-Clock-3"></i>
									<span class="item-name"><?php echo $value->menu ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</li>
  			
  		</ul>


<!-- Finance -->

  		<ul class="childNav" data-parent="finance">

		  	<?php foreach ($datafinance as $value): ?>

				<li class="nav-item">

					<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
						<i class="nav-icon i-Clock-3"></i>
						<span class="item-name"><?php echo $value->menu ?></span>
					</a>
				</li>

			<?php endforeach ?>

  		</ul>

<!-- Konfigurasi & Report -->
		  <ul class="childNav" data-parent="report&konfigurasi">

		  	<?php foreach ($datareport as $value): ?>

				<li class="nav-item">

					<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
						<i class="nav-icon i-Clock-3"></i>
						<span class="item-name"><?php echo $value->menu ?></span>
					</a>
				</li>

			<?php endforeach ?>

  		</ul>

<!-- Master Data -->

		<ul class="childNav" data-parent="masterdata">
			<li class="nav-item" data-toggle="collapse" data-target="#konfigurasi">
				<a href="#">
  					<i class="nav-icon fa fa-cog"></i>
  					<span class="item-name">Konfigurasi</span>
  				</a>

				<div id="konfigurasi" class="collapse">
					<ul>
						<?php foreach ($datakonfig as $value): ?>
							<li class="nav-item">
								<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
									<i class="nav-icon i-Clock-3"></i>
									<span class="item-name"><?php echo $value->menu ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				
				</div>

			</li>

			<li class="nav-item" data-toggle="collapse" data-target="#maintenance">
				<a href="#">
  					<i class="nav-icon fa fa-wrench"></i>
  					<span class="item-name">Maintenance</span>
  				</a>

				<div id="maintenance" class="collapse">
					<ul>
						<?php foreach ($datamaintenance as $value): ?>
							<li class="nav-item">
								<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
									<i class="nav-icon i-Clock-3"></i>
									<span class="item-name"><?php echo $value->menu ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				
				</div>

			</li>

			<li class="nav-item" data-toggle="collapse" data-target="#setup">
				<a href="#">
  					<i class="nav-icon fa fa-address-card"></i>
  					<span class="item-name">Setup User</span>
  				</a>

				<div id="setup" class="collapse">
					<ul>
						<?php foreach ($datasetup as $value): ?>
							<li class="nav-item">
								<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
									<i class="nav-icon i-Clock-3"></i>
									<span class="item-name"><?php echo $value->menu ?></span>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				
				</div>

			</li>
		</ul>

  		<!-- <ul class="childNav" data-parent="masterdata">
			
		  	<?php foreach ($datamaster as $value): ?>

				<li class="nav-item">

					<a href="<?php echo base_url(); ?><?php echo $value->menu_url ?>">
						<i class="nav-icon i-Clock-3"></i>
						<span class="item-name"><?php echo $value->menu ?></span>
					</a>
				</li>

			<?php endforeach ?>
			
  			
		</ul> -->
		  
<!-- END Master Data -->
  	</div>
  	<div class="sidebar-overlay"></div>
  </div>
