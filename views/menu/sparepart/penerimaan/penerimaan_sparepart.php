<div class="breadcrumb">
    <h1>Penerimaan Sparepart</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nomorinvoice">Nomor invoice</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nomorinvoice" id="nomorinvoice" maxlength="50" placeholder="Nomor Invoice" required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tanggalinvoice">Tanggal Invoice</label>
                            <div class="col-sm-6">
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
                                <button id="Invoice" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; INVOICE</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nofakpajak">Faktur Pajak</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nofakpajak" id="nofakpajak" maxlength="50" placeholder="Nomor Faktur Pajak" required />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tglppn">Tanggal PPN</label>
                            <div class="col-sm-8">
                                <div class="input-group date" id="tglppn">
                                    <input type="text" class="form-control" id="tanggalppn" width="200" readonly>
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nomorpenerimaan">No Penerimaan</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="nomorpenerimaan" id="nomorpenerimaan" maxlength="50" value="<?php echo ("PP" . substr(date("Y"), 2, 2) . date("m") . "00000"); ?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tanggalpenerimaan">Tgl Penerimaan</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="tanggalpenerimaan" id="tanggalpenerimaan" maxlength="50" value="<?php echo date("d-m-Y"); ?>" readonly required />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nomororder">Nomor Order</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nomororder" id="nomororder" maxlength="50" readonly required />
                            </div>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="tanggalorder" id="tanggalorder" maxlength="50" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findorder" id="cariorder" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nilaiuangmuka">Nilai Uang Muka</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nilaiuangmuka" id="nilaiuangmuka" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="supplier">Supplier</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodesupplier" id="kodesupplier" placeholder="Kode Supplier" readonly required />
                                <input class="form-control" type="hidden" name="top" id="top" placeholder="top" readonly required />    
                                <input class="form-control" type="hidden" name="pkpsupplier" id="pkpsupplier" placeholder="Nama Supplier" readonly required />
                            
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namasupplier" id="namasupplier" placeholder="Nama Supplier" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
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
                            <label class="col-sm-3 col-form-label" for="kodesparepart">Kode</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodesparepart" id="kodesparepart" placeholder="Kode Part" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namasparepart" id="namasparepart" placeholder="Nama Part" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="hargasatuan">Harga</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="hargasatuan" id="hargasatuan" placeholder="Harga" maxlength="250" style="text-align:right" required />
                            </div>

                            <label for="qty">Qty</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" maxlength="250" style="text-align:right" required />
                            </div>

                            <label for="qtyterima">Qty Terima</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qtyterima" id="qtyterima" maxlength="250" style="text-align:right" required />
                                <input class="form-control" type="hidden" name="qtygr" id="qtygr" maxlength="250" style="text-align:right" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row">
                            <label class="" for="persen">&nbsp;&nbsp;&nbsp;&nbsp;Persen Disc</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="persen" id="persen" maxlength="250" style="text-align:right" required />
                            </div>

                            <label for="discount">Discount</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="discount" id="discount" maxlength="250" style="text-align:right" required />
                            </div>

                            <label for="total">Total</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="total" id="total" maxlength="250" style="text-align:right" readonly required />
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
                                <table class="table table-bordered table-striped display nowrap" id="detailsparepart">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>QtyOrder</th>
                                        <th>QtyGR</th>
                                        <th>QtyTerima</th>
                                        <th>Persendisc</th>
                                        <th>Disc</th>
                                        <th>Total</th>
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
                    <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findpenerimaan"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <!-- <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button> -->
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                    <button id="closebo" class="btn  btn-danger"><i class="fa fa-eraser"></i>&nbsp; CLOSE BACKORDER</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findorder">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Order Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchorder" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="25">Tanggal</th>
                                <th width="150">Supplier</th>
                                <th width="150">Total</th>
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
                    <table id="tablesearch" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="100">TanggalOrder</th>
                                <th width="100">Supplier</th>
                                <th width="100">Invoice</th>
                                <th width="100">No Invoice</th>
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