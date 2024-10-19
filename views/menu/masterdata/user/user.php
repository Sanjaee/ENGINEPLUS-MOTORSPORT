<div class="breadcrumb">
    <h1>User Login</h1>
</div>
<span style="color: red; font-size: 10; font-weight: normal">Jika tidak ada cabang / sub cabang tidak perlu diisi biarkan default ALL</span>
<div class="separator-breadcrumb border-top"></div>


<!-- /. ROW  -->
<div class="row text-left pad-top">
    <div class="col-md-6">
        <div class="form-group">
            <label for="login">Username &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
            <input class="form-control" type="text" name="login" id="login" maxlength="50" placeholder="Login" required />
            <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
        </div>

        <div class="form-group">
            <label for="password">Password &emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
            <input class="form-control" type="password" name="password" id="password" maxlength="50" placeholder="Password" required />
        </div>

        <div class="form-group">
            <label for="nama">Nama &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; :</label>
            <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required />
        </div>

        <div class="form-group">
            <label for="alamat">Alamat &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
            <textarea name="alamat" id="alamat" class="form-control"></textarea>
            <!-- <input class="form-control" type="text" name="alamat" maxlength="50" placeholder="alamat" required/> -->
        </div>

        <div class="form-group">
            <label for="kode_grup">Grup &emsp;&emsp;&emsp;&emsp;&emsp; : </label> </br>
            <input class="form-single" type="text" name="kode_grup" id="kode_grup" maxlength="10" placeholder="" readonly required />
            <input class="form-double" type="text" name="nama_grup" id="nama_grup" maxlength="150" placeholder="" readonly required />
            <button id="carigrup" class="btn btn-search"><i class="fa fa-search"></i></button>
        </div>

        <div class="form-group">
            <label for="kodecompany">Company &emsp;&nbsp; : </label> </br>
            <input class="form-single" type="text" name="kodecompany" id="kodecompany" maxlength="10" placeholder="" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
            <input class="form-double" type="text" name="namacompany" id="namacompany" maxlength="150" placeholder="" readonly required />
            <button id="caricompany" class="btn btn-search"><i class="fa fa-search"></i></button>
        </div>

        <div class="form-group">
            <label for="kode_cabang">Kode Cabang &emsp;&nbsp; : </label> </br>
            <input class="form-single" type="text" name="kode_cabang" id="kode_cabang" maxlength="10" placeholder="" readonly required />
            <input class="form-double" type="text" name="nama_cabang" id="nama_cabang" maxlength="150" placeholder="" readonly required />
            <button id="caricabang" class="btn btn-search"><i class="fa fa-search"></i></button>
        </div>

        <div class="form-group">
            <label for="kode_cabang">Kode Sub Cabang &emsp;&nbsp; : </label> </br>
            <input class="form-single" type="text" name="kodesub" id="kodesub" maxlength="10" placeholder="" readonly required />
            <input class="form-double" type="text" name="namasub" id="namasub" maxlength="150" placeholder="" readonly required />
            <button id="carisubcabang" class="btn btn-search"><i class="fa fa-search"></i></button>
        </div>

        <div class="form-group">
            <label for="aktif">Aktif &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
            <input type="radio" name="aktif" id="aktif" value="true" required /> Ya
            &emsp;&emsp;
            <input type="radio" name="aktif" id="aktif" value="false" required /> Tidak
        </div>
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

<!-- </div> -->

<!-- Find Data -->
<div id="tablesearchtampil" class="popup1">
    <center>
        <!-- <div class="pre-scrollable"> -->
        <div class="popupsearch">
            <div class="pre-scrollable">
                <h3 align="center">Pencarian Grup</h3>
                <div class="table-responsive">
                    <table id="tablesearchgrup" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="30">Kode</th>
                                <th width="150">Nama</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="button">
                        <button id="closesearchgrup" class="btn btn-dark1">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>

<!-- Find Data -->
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

<!-- Find Data -->
<div id="tablesearchtampil" class="popup3">
    <center>
        <!-- <div class="pre-scrollable"> -->
        <div class="popupsearch">
            <div class="pre-scrollable">
                <h3 align="center">Pencarian Login</h3>
                <div class="table-responsive">
                    <table id="tablesearch" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5"></th>
                                <th width="30">Login</th>
                                <th width="70">Nama</th>
                                <th width="150">Alamat</th>
                                <th width="70">Grup</th>
                                <th width="70">Cabang</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="button">
                        <button id="closesearch" class="btn btn-dark1">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>

<div id="tablesearchtampil" class="popup4">
    <center>
        <!-- <div class="pre-scrollable"> -->
        <div class="popupsearch">
            <div class="pre-scrollable">
                <h3 align="center">Pencarian Sub Cabang</h3>
                <div class="table-responsive">
                    <table id="tablesearchsubcabang" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="30">Kode</th>
                                <th width="150">Nama</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="button">
                        <button id="closesearchsubcabang" class="btn btn-dark1">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>

<div id="tablesearchtampil" class="popup5">
    <center>
        <!-- <div class="pre-scrollable"> -->
        <div class="popupsearch">
            <div class="pre-scrollable">
                <h3 align="center">Pencarian Company</h3>
                <div class="table-responsive">
                    <table id="tablesearchcompany" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="30">Kode</th>
                                <th width="150">Nama</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="button">
                        <button id="closesearchcompany" class="btn btn-dark1">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>