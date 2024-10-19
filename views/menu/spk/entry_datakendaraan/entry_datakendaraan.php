<?php
$jeniscustomer = $this->db->query('select * from glbm_jeniscustomer where aktif = true')->result();
?>
<div class="breadcrumb">
    <h1>Entry Data Kendaraan</h1>
</div>
<span style="color: red; font-size: 10; font-weight: normal">Suggest : jika nopolisi dan customer diganti, maka ganti nopolisi terlebih dahulu kemudian ganti customer.</span>
<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                    <input class="form-control" type="hidden" name="kodegrupcabang" id="kodegrupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />
                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nopolisi">Nomor Polisi</label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nomor Polisi" maxlength="50" required />
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="carinopol" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findnopol">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tahun">Tahun / Transmisi</label>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="tahun" id="tahun" placeholder="Tahun Pembuatan" maxlength="150" required />
                                </div>

                                <div class="col-sm-4 form-group">
                                    <select name="transmisi" class="form-control" id="transmisi">
                                        <option value="-">- Pilih Transmisi -</option>
                                        <option value="0">AT</option>
                                        <option value="1">MT</option>
                                        <option value="2">CVT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="norangka">No Rangka</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="norangka" id="norangka" placeholder="No Rangka" maxlength="150" required />
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nomesin">No Mesin</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="nomesin" id="nomesin" placeholder="Nomor Mesin" maxlength="150" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode_tipe">Tipe</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kode_tipe" id="kode_tipe" placeholder="Kode" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe" maxlength="250" readonly required />
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="caritipe" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findtipe">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="warna">Warna</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kodewarna" id="kodewarna" placeholder="Kode" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="namawarna" id="namawarna" placeholder="Nama Warna" maxlength="250" readonly required />
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="cariwarna" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findwarna">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode_kategori">Kategori</label>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="kode_kategori" id="kode_kategori" placeholder="Kode Kategori" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" placeholder="Nama Kategori" maxlength="250" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="jenismobil">Tipe/Model</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="jenismobil" id="jenismobil" placeholder="Tipe / Model Kendaraan" maxlength="100" required />
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nohp">No. HP</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="nohp" id="nohp" placeholder="No. HP" maxlength="250" required/>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nocustomer">No Customer</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Kode" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-3 form-group">
                                    <select name="jeniscustomer" class="form-control" id="jeniscustomer">
                                        <option value="-">- Pilih Title -</option>
                                        <option value="1">Mr</option>
                                        <option value="2">Mrs</option>
                                        <option value="3">Ms</option>
                                        <option value="4">Company</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <button id="newcust" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="pic">PIC</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="pic" id="pic" placeholder="PIC" maxlength="250" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nocustomer">Nama Cust</label>
                                <div class="col-sm-7 form-group">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" required />
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="caricustomer" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findcustomer">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nohppic">No. HP PIC</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="nohppic" id="nohppic" placeholder="No. HP PIC" maxlength="250" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                                <div class="col-sm-8 form-group">
                                    <textarea name="alamat" id="alamat" class="form-control" maxlength="250" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="statuskendaraan">Jenis Customer
									<span style="color: red; font-size: 10; font-weight: normal">*</span></label>
								<div class="col-sm-8 form-group">
									<select name="jeniscustomer2" class="form-control" id="jeniscustomer2">
										<option value="">- Jenis Customer -</option>
										<?php foreach ($jeniscustomer as $sk) : ?>
											<option value="<?= $sk->nama ?>"><?= $sk->nama ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kelurahan">Kel/Kec</label>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="kelurahan" id="kelurahan" placeholder="Kelurahan" maxlength="150" readonly required />
                                    <input class="form-control" type="hidden" name="kodekelurahan" id="kodekelurahan" placeholder="Kelurahan" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kecamatan" id="kecamatan" placeholder="Kecamatan" maxlength="250" readonly required />
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="carikodepos" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpos">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="npwp">NPWP</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="npwp" id="npwp" placeholder="00.000.000.0-000.000" maxlength="250" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kota">Kota/Provinsi</label>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="kota" id="kota" placeholder="Kota" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="provinsi" id="provinsi" placeholder="Provinsi" maxlength="250" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="email">Email</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="email" id="email" placeholder="Email" maxlength="250" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kodepos">Kode Pos</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="kodepos" id="kodepos" placeholder="Kode Pos" maxlength="250" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="odemeter">KM Akhir</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="odemeter" id="odemeter" placeholder="KM Akhir" maxlength="250" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nohp">No HP</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="nohp" id="nohp" placeholder="No HP" maxlength="250" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="table-responsive">
                                    <div style="height:200px;">
                                        <table class="table table-bordered table-striped" id="detailspk">
                                            <tr>
                                                <th style="display:none;"></th>
                                                <th></th>
                                                <th>Nomor WO</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Jenis WO</th>
                                                <th>SA</th>
                                                <th>Status WO</th>
                                                <th>Keluhan</th>
                                                <th>Odmeter</th>
                                            </tr>
                                            <tbody id="detaildataspk"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <button id="new" class="btn  btn-success"><i class="fa fa-pen"></i>&nbsp; NEW</button>
                    <button id="save" class="btn  btn-success"><i class="fa fa-check"></i>&nbsp;SAVE</button>
                    <button id="estimasiwo" class="btn  btn-danger"><i class="fa fa-search"></i>&nbsp;ESTIMASI WO</button>
                    <button id="entrywo" class="btn  btn-success"><i class="fa fa-search"></i>&nbsp;ENTRY WO</button>
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                    <!-- <button id="history" class="btn btn-danger" data-toggle="modal" data-target="#findhistory"><i class="fa fa-times"></i>&nbsp; HISTORY</button> -->
                    <button id="cetakhistory" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; HISTORY</button>
                    <button id="gantinopol" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; GANTI NO POLISI</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findnopol">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchnopol" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="150">No Polisi</th>
                                <th width="150">No Rangka</th>
                                <th width="150">No Mesin</th>
                                <th width="150">Nama Customer</th>
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

<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findtipe">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Tipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchtipe" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Kode</th>
                                <th width="150">Nama</th>
                                <th width="20">Kode Kategori</th>
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

<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header" style="padding: 10px; color: #000;">
                <h7 class="modal-title" style="margin-left: 5px;">Data Customer</h7>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchcustomer" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="150">Nama</th>
                                <th width="150">Alamat</th>
                                <th width="20">No. HP</th>
                                <th width="20">Email</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findwarna">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Warna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchwarna" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Kode</th>
                                <th width="150">Nama</th>
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

<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpos">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Kode Pos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchpos" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Kode</th>
                                <th width="150">Kelurahan</th>
                                <th width="150">Kecamatan</th>
                                <th width="150">Kota</th>
                                <th width="150">Provinsi</th>
                                <th width="150">Kode Pos</th>
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

<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findhistory">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">HISTORY WO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchspk" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="25">Nomor WO</th>
                                <th width="25">Nomor Polisi</th>
                                <th width="25">Nomor Rangka</th>
                                <th width="150">Nama</th>
                                <th width="150">Keluhan</th>
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

<!-- SARAN MODAL -->
<div class="span4" data-toggle="modal" data-target="#tampilsaran" data-backdrop="static" data-keyboard="false" id="munculpesan"></div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="tampilsaran">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SARAN SEBELUMNYA</h5>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="saranservice"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="closesaranservice">Close</button>
            </div>
        </div>
    </div>
</div>