<div class="modal-header" style="padding: 5px;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <h2>
                    <span class="logo-menu"><i class="links_icon fas fa-file-chart-line" style="font-size: 22px;"></i></span>
                    <span class="text-uppercase"><?php echo $title ?></span>
                </h2>
            </div>
            <div class="col-md-7">
                <div class="form-group" style="float: right;">
                    <!-- <button id="query_data" class="btn btn-success mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-save" style="margin-right: 10px;"></i>Query Data</button> -->
                    <button id="new" class="btn btn-success mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="fa fa-refresh" style="margin-right: 10px;"></i>New</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12" style="margin-top:20px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black; font-weight: bold;">List Permohonan Uang</h5>
                <!-- <div class="row"> -->
                <!-- </div> -->
            </div><br>
            <div>
                <div class="table-responsive">
                    <div class="pre-scrollable">
                        <table id="tableapprovalpermohonan" class="table table-bordered table-striped table-striped" style="width:100%">
                            <thead>
                                <tr style="line-height: 0.5 cm; ">

                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Nomor</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Tanggal</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Keterangan</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Jenis Transaksi</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Status</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-12" style="margin-top:20px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black; font-weight: bold;">List Data WO</h5>
                <!-- <div class="row"> -->
                <!-- </div> -->
            </div><br>
            <div>
                <div class="table-responsive">
                    <div class="pre-scrollable">
                        <table id="tableapprovalwo" class="table table-bordered table-striped table-striped" style="width:100%">
                            <thead>
                                <tr style="line-height: 0.5 cm; ">

                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">No Polisi</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">No Rangka</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">No Mesin</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Nama Customer</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Status</span>
                                    </th>
                                    <th style="text-align: center; width:200px; ">
                                        <span style="font-weight: bold">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
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
                <div class="card-title mb-3"></div>
                <div>
                    <!-- <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="modal-body pre-scrollable" style="height: 550px; border: 1px solid; border-color: #DCDCDC;">
                                    <div class="table-responsive">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="color: black; font-weight: bold;">LIST PERMOHONAN UANG</h5>
                                        </div>
                                        <table class="table table-bordered table-striped" id="tableapprovalpermohonan">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Jenis Transaksi</th>
                                                    <th>Status</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dataapprovalpermohonan"></tbody>
                                        </table>
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

<!-- DETAIL PERMOHONAN UANG-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findpermohonanuang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black;">DETAIL PERMOHONAN UANG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body pre-scrollable"> -->
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="col-md-12">
                                <!-- <div class="row"> -->
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-6" id="nomor_header">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="nomorheader">Nomor</label>
                                                <div class="col-sm-8 form-group">
                                                    <input class="form-control" type="text" name="nomorheader" id="nomorheader" placeholder="Nomor" readonly="" required="">
                                                    <input class="form-control" type="hidden" name="statusheader" id="statusheader" placeholder="" readonly="" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="norang">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="jenispembayaranheader">Jenis Pembayaran</label>
                                                <div class="col-sm-8 form-group">
                                                    <input class="form-control" type="text" name="jenispembayaranheader" id="jenispembayaranheader" placeholder="Jenis Pembayaran" readonly="" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="norang">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="tanggalheader">Tanggal</label>
                                                <div class="col-sm-8 form-group">
                                                    <input class="form-control" type="text" name="tanggalheader" id="tanggalheader" placeholder="Tanggal" readonly="" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="norang">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="keterangan">Keterangan</label>
                                                <div class="col-sm-8 form-group">
                                                    <textarea name="keteranganheader" id="keteranganheader" class="form-control" cols="20" rows="5" readonly=""></textarea>
                                                    <!-- <input class="form-control" type="text" name="keteranganheader" id="keteranganheader" placeholder="Keterangan" readonly="" required=""> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body pre-scrollable" style="height: 500px; border: 1px solid; border-color: #DCDCDC;">
                                            <div class="table-responsive">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" style="color: black; font-weight: bold;"></h5>
                                                </div>
                                                <table class="table table-bordered table-striped" id="tablepermohonanuang">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th style="width:70px;"></th> -->
                                                            <th style="width:150px;">Nomor</th>
                                                            <th style="width:150px;">No Referensi</th>
                                                            <th style="width:150px;">Kode Supplier</th>
                                                            <th style="width:150px;">Nama Supplier</th>
                                                            <th style="text-align: right;">Kode Account</th>
                                                            <th style="width:150px;">Nilai Permohonan</th>
                                                            <th style="width:150px;">Memo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="datapermohonanuang">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <!-- <label class="col-sm-2 col-form-label" for="totalnilaipermohonan" style="font-weight: bold;">Total</label> -->
                                        <div class="col-sm-6 form-group">
                                            <!-- <input class="form-control" type="text" name="totalnilaipermohonan" id="totalnilaipermohonan" placeholder="Total" style="text-align:right; font-weight: bold;" readonly="" required=""> -->
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2 form-group">
                                            <button class="btn-primary" id="processingpermohonan"><i class="fa fa-check" style="margin-right: 10px;"></i>Approve</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                            <!-- </div> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- DETAIL WO -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="finddatawo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black;">DETAIL DATA WO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body pre-scrollable"> -->
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="col-md-12">
                                <!-- <div class="row"> -->
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-6" id="norang">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="nopolisi_wo"></label>
                                                <div class="col-sm-8 form-group">
                                                    <input class="form-control" type="hidden" name="nopolisi_wo" id="nopolisi_wo" placeholder="Jenis Pembayaran" readonly="" required="">
                                                    <input class="form-control" type="hidden" name="statusheader_wo" id="statusheader_wo" placeholder="" readonly="" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body pre-scrollable" style="height: 500px; border: 1px solid; border-color: #DCDCDC;">
                                            <div class="table-responsive">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" style="color: black; font-weight: bold;"></h5>
                                                </div>
                                                <table class="table table-bordered table-striped" id="tabledatawo">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th style="width:70px;"></th> -->
                                                            <th style="width:150px;">Nomor WO</th>
                                                            <th style="width:150px;">No Polisi</th>
                                                            <th style="width:150px;">No Rangka</th>
                                                            <th style="width:150px;">No Mesin</th>
                                                            <th style="text-align: right;">No Customer</th>
                                                            <th style="width:150px;">Keterangan</th>
                                                            <th style="width:150px;">Keluhan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabledetailwo">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <!-- <label class="col-sm-2 col-form-label" for="totalnilaipermohonan" style="font-weight: bold;">Total</label> -->
                                        <div class="col-md-6 form-group">
                                            <!-- <input class="form-control" type="text" name="totalnilaipermohonan" id="totalnilaipermohonan" placeholder="Total" style="text-align:right; font-weight: bold;" readonly="" required=""> -->
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2 form-group">
                                            <button class="btn-primary" id="processingdatawo"><i class="fa fa-check" style="margin-right: 10px;"></i>Approve</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                            <!-- </div> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>