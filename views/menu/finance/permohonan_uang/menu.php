<div class="breadcrumb">
    <h1>Permohonan Pengeluaran Uang</h1>

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
                                <input class="form-control" type="hidden" name="sgroup" id="sgroup" value="<?php echo $this->session->userdata('mygrup')?>" readonly required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang')?>" readonly required />
                                <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                            <div class="col-md-8">
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

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="kodetransaksi">Jenis Pembayaran</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="kodetransaksi" id="kodetransaksi" maxlength="50" placeholder="Kode Transaksi" readonly required />

                            </div>
                            <div class="col-sm-5">
                                <input class="form-control" type="text" name="namatransaksi" id="namatransaksi" maxlength="150" placeholder="Nama Transaksi" readonly required />

                            </div>
                            <div class="col-sm-1.5">
                                <button id="carijenistransaksi" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findjenis">
                                    <i class="fa fa-search"></i>
                                </button>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-md-8">
                                <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan"></textarea>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-6" id="departemen">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="kodedepartemen">Departemen</label>
                            <div class=" col-md-2 form-group">
                                <input class="form-control" type="text" name="kodedepartemen" id="kodedepartemen" maxlength="50" placeholder="Kode Departemen" readonly required />
                            </div>
                            <div class=" col-md-5 form-group">
                                <input class="form-control" type="text" name="namadepartemen" id="namadepartemen" maxlength="150" placeholder="Nama Departemen" readonly required />
                            </div>
                            <div class=" col-md-1.5">
                                <button id="caridepartemen" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#finddepartemen">
                                    <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>




                    <div class="col-12 separator-breadcrumb border-top my-4"></div>

                    <!-- Section 2 -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="kodetujuan">Nomor Invoice</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="noinvoice" id="noinvoice" maxlength="150" placeholder="Nomor Invoice" readonly required />
                            </div>
                            <div class="col-sm-1.5">
                                <button id="carinoinvoice" class="btn-search btn-primary btn-block" data-toggle="modal">
                                    <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6"></div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="">Refrensi </label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="noreferensi" id="noreferensi" maxlength="50" placeholder="No. Referensi" readonly required />
                            </div>

                            <div class="col-md-4">
                                <input class="form-control" type="text" name="namareferensi" id="namareferensi" maxlength="150" placeholder="Nama Referensi" readonly required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3" for="">Nilai Faktur</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="nilaifaktur" id="nilaifaktur" maxlength="10" value="0" style="text-align:right" readonly required />
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3" for="">Sudah Terima </label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="nilaisudahterima" id="nilaisudahterima" maxlength="15" value="0" style="text-align:right" readonly required />
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3" for="">Sisa</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="nilaisisa" id="nilaisisa" maxlength="15" value="0" style="text-align:right" readonly required />
                            </div>

                        </div>
                    </div>


                    <div class="col-12 separator-breadcrumb border-top my-4"></div>

                    <!-- Section 3 -->


                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3" for="nilaipembayaran">Nilai pembayaran </label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="nilaipembayaran" id="nilaipembayaran" maxlength="12" value="0" style="text-align:right" />
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6" id="tampilalokasi">
                        <div class="form-group row">
                            <label class="col-sm-3" for="nilaialokasi">Nilai Penghapusan</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="nilaialokasi" id="nilaialokasi" maxlength="12" value="0" style="text-align:right" />
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3" for="nomorkasiraccount">Account Kasir</label>
                            <div class="col-md-2">
                                <input class="form-control" type="text" name="nomorkasiraccount" id="nomorkasiraccount" maxlength="50" placeholder="No. Account" readonly required />
                            </div>
                            <div class="col-md-5">
                                <input class="form-control" type="text" name="namakasiraccount" id="namakasiraccount" maxlength="150" placeholder="Nama Account" readonly required />
                            </div>
                            <div class="col-md-1.5">
                                <button id="carinomorkasiraccount" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findkasir">
                                    <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="tampilpemotonganalokasi">
                        <div class="form-group row">
                            <label class="col-sm-3" for="">No.Account</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" name="noaccount" id="noaccount" maxlength="10" placeholder="No. Account" required />
                            </div>
                            <div class="col-md-1.5">
                                <button id="carinomoraccountpenghapusan" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpenghapusan">
                                    <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3" for="memo">Memo</label>
                            <div class="col-md-8">
                                <textarea name="memo" id="memo" class="form-control" placeholder="Memo"></textarea>
                            </div>

                        </div>
                    </div>




                    <div class="form-group col-md-8 mt-4">
                        <div class="row ">
                            <div class=" col-md-2 form-group">
                                <button id="new-row" class="btn btn-success btn-block">Baru</button>
                            </div>
                            <div class=" col-md-2 form-group">
                                <button id="add-row" class="btn btn-success btn-block">Tambah</button>
                            </div>
                            <div class=" col-md-2 form-group">
                                <button id="remove-row" class="btn btn-danger btn-block">Hapus</button>
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-group table-responsive-md">
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
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody id="detailtable"></tbody>
                            </table>
                        </div>

                    </div>
                    <div class="form-group col-md-4 offset-md-8">
                        <label for=""><b>Total &emsp; : &emsp;</b></label>
                        <input class="form-control" type="text" name="total" id="total" maxlength="15" value="0" style="text-align:right" readonly required />
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
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                    <button id="find" class="btn btn-success" data-toggle="modal" data-target="#findmodal">
                        <i class="fa fa-search"></i> &nbsp;FIND</button>
                    <button id="cancel" class="btn btn-danger" disabled><i class="fa fa-times"></i> &nbsp;CANCEL</button>
                    <button id="close" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp;CLOSE</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;PRINT</button>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Pop up Jenis Transaksi  -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findjenis">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Jenis Transaksi</h5>
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


<!-- Pop up Departemen  -->

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




<!-- Pop up Invoice  -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findinvoice">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchinvoice" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead id="judulpencarian">
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




<!-- Pop up Penghapusan  -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpenghapusan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Account Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchcoapenghapusan" class="table table-bordered table-striped display nowrap" style="width:100%">
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


<!-- Pop up kasir  -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findkasir">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Account Kasir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchkasiraccount" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="25">Kode</th>
                                <th width="100">Nama</th>
                                <th width="50">No. Rekening</th>
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
                                <th width="50">Total</th>
                                <th width="20">Kode Cabang</th>
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