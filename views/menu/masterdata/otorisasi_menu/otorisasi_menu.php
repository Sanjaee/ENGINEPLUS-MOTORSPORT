<div class="breadcrumb">
	<h1>Otorisasi Menu</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="Group">Group</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode" id="kode" placeholder="Kode Group" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="grup" id="grup" placeholder="Nama Group" maxlength="150" readonly required/>
                                <input class="form-control" type="hidden" name="record" id="record" placeholder="Nama Group" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target=".grup" id="carigrup"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="menu">Menu</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama"  readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="url" id="url" maxlength="50" placeholder="Url" readonly required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button data-toggle="modal" data-target=".menu" id="carimenu"  class="btn-search btn-primary btn-block">
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
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="head" id="head" maxlength="50" placeholder="Head" style="width: 150px" readonly required/>
                                <input class="form-control" type="hidden" name="urutan" id="urutan" maxlength="50" placeholder="urutan" style="width: 150px" readonly required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>                    
                </div>

            <div class="form-group">
                <div style="overflow-y:auto; height:400px;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="detail">
                                <tr>
                                    <th>Head</th>
                                    <th>Nama</th>
                                    <th>Url</th>
                                    <th>Urutan</th>
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
                        <h3 align="center">DATA GROUP</h3>  
                        <div class="table-responsive">
                            <table id="tablesearchgrup" class="table table-bordered table-striped">  
                                <thead>  
                                    <tr>  
                                        <th width="10"></th>
                                        <th width="150">Kode</th>  
                                        <th width="150">Nama</th>  
                                    </tr>  
                                </thead>                  
                            </table>
                            <div id="button">
                                <button id="closesearchgrup" class="btn btn-dark1" >Close</button>
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
                            <h3 align="center">DATA MENU</h3>  
                            <div class="table-responsive">
                            <table id="tablesearchmenu" class="table table-bordered table-striped">  
                                <thead>  
                                    <tr>  
                                        <th width="10"></th>
                                        <th width="25">Nama</th>  
                                        <th width="150">Url</th>
                                    </tr>  
                                </thead>                  
                            </table>
                            <div id="button">
                                <button id="closesearchmenu" class="btn btn-dark1" >Close</button>
                            </div>
                        </div>  
                    </div>
                </div>  
            </center>
        </div>

        <div id="tablesearchtampil" class = "popup3">
        <center>
            <!-- <div class="pre-scrollable"> -->
            <div class="popupsearch">  
                <div class="scrollable">
                    <h3 align="center">DATA REQUEST PART</h3>  
                    <div class="table-responsive">
                        <table id="tablesearch" class="table table-bordered table-striped">  
                            <thead>  
                                <tr>  
                                    <th width="10"></th>
                                    <th width="25">Nomor</th> 
                                    <th width="150">Nomor Referensi</th>  
                                    <th width="150">Keterangan</th>
                                </tr>  
                            </thead>                  
                        </table>
                    <div id="button">
                        <button id="closesearch" class="btn btn-dark1" >Close</button>
                    </div>
                    </div>  
                </div>
            </div>  
        </center>
    </div>
</div>