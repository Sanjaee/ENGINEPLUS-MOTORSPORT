<!DOCTYPE html>
<html>
<head>
    <title>Data Table</title>
</head>
<body>
    <div class="col-md-7">
        <tr>
            <td>
                <b>Kode : &nbsp;</b>
                <input name="kodepart" type="text" id="kodepart" class="form-control" height="50" readonly required/>
                &nbsp;
                <!-- <b>Nama : </b> -->
                <input name="namapart" type="text" id="namapart" class="form-control" width="50" readonly required/>
                &emsp;
                <button id="search" class="btn btn-dark" >Cari</button>
            </td>
        </tr>
        <br><br>
        <tr>
            <td>
                <b>Qty :  &emsp;</b>
                <input name="qty" type="text" id="qty" class="form-control" width="1%"  required/>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                <button id="add-row" class="btn btn-dark" >Add</button>
            </td>    
        </tr>
        <br><br>
        <table class="table" id="mytable">
            <tr>
                <th>Kode Part</th>
                <th>Nama Part</th>
                <th>Qty</th>
                <th>action</th>
            </tr>
        </table>
        <a href="<?php echo base_url(); ?>main/cetak" class="btn btn-dark1" target="_blank">Cetak</a>
    </div>


    <div id="tablesearchtampil">
        <center>
            <!-- <div class="pre-scrollable"> -->
            <div class="popupsearch">  
                <div class="pre-scrollable">
                    <h3 align="center">Pencarian Data</h3>  
                    <div class="table-responsive">
                        <table id="tablesearch" class="table table-bordered table-striped">  
                            <thead>  
                                <tr>  
                                    <th width="25">Kode</th>  
                                    <th width="50">Nama</th> 
                                    <th width="300"><button id="#"><i class="fa fa-ellipsis-h"></i></button></th>
                                </tr>  
                            </thead>                  
                        </table>
                        <div id="button">
                            <button id="closesearch" class="btn btn-dark1" >Close</button>
                        </div>
                    </div>  
                </div>
            </div>  
        </center>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-3.2.1.min.js"></script>
    <?php
    $this->load->view('jsbutton/carimasterpart');
    $this->load->view('jsbutton/addpengambilanpart');
    ?>

</body>
</html>