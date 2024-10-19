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
            
            $('#kodegrup').val("");
            $('#namagrup').val("");
            $('#head').val("");
            $('#nama_menu').val("");
            $("#otoritas").prop("checked", "true");
            $('#tablesearchtampil').css('visibility','hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('update').disabled = true;
            GetDataOtorisasi();
            
            
        };

        function DataGrup(kode_grup) {
            $.ajax({  
                url:"<?php echo base_url('masterdata/Otorisasi_pembatalan/GetDataGrup'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{
                    kode_grup:kode_grup
                },  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            $('#namagrup').val(data[i].nama.trim());
                        }
                    }  
            });  
        };

        function GetDataOtorisasi() {
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "order": [],
                "ajax": {
                    "url":"<?php echo base_url('masterdata/Otorisasi_pembatalan/CariDataOtorisasi'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"stpm_otorisasipembatalan",
                        field:{grup:"grup",head_menu:"head_menu",nama_menu:"nama_menu",otoritas_batal:"otoritas_batal"},
                        sort:"grup,head_menu",
                        where:{grup:"grup",head_menu:"head_menu",nama_menu:"nama_menu",otoritas_batal:"otoritas_batal"}
                    },
                }
            });
        }

        $(document).on('click', ".searchop", function() {
            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode_grup = _row.closest("tr").find("td:eq(1)").text();
            var head_menu = _row.closest("tr").find("td:eq(2)").text();
            var nama_menu = _row.closest("tr").find("td:eq(3)").text();
            var otoritas = _row.closest("tr").find("td:eq(4)").text();
            $('#kodegrup').val(kode_grup);
            $('#head').val(head_menu);
            $('#nama_menu').val(nama_menu);
            if (otoritas == 'YES'){                        
                $('input:radio[name="otoritas"][value="YES"]').prop('checked', true);
            }
            else {
                $('input:radio[name="otoritas"][value="NO"]').prop('checked', true);
            }

            DataGrup(kode_grup);
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
        });

        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility','hidden');
        
//------------------validasi ---------------------------
        function CekValidasi() {
            if($('#kodegrup').val() == '' || $('#namagrup').val() == ''){
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
                $('#kodegrup').focus();
                var result = false;
            } else if($('#head').val() == '' || $('#nama_menu').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Menu Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                    }
                });   
                $('#head').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };
// ---------- OnLookUp Grup --------------------------------------
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
                            $('#kodegrup').val(data[i].kode.trim());
                            $('#namagrup').val(data[i].nama.trim());
                        }
                    }
                }, false);
            $('.popup1').css('visibility','hidden');
        });

        //Close Pop UP Search
        document.getElementById("closesearchgrup").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility','hidden');
            // location.reload(true);
        }, false);


// ---------- OnLookUp Menu --------------------------------------
        document.getElementById("carimenu").addEventListener("click", function(event) {
            $('.popup2').css('visibility','visible');
            event.preventDefault();
            $('#tablesearchmenu').DataTable({ 
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
                    "url":"<?php echo base_url('masterdata/otorisasi_pembatalan/CariMenu'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"stpm_menu",
                        field:{menu:"menu"},
                        sort:"menu",
                        where:{menu:"menu"},
                        value:"aktif = true and grup = 'system'"
                    },  
                }
            });
        }, false);
        
        //Close Pop UP Search
        document.getElementById("closesearchmenu").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup2').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchmenu", function() {
            var result = $(this).attr("data-id");
                var menu = result.trim();
                console.log(menu);
                $.ajax({  
                url:"<?php echo base_url('masterdata/otorisasi_pembatalan/CariMenuDetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{menu:menu},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#head').val(data[i].head.trim());
                            $('#nama_menu').val(data[i].menu.trim());
                        }
                    }
                }, false);
            $('.popup2').css('visibility','hidden');
        });
// ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var kodegrup = $('#kodegrup').val();
            var head_menu = $('#head').val();
            var nama_menu = $('#nama_menu').val();
            var otoritas_batal= $("input[name='otoritas']:checked").val();
                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('masterdata/Otorisasi_pembatalan/Save'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                            kodegrup : kodegrup,
                            head_menu : head_menu,
                            nama_menu : nama_menu,
                            otoritas_batal : otoritas_batal
                        },  
                        success:function(data){  
                        if (data.kodegrup  != ""){
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
                            $('#kodegrup').val(data.kodegrup);   
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
            var kodegrup = $('#kodegrup').val();
            var head_menu = $('#head').val();
            var nama_menu = $('#nama_menu').val();
            var otoritas_batal= $("input[name='otoritas']:checked").val();
                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('masterdata/Otorisasi_pembatalan/Update'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                            kodegrup : kodegrup,
                            head_menu : head_menu,
                            nama_menu : nama_menu,
                            otoritas_batal : otoritas_batal
                        },  
                        success:function(data){  
                        if (data.kodegrup  != ""){
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
                            $('#kodegrup').val(data.kodegrup);   
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