<div class="breadcrumb">
    <h1>Penghapusan Piutang</h1>

</div>
<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nomor">Nomor</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" value="" readonly required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tgl">Tanggal</label>
                            <div class="col-md-8">
                                <div class="input-group date" id="tanggal">
                                    <input type="text" class="form-control" id="tglpenghapusan" width="200" readonly>
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
                            <label class="col-sm-3 col-form-label" for="jenis">Jenis Piutang</label>
                            <div class="col-sm-8 form-group">
                                <select name="jenis" class="form-control" id="jenis">
                                    <option value="0">- Pilih Jenis -</option>
                                    <option value="51">Faktur General Repair</option>
                                    <option value="52">Faktur Part Counter</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nomorfaktur">Nomor Faktur</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" name="nomorfaktur" id="nomorfaktur" maxlength="50" placeholder="Nomor Faktur" readonly required />
                                <input class="form-control" type="hidden" name="nomorcustomer" id="nomorcustomer" readonly required />
                                <input class="form-control" type="hidden" name="tgltransaksi" id="tgltransaksi" readonly required />
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="namacustomer" id="namacustomer" maxlength="150" placeholder="Nama Customer" readonly required />
                            </div>

                            <div class="col-sm-1.5">
                                <button id="carinomorfaktur" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findfaktur">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nilaipiutang">Nilai Piutang</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="nilaipiutang" id="nilaipiutang" maxlength="50" placeholder="Nilai Piutang" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nilaipenghapusan">Nilai Penghapusan</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="nilaipenghapusan" id="nilaipenghapusan" maxlength="50" placeholder="Nilai Penghapusan" required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="nilaipenerimaan">Nilai Penerimaan</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="nilaipenerimaan" id="nilaipenerimaan" maxlength="50" placeholder="Nilai Penerimaan" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" type="text" name="keterangan" id="keterangan" maxlength="100" placeholder="Keterangan" required ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="keterangan"></label>
                            <div class="col-sm-4">
                                <button id="add-row" class="btn btn-success btn-block">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group table-responsive-md">
                        <table class="table table-bordered table-striped display nowrap" id="tablelistdata">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Nomor Invoice</th>
                                    <th>Nama Customer</th>
                                    <th>Nilai Piutang</th>
                                    <th>Nilai Penghapusan</th>
                                    <th style="display:none;">nomorcustomer</th>
                                    <th style="display:none;">tgltransaksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="detailtable"></tbody>
                        </table>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="total">Total Penghapusan</label>
                        <div class="col-sm-8 form-group">
                            <input class="form-control" type="text" name="total" id="total" style="text-align:right;" maxlength="250" readonly required />
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>

    <!-- BUTTON BOTTOM -->
    <div class="col-md-12">
        <div class="card mb-4">


            <div class="card-body mb-2">
                <div class="form-group">
                    <button id="new" class="btn btn-success"><i class="fa fa-pen"></i> &nbsp;NEW</button>
                    <button id="save" class="btn btn-success"><i class="fa fa-check"></i> &nbsp;SAVE</button>
                    <button id="find" class="btn btn-success" data-toggle="modal" data-target="#findmodal">
                        <i class="fa fa-search"></i> &nbsp;FIND</button>
                    <button id="cancel" class="btn btn-danger" disabled><i class="fa fa-times"></i> &nbsp;CANCEL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;PRINT</button>
                    <button id="approve" class="btn btn-warning"><i class="fa fa-times"></i> &nbsp;APPROVE</button>
                </div>
            </div>
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

<!-- pop up faktur -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findfaktur">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Piutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchfaktur" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="25">Nomor</th>
                                <th width="150">Nama</th>
                                <th width="150">Nilai Piutang</th>
                                <th width="150">Nilai Penerimaan</th>
                                <th width="150">Nilai Sisa</th>
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

<!-- Pop up FIND  -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findmodal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pencarian Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearch" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="10">Nomor</th>
                                <th width="10">Tanggal</th>
                                <th width="100">Keterangan</th>
                                <th width="20">Kode Cabang</th>
                                <th width="20">Status</th>
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