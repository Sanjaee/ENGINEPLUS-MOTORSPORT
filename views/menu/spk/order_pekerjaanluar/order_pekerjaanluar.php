<div class="breadcrumb">
	<h1>Order Pekerjaan Luar</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="noinvoice">No Invoice</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="noinvoice" id="noinvoice" maxlength="50" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="tglinvoice">Tgl Invoice</label>
                                <div class="col-sm-6 form-group">
                                    <div class="input-group date" id="tanggalinv">
                                        <input type="text" class="form-control" id="tanggalinvoice" width="200" readonly>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text btn-primary">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="Invoice" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; Invoice</button>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="nomor">Nomor OPL</label>
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
                                    <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="tanggal" id="tanggal" maxlength="50" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row" >
                                <label class="col-sm-2 col-form-label" for="nomorspk">Nomor WO</label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="nomorspk" id="nomorspk" maxlength="50" placeholder="Nomor WO" readonly required/>
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="carispk"  class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findwo">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nopolisi">No Polisi</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nomor Polisi" maxlength="150" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nocustomer">Customer</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="No Customer" maxlength="150" readonly required/>
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" readonly required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode_teknisi">Teknisi</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kode_teknisi" id="kode_teknisi" placeholder="Kode Teknisi" maxlength="150" readonly required/>
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="nama_teknisi" id="nama_teknisi" placeholder="Nama Teknisi" maxlength="250" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kodesupplier">Supplier</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kodesupplier" id="kodesupplier" placeholder="Kode Supplier" maxlength="150" readonly required/>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="namasupplier" id="namasupplier" placeholder="Nama Supplier" maxlength="250" readonly required/>
                                    <input class="form-control" type="hidden" name="pkpsupplier" id="pkpsupplier" placeholder="Nama Supplier" readonly required />
                           </div>
                                <div class="col-sm-1.5 form-group">
                                    <button  id="carisupp"  class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findsupplier">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="alamatsupplier">Alamat Supplier</label>
                                <div class="col-sm-8 form-group">
                                    <textarea class="form-control" type="text" name="alamatsupplier" id="alamatsupplier" placeholder="Alamat Supplier" maxlength="150" readonly required></textarea>
                                </div>
                            </div>
                        </div>     
                    </div>

                    <!-- <div class="row">                  
                        
                    </div> -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="kodeopl">Jasa OPL</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="kodeopl" id="kodeopl" placeholder="Kode OPL" readonly required/>
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="namaopl" id="namaopl" placeholder="Nama OPL" readonly required/>
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="cariopl"  class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findopl">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>    

                        <div class="col-md-6">
                            <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="kategoridetail">Kategori Detail</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="kategoridetail" id="kategoridetail" placeholder="Kategori Detail" required/>
                                </div>
                            </div>
                        </div>   
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" for="hargabeli">Harga Beli</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="hargabeli" id="hargabeli" placeholder="Harga Beli" maxlength="250" style="text-align:right" required/>
                                    <!-- <input class="form-control" type="text" name="hargabelix" id="hargabelix" placeholder="Harga Beli" maxlength="250" style="text-align:right" readonly required/> -->
                                </div>

                                <label class="col-sm-1 col-form-label" for="hargajual">Harga Jual</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="hargajual" id="hargajual" placeholder="Harga Jual" maxlength="250" style="text-align:right" required/>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                </div>
                                
                                <div class="col-sm-2 form-group">
                                    <button id="remove-row" class="btn btn-danger"><i class="fa fa-plus"></i> &nbsp;Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped display nowrap" id="detailfaktur">
                                    <tr>
                                        <!-- <th style=""></th> -->
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>KategoriDetail</th>
                                        <th>Harga</th>
                                        <th>HargaJual</th>
                                        <th>Edit</th>
                                    </tr>
                                <tbody id="detaildatafaktur"></tbody>
                            </table>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="dpp">DPP</label>
                            &emsp;&emsp;&emsp;&emsp;&emsp;
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="dpp" id="dpp" maxlength="50" value="0" style="text-align:right" readonly required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="ppn">PPN</label>
                            <div class="col-sm-7 form-group">
                                <input class="form-control" type="text" name="ppn" id="ppn" maxlength="50" value="0" style="text-align:right" readonly required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="grandtotal">Total</label>
                            <div class="col-sm-7 form-group">
                                <input class="form-control" type="text" name="grandtotal" id="grandtotal" maxlength="50" value="0" style="text-align:right" readonly required/>
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
                                <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                                <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                                <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                                <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#finddataopl"><i class="fa fa-search"></i>&nbsp;FIND</button>
                                <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                                
                                <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
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
                                <table id="tablesearchspk" class="table table-bordered table-striped display nowrap" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="150">Nomor WO</th>  
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

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findsupplier">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">  
                            <div class="table-responsive">
                                <table id="tablesearchsupplier" class="table table-bordered table-striped display nowrap" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Kode</th>  
                                            <th width="25">Nama</th> 
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
            
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="finddataopl">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data OPL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">  
                        <div class="table-responsive">
                            <table id="tablesearch" class="table table-bordered table-striped display nowrap" style="width:100%">  
                                <thead>  
                                    <tr>  
                                        <th width="10"></th>
                                        <th width="25">Nomor</th>  
                                        <th width="150">Nomor WO</th>  
                                        <th width="150">Nomor Polisi</th>  
                                        <th width="150">Invoice</th>
                                        <th width="150">Kode OPL</th>
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

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findopl">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Jasa OPL</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">  
                            <div class="table-responsive">
                                <table id="tablesearchopl" class="table table-bordered table-striped display nowrap" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Kode</th>  
                                            <th width="150">Nama</th>  
                                            <th width="150">Harga Beli</th>  
                                            <th width="150">Harga Jual</th> 
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

        </div>  