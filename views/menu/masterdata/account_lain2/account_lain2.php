            <div class="breadcrumb">
                <h1>Account lain - lain</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>

                <!-- /. ROW  --> 
            <div class="row text-left pad-top">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label for="nomor">Nomor &emsp;&emsp; :</label>
                        <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" placeholder="Nomor" required/>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp;&emsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required/>
                    </div>

                    <div class="form-group jenis">
                        <label for="jenis">Jenis &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <select name="jenis" class="form-control" id="jenis" >
                            <option value="">--Pilih--</option>
                            <option value="0">Aset</option>
                            <option value="1">Hutang</option>
							<option value="2">Modal</option>
                            <option value="3">Pendapatan</option>
                            <option value="4">Biaya</option>
                            <option value="5">Lain-lain</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="aktif">Aktif &emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
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
                            <h3 align="center">Pencarian Account Lain-lain</h3>  
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">  
                                    <thead>  
                                        <tr>  
                                            <th width="5"></th>
                                            <th width="25">Nomor</th>  
                                            <th width="200">Nama</th> 
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