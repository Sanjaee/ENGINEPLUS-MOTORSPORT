<script type="text/javascript">
    $(document).ready( function () {  
        document.getElementById('kodekategori').disabled = true;  
        document.getElementById('namakategori').disabled = true;  
        
        $('.popup1').css('visibility','hidden');
        $('.popup2').css('visibility','hidden');
        
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
        else if($('#kodekategori').val() == '' || $('#namakategori').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Kategori Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#kodekategori').focus();
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
        document.getElementById('kodekategori').disabled = true;
        document.getElementById('namakategori').disabled = true;
        document.getElementById('aktif').disabled = true;
        $('#save').prop('disabled', true);
        $('#kodekategori').prop('disabled', true);
        $('#update').prop('disabled', false);
        
    }
// -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();  
            var kode =  $('#kode').val();
            var nama = $('#nama').val();
            var kodekategori =  $('#kodekategori').val();
            var namakategori = $('#namakategori').val();
            var aktif= $("input[name='aktif']:checked").val();

                    if(CekValidasi() == true){
                        $.ajax({  
                            url:"<?php echo base_url('masterdata/tipe/save'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    kode:kode,
                                    nama:nama,
                                    kodekategori:kodekategori,
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
            $('.popup2').css('visibility','visible');
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
                        "url":"<?php echo base_url('masterdata/tipe/caridataafind'); ?>",  
                        "method":"POST",
                        "data":{
                                nmtb:"glbm_tipe",
                                field:{kode:"kode",nama:"nama"},
                                sort:"kode,nama",
                                where:{kode:"kode",nama:"nama"}
                                },  
                },
            });
        }, false);
        
        //Close Pop UP Search
        document.getElementById("closesearch").addEventListener("click", function(event) {
                event.preventDefault();
                $('.popup2').css('visibility','hidden');
                // location.reload(true);
            }, false);

            $(document).on('click', ".searchokkategori", function() {
                var result = $(this).attr("data-id");
                var kode = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/tipe/find'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#kode').val(data[i].kode.trim());
                            $('#nama').val(data[i].nama.trim());
                            $('#kodekategori').val(data[i].kodekategori.trim());
                            namadetail(data[i].kodekategori.trim());
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
                        $('#save').prop('disabled', true);
                        $('#update').prop('disabled', false);
                        $('#carikategori').prop('disabled', false);    
                }  
            });  
                $('.popup2').css('visibility','hidden');
            });

            function namadetail(params) {
            $.ajax({  
            url:"<?php echo base_url('masterdata/tipe/getKodeKategori'); ?>",  
            method:"POST", 
            dataType: "json",
            async : true,
            data:{kodekategori:params},  
            success:function(data){  
                    for(var i = 0; i < data.length; i++){
                        // $('#nomoraccount').val(data[i].nomor.trim());
                        $('#namakategori').val(data[i].nama.trim());                                                       
                    }
                }  
            });  
        }
// -- END FIND --

// -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();  
            var kode =  $('#kode').val();
            var nama =  $('#nama').val();            
            var kodekategori =  $('#kodekategori').val();
            var namakategori = $('#namakategori').val();
            var aktif= $("input[name='aktif']:checked").val();

                if(kode == ''){
                    alert('Pilih data terlebih dahulu');
                    $('#kode').focus();
                }
                else if(nama == ''){
                    alert('Nama Tidak Boleh Kosong');
                    $('#nama').focus();
                }
                else if(kodekategori == ''){
                    alert('kategori Boleh Kosong');
                    $('#kodekategori').focus();
                }
                else if(aktif == undefined){
                    alert('Jenis aktif harus dipilih');
                    $('#aktif').focus();
                }
                else{
                    
                        $.ajax({    
                            url:"<?php echo base_url('masterdata/tipe/update'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    kode:kode,
                                    nama:nama,
                                    kodekategori:kodekategori,
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

            document.getElementById("carikategori").addEventListener("click", function(event) {
            $('.popup1').css('visibility','visible');
            event.preventDefault();
            $('#tablesearchkategori').DataTable({ 
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
                        "url":"<?php echo base_url('masterdata/tipe/caridatakategori'); ?>",  
                        "method":"POST",
                        "data":{
                                nmtb:"glbm_product",
                                field:{kode:"kode",nama:"nama"},
                                sort:"kode,nama",
                                where:{kode:"kode",nama:"nama"},
                                value:"aktif = true"
                                },  

                }
            });
        }, false);
        
        //Close Pop UP Search
        document.getElementById("closesearchkategori").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchkategori", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();    
            $.ajax({  
            url:"<?php echo base_url('masterdata/tipe/getKategori'); ?>",  
            method:"POST", 
            dataType: "json",
            async : true,
            data:{kode:kode},  
            success:function(data){  
                    for(var i = 0; i < data.length; i++){
                        $('#kodekategori').val(data[i].kode.trim());
                        $('#namakategori').val(data[i].nama.trim());                                                       
                    }
                }  
            });  
            $('.popup1').css('visibility','hidden');
        });

        });
</script>