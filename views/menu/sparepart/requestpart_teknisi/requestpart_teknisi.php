<div class="breadcrumb">
	<h1>Request Teknisi</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nomor">Nomor</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50"  readonly required/>
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang')?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang')?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany')?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggalorder">Tanggal Order</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="tanggalorder" id="tanggalorder" maxlength="50" value = "<?php echo date("d-m-Y"); ?>" readonly required/>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nomorspk">Nomor WO</label>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" type="text" name="nomorspk" id="nomorspk" placeholder="Nomor WO" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target="#findwo" id="carispk"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kode_tipe">Tipe</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode_tipe" id="kode_tipe" placeholder="Kode Tipe" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe" maxlength="150" readonly required/>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nocustomer">No Customer</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Nomor Customer" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="150" readonly required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kode_kategori">Kategori</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode_kategori" id="kode_kategori" placeholder="Kode Kategori" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" placeholder="Nama Kategori" maxlength="150" readonly required/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-8 form-group">
                                <textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" maxlength="150" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kodemekanik">Mekanik</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodemekanik" id="kodemekanik" placeholder="Kode Mekanik" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namamekanik" id="namamekanik" placeholder="Nama Mekanik" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findmekanik" id="carimekanik"  class="btn-search btn-primary btn-block">
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
                            <label class="col-sm-2 col-form-label" for="kode">Kode Parts</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode" id="kode" maxlength="50" placeholder="Kode" style="width: 150px" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" style="width: 250px" readonly required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="cariparts"  class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpart">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="Satuan">Satuan</label>
                            <div class="col-sm-5 form-group">
                            <input class="form-control" type="text" name="satuan" id="satuan" placeholder="satuan" maxlength="250" readonly required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="qty">Qty</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qty" id="qty"  maxlength="250" style="text-align:right" required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="form-group">
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="detail">
                        <tr>
                            <th style="display:none;"></th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Qty</th>
                            <th width = "100px" ></th>
                        </tr>
                        <tbody id="detaildata"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                            <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                            <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                            <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findreq"><i class="fa fa-search"></i>&nbsp;FIND</button>
                            <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                            <button id="history" class="btn  btn-danger" data-toggle="modal" data-target="#findhistory"><i class="fa fa-pencil-square-o"></i>&nbsp; HISTORY</button>
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
                                            <th width="150">No Rangka</th>
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

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findreq">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Request Part</h5>
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
                                            <th width="150">Nomor Referensi</th>  
                                            <th width="150">Keterangan</th>
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


            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findhistory">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Histroy Pembebanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                        <div class="table-responsive">
                            <table id="tablesearchhistory" class="table table-bordered table-striped" style="width:100%">  
                                <thead>  
                                    <tr>  
                                        <th width="25">Nomor</th>  
                                        <th width="25">Nomor WO</th> 
                                        <th width="150">Kode Part</th>  
                                        <th width="150">Nama Part</th>  
                                        <th width="150">Qty</th>  
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


            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findmekanik">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Mekanik</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                            <div class="table-responsive">
                                <table id="tablesearchmekanik" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>
                                            <th width="25"></th>   
                                            <th width="25">Kode</th>  
                                            <th width="25">Nama Mekanik</th> 
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




    </div>






</div>