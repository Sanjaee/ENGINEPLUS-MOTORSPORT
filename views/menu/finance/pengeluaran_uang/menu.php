<div class="breadcrumb">
    <h1>Pengeluaran Uang</h1>

</div>
<div class="separator-breadcrumb border-top"></div>


<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">

            <div class="card-body mb-2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label" for="nomor">Nomor</label>
                            <div class="col-sm-6">
                                <input class=" form-control" type="text" name="nomor" id="nomor" maxlength="50" value="" readonly required />
                                <input class="form-control" type="hidden" name="sgroup" id="sgroup" value="<?php echo $this->session->userdata('mygrup')?>" readonly required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang')?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="tanggal">Tanggal</label>
                            <div class="col-sm-6">
                                <div class="input-group date" id="tanggal">
                                    <input type="text" class="form-control" id="tglpembayaran" width="200" readonly>
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
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="kodetujuan">Jenis Pembayaran</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" name="kodetransaksi" id="kodetransaksi" maxlength="50" placeholder="Kode Transaksi" readonly required />

                            </div>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="namatransaksi" id="namatransaksi" maxlength="150" placeholder="Nama Transaksi" readonly required />

                            </div>
                            <div class="col-sm-1">
                                <button id="carijenistransaksi" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findjt">
                                    <i class="fa fa-search"></i>
                                </button>


                            </div>
                        </div>
                    </div>
                    <!-- Section 2 -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kodetujuan">Nomor Permohonan</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="nopermohonan" id="nopermohonan" maxlength="150" placeholder="Nomor Permohonan" readonly required />
                            </div>
                            <div class="col-sm-1">
                                <button id="carinopermohonan" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpermohonan"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="departemen">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="departemen">Departemen</label>

                            <div class=" col-md-2 form-group">
                                <input class="form-control" type="text" name="kodedepartemen" id="kodedepartemen" maxlength="50" placeholder="Kode Departemen" readonly required />
                            </div>
                            <div class=" col-md-3 form-group">
                                <input class="form-control" type="text" name="namadepartemen" id="namadepartemen" maxlength="150" placeholder="Nama Departemen" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="alamat">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" readonly></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 separator-breadcrumb border-top my-4"></div>

                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div class="table-responsive-md">
                                <table class="table table-bordered table-striped display nowrap" id="tablelistdata">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Nilai Pembayaran</th>
                                            <th>Account</th>
                                            <th>Nama Account</th>
                                            <th>Nilai Alokasi</th>
                                            <th>Acc Alokasi</th>
                                            <th>Memo</th>
                                            <th>Kode Cabang</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailtable"></tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                    <div class="form-group col-md-4 offset-md-8">
                        <label for=""><b>Total &emsp; : &emsp;</b></label>
                        <input class="form-control" type="text" name="total" id="total" maxlength="15" value="0" style="text-align:right" readonly />
                    </div>

                </div>


            </div>
        </div>
    </div>

    <!-- BUTTON BOTTOM -->
    <div class="col-md-12">
        <div class="card mb-4">


            <div class="card-body mb-2">
                <div class="form-group">
                    <button id="new" class="btn btn-success"><i class="fa fa-pen"></i> &nbsp;NEW</button>
                    <button id="save" class="btn btn-success"><i class="fa fa-check"></i> &nbsp;SAVE</button>
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                    <!-- <button data-toggle="modal" data-target=".finds" id="find" class="btn btn-success">
                        <i class="fa fa-search"></i> &nbsp;FIND
                    </button> -->
                    <button id="find" class="btn btn-success" data-toggle="modal" data-target="#findpengeluaran" disabled><i class="fa fa-check"></i> &nbsp;FIND</button>
                    <button id="cancel" class="btn btn-danger" disabled><i class="fa fa-times"></i> &nbsp;CANCEL</button>
                    <button id="close" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp;CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findjt">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Jenis Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">  
                <div class="table-responsive">
                    <table id="tablesearchjenistransaksi" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="25">Kode</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpermohonan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Permohonan Uang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <div class="table-responsive">
                <table id="tablesearchnopermohonan" class="table table-bordered table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5"></th>
                            <th width="10">Nomor</th>
                            <th width="10">Tanggal</th>
                            <th width="100">Keterangan</th>
                            <th width="20">Kode Cabang</th>
                            <!-- <th width="20">Status</th> -->
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpengeluaran">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Pengeluaran Uang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
            <div class="table-responsive">
                <table id="tablesearchfind" class="table table-bordered table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5"></th>
                            <th width="10">Nomor</th>
                            <th width="10">No. Permohonan</th>
                            <th width="25">Tanggal</th>
                            <th width="50">total</th>
                            <th width="100">Keterangan</th>
                            <th width="20">Kode Cabang</th>
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