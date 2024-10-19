<div class="breadcrumb">
    <h1>Estimasi Order Sparepart</h1>
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
                            <label for="tanggalorder">Tanggal Order</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="tanggalorder" id="tanggalorder" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <hr> -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kurs">Kurs</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="kurs" id="kurs" style="text-align:right" maxlength="10"  required />
                           </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tanggalorder">Biaya Berat/Kg</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" name="biayaberat" id="biayaberat" style="text-align:right" maxlength="50"  required />
                            </div>
                            
                            <label class="col-sm-2 col-form-label" for="Satuan">Total Bea Masuk</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="totalbea" id="totalbea" style="text-align:right" placeholder="satuan" maxlength="250" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="shipping">Shipping $</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="shipping" id="shipping" maxlength="10"  required />
                           </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tanggalorder">Total Shipping</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="totalshipping" id="totalshipping" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kodesparepart">Kode</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodesparepart" id="kodesparepart" placeholder="Kode Part"  required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namasparepart" id="namasparepart" placeholder="Nama Part"  required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findpart" id="carisparepart" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="qty">Qty</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" placeholder="Qty" maxlength="250" style="text-align:right" required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="Satuan">Harga USD</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargausd" id="hargausd" placeholder="harga usd" maxlength="250" required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="qty">Harga Satuan</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargasatuan" id="hargasatuan" placeholder="Harga Satuan RP" maxlength="250" style="text-align:right" Readonly required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="Satuan">Harga Total</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargatotal" id="hargatotal" placeholder="Harga Total RP" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="hargasatuan">Hargabeli</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargabeli" id="hargabeli" placeholder="Harga Beli Master" maxlength="250" style="text-align:right" readonly required />
                            </div>
                            <label class="col-sm-2 col-form-label" for="total">Hargajual</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargajual" id="hargajual" placeholder="Harga Jual Master" maxlength="250" style="text-align:right" readonly required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="qty">Berat Satuan</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="beratsatuan" id="beratsatuan" placeholder="Berat Satuan RP" maxlength="250" style="text-align:right" required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="Satuan">Biaya Berat Satuan</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="biayaberatsatuan" id="biayaberatsatuan" placeholder="Biaya Berat Sataun Bea" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="hargasatuan">Ship/Satuan</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="shipsatuan" id="shipsatuan" placeholder="Shipping satuan" maxlength="250" style="text-align:right" readonly required />
                            </div>
                            <label class="col-sm-2 col-form-label" for="total">Harga Modal / Satuan</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargamodal" id="hargamodal" placeholder="Harga Modal satuan" maxlength="250" style="text-align:right" readonly required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="qty">Margin Jual</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="margin" id="margin" placeholder="Margin" maxlength="250" style="text-align:right" required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="Satuan">Harga Normal</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="harganormal" id="harganormal" placeholder="Harga Normal" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="Spare">Spare Margin</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="sparemargin" id="sparemargin" placeholder="Spare Margin" maxlength="250" style="text-align:right" required />
                            </div>
                            <label class="col-sm-2 col-form-label" for="total">Harga Jual Est</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargajualest" id="hargajualest" placeholder="Harga Jual Estimasi" maxlength="250" style="text-align:right" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button id="add-row" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped display nowrap" id="detailsparepart">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Qty</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Harga USD</th>
                                        <th>Harga Satuan</th>
                                        <th>Harga Total</th>
                                        <th>Berat Satuan</th>
                                        <th>Biaya Berat Satuan</th>
                                        <th>Ship Satuan</th>
                                        <th>Harga Modal</th>
                                        <th>Margin Jual</th>
                                        <th>Harga Normal</th>
                                        <th>Spare Margin</th>
                                        <th>Harga Jual Est</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody id="detaildatasparepart"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <br>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="dpp">DPP</label>
                            &emsp;&emsp;&emsp;&emsp;&emsp;
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="dpp" id="dpp" maxlength="50" value="0" style="text-align:right" readonly required />
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
                    <!-- <button id="approve" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; APPROVE</button> -->
                    <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                    <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                    <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findorder"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                </div>
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
                    <table id="tablesearchsparepart" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Action</th>
                                <th width="150">Kode Sparepart</th>
                                <th width="150">Nama Sparepart</th>
                                <th width="25">Qty Stock</th>
                                <th width="25">Kode Cabang</th>
                                <th width="25">Lokasi</th>
                                <th width="50">Keterangan</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findorder">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Estimasi Order</h5>
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
                                <th width="100">Tanggal Estimasi Order</th>
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
