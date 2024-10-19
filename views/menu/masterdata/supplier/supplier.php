            <div class="breadcrumb">
                <h1>Supplier</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>


                <!-- /. ROW  --> 
                <div class="row text-left pad-top">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor">Nomor &emsp;&emsp;&emsp;&emsp; : </label>
                            <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" placeholder="S000000000" readonly required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="nama">Nama &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required/>
                        </div>

                        <div class="form-group">
                            <label for="nohp">No. HP &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="nohp" id="nohp" maxlength="50" placeholder="No HP" required/>
                        </div>

                        <div class="form-group">
                            <label for="notlp">No. TLP &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="notlp" id="notlp" maxlength="50" placeholder="No Tlp" required/>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            <!-- <input class="form-control" type="text" name="alamat" maxlength="50" placeholder="alamat" required/> -->
                        </div>
                        <div class="form-group">
                            <label for="TOP">TOP &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="top" id="top" maxlength="50" placeholder="top" required/>
                        </div>
                        

                        <div class="form-group">
                            <label for="aktif">Aktif &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; :</label>
                            <input type="radio" name="aktif" id="aktif" value = true required/> Ya
                            &emsp;&emsp;
                            <input type="radio" name="aktif" id="aktif" value = false  required/> Tidak
                        </div>
                    </div>

                    <div class="col-md 6">
                        <div class="form-group">
                            <label for="pkp">PKP &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; :&nbsp;&nbsp;</label>
                            <input type="radio" name="pkp" id="pkp" value="true" required/> Ya
                            &emsp;&emsp;
                            <input type="radio" name="pkp" id="pkp" value="false" required/> Tidak
                        </div>

                        <div class="form-group">
                            <label for="npwp">NPWP &emsp;&emsp;&emsp;&emsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="npwp" id="npwp" maxlength="50" placeholder="NPWP" required/>
                        </div>

                        <div class="form-group">
                            <label for="namanpwp">Nama NPWP &emsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="namanpwp" id="namanpwp" maxlength="50" placeholder="Nama NPWP" required/>
                        </div>

                        <div class="form-group">
                            <label for="alamatnpwp">Alamat NPWP &nbsp;&nbsp;&nbsp; :</label>
                            <textarea name="alamatnpwp" id="alamatnpwp" class="form-control"></textarea>
                            <!-- <input class="form-control" type="text" name="alamat" maxlength="50" placeholder="alamat" required/> -->
                        </div>
                        <div class="form-group">
                            <label for="norekening">No Rekening &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="norekening" id="norekening" maxlength="50" placeholder="No Rekening" required/>
                        </div>
                        <div class="form-group">
                            <label for="norekening">Nama Rekening &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="namarekening" id="namarekening" maxlength="50" placeholder="Nama Rekening" required/>
                        </div>
                        <div class="form-group">
                            <label for="norekening">Nama Bank &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; :</label>
                            <input class="form-control" type="text" name="namabank" id="namabank" maxlength="50" placeholder="Nama Bank" required/>
                        </div>
                    </div>
                </div>

                <br><br>
                    <div class="card-body">
                        <div class="form-group">
                            <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                            <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                            <button id="find" class="btn  btn-success"><i class="fa fa-search"></i>&nbsp;FIND</button>
                            <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                            <button id="export" class="btn  btn-danger"><i class="fa fa-file"></i>&nbsp; Export</button>
                        </div>
                    </div>

            <!-- Find Data -->
            <div id="tablesearchtampil">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">  
                        <div class="pre-scrollable">
                            <h3 align="center">Pencarian Supplier</h3>  
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">  
                                    <thead>  
                                        <tr>  
                                            <th width="10"></th>
                                            <th width="25">nomor</th>  
                                            <th width="50">Nama</th> 
                                            <th width="50">No Telp</th> 
                                            <th width="50">No HP</th> 
                                            <th width="50">Alamat</th>  
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