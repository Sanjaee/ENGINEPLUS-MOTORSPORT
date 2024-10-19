<div class="breadcrumb">
	<h1>Otorisasi Pembatalan</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<!-- <div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <button id="news" class="btn  btn-success"><i class="fa fa-refresh"></i>&nbsp; NEW</button>
                    <button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;SAVE</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="grup">Group</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="kodegrup" id="kodegrup" placeholder="Kode Group" readonly required/>
                            </div>
                            <div class="col-sm-4 form-group">
                                <input class="form-control" type="text" name="namagrup" id="namagrup" placeholder="Nama Group" readonly required/>
                                <!-- <input class="form-control" type="hidden" name="record" id="record" placeholder="Nama Group" readonly required/> -->
                            </div>
                            <div class="col-sm-1 form-group">
                                <button data-toggle="modal" data-target=".grup" id="carigrup"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="menu">Menu</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="head" id="head" placeholder="Header Menu" readonly required/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="nama_menu" id="nama_menu" placeholder="Nama Menu" readonly required/>
                            </div>
                            <div class="col-sm-1 form-group">
                                <button data-toggle="modal" data-target=".menu" id="carimenu"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="otoritas">Otoritas Batal</label>
                            <div class="col-sm-1 form-group">
                                <label class="radio radio-success">
                                    <input type="radio" name="otoritas" id="otoritas" value="YES"><span>YES</span><span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-1 form-group">
                                <label class="radio radio-danger">
                                    <input type="radio" name="otoritas" id="non_otoritas" value="NO"><span>NO</span><span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Data Otorisasi Pembatalan</h5>
                            </div>
                            <div class="modal-body pre-scrollable">
                                <div class="table-responsive">
                                    <!-- <div class="pre-scrollable"> -->
                                        <table id="tablesearch" class="table table-bordered table-striped table-striped" style="width:100%">
                                            <thead class = "thead-dark">
                                                <tr style="line-height: 0.5 cm; ">
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">Action</span>
                                                    </th>
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">Kode Group</span>
                                                    </th>
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">Header Menu</span>
                                                    </th>
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">Nama Menu</span>
                                                    </th>
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">Otoritas Batal</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>

                                        </table>
                                    <!-- </div> -->
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
                    <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp;UPDATE</button>
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
                                <!-- <th width="150">Header</th>   -->
                                <th width="150">Menu</th>  
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