<div class="breadcrumb">
    <h1>Closing Accounting</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<!-- <div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <button id="news" class="btn  btn-success"><i class="fa fa-refresh"></i>&nbsp; NEW</button>
                    <button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;SAVE</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="jenis">Jenis</label>
                            &emsp;
                            <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                            <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                            <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            <input class="form-control" type="hidden" name="grupcabang" id="grupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />
                            <label class="radio radio-success">
                                <input type="radio" name="jenis" id="part" value="1"><span> HPP Parts</span><span class="checkmark"></span>
                            </label>
                            &emsp;&emsp;&emsp;
                            <label class="radio radio-danger">
                                <input type="radio" name="jenis" id="kasir" value="2"><span> Kasir & Accounting</span><span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tglclosing">Periode Closing</label>
                            <div class="col-sm-6">
                                <div class="input-group date" id="tanggal">
                                    <input type="text" class="form-control" id="tglclosing" width="200" readonly>
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

                <div class="col-md-12" style="margin-top:20px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Closing Accounting</h5>
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
                                                <span style="font-weight: bold">Periode</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Jenis</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">KodeCabang</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Company</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Status</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
                    <button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp; CLOSING</button>
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                    <button id="update" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; UNCLOSE</button>
                    <button id="cetak" class="btn btn-success" style="visibility: hidden;"><i class="fa fa-print"></i>&nbsp;</button>
                  
                </div>
            </div>
        </div>
    </div>
</div>
