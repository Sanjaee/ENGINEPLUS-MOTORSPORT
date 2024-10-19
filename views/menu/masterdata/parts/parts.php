            <div class="breadcrumb">
                <h1>Spareparts</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <!-- /. ROW  -->
            <div class="row text-left pad-top">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="kode">Kode &nbsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : </label>
                        <input class="form-control" type="text" name="kode" id="kode" maxlength="50" placeholder="Kode" required />
                        <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                        <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="nama" id="nama" maxlength="200" placeholder="Nama" required />
                    </div>

                    <div class="form-group">
                        <label for="hargabeli">Harga Beli &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="hargabeli" id="hargabeli" style="text-align:right" maxlength="50" placeholder="Harga Beli" required />
                    </div>

                    <div class="form-group">
                        <label for="hargajual">Harga Jual &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="hargajual" id="hargajual" style="text-align:right" maxlength="50" placeholder="Harga Jual" required />
                    </div>

                    <div class="form-group">
                        <label for="minstock">Min Stock &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="minstock" id="minstock" style="text-align:right" maxlength="50" placeholder="Minimum Stock" required />
                    </div>

                    <br>
                    <div class="form-group">
                        <label for="aktif">Aktif &emsp;&emsp;&emsp;&emsp; :</label>
                        <input type="radio" name="aktif" id="aktif" value=true required /> Ya
                        &emsp;&emsp;
                        <input type="radio" name="aktif" id="aktif" value=false required /> Tidak
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hargajual">COGS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="cogs" id="cogs" style="text-align:right" maxlength="50" placeholder="COGS" readonly required />
                    </div>

                    <div class="form-group">
                        <label for="jenis_detail">Jenis Detail :</label>
                        <select name="jenis" class="form-control" id="jenis_detail">
                            <option value="0">- Pilih Jenis Detail -</option>
                            <option value="1">INTERNAL ENGINE</option>
                            <option value="2">EXTERNAL ENGINE</option>
                            <option value="3">INTAKE & EXHAUST SYSTEM</option>
                            <option value="4">COOLING SYSTEM</option>
                            <option value="5">FUEL SYSTEM</option>
                            <option value="6">ELECTRICAL</option>
                            <option value="7">AIR CONDITIONER SYSTEM</option>
                            <option value="8">STEERING & WHEEL</option>
                            <option value="9">TRANSMISI</option>
                            <option value="10">BRAKE SYSTEM</option>
                            <option value="11">UNDERCARRIAGE</option>
                            <option value="12">OIL & CHEMICAL</option>
                            <option value="13">BODY PART</option>
                            <option value="14">HOSE</option>
                            <option value="15">CLAMP</option>
                            <option value="16">FITTING</option>
                            <option value="17">OTHER</option>
                            <option value="18">SUSPENSION SYSTEM</option>
                            <option value="19">3D PRINTED</option>
                            <option value="20">MERCHANDISE</option>
                            <option value="21">CNC</option>
                            <option value="22">CARBON</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kategoripart">Kategori Part :</label>
                        <select name="kategoripart" class="form-control" id="kategoripart">
                            <option value="0">- Pilih Kategori -</option>
                            <option value="1">DIXCEL</option>
                            <option value="2">DLL</option>
                            <option value="3">DW</option>
                            <option value="4">E+</option>
                            <option value="5">EDEL</option>
                            <option value="6">FUELTECH</option>
                            <option value="7">HARDRACE</option>
                            <option value="8">HYBRID RACING</option>
                            <option value="9">OEM</option>
                            <option value="10">POWER ENTERPRIZE</option>
                            <option value="11">PRL</option>
                            <option value="12">TURBO GUARD</option>
                            <option value="13">TURBOSMART</option>
                            <option value="14">GUDANG PLUIT</option>
                            <option value="15">OTHER</option>
                            <option value="16">T-SHIRT</option>
                            <option value="17">CNC</option>
                            <option value="18">CARBON</option>
                            <option value="19">MOMO</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="satuan">Satuan :</label>
                        <select name="satuan" class="form-control" id="satuan">
                            <option value="-">- Pilih Satuan -</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Liter">Liter</option>
                            <option value="Botol">Botol</option>
                            <option value="Galon">Galon</option>
                            <option value="Meter">Meter</option>
                            <option value="Set">Set</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Lokasi">Lokasi &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="lokasi" id="lokasi" maxlength="10" placeholder="Lokasi Parts" required />
                    </div>
                    <div class="form-group">
                        <label for="stock">Qty Stock &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="stock" id="stock" maxlength="10" placeholder="0" readonly required />
                    </div>
                    
                    <div class="form-group">
                        <label for="Keterangan">Keterangan &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
                        <input class="form-control" type="text" name="keterangan" id="keterangan" maxlength="100" placeholder="Keterangan Parts" required />
                    </div>
                </div>
                <br>

                <div class="card-body">
                    <div class="form-group">
                        <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                        <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                        <button id="find" class="btn  btn-success"  data-toggle="modal" data-target="#findsparepart"><i class="fa fa-search"></i>&nbsp;FIND</button>
                        <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                        <button id="excel" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; Export Excel</button>
                        <!-- <button id="close" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; CLOSE</button> -->
                    </div>
                </div>

            </div>

            <!-- Find Data -->          

            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findsparepart">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;">Data Sparepart</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tablesearch" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5"></th>
                                            <th width="150">Kode</th>
                                            <th width="100">Nama</th>
                                            <th width="150">Harga Beli</th>
                                            <th width="150">Harga Jual</th>
                                            <th width="150">Qty</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>