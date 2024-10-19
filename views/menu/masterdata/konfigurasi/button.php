<script type="text/javascript">
    $(document).ready( function () {  
        $('#tablesearchtampil').css('visibility','hidden');
        //disable tombol update
        $('#update').prop('disabled', true);
        $("#ppn").prop("checked", "true");

// -- Validasi --
    function CekValidasi() {
        if($('#kode').val() == 0 || $('#kode').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'kode Tidak Boleh Kosong',
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
        else if($('#nama').val() == '-' || $('#nama').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Nama Tidak Boleh Kosong atau -',
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
        else if($('#alamat').val() == '-' || $('#alamat').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Alamat Tidak Boleh Kosong atau -',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#alamat').focus();
            var result = false;
        }
        else{
            var result = true;
        }
        return result;
    };
    function FindData(){
        document.getElementById('kode').disabled = true; 
        $('#save').prop('disabled', true);
        $('#update').prop('disabled', false);
        
    }
// -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();  
            var kode =  $('#kode').val();
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var npwp = $('#npwp').val();
            var ppn = $("input[name='ppn']:checked").val();

                    if(CekValidasi() == true){
                        $.ajax({  
                            url:"<?php echo base_url('masterdata/konfigurasi/save'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    kode:kode,
                                    nama:nama,
                                    alamat:alamat,
                                    ppn :ppn,
                                    npwp:npwp
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
                            //$('#kode').val(data.kode);   
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
                                nmtb:"stpm_konfigurasi",
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
                $.ajax({  
                url:"<?php echo base_url('masterdata/konfigurasi/find'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            console.log(data);
                            $('#kode').val(data[i].kode.trim());
                            $('#nama').val(data[i].nama.trim());
                            $('#alamat').val(data[i].alamat.trim());
                            $('#npwp').val(data[i].npwp.trim());
                            $('#save').prop('disabled', true);
                            $('#update').prop('disabled', false);
                            $('#kode').prop('disabled', true);
                            if (data[i].ppn == '1'){                        
                                $('input:radio[name="ppn"][value="1"]').prop('checked', true);
                            }
                            else{
                                $('input:radio[name="ppn"][value="0"]').prop('checked', true);
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
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var npwp = $('#npwp').val();
            var ppn = $("input[name='ppn']:checked").val();
            if(CekValidasi() == true){
                    $.ajax({    
                        url:"<?php echo base_url('masterdata/konfigurasi/update'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                            kode:kode,
                            nama:nama,
                            alamat:alamat,
                            ppn :ppn,
                            npwp:npwp
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