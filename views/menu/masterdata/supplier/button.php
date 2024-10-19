<script type="text/javascript">
    $(document).ready( function () {  
        $('#tablesearchtampil').css('visibility','hidden');
        //disable tombol update
        $('#update').prop('disabled', true);
        $("#pkp").prop("checked", true);
        $("#aktif").prop("checked", true);
        $('#top').val('0')
        $('input[name=pkp]').change(function() {
        if (this.value == 'true') {
            document.getElementById('npwp').disabled = false;
            document.getElementById('namanpwp').disabled = false;
            document.getElementById('alamatnpwp').disabled = false;
        }
        else if (this.value == 'false') {
            document.getElementById('npwp').disabled = true;
            document.getElementById('namanpwp').disabled = true;
            document.getElementById('alamatnpwp').disabled = true;
        }
    });

// -- Validasi --
    function CekValidasi() {
        var pkp = $("input[name='pkp']:checked").val();
        if($('#nama').val() == 0 || $('#nama').val() == ''){
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
        else if($('#nohp').val() == 0 || $('#nohp').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'No. HP Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#nohp').focus();
            var result = false;
        }
        else if($('#notlp').val() == 0 || $('#notlp').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'No. Tlp Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#notlp').focus();
            var result = false;
        }
        else if($('#alamat').val() == 0 || $('#alamat').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Alamat Tidak Boleh Kosong',
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
        else if($("input[name='pkp']:checked").val() == "true"){
            var result = true;
            if($('#npwp').val() == 0 || $('#npwp').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'NPWP Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                        }
                    }
                });   
                $('#npwp').focus();
                var result = false;
            }
            else if($('#namanpwp').val() == 0 || $('#namanpwp').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Nama NPWP Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });   
                $('#namanpwp').focus();
                var result = false;
            }
            else if($('#alamatnpwp').val() == 0 || $('#alamatnpwp').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Alamat NPWP Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                        }
                    }
                });   
                $('#alamatnpwp').focus();
                var result = false;
            }
        }
        else{
            var result = true;
        }
        return result;
    };
    function FindData(){
        document.getElementById('nama').disabled = true; 
        document.getElementById('nohp').disabled = true;
        document.getElementById('notlp').disabled = true;
        document.getElementById('alamat').disabled = true;
        $('#save').prop('disabled', true);
        $('#update').prop('disabled', false);
        
    }
