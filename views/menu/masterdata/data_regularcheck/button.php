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
            
            $('#koderegular').val("");
            $('#namaregular').val("");
            $('#kodekeljasa').val("");
            $('#namakeljasa').val("");
            $('#kodereferensi').val("");
            $('#namareferensi').val("");
            $('#qty').val("0");
            $('#tablesearchtampil').css('visibility','hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('carikeljasa').disabled = false;
            document.getElementById('cariregular').disabled = false;
            $('#detaildata').empty();
            $("#carijasa").hide();
            $("#caripart").hide();
            $("#qty").hide();
        };
        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility','hidden');
        

        $("input[name='jenis']").change(function() {
            if($(this).val()=="true") {
                $("#carijasa").show();
                $("#caripart").hide();
                $("#qty").hide();
                $('#kodereferensi').val("");
                $('#namareferensi').val("");
                $('#qty').val("0");
            } else if ($(this).val()=="false") {
                $("#carijasa").hide();
                $("#caripart").show();
                $("#qty").show();
                $('#kodereferensi').val("");
                $('#namareferensi').val("");
                $('#qty').val("0");
            }
        });
    
        function cleardetail(){
            $('#detaildata').empty();
        }

        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };
        $("#qty").keypress(function(data) {
            return angka(data);
        });

//------------------validasi ---------------------------
    function CekValidasi() {
        if($('#kodekeljasa').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Model Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#kodekeljasa').focus();
            var result = false;
        }
        else  if($('#koderegular').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Regular Check Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#koderegular').focus();
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
            var koderegular = $('#koderegular').val();
            $.ajax({  
                url:"<?php echo base_url('masterdata/data_regularcheck/Getdetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode,koderegular:koderegular},  
                success:function(data){  
                    for(var i = 0; i < data.length; i++)
                    { 
                        var koderegular = data[i].kode_regularcheck.trim();
                        var namaregular = data[i].namaregular.trim();
                        var kodekeljasa = data[i].kode_model.trim();
                        var namakeljasa = data[i].namamodel.trim();
                        var kodereferensi = data[i].kode_referensi.trim();
                        var namareferensi = data[i].namaref.trim();
                        var qty = data[i].qty.trim();
                        var jenis = data[i].jenis.trim();
                        insertdetail(koderegular,namaregular,kodekeljasa,namakeljasa,kodereferensi,namareferensi,qty,jenis,"");
                    }
                }  
            });  
        };


// ---------- OnLookUp Regular Check --------------------------------------
        document.getElementById("cariregular").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchregular').DataTable({ 
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
                    "url":"<?php echo base_url('masterdata/data_regularcheck/Cariregularcheck'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"glbm_regularchecklist",
                        field:{kode:"kode",nama:"nama"},
                        sort:"kode",
                        where:{kode:"kode",nama:"nama"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);
        
        $(document).on('click', ".searchrc", function() {
            var result = $(this).attr("data-id");
                var kode = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/data_regularcheck/Getregularcheck'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#koderegular').val(data[i].kode.trim());
                            $('#namaregular').val(data[i].nama.trim());
                        }
                    }
                }, false);
                
            document.getElementById('cariregular').disabled = true;
        });
// ---------- OnLookUp Model --------------------------------------

        document.getElementById("carikeljasa").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchmodel').DataTable({ 
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
                    "url":"<?php echo base_url('masterdata/data_regularcheck/CariKelJasa'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"glbm_product",
                        field:{kode:"kode",nama:"nama"},
                        sort:"kode",
                        where:{kode:"kode",nama:"nama"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);
        
        $(document).on('click', ".searchmodel", function() {
            var result = $(this).attr("data-id");
                var kode = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/data_regularcheck/GetKeljasa'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#kodekeljasa').val(data[i].kode.trim());
                            $('#namakeljasa').val(data[i].nama.trim());
                            DataDetail(data[i].kode.trim());
                        }
                    }
                }, false);
                document.getElementById('carikeljasa').disabled = true;
        });

