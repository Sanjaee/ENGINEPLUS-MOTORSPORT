<!DOCTYPE html>
<html>
<head>
    <title>Data Table</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fontawesome-free/css/all.min.css">
    
</head>
<body>
    <div class="col-md-6">
        <b>Kode : </b>
        <tr>
            <td><input name="kode" type="text" id="kode" class="form-control" value="" required /></td>
        </tr>
        <b>Nama : </b>
        <tr>
            <td>
                <input name="nama" type="text" id="nama" class="form-control" required />
            </td>
        </tr>
    </div><br><br>
    <div id="button">
        <button id="search" class="btn btn-dark" >Cari</button>
    </div>

    
    <div id="tablesearchtampil">
        <center>
            <div class="scroll">
                <div class="popupsearch">  
                    <h3 align="center">Pencarian Data</h3>  
                    <div class="table-responsive">
                        <table id="tablesearch" class="table table-bordered table-striped">  
                            <thead>  
                                <tr>  
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Kode" style="width: 20px;">Kode</th>  
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="nama" style="width: 50px;">Nama</th> 
                                    <th><button id="#"><i class="fa fa-ellipsis-h"></i></button></th>
                                </tr>  
                            </thead>                  
                        </table>
                        <div id="button">
                            <button id="closesearch" class="btn btn-dark" >Close</button>
                        </div>
                    </div>  
                </div>
            </div>  
        </center>
    </div>

    
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-3.2.1.min.js"></script>
<!-- <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables/jquery.dataTables.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready( function () {
    $('#tablesearchtampil').css('visibility','hidden');

    document.getElementById("search").addEventListener("click", function(event) {
        $('#tablesearchtampil').css('visibility','visible');
        event.preventDefault();
        $('#tablesearch').DataTable({  
            "destroy": true,
            "searching": true,
            "processing":true,  
            "serverSide":true,  
            "order":[],  
            "ajax":{  
                    url:"<?php echo base_url('caridata/caridata'); ?>",  
                    method:"POST",
                    data:{
                            nmtb:"test",
                            // field:{kode:"kode",nama:"nama",nama2:"nama2",nama3:"nama3"}
                            field:{kode:"kode",nama:"nama"},
                            sort:"kode,nama"
                            },  
            },  
            "columnDefs":[  
                    {  
                        "targets":[0, 1, 2],  
                        "orderable":false,  
                    },  
            ],  
        });
    }, false);
      //Close Pop UP Search
      document.getElementById("closesearch").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchtampil').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchok", function() {
            var a = $(this).attr("data-id");
            $('#kode').val(a.trim());
            $('#tablesearchtampil').css('visibility','hidden');
        });

 });

</script>
</body>
</html>