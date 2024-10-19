<div class="breadcrumb">
    <h1>Transfer Part Ke HO</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nomortransfer">Nomor Transfer</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="nomortransfer" id="nomortransfer" maxlength="50" readonly required />
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="tanggaltransfer">Tanggal Transfer</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="tanggaltransfer" id="tanggaltransfer" maxlength="50" readonly required />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">     
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                                <div class="col-sm-8 form-group">
                                    <textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" maxlength="150" required></textarea>
                                </div>
                            </div>
                        </div>             
                    </div> -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="kodesparepart">Kode Parts</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodesparepart" id="kodesparepart" maxlength="50" placeholder="Kode" style="width: 150px" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namasparepart" id="namasparepart" maxlength="50" placeholder="Nama" style="width: 250px" readonly required />
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findpart" id="carisparepart" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-8 form-group">
                                <textarea class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" maxlength="150" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="qty">Qty Stock</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" maxlength="50" value="0" readonly required />
                            </div>

                            <label class="col-sm-2 col-form-label" for="qtytransfer">Qty TF</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qtytransfer" id="qtytransfer" value="0" required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>



                <br>

                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="detailsparepart">
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>QtyStock</th>
                                <th>QtyTF</th>
                                <th>Action</th>
                            </tr>
                            <tbody id="detaildatasparepart"></tbody>
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
                            <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                            <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                            <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findtf"><i class="fa fa-search"></i>&nbsp;FIND</button>
                            <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                            <button id="cetak" class="btn  btn-success"><i class="fa fa-print"></i>&nbsp;CETAK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <table id="tablesearchsparepart" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10">Action</th>
                                        <th width="25">kode sparepart</th>
                                        <th width="25">Nama Sparepart</th>
                                        <th width="25">Harga Beli</th>
                                        <th width="25">Harga Jual</th>
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

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findtf">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Transfer HO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearch" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="25">Nomor</th>
                                        <th width="100">Kode Cabang</th>
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