<div class="breadcrumb">
    <h1>Ordering Sparepart</h1>
</div>
<?php
$statusorder = $this->db->query('select * from glbm_statusorder where aktif = true')->result();
?>
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
                                <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" value="<?php echo ("PO" . substr(date("Y"), 2, 2) . date("m") . "00000"); ?>" readonly required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tanggalorder">Tanggal</label>
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
                            <label class="col-sm-2 col-form-label" for="jenis">Jenis Order</label>
                            <br>
                            <div class="col-sm-6 form-group">
                                <label class="radio radio-success">
                                    <input type="radio" name="jenis" id="jenis" value="true"><span> Internal</span><span class="checkmark"></span>
                                </label>
                                &emsp;&emsp;&emsp;
                                <label class="radio radio-danger">
                                    <input type="radio" name="jenis" id="nonjenis" value="false"><span> External</span><span class="checkmark"></span>
                                </label>
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
                                <input class="form-control" type="hidden" name="pkpsupplier" id="pkpsupplier" placeholder="Nama Supplier" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findsupplier" id="carisupplier" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                    <button data-toggle="modal" data-target="#findcabang" id="caricabang" class="btn-search btn-primary btn-block">
                                        <i class="fa fa-search"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-8 form-group">
                                <textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="keterangan" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-8 form-group">
                                <textarea class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat" readonly required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="estorder">Estimasi Order</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nomorestimasi" id="nomorestimasi" placeholder="Nomor Estimasi" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findestimasi" id="cariestimasi" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
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
                            <label class="col-sm-2 col-form-label" for="tanggalreal">Tgl Order</label>
                            <div class="col-sm-8">
                                <div class="input-group date" id="tanggalreal">
                                    <input type="text" class="form-control" id="tglrealorder" width="200" readonly>
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
                            <label class="col-sm-2 col-form-label" for="qty">Qty</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" placeholder="Qty" maxlength="250" style="text-align:right" required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="Satuan">Satuan</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="satuan" id="satuan" placeholder="satuan" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="statusorder">Status Order
                                <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                            <div class="col-sm-8 form-group">
                                <select name="statusorder" class="form-control" id="statusorder">
                                    <option value="-">- Status Order -</option>
                                    <?php foreach ($statusorder as $pm) : ?>
                                        <option value="<?= $pm->nama ?>"><?= $pm->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
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
                            <label class="col-sm-2 col-form-label" for="total">Total</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="total" id="total" placeholder="Total" maxlength="250" style="text-align:right" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button id="add-row" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="tglestimasidtng">Estimasi Kedatangan</label>
                            <div class="col-sm-8">
                                <div class="input-group date" id="tglestimasidtng">
                                    <input type="text" class="form-control" id="tanggalestimasidtng" width="200" readonly>
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

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped display nowrap" id="detailsparepart">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
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
                    <!-- <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button> -->
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                    <button id="reforder" class="btn btn-danger" data-toggle="modal" data-target="#cariref"><i class="fa fa-cart-arrow-down"></i> &nbsp;REFERENSI ORDER</button>
                    <button id="minimstock" class="btn btn-danger" data-toggle="modal" data-target="#cariminstock"><i class="fa fa-cart-arrow-down"></i> &nbsp;MIN STOCK</button>
                    <button id="update" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;UPDATE</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Find Data -->
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
                                <th width="25">Keterangan</th>
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
                <h5 class="modal-title">Data Ordering Parts</h5>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcabang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchcabang" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Action</th>
                                <th width="25">Kode Cabang</th>
                                <th width="25">Nama Cabang</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="cariref">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Referensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchref" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="10">Nomor</th>
                                <th width="25">Tanggal Order</th>
                                <th width="25">Supplier</th>
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findestimasi">
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
                    <table id="tablesearchest" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="10">Nomor</th>
                                <th width="25">Tanggal Estimasi</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="cariminstock">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Minimum Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchmin" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Kode Part</th>
                                <th width="25">Nama</th>
                                <th width="25">Qty Akhir</th>
                                <th width="25">Min Stock</th>
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