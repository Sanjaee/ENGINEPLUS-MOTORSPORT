<div class="breadcrumb mt-5">
	<h1>PRINT REPORT</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<?php

$aktif = 'TRUE';
$menu = 'report';
$grup = $this->session->userdata('mygrup');

$paramcombobox = $this->db->query("SELECT * FROM Stpm_report WHERE menu = '" . $menu . "' AND aktif = '" . $aktif . "' AND grup = '" . $grup . "' order by index asc ")->result();
$jenisservice = $this->db->query('SELECT * FROM glbm_jenisreport')->result();

?>

<div class="row">
	<div class="col-md-12">
		<div class="card mb-4">
			<div class="card-body">
				<div class="card-title mb-3"></div>
				<div>
					<input class="form-control" type="hidden" name="grup" id="grup" value="<?php echo $this->session->userdata('mygrup') ?>" readonly required />
					<input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
					<input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
					<input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
					<input class="form-control" type="hidden" name="kodegrupcabang" id="kodegrupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />

					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<input type="hidden" class="form-control" id="gruplogin" value="<?php echo $this->session->userdata('mygrup') ?>" width="200">
								<label class="col-sm-3 col-form-label" for="pilihjenis_report">Jenis report</label>
								<input type="hidden" name="idjenisreport" id="idjenisreport">
								<div class="col-sm-7 form-group">
									<select name="pilihjenis_report" class="form-control" id="pilihjenis_report">
										<option value="" selected disabled>- Pilih Jenis Report -</option>
										<?php foreach ($jenisservice as $service) : ?>
											<option value="<?php echo $service->jenis ?>"><?php echo $service->jenis ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- <div class="col-md-6">
							<div class="form-group row">
								<input type="hidden" class="form-control" id="gruplogin" value="<?php echo $this->session->userdata('mygrup') ?>" width="200" readonly>

								<label class="col-sm-3 col-form-label" for="jenis_report">Jenis Report</label>
								<input type="hidden" class="form-control" id="viewname" width="200" readonly>
								<input type="hidden" class="form-control" id="reportname" width="200" readonly>
								<input type="hidden" class="form-control" id="reportlocation" width="200" readonly>
								<input type="hidden" class="form-control" id="filereport" width="200" readonly>
								<div class="col-sm-7 form-group">
									<select name="jenis_report" class="form-control" id="jenis_report">
										<?php foreach ($paramcombobox as $cell) : ?>
											<option value="<?php echo $cell->nama_report ?>"><?php echo $cell->nama_report ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div> -->

						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label" for="pilihjenisreport">Pilih report</label>
								<input type="hidden" class="form-control" id="viewname" width="200" readonly>
								<input type="hidden" class="form-control" id="reportname" width="200" readonly>
								<input type="hidden" class="form-control" id="reportlocation" width="200" readonly>
								<input type="hidden" class="form-control" id="filereport" width="200" readonly>
								<div class="col-md-7 form-group">
									<input class="form-control" type="text" name="jenis_report" id="jenis_report" placeholder="" readonly required />
								</div>
								<div class="col-sm-1.5 form-group">
									<button id="carijenisreport" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpilihjenisreport">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-lg-6" id="grup_part">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="kode_part">Kode Parts</label>
								<div class="col-sm-7 form-group">
									<input class="form-control" type="text" name="kode_part" id="kode_part" placeholder="Kode Parts" maxlength="50" required />
								</div>
								<div class="col-md-2">
									<button id="cariparts" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpart">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-lg-6" id="grup_customer">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="kodecustomer">Nomor Customer</label>
								<div class="col-sm-7 form-group">
									<input class="form-control" type="text" name="kodecustomer" id="kodecustomer" placeholder="Nomor Customer" maxlength="50" required />
								</div>
								<div class="col-md-2">
									<button id="caricustomer" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findcustomer">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</div>
					</div>

					<div class="row" id="bulanan">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="bulan">Bulan</label>
								<div class="col-md-7">
									<div class="input-group date" id="bulan_mulai">
										<input type="text" class="form-control" id="bulan" width="200" value="<?php echo date("Y-m"); ?>" readonly>
										<div class="input-group-prepend">
											<div class="input-group-text btn-primary">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row" id="tanggalinput">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="tglmulai">Tanggal Mulai</label>
								<div class="col-md-7">
									<div class="input-group date" id="tanggal_mulai">
										<input type="text" class="form-control" id="tglmulai" width="200" value="<?php echo date("Y-m-d"); ?>" readonly>
										<div class="input-group-prepend">
											<div class="input-group-text btn-primary">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="tglakhir">Tanggal Akhir</label>
								<div class="col-md-7">
									<div class="input-group date" id="tanggal_akhir">
										<input type="text" class="form-control" id="tglakhir" width="200" value="<?php echo date("Y-m-d"); ?>" readonly>
										<div class="input-group-prepend">
											<div class="input-group-text btn-primary">
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="align-center">
								<button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;Print</button>
								&emsp;
								<button id="excel" class="btn btn-success"><i class="fa fa-file-excel"></i> &nbsp;Export Excel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- pop up jenis report -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpilihjenisreport">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Report</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="tablesearchjenisreport" class="table table-bordered table-striped" style="width:100%">
						<thead>
							<tr>
								<th width="10">Action</th>
								<th width="150">Report</th>
							</tr>
						</thead>
						<tbody></tbody>

					</table>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- Pop Sparepart  -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpart">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Data Parts</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="tablesearchparts" class="table table-bordered table-striped" style="width:100%">
						<thead>
							<tr>
								<th width="10">Action</th>
								<th width="50">Kode</th>
								<th width="150">Nama</th>
							</tr>
						</thead>
						<tbody></tbody>

					</table>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcustomer">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Data Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="tablesearchcustomer" class="table table-bordered table-striped" style="width:100%">
						<thead>
							<tr>
								<th width="10">Action</th>
								<th width="50">Nomor</th>
								<th width="150">Nama</th>
							</tr>
						</thead>
						<tbody></tbody>

					</table>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
