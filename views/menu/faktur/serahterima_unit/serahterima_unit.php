<div class="breadcrumb">
    <h1>Detail Saran Perbaikan</h1>
</div>

<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nomor">Nomor WO</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" readonly required />
                                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="tanggal" id="tanggal" maxlength="50" value="<?php echo date("d-m-Y"); ?>" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="dokumen">Pilih Dokumen</label>
                                <div class="col-sm-4">
                                    <input type="radio" name="dokumen" id="dokumentspk" value="true" required /> WO
                                </div>
                                <div class="col-sm-4">
                                    <input type="radio" name="dokumen" id="dokumentfaktur" value="false" required /> FAKTUR
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="warranty">Garansi</label>
                                <div class="col-sm-4">
                                    <input type="radio" name="warranty" id="warranty" value="true" required /> Ya
                                </div>
                                <div class="col-sm-4">
                                    <input type="radio" name="warranty" id="nonwarranty" value="false" required /> Tidak
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nomor_dokumen">Nomor Dokumen</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="nomor_dokumen" id="nomor_dokumen" maxlength="50" placeholder="Nomor WO / Faktur" readonly required />
                                </div>
                                <div class="form-group">
                                    <button id="carispk" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findwo">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <button id="carifaktur" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findfaktur">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nocustomer">Customer</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Nomor Customer" maxlength="50" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="kode_tipe">Tipe</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="kode_tipe" id="kode_tipe" maxlength="50" placeholder="Kode Tipe" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="nama_tipe" id="nama_tipe" maxlength="50" placeholder="Nama Tipe" readonly required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="kode_kategori">Kategori</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="kode_kategori" id="kode_kategori" maxlength="50" placeholder="Kode Kategori" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" maxlength="50" placeholder="Nama Kategori" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan"  maxlength="500"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="saran">Saran</label>
                                <div class="col-sm-8">
                                    <textarea name="saran" id="saran" class="form-control" placeholder="Saran" maxlength="500"></textarea>
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
                    <button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;SAVE</button>
                    <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findserah"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <button id="update" class="btn  btn-danger"><i class="fa fa-times"></i>&nbsp; UPDATE</button>
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-times"></i>&nbsp; CANCEL</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findwo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data WO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchspk" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="150">Nomor WO</th>
                                <th width="150">No Polisi</th>
                                <th width="150">No Rangka</th>
                                <th width="150">Nomor Customer</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findfaktur">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Faktur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchfaktur" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="150">No Polisi</th>
                                <th width="150">Nomor WO</th>
                                <th width="150">Nomor Customer</th>
                                <!--th width="150">Grand_Total</th-->
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findserah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Saran Perbaikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearch" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="150">Nomor Referensi</th>
                                <th width="150">Keterangan</th>
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