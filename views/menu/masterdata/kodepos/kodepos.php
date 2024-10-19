<div class="breadcrumb">
                <h1>Kode Pos</h1>
            </div>

        <div class="separator-breadcrumb border-top"></div>

                <!-- /. ROW  -->
                <div class="row text-left pad-top">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode">Kode &nbsp;&emsp;&nbsp; : </label>
                        <input class="form-control" type="text" name="kode" id="kode" maxlength="50" placeholder="Kode" required/>
                    </div>

                    <div class="form-group">
                        <label for="kelurahan">Kelurahan &emsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="kelurahan" id="kelurahan" maxlength="50" placeholder="kelurahan" required/>
                    </div>
                    
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan &emsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="kecamatan" id="kecamatan" maxlength="50" placeholder="kecamatan" required/>
                    </div>
                    
                    <div class="form-group">
                        <label for="kota">Kota &emsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="kota" id="kota" maxlength="50" placeholder="kota" required/>
                    </div>
                    
                    <div class="form-group">
                        <label for="provinsi">Provinsi &emsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="provinsi" id="provinsi" maxlength="50" placeholder="provinsi" required/>
                    </div>
                    
                    <div class="form-group">
                        <label for="kodepos">kode Pos &emsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="kodepos" id="kodepos" maxlength="50" placeholder="kodepos" required/>
                    </div>
                    
                    <div class="form-group">
                        <label for="aktif">Aktif &emsp;&emsp;&emsp; :</label>
                        <input type="radio" name="aktif" id="aktif" value = true required/> Ya
                        &emsp;&emsp;
                        <input type="radio" name="aktif" id="aktif" value = false  required/> Tidak
                    </div>

                    

                    <!-- <div class="row text-left">
                        <div class="form-group">
                            <button id="new" class="btn btn-new"><i class="fa fa-pen"></i> &nbsp;NEW</button>
                            <button id="save" class="btn btn-new"><i class="fa fa-check"></i> &nbsp;SAVE</button>
                            <button id="find" class="btn btn-new"><i class="fa fa-search"></i> &nbsp;FIND</button>
                            <button id="update" class="btn btn-new"><i class="fa fa-pencil-square-o"></i> &nbsp;UPDATE</button>
                            <button id="close" class="btn btn-close"><i class="fa fa-times"></i> &nbsp;CLOSE</button>
                        </div>
                    </div> -->
                </div>
         </div>
            <div class="card-body">
                <div class="form-group">
                    <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                    <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                    <button id="find" class="btn  btn-success"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                    <!-- <button id="close" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; CLOSE</button> -->
                </div>
            </div>
            <!-- Find Data -->
            <div id="tablesearchtampil">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">  
                        <div class="pre-scrollable">
                            <h3 align="center">Pencarian Kode Pos</h3>  
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">kode</th>  
                                            <th width="50">kelurahan</th>  
                                            <th width="50">kecamatan</th>  
                                            <th width="50">kota</th>  
                                            <th width="50">provinsi</th>  
                                            <th width="50">kode pos</th>  
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