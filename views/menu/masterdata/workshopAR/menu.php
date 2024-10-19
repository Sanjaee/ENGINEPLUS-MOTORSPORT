<div class="modal-header" style="padding: 5px;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <h2>
                    <span class="logo-menu"><i class="links_icon fas fa-file-chart-line" style="font-size: 22px;"></i></span>
                    <span class="text-uppercase">Tools Control AR</span>
                </h2>
            </div>

            <div class="col-md-7">
                <div class="form-group" style="float: right;">
                    <button id="export" class="btn btn-danger mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-save" style="margin-right: 10px;"></i>Export</button>
                    <button id="print" class="btn btn-success mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-save" style="margin-right: 10px;"></i>Print</button>
                    <button id="query_data" class="btn btn-success mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-save" style="margin-right: 10px;"></i>Query Data</button>
                    <button id="new" class="btn btn-success mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="fa fa-refresh" style="margin-right: 10px;"></i>New</button>
                </div>
            </div>
        </div>

        <span style="color: red; font-size: 10; font-weight: normal">Note : WO OPEN TIDAK PERLU ISI RANGE TANGGAL.</span>
    </div>
</div>

<div class="separator-breadcrumb border-top"></div>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <!-- <div class="card-title mb-3"></div> -->
                <!-- <div> -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 form-label" for="jenisfaktur">Jenis Faktur</label>
                            <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                            <input class="form-control" type="hidden" name="kodesubcabang" id="kodesubcabang" value="<?php echo $this->session->userdata('mysubcabang') ?>" readonly required />
                            <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                            <input class="form-control" type="hidden" name="kodegrupcabang" id="kodegrupcabang" value="<?php echo $this->session->userdata('mygrupcabang') ?>" readonly required />
                            <div class="col-md-7 form-group">
                                <select name="jenisfaktur" class="form-control" id="jenisfaktur">
                                    <option value="-">-- Pilih Jenis Faktur --</option>
                                    <option value="0">INVOICE GENERAL REPAIR LUNAS</option>
                                    <option value="1">INVOICE GENERAL REPAIR BELUM LUNAS</option>
                                    <option value="2">INVOICE PART COUNTER LUNAS</option>
                                    <option value="3">INVOICE PART COUNTER BELUM LUNAS</option>
                                    <option value="4">WO OPEN</option>
                                    <option value="5">WO OPEN OUTSTANDING</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-3 form-label" for="jenispencairan">Jenis Pencairan</label>
                                <div class="col-md-8 form-group">
                                    <select name="jenispencairan" class="form-control" id="jenispencairan">
                                        <option value="-">-- Pilih Jenis Pencairan --</option>
                                        <option value="0">NOMOR FAKTUR</option>
                                        <option value="1">NOMOR ORDER</option>
                                        <option value="2">NAMA CUSTOMER</option>
                                        <option value="3">NOMOR POLISI</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="pencairan">Nama Customer</label>
                            <div class="col-md-7 form-group">
                                <input class="form-control" type="text" name="pencairan" id="pencairan" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="tanggalinput">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tglmulai">Tanggal Mulai</label>
                            <div class="col-md-7">
                                <div class="input-group date" id="tanggal_mulai">
                                    <input type="text" class="form-control" id="tglmulai" width="200" value="<?php echo date("Y-m-d"); ?>" readonly>
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

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="tglakhir">Tanggal Akhir</label>
                            <div class="col-md-7">
                                <div class="input-group date" id="tanggal_akhir">
                                    <input type="text" class="form-control" id="tglakhir" width="200" value="<?php echo date("Y-m-d"); ?>" readonly>
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
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <!-- <div class="modal-body pre-scrollable" style="height: 700px; border: 1px solid; border-color: #DCDCDC;"> -->
                            <div class="table-responsive">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="color: black; font-weight: bold;">DATA LIST TRANSAKSI</h5>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="pencairan">Total Sisa AR/WO</label>
                                        <div class="col-md-7 form-group">
                                            <input class="form-control" style="text-align:right;" type="text" name="totalar" id="totalar" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped" id="detailhistoryar">
                                    <thead id="headerworkshopAR"></thead>
                                    <tbody id="detaildatalistworkshopar"></tbody>
                                </table>
                            </div>

                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>

    <!-- DETAIL HISTORY AR -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="finddetailhistoryar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: black;">DETAIL HISTORY AR</h5>
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
                                        <a class="nav-link" id="jasa-basic-tab" data-toggle="tab" href="#jasa" role="tab" aria-controls="jasa" aria-selected="false">JASA</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="history-sparepart-basic-tab" data-toggle="tab" href="#history-sparepart" role="tab" aria-controls="history-sparepart" aria-selected="false">SPAREPART</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                    <a class="nav-link" id="history-bahan-basic-tab" data-toggle="tab" href="#history-bahan" role="tab" aria-controls="history-bahan" aria-selected="false">BAHAN</a>
                                </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link" id="opl-basic-tab" data-toggle="tab" href="#opl" role="tab" aria-controls="opl" aria-selected="false">OPL</a>
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
                                                                <label class="form-label" for="totalsparepart">Data Faktur</label>
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
                                                                            <label class="col-sm-3 col-form-label" for="nofaktur">No Faktur</label>
                                                                            <div class="col-md-9 form-group">
                                                                                <input class="form-control" type="text" name="nofaktur" id="nofaktur" placeholder="No Faktur" readonly required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label" for="tglfaktur">Tgl Faktur</label>
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
                                                                    <div class="col-md-5">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label" for="tglpass">PM</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" name="projectmanager" id="projectmanager" readonly required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="row">
                                                                <div class="col-md-7">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="nofakturpajak">No Faktur Pajak</label>
                                                                        <div class="col-md-9 form-group">
                                                                            <input class="form-control" type="text" name="nofakturpajak" id="nofakturpajak" placeholder="No Faktur Pajak" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="tglfakturpajak">Tgl Fak. Pajak</label>
                                                                        <div class="col-md-8">
                                                                            <input class="form-control" type="text" name="tglfakturpajak" id="tglfakturpajak" readonly required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
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
                                                                <label class="form-label" for="totalsparepart">Data Customer</label>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label" for="customer">Nama Customer</label>
                                                                            <div class="col-md-4 form-group">
                                                                                <input class="form-control" type="text" name="nocustomer" id="nocustomer" placeholder="Nomor Customer" readonly required>
                                                                            </div>
                                                                            <div class="col-md-6 form-group">
                                                                                <input class="form-control" type="text" name="nama_customer" id="nama_customer" placeholder="Nama Customer" readonly required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label" for="alamatcustomer">Alamat Customer</label>
                                                                            <div class="col-md-10 form-group">
                                                                                <input class="form-control" type="text" name="alamat_customer" id="alamat_customer" placeholder="Alamat Customer" readonly required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label" for="kelutahancustomer">Kel/Kec Cust.</label>
                                                                            <div class="col-md-5 form-group">
                                                                                <input class="form-control" type="text" name="kelurahan_customer" id="kelurahan_customer" placeholder="Kelurahan Customer" readonly required>
                                                                            </div>
                                                                            <div class="col-md-5 form-group">
                                                                                <input class="form-control" type="text" name="kecamatan_customer" id="kecamatan_customer" placeholder="Kecamatan Customer" readonly required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label" for="kotacustomer">Kota Customer</label>
                                                                            <div class="col-md-6 form-group">
                                                                                <input class="form-control" type="text" name="kota_customer" id="kota_customer" placeholder="Kota Customer" readonly required>
                                                                            </div>
                                                                            <div class="col-md-4 form-group">
                                                                                <input class="form-control" type="text" name="kodepos_customer" id="kodepos_customer" placeholder="Kode Pos Customer" readonly required>
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
                                                    <label class="form-label" for="totalsparepart">Data AR</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label" for="totaljasa">Total Jasa</label>
                                                                <div class="col-sm-8 form-group">
                                                                    <input class="form-control" type="text" name="totaljasa" id="totaljasa" placeholder="Total Jasa" style="text-align:right" readonly="" required="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label" for="totalsparepart">Total Part</label>
                                                                <div class="col-sm-8 form-group">
                                                                    <input class="form-control" type="text" name="totalsparepart" id="totalsparepart" placeholder="Total Part" style="text-align:right" readonly="" required="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <hr class="my-1">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label" for="subtotal" style="font-weight: bold;">Subtotal</label>
                                                                <div class="col-sm-8 form-group">
                                                                    <input class="form-control" type="text" name="subtotal" id="subtotal" placeholder="Subtotal" style="text-align:right; font-weight: bold;" readonly="" required="">
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                                <label class="col-sm-4 col-form-label" for="pencairanar">Pencairan AR</label>
                                                                <div class="col-sm-8 form-group">
                                                                    <input class="form-control" type="text" name="pencairanar" id="pencairanar" placeholder="Pencairan AR" style="text-align:right" readonly="" required="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <hr class="my-1">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label" for="sisaar" style="font-weight: bold;">Sisa AR</label>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>