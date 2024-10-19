<script type="text/javascript">
    $(document).ready( function () {
        var _row = null;
        
        function getbulan(date) {
            switch (date) {
                case 1:
                    return "January";
                    break;
                case 2:
                    return "February";
                    break;
                case 3:
                    return "March";
                    break;
                case 4:
                    return "April";
                    break;
                case 5:
                    return "May";
                    break;
                case 6:
                    return "June";
                    break;
                case 7:
                    return "July";
                    break;
                case 8:
                    return "August";
                    break;
                case 9:
                    return "September";
                    break;
                case 10:
                    return "October";
                    break;
                case 11:
                    return "November";
                    break;
                case 12:
                    return "December";
                    break;
            }
        };

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            return day + ' ' + month + ' ' + year;
        };

        function BersihkanLayarBaru(){
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            
            $('#grup').val("");
            $('#kode').val("");
            $('#nama').val("");
            $('#maxdisc').val("0");
            $('#module').val("0");
            $("#aktif").prop("checked", "true");
            $('#tablesearchtampil').css('visibility','hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('update').disabled = true;
            GetDataOtorisasiD();
            
            
        };

        function DataOD(_module,grup) {
            $.ajax({  
                url:"<?php echo base_url('masterdata/Otorisasi_discount/GetDataOD'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{
                    module:_module,
                    grup:grup
                    },  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                                                     
                            $('#grup').val(data[i].nama.trim());
                            $('#maxdisc').val(data[i].maxdisc.trim());
                            $('#module').val(data[i].module.trim());
                            if (data[i].aktif == 't'){                        
                                $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                            }
                            else {
                                $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                            }
                        }
                    }  
            });  
        };

        function GetDataOtorisasiD() {
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "order": [],
                "ajax": {
                    "url":"<?php echo base_url('masterdata/Otorisasi_discount/CariDataOtorisasiD'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"stpm_grupdiscount",
                        field:{module:"module",grup:"grup",nama:"nama",maxdisc:"maxdisc",pemakai:"pemakai"},
                        sort:"module",
                        where:{module:"module",grup:"grup",nama:"nama",pemakai:"pemakai"}
                    },
                }
            });
        }

        $(document).on('click', ".searchod", function() {
            _row = $(this);
            //var id = $(this).attr("data-yes");
            var _module = _row.closest("tr").find("td:eq(1)").text();
            var grup = _row.closest("tr").find("td:eq(2)").text();
            var nama = _row.closest("tr").find("td:eq(3)").text();
            var maxdisc = _row.closest("tr").find("td:eq(4)").text();
            $('#kode').val(grup);
            // $('#grup').val(nama);
            // $('#module').val(_module);
            // $('#maxdisc').val(maxdisc);

            DataOD(_module,grup);
            document.getElementById('module').disabled = true;
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
        });

        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility','hidden');
        
//------------------validasi ---------------------------
        function CekValidasi() {
            if($('#kode').val() == '' || $('#grup').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Group Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                    }
                });   
                $('#kode').focus();
                var result = false;
            } else if($('#module').val() == '0' || $('#module').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Kategori Disc Terlebih Dahulu',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                    }
                });   
                $('#module').focus();
                var result = false;
            }
            else{
                var result = true;
            }
            return result;
        };
// ---------- OnLookUp SPK --------------------------------------
        document.getElementById("carigrup").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility','visible');
            $('#tablesearchgrup').DataTable({ 
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
                "ajax":
                {  
                    "url":"<?php echo base_url('masterdata/Otorisasi_discount/Carigrup'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"stpm_grup",
                        field:{kode:"kode",nama:"nama"},
                        sort:"kode",
                        where:{kode:"kode",nama:"nama"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchgrup").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchtampil').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchgrup", function() {
            var result = $(this).attr("data-id");
                var kode = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/otorisasi_menu/CarigrupDetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#kode').val(data[i].kode.trim());
                            $('#grup').val(data[i].nama.trim());
                        }
                    }
                }, false);
            $('.popup1').css('visibility','hidden');
        });
// ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var kode = $('#kode').val();
            var _module = $('#module').val();
            var nama = $('#grup').val();
            var maxdisc = $('#maxdisc').val();
            var aktif= $("input[name='aktif']:checked").val();
                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('masterdata/Otorisasi_discount/Save'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                            kode : kode,
                            module : _module,
                            nama : nama,
                            maxdisc : maxdisc,
                            aktif : aktif
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
                            $('#kode').val(data.kode);   
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
                            BersihkanLayarBaru();
                        }   
                    }, false);
                }        
        });
// ---------- On Button Update --------------------------------------
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var _module = $('#module').val();
            var kode = $('#kode').val();
            var nama = $('#grup').val();
            var maxdisc = $('#maxdisc').val();
            var aktif= $("input[name='aktif']:checked").val();
                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('masterdata/Otorisasi_discount/Update'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                            module : _module,
                            kode : kode,
                            nama : nama,
                            maxdisc : maxdisc,
                            aktif : aktif
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
                            $('#kode').val(data.kode);   
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
                            BersihkanLayarBaru();
                        }   
                    }, false);
                }        
        });
// ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {   
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
            
        });
});
</script>