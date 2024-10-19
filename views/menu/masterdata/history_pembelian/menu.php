<div class="modal-header" style="padding: 5px;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <h2>
                    <span class="logo-menu"><i class="links_icon fas fa-file-chart-line" style="font-size: 22px;"></i></span>
                    <span class="text-uppercase">HISTORY AP</span>
                </h2>
            </div>
            <div class="col-md-7">
                <div class="form-group" style="float: right;">
                    <button id="query_data" class="btn btn-success mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-save" style="margin-right: 10px;"></i>Query Data</button>
                    <button id="new" class="btn btn-success mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="fa fa-refresh" style="margin-right: 10px;"></i>New</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-3 form-label" for="jenisfaktur">Jenis Faktur</label>
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodesubcabang" id="kodesubcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodegrupcabang" id="kodegrupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />
                                <div class="col-md-8 form-group">
                                    <select name="jenisfaktur" class="form-control" id="jenisfaktur">
                                        <option value="-">-- Pilih Jenis Faktur --</option>
                                        <option value="0">Order Pekerjaan Luar</option>
                                        <option value="1">Pembelian Spareparts</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-3 form-label" for="jenispencairan">Jenis Pencairan</label>
                                <div class="col-md-8 form-group">
                                    <select name="jenispencairan" class="form-control" id="jenispencairan">
                                        <option value="-">-- Pilih Jenis Pencairan --</option>
                                        <option value="0">NOMOR TRANSAKSI</option>
                                        <option value="1">NOMOR ORDER</option>
                                        <option value="2">NAMA SUPPLIER</option>
                                        <option value="3">NOMOR INVOICE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="pencairan">Pencairan</label>
                                <div class="col-md-7 form-group">
                                    <input class="form-control" type="text" name="pencairan" id="pencairan" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="modal-body pre-scrollable" style="height: 550px; border: 1px solid; border-color: #DCDCDC;">
                                    <div class="table-responsive">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="color: black; font-weight: bold;">DATA LIST TRANSAKSI</h5>
                                        </div>
                                        <table class="table table-bordered table-striped" id="detailhistoryar">
                                            <thead>
                                                <tr>
                                                    <th>Nomor Trx</th>
                                                    <th>Tanggal</th>
                                                    <th>Nomor Referensi</th>
                                                    <th>No Polisi</th>
                                                    <th>Nama Customer</th>
                                                    <th>Nama Supplier</th>
                                                    <th>Status</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detaildatahistoryar"></tbody>
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

