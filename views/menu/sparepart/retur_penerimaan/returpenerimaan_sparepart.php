<div class="breadcrumb">
    <h1>Retur Penerimaan Sparepart</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="noretur">No Retur</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="noretur" id="noretur" maxlength="50" readonly required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tglretur">Tanggal Retur</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="tglretur" id="tglretur" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nomorpenerimaan">No Penerimaan</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="nomorpenerimaan" id="nomorpenerimaan" maxlength="50" value="<?php echo ("PP" . substr(date("Y"), 2, 2) . date("m") . "00000"); ?>" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findpenerimaan" id="caripenerimaan" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tanggalpenerimaan">Tanggal Penerimaan</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="tanggalpenerimaan" id="tanggalpenerimaan" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nomorinvoice">No invoice</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nomorinvoice" id="nomorinvoice" maxlength="50" placeholder="Nomor Invoice" readonly required />

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tglinvoice">Tanggal Invoice</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="tglinvoice" id="tglinvoice" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nofakpajak">Faktur Pajak</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nofakpajak" id="nofakpajak" maxlength="50" placeholder="Nomor Faktur Pajak" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tglppn">Tanggal PPn</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="tglppn" id="tglppn" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="supplier">Supplier</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodesupplier" id="kodesupplier" placeholder="Kode Supplier" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namasupplier" id="namasupplier" placeholder="Nama Supplier" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kodesparepart">Kode</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodesparepart" id="kodesparepart" placeholder="Kode Part" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namasparepart" id="namasparepart" placeholder="Nama Part" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-8 form-group">
                                <textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" maxlength="150" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="hargasatuan">Harga</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargasatuan" id="hargasatuan" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                            </div>

                            <label for="qty">Qty Retur</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" maxlength="250" style="text-align:right" required />
                                <input class="form-control" type="hidden" name="qtyretur" id="qtyretur" maxlength="250" style="text-align:right" readonly required />
                            </div>

                            <label for="qtyterima">Qty Terima</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qtyterima" id="qtyterima" maxlength="250" style="text-align:right" readonly required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="persen">Persen Disc</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="persen" id="persen" maxlength="250" style="text-align:right" readonly required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="discount">Discount</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="discount" id="discount" maxlength="250" style="text-align:right" readonly required />
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="total">Total</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="total" id="total" maxlength="250" style="text-align:right" readonly required />
                            </div>

                            <label for="biayapinalti">Biaya Penalti</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="biayapinalti" id="biayapinalti" maxlength="250" style="text-align:right" required />
                            </div>

                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="detailsparepart">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>QtyTerima</th>
                                        <th>QtyRetur</th>
                                        <th>Qty</th>
                                        <th>Persendisc</th>
                                        <th>Disc</th>
                                        <th>Total</th>
                                        <th>BiayaPenalti</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    <tbody id="detaildatasparepart"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="row">
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
                    <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findretur"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <!-- <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button> -->
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpenerimaan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Penerimaan Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchpenerimaan" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="100">Tanggal</th>
                                <th width="100">Supplier</th>
                                <th width="100">No Invoice</th>
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