            <div class="breadcrumb">
                <h1>Jasa</h1>
            </div>
            <span style="color: red; font-size: 10; font-weight: normal">Data tasklist otomatis tersimpan disemua model kendaraan</span>
            <div class="separator-breadcrumb border-top"></div>

                <!-- /. ROW  --> 
            <div class="row text-left pad-top">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label for="kode">Kode &nbsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : </label>
                        <input class="form-control" type="text" name="kode" id="kode" maxlength="60" placeholder="Kode" required/>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="nama" id="nama" maxlength="150" placeholder="Nama" required/>
                    </div>

                    <div class="form-group">
                        <label for="jam">Jam &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="jam" id="jam" style="text-align:right" maxlength="50" placeholder="Jam" required/>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori :</label>
                        <select name="kategori" class="form-control" id="kategori">
                            <option value="-">- Pilih Kategori -</option>
                            <option value="1">PAKET SERVICE</option> 
                            <option value="2">INTERNAL ENGINE & ENGINE SUPPORT</option>
                            <option value="3">ENGINE BLUEPRINTING</option>
                            <option value="4">INTAKE & EXHAUST SYSTEM</option>
                            <option value="5">TURBO SYSTEM</option> 
                            <option value="6">COOLING SYSTEM</option> 
                            <option value="7">FUEL & EMISSION  SYSTEM</option>
                            <option value="8">ELECTRICAL</option>
                            <option value="9">AC SYSTEM</option> 
                            <option value="10">STEERING & WHEEL SYSTEM</option>  
                            <option value="11">TRANSAXLE SYSTEM</option>
                            <option value="12">SUSPENSION SYSTEM</option>
                            <option value="13">BRAKE SYSTEM</option>
                            <option value="14">UNDERCARRIAGE</option> 
                            <option value="15">LUBRICATION SYSTEM</option>
                            <option value="16">INTERIOR & EXTERIOR BODY</option>
                            <option value="17">FABRICATION</option>
                            <option value="18">VENDOR LUAR</option> 
                            <option value="19">DYNO</option>
                            <option value="20">OTHERS</option>
                            <option value="21">3D DESIGN</option>
                            <option value="22">3D SCAN</option>
                            <option value="23">CMM</option>
                        </select>
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
                            <button id="excel" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; Export Excel</button>
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
                            <h3 align="center">Pencarian Jasa</h3>  
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