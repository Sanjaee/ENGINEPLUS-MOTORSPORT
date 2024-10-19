            <div class="breadcrumb">
            	<h1>Otorisasi Report</h1>
            </div>
            <?php
			$aktif = 'TRUE';
			$menu = 'report';
			$grup = $this->session->userdata('mygrup');
			$report = $this->db->query("SELECT * FROM Stpm_report WHERE menu = '" . $menu . "' AND aktif = '" . $aktif . "' AND grup = '" . $grup . "' order by index asc ")->result();;
			?>

            <!-- /. ROW  -->

            <div class="row">
            	<div class="col-md-6">
            		<div class="form-group row">
            			<label for="nama" class="col-md-2">Nama</label>
            			<div class="col-md-8 form-group">
            				<input class="form-control" type="hidden" name="id_jenis" id="id_jenis" />
            				<input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required />
            			</div>
            			<div class="col-md-2 form-group">
            				<button id="carireport" class="btn-search btn-primary" data-toggle="modal" data-target="#findreport"><i class="fa fa-search"></i></button>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-6">
            		<div class="form-group row">
            			<label for="nama" class="col-md-2">Otorisasi</label>
            			<div class="col-md-8 form-group">
            				<input class="form-control" type="hidden" name="id_jenis" id="id_jenis" />
            				<input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Otorisasi" required />
            			</div>
            		</div>
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-6">
            		<div class="form-group row">
            			<label for="exampleFormControlSelect1" class="col-md-2">Jenis Report</label>
            			<div class="form-group col-md-4">
            				<select class="form-control" id="exampleFormControlSelect1">
            					<option selected disabled>-Pilih Jenis-</option>
            					<option>1</option>
            					<option>2</option>
            					<option>3</option>
            					<option>4</option>
            					<option>5</option>
            				</select>
            			</div>
            		</div>
            	</div>
            </div>

            <div class="row">
            	<div class="col-md-6">
            		<div class="card-body">
            			<div class="form-group">
            				<button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
            				<button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
            				<button id="find" class="btn  btn-success"><i class="fa fa-search"></i>&nbsp;FIND</button>
            				<button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
            				<button id="close" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; CLOSE</button>
            			</div>
            		</div>
            	</div>
            </div>

            <!-- Find Data -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findreport">
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
            					<table id="tablesearch" class="table table-bordered table-striped" style="width:100%">
            						<thead>
            							<tr>
            								<th width=""></th>
            								<th width="50">Nama report</th>
            								<th width="">Otorisasi</th>
            								<th width="50">Aktif</th>
            							</tr>
            						</thead>
            					</table>
            				</div>
            			</div>
            			<div class="modal-footer">
            				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            			</div>
            		</div>
            	</div>
            </div>
