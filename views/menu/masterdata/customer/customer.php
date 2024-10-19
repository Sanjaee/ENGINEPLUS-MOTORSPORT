            <div class="breadcrumb">
                <h1>Customer</h1>
            </div>
            <?php
            $jeniscustomer = $this->db->query('select * from glbm_jeniscustomer where aktif = true')->result();
            ?>
            <div class="separator-breadcrumb border-top"></div>
            <!-- /. ROW  -->
            <div class="row text-left pad-top">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nomor">Nomor &emsp;&emsp;&emsp;&emsp; : </label>
                        <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" placeholder="C000000000" readonly required />
                        <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                        <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                        <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />

                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; :</label><br />
                        <select name="jeniscustomer" class="form-single" id="jeniscustomer">
                            <option value="-">- Pilih Title -</option>
                            <option value="1">Mr</option>
                            <option value="2">Mrs</option>
                            <option value="3">Ms</option>
                            <option value="4">Company</option>
                        </select>&emsp;&emsp;&emsp;&emsp;
                        <input class="form-double" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required />
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="kode">kelurahan &nbsp;&nbsp; :</label><br />
                        <input class="form-single" type="text" name="kode" id="kode" placeholder="kode kelurahan" maxlength="50" required />
                        <input class="form-double" type="text" name="kelurahan" id="kelurahan" placeholder="kelurahan" maxlength="150" required />
                        <button id="carikodepos" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>

                    <div class="form-group">
                        <label for="kecamatan">Kecamatan &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="kecamatan" id="kecamatan" maxlength="50" placeholder="kecamatan" required />
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="kota" id="kota" maxlength="50" placeholder="kota" required />
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="provinsi" id="provinsi" maxlength="50" placeholder="provinsi" required />
                    </div>
                    <div class="form-group">
                        <label for="kodepos">Kodepos &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="kodepos" id="kodepos" maxlength="50" placeholder="kodepos" required />
                    </div>

                    <div class="form-group">
                        <label for="nohp">No. HP &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="number" name="nohp" id="nohp" maxlength="50" placeholder="No HP" required />
                    </div>

                    <div class="form-group">
                        <label for="notlp">No. Tlp &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="number" name="notlp" id="notlp" maxlength="50" placeholder="No Tlp" required />
                    </div>

                    <div class="form-group">
                        <label for="email">Email &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="email" name="email" id="email" maxlength="50" placeholder="E-mail" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Jenis Customer &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <select name="jeniscustomer2" class="form-control" id="jeniscustomer2">
                            <option value="">- Jenis Customer -</option>
                            <?php foreach ($jeniscustomer as $sk) : ?>
                                <option value="<?= $sk->nama ?>"><?= $sk->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md 6">
                    <div class="form-group">
                        <label for="top">TOP &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="top" id="top" maxlength="50" placeholder="top" required />
                    </div>
                    <div class="form-group">
                        <label for="kreditlimit">Kredit Limit &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="kreditlimit" id="kreditlimit" style="text-align:right" maxlength="50" placeholder="kreditlimit" required />
                    </div>

                    <div class="form-group">
                        <label for="pkp">PKP &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input type="radio" name="pkp" id="pkp" value="true" required /> Ya
                        &emsp;&emsp;
                        <input type="radio" name="pkp" id="pkp" value="false" required /> Tidak
                    </div>

                    <div class="form-group">
                        <label for="npwp">NPWP &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="npwp" id="npwp" maxlength="50" placeholder="NPWP" required />
                    </div>

                    <div class="form-group">
                        <label for="namanpwp">Nama NPWP &emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="namanpwp" id="namanpwp" maxlength="50" placeholder="Nama NPWP" required />
                    </div>

                    <div class="form-group">
                        <label for="alamatnpwp">Alamat NPWP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <textarea name="alamatnpwp" id="alamatnpwp" class="form-control"></textarea>
                        <!-- <input class="form-control" type="text" name="alamat" maxlength="50" placeholder="alamat" required/> -->
                    </div>

                    <div class="form-group">
                        <label for="nama">Kategori &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; :</label><br />
                        <select name="kategoricustomer" class="form-single" id="kategoricustomer">
                            <option value="-">- Pilih Kategori -</option>
                            <option value="1">Workshop</option>
                            <option value="2">End User</option>
                            <option value="3">Reseller</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="aktif">Data Customer Aktif ? &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input type="radio" name="aktif" id="aktif" value=true required /> Ya
                        &emsp;&emsp;
                        <input type="radio" name="aktif" id="aktif" value=false required /> Tidak
                    </div>


                </div>
            </div>




            <div class="card-body">
                <div class="form-group">
                    <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                    <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                    <button id="find" class="btn  btn-success"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                    <button id="export" class="btn  btn-danger"><i class="fa fa-file"></i>&nbsp; Export</button>
                </div>
            </div>



            <!-- lookup kategori -->
            <div id="tablesearchtampil" class="popup1">
                <center>
                    <!-- <div class="pre-scrollable"> -->
                    <div class="popupsearch">
                        <div class="pre-scrollable">
                            <h3 align="center">Pencarian Kode Pos</h3>
                            <div class="table-responsive">
                                <table id="tablesearchkodepos" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10"></th>
                                            <th width="25">Kode</th>
                                            <th width="50">Kelurahan</th>
                                            <th width="50">Kecamatan</th>
                                            <th width="50">Kota</th>
                                            <th width="50">Provinsi</th>
                                            <th width="50">Kode Pos</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="button">
                                    <button id="closesearchkodepos" class="btn btn-dark1">Close</button>
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
                            <h3 align="center">Pencarian Customer</h3>
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10"></th>
                                            <th width="25">nomor</th>
                                            <th width="50">Nama</th>
                                            <th width="50">Alamat</th>
                                            <th width="50">No Telp</th>
                                            <th width="50">No HP</th>
                                            <th width="50">Email</th>
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