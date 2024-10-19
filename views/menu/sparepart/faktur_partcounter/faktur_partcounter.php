<div class="breadcrumb">
    <h1>Faktur Part Counter</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row ">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nomor">Nomor Faktur </label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" readonly required />
                                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="mgrup" id="mgrup" value="<?php echo $this->session->userdata('mygrup') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="tanggal" id="tanggal" maxlength="50" value="<?php echo date("d-m-Y"); ?>" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nomororder">Nomor Order </label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="nomororder" id="nomororder" maxlength="50" placeholder="Nomor Order" readonly required />
                                </div>
                                <div class="form-group">
                                    <button data-toggle="modal" data-target="#findorder" id="cariorder" class="btn-search btn-primary btn-block">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nopolisi">No Polisi </label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="nopolisi" id="nopolisi" maxlength="50" placeholder="Nomor Polisi" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nocustomer">Customer</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Nomor Customer" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nohp">No Tlp/HP</label>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="notlp" id="notlp" placeholder="Nomor Telp" maxlength="50" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="nohp" id="nohp" placeholder="Nomor HP" maxlength="50" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="alamat">Alamat</label>
                                <div class="col-sm-8 form-group">
                                    <textarea name="alamat" id="alamat" class="form-control" placeholder="alamat" readonly required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="uangmuka">Uang Muka</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="uangmuka" id="uangmuka" maxlength="50" placeholder="uang muka" style="text-align:right" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode">Kode Sparepart</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="kode" id="kode" maxlength="50" placeholder="Kode" readonly required />
                                </div>

                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" readonly required />
                                </div>

                                <div class="col-sm-2 form-group">
                                    <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="qty">Qty</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="qty" id="qty" placeholder="0" maxlength="250" style="text-align:right" readonly required />
                                </div>

                                <label for="harga">Harga</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="harga" id="harga" maxlength="250" style="text-align:right" readonly required />
                                </div>

                                <div class="col-sm-3 form-group">
                                    <select name="jenisdetail" class="form-control" id="jenisdetail">
                                        <option value="-">- Pilih Jenis -</option>
                                        <option value="1">PO Luar Negeri</option>
                                        <option value="2">Dalam Negeri</option>
                                        <option value="3">Stock</option>
                                        <option value="4">Workshop</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="persen">Persen</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="persen" id="persen" placeholder="0" maxlength="250" style="text-align:right" required />
                                </div>

                                <label for="discount">Discount</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="discount" id="discount" maxlength="250" style="text-align:right" required />
                                </div>

                                <label for="total">Subtotal</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="total" id="total" maxlength="250" style="text-align:right" readonly required />
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped display nowrap" id="detailfaktur">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Persen</th>
                                            <th>Discount</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="detaildatafaktur"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

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

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button id="new" class="btn btn-success"><i class="fa fa-retweet"></i> &nbsp;New</button>
                            <button id="save" class="btn btn-success"><i class="fa fa-save"></i> &nbsp;Save</button>
                            <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                            <button id="find" class="btn btn-success" data-toggle="modal" data-target="#findfaktur"><i class="fa fa-search"></i> &nbsp;Find</button>
                            <button id="cancel" class="btn btn-danger" disabled><i class="fa fa-window-close"></i> &nbsp;Cancel</button>
                            <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;Cetak</button>
                            <button id="excel" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;Export Excel</button>
                            <button id="cetakgd" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;Cetak Gudang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findorder">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Ordering</h5>
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
                                        <th width="150">Nomor Order</th>
                                        <th width="150">Nomor Polisi</th>
                                        <th width="150">Nama Customer</th>
                                        <th width="150">No HP</th>
                                        <th width="150">No Tlp</th>
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
                            <table id="tablesearchparts" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10">Action</th>
                                        <th width="25">kode sparepart</th>
                                        <th width="25">Nama Sparepart</th>
                                        <th width="25">Harga Beli</th>
                                        <th width="25">Harga Jual</th>
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

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findfaktur">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Faktur Part Counter</h5>
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
                                        <th width="150">No Polisi</th>
                                        <th width="150">Nomor Order</th>
                                        <th width="150">Nama Customer</th>
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