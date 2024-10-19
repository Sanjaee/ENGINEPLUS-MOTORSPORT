            <div class="breadcrumb">
                <h1>Regular Checklist</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>

                <!-- /. ROW  --> 
            <div class="row text-left pad-top">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label for="kode">Kode &nbsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : </label>
                        <input class="form-control" type="text" name="kode" id="kode" maxlength="10" placeholder="Kode" required/>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required/>
                    </div>

                    <div class="form-group">
                        <label for="aktif">Aktif &emsp;&emsp;&emsp;&emsp; :</label>
                        <input type="radio" name="aktif" id="aktif" value = true required/> Ya
                        &emsp;&emsp;
                        <input type="radio" name="aktif" id="aktif" value = false  required/> Tidak
                    </div>

                    <br>

                    <div class="card-body">
                        <div class="form-group">
                            <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                            <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                            <button id="find" class="btn  btn-success"><i class="fa fa-search"></i>&nbsp;FIND</button>
                            <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                            <button id="close" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Find Data -->
            <div id="tablesearchtampil">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">  
                        <div class="pre-scrollable">
                            <h3 align="center">Data Regular Checklist</h3>  
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">  
                                    <thead>  
                                        <tr>  
                                            <th width="5"></th>
                                            <th width="25">Kode</th>  
                                            <th width="50">Nama</th>  
                                            <!-- <th width="50">Harga Beli</th>  -->                                    
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