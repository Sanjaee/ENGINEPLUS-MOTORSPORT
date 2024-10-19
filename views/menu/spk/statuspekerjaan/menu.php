<div class="breadcrumb">
    <h1>Status Pekerjaan</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nomor_wo">Nomor WO</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="nomor_wo" id="nomor_wo" maxlength="50" value="" readonly required />
                                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="kodegrupcabang" id="kodegrupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button data-toggle="modal" data-target="#carinomorwo" id="cariwo" class="btn-search btn-primary btn-block">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nopolisi">No Polisi</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="nopolisi" id="nopolisi" maxlength="50" placeholder="Nomor Polisi" readonly required />

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="foreman">Foreman</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" name="kodeforeman" id="kodeforeman" maxlength="50" value="" readonly required />
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="namaforeman" id="namaforeman" maxlength="50" value="" readonly required />
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tanggal_wo">Tanggal WO</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="tanggal_wo" id="tanggal_wo" maxlength="50" readonly required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nocustomer">Customer</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" maxlength="50" readonly required />
                                </div>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" maxlength="50" readonly required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="keluhan">Keluhan</label>
                                <div class="col-sm-8">
                                    <textarea name="keluhan" id="keluhan" cols="10" rows="2" class="form-control" readonly></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <button id="history" class="btn btn-danger" data-toggle="modal" data-target="#findhistory"><i class="fa fa-times"></i>&nbsp; HISTORY</button>
                            </div>
                            <div class="col-sm-2">
                                <button id="cetak" class="btn btn-success" data-toggle="modal"><i class="fa fa-file"></i>&nbsp; CETAK</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label" for="persen">Persen Disc</label>
                        <div class="col-sm-3 form-group">
                            <input class="form-control" type="text" name="persen" id="persen"  maxlength="250" style="text-align:right" readonly  required/>
                        </div>
                    
                        <label for="discount">Discount</label>
                        <div class="col-sm-3 form-group">
                            <input class="form-control" type="text" name="discount" id="discount"  maxlength="250" style="text-align:right"  readonly required/>
                        </div>
                    
                        <label for="total">Total</label>
                        <div class="col-sm-2 form-group">
                            <input class="form-control" type="text" name="total" id="total" maxlength="250" style="text-align:right" readonly required/>
                        </div>

                        <div class="col-sm-2 form-group">
                            <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                        </div>
                    </div>
                </div>
            </div> -->
                <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="tablestatuspekerjaan">
                                    <tr>
                                        <th style="text-align:center;">Kode</th>
                                        <th style="text-align:center;">Nama</th>
                                        <th style="text-align:center;">Qty</th>
                                        <th style="text-align:center;">Harga</th>
                                        <th style="text-align:center;">Persendisc</th>
                                        <th style="text-align:center;">Disc</th>
                                        <th style="text-align:center;">Total</th>
                                        <th style="text-align:center;">Status</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                    <tbody id="tabledatastatuspekerjaan"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <!-- <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="dpp">DPP</label>
                            &emsp;&emsp;&emsp;&emsp;&emsp;
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="dpp" id="dpp" maxlength="50" value="0" style="text-align:right" readonly required />
                                <input class="form-control" type="hidden" name="totalpinalti" id="totalpinalti" maxlength="50" value="0" style="text-align:right" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="ppn">PPN</label>
                            <div class="col-sm-7 form-group">
                                <input class="form-control" type="text" name="ppn" id="ppn" maxlength="50" value="0" style="text-align:right" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="grandtotal">Total</label>
                            <div class="col-sm-7 form-group">
                                <input class="form-control" type="text" name="grandtotal" id="grandtotal" maxlength="50" value="0" style="text-align:right" readonly required />
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">

                    <!-- <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                    <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                    <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findretur"><i class="fa fa-search"></i>&nbsp;FIND</button> -->
                    <!-- <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button> -->
                    <!-- <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button> -->
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findhistory">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">HISTORY BATAL PEKERJAAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchspk" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nomor WO</th>
                                <th>Nopolisi</th>
                                <th>Kode Pekerjaan</th>
                                <th>Nama Pekerjaan</th>
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="carinomorwo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cari WO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchwo" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="100">Tanggal</th>
                                <th width="100">No Polisi</th>
                                <th width="100">Nama Customer</th>
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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findretur">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Retur Parts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchretur" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="25">Tanggal</th>
                                <th width="150">Nomor Penerimaan</th>
                                <th width="150">Nomor Invoice</th>
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