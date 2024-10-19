<div class="breadcrumb">
	<h1>Memo Pembatalan WO</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row ">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nomor">Nomor Pembatalan </label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" readonly required/>
                                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang')?>" readonly required />
                                    <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang')?>" readonly required />
                                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany')?>" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="tanggal" id="tanggal" maxlength="50" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nomorspk">Nomor WO </label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="nomorspk" id="nomorspk" placeholder="Nomor WO" maxlength="50" readonly required/>
                                </div>
                                <div class="form-group">
                                    <button id="carispk" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findwo">
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
                            <label class="col-sm-3 col-form-label" for="nocustomer">Customer</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Nomor Customer" maxlength="150" readonly required/>
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" readonly required/>
                                </div>
                                &nbsp;&nbsp;
                                <!-- <div class="form-group">
                                    <button data-toggle="modal" data-target=".namacustomer" id="caricustomer"  class="btn-search btn-primary btn-block">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode_tipe">Tipe</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kode_tipe" id="kode_tipe" placeholder="Kode" maxlength="150" readonly required/>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe" maxlength="250" readonly required/>
                                </div>
                                &nbsp;&nbsp;
                                <!-- <div class="form-group">
                                    <button data-toggle="modal" data-target=".tipe" id="caritipe"  class="btn-search btn-primary btn-block">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="alasan">Alasan Pembatalan</label>
                                <div class="col-sm-8 form-group">
                                <textarea name="alasan" id="alasan" class="form-control" placeholder="Alasan Pembatalan ..." ></textarea>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="detailspk">
                                            <tr>
                                                <th style="display:none;"></th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Jenis</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Subtotal</th>
                                            </tr>
                                            <tbody id="detaildataspk"></tbody>
                                    </table>
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
                    <button id="new" class="btn btn-success"><i class="fa fa-retweet"></i> &nbsp;NEW</button>
                    <button id="save" class="btn btn-success"><i class="fa fa-save"></i> &nbsp;SAVE</button>
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                    <button id="find" class="btn btn-success" data-toggle="modal" data-target="#findmemo"><i class="fa fa-search"></i> &nbsp;FIND</button>
                    <button id="cancel" class="btn btn-danger" disabled><i class="fa fa-window-close"></i> &nbsp;CANCEL</button>
                </div>
			</div>
		</div>
	</div>
</div>

<!-- Find Data -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findwo">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data WO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                            <div class="table-responsive">
                                <table id="tablesearchspk" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="150">Nomor WO</th>  
                                            <th width="150">No Polisi</th>
                                            <th width="150">Nomor Customer</th>
                                            <th width="150">Tipe</th>  
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

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findmemo">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Memo</h5>
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
                                            <th width="150">Nomor WO</th>  
                                            <th width="250">Alasan</th>  
                                            <!--th width="150">Grand_Total</th-->
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
