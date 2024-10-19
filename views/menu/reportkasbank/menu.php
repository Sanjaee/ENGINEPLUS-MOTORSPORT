<div class="breadcrumb">
    <h1><?php echo $title ?></h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <input class="form-control" type="hidden" name="mgrup" id="mgrup" value="<?php echo $this->session->userdata('mygrup') ?>" readonly required />
                            <input class="form-control" type="hidden" name="groupcabang" id="groupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />
                            <label class="col-sm-2 col-form-label" for="nomor">Tanggal Awal</label>
                            <div class="col-md-4">
                                <div class="input-group date" id="tanggalawal">
                                    <input type="text" class="form-control" id="tglawal" width="200" readonly>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text btn-primary">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-2 col-form-label" for="tanggalakhir">Tanggal akhir</label>
                            <div class="col-md-4">
                                <div class="input-group date" id="tanggalakhir">
                                    <input type="text" class="form-control" id="tglakhir" width="200" readonly>
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
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="menu">Account</label>
                            <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            <input class="form-control" type="hidden" name="kodecabang" id="kodecabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" placeholder="Nomor" readonly required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" readonly required />
                            </div>
                            <div class="col-md-2">
                                <button id="cariaccount" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findmodalaccount" data-backdrop="static">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="menu">&nbsp;</label>
                            <div class="col-sm-3 form-group">
                                <button id="submit" class="btn-search btn-primary btn-block"><i class="fa fa-search"></i> &nbsp;Submit</button>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="excel" class="btn-search btn-primary btn-block"><i class="fa fa-search"></i> &nbsp;Export</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped display nowrap" id="detail">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <!-- <th>No. COA</th> -->
                                    <th>No. Voucher</th>
                                    <th>No. Permohonan</th>
                                    <th>Keterangan</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody id="detaildata"></tbody>
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
                    <button id="new" class="btn  btn-success"><i class="fa fa-refresh"></i>&nbsp; NEW</button>
                    &nbsp;
                    <button id="cetak" class="btn  btn-success"><i class="fa fa-print"></i>&nbsp; CETAK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findmodalaccount">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DATA ACCOUNT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchaccount" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="50">Nomor</th>
                                <th width="250">Nama</th>
                                <th width="100">Rekening</th>
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