<!-- DETAIL HISTORY AR -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="finddetailhistoryar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black;">DETAIL HISTORY AP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body pre-scrollable"> -->
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <ul class="nav nav-tabs nav-justified" id="myTabx" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="summary-basic-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">SUMMARY</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="jasa-basic-tab" data-toggle="tab" href="#jasa" role="tab" aria-controls="jasa" aria-selected="false">Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="kasir-basic-tab" data-toggle="tab" href="#kasir" role="tab" aria-controls="kasir" aria-selected="false">KASIR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="history-basic-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">HISTORY</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <!-- SUMMARY -->
                                <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-basic-tab">
                                    <div class="row">
                                        <div class="col-12 col-lg-8 ">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group border px-1 py-1">
                                                            <label class="form-label" for="totalsparepart">Data Transaksi</label>
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="nowo">No WO</label>
                                                                        <div class="col-md-9 form-group">
                                                                            <input class="form-control" type="text" name="nowo" id="nowo" placeholder="No WO" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="tglwo">Tgl WO</label>
                                                                        <div class="col-md-8">
                                                                            <input class="form-control" type="text" name="tglwo" id="tglwo" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="nofaktur">No Transaksi</label>
                                                                        <div class="col-md-9 form-group">
                                                                            <input class="form-control" type="text" name="nofaktur" id="nofaktur" placeholder="No Faktur" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="tglfaktur">Tgl Transaksi</label>
                                                                        <div class="col-md-8">
                                                                            <input class="form-control" type="text" name="tglfaktur" id="tglfaktur" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="namasa">Nama SA</label>
                                                                        <div class="col-md-9 form-group">
                                                                            <input class="form-control" type="text" name="namasa" id="namasa" placeholder="Nama SA" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group border px-1 py-1">
                                                            <label class="form-label" for="totalsparepart">Data Kendaraan</label>
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="nopolisi">No Polisi</label>
                                                                        <div class="col-md-9 form-group">
                                                                            <input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="No Polisi" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-5 col-form-label" for="tahunpembuatan">Tahun</label>
                                                                        <div class="col-md-6">
                                                                            <input class="form-control" type="text" name="tahunpembuatan" id="tahunpembuatan" placeholder="Tahun" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="norangka">No Rangka</label>
                                                                        <div class="col-md-9 form-group">
                                                                            <input class="form-control" type="text" name="norangka" id="norangka" placeholder="No Rangka" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-5 col-form-label" for="transmisi">Transmisi</label>
                                                                        <div class="col-md-6">
                                                                            <input class="form-control" type="text" name="transmisi" id="transmisi" placeholder="Transmisi" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="nomesin">No Mesin</label>
                                                                        <div class="col-md-9 form-group">
                                                                            <input class="form-control" type="text" name="nomesin" id="nomesin" placeholder="No Mesin" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-5 col-form-label" for="odometer">KM Akhir</label>
                                                                        <div class="col-md-6">
                                                                            <input class="form-control" type="text" name="odometer" id="odometer" placeholder="KM Akhir" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label" for="tipekendaraan">Tipe Kendaraan</label>
                                                                        <div class="col-md-10 form-group">
                                                                            <input class="form-control" type="text" name="nama_tipe" id="nama_tipe" placeholder="Nama Tipe" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label" for="warnakendaraan">Warna Kendaraan</label>
                                                                        <div class="col-md-4 form-group">
                                                                            <input class="form-control" type="text" name="kode_warna" id="kode_warna" placeholder="Kode Warna" readonly required>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <input class="form-control" type="text" name="nama_warna" id="nama_warna" placeholder="Nama Warna" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group border px-1 py-1">
                                                            <label class="form-label" for="totalsparepart">Data Supplier</label>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label" for="customer">Nama Supplier</label>
                                                                        <div class="col-md-4 form-group">
                                                                            <input class="form-control" type="text" name="nosupplier" id="nosupplier" placeholder="Nomor Supplier" readonly required>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <input class="form-control" type="text" name="nama_supplier" id="nama_supplier" placeholder="Nama Supplier" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label" for="alamatcustomer">Alamat Supplier</label>
                                                                        <div class="col-md-10 form-group">
                                                                            <input class="form-control" type="text" name="alamat_supplier" id="alamat_supplier" placeholder="Alamat Supplier" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label" for="npwp">NPWP</label>
                                                                        <div class="col-md-10 form-group">
                                                                            <input class="form-control" type="text" name="npwp" id="npwp" placeholder="NPWP" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label" for="nohp">No HP</label>
                                                                        <div class="col-md-10 form-group">
                                                                            <input class="form-control" type="text" name="nohp" id="nohp" placeholder="No HP" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="form-group border px-1 py-1">
                                                <label class="form-label" for="totalsparepart">Data AP</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <hr class="my-1">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" for="dpp">DPP</label>
                                                            <div class="col-sm-8 form-group">
                                                                <input class="form-control" type="text" name="dpp" id="dpp" placeholder="DPP" style="text-align:right" readonly="" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" for="ppn">PPN</label>
                                                            <div class="col-sm-8 form-group">
                                                                <input class="form-control" type="text" name="ppn" id="ppn" placeholder="PPN" style="text-align:right" readonly="" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr class="my-1">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" for="grandtotal" style="font-weight: bold;">Grandtotal</label>
                                                            <div class="col-sm-8 form-group">
                                                                <input class="form-control" type="text" name="grandtotal" id="grandtotal" placeholder="Grandtotal" style="text-align:right; font-weight: bold;" readonly="" required="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label">&nbsp;</label>
                                                            <div class="col-sm-8 form-group">
                                                                <input class="form-control" type="hidden" readonly="" required="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" for="uangmuka">Uang Muka</label>
                                                            <div class="col-sm-8 form-group">
                                                                <input class="form-control" type="text" name="uangmuka" id="uangmuka" placeholder="Uang Muka" style="text-align:right" readonly="" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" for="pelunasan">Pelunasan</label>
                                                            <div class="col-sm-8 form-group">
                                                                <input class="form-control" type="text" name="pelunasan" id="pelunasan" placeholder="Pelunasan" style="text-align:right" readonly="" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" for="pencairanar">Pencairan AP</label>
                                                            <div class="col-sm-8 form-group">
                                                                <input class="form-control" type="text" name="pencairanar" id="pencairanar" placeholder="Pencairan AR" style="text-align:right" readonly="" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr class="my-1">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" for="sisaar" style="font-weight: bold;">Sisa AP</label>
                                                            <div class="col-sm-8 form-group">
                                                                <input class="form-control" type="text" name="sisaar" id="sisaar" placeholder="Sisa AR" style="text-align:right; font-weight: bold;" readonly="" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- JASA DETAIL -->
                                <div class="tab-pane fade" id="jasa" role="tabpanel" aria-labelledby="jasa-basic-tab">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="modal-body pre-scrollable" style="height: 500px; border: 1px solid; border-color: #DCDCDC;">
                                                        <div class="table-responsive">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color: black; font-weight: bold;">DETAIL TRANSAKSI</h5>
                                                            </div>
                                                            <table class="table table-bordered table-striped" id="detailjasa">
                                                                <thead>
                                                                    <tr>
                                                                        <th>KODE</th>
                                                                        <th>DESKRIPSI</th>
                                                                        <th>QTY</th>
                                                                        <th style="text-align: right;">HARGA</th>
                                                                        <th>PERSEN DISC</th>
                                                                        <th>DISC /ITEM</th>
                                                                        <th style="text-align: right;">SUBTOTAL</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="detaildatajasa"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="totaldetailjasa" style="font-weight: bold;">Total</label>
                                                    <div class="col-sm-8 form-group">
                                                        <input class="form-control" type="text" name="totaldetailjasa" id="totaldetailjasa" placeholder="Total" style="text-align:right; font-weight: bold;" readonly="" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PENERIMAAN KASIR DETAIL -->
                                <div class="tab-pane fade" id="kasir" role="tabpanel" aria-labelledby="kasir-basic-tab">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="modal-body pre-scrollable" style="height: 250px; border: 1px solid; border-color: #DCDCDC;">
                                                        <div class="table-responsive">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color: black; font-weight: bold;">DETAIL PENGELUARAN KASIR</h5>
                                                            </div>
                                                            <table class="table table-bordered table-striped" id="detailpenerimaankasir">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>JENIS TRANSAKSI</th> -->
                                                                        <th>NO PEMBAYARAN</th>
                                                                        <th>TGL PEMBAYARAN</th>
                                                                        <th>NILAI PEMBAYARAN</th>
                                                                        <th>MASUK KE ACCOUNT</th>
                                                                        <th>KETERANGAN</th>
                                                                        <th>JENIS</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="detaildatapenerimaankasir"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="totaldetailpenerimaankasir" style="font-weight: bold;">Total</label>
                                                    <div class="col-sm-8 form-group">
                                                        <input class="form-control" type="text" name="totaldetailpenerimaankasir" id="totaldetailpenerimaankasir" placeholder="Total" style="text-align:right; font-weight: bold;" readonly="" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="modal-body pre-scrollable" style="height: 250px; border: 1px solid; border-color: #DCDCDC;">
                                                        <div class="table-responsive">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color: black; font-weight: bold;">DETAIL PERMOHONAN UANG KASIR</h5>
                                                            </div>
                                                            <table class="table table-bordered table-striped" id="detailpermohonan">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>JENIS TRANSAKSI</th> -->
                                                                        <th>NO PERMOHONAN</th>
                                                                        <th>TGL PERMOHONAN</th>
                                                                        <th>NILAI PERMOHONAN</th>
                                                                        <th>MASUK KE ACCOUNT</th>
                                                                        <th>KETERANGAN</th>
                                                                        <th>JENIS</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="datadetailpermohonan"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="totaldetailpermohonan" style="font-weight: bold;">Total</label>
                                                    <div class="col-sm-8 form-group">
                                                        <input class="form-control" type="text" name="totaldetailpermohonan" id="totaldetailpermohonan" placeholder="Total" style="text-align:right; font-weight: bold;" readonly="" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="modal-body pre-scrollable" style="height: 250px; border: 1px solid; border-color: #DCDCDC;">
                                                        <div class="table-responsive">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color: black; font-weight: bold;">HISTORY PEMBATALAN PENGELUARAN KASIR</h5>
                                                            </div>
                                                            <table class="table table-bordered table-striped" id="detailhistorypembatalanpenerimaankasir">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>JENIS TRANSAKSI</th> -->
                                                                        <th>NO PEMBAYARAN</th>
                                                                        <th>TGL PEMBAYARAN</th>
                                                                        <th>NILAI PEMBAYARAN</th>
                                                                        <th>MASUK KE ACCOUNT</th>
                                                                        <th>KETERANGAN</th>
                                                                        <th>TGL BATAL</th>
                                                                        <th>USER BATAL</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="detaildatahistorypembatalanpenerimaankasir"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="totaldetailpembatalanpenerimaankasir" style="font-weight: bold;">Total</label>
                                                    <div class="col-sm-8 form-group">
                                                        <input class="form-control" type="text" name="totaldetailpembatalanpenerimaankasir" id="totaldetailpembatalanpenerimaankasir" placeholder="Total" style="text-align:right; font-weight: bold;" readonly="" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- HISTORY WO DETAIL -->
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-basic-tab">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row" id="noorder">
                                                    <label class="col-sm-4 col-form-label" for="noorderhistorywo">No Order</label>
                                                    <div class="col-sm-8 form-group">
                                                        <input class="form-control" type="text" name="noorderhistorywo" id="noorderhistorywo" placeholder="No Order" readonly="" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="modal-body pre-scrollable" style="height: 500px; border: 1px solid; border-color: #DCDCDC;">
                                                        <div class="table-responsive">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color: black; font-weight: bold;">HISTORY BATAL</h5>
                                                            </div>
                                                            <table class="table table-bordered table-striped" id="detailhistorybatal">
                                                                <thead>
                                                                    <tr>
                                                                        <th>NO FAKTUR</th>
                                                                        <th>TGL FAKTUR</th>
                                                                        <th>NO ORDER</th>
                                                                        <th>NO POLISI</th>
                                                                        <th>NAMA</th>
                                                                        <th>TOTAL</th>
                                                                        <th>ALASAN BATAL</th>
                                                                        <th>TGL BATAL</th>
                                                                        <th>USER BATAL</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="detaildatahistorybatal"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="modal-body pre-scrollable" style="height: 250px; border: 1px solid; border-color: #DCDCDC;">
                                                        <div class="table-responsive">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color: black; font-weight: bold;">HISTORY RETUR</h5>
                                                            </div>
                                                            <table class="table table-bordered table-striped" id="detailhistoryretur">
                                                                <thead>
                                                                    <tr>
                                                                        <th>NO WO</th>
                                                                        <th>TGL WO</th>
                                                                        <th>NO FAKTUR</th>
                                                                        <th>TGL FAKTUR</th>
                                                                        <th>NO POLISI</th>
                                                                        <th>NO RANGKA</th>
                                                                        <th>NO FAKTUR PAJAK</th>
                                                                        <th>TLG FAKTUR PAJAK</th>
                                                                        <th>NILAI FAKTUR</th>
                                                                        <th>ALASAN BATAL</th>
                                                                        <th>TGL BATAL</th>
                                                                        <th>USER BATAL</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="detaildatahistoryretur"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>