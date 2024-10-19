<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        <?php echo SITE_NAME . " : " . ucfirst($this->uri->segment(1)) . " - " . ucfirst($this->uri->segment(2)) ?>
    </title>

    <style>
        @page {
            margin: 1cm 1cm 1cm 1cm;
        }
        .body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }
        .nav-bar {
            font-family: helvetica;
            color: black;
            text-align: center;
            font-size: 10px;
            line-height: 0.4cm;
        }
        .header {
            margin-left: 300px;
        }
        .content {
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 0.5cm;
        }
        .content-detail {
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
        }
        .footer {
            font-family: helvetica;
            color: black;
            text-align: center;
            line-height: 0.5cm;
        }
    </style>

    <style type="text/css">
        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }
    </style>

    <!-- <script type="text/javascript">
        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            
            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';
            
            // Create download link element
            downloadLink = document.createElement("a");
            
            document.body.appendChild(downloadLink);
            
            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            
                // Setting the file name
                downloadLink.download = filename;
                
                //triggering the function
                downloadLink.click();
            }
        }
    </script> -->
</head>

<body>
    <div class="breadcrumb">
        <h1>Export Data Report</h1>        
    </div>
    <span style="color: red; font-size: 10; font-weight: normal">Pilih Tanggal Dahulu , Kemudian Pilih Jenis Data nya.</span></label>
    <div class="separator-breadcrumb border-top"></div>

    <?php

    $aktif = 'true';
    $menu = 'export';

    $paramcombobox = $this->db->query("SELECT * FROM Stpm_report WHERE menu = '".$menu."' AND aktif = '".$aktif."' order by index ")->result();

    ?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>
                   

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tglmulai">Tanggal Mulai</label>
                                <div class="col-md-6">
                                    <div class="input-group date" id="tanggal_mulai">
                                        <input type="text" class="form-control" id="tglmulai" width="200" value = "<?php echo date("Y-m-d"); ?>" readonly>
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
                                <div class="col-md-6">
                                    <div class="input-group date" id="tanggal_akhir">
                                        <input type="text" class="form-control" id="tglakhir" width="200" value = "<?php echo date("Y-m-d"); ?>" readonly>
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

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jenis_data">Jenis Data</label>
                                <div class="col-sm-6 form-group">
                                    <select name="jenis" class="form-control" id="jenis_data">
                                    <?php foreach ($paramcombobox as $cell): ?>
                                            <option value="<?php echo $cell->index ?>"><?php echo $cell->nama_report ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <input class="form-control" type="hidden" name="judul" id="judul" readonly required />
                                </div>
                            </div>
                        </div>
                        
                        <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang')?>" readonly required />
                        <input class="form-control" type="hidden" name="kodecompany" id="kodecompany" value="<?php echo $this->session->userdata('mycompany')?>" readonly required />

                        <div class="col-md-6">
                            <div class="form-group">
                            
                                    <!-- <button class="btn btn-success" onclick="exportTableToExcel('tableExport', 'members-data')"><i class="fa fa-file-export" style="font-size: 16px"></i><span style="font-size: 16px; margin-left: 10px;">Export</span></button> -->
                                    <button id="export" class="btn btn-success"><i class="fa fa-file-export" style="font-size: 16px"></i><span style="font-size: 16px; margin-left: 10px;">Export</span></button>
                                
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12" style="margin-top:20px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Status Data Dokumen</h5>
                            </div>
                            <div class="modal-body pre-scrollable">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="tableExport">
                                        <!-- <tr class = "thead-dark" style="line-height: 0.5 cm; ">
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">No SPK</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Status</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">No SN</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Customer</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Tipe</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Kategori</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Keluhan</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Keterangan</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Nilai SPK</span>
                                            </th>
                                            <th style="text-align: center; ">
                                                <span style="font-weight: bold">Tanggal</span>
                                            </th>
                                        </tr> -->
                                        <tbody id="detaildata"></tbody>
                                        <tbody id="detailfaktur"></tbody>
                                        <tbody id="detailsum"></tbody>
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
</body>