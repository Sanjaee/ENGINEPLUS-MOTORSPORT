<div class="breadcrumb">
    <h1>Input Faktur Pajak</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
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

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="tanggalfp">Tanggal</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="tanggalfp" id="tanggalfp" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nomorfp">No Faktur Pajak</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nomorfp" id="nomorfp" placeholder="Auto Generate" maxlength="150" required disabled readonly/>
                            </div>
							<div class="col-sm-2 form-group">
                                <!-- <button data-toggle="modal" data-target="#findnomorfp" id="carinomorfp" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="noinvoice">No Invoice</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="noinvoice" id="noinvoice" placeholder="Nomor Invoice" maxlength="150" readonly required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target="#findinvoice" id="cariinvoice" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="tglppn">Tanggal PPn</label>
                            <div class="col-sm-6">
                                <div class="input-group date" id="tglppn">
                                    <input type="text" class="form-control" id="tglppnx" width="200" readonly>
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
                            <label class="col-sm-2 col-form-label" for="nocustomer">No Customer</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Nomor Customer" maxlength="150" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="150" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nopolisi">No Polisi</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nopolisi" maxlength="150" readonly required />
                            </div>
                            <!-- <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="norangka" id="norangka" placeholder="Norangka" maxlength="150" readonly required />
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat Customer" maxlength="150" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="npwp">NPWP</label>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" type="text" name="npwp" id="npwp" placeholder="npwp" maxlength="150" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="dpp">DPP/PPn</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="dpp" id="dpp" placeholder="DPP" maxlength="150" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="ppn" id="ppn" placeholder="PPN" maxlength="150" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="grandtotal">Grand Total</label>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="grandtotal" id="grandtotal" placeholder="grandtotal" maxlength="150" readonly required />
                            </div>

                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="detail">
                            <tr>
                                <th style="display:none;"></th>
                                <th>NoInvoice</th>
                                <th>TglPPN</th>
                                <th>NoCustomer</th>
                                <th>NamaCustomer</th>
                                <th>NPWP</th>
                                <th width="100px"></th>
                            </tr>
                            <tbody id="detaildata"></tbody>
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
                            <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                            <button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;SAVE</button>
                            <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                            <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findreq"><i class="fa fa-search"></i>&nbsp;FIND</button>
                            <button id="cancel" class="btn  btn-danger"><i class="fa fa-window-close"></i>&nbsp; CANCEL</button>
                            <button id="cetak" class="btn btn-success" style="visibility: hidden;"><i class="fa fa-print"></i>&nbsp;</button>
                            <button id="find" class="btn  btn-warning" data-toggle="modal" data-target="#video" data-backdrop="static"><i class="fa fa-video-camera"></i>&nbsp; V-HELP</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<!-- Find Data Nomor Faktur Pajak -->
		<!-- <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findnomorfp">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Nomor Faktur Pajak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchnomorfp" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="150">Nomor Faktur Pajak</th>
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
        </div> -->

        <!-- Find Data -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findinvoice">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchinvoice" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="150">Nomor Invoice</th>
                                        <th width="150">No Polisi</th>
                                        <th width="150">No SO</th>
                                        <th width="150">Nama Customer</th>
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
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findreq">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Faktur Pajak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearch" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10">Action</th>
                                        <th width="100">Nomor</th>
                                        <th width="150">Nomor Invoice</th>
                                        <th width="150">Nomor FP</th>
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
                            <table id="tablesearch" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <iframe width="765" height="400" src="https://www.youtube.com/embed/6UdhhGm6rbM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
</div>
