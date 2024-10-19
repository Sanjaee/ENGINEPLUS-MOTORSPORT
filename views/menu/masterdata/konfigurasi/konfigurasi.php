            <div class="breadcrumb">
                <h1>Konfigurasi</h1>
            </div>

        <div class="separator-breadcrumb border-top"></div>

                <!-- /. ROW  --> 
            <div class="row text-left pad-top">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="kode">Kode &nbsp;&emsp; :</label>
                        <input class="form-control" type="text" name="kode" id="kode" maxlength="3" placeholder="kode" required/>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp; :</label>
                        <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="nama" required/>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat &nbsp;&nbsp; :</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        <!-- <input class="form-control" type="text" name="alamat" maxlength="50" placeholder="alamat" required/> -->
                    </div>

                    <div class="form-group">
                        <label for="npwp">NPWP &nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="npwp" id="npwp" maxlength="50" placeholder="npwp" required/>
                    </div>

                    <div class="form-group">
                        <label for="ppn">PPn &nbsp;&nbsp;&nbsp; :</label>
                        <div class="col-sm-6 form-group">
                            <label class="radio radio-success">
                                <input type="radio" name="ppn" id="ppn" value="1"><span> YA</span><span class="checkmark"></span>
                            </label>
                            &emsp;&emsp;&emsp;
                            <label class="radio radio-danger">
                                <input type="radio" name="ppn" id="nonppn" value="0"><span> TIDAK</span><span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <br>

                    
                </div>
             </div>

            <div class="card-body">
                <div class="form-group">
                    <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                    <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                    <button id="find" class="btn  btn-success"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                    <button id="close" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; CLOSE</button>
                </div>
            </div>

              <!-- Find Data -->
            <div id="tablesearchtampil">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">  
                        <div class="pre-scrollable">
                            <h3 align="center">Pencarian Konfigurasi</h3>  
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <!-- <th width="25">id</th>   -->
                                            <th width="50">Kode</th>  
                                            <th width="50">Nama</th>  
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