//---------------- Look Up Jasa -----------------------------------------------
        document.getElementById("carijasa").addEventListener("click", function(event) {
            event.preventDefault();
            var model = $('#kodekeljasa').val();
            $('#tablesearchjasa').DataTable({ 
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
                    "url":"<?php echo base_url('masterdata/data_regularcheck/CariDataJasa'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"cari_jasa",
                        field:{kode:"kode",nama:"nama"},
                        sort:"kode",
                        where:{kode:"kode",nama:"nama"},
                        value:"aktif = true and kodeproduct = '"+ model +"'"
                    },  
                }
            });
        }, false);
        
        $(document).on('click', ".searchjasa", function() {
            var result = $(this).attr("data-id");
                var kode = result.trim();
                var model = $('#kodekeljasa').val();
                $.ajax({  
                url:"<?php echo base_url('masterdata/data_regularcheck/GetJasa'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode,model:model},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#kodereferensi').val(data[i].kode.trim());
                            $('#namareferensi').val(data[i].nama.trim());
                        }
                    }
                }, false);
        });

        //---------------- Look Up Part -----------------------------------------------
        document.getElementById("caripart").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchpart').DataTable({ 
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
                    "url":"<?php echo base_url('masterdata/data_regularcheck/CariDataParts'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"glbm_parts",
                        field:{kode:"kode",nama:"nama",hargabeli:"hargabeli",hargajual:"hargajual"},
                        sort:"kode",
                        where:{kode:"kode",nama:"nama"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);
        
        $(document).on('click', ".searchparts", function() {
            var result = $(this).attr("data-id");
                var kode = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/data_regularcheck/GetParts'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#kodereferensi').val(data[i].kode.trim());
                            $('#namareferensi').val(data[i].nama.trim());
                            //$('#qty').val(data[i].qty.trim());
                        }
                    }
                }, false);
        });

// ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault(); 
            var datadetail = ambildatadetail();
            var koderegular = $('#koderegular').val();
            var kodekeljasa = $('#kodekeljasa').val();
                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('masterdata/data_regularcheck/Save'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                            koderegular : koderegular,
                            kodekeljasa : kodekeljasa,
                            datadetail : datadetail
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
                            $('#koderegular').val(data.koderegular);   
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
            var kode = $("#kodereferensi").val();
            var table = document.getElementById('detail');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string ="";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c==4) {
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
            if($('#kodereferensi').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Referensi Tidak Boleh Kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                   }
                }
            });   
            $('#kodereferensi').focus();
            var result = false;
            }
            else  if($('#kodekeljasa').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Model Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                        }
                    }
                });   
                $('#kodekeljasa').focus();
                var result = false;
            }
            else  if($('#koderegular').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Regular Check Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                        }
                    }
                });   
                $('#koderegular').focus();
                var result = false;
            }
            else
            {
                var koderegular = $("#koderegular").val();
                var namaregular = $("#namaregular").val();
                var kodekeljasa = $("#kodekeljasa").val();
                var namakeljasa = $("#namakeljasa").val();
                var kodereferensi = $("#kodereferensi").val();
                var namareferensi = $("#namareferensi").val();
                var qty = $("#qty").val();
                var jenis2 = $("input[name='jenis']:checked").val();
                if (jenis2 == 'true'){
                    var jenis = 'Jasa'
                }else{
                    var jenis = 'Part'
                };

                if (ValidasiAdd() == "sukses"){
                insertdetail(koderegular,namaregular,kodekeljasa,namakeljasa,kodereferensi,namareferensi,qty,jenis,"")
                $('#kodereferensi').val("");
                $('#namareferensi').val("");
                $('#qty').val("0");
                }
            }
        });    

        function insertdetail(koderegular,namaregular,kodekeljasa,namakeljasa,kodereferensi,namareferensi,qty,jenis,del){
            var row = "";
                row = 
                    '<tr id="'+ kodereferensi +'">' +
                        '<td>'+koderegular+'</td>' +
                        '<td>'+namaregular+'</td>' +
                        '<td>'+kodekeljasa+'</td>' +
                        '<td>'+namakeljasa+'</td>' +
                        '<td>'+kodereferensi+'</td>' +
                        '<td>'+namareferensi+'</td>' +
                        '<td>'+qty+'</td>' +
                        '<td>'+jenis+'</td>' +
                        '<td>' +
                            '<button data-table="'+ kodereferensi +'" class="hapus btn btn-close" '+del+'><i class="fa fa-times"></i></button>' +
                            // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                        '</td>' +
                    '</tr>';
                $('#detaildata').append(row);
             
        }

        function ambildatadetail() {
            var table = document.getElementById('detail');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 0) {
                        string = "{" + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }
                string = string + "}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }

        $(document).on('click','.hapus',function() {
            var id = $(this).attr("data-table");
            //console.log(id);
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