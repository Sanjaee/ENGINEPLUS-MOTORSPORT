            <div class="breadcrumb">
            	<h1>Jenis Report</h1>
            </div>
            <?php
			$aktif = 'TRUE';
			$menu = 'report';
			$grup = $this->session->userdata('mygrup');
			$report = $this->db->query("SELECT * FROM Stpm_report WHERE menu = '" . $menu . "' AND aktif = '" . $aktif . "' AND grup = '" . $grup . "' order by index asc ")->result();;
			?>

            <!-- /. ROW  -->

            <div class="row text-left pad-top">
            	<div class="col-md-5">
            		<div class="form-group">
            			<label for="nama">Nama &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
            			<input class="form-control" type="hidden" name="id_jenis" id="id_jenis" />
            			<input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required />
            		</div>
            		<div class="form-group">
            			<label for="aktif">Aktif &emsp;&emsp;&emsp;&emsp; :</label>
            			<input type="radio" name="aktif" id="aktif" value=true required /> Ya
            			&emsp;&emsp;
            			<input type="radio" name="aktif" id="aktif" value=false required /> Tidak
            		</div>

            		<br>

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
            <div id="tablesearchtampil">
            	<center>
            		<div class="popupsearch">
            			<div class="pre-scrollable">
            				<h3 align="center">Jenis Report</h3>
            				<div class="table-responsive">
            					<table id="tablesearch" class="table table-bordered table-striped">
            						<thead>
            							<tr>
            								<th width="5"></th>
            								<th width="50">Nama</th>
            								<th width="25">Aktif</th>
            							</tr>
            						</thead>
            					</table>
            					<div id="button">
            						<button id="closesearch" class="btn btn-dark1">Close</button>
            					</div>
            				</div>
            			</div>
            		</div>
            	</center>
            </div>
