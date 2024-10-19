<div class="breadcrumb">
    <h1><?php echo $title ?></h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="nomor">Tanggal</label>
                            <div class="col-md-8">
                                <div class="input-group date" id="tanggal">
                                    <input type="text" class="form-control" id="tglkasbank" width="200" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="menu">Account</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" placeholder="Nomor" readonly required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" readonly required />
                            </div>
                            <div class="col-md-2">
                                <button id="cariaccount" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findmodalaccount" data-backdrop="static">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="menu"></label>
                            <div class="col-sm-8 form-group">
                                <input class="form-control" type="text" name="nilai" id="nilai" maxlength="50" placeholder="0" style="text-align:right" required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn-search btn-primary btn-block"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="detail">
                            <tr>
                                <th>Account</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th width="40px"></th>
                            </tr>
                            <tbody id="detaildata"></tbody>
                        </table>
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
                    <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findmodalaccount">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DATA ACCOUNT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchaccount" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="50">Nomor</th>
                                <th width="250">Nama</th>
                                <th width="100">Rekening</th>
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