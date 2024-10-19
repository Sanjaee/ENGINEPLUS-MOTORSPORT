<div class="breadcrumb">
    <h1>Jasa Detail</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="JasaHead">Jasa Head</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="jasaheadkode" id="jasaheadkode" placeholder="Kode Jasa Head" maxlength="150" readonly required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="jasaheadnama" id="jasaheadnama" placeholder="Nama Jasa Head" maxlength="150" readonly required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target=".jasahead" id="carijasahead" class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jasadetail">Jasa Detail</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodejasadetail" id="kodejasadetail" maxlength="50" placeholder="Kode Jasa Detail" required />
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namajasadetail" id="namajasadetail" maxlength="150" placeholder="Nama Jasa Detail" required />
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target=".jasadetail" id="carijasadetail" class="btn-search btn-primary btn-block">
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
                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="new_detail" class="btn btn-danger"><i class="fa fa-plus"></i> &nbsp;New</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div style="overflow-y:auto;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="detail">
                                <tr>
                                    <th>Kode Head</th>
                                    <th>Kode Jasa Detail</th>
                                    <th>Nama Jasa Detail</th>
                                    <th width="100px"></th>
                                </tr>
                                <tbody id="detaildata"></tbody>
                            </table>
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
                            <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                            <button id="excel" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; Export Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Find Data -->
        <div id="tablesearchtampil" class="popup1">
            <center>
                <!-- <div class="pre-scrollable"> -->
                <div class="popupsearch">
                    <div class="pre-scrollable">
                        <h3 align="center">DATA JASA HEAD</h3>
                        <div class="table-responsive">
                            <table id="tablesearchjasahead" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="150">Kode Jasa Head</th>
                                        <th width="150">Nama Jasa Head</th>
                                    </tr>
                                </thead>
                            </table>
                            <div id="button">
                                <button id="closesearchjasahead" class="btn btn-dark1">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>

        <!-- Find Data -->
        <div id="tablesearchtampil" class="popup2">
            <center>
                <!-- <div class="pre-scrollable"> -->
                <div class="popupsearch">
                    <div class="pre-scrollable">
                        <h3 align="center">DATA JASA DETAIL</h3>
                        <div class="table-responsive">
                            <table id="tablesearchjasadetail" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="25">Kode Jasa Detail</th>
                                        <th width="150">Nama Jasa Detail</th>
                                    </tr>
                                </thead>
                            </table>
                            <div id="button">
                                <button id="closesearchjasadetail" class="btn btn-dark1">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>