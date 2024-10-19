<div class="breadcrumb">
    <h1>Berita Acara Gudang</h1>
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jenis_detail">Jenis Detail</label>
                            <div class="col-sm-8 form-group">
                                <select name="jenis" class="form-control" id="jenis_detail">
                                    <option value="-">- Pilih Jenis Detail -</option>
                                    <option value="1">Adjustment In</option>
                                    <option value="2">Adjustment Out</option>
                                </select>
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
                </div>

                <!-- <div class="row">                  
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                                <div class="col-sm-8 form-group">
                                    <textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" maxlength="150" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div> -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kodesparepart">Kode Parts</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodesparepart" id="kodesparepart" maxlength="50" placeholder="Kode" style="width: 150px" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namasparepart" id="namasparepart" maxlength="50" placeholder="Nama" style="width: 250px" readonly required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target="#findpart" id="carisparepart" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="qtystock">Qty Stock</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qtystock" id="qtystock" maxlength="250" style="text-align:right" readonly required />
                            </div>
                            <label class="col-sm-2 col-form-label" for="qty">Qty</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" maxlength="250" style="text-align:right" required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="add-row" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row " id="tampilharga">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-2" for="harga">Nilai Satuan</label>
                            <div class="col-md-5">
                                <input class="form-control" type="text" name="harga" id="harga" maxlength="50" value="0" style="text-align:right" required />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                            <label for="kodesparepart">Kode &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; : &nbsp;</label>
                            <input class="form-single" type="text" name="kodesparepart" id="kodesparepart" style="width:120px" placeholder="Kode" readonly required/>
                            <input class="form-double" type="text" name="namasparepart" id="namasparepart" style="width:320px" placeholder="Nama" readonly required/>
                            <button id="carisparepart" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                            
                        <div class="form-group">
                            <label for="qty">Qty&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</label>
                            <input class="form-control" type="text" name="qty" id="qty" maxlength="50" value="0" style="text-align:right" required/>
                            <button id="add-row" class="btn btn-search" ><b>Add</b></button>
                        </div>               -->

                <br>

                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped display nowrap" id="detailsparepart">
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>action</th>
                            </tr>
                            <tbody id="detaildatasparepart"></tbody>
                        </table>
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
                    <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findbag"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <button id="cetak" class="btn  btn-success"><i class="fa fa-print"></i>&nbsp; CETAK</button>
                    <!-- <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <table id="tablesearchsparepart" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Action</th>
                                <th width="25">kode sparepart</th>
                                <th width="25">Nama Sparepart</th>
                                <th width="150">Qty</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findbag">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data BAG</h5>
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
                                <th width="100">Tanggal</th>
                                <th width="100">Keterangan</th>
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