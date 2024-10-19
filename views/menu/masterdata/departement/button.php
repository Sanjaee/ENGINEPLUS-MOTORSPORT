<script type="text/javascript">
    $(document).ready( function () {  
        $('#tablesearchtampil').css('visibility','hidden');
        //disable tombol update
        $('#update').prop('disabled', true);
        $("#aktif").prop("checked", true);

// -- Validasi --
    function CekValidasi() {
        if($('#kode').val() == 0 || $('#kode').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Kode Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#kode').focus();
            var result = false;
        }
        else if($('#nama').val() == 0 || $('#nama').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Nama Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#nama').focus();
            var result = false;
        }
        else{
            var result = true;
        }
        return result;
    };
    function FindData(){
        document.getElementById('kode').disabled = true; 
        document.getElementById('nama').disabled = true;
        document.getElementById('aktif').disabled = true;
        $('#save').prop('disabled', true);
        $('#update').prop('disabled', false);
        
    }
// -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();  
            var kode =  $('#kode').val();
            var nama = $('#nama').val();
            var aktif= $("input[name='aktif']:checked").val();

                    if(CekValidasi() == true){
                        $.ajax({  
                            url:"<?php echo base_url('masterdata/departement/save'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    kode:kode,
                                    nama:nama,
                                    aktif:aktif
                                },  
                            success:function(data){  
                            if (data.kode  != ""){
                                $.alert({
                                    title: 'Info..',
                                    content: data.message,
                                    buttons: {
                                    formSubmit: {
                                    text: 'OK',
                                    btnClass: 'btn-red'
                                        }
                                    }
                                });         
                            FindData();        
                            }
                            else{
                                $.alert({
                                    title: 'Info..',
                                    content: data.message,
                                    buttons: {
                                    formSubmit: {
                                    text: 'OK',
                                    btnClass: 'btn-red'
                                        }
                                    }
                                });   
                            }
                            }   
                        }, false);
                    }
            }); 
// -- END SAVE --

// -- NEW --
    document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault(); 
                document.getElementById('kode').disabled = false; 
                document.getElementById('nama').disabled = false;
                document.getElementById('aktif').disabled = false;
                $('#kode').val("");
                $('#nama').val("");
                $('#save').prop('disabled', false);
                $("#aktif").prop("checked", true);
            }); 
// -- END NEW --

// -- FIND --
        document.getElementById("find").addEventListener("click", function(event) {
            $('#tablesearchtampil').css('visibility','visible');
            event.preventDefault();
            $('#tablesearch').DataTable({ 
                "destroy": true,
                "searching": true,
                "processing":true,  
                "serverSide":true,
                "lengthChange": false,
                // "scrollX": true,
                "scrollY": true,
                "ordering":  true,
                
                // "order":[0,1,2],  
                "ajax":{  
                        "url":"<?php echo base_url('caridata/caridata'); ?>",  
                        "method":"POST",
                        "data":{
                                nmtb:"glbm_departement",
                                field:{kode:"kode",nama:"nama"},
                                sort:"kode,nama"
                                },  
                },
                "order":[], 
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
                $.ajax({  
                url:"<?php echo base_url('masterdata/departement/find'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            console.log(data);
                            $('#kode').val(data[i].kode.trim());
                            $('#nama').val(data[i].nama.trim());
                            $('#save').prop('disabled', true);
                            $('#update').prop('disabled', false);
                            
                            if (data[i].aktif == 't'){                        
                                $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                            }
                            else{
                                $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                            }
                            
                        }
                        document.getElementById('kode').disabled = true; 
                }  
            });  
                $('#tablesearchtampil').css('visibility','hidden');
            });
// -- END FIND --

// -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();  
            var kode =  $('#kode').val();
            var nama =  $('#nama').val();
            var aktif= $("input[name='aktif']:checked").val();

                if(CekValidasi() == true){                    
                    $.ajax({    
                        url:"<?php echo base_url('masterdata/departement/update'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                                kode:kode,
                                nama:nama,
                                aktif:aktif
                            },  
                        success:function(data){  
                            $.alert({
                                title: 'Info..',
                                content: data.message,
                                buttons: {
                                formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                                    }
                                }
                            });   
                        }   
                    }, false);
                }
            }); 
// -- END UPDATE -- 
        });
</script>