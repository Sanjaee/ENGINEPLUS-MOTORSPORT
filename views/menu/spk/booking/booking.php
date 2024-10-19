<div class="breadcrumb">
	<h1>Entry Booking Service</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                <?php if ($this->session->flashdata('pesan')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nomor">Nomor Booking
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" readonly required/>
                                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang')?>" readonly required />
                                    <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang')?>" readonly required />
                                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany')?>" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tgl Booking
                                <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                <div class="col-sm-8">
                                    <div class="input-group date" id="tanggalbk">
                                        <input type="text" class="form-control" id="tanggal" width="200" readonly>
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

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nopolisi">Nomor Polisi
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nomor Polisi" maxlength="50" required/>
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="carisn" class="btn-search btn-primary btn-block"   data-toggle="modal" data-target="#findnopol">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="returnjob">Return Job</label>
                                <br>
                                <div class="col-sm-6 form-group">
                                    <label class="radio radio-success">
                                        <input type="radio" name="returnjob" id="returnjob" value="true"><span> YA</span><span class="checkmark"></span>
                                    </label>
                                    &emsp;&emsp;&emsp;
                                    <label class="radio radio-danger">
                                        <input type="radio" name="returnjob" id="nonreturnjob" value="false"><span> TIDAK</span><span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nocustomer">Nama
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Kode" maxlength="150" readonly required/>
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" required/>
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="caricustomer"  class="btn-search btn-primary btn-block"  data-toggle="modal" data-target="#findcust">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="inventaris">Inventaris</label>
                                <br>
                                <div class="col-sm-6 form-group">
                                    <label class="radio radio-success">
                                        <input type="radio" name="inventaris" id="inventaris" value="true"><span> YA</span><span class="checkmark"></span>
                                    </label>
                                    &emsp;&emsp;&emsp;
                                    <label class="radio radio-danger">
                                        <input type="radio" name="inventaris" id="noninventaris" value="false"><span> TIDAK</span><span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tipe">Tipe
                                <span style="color: red; font-size: 10; font-weight: normal">*</span>
                            </label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="kodetipe" id="kodetipe" placeholder="Kode" maxlength="150" readonly required/>
                                <input class="form-control" type="hidden" name="model" id="model" placeholder="Kode" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namatipe" id="namatipe" placeholder="Nama Tipe" maxlength="250" readonly required/>
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button id="caritipe"  class="btn-search btn-primary btn-block"   data-toggle="modal" data-target="#findtipe">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="pic">PIC 
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="pic" id="pic" placeholder="PIC" maxlength="250" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="keluhan">Keluhan 
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-8 form-group">
                                <textarea name="keluhan" id="keluhan" class="form-control" maxlength="250" placeholder="Keluhan" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nohp">No. HP 
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="nohp" id="nohp" placeholder="No. HP" maxlength="250" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jenis">Jenis 
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-8 form-group">
                                    <select name="jenis" class="form-control" id="jenis">
                                        <option value="-">- Pilih Jenis -</option>
                                        <option value="0">Service Berkala Int</option>
                                        <option value="1">Service Berkala Ext</option>
                                        <option value="2">General Repair</option>
                                        <option value="3">Express Maintenance</option>
                                        <option value="4">Custom</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="regular">Regular Check</label>
                                <!-- <span style="color: red; font-size: 10; font-weight: normal">*</span></label> -->
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="koderegular" id="koderegular" placeholder="Kode" maxlength="150" readonly required/>
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="namaregular" id="namaregular" placeholder="Nama Paket Perawatan" maxlength="250" readonly required/>
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="cariregular"  class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findregular">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jenis_detail">Jenis Detail
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-8 form-group">
                                    <select name="jenis" class="form-control" id="jenis_detail">
                                        <option value="-">- Pilih Jenis Detail -</option>
                                        <option value="1">Parts</option>
                                        <option value="2">Task List</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode">Kode Sparepart / Jasa</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kode" id="kode" placeholder="Kode" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama" maxlength="250" readonly required />
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="cariparts" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpart"><i class="fa fa-search"></i></button>
                                    <button id="caritask" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findtask"><i class="fa fa-search"></i></button>
                               </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jenisdetailx">Kategori / Detail
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="jenisdetail" id="jenisdetail" placeholder="kategori" maxlength="250" style="text-align:left" readonly required />
                                </div>

                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="detailkategori" id="detailkategori" placeholder="Detail Kategori" maxlength="150" style="text-align:left" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label" for="qty">Qty / Harga
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                
                                <div class="col-sm-6 form-group">
                                    <input class="form-control" type="text" name="qty" id="qty" placeholder="Qty" maxlength="250" style="text-align:right" required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group row">
                                <!-- <label class="col-sm-3 col-form-label" for="harga">Harga</label> -->
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="harga" id="harga" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 form-group">
                            <input class="form-control" type="text" name="satuan" id="satuan" placeholder="satuan" maxlength="250" readonly required />
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="total">Total</label>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="total" id="total" placeholder="Total" maxlength="250" style="text-align:right" required />
                                </div>
                                <div class="form-group">
                                    <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                    <button id="edit_detail" class="btn btn-new"><i class="fa fa-edit"></i> &nbsp;Edit</button>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-1">
                            <div class="form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                <button id="edit_detail" class="btn btn-new"><i class="fa fa-edit"></i> &nbsp;Edit</button>
                            </div>
                        </div> -->
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="detailspk">
                                            <tr>
                                                <th style="display:none;"></th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Jenis</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Subtotal</th>
                                                <th width = "100px" ></th>
                                            </tr>
                                            <tbody id="detaildataspk"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row" id="tableparts" hidden require>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="detailparts">
                                            <tr>
                                                <th style="display:none;"></th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Jenis</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Subtotal</th>
                                                <th width = "100px" ></th>
                                            </tr>
                                            <tbody id="detaildataparts"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row" id="tabletask" hidden require>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="detailtask">
                                            <tr>
                                                <th style="display:none;"></th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Jenis</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Subtotal</th>
                                                <th width = "100px" ></th>
                                            </tr>
                                            <tbody id="detaildatatask"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="total_sparepart">Total Sparepart</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="total_sparepart" id="total_sparepart" maxlength="50" value="0" readonly required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="dpp">DPP</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="dpp" id="dpp" maxlength="50" value="0" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="total_jasa">Total Jasa</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="total_jasa" id="total_jasa" maxlength="50" value="0" readonly required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="ppn">PPN</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="ppn" id="ppn" maxlength="50" value="0" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="grandtotal">Grand Total</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="grandtotal" id="grandtotal" maxlength="50" value="0" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="card mb-4">
			<div class="card-body">
				<div class="form-group">
					<button id="new" class="btn  btn-success"><i class="fa fa-refresh"></i>&nbsp; NEW</button>
					<button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;SAVE</button>
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
					<button id="find" class="btn  btn-success"   data-toggle="modal" data-target="#findbook"><i class="fa fa-search"></i>&nbsp;FIND</button>
					<button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-window-close"></i>&nbsp; CANCEL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
				</div>
			</div>
		</div>
	</div>
</div>


            <!-- Find Data -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findnopol">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Kendaraan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tablesearchsn" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="150">Nomor polisi</th>  
                                            <th width="150">Nomor Rangka</th>
                                            <th width="150">Nomor Mesin</th>
                                            <th width="150">Nomor Customer</th>
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


            <!-- Find Data -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findtipe">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Tipe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tablesearchtipe" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Kode</th>  
                                            <th width="150">Nama</th>
                                            <th width="20">Kode Kategori</th>
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


            <!-- Find Data -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcust">
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
                                            <th width="10"></th>
                                            <th width="25">Nomor</th>  
                                            <th width="150">Nama</th>
                                            <!-- <th width="500">Alamat</th> -->
                                            <th width="20">No. HP</th>
                                            <th width="20">Email</th>
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


            <!-- Find Data -->
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
                                        <th width="50">Harga Jual</th>
                                        <th width="50">Qty</th>
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

            <!-- Find Data -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findtask">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Tasklist</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tablesearchtask" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Kode</th>  
                                            <th width="150">Nama</th>
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

            <!-- Find Data -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findbook">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Booking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Nomor</th>  
                                            <th width="150">Nomor Polisi</th>  
                                            <th width="150">Nama Customer</th>  
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

            <div id="tablesearchtampil" class = "popup8">
                <div class="popupsearch">

                    <table width="100%" style="margin-top: 5px;">
                        <tr>
                            <td width="90%" style="vertical-align: bottom;">

                            </td>
                            <td width="10%" style="vertical-align: bottom;">
                                <div id="button">
                                    <button id="closesearchspk" class="btn btn-light" style = "background-color: #FFFFFF;"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td width="100%" style="vertical-align: bottom;">
                                <h3 align="center"><b>HISTORY SPK</b></h3>
                            </td>
                        </tr>
                    </table>

                    <div class="pre-scrollable">  
                        <div class="table-responsive">
                            <table id="tablesearchspk" class="table table-bordered table-striped">  
                                <thead>  
                                    <tr>  
                                        <th width="25">Nomor SPK</th>  
                                        <th width="25">Nomor SN</th>  
                                        <th width="150">Nama</th>
                                        <th width="150">Keluhan</th>
                                    </tr>  
                                </thead>                  
                            </table>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findregular">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Regular Check</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">  
                            <div class="table-responsive">
                                <table id="tablesearchregular" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Kode</th>  
                                            <th width="150">Nama</th>
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