<script type="text/javascript">
    $(document).ready( function () {  
        $('#tablesearchtampil').css('visibility','hidden');
        //disable tombol update
        $('#update').prop('disabled', true);
        $("#aktif").prop("checked", true);

// -- Validasi --
    function CekValidasi() {
        if($('#nomor').val() == 0 || $('#nomor').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Nomor Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#nomor').focus();
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
        else if($('#jenis').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Jenis Harus Dipilih',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#jenis').focus();
            var result = false;
        }
        else{
            var result = true;
        }
        return result;
    };
    function FindData(){
        document.getElementById('nomor').disabled = true; 
        document.getElementById('nama').disabled = true;
        document.getElementById('jenis').disabled = true;
        document.getElementById('aktif').disabled = true;
        $('#save').prop('disabled', true);
        $('#update').prop('disabled', false);
        
    }
// -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();  
            var nomor =  $('#nomor').val();
            var nama = $('#nama').val();
            var jenis = $('#jenis').val();
            var aktif= $("input[name='aktif']:checked").val();

               
                    if(CekValidasi() == true){
                        $.ajax({  
                            url:"<?php echo base_url('masterdata/account_lain2/save'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    nomor:nomor,
                                    nama:nama,
                                    jenis:jenis,
                                    aktif:aktif
                                },  
                            success:function(data){  
                            if (data.nomor  != ""){
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
                            $('#nomor').val(data.nomor);   
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
            BersihkanLayar(); 
        }); 
// -- END NEW --
    function BersihkanLayar(){
        location.reload(true);
    };

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
                // // "scrollX": true,
                // "scrollY": true,
                // // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax":{  
                        "url":"<?php echo base_url('caridata/caridata'); ?>",  
                        "method":"POST",
                        "data":{
                                nmtb:"glbm_accountlainlain",
                                field:{nomor:"nomor",nama:"nama"},
                                sort:"nomor,nama"
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
                var nomor = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/account_lain2/find'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{nomor:nomor},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            console.log(data);
                            $('#nomor').val(data[i].nomor.trim());
                            $('#nama').val(data[i].nama.trim());
                            $("div.jenis select").val(data[i].jenis.trim());
                            // $('#jenis').val(data[i].jenis.trim());
                            $('#save').prop('disabled', true);
                            $('#update').prop('disabled', false);
                            
                            if (data[i].aktif == 't'){                        
                                $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                            }
                            else{
                                $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                            }
                            
                        }
                        document.getElementById('nomor').disabled = true; 
                }  
            });  
                $('#tablesearchtampil').css('visibility','hidden');
            });
// -- END FIND --

// -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();  
            var nomor =  $('#nomor').val();
            var nama =  $('#nama').val();
            var jenis = $('#jenis').val();
            var aktif= $("input[name='aktif']:checked").val();

            if(CekValidasi() == true){
                    $.ajax({    
                        url:"<?php echo base_url('masterdata/account_lain2/update'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                                nomor:nomor,
                                nama:nama,
                                jenis:jenis,
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