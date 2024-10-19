<div class="breadcrumb">
    <h1>Entry Jasa Detail</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="no_wo">Nomor WO</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="no_wo" id="no_wo" placeholder="Nomor WO" maxlength="250" readonly required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="carinowo" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findwo" data-backdrop="static">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nopolisi">No. Polisi</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="No. Polisi" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="data_customer">Customer</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nomor_customer" id="nomor_customer" placeholder="Nomor Customer" maxlength="250" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="nama_customer" id="nama_customer" placeholder="Nama Customer" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="data_tipe">Tipe</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode_tipe" id="kode_tipe" placeholder="Kode Tipe" maxlength="250" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe" maxlength="250" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jasa">Head Jasa</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode_jasa" id="kode_jasa" placeholder="Kode Head Jasa" maxlength="250" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="nama_jasa" id="nama_jasa" placeholder="Nama Head Jasa" maxlength="250" readonly required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="carijasa" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findjasa" data-backdrop="static">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jasa">Jasa Detail</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode_jasadetail" id="kode_jasadetail" placeholder="Kode Detail Jasa" maxlength="250" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="nama_jasadetail" id="nama_jasadetail" placeholder="Nama Detail Jasa" maxlength="250" readonly required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="carijasadetail" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findjasadetail" data-backdrop="static">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="button">&nbsp;</label>
                            <div class="col-sm-8 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                &nbsp;
                                <!-- <button id="remove_detail" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp;Remove</button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped display nowrap" id="detailjasa">
                            <tr>
                                <th style="text-align: center;">Head Jasa</th>
                                <th style="text-align: center;">Kode Detail Jasa</th>
                                <th style="text-align: center;">Nama Detail Jasa</th>
                                <th style="width: 10px; text-align: center;">&nbsp;</th>
                            </tr>
                            <tbody id="detaildatajasa"></tbody>
                        </table>
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
                            <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                            <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                            <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                            <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findentryjasadetail"><i class="fa fa-search"></i>&nbsp;FIND</button>
                            <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                            <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data WO -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findwo">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Work Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchwo" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="150">Nomor WO</th>
                                        <th width="150">No. Polisi</th>
                                        <th width="150">Nomor Rangka</th>
                                        <th width="150">Nama Customer</th>
                                        <th width="150">Tipe</th>
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

        <!-- Data Jasa -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findjasa">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Jasa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchjasa" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="25">Kode Jasa</th>
                                        <th width="150">Nama Jasa</th>
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

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findjasadetail">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Jasa Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchjasadetail" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="25">Kode Jasa</th>
                                        <th width="150">Nama Jasa</th>
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

        <!-- Data Registrasi Kontrak Service -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findentryjasadetail">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Entry Jasa Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchentryjasadetail" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="150">Nomor WO</th>
                                        <th width="150">No. Polisi</th>
                                        <th width="150">Nomor Customer</th>
                                        <th width="150">Nama Customer</th>
                                        <th width="150">Kode Tipe</th>
                                        <th width="150">Nama Tipe</th>
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