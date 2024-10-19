<div class="breadcrumb">
    <h1>Estimasi WO</h1>
</div>

<div class="separator-breadcrumb border-top"></div>


<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <?php if ($this->session->flashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nomor">No Estimasi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" readonly srequired />
                                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="tanggal" id="tanggal" maxlength="50" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nopolisi">NoPol/Noka
                                </label>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nomor Polisi" maxlength="50" value="<?php printf(urldecode($nopol)); ?>" readonly required />
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="norangka" id="norangka" placeholder="Nomor Rangka" maxlength="50" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="warranty">Warranty</label>
                                <br>
                                <div class="col-sm-6 form-group">
                                    <label class="radio radio-success">
                                        <input type="radio" name="warranty" id="warranty" value="true"><span> YA</span><span class="checkmark"></span>
                                    </label>
                                    &emsp;&emsp;&emsp;
                                    <label class="radio radio-danger">
                                        <input type="radio" name="warranty" id="nonwarranty" value="false"><span> TIDAK</span><span class="checkmark"></span>
                                    </label>
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
                                    <input class="form-control" type="hidden" name="model" id="model" placeholder="Kode" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <input class="form-control" type="text" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe" maxlength="250" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="returnjob">Return Job</label>
                                <br>
                                <div class="col-sm-6 form-group">
                                    <label class="radio radio-success">
                                        <input type="radio" name="returnjob" id="returnjob" value="true"><span> YA</span><span class="checkmark"></span>
                                    </label>
                                    &emsp;&emsp;&emsp;
                                    <label class="radio radio-danger">
                                        <input type="radio" name="returnjob" id="nonreturnjob" value="false"><span> TIDAK</span><span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nocustomer">Nama</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Kode" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="inventaris">Inventaris</label>
                                <br>
                                <div class="col-sm-6 form-group">
                                    <label class="radio radio-success">
                                        <input type="radio" name="inventaris" id="inventaris" value="true"><span> YA</span><span class="checkmark"></span>
                                    </label>
                                    &emsp;&emsp;&emsp;
                                    <label class="radio radio-danger">
                                        <input type="radio" name="inventaris" id="noninventaris" value="false"><span> TIDAK</span><span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="keluhan">Keluhan
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                <div class="col-sm-9 form-group">
                                    <textarea name="keluhan" id="keluhan" class="form-control" maxlength="250" placeholder="Keluhan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="pic">PIC
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="pic" id="pic" placeholder="PIC" maxlength="250" required readonly />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="jenis">Jenis / KM
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                <div class="col-sm-5 form-group">
                                    <select name="jenis" class="form-control" id="jenis">
                                        <option value="-">- Pilih Jenis -</option>
                                        <option value="0">Service Berkala Int</option>
                                        <option value="1">Service Berkala Ext</option>
                                        <option value="2">General Repair</option>
                                        <option value="3">Express Maintenance</option>
                                        <option value="4">Custom</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="odemeter" id="odemeter" placeholder="odemeter" maxlength="250" required readonly />
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nohp">No. HP
                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="nohp" id="nohp" placeholder="No. HP" maxlength="250" required readonly />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="regular">Regular Check</label>
                                <!-- <span style="color: red; font-size: 10; font-weight: normal">*</span></label> -->
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="koderegular" id="koderegular" placeholder="Kode" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <input class="form-control" type="text" name="namaregular" id="namaregular" placeholder="Nama Paket Perawatan" maxlength="250" readonly required />
                                </div>
                                <div class="col-sm-1.5 form-group">
                                    <button id="cariregular" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findregular">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="nav nav-tabs nav-justified" id="myTabx" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="summary-basic-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">Summary</a></li>
                                <li class="nav-item"><a class="nav-link" id="sparepart-basic-tab" data-toggle="tab" href="#sparepartx" role="tab" aria-controls="sparepart" aria-selected="false">Sparepart</a></li>
                                <li class="nav-item"><a class="nav-link" id="jasa-basic-tab" data-toggle="tab" href="#jasa" role="tab" aria-controls="jasa" aria-selected="false">Jasa</a></li>
                                <li class="nav-item"><a class="nav-link" id="pekerjaan-basic-tab" data-toggle="tab" href="#pekerjaan" role="tab" aria-controls="pekerjaan" aria-selected="false">Pekerjaan Luar</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" id="bahan-basic-tab" data-toggle="tab" href="#bahanx" role="tab" aria-controls="bahan" aria-selected="false">Bahan</a></li> -->
                            </ul>
                            <br>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-basic-tab" style="visibility: visible;">
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-md-12 col-sm-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="summarytotal_sparepart">Total Sparepart</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="summarytotal_sparepart" id="summarytotal_sparepart" maxlength="50" value="0" readonly required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="dpp">DPP</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="dpp" id="dpp" maxlength="50" value="0" readonly required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="summarytotal_jasa">Total Jasa</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="summarytotal_jasa" id="summarytotal_jasa" maxlength="50" value="0" readonly required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="ppn">PPN</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="ppn" id="ppn" maxlength="50" value="0" readonly required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="keterangan">Keterangan</label>
                                                        <div class="col-sm-8 form-group">
                                                            <textarea name="keterangan" id="keterangan" class="form-control" maxlength="250" placeholder="Keterangan"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="grandtotal">Grand Total</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="grandtotal" id="grandtotal" maxlength="50" value="0" readonly required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- SPARE PARTS -->
                                <div class="tab-pane fade" id="sparepartx" role="tabpanel" aria-labelledby="sparepart-basic-tab" style="visibility: visible;">
                                    <!-- <div class="tab-pane fade" id="sparepart" role="tabpanel" aria-labelledby="sparepart-basic-tab"> -->

                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="kode_part">Kode Sparepart</label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="kode_part" id="kode_part" placeholder="Kode Part" maxlength="150" readonly required />
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="nama_part" id="nama_part" placeholder="Nama Part" maxlength="250" required />
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <button id="cariparts" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpart"><i class="fa fa-search"></i></button>
                                                    <!-- <button id="caritask" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findtask"><i class="fa fa-search"></i></button>
                                                    <button id="cariopl" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findopl"><i class="fa fa-search"></i></button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="jenisdetailx">Kategori / Detail
                                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="jenisdetail_part" id="jenisdetail_part" placeholder="kategori" maxlength="250" style="text-align:left" readonly required />
                                                </div>

                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="detailkategori_part" id="detailkategori_part" placeholder="Detail Kategori" maxlength="150" style="text-align:left" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label" for="qty">Qty / Harga
                                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                                <div class="col-sm-6 form-group">
                                                    <input class="form-control" type="text" name="qty_part" id="qty_part" placeholder="Qty" maxlength="250" style="text-align:right" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 form-group">
                                            <input class="form-control" type="text" name="satuan_part" id="satuan_part" placeholder="satuan" maxlength="250" readonly required />
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <!-- <label class="col-sm-3 col-form-label" for="harga">Harga</label> -->
                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="harga_part" id="harga_part" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="total">Total</label>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="total_part" id="total_part" placeholder="Total" maxlength="250" style="text-align:right" required />
                                                </div>
                                                <div class="form-group">
                                                    <button id="add_detailpart" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                                    <!-- <button id="new_detailpart" class="btn btn-primary"><i class="fa fa-refresh"></i> &nbsp;New</button> -->
                                                    <button id="remove_part" class="btn btn-danger">
                                                        <i class="fa fa-frown"></i>
                                                        <b> Remove</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-1">
                            <div class="form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                <button id="edit_detail" class="btn btn-new"><i class="fa fa-edit"></i> &nbsp;Edit</button>
                            </div>
                        </div> -->
                                    </div>

                                    <section class="table my-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="table-responsive">
                                                        <!-- <table class="table table-bordered table-striped display nowrap" id="detailspk"> -->
                                                        <table class="table table-bordered table-striped display nowrap" id="detailsparepart">
                                                            <tr>
                                                                <th style="display:none;"></th>
                                                                <th>Kode</th>
                                                                <th>Nama</th>
                                                                <th>Kategori</th>
                                                                <th>Jenis</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                                <th>Subtotal</th>
                                                                <th width="100px"></th>
                                                            </tr>
                                                            <tbody id="detaildatasparepart"></tbody>
                                                            <!-- <tbody id="detaildataspk"></tbody> -->
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="total_sparepart">Total Sparepart</label>
                                            <div class="col-sm-5 form-group">
                                                <input class="form-control" type="text" name="total_sparepart" id="total_sparepart" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- JASA -->
                                <div class="tab-pane fade" id="jasa" role="tabpanel" aria-labelledby="jasa-basic-tab" style="visibility: visible;">
                                    <!-- <div class="tab-pane fade" id="sparepart" role="tabpanel" aria-labelledby="sparepart-basic-tab"> -->

                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="kode_jasa">Jasa</label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="kode_jasa" id="kode_jasa" placeholder="Kode jasa" maxlength="150" readonly required />
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="nama_jasa" id="nama_jasa" placeholder="Nama jasa" maxlength="250" required />
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <!-- <button id="carijasas" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpart"><i class="fa fa-search"></i></button> -->
                                                    <button id="caritask" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findtask"><i class="fa fa-search"></i></button>
                                                    <!-- <button id="cariopl" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findopl"><i class="fa fa-search"></i></button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="jenisdetailjasa">Kategori / Detail
                                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="jenisdetail_jasa" id="jenisdetail_jasa" placeholder="kategori" maxlength="250" style="text-align:left" readonly required />
                                                </div>

                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="detailkategori_jasa" id="detailkategori_jasa" placeholder="Detail Kategori" maxlength="150" style="text-align:left" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label" for="qty">Qty / Harga
                                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                                <div class="col-sm-6 form-group">
                                                    <input class="form-control" type="text" name="qty_jasa" id="qty_jasa" placeholder="Qty" maxlength="250" style="text-align:right" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <!-- <label class="col-sm-3 col-form-label" for="harga">Harga</label> -->
                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="harga_jasa" id="harga_jasa" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="total">Total</label>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="total_jasa" id="total_jasa" placeholder="Total" maxlength="250" style="text-align:right" required />
                                                </div>
                                                <div class="form-group">
                                                    <button id="add_detailjasa" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                                    <button id="remove_jasa" class="btn btn-danger">
                                                        <i class="fa fa-frown"></i>
                                                        <b> Remove</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-1">
                            <div class="form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                <button id="edit_detail" class="btn btn-new"><i class="fa fa-edit"></i> &nbsp;Edit</button>
                            </div>
                        </div> -->
                                    </div>

                                    <section class="table my-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="table-responsive">
                                                        <!-- <table class="table table-bordered table-striped display nowrap" id="detailspk"> -->
                                                        <table class="table table-bordered table-striped display nowrap" id="detailjasa">
                                                            <tr>
                                                                <th style="display:none;"></th>
                                                                <th>Kode</th>
                                                                <th>Nama</th>
                                                                <th>Kategori</th>
                                                                <th>Jenis</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                                <th>Subtotal</th>
                                                                <th width="100px"></th>
                                                            </tr>
                                                            <tbody id="detaildatajasa"></tbody>
                                                            <!-- <tbody id="detaildataspk"></tbody> -->
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="total_jasaa">Total Jasa</label>
                                            <div class="col-sm-5 form-group">
                                                <input class="form-control" type="text" name="total_jasaa" id="total_jasaa" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- OPL -->
                                <div class="tab-pane fade" id="pekerjaan" role="tabpanel" aria-labelledby="pekerjaan-basic-tab" style="visibility: visible;">
                                    <!-- <div class="tab-pane fade" id="sparepart" role="tabpanel" aria-labelledby="sparepart-basic-tab"> -->

                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="kode_opl">OPL</label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="kode_opl" id="kode_opl" placeholder="Kode OPL" maxlength="150" readonly required />
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="nama_opl" id="nama_opl" placeholder="Nama OPL" maxlength="250" required />
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <button id="cariopl" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findopl"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="jenisdetailopl">Kategori / Detail
                                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="jenisdetail_opl" id="jenisdetail_opl" placeholder="kategori" maxlength="250" style="text-align:left" readonly required />
                                                </div>

                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="detailkategori_opl" id="detailkategori_opl" placeholder="Detail Kategori" maxlength="150" style="text-align:left" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label" for="qty">Qty / Harga
                                                    <span style="color: red; font-size: 10; font-weight: normal">*</span></label>
                                                <div class="col-sm-6 form-group">
                                                    <input class="form-control" type="text" name="qty_opl" id="qty_opl" placeholder="Qty" maxlength="250" style="text-align:right" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <!-- <label class="col-sm-3 col-form-label" for="harga">Harga</label> -->
                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="harga_opl" id="harga_opl" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="total">Total</label>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="total_opl" id="total_opl" placeholder="Total" maxlength="250" style="text-align:right" required />
                                                </div>
                                                <div class="form-group">
                                                    <button id="add_detailopl" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                                    <button id="remove_opl" class="btn btn-danger">
                                                        <i class="fa fa-frown"></i>
                                                        <b> Remove</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-1">
                            <div class="form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                <button id="edit_detail" class="btn btn-new"><i class="fa fa-edit"></i> &nbsp;Edit</button>
                            </div>
                        </div> -->
                                    </div>

                                    <section class="table my-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="table-responsive">
                                                        <!-- <table class="table table-bordered table-striped display nowrap" id="detailspk"> -->
                                                        <table class="table table-bordered table-striped display nowrap" id="detailopl">
                                                            <tr>
                                                                <th style="display:none;"></th>
                                                                <th>Kode</th>
                                                                <th>Nama</th>
                                                                <th>Kategori</th>
                                                                <th>Jenis</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                                <th>Subtotal</th>
                                                                <th width="100px"></th>
                                                            </tr>
                                                            <tbody id="detaildataopl"></tbody>
                                                            <!-- <tbody id="detaildataspk"></tbody> -->
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="totall_opl">Total OPL</label>
                                            <div class="col-sm-5 form-group">
                                                <input class="form-control" type="text" name="totall_opl" id="totall_opl" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <br><br>
                    <br>

                    <hr>

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
                    <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                    <button id="find" class="btn  btn-success" data-toggle="modal" data-target="#findwo"><i class="fa fa-search"></i>&nbsp;FIND</button>
                    <button id="update" class="btn  btn-success"><i class="fa fa-pencil-square-o"></i>&nbsp; UPDATE</button>
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-pencil-square-o"></i>&nbsp; CANCEL</button>
                    <button id="close" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; CLOSE</button>
                    <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                    <button id="history" class="btn btn-danger" data-toggle="modal" data-target="#findhistory"><i class="fa fa-times"></i>&nbsp; HISTORY</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Find Data -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpart">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Parts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchparts" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Action</th>
                                <th width="50">Kode</th>
                                <th width="150">Nama</th>
                                <th width="50">Harga Jual</th>
                                <th width="50">Qty Stock</th>
                                <th width="50">Lokasi</th>
                                <th width="50">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findtask">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Tasklist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchtask" class="table table-bordered table-striped display nowrap" style="width:100%">
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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findwo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Estimasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearch" class="table table-bordered table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="25">Nomor</th>
                                <th width="150">No Polisi</th>
                                <th width="150">No Rangka</th>
                                <th width="150">Nomor Customer</th>
                                <th width="150">Tipe</th>
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
                    <table id="tablesearchspk" class="table table-bordered table-striped display nowrap" style="width:100%">
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findopl">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data OPL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchopl" class="table table-bordered table-striped display nowrap" style="width:100%">
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findregular">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Regular Check</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchregular" class="table table-bordered table-striped display nowrap" style="width:100%">
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