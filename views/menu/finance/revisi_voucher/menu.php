<div class="breadcrumb">
    <h1>Revisi Voucher</h1>

</div>
<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body mb-2">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jenis">Filter</label>
                            <div class="col-sm-8 form-group">
                                <select name="jenis" class="form-control" id="jenis">
                                    <option value="-">- Pilih Jenis -</option>
                                    <option value="1">Bukti Terima Uang</option>
                                    <option value="2">Bukti Keluar Uang</option>
                                    <option value="3">Pencairan Kartu Debit</option>
                                    <option value="4">Pencairan Kartu Kredit</option>
                                    <option value="5">Pencairan Market Place</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="tgl">Tanggal</label>
                            <div class="col-md-4">
                                <div class="input-group date" id="tglawal">
                                    <input type="text" class="form-control" id="tglawalp" width="200" readonly>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text btn-primary">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label for="tgl">s/d</label>
                            <div class="col-md-4">
                                <div class="input-group date" id="tglakhir">
                                    <input type="text" class="form-control" id="tglakhirp" width="200" readonly>
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

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <button id="query" class="btn btn-success"><i class="fa fa-pen"></i> &nbsp;Query Data</button>
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="noaccount">Nomor Account</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="noaccount" id="noaccount" maxlength="50" placeholder="Kode Account" readonly required />

                            </div>
                            <div class="col-sm-5">
                                <input class="form-control" type="text" name="namaaccount" id="namaaccount" maxlength="150" placeholder="Nama Account" readonly required />
                            </div>

                            <div class="col-sm-1.5">
                                <button id="carinomoraccount" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findcoa">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4 ">
            <div class="card-body">
                <div class="card-title mb-3 text-left">Data Voucher</div>
                <!-- <div class="modal-body pre-scrollable"> -->
                <div class="form-group row">
                    <div class="table-responsive">
                        <div style="height:655px;">
                            <!-- <div class="form-group" style="height:630px;"> -->
                            <table class="table table-bordered table-striped display nowrap" id="headervoucher">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No Voucher</th>
                                        <th>Tanggal</th>
                                        <th>Verifikasi</th>
                                        <th style="display:none;">Kode Trx</th>
                                        <th>Nama Trx</th>
                                        <th style="display:none;">Keterangan</th>
                                        <th style="display:none;">Kode Dept</th>
                                        <th>Departemen</th>
                                    </tr>
                                </thead>
                                <tbody id="headerdatavoucher"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <!-- overflow:scroll; -->
    <div class="col-lg-6 tampildriver">
        <div class="card mb-8">
            <div class="card-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="nomor">Nomor / Tanggal</label>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="novoucher" id="novoucher" maxlength="50" placeholder="Nomor Voucher" readonly required />
                            </div>
                            <div class="col-lg-5">
                                <div class="input-group date" id="tgltrans">
                                    <input type="text" class="form-control" id="tgltransaksi" width="200" readonly>
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

                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-md-12 col-lg-2 col-form-label" for="kodetrx">Jenis Transaksi</label>
                            <div class="col-md-4 col-lg-2">
                                <input class="form-control" type="text" name="kodetrx" id="kodetrx" maxlength="50" placeholder="Kode Transaksi" readonly required />
                            </div>
                            <div class="col-md-8 col-lg-7">
                                <input class="form-control" type="text" name="namatrx" id="namatrx" maxlength="50" placeholder="Nama Transaksi" required readonly />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="keterangan" id="keterangan" maxlength="50" placeholder="Keterangan" required readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12" id="departemen">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kodedepartemen">Departemen</label>
                            <div class=" col-md-2 form-group">
                                <input class="form-control" type="text" name="kodedepartemen" id="kodedepartemen" maxlength="50" placeholder="Kode Departemen" readonly required />
                            </div>
                            <div class=" col-md-6 form-group">
                                <input class="form-control" type="text" name="namadepartemen" id="namadepartemen" maxlength="150" placeholder="Nama Departemen" readonly required />
                            </div>
                            <div class=" col-md-1.5">
                                <button id="caridepartemen" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#finddepartemen">
                                    <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 separator-breadcrumb border-top my-4"></div>

                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-md-12 col-lg-2 col-form-label" for="noinvoice">Nomor Invoice</label>
                            <div class="col-md-8 col-lg-3">
                                <input class="form-control" type="text" name="noinvoice" id="noinvoice" maxlength="50" placeholder="Nomor Invoice" readonly required />
                            </div>
                            <div class="col-md-4 col-lg-5">
                                <input class="form-control" type="text" name="noref" id="noref" maxlength="150" placeholder="Nama Invoice" readonly required />
                                <input class="form-control" type="hidden" name="norefx" id="norefx" maxlength="150" placeholder="Nama Invoice" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-md-12 col-lg-2 col-form-label" for="cust">Cust/Supp</label>
                            <div class="col-md-8 col-lg-3">
                                <input class="form-control" type="text" name="nomorcust" id="nomorcust" maxlength="50" placeholder="Nomor" readonly required />
                            </div>
                            <div class="col-md-4 col-lg-5">
                                <input class="form-control" type="text" name="namacust" id="namacust" maxlength="150" placeholder="Nama" readonly required />
                            </div>
                            <div class="col-md-1.5">
                                <button type="button" id="carinomoraccountlain" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findcoalain" data-backdrop="static">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-md-12 col-lg-2 col-form-label" for="noaccount">Nomor Account</label>
                            <div class="col-md-6 col-lg-3">
                                <input class="form-control" type="hidden" name="jenisaccount" id="jenisaccount" maxlength="50" placeholder="Nomor Account" readonly required />
                                <input class="form-control" type="text" name="noaccount" id="noaccount" maxlength="50" placeholder="Nomor Account" readonly required />
                            </div>
                            <div class="col-md-4 col-lg-5">
                                <input class="form-control" type="text" name="namaaccount" id="namaaccount" maxlength="150" placeholder="Nama Account" readonly required />
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="carinomoraccount" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findcoa" data-backdrop="static">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="memo">Memo</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="memo" id="memo" maxlength="120" placeholder="Memo" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="subtotal">Total</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="text" name="subtotal" id="subtotal" maxlength="50" value="0" style="text-align:right" readonly required />
                            </div>
                            <div class="col-md-2 form-group">
                                <button id="add-data" class="btn btn-success">
                                    <i class="fa fa-smile-o"></i>
                                    <b> Change</b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="table-responsive">
                        <div style="height:200px;">
                            <table class="table table-bordered table-striped display nowrap" id="detailvoucher">
                                    <tr>
                                        <th></th>
                                        <th>No Voucher</th>
                                        <th>No Invoice</th>
                                        <th style="display:none;">Kode</th>
                                        <th>Nama</th>
                                        <th style="display:none;">No Account</th>
                                        <th>Nama Account</th>
                                        <th style="display:none;">Memo</th>
                                        <th  style="text-align:right" >Nilai Terima</th>
                                        <th style="display:none;">Jenis</th>
                                        <th style="display:none;">norefx</th>
                                    </tr>
                                <tbody id="detaildatavoucher"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-sm-4">
                            </div>
                            <label class="col-sm-4 col-form-label" for="total">Total : </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="total" id="total" maxlength="10" value="0" style="text-align:right" required readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BUTTON BOTTOM -->

<div class="card mb-6">
    <div class="card-body mb-2">
        <div class="form-group">
            <button id="new" class="btn btn-success"><i class="fa fa-pen"></i> &nbsp;NEW</button>
            <button id="save" class="btn btn-success"><i class="fa fa-check"></i> &nbsp;SAVE</button>
            <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
            <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;PRINT</button>
            <button id="find" class="btn  btn-warning" data-toggle="modal" data-target="#video" data-backdrop="static"><i class="fa fa-video-camera"></i>&nbsp; V-HELP</button>
        </div>
    </div>
</div>


<!-- Pop up Account  -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcoa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchcoa" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="25">Kode</th>
                                <th width="150">Nama</th>
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcoalain">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchcoalain" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="25">Kode</th>
                                <th width="150">Nama</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="finddepartemen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Departemen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchdepartemen" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="25">Kode</th>
                                <th width="150">Nama</th>
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

 <!-- VIDEO -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="video">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-weight: bold;" class="modal-title">VIDEO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearch" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                    <iframe width="765" height="400" src="https://www.youtube.com/embed/ydzIdO_L7rg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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