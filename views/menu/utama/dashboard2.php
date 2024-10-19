<?php if ($this->session->flashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('pesan'); ?>
    </div>
<?php endif; ?>
<script src="<?php echo base_url('assets/chart.js/Chart.min.js') ?>"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="modal-content" style="height:386.62px">
                            <div class="modal-header">
                                <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany') ?>" readonly required />
                                <input class="form-control" type="hidden" name="kodecabang" id="kodecabang" value="<?php echo $this->session->userdata('mycabang') ?>" readonly required />
                                <h5 class="modal-title">Data Summary Bulan Berjalan</h5>
                            </div>
                            <div class="modal-body pre-scrollable">
                                <div class="form-group row" hidden>
                                    <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" name="tanggal" id="tanggal" value="<?php echo date("d-m-Y"); ?>" maxlength="50" readonly required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="nomor">Total Nilai Faktur</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="totalfaktur" id="totalfaktur" placeholder="Total Faktur" maxlength="50" readonly required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="nomor">Total Sisa Piutang</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="totalpiutang" id="totalpiutang" placeholder="Total Piutang" maxlength="50" readonly required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="nomor">Total Sisa Hutang</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="totalhutang" id="totalhutang" placeholder="Total Hutang" maxlength="50" readonly required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="nomor">Total Nilai Pengeluaran</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="totalpengeluaran" id="totalpengeluaran" placeholder="Total Pengeluaran" maxlength="50" readonly required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="nomor">Total Nilai Penerimaan</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="totalpenerimaan" id="totalpenerimaan" placeholder="Total Penerimaan" maxlength="50" readonly required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="nomor">Total Nilai Pencairan K/D</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="totalpencairan" id="totalpencairan" placeholder="Total Pencairan" maxlength="50" readonly required />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="modal-content" style="height:386.62px">
                            <div class="modal-header">
                                <h5 class="modal-title">Record Jumlah Dokumen WO dan Faktur</h5>

                            </div>
                            <div class="modal-body pre-scrollable">
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div class="col-sm-4 form-group">

                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                
                            </div> -->
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-top:20px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Daftar Piutang Jatuh Tempo</h5>
                            </div>
                            <div class="modal-body pre-scrollable">
                                <div class="table-responsive">
                                    <!-- <div class="pre-scrollable"> -->
                                    <table id="tablesearchar" class="table table-bordered table-striped table-striped" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr style="line-height: 0.5 cm; ">
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">No Faktur</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Tgl Faktur</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Nama</span>
                                                </th>
                                                <th style="text-align: right; ">
                                                    <span style="font-weight: bold">Nilai Piutang</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>

                                    </table>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Daftar Hutang Jatuh Tempo</h5>
                            </div>
                            <div class="modal-body pre-scrollable">
                                <div class="table-responsive">
                                    <!-- <div class="pre-scrollable"> -->
                                    <table id="tablesearchap" class="table table-bordered table-striped table-striped" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr style="line-height: 0.5 cm; ">
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">No Faktur</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">No Invoice</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Tgl Invoice</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Nama</span>
                                                </th>
                                                <th style="text-align: right; ">
                                                    <span style="font-weight: bold">Nilai Hutang</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>

                                    </table>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top:20px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Status Dokumen WO</h5>
                            </div>
                            <div class="modal-body pre-scrollable">
                                <div class="table-responsive">
                                    <!-- <div class="pre-scrollable"> -->
                                    <table id="tablesearch" class="table table-bordered table-striped table-striped" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr style="line-height: 0.5 cm; ">
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">No WO</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">No Polisi</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Model</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Tipe</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Customer</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Jenis Service</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Status Dokumen</span>
                                                </th>
                                                <th style="text-align: center; ">
                                                    <span style="font-weight: bold">Penerima</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>

                                    </table>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<button id="minimstock" class="btn btn-danger" data-toggle="modal" data-target="#cariminstock"><i class="fa fa-cart-arrow-down"></i> &nbsp;MIN STOCK</button>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="cariminstock">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Minimum Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tablesearchmin" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">Kode Part</th>
                                <th width="25">Nama</th>
                                <th width="25">Qty Akhir</th>
                                <th width="25">Min Stock</th>
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
<script>
    // function loadLabel(){
    //     var i = 0;
    //     var result = "";
    //     if ($('#fafaf').val() == 0){
    //         i= 6;
    //     }
    //     else{
    //         i = $('#fafaf').val();
    //     }
    //     var date: i
    //     $.ajax({  
    //         url:"<?php //echo base_url('dashboard/dashboard/loadLabel'); 
                    ?>",  
    //         method:"POST", 
    //         dataType: "json",
    //         async : false,
    //         data:{
    //             tanggal : i,

    //         },  
    //         success:function(data){  
    //             if(data.length != 0){
    //                 result = data
    //             }

    //         }
    //     })
    //     return result;
    // }

    // function loadDashboard() {
    //     var ctx = document.getElementById("myChart").getContext('2d');
    //     var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: <?php //echo json_encode($date);
                        ?>,
    //         // labels: loadlabel(),
    //         datasets: [{
    //             label: 'SPK',
    //             data: 
    //                 <?php //echo json_encode($nomor);
                        ?>
    //             ,
    //             backgroundColor: [
    //             'rgba(255, 99, 132, 0.3)',
    //             'rgba(255, 99, 132, 0.3)',
    //             'rgba(255, 99, 132, 0.3)',
    //             'rgba(255, 99, 132, 0.3)',
    //             'rgba(255, 99, 132, 0.3)',
    //             'rgba(255, 99, 132, 0.3)',
    //             'rgba(255, 99, 132, 0.3)'
    //             ],
    //             borderColor: [
    //             'rgba(255,99,132,1)',
    //             'rgba(255,99,132,1)',
    //             'rgba(255,99,132,1)',
    //             'rgba(255,99,132,1)',
    //             'rgba(255,99,132,1)',
    //             'rgba(255,99,132,1)',
    //             'rgba(255,99,132,1)'
    //             ],
    //             borderWidth: 1
    //         },
    //         {
    //             label: 'Faktur',
    //             data: 
    //                 <?php //echo json_encode($nomor);
                        ?>
    //             ,
    //             backgroundColor: [
    //             'rgba(54, 162, 235, 0.3)',
    //             'rgba(54, 162, 235, 0.3)',
    //             'rgba(54, 162, 235, 0.3)',
    //             'rgba(54, 162, 235, 0.3)',
    //             'rgba(54, 162, 235, 0.3)',
    //             'rgba(54, 162, 235, 0.3)',
    //             'rgba(54, 162, 235, 0.3)'
    //             ],
    //             borderColor: [
    //             'rgba(54, 162, 235, 1)',
    //             'rgba(54, 162, 235, 1)',
    //             'rgba(54, 162, 235, 1)',
    //             'rgba(54, 162, 235, 1)',
    //             'rgba(54, 162, 235, 1)',
    //             'rgba(54, 162, 235, 1)',
    //             'rgba(54, 162, 235, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     min: 0,
    //                     max: 100,
    //                     stepSize: 10,
    //                     // beginAtZero:true
    //                 }
    //             }]
    //         }
    //     }
    // });
    //}

    //loadDashboard ();
</script>