<div class="breadcrumb">
    <h1>Order Part Counter</h1>
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
                            <label class="col-sm-2 col-form-label" for="tanggalorder">Tgl Order</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="tanggalorder" id="tanggalorder" maxlength="50" value="<?php echo date("d-m-Y"); ?>" readonly required />
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="ref">Ref Order</label>
                            <br>
                            <div class="col-sm-6 form-group">
                                <label class="radio radio-success">
                                    <input type="radio" name="ref" id="ref" value="true"><span> YA</span><span class="checkmark"></span>
                                </label>
                                &emsp;&emsp;&emsp;
                                <label class="radio radio-danger">
                                    <input type="radio" name="ref" id="nonref" value="false"><span> TIDAK</span><span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="order">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nomororder">No Order
                                <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="nomororder" id="nomororder" maxlength="50" readonly srequired />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button id="cariorder" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findorderpart">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="customer">Customer</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nocustomer" id="nocustomer" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findcust" id="caricustomer" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nopolisi">No Polisi</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nomor Polisi" maxlength="50" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-8 form-group">
                                <textarea name="alamat" id="alamat" class="form-control" maxlength="250" placeholder="Alamat" readonly ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nohp">No Tlp/HP</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="notlp" id="notlp" placeholder="Nomor Telp" maxlength="50" required />
                            </div>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="nohp" id="nohp" placeholder="Nomor HP" maxlength="50" required />
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
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findpart" id="carisparepart" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="tipejual">Tipe Penjualan</label>
                            <div class="col-sm-4 form-group">
                                <select name="tipejual" class="form-control" id="tipejual">
                                    <option value="-">- Pilih Tipe -</option>
                                    <option value="1">MP Tokopedia</option>
                                    <option value="2">MP Bukalapak</option>
                                    <option value="3">Workshop E+</option>
                                    <option value="4">B2B</option>
                                    <option value="5">B2C</option>
                                    <option value="6">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="qty">Qty</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" placeholder="Qty" maxlength="250" style="text-align:right" required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="satuan">Satuan</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="satuan" id="satuan" placeholder="satuan" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="hargasatuan">Harga</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="hargasatuan" id="hargasatuan" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="total">Total</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="total" id="total" placeholder="Total" maxlength="250" style="text-align:right" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="persen">Disc %</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="persen" id="persen" placeholder="Discount %" maxlength="250" style="text-align:right" required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="discount">Disc Rp</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="discount" id="discount" placeholder="Discount Rp" maxlength="250" style="text-align:right" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jenisdetail">Jenis Detail</label>
                            <div class="col-sm-4 form-group">
                                <select name="jenisdetail" class="form-control" id="jenisdetail">
                                    <option value="-">- Pilih Jenis -</option>
                                    <option value="1">PO Luar Negeri</option>
                                    <option value="2">Vendor</option>
                                    <option value="3">Stock</option>
                                    <option value="4">Workshop</option>
                                </select>
                            </div>


                            <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="keterangan" id="keterangan" placeholder="keterangan" maxlength="50" required />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <button id="add-row" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
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
                                        <th>Jenis</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Persen</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Keterangan</th>
                                        <th width="30" style="text-align: center;">Action</th>
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
                            <label class="col-sm-3 col-form-label" for="ongkir">Ongkir</label>
                            <div class="col-sm-7 form-group">
                                <input class="form-control" type="text" name="ongkir" id="ongkir" maxlength="50" value="0" style="text-align:right" required />
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
                    <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findorder"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                    <button id="refbatal" class="btn  btn-warning" data-toggle="modal" data-target="#refbatalx"><i class="fa fa-check"></i>&nbsp;REF BATAL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                </div>
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
                    <table id="tablesearchcustomer" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
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
                <h5 class="modal-title">Data Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchsparepart" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="100">Kode Sparepart</th>
                                <th width="150">Nama Sparepart</th>
                                <th width="25">Harga jual</th>
                                <th width="25">Harga Beli</th>
                                <th width="25">Qty Stock</th>
                                <th width="25">Lokasi</th>
                                <th width="25">Keterangan</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findorder">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Ordering Part Counter</h5>
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
                                <th width="100">No Polisi</th>
                                <th width="100">Customer</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findorderpart">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Ordering Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchop" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">No Order</th>
                                <th width="25">Nama Supplier</th>
                                <th width="150">Kode Cabang</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="refbatalx">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Referensi Batal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchbatal" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="100">No Polisi</th>
                                <th width="100">Customer</th>
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