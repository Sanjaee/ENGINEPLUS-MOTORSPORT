<div class="breadcrumb">
    <h1>Pemakaian Sparepart</h1>
</div>
<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nomor">Nomor Pemakaian</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" readonly required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="tanggal" id="tanggal" maxlength="50" readonly required />
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
                                <input class="form-control" type="text" name="nomorspk" id="nomorspk" maxlength="50" placeholder="Nomor WO" readonly required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target="#findwo" id="carispk" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kategori">Keterangan</label>
                            <div class="col-sm-8 form-group">
                                <textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required> </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nopolisi">No Polisi</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nomor Polisi" maxlength="150" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kode_teknisi">Teknisi</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode_teknisi" id="kode_teknisi" placeholder="Kode Teknisi" maxlength="150" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="nama_teknisi" id="nama_teknisi" placeholder="Nama Teknisi" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nocustomer">Customer</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="No Customer" maxlength="150" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="keluhan">Keluhan</label>
                            <div class="col-sm-8 form-group">
                                <textarea class="form-control" type="text" name="keluhan" id="keluhan" placeholder="keluhan" maxlength="150" readonly required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">                  
                        
                    </div> -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kodesparepart">Sparepart</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodesparepart" id="kodesparepart" placeholder="Kode Part" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namasparepart" id="namasparepart" placeholder="Nama Part" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findpart" id="caripart" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="hargasatuan">Harga</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="hargasatuan" id="hargasatuan" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                            </div>

                            <label for="qty">Qty</label>
                            <div class="col-sm-1 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" maxlength="250" style="text-align:right" placeholder="0" required />
                            </div>
                            <label for="qtystock">Qty Stock</label>
                            <div class="col-sm-1 form-group">
                                <input class="form-control" type="text" name="qtystock" id="qtystock" maxlength="250" style="text-align:right" placeholder="0" readonly required />
                            </div>
                            <label for="total">Subtotal</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="total" id="total" maxlength="250" style="text-align:right" placeholder="Subtotal" required />
                            </div>

                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">                          
                                <label class="col-sm-2 col-form-label" for="qtystock">Qty Stock</label>
                               
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="qtystock" id="qtystock" maxlength="250" style="text-align:right" placeholder = "0" readonly required/>
                                  </div>
                            
                                <label for="total">Total</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="total" id="total" maxlength="250" style="text-align:right" readonly required/>
                                </div>

                                <div class="col-sm-2 form-group">
                                    <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    </div> -->

                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped display nowrap" id="detailfaktur">
                            <tr>
                                <!-- <th style=""></th> -->
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>QtyStock</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                            <tbody id="detaildatafaktur"></tbody>
                        </table>
                    </div>
                </div>

                <!-- <div class="row">                  
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="grandtotal">Grand total</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="grandtotal" id="grandtotal" maxlength="50" value="0" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
                            <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findpembebanan"><i class="fa fa-search"></i>&nbsp;FIND</button>
                            <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                            <button id="history" class="btn  btn-danger" data-toggle="modal" data-target="#findhistory"><i class="fa fa-pencil-square-o"></i>&nbsp; HISTORY</button>
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
                                        <th width="25">Nomor</th>
                                        <th width="150">No Polisi</th>
                                        <th width="150">No Rangka</th>
                                        <th width="150">Nama Customer</th>
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

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findhistory">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Histroy Pemakaian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchhistory" class="table table-bordered table-striped display nowrap" style="width:100%">
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
                        <button id="cetakclosewo" class="btn btn-danger"><i class="fa fa-print"></i> &nbsp;Cetak</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Find Data -->

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpembebanan">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Pemakaian</h5>
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

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpart">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Spareparts</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchpart" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="25">Kode</th>
                                        <th width="150">Nama</th>
                                        <th width="50">Harga Jual</th>
                                        <th width="50">Harga Beli</th>
                                        <th width="50">Qty</th>
                                        <th width="50">Lokasi</th>
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

        <div class="span4" data-toggle="modal" data-target="#tampilsaran" data-backdrop="static" data-keyboard="false" id="munculpesan"></div>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="tampilsaran">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Minimum Stock</h5>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title" id="saranservice"></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="closesaranservice">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>