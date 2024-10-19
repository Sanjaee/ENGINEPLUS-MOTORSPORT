<div class="breadcrumb">
    <h1>Entry Invoice</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row ">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nomor">Nomor Faktur </label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="nomor" id="nomor" maxlength="50" readonly required />
                                    <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="subcabang" id="subcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                                    <input class="form-control" type="hidden" name="mgrup" id="mgrup" value="<?php echo $this->session->userdata('mygrup') ?>" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="tanggal" id="tanggal" maxlength="50" value="<?php echo date("d-m-Y"); ?>" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nomorspk">Nomor WO </label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="nomorspk" id="nomorspk" maxlength="50" placeholder="Nomor WO" readonly required />
                                </div>
                                <div class="form-group">
                                    <button id="carispk" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findwo">
                                        <i class="fa fa-search"></i>
                                    </button>
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
                                <label class="col-sm-2 col-form-label" for="nopolisi">No Polisi </label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="nopolisi" id="nopolisi" maxlength="50" placeholder="Nomor Polisi" readonly required />
                                </div>
                                <!-- <div class="form-group">
                                    <button data-toggle="modal" data-target=".nomorsn" id="carisn" class="btn-search btn-primary btn-block">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode_tipe">Tipe</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kode_tipe" id="kode_tipe" placeholder="Kode" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe" maxlength="250" readonly required />
                                </div>
                                &nbsp;&nbsp;
                                <!-- <div class="form-group">
                                    <button data-toggle="modal" data-target=".tipe" id="caritipe"  class="btn-search btn-primary btn-block">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nocustomer">Customer</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Nomor Customer" maxlength="150" readonly required />
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input class="form-control" type="text" name="namacustomer" id="namacustomer" placeholder="Nama Customer" maxlength="250" readonly required />
                                </div>
                                <input type="checkbox" id="billto" name="billto" value="true">&nbsp;
                                <div class="form-group">
                                    <button id="caricust" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#namacust">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode_kategori">Kategori</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kode_kategori" id="kode_kategori" maxlength="50" placeholder="Kode Kategori" readonly required />
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" maxlength="50" placeholder="Nama Kategori" readonly required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="keluhan">Keluhan</label>
                                <div class="col-sm-8 form-group">
                                    <textarea name="keluhan" id="keluhan" class="form-control" placeholder="Keluhan .." readonly required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="teknisi">Teknisi</label>
                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="kode_teknisi" id="kode_teknisi" maxlength="50" placeholder="Kode Teknisi" readonly required />
                                </div>
                                <div class="col-sm-5 form-group">
                                    <input class="form-control" type="text" name="nama_teknisi" id="nama_teknisi" maxlength="50" placeholder="Nama Teknisi" readonly required />
                                </div>
                                &nbsp;&nbsp;
                                <!-- <div class="form-group">
                                    <button data-toggle="modal" data-target=".nama_teknisi" id="cariteknisi"  class="btn-search btn-primary btn-block">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="uangmuka">Uang Muka</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" type="text" name="uangmuka" id="uangmuka" maxlength="50" placeholder="uang muka" style="text-align:right" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tgl Jt Tempo</label>
                                <div class="col-md-8">
                                    <div class="input-group date" id="tgltempo">
                                        <input type="text" class="form-control" id="tgljttempo" width="200" readonly>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text btn-primary">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode">Kode Sparepart / Jasa</label>
                                <div class="col-sm-2 form-group">
                                    <input class="form-control" type="text" name="kode" id="kode" maxlength="60" placeholder="Kode" readonly required />
                                    <input class="form-control" type="hidden" name="noreferensi" id="noreferensi" maxlength="50" placeholder="noreferensi" readonly required />
                                </div>

                                <div class="col-sm-3 form-group">
                                    <input class="form-control" type="text" name="nama" id="nama" maxlength="50" placeholder="Nama" required />
                                </div>
                                <div class="col-sm-1 form-group">
                                    <button id="caritask" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#carijasa">
                                        <i class="fa fa-search"></i>
                                    </button>

                                </div>

                                <div class="col-sm-1 form-group">
                                    <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                </div>

                            </div>
                        </div>
                    </div> -->



                    <div class="col-md-4">
                        <!-- <div class="form-group row"> -->
                        <span style="color: red; font-size: 10; font-weight: bold; margin-left:auto">Note : Faktur hanya dapat menambahkan pekerjaan.</span>
                        <!-- </div> -->
                    </div><br>



                    <!-- TAB -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="nav nav-tabs nav-justified" id="myTabx" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="summary-basic-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">Summary</a></li>
                                <li class="nav-item"><a class="nav-link" id="sparepart-basic-tab" data-toggle="tab" href="#sparepartx" role="tab" aria-controls="sparepart" aria-selected="false">Sparepart</a></li>
                                <li class="nav-item"><a class="nav-link" id="jasa-basic-tab" data-toggle="tab" href="#jasa" role="tab" aria-controls="jasa" aria-selected="false">Jasa</a></li>
                                <li class="nav-item"><a class="nav-link" id="pekerjaan-basic-tab" data-toggle="tab" href="#pekerjaan" role="tab" aria-controls="pekerjaan" aria-selected="false">Pekerjaan Luar</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" id="bahan-basic-tab" data-toggle="tab" href="#bahanx" role="tab" aria-controls="bahan" aria-selected="false">Bahan</a></li> -->
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-basic-tab" style="visibility: visible;">
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-md-12 col-sm-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="summarytotal_sparepart">Total Sparepart</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="summarytotal_sparepart" id="summarytotal_sparepart" style="text-align:right;" maxlength="50" value="0" readonly required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="dpp">DPP</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="dpp" id="dpp" maxlength="50" value="0" style="text-align:right;" readonly required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="summarytotal_jasa">Total Jasa</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="summarytotal_jasa" id="summarytotal_jasa" style="text-align:right;" maxlength="50" value="0" readonly required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label" for="ppn">PPN</label>
                                                        <div class="col-sm-8 form-group">
                                                            <input class="form-control" type="text" name="ppn" id="ppn" maxlength="50" style="text-align:right;" value="0" readonly required />
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
                                                            <input class="form-control" type="text" name="grandtotal" id="grandtotal" style="text-align:right;" maxlength="50" value="0" readonly required />
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
                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="nama_part" id="nama_part" placeholder="Nama Part" maxlength="250" readonly required />
                                                </div>
                                                <!-- <div class="col-sm-1 form-group"> -->
                                                <!-- <button id="cariparts" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpart"><i class="fa fa-search"></i></button> -->
                                                <!-- <button id="caritask" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findtask"><i class="fa fa-search"></i></button>
                                                    <button id="cariopl" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findopl"><i class="fa fa-search"></i></button> -->
                                                <!-- </div> -->
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
                                        <div class="col-md-5">
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
                                                <label class="col-sm-3 col-form-label" for="persendisc">PersenDisc / Discount</label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="persen_part" id="persen_part" placeholder="Persen Disc" maxlength="250" style="text-align:right" required />
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="discount_part" id="discount_part" placeholder="Discount" maxlength="250" style="text-align:right" required />
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
                                                    <button id="remove_part" class="btn btn-danger">
                                                        <i class="fa fa-frown"></i>
                                                        <b> Remove</b>
                                                    </button>
                                                </div>
                                                <div class="col-md-2 col-lg-1 form-group">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-1">
                            <div class="form-group">
                                <button id="add_detail" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Add</button>
                                <button id="edit_detail" class="btn btn-new"><i class="fa fa-edit"></i> &nbsp;Edit</button>
                            </div>
                        </div> -->

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
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                                <th>Persendisc</th>
                                                                <th>Discount</th>
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
                                                    <input class="form-control" type="text" name="nama_jasa" id="nama_jasa" placeholder="Nama jasa" maxlength="250" readonly required />
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <!-- <button id="carijasas" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findpart"><i class="fa fa-search"></i></button> -->
                                                    <button id="caritask" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#carijasa"><i class="fa fa-search"></i></button>
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
                                                    <input class="form-control" type="hidden" name="kodejenisdetail_jasa" id="kodejenisdetail_jasa" placeholder="" maxlength="250" style="text-align:left" readonly required />
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

                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <!-- <label class="col-sm-3 col-form-label" for="harga">Harga</label> -->
                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="harga_jasa" id="harga_jasa" placeholder="Harga" maxlength="250" style="text-align:right" readonly required />
                                                    <input class="form-control" type="hidden" name="totaljasa" id="totaljasa" placeholder="kategori" maxlength="250" style="text-align:left" readonly required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="persendisc">PersenDisc / Discount</label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="persen_jasa" id="persen_jasa" placeholder="Persen Disc" maxlength="250" style="text-align:right" required />
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="discount_jasa" id="discount_jasa" placeholder="Discount" maxlength="250" style="text-align:right" required />
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
                                                                <th hidden>Jenis</th>
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                                <th>Persendisc</th>
                                                                <th>Discount</th>
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
                                                <div class="col-sm-5 form-group">
                                                    <input class="form-control" type="text" name="nama_opl" id="nama_opl" placeholder="Nama OPL" maxlength="250" readonly required />
                                                </div>
                                                <!-- <div class="col-sm-1 form-group">
                                                    <button id="cariopl" class="btn-search btn-primary btn-block" data-toggle="modal" data-target="#findopl"><i class="fa fa-search"></i></button>
                                                </div> -->
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

                                        <div class="col-md-5">
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
                                                <label class="col-sm-3 col-form-label" for="persendisc">PersenDisc / Discount</label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" type="text" name="persen_opl" id="persen_opl" placeholder="Persen Disc" maxlength="250" style="text-align:right" required />
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <input class="form-control" type="text" name="discount_opl" id="discount_opl" placeholder="Discount" maxlength="250" style="text-align:right" required />
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
                                                                <th>Qty</th>
                                                                <th>Harga</th>
                                                                <th>Persendisc</th>
                                                                <th>Discount</th>
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

                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button id="new" class="btn btn-success"><i class="fa fa-retweet"></i> &nbsp;NEW</button>
                            <button id="save" class="btn btn-success"><i class="fa fa-save"></i> &nbsp;SAVE</button>
                            <button id="loading" class="btn" style="background-color:grey;"><img src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading" />Loading</button>
                            <button id="find" class="btn btn-success" data-toggle="modal" data-target="#findfaktur"><i class="fa fa-search"></i> &nbsp;FIND</button>
                            <button id="cancel" class="btn btn-danger" disabled><i class="fa fa-window-close"></i> &nbsp;CANCEL</button>
                            <button id="cetak" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;CETAK</button>
                            <button id="excel" class="btn btn-success"><i class="fa fa-print"></i> &nbsp;Export Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Find Data -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findwo">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data WO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchspk" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="150">Nomor WO</th>
                                        <th width="150">Nomor Polisi</th>
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

        <!-- Find Data -->
        <div id="tablesearchtampil" class="popup2">
            <center>
                <!-- <div class="pre-scrollable"> -->
                <div class="popupsearch">
                    <div class="pre-scrollable">
                        <h3 align="center">DATA PARTS</h3>
                        <div class="table-responsive">
                            <table id="tablesearchparts" class="table table-bordered table-striped display nowrap">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="25">Kode</th>
                                        <th width="150">Nama</th>
                                    </tr>
                                </thead>
                            </table>
                            <div id="button">
                                <button id="closesearchparts" class="btn btn-dark1">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>



        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="carijasa">
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
                                        <th width="150">Harga</th>
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


        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findfaktur">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Faktur</h5>
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
                                        <th width="150">Nomor WO</th>
                                        <th width="150">Nomor Customer</th>
                                        <!--th width="150">Grand_Total</th-->
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

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="namacust">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablesearchcust" class="table table-bordered table-striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="25">Nomor</th>
                                        <th width="150">Nama Customer</th>
                                        <th width="150">Alamat</th>
                                        <th width="150">No HP</th>
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
    </div>