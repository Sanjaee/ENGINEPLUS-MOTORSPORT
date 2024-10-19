<div class="breadcrumb">
    <h1>Register Nomor Faktur Pajak</h1>
</div>

<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <label class="col-form-label" style="font-size: 25px;">Register</label>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="Group">Mulai Nomor</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nomulai" id="nomulai" placeholder="###-##.########" maxlength="13" required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                                <input class="form-control" type="hidden" name="groupcabang" id="groupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />
                            </div>
                            s/d
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="noakhir" id="noakhir" placeholder="###-##.########" maxlength="13" required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;Register</button>
                                <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
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
                <div class="row">
                    <div class="col-md-8">
                        <label class="col-form-label" style="font-size: 25px;">Check Data</label>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="Group">Nomor FP</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nomorfp" id="nomorfp" placeholder="###-##.########" maxlength="15" readonly required />
                            </div>

                            <!-- <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="noakhir" id="noakhir" placeholder="###-##.########" maxlength="15" required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;Register</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="Group">No Invoice</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="noinvoice" id="noinvoice" placeholder="nomor invoice" maxlength="15" readonly required />
                            </div>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="statusfp" id="statusfp" placeholder="Status FP" readonly required />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="Group">Nama Customer</label>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" readonly required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="remove" class="btn btn-danger"><i class="fa fa-window-close"></i>&nbsp;Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top:20px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Data Faktur Pajak</h5>
                            </div>
                            <div class="modal-body pre-scrollable">
                                <div class="table-responsive">
                                    <!-- <div class="pre-scrollable"> -->
                                    <table id="tablesearch" class="table table-bordered table-striped table-striped" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr style="line-height: 0.5 cm; ">

                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Action</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Nomor Faktur Pajak</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Tanggal Faktur Pajak</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Status Faktur Pajak</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Nomor Invoice</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Nama Customer</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>

                                    </table>
                                    <!-- </div> -->
                                </div>
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
                    <button id="new" class="btn  btn-success"><i class="fa fa-refresh"></i>&nbsp; NEW</button>
                    <!-- <button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;SAVE</button>
                    <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp;UPDATE</button> -->
                    <button id="cetak" class="btn btn-success" style="visibility: hidden;"><i class="fa fa-print"></i>&nbsp;</button>
                    <button id="find" class="btn  btn-warning" data-toggle="modal" data-target="#video" data-backdrop="static"><i class="fa fa-video-camera"></i>&nbsp; V-HELP</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Find Data -->
<div id="tablesearchtampil" class="popup1">
    <center>
        <!-- <div class="pre-scrollable"> -->
        <div class="popupsearch">
            <div class="pre-scrollable">
                <h3 align="center">DATA GROUP</h3>
                <div class="table-responsive">
                    <table id="tablesearchgrup" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="150">Kode</th>
                                <th width="150">Nama</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="button">
                        <button id="closesearchgrup" class="btn btn-dark1">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </center>
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
                    <table id="tablesearch" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <iframe width="765" height="400" src="https://www.youtube.com/embed/4dZBH3QnI-M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
