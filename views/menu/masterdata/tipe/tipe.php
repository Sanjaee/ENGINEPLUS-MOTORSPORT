            <div class="breadcrumb">
                <h1>Tipe</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>

                <!-- /. ROW  --> 
            <div class="row text-left pad-top">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode">Kode &emsp;&emsp;&nbsp;&nbsp; : </label>
                        <input class="form-control" type="text" name="kode" id="kode" maxlength="20" placeholder="Kode" required/>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required/>
                    </div>                    

                    <div class="form-group">
                        <label for="kodekategori">Kode Kategori &nbsp;&nbsp;  :</label></br>
                        <input class="form-single" type="text" name="kodekategori" id="kodekategori" placeholder="Kode Kategori" maxlength="50"  required/>
                        <input class="form-double" type="text" name="namakategori" id="namakategori"  placeholder="Nama Kategori"maxlength="150"   required/>
                        
                        <button id="carikategori" class="btn btn-search"><i class="fa fa-search"></i></button>
                        
                        <!-- <button id="carikategori" class="btn btn-search"><i class="fa fa-search"></i></button> -->
                    </div>


                    <div class="form-group">
                        <label for="aktif">Aktif &emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
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
            <!-- lookup kategori -->
            <div id="tablesearchtampil" class = "popup1">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">  
                        <div class="pre-scrollable">
                            <h3 align="center">Pencarian kategori</h3>  
                            <div class="table-responsive">
                                <table id="tablesearchkategori" class="table table-bordered table-striped">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">Kode</th>  
                                            <th width="150">Nama</th>  
                                        </tr>  
                                    </thead>                  
                                </table>
                                <div id="button">
                                    <button id="closesearchkategori" class="btn btn-dark1" >Close</button>
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
                            <h3 align="center">Pencarian Tipe</h3>  
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">kode</th>  
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