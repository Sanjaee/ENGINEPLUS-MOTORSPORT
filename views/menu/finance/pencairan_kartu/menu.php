<div class="breadcrumb">
    <h1>Pencairan Kartu Debit Kredit</h1>

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
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang')?>" readonly required />
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
                                    <input type="text" class="form-control" id="tglpelunasan" width="200" readonly>
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

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="jenis">Filter</label>
                            <div class="col-sm-5 form-group">
                                <select name="jenis" class="form-control" id="jenis">
                                    <option value="-">- Pilih Jenis -</option>
                                    <option value="3">Kartu Debit</option>
                                    <option value="4">Kartu Kredit</option>
                                    <option value="5">Market Place</option>
                                </select>
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
                                        <th>Jenis</th>
                                        <th>No Account</th>
                                        <th>Nomor Piutang</th>
                                        <th>Tanggal</th>
                                        <th>Nomor Penerimaan</th>
                                        <th>Nilai Penerimaan</th>
                                        <th>Nama Customer</th>
                                        <th>Kode Cabang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="detailtable"></tbody>
                            </table>
                        </div>

                    </div>
                        <div class="col-md-10">
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" for="total">Total</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="total" id="total" style = "text-align:right;" maxlength="250" readonly required/>
                                </div>

                                <label class="col-sm-2 col-form-label" for="bankcharge">Bank Charge</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="bankcharge" id="bankcharge" style = "text-align:right;" maxlength="150" required/>
                                </div>

                                <label class="col-sm-2 col-form-label" for="totalterima">Total Penerimaan</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="totalterima" id="totalterima" style = "text-align:right;" maxlength="150" readonly required/>
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
                    <button id="close" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp;CLOSE</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;PRINT</button>
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