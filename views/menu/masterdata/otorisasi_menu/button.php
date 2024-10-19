<script type="text/javascript">
    $(document).ready( function () {
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
        }

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            return day + ' ' + month + ' ' + year;
        }

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
            $('#url').val("");
            $('#head').val("");
            $('#tablesearchtampil').css('visibility','hidden');

            document.getElementById('save').disabled = false;
            $('#detaildata').empty();
        };
        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility','hidden');
        
    
        function cleardetail(){
            $('#detaildata').empty();
        }

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
        }
        else{
            var result = true;
        }
        return result;
    };
// ---------- Get Data --------------------------------------
        function DataDetail(kode) {
            cleardetail();
            $.ajax({  
                url:"<?php echo base_url('masterdata/otorisasi_menu/Getdetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                    $('#record').val(data.length);
                    for(var i = 0; i < data.length; i++)
                    { 
                        var head = data[i].head.trim();
                        var menu = data[i].menu.trim();
                        var menuurl = data[i].menu_url.trim();
                        var urutan = data[i].pos.trim();
                        insertdetaildata(i,head,menu,menuurl,urutan,"");
                    }
                }  
            });  
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
                    "url":"<?php echo base_url('masterdata/otorisasi_menu/Carigrup'); ?>",  
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
            $('.popup1').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchgrup", function() {
            var result = $(this).attr("data-id");
                var kode = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/otorisasi_menu/Carigrupdetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#kode').val(data[i].kode.trim());
                            $('#grup').val(data[i].nama.trim());

                            DataDetail(data[i].kode.trim());
                        }
                    }
                }, false);
            $('.popup1').css('visibility','hidden');
        });
// ---------- OnLookUp Parts --------------------------------------

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
                    "url":"<?php echo base_url('masterdata/otorisasi_menu/CariMenu'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"stpm_menu",
                        field:{menu:"menu", menu_url:"menu_url"},
                        sort:"menu",
                        where:{menu:"menu", menu_url:"menu_url"},
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
                $.ajax({  
                url:"<?php echo base_url('masterdata/otorisasi_menu/CariMenuDetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{menu:menu},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#nama').val(data[i].menu.trim());
                            $('#url').val(data[i].menu_url.trim());
                            $('#head').val(data[i].head.trim());
                            $('#urutan').val(data[i].pos.trim());
                        }
                    }
                }, false);
            $('.popup2').css('visibility','hidden');
        });

// ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault(); 
            var datadetail = ambildatadetail();
            var kode = $('#kode').val();
                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('masterdata/otorisasi_menu/Save'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                            kode : kode,
                            detailrequest : datadetail
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
// ---------- ADD DETAIL TABLE ----------------------------------
        function ValidasiAdd(){
            var kode = $("#nama").val();
            var table = document.getElementById('detail');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string ="";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c==1) {
                        if (table.rows[r].cells[c].innerHTML == kode){
                            alert("data sudah pernah diinput")
                            return "gagal";
                        }
                    }
                }
            }
            return "sukses";
        }


        $("#add_detail").click(function(){
            if($('#nama').val() == '' || $('#url').val() == ''){
                $.alert({
                title: 'Info..',
                content: 'Pilih Menu nya terlebih dahulu',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                        }
                    }
                });   
                // alert('Pilih personil terlebih dahulu');
                $('#carimenu').focus();
            } 
            else
            {
                var head = $("#head").val();
                var menu = $("#nama").val();
                var menuurl = $("#url").val();
                var urutan = $("#urutan").val();

                if (ValidasiAdd() == "sukses"){
                    var record = parseInt(parseInt($('#record').val()) + parseInt(1));
                insertdetail(record,head,menu,menuurl,urutan,"")
                $("#head").val("");
                $("#nama").val("");
                $("#url").val("");
                $("#urutan").val("");
                }
            }
        });    

        function insertdetail(i,head,menu,menuurl,urutan,find){
            var row = "";
                row = 
                    '<tr id="'+ i +'">' +
                        '<td>'+head+'</td>' +
                        '<td>'+menu+'</td>' +
                        '<td>'+menuurl+'</td>' +
                        '<td>'+urutan+'</td>' +
                        '<td>' +
                            '<button data-table="'+ i +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                            // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                        '</td>' +
                    '</tr>';
                $('#detaildata').append(row);
                $('#record').val(i);
             
        }

        function insertdetaildata(i,head,menu,menuurl,urutan,find){
            var row = "";
                row = 
                        '<tr id="'+ i +'">' +
                        '<td>'+head+'</td>' +
                        '<td>'+menu+'</td>' +
                        '<td>'+menuurl+'</td>' +
                        '<td>'+urutan+'</td>' +
                        '<td>' +
                            '<button data-table="'+ i +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                            // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                        '</td>' +
                    '</tr>';
                $('#detaildata').append(row);
             
        }

        function ambildatadetail(){
            var table = document.getElementById('detail');
            var arr2 =[];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string ="";
                for (var c = 0, m = table.rows[r].cells.length; c < m-1; c++) {
                    if (c==0) {
                        string= "{"+table.rows[0].cells[c].innerHTML+" : '"+table.rows[r].cells[c].innerHTML+"'";
                    }
                    else{
                        string = string +", "+table.rows[0].cells[c].innerHTML+" : '"+table.rows[r].cells[c].innerHTML+"'";           
                    }
                }
                string = string+"}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }

        $(document).on('click','.hapus',function() {
            var id = $(this).attr("data-table");
            console.log(id);
            $('#'+id).remove();
            var table = document.getElementById('detaildata');
        });


    // ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {   
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
            
        });
});
</script>