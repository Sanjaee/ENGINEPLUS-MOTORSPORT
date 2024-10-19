<div class="breadcrumb">
	<h1>Otorisasi Discount</h1>
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
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="Group">Group</label>
                            <div class="col-sm-3 form-group">
                                <input class="form-control" type="text" name="kode" id="kode" placeholder="Kode Group" maxlength="150" readonly required/>
                            </div>
                            <div class="col-sm-4 form-group">
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
                            <label class="col-sm-3 col-form-label" for="maxdisc">Max Discount (%)</label>
                            <div class="col-sm-2 form-group">
                                <input class="form-control" type="text" name="maxdisc" id="maxdisc" maxlength="50" placeholder="0" required/>
                            </div>
                            <label class="col-sm-2 col-form-label" for="module">Kategori Disc</label>
                            <div class="col-sm-4 form-group">
                                <select name="module" class="form-control" id="module" required>
                                    <option value="0">- Pilih Kategori Disc -</option>
                                    <option value="1">Discount Faktur</option>
                                    <option value="2">Discount Part Counter</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="aktif">Aktif</label>
                            &emsp;
                            <label class="radio radio-success">
                                <input type="radio" name="aktif" id="aktif" value="true"><span> YA</span><span class="checkmark"></span>
                            </label>
                            &emsp;&emsp;&emsp;
                            <label class="radio radio-danger">
                                <input type="radio" name="aktif" id="nonaktif" value="false"><span> TIDAK</span><span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="margin-top:20px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Data Otorisasi Discount</h5>
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
                                                        <span style="font-weight: bold">Module</span>
                                                    </th>
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">Group</span>
                                                    </th>
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">Nama Group</span>
                                                    </th>
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">Max Disc (%)</span>
                                                    </th>
                                                    <th style="text-align: center; ">
                                                        <span style="font-weight: bold">User</span>
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

                <!-- <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="detail">
                            <tr style="line-height : 1.5">
                                <th>Group</th>
                                <th>Nama</th>
                                <th>Max Discount</th>
                                <th width = "100px" ></th>
                            </tr>
                            <tbody id="detaildata"></tbody>
                        </table>
                    </div>
                </div> -->
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