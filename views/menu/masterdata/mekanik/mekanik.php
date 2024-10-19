            <div class="breadcrumb">
                <h1>Teknisi</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <!-- /. ROW  -->
            <div class="row text-left pad-top">
                <div class="col-md-6">
                    <input class="form-single" type="hidden" name="kodecompany" id="kodecompany" maxlength="10" placeholder="" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                    <div class="form-group">
                        <label for="kode">Kode &emsp;&emsp;&emsp; : </label>
                        <input class="form-control" type="text" name="kode" id="kode" maxlength="50" placeholder="Kode" required />
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp;&emsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required />
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat &emsp;&emsp; :</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        <!-- <input class="form-control" type="text" name="alamat" maxlength="50" placeholder="alamat" required/> -->
                    </div>

                    <div class="form-group">
                        <label for="kode_cabang">Kode Cabang &emsp;&nbsp; : </label> </br>
                        <input class="form-single" type="text" name="kode_cabang" id="kode_cabang" maxlength="10" placeholder="" readonly required />
                        <input class="form-double" type="text" name="nama_cabang" id="nama_cabang" maxlength="150" placeholder="" readonly required />
                        <button id="caricabang" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>

                    <div class="form-group">
                        <label for="kode_cabang">Foreman &emsp;&nbsp; : </label> </br>
                        <input class="form-single" type="text" name="kode_foreman" id="kode_foreman" maxlength="10" placeholder="" readonly required />
                        <input class="form-double" type="text" name="nama_foreman" id="nama_foreman" maxlength="150" placeholder="" readonly required />
                        <button id="cariforeman" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>

                    <div class="form-group">
                        <label for="aktif">Aktif &emsp;&emsp;&emsp;&nbsp; :</label>
                        <input type="radio" name="aktif" id="aktif" value="true" required /> Ya
                        &emsp;&emsp;
                        <input type="radio" name="aktif" id="aktif" value="false" required /> Tidak
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
                            <h3 align="center">Pencarian Mekanik</h3>
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5"></th>
                                            <th width="25">Kode</th>
                                            <th width="50">Nama</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="button">
                                    <button id="closesearch" class="btn btn-dark1">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>

            <div id="tablesearchtampil" class="popup2">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">
                        <div class="pre-scrollable">
                            <h3 align="center">Pencarian Cabang</h3>
                            <div class="table-responsive">
                                <table id="tablesearchcabang" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10"></th>
                                            <th width="30">Kode</th>
                                            <th width="150">Nama</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="button">
                                    <button id="closesearchcabang" class="btn btn-dark1">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>

            <div id="tablesearchtampil" class="popup3">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">
                        <div class="pre-scrollable">
                            <h3 align="center">Pencarian Foreman</h3>
                            <div class="table-responsive">
                                <table id="tablesearchforeman" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10"></th>
                                            <th width="30">Kode</th>
                                            <th width="150">Nama</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="button">
                                    <button id="closesearchforeman" class="btn btn-dark1">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>