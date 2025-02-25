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
        else if($('#kelurahan').val() == 0 || $('#kelurahan').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Kelurahan Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#kelurahan').focus();
            var result = false;
        }
        else if($('#kecamatan').val() == 0 || $('#kecamatan').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Kecamatan Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#kecamatan').focus();
            var result = false;
        }
        else if($('#kota').val() == 0 || $('#kota').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Kota Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#kota').focus();
            var result = false;
        }
        else if($('#provinsi').val() == 0 || $('#provinsi').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Provinsi Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#provinsi').focus();
            var result = false;
        }
        else if($('#kodepos').val() == 0 || $('#kodepos').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Kode Pos Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#kodepos').focus();
            var result = false;
        }
        else{
            var result = true;
        }
        return result;
    };
    function FindData(){
        document.getElementById('kode').disabled = true; 
        document.getElementById('kelurahan').disabled = true;
        document.getElementById('kecamatan').disabled = true;
        document.getElementById('kota').disabled = true;
        document.getElementById('provinsi').disabled = true;
        document.getElementById('kodepos').disabled = true;
        document.getElementById('aktif').disabled = true;
        $('#save').prop('disabled', true);
        $('#update').prop('disabled', false);
        
    }
// -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();  
            var kode =  $('#kode').val();
            var kelurahan = $('#kelurahan').val();
            var kecamatan = $('#kecamatan').val();
            var kota = $('#kota').val();
            var provinsi = $('#provinsi').val();
            var kodepos = $('#kodepos').val();
            var aktif = $("input[name='aktif']:checked").val();

               
                    if(CekValidasi() == true){
                        $.ajax({  
                            url:"<?php echo base_url('masterdata/kodepos/save'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    kode:kode,
                                    kelurahan:kelurahan,
                                    kecamatan:kecamatan,
                                    kota:kota,
                                    provinsi:provinsi,
                                    kodepos:kodepos,
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
                                nmtb:"glbm_kodepos",
                                field:{kode:"kode",kelurahan:"kelurahan",kecamatan:"kecamatan",kota:"kota",provinsi:"provinsi",kodepos:"kodepos"},
                                sort:"kode,kelurahan"
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
                url:"<?php echo base_url('masterdata/kodepos/find'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            console.log(data);
                            $('#kode').val(data[i].kode.trim());
                            $('#kelurahan').val(data[i].kelurahan.trim());
                            $('#kecamatan').val(data[i].kecamatan.trim());
                            $('#kota').val(data[i].kota.trim());
                            $('#provinsi').val(data[i].provinsi.trim());
                            $('#kodepos').val(data[i].kodepos.trim());
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
            var kelurahan = $('#kelurahan').val();
            var kecamatan = $('#kecamatan').val();
            var kota = $('#kota').val();
            var provinsi = $('#provinsi').val();
            var kodepos = $('#kodepos').val();
            var aktif= $("input[name='aktif']:checked").val();

            if(CekValidasi() == true){
                    $.ajax({    
                        url:"<?php echo base_url('masterdata/kodepos/update'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                                kode:kode,
                                kelurahan:kelurahan,
                                kecamatan:kecamatan,
                                kota:kota,
                                provinsi:provinsi,
                                kodepos:kodepos,
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