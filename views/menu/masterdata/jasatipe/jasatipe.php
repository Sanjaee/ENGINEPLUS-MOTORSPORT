<div class="breadcrumb">
	<h1>Jasa Tipe</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="Model">Model</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodemodel" id="kodemodel" placeholder="Kode model" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namamodel" id="namamodel" placeholder="Nama Model" maxlength="150" readonly required/>
                                <input class="form-control" type="hidden" name="record" id="record" placeholder="Nama Group" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target=".model" id="carimodel"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jasa">Jasa</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodejasa" id="kodejasa" maxlength="60" placeholder="Kode Jasa"  readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namajasa" id="namajasa" maxlength="150" placeholder="Nama Jasa" readonly required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target=".jasa" id="carijasa"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jasa"></label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="frt" id="frt" maxlength="50" placeholder="frt" style="width: 150px" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="jam" id="jam" maxlength="50" placeholder="jam" style="width: 150px" required/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="menu"></label>
                            <div class="col-sm-3 form-group">
                            <input class="form-control" type="text" name="harga" id="harga" maxlength="50" placeholder="harga" style="width: 150px" required/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                <button id="new_detail" class="btn btn-danger"><i class="fa fa-plus"></i> &nbsp;New</button>
                            </div>
                                
                            
                        </div>
                    </div>                    
                </div>

            <div class="form-group">
                <div style="overflow-y:auto; height:400px;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="detail">
                                <tr>
                                    <th>KODE_JASA</th>
                                    <th>NAMA_JASA</th>
                                    <th>KODE_MODEL</th>
                                    <th>NAMA_MODEL</th>
                                    <th>FRT</th>
                                    <th>JAM</th>
                                    <th>HARGA_JASA</th>
                                    <th width = "100px" ></th>
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
        <div id="tablesearchtampil" class = "popup1">
            <center>
                <!-- <div class="pre-scrollable"> -->
                <div class="popupsearch">  
                    <div class="pre-scrollable">
                        <h3 align="center">DATA MODEL</h3>  
                        <div class="table-responsive">
                            <table id="tablesearchmodel" class="table table-bordered table-striped">  
                                <thead>  
                                    <tr>  
                                        <th width="10"></th>
                                        <th width="150">Kode</th>  
                                        <th width="150">Nama</th>  
                                    </tr>  
                                </thead>                  
                            </table>
                            <div id="button">
                                <button id="closesearchmodel" class="btn btn-dark1" >Close</button>
                            </div>
                        </div>  
                    </div>
                </div>  
            </center>
        </div>

        <!-- Find Data -->
        <div id="tablesearchtampil" class = "popup2">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">  
                        <div class="pre-scrollable">
                            <h3 align="center">DATA JASA</h3>  
                            <div class="table-responsive">
                            <table id="tablesearchjasa" class="table table-bordered table-striped">  
                                <thead>  
                                    <tr>  
                                        <th width="10"></th>
                                        <th width="25">Kode Jasa</th>  
                                        <th width="150">Nama Jasa</th>
                                    </tr>  
                                </thead>                  
                            </table>
                            <div id="button">
                                <button id="closesearchjasa" class="btn btn-dark1" >Close</button>
                            </div>
                        </div>  
                    </div>
                </div>  
            </center>
        </div>
</div>