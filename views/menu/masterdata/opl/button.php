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
        else if($('#hargajual').val() == 0 || $('#hargajual').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Harga Jual Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            }
        );   
            $('#hargajual').focus();
            var result = false;       
        }
        else if($('#hargabeli').val() == 0 || $('#hargabeli').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Harga Beli Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            }
        );   
            $('#hargabeli').focus();
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
        document.getElementById('hargajual').disabled = true;
        document.getElementById('aktif').disabled = true;
        $('#save').prop('disabled', true);
        $('#update').prop('disabled', false);
        
    }
// -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();  
            var kode =  $('#kode').val();
            var nama = $('#nama').val();
            var hargajual = $('#hargajual').val();
            var hargabeli = $('#hargabeli').val();
            var aktif= $("input[name='aktif']:checked").val();

                    if(CekValidasi() == true){
                        $.ajax({  
                            url:"<?php echo base_url('masterdata/opl/save'); ?>",  
                            method:"POST", 
                            dataType: "json",
                            async : true,
                            data:{
                                    kode:kode,
                                    nama:nama,
                                    hargajual:hargajual,
                                    hargabeli:hargabeli,
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
        // document.getElementById("find").addEventListener("click", function(event) {
        //     $('#tablesearchtampil').css('visibility','visible');
        //     event.preventDefault();
        //     $('#tablesearch').DataTable({ 
        //         "destroy": true,
        //         "searching": true,
        //         "processing":true,  
        //         "serverSide":true,
        //         "lengthChange": false,
        //         // "scrollX": true,
        //         "scrollY": true,
        //         "ordering":  true,
                
        //         // "order":[0,1,2],  
        //         "ajax":{  
        //                 "url":"<?php echo base_url('caridata/caridata'); ?>",  
        //                 "method":"POST",
        //                 "data":{
        //                         nmtb:"glbm_jasaopl",
        //                         field:{kode:"kode",nama:"nama"},
        //                         sort:"kode"
        //                         },  
        //         },
        //         "order":[], 
        //     });
        // }, false);

        document.getElementById("find").addEventListener("click", function(event) {
            $('#tablesearchtampil').css('visibility', 'visible');
            event.preventDefault();
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // "scrollX": true,
                "scrollY": true,
                // "ordering": true,

                "order":[],  
                "ajax": {
                    "url": "<?php echo base_url('masterdata/opl/finddata'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_jasaopl",
                        field:{kode:"kode",nama:"nama"},
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true"
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
                url:"<?php echo base_url('masterdata/opl/find'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            $('#kode').val(data[i].kode.trim());
                            $('#nama').val(data[i].nama.trim());
                            $('#hargajual').val(formatRupiah(data[i].hargajual.trim(),''));                                                
                            $('#hargabeli').val(formatRupiah(data[i].hargabeli.trim(),''));  
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
            var hargajual =  $('#hargajual').val();
            var hargabeli =  $('#hargabeli').val();
            var aktif= $("input[name='aktif']:checked").val();

            if(CekValidasi() == true){
                $.ajax({    
                    url:"<?php echo base_url('masterdata/opl/update'); ?>",  
                    method:"POST", 
                    dataType: "json",
                    async : true,
                    data:{
                            kode:kode,
                            nama:nama,
                            hargajual:hargajual,
                            hargabeli:hargabeli,
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
        $("#hargajual").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                return false;
            }
        });

        $("#hargabeli").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                return false;
            }
        });

        $("#kode").keypress(function(data) {
            if ((data.which < 97 || data.which > 122) && (data.which < 45 || data.which > 45) && (data.which < 48 || data.which > 57) && (data.which < 65 || data.which > 90)) {
                return false;
            }
        });

        function formatRupiah(angka,prefix){
            var number_string = angka.replace(/[^.\d]/g, '').toString(),
            split   		= number_string.split('.'),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? ',' : '';
                rupiah += separator + ribuan.join(',');
            }

            rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        };

        var nominal = document.getElementById('hargajual');
            nominal.addEventListener('keyup', function(e){
                nominal.value = formatRupiah(this.value,'');
        });

        var nominal2 = document.getElementById('hargabeli');
            nominal2.addEventListener('keyup', function(e){
                nominal2.value = formatRupiah(this.value,'');
        });

        document.getElementById("excel").addEventListener("click", function(event) {
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();

            window.open(
                "<?php echo base_url('export_excel/report/masteropl/') ?>" + kodecabang + ":" + kodecompany
            );

        });
    });
</script>