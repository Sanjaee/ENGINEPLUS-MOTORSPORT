            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>BAHAN</strong>
                        </div>
                    </div>
                </div>

                <!-- /. ROW  --> 
                <div class="row text-left pad-top">
                    
                    <div class="form-group">
                        <label for="kode">Kode &nbsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : </label>
                        <input class="form-control" type="text" name="kode" id="kode" maxlength="50" placeholder="Kode" required/>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required/>
                    </div>

                    <div class="form-group">
                       <label for="hargabeli">Harga Beli &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="hargabeli" id="hargabeli" style="text-align:right" maxlength="50" placeholder="Harga Beli" required/>
                    </div>

                    <div class="form-group">
                       <label for="hargajual">Harga Jual &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="hargajual" id="hargajual" style="text-align:right" maxlength="50" placeholder="Harga Jual" required/>
                    </div>

                    <div class="form-group">
                        <label for="aktif">Aktif &emsp;&emsp;&emsp;&emsp; :</label>
                        <input type="radio" name="aktif" id="aktif" value = true required/> Ya
                        &emsp;&emsp;
                        <input type="radio" name="aktif" id="aktif" value = false  required/> Tidak
                    </div>

                    <br><br><br><br><br>

                    <div class="row text-left">
                        <div class="form-group">
                            <button id="new" class="btn btn-new"><i class="fa fa-pen"></i> &nbsp;NEW</button>
                            <button id="save" class="btn btn-new"><i class="fa fa-check"></i> &nbsp;SAVE</button>
                            <button id="find" class="btn btn-new"><i class="fa fa-search"></i> &nbsp;FIND</button>
                            <button id="update" class="btn btn-new"><i class="fa fa-pencil-square-o"></i> &nbsp;UPDATE</button>
                            <button id="close" class="btn btn-close"><i class="fa fa-times"></i> &nbsp;CLOSE</button>
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
                            <h3 align="center">Pencarian Bahan</h3>  
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">  
                                    <thead>  
                                        <tr>  
                                            <th width="5"></th>
                                            <th width="25">Kode</th>  
                                            <th width="50">Nama</th>  
                                            <!-- <th width="100">Harga Beli</th>  -->
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