// -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();  
            var nama =  $('#nama').val();
            var nohp = $('#nohp').val();
            var notlp = $('#notlp').val();
            var alamat = $('#alamat').val();
            var pkp= $("input[name='pkp']:checked").val();
            var npwp= $('#npwp').val();
            var namanpwp= $('#namanpwp').val();
            var alamatnpwp= $('#alamatnpwp').val();
            var aktif= $("input[name='aktif']:checked").val(); 
            var top = $('#top').val();
            var norekening = $('#norekening').val();
            var namarekening = $('#namarekening').val();
            var namabank = $('#namabank').val();
                
                if(CekValidasi() == true){
                        $.ajax({  
                            url:"<?php echo base_url('masterdata/supplier/save'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    nama:nama,
                                    nohp:nohp,
                                    notlp:notlp,
                                    alamat:alamat,
                                    pkp:pkp,
                                    npwp:npwp,
                                    namanpwp:namanpwp,
                                    alamatnpwp:alamatnpwp,
                                    aktif:aktif,
                                    top:top,
                                    norekening:norekening,
                                    namarekening:namarekening,
                                    namabank:namabank
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
                // "scrollX": true,
                "scrollY": true,
                "ordering":  true,
                
                // "order":[0,1,2],  
                "ajax":{  
                        "url":"<?php echo base_url('caridata/caridata'); ?>",  
                        "method":"POST",
                        "data":{
                                nmtb:"glbm_supplier",
                                field:{nomor:"nomor",nama:"nama",notlp:"notlp",nohp:"nohp",alamat:"alamat"},
                                sort:"nomor,nama"
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
                var nomor = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/supplier/find'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{nomor:nomor},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            $('#nomor').val(data[i].nomor.trim());
                            $('#nama').val(data[i].nama.trim());
                            $('#nohp').val(data[i].nohp.trim());
                            $('#notlp').val(data[i].notlp.trim());
                            $('#alamat').val(data[i].alamat.trim());
                            $('#npwp').val(data[i].npwp.trim());
                            $('#namanpwp').val(data[i].namanpwp.trim());
                            $('#alamatnpwp').val(data[i].alamatnpwp.trim());
                            $('#top').val(data[i].top.trim());
                            $('#norekening').val(data[i].norekening.trim());
                            $('#namarekening').val(data[i].namarekening.trim());
                            $('#namabank').val(data[i].namabank.trim());
                            $('#save').prop('disabled', true);
                            $('#update').prop('disabled', false);
                            // console.log(data[i].pkp);
                            if (data[i].pkp == 't'){
                                document.getElementById('npwp').disabled = false;
                                document.getElementById('namanpwp').disabled = false;
                                document.getElementById('alamatnpwp').disabled = false;
                                $('input:radio[name="pkp"][value="true"]').prop('checked', true);
                            }
                            else{
                                document.getElementById('npwp').disabled = true;
                                document.getElementById('namanpwp').disabled = true;
                                document.getElementById('alamatnpwp').disabled = true;
                                $('input:radio[name="pkp"][value="false"]').prop('checked', true);
                            }
                            if (data[i].aktif == 't'){                        
                                $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                            }
                            else{
                                $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                            }
                        }
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
            var nohp = $('#nohp').val();
            var notlp = $('#notlp').val();
            var alamat = $('#alamat').val();
            var pkp= $("input[name='pkp']:checked").val();
            var npwp= $('#npwp').val();
            var namanpwp= $('#namanpwp').val();
            var alamatnpwp= $('#alamatnpwp').val();
            var aktif= $("input[name='aktif']:checked").val();
            var top = $('#top').val();
            var norekening = $('#norekening').val();
            var namarekening = $('#namarekening').val();
            var namabank = $('#namabank').val();

                if(nomor == '' || nomor =='S000000000'){
                    $.alert({
                        title: 'Info..',
                        content: 'Pilih data terlebih dahulu',
                        buttons: {
                        formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#nomor').focus();
                }
                else if(nama == ''){
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
                }
                else if(nohp == ''){
                    $.alert({
                        title: 'Info..',
                        content: 'No HP Tidak Boleh Kosong',
                        buttons: {
                        formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#nohp').focus();
                }
                else if(notlp == ''){
                    $.alert({
                        title: 'Info..',
                        content: 'No Tlp Tidak Boleh Kosong',
                        buttons: {
                        formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#notlp').focus();
                }
                else if(alamat == ''){
                    $.alert({
                        title: 'Info..',
                        content: 'Alamat Tidak Boleh Kosong',
                        buttons: {
                        formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#alamat').focus();
                }
                else if(pkp == undefined){
                    $.alert({
                        title: 'Info..',
                        content: 'Jenis PKP harus diisi',
                        buttons: {
                        formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#email').focus();
                }
                else if(pkp == true){
                    if(npwp==''){
                        $.alert({
                            title: 'Info..',
                            content: 'NPWP Tidak Boleh Kosong',
                            buttons: {
                            formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });
                        $('#npwp').focus();
                    }
                    else if(namanpwp == ''){
                        $.alert({
                            title: 'Info..',
                            content: 'Nama NPWP Tidak Boleh Kosong',
                            buttons: {
                            formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });
                        $('#namanpwp').focus();
                    }
                    else if(alamatnpwp == ''){
                        $.alert({
                            title: 'Info..',
                            content: 'Alamat NPWP Tidak Boleh Kosong',
                            buttons: {
                            formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });
                        $('#alamatnpwp').focus();
                    }     
                }
                else if(aktif == undefined){
                    $.alert({
                        title: 'Info..',
                        content: 'Jenis aktif harus dipilih',
                        buttons: {
                        formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#aktif').focus();
                }
                else{
                    
                        $.ajax({  
                            
                            url:"<?php echo base_url('masterdata/supplier/update'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    nomor:nomor,
                                    nama:nama,
                                    nohp:nohp,
                                    notlp:notlp,
                                    alamat:alamat,
                                    pkp:pkp,
                                    npwp:npwp,
                                    namanpwp:namanpwp,
                                    alamatnpwp:alamatnpwp,
                                    aktif:aktif,
                                    top:top,                                    
                                    norekening:norekening,
                                    namarekening:namarekening,
                                    namabank:namabank
                                },  
                            success:function(data){  
                                if (data.nomor  != ""){
                                    $.alert({
                                        title: 'Info..',
                                        content: 'Data berhasil diubah',
                                        buttons: {
                                        formSubmit: {
                                        text: 'OK',
                                        btnClass: 'btn-red'
                                            }
                                        }
                                    });
                                    $('#nomor').val(data.nomor);
                                }
                                else{
                                    $.alert({
                                        title: 'Info..',
                                        content: 'Data berhasil diubah',
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
// --END UPDATE --
        $("#nohp").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                return false;
            }
        });
        $("#notlp").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                return false;
            }
        });

        
        document.getElementById("export").addEventListener("click", function(event) {
            window.open(
                "<?php echo base_url('export_excel/report/mastersupplier/') ?>"
            );

        });
    });
</script>