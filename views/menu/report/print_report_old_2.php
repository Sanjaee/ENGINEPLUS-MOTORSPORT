<div class="breadcrumb mt-5">
    <h1>PRINT REPORT</h1>
</div>

<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                    <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                    <input class="form-control" type="hidden" name="kodegrupcabang" id="kodegrupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />

                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <input type="hidden" class="form-control" id="gruplogin" value="<?php echo $this->session->userdata('mygrup') ?>" width="200" readonly>
                                <input type="hidden" class="form-control" id="viewname" readonly>
                                <input type="hidden" class="form-control" id="reportname" readonly>
                                <input type="hidden" class="form-control" id="reportlocation" readonly>
                                <input type="hidden" class="form-control" id="filereport" readonly>
                                <input type="hidden" class="form-control" id="loadview" readonly>
                                <input type="hidden" class="form-control" id="loadviewexcel" readonly>
                                <label class="col-sm-3 col-form-label" for="jenis_report">Nama Report</label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="jenis_report" id="jenis_report" placeholder="Nama Report" maxlength="250" readonly required />
                                </div>
                                <div class="col-md-2">
                                    <button id="carireport" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findreport">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6" id="grup_part">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="kode_part">Kode Parts</label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="kode_part" id="kode_part" placeholder="Kode Parts" maxlength="50" required />
                                </div>
                                <div class="col-md-2">
                                    <button id="cariparts" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpart">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6" id="grup_customer">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="kodecustomer">Nomor Customer</label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="kodecustomer" id="kodecustomer" placeholder="Nomor Customer" maxlength="50" required />
                                </div>
                                <div class="col-md-2">
                                    <button id="caricustomer" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findcustomer">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-6 col-lg-6" id="jenisouts">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jenis">Jenis Outstanding
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span>
                                </label>
                                <div class="col-sm-7 form-group">
                                    <select name="jenisost" class="form-control" id="jenisost">
                                        <option value="0">- Pilih Jenis -</option>
                                        <option value="1">Uang Muka Pembelian</option>
                                        <option value="2">Data Pengeluaran Uang Interbranch</option>
                                        <option value="3">Data Penerimaan Uang Interbranch</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="row" id="average">
                        <div class="col-md-6" hidden>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="md">MD</label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="md" id="md" placeholder="MD" value="4" required readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="wd">WD</label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="wd" id="wd" placeholder="WD" maxlength="50" required />
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" id="cabangs">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="daricabang">Cabang :</label>
                                <div class="col-md-3 ">
                                    <input class="form-control" type="text" name="kodecabang" id="kodecabang" maxlength="50" placeholder="Kode Cabang" value = "<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="text" name="namacabang" id="namacabang" maxlength="150" placeholder="Nama Cabang" readonly required />
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="caricabang" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findcabang">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="bulanan">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="bulan">Bulan</label>
                                <div class="col-md-7">
                                    <div class="input-group date" id="bulan_mulai">
                                        <input type="text" class="form-control" id="bulan" width="200" value="<?php echo date("Y-m"); ?>" readonly>
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

                    <div class="row" id="tanggalinput">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tglmulai">Tanggal Mulai</label>
                                <div class="col-md-7">
                                    <div class="input-group date" id="tanggal_mulai">
                                        <input type="text" class="form-control" id="tglmulai" width="200" value="<?php echo date("Y-m-d"); ?>" readonly>
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

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tglakhir">Tanggal Akhir</label>
                                <div class="col-md-7">
                                    <div class="input-group date" id="tanggal_akhir">
                                        <input type="text" class="form-control" id="tglakhir" width="200" value="<?php echo date("Y-m-d"); ?>" readonly>
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
                            <div class="align-center">
                                <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;Print</button>
                                &nbsp;
                                <button id="excel" class="btn btn-success"><i class="fa fa-file-excel"></i> &nbsp;Export Excel</button>
                                <button id="cetak" class="btn btn-success" style="visibility: hidden;"><i class="fa fa-print"></i>&nbsp;</button>
                                <button id="find" class="btn  btn-warning" data-toggle="modal" data-target="#video" data-backdrop="static"><i class="fa fa-video-camera"></i>&nbsp; V-HELP</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Pop Sparepart  -->
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
                    <table id="tablesearchparts" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Action</th>
                                <th width="50">Kode</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcustomer">
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
                    <table id="tablesearchcustomer" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Action</th>
                                <th width="50">Nomor</th>
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findreport">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchreport" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Action</th>
                                <th width="150">Nama Report</th>
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
                        <table id="tablesearchcabang" class="table table-bordered table-striped" style="width:100%">
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
                    <table id="tablesearch" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <iframe width="765" height="400" src="https://www.youtube.com/embed/jikmyKJmRXA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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