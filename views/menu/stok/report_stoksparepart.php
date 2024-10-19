<div class="breadcrumb">
    <h1>REPORT STOCK SPAREPART</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<?php

$aktif = 'true';

$paramcombobox = $this->db->query("SELECT * FROM Stpm_report WHERE aktif = '" . $aktif . "' order by index ")->result();

?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <form action="<?php echo base_url('form/reportstok/export'); ?>" method="post">
                        <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                        <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                        <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />

                        <div class="row" id="viewstok">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3" for="keterangan">Sparepart</label>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" name="kodepart" id="kodepart" placeholder="Kode" readonly="" required="">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" type="text" name="namapart" id="namapart" placeholder="Nama" readonly="" required="">
                                    </div>
                                    <div class="col-md-2">
                                        <button id="caripart" class="btn-primary btn-block btn-search" data-toggle="modal" data-target="#findpart" data-backdrop="static">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button id="cetak" class="btn btn-primary">Cari Data</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button id="excel" class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-print"></i> &nbsp;Export Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <section>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="datastok" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Kode Cabang</th>
                                        <th>Nama Cabang</th>
                                        <th>Kode Parts</th>
                                        <th>Nama</th>
                                        <th>Harga Jual</th>
                                        <th>Sisa Stock</th>
                                    </tr>
                                </thead>
                                <tbody id="detaildatastok">

                                </tbody>
                            </table>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pop Cabang  -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcabang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchcabang" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Kode</th>
                                <th width="100">Nama</th>
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
<!-- Pop Parts  -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpart">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sparepart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchpart" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Kode</th>
                                <th width="100">Nama</th>                                
                                <th width="100">Kode Cabang</th>
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