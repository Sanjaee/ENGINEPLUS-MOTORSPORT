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
                // "lengthChange": false,
                // "scrollX": true,
                "scrollY": true,
                "ordering":  false,
                // "sAjaxDataProp":"",
                // "data":[0, 1, 2],  
                // "order":[], 
                
                "ajax":{  
                        "url":"<?php echo base_url('caridata/caridata'); ?>",  
                        "method":"POST",
                        "data":{
                                nmtb:"glbm_parts",
                                // field:{kode:"kode",nama:"nama",nama2:"nama2",nama3:"nama3"}
                                field:{kode:"kode",nama:"nama"},
                                sort:"kode,nama"
                                },  
                },
            });
        }, false);
        
        //Close Pop UP Search
        document.getElementById("closesearch").addEventListener("click", function(event) {
                event.preventDefault();
                $('#tablesearchtampil').css('visibility','hidden');
                // location.reload(true);
            }, false);

            $(document).on('click', ".searchok", function() {
                var result = $(this).attr("data-id");
                var kode = result.trim();
                // $('#kodepart').val(result.trim());

                $.ajax({  
                url:"<?php echo base_url('masterpart/caridata'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                for(var i = 0; i < data.length; i++){
                    $('#kodepart').val(data[i].kode.trim());
                    $('#namapart').val(data[i].nama.trim());
                }
                }  
            });  


                $('#tablesearchtampil').css('visibility','hidden');
            });

    });

    </script>