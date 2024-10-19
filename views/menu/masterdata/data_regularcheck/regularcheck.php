<div class="breadcrumb">
	<h1>Data Regular Check</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="regular">Regular Check</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="koderegular" id="koderegular" placeholder="Kode Regular Check" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namaregular" id="namaregular" placeholder="Nama REgular Check" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#regular" id="cariregular"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="model">Model</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodekeljasa" id="kodekeljasa" maxlength="50" placeholder="Kode Kelempok Jasa"  readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namakeljasa" id="namakeljasa" maxlength="50" placeholder="Nama Kelompok Jasa" readonly required/>
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#keljasa" id="carikeljasa"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class= "row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="jenis">Jenis</label>
                            <br>
                            <div class="col-sm-6 form-group">
                                <label class="radio radio-success">
                                    <input type="radio" name="jenis" id="jasa" value="true"><span> Jasa</span><span class="checkmark"></span>
                                </label>
                                &emsp;&emsp;&emsp;
                                <label class="radio radio-danger">
                                    <input type="radio" name="jenis" id="part" value="false"><span> Part</span><span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="ref">Referensi</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kodereferensi" id="kodereferensi" maxlength="50" placeholder="Kode Referensi"  readonly required/>
                            </div>
                            <div class="col-sm-5 form-group">
                                <input class="form-control" type="text" name="namareferensi" id="namareferensi" maxlength="50" placeholder="Nama Referensi" readonly required/>
                            </div>
                            <div class="col-sm-1.5 form-group">
                                <button data-toggle="modal" data-target="#findjasa" id="carijasa"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                                <button data-toggle="modal" data-target="#findpart" id="caripart"  class="btn-search btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <!-- <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div> -->
                        </div>
                    </div>                    
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="qty" name = "qty"></label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="qty" id="qty" maxlength="50" placeholder="qty" required/>
                            </div>
                            <div class="col-sm-2 form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                            </div>
                        </div>
                    </div>                    
                </div>

            <div class="form-group">
                <!-- <div style="overflow-y:auto; height:400px;"> -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="detail">
                                <tr>
                                    <th>Kode Regular</th>
                                    <th>Nama Regular</th>
                                    <th>Kode Model</th>
                                    <th>Nama Model</th>
                                    <th>Kode Referensi</th>
                                    <th>Nama Referensi</th>
                                    <th>Qty</th>
                                    <th>Jenis</th>
                                    <th width = "100px" ></th>
                                </tr>
                                <tbody id="detaildata"></tbody>
                        </table>
                    </div>
                <!-- </div> -->
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
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="regular">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Regular Checklist</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">  
                            <div class="table-responsive">
                                <table id="tablesearchregular" class="table table-bordered table-striped"  style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="150">Kode</th>  
                                            <th width="150">Nama</th>  
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

        <!-- Find Data -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="keljasa">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Model</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">   
                            <div class="table-responsive">
                                <table id="tablesearchmodel" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Kode</th>  
                                            <th width="150">Nama</th>
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

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findjasa">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Jasa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">   
                            <div class="table-responsive">
                                <table id="tablesearchjasa" class="table table-bordered table-striped" style="width:100%">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Kode</th>  
                                            <th width="150">Nama</th>
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

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpart">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Part</h5>
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
                                            <th width="150">Nama</th>  
                                            <th width="150">Harga Beli</th>
                                            <th width="150">Harga Jual</th>
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