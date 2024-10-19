<script type="text/javascript">
    $(document).ready( function () {  
        $('#tablesearchtampil').css('visibility','hidden');
        //disable tombol update
        $('#update').prop('disabled', true);
        $("#caritask").hide();
        $("#cariparts").hide();
        document.getElementById('edit_detail').disabled = true;
    });
</script>

<script type="text/javascript">
    $(document).ready( function () {  
        $('#tablesearchtampil').css('visibility','hidden');

// ---------- Validasi----------------------------------------
        function CekValidasi() {
            
            if($('#nomorsn').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Nomor SN Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                    }
                });   
                $('#carisn').focus();
                var result = false;
            }
            else if($('#kode_tipe').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Tipe Tidak Boleh Kosong',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                    }
                });   
                $('#caritipe').focus();
                var result = false;
            }
            else if($('#jenis').val() == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Jenis Service Tidak Boleh Kosong',
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
            else if($('#nocustomer').val()  == ''||$('#namacustomer').val()  == ''||$('#pic').val()  == ''||$('#nohp').val()  == ''||$('#nohp').val() == 0 ||$('#kategori').val()  == ''||$('#kode_teknisi').val()  == ''||$('#nama_teknisi').val()  == ''){
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Customer Terlebih Dahulu',
                    buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                    }
                });
                $('#caricustomer').focus();
                var result = false;
            }
            else{
                var result = true;
            }
            return result;
        };
// ---------- END Validasi ----------------------------------------

// ---------- FIND Data ----------------------------------------
        function DataCustomer(nocustomer) {
            $.ajax({  
                url:"<?php echo base_url('spk/entry_spk/GetDataCustomer'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{nocustomer:nocustomer},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                                                     
                            $('#namacustomer').val(data[i].nama.trim());
                        }
                    }  
            });  
        };

        function DataTipe(kode_tipe) {
            $.ajax({  
                url:"<?php echo base_url('spk/entry_spk/GetDataTipe'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode_tipe:kode_tipe},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                                                     
                            $('#nama_tipe').val(data[i].nama.trim());
                            $('#kode_kategori').val(data[i].kodekategori.trim());

                            DataProduct(data[i].kodekategori.trim());
                        }
                    }  
            });  
        };

        function DataProduct(kode) {
            $.ajax({  
                url:"<?php echo base_url('spk/entry_spk/GetDataProduct'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                                                     
                            $('#nama_kategori').val(data[i].nama.trim());
                        }
                    }  
            });  
        };

        function DataSN(nomorsn) {
            $.ajax({  
                url:"<?php echo base_url('spk/entry_spk/GetDataSN'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{nomorsn:nomorsn},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                                                     
                            $('#kode_tipe').val(data[i].kode_tipe.trim());
                            $('#nama_tipe').val(data[i].nama_tipe.trim());
                            $('#kode_kategori').val(data[i].kode_kategori.trim());
                            $('#nama_kategori').val(data[i].nama_kategori.trim());
                        }
                    }  
            });  
        };

        function DataTeknisi(kode) {
            $.ajax({  
                url:"<?php echo base_url('spk/entry_spk/GetDataTeknisi'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            $('#nama_teknisi').val(data[i].nama.trim());
                        }
                    }  
            });  
        };

        function DataParts(kode) {
            $.ajax({  
                url:"<?php echo base_url('spk/entry_spk/GetDataParts'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            $('#nama').val(data[i].nama.trim());
                            $('#harga').val(formatRupiah(data[i].hargajual.trim(),''));
                            $('#jenis_detail').val(1);
                        }
                    }  
            });  
        };

        function DataTask(kode) {
            $.ajax({  
                url:"<?php echo base_url('spk/entry_spk/GetDataTask'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            $('#nama').val(data[i].nama.trim());
                            $('#harga').val(formatRupiah(data[i].hargajual.trim(),''));
                            $('#jenis_detail').val(2);
                        }
                    }  
            });  
        };

        function FindData(){
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
            document.getElementById('cancel').disabled = false;
            document.getElementById('carisn').disabled = true;
            document.getElementById('caritipe').disabled = true;
            document.getElementById('caricustomer').disabled = true;
            document.getElementById('nomorsn').readOnly = true;
            document.getElementById('namacustomer').readOnly = true;
            document.getElementById('keluhan').readOnly = true;
            document.getElementById('jenis').disabled = true;
            //document.getElementById('cariteknisi').disabled = true;
            //document.getElementById('cariparts').disabled = true;
            //document.getElementById('caritask').disabled = true;
            //document.getElementById('add_detail').disabled = true;
            $('.hapus').prop("disabled", true);
        };

        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({  
                url:"<?php echo base_url('spk/entry_spk/FindDetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{nomor:nomor},  
                success:function(data){  
                    for(var i = 0; i < data.length; i++){ 
                        var jenis = data[i].jenis.trim();
                        var kode_referensi = data[i].kodereferensi.trim();
                        var nama_referensi = data[i].namareferensi.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(),'');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(),'');
                        inserttable(kode_referensi,nama_referensi,jenis,qty,harga,subtotal,"disabled");
                        }
                    }  
            });  
        };
// ----------END FIND Data ----------------------------------------
        function formatDate(input) {
            var datePart = input.match(/\d+/g),
            year = datePart[0].substring(0), 
            month = datePart[1], day = datePart[2];

            return day+'-'+month+'-'+year;
        }

        function BersihkanLayar(){
            location.reload(true);
        };
// ---------- ON LOOKUP SN ----------------------------------------
        document.getElementById("carisn").addEventListener("click", function(event) {
            $('.popup1').css('visibility','visible');
            event.preventDefault();
            var nomor = "test";
            $('#tablesearchsn').DataTable({ 
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
                    "url":"<?php echo base_url('spk/entry_spk/CariDataSN'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"trnt_databarang",
                        field:{nosn:"nosn",kode_tipe:"kode_tipe",nama_tipe:"nama_tipe",kode_kategori:"kode_kategori",nama_kategori:"nama_kategori"},
                        sort:"nosn",
                        where:{nosn:"nosn",kode_tipe:"kode_tipe",nama_tipe:"nama_tipe",kode_kategori:"kode_kategori",nama_kategori:"nama_kategori"},
                        value:"pemakai = '"+nomor+"'"
                    },  
                }
            });
        }, false);
        
            //Close Pop UP Search
        document.getElementById("closesearchsn").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchsn", function() {
            var result = $(this).attr("data-id");
            $('#nomorsn').val(result.trim()); 
            DataSN(result.trim());
            $('.popup1').css('visibility','hidden');
        });

// ---------- ON LOOKUP TIPE ----------------------------------------
        document.getElementById("caritipe").addEventListener("click", function(event) {
            $('.popup2').css('visibility','visible');
            event.preventDefault();
            $('#tablesearchtipe').DataTable({ 
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
                    "url":"<?php echo base_url('spk/entry_spk/CariDataTipe'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"glbm_tipe",
                        field:{kode:"kode", nama:"nama", kodekategori:"kodekategori"},
                        sort:"kode",
                        where:{kode:"kode", nama:"nama", kodekategori:"kodekategori"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);
        
            //Close Pop UP Search
        document.getElementById("closesearchtipe").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup2').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchtipe", function() {
            var result = $(this).attr("data-id");
            $('#kode_tipe').val(result.trim()); 
            DataTipe(result.trim());
            $('.popup2').css('visibility','hidden');
        });
// ---------- ON LOOKUP CUSTOMER ------------------------------------
        document.getElementById("caricustomer").addEventListener("click", function(event) {
            $('.popup3').css('visibility','visible');
            event.preventDefault();
            $('#tablesearchcustomer').DataTable({ 
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
                    "url":"<?php echo base_url('spk/entry_spk/CariDataCustomer'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"glbm_customer",
                        field:{nomor:"nomor", nama:"nama", alamat:"alamat", nohp:"nohp", email:"email"},
                        sort:"nomor",
                        where:{nomor:"nomor", nama:"nama", alamat:"alamat", nohp:"nohp", email:"email"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);
        
            //Close Pop UP Search
        document.getElementById("closesearchcustomer").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup3').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchcustomer", function() {
            var result = $(this).attr("data-id");
            $('#nocustomer').val(result.trim()); 
            DataCustomer(result.trim());
            $('.popup3').css('visibility','hidden');
        });
// ---------- ON LOOKUP TEKNISI ------------------------------------
        document.getElementById("cariteknisi").addEventListener("click", function(event) {
            $('.popup4').css('visibility','visible');
            event.preventDefault();
            $('#tablesearchteknisi').DataTable({ 
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
                    "url":"<?php echo base_url('spk/entry_spk/CariDataTeknisi'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"glbm_teknisi",
                        field:{kode:"kode", nama:"nama", alamat:"alamat"},
                        sort:"kode",
                        where:{kode:"kode", nama:"nama", alamat:"alamat"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);
        
            //Close Pop UP Search
        document.getElementById("closesearchteknisi").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup4').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchteknisi", function() {
            var result = $(this).attr("data-id");
            $('#kode_teknisi').val(result.trim()); 
            DataTeknisi(result.trim());
            $('.popup4').css('visibility','hidden');
        });
// ---------- ON LOOKUP PARTS ------------------------------------
        document.getElementById("cariparts").addEventListener("click", function(event) {
            $('.popup5').css('visibility','visible');
            event.preventDefault();
            $('#tablesearchparts').DataTable({ 
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
                    "url":"<?php echo base_url('spk/entry_spk/CariDataParts'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"glbm_parts",
                        field:{kode:"kode", nama:"nama"},
                        sort:"kode",
                        where:{kode:"kode", nama:"nama"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);
        
            //Close Pop UP Search
        document.getElementById("closesearchparts").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup5').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchparts", function() {
            var result = $(this).attr("data-id");
            $('#kode').val(result.trim()); 
            DataParts(result.trim());
            $('.popup5').css('visibility','hidden');
        });
// ---------- ON LOOKUP TASK ------------------------------------
        document.getElementById("caritask").addEventListener("click", function(event) {
            $('.popup6').css('visibility','visible');
            event.preventDefault();
            $('#tablesearchtask').DataTable({ 
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
                    "url":"<?php echo base_url('spk/entry_spk/CariDataTask'); ?>",  
                    "method":"POST",
                    "data":
                    {
                        nmtb:"glbm_jasa",
                        field:{kode:"kode", nama:"nama"},
                        sort:"kode",
                        where:{kode:"kode", nama:"nama"},
                        value:"aktif = true"
                    },  
                }
            });
        }, false);
        
            //Close Pop UP Search
        document.getElementById("closesearchtask").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup6').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchtask", function() {
            var result = $(this).attr("data-id");
            $('#kode').val(result.trim()); 
            DataTask(result.trim());
            $('.popup6').css('visibility','hidden');
        });






// -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayar();      
        }); 
// ---------- ON JENIS TABLE ------------------------------------
        document.getElementById("jenis_detail").addEventListener("change", function(event) {
            event.preventDefault();
            var jenis = $("#jenis_detail").val();

            var jenis = $("#jenis_detail").val();

            if (jenis == 1) {
                $("#caritask").hide();
                $("#cariparts").show();
            }
            else if (jenis ==2) 
            {
                $("#caritask").show();
                $("#cariparts").hide();
            }
            else
            {
                $("#caritask").hide();
                $("#cariparts").hide();
            }
                  
        });
// ---------- ADD DETAIL TABLE ----------------------------------
        $("#add_detail").click(function(){
            if($('#jenis_detail').val() == 0 ){
                $.alert({
                        title: 'Info..',
                        content: 'Pilih Jenis Detail Terlebih Dahulu',
                        buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });   
                        // alert('Pilih personil terlebih dahulu');
                        $('#jenis_detail').focus();
                
            } else if($('#jenis_detail').val() == 1 ){
                if($('#kode').val() == '' || $('#nama').val() == ''){
                        $.alert({
                        title: 'Info..',
                        content: 'Pilih Sparepart terlebih dahulu',
                        buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });   
                        // alert('Pilih personil terlebih dahulu');
                        $('#cariparts').focus();
                }
                else
                {
                    var jenis = $("#jenis_detail").val();
                    var kode = $("#kode").val();
                    var nama = $("#nama").val();
                    var harga = $("#harga").val();
                    var qty = $("#qty").val();
                    var total = $("#total").val();

                    insertdetail(kode,nama,jenis,harga,qty,total,"")
                    $("#kode").val("");
                    $("#nama").val("");
                    $("#harga").val("0");
                    $("#qty").val("0");
                    $('#jenis_detail').val(0);
                    $("#total").val("0");

                    $("#cariparts").hide();
                }
                
            }
            else if($('#jenis_detail').val() == 2 ){
                if($('#kode').val() == '' || $('#nama').val() == ''){
                        $.alert({
                        title: 'Info..',
                        content: 'Pilih Jasa terlebih dahulu',
                        buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });   
                        // alert('Pilih personil terlebih dahulu');
                        $('#caritask').focus();
                }
                else
                {
                    var jenis = $("#jenis_detail").val();
                    var kode = $("#kode").val();
                    var nama = $("#nama").val();
                    var harga = $("#harga").val();
                    var qty = $("#qty").val();
                    var total = $("#total").val();

                    insertdetail(kode,nama,jenis,harga,qty,total,"")
                    $("#kode").val("");
                    $("#nama").val("");
                    $("#harga").val("0");
                    $("#qty").val("0");
                    $('#jenis_detail').val(0);
                    $("#total").val("0");

                    $("#caritask").hide();
                }
                
            }
        });

        $("#edit_detail").click(function(){
            if($('#jenis_detail').val() == 0 ){
                $.alert({
                        title: 'Info..',
                        content: 'Pilih Jenis Detail Terlebih Dahulu',
                        buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });   
                        // alert('Pilih personil terlebih dahulu');
                        $('#jenis_detail').focus();
                
            } else if($('#jenis_detail').val() == 1 ){
                if($('#kode').val() == '' || $('#nama').val() == ''){
                        $.alert({
                        title: 'Info..',
                        content: 'Pilih Sparepart terlebih dahulu',
                        buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });   
                        // alert('Pilih personil terlebih dahulu');
                        $('#cariparts').focus();
                }
                else
                {
                    var jenis = $("#jenis_detail").val();
                    var kode = $("#kode").val();
                    var nama = $("#nama").val();
                    var harga = $("#harga").val();
                    var qty = $("#qty").val();
                    var total = $("#total").val();

                    _row.closest("tr").find("td").remove();

                    insertdetail(kode,nama,jenis,harga,qty,total,"")
                    $("#kode").val("");
                    $("#nama").val("");
                    $("#harga").val("0");
                    $("#qty").val("0");
                    $('#jenis_detail').val(0);
                    $("#total").val("0");

                    $("#cariparts").hide();

                    document.getElementById('jenis_detail').disabled = false;
                    document.getElementById('add_detail').disabled = false;
                    document.getElementById('edit_detail').disabled = true;
                }
                
            }
            else if($('#jenis_detail').val() == 2 ){
                if($('#kode').val() == '' || $('#nama').val() == ''){
                        $.alert({
                        title: 'Info..',
                        content: 'Pilih Jasa terlebih dahulu',
                        buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });   
                        // alert('Pilih personil terlebih dahulu');
                        $('#caritask').focus();
                }
                else
                {
                    var jenis = $("#jenis_detail").val();
                    var kode = $("#kode").val();
                    var nama = $("#nama").val();
                    var harga = $("#harga").val();
                    var qty = $("#qty").val();
                    var total = $("#total").val();

                    _row.closest("tr").find("td").remove();

                    insertdetail(kode,nama,jenis,harga,qty,total,"")
                    $("#kode").val("");
                    $("#nama").val("");
                    $("#harga").val("0");
                    $("#qty").val("0");
                    $('#jenis_detail').val(0);
                    $("#total").val("0");

                    $("#cariparts").hide();
                    
                    document.getElementById('jenis_detail').disabled = false;
                    document.getElementById('add_detail').disabled = false;
                    document.getElementById('edit_detail').disabled = true;
                }
                
            }
        });

        function inserttable(kode_referensi,nama_referensi,jenis,harga,qty,subtotal,find){
            var row = "";
                row = 
                    '<tr id="'+ jenis +'">' +
                        '<td style="display:none;"></td>' +
                        '<td>'+kode_referensi+'</td>' +
                        '<td>'+nama_referensi+'</td>' +
                        '<td>'+jenis+'</td>' +
                        '<td>'+harga+'</td>' +
                        '<td>'+qty+'</td>' +
                        // '<td id="ongkir-'+jenis+'">'
                        //     +ongkosharian+
                        // '</td>' +
                        '<td>'+subtotal+'</td>' +
                        '<td>' +
                            '<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                            // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                        '</td>' +
                    '</tr>';
            $('#detaildataspk').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN();
            Grandtotal();
        }

        function insertdetail(kode,nama,jenis,harga,qty,total,find){
            var row = "";
                row = 
                    '<tr id="'+ jenis +'">' +
                        '<td style="display:none;"></td>' +
                        '<td>'+
                            '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-check-square"></i></button>'+
                        '</td>' +
                        '<td>'+kode+'</td>' +
                        '<td>'+nama+'</td>' +
                        '<td>'+jenis+'</td>' +
                        '<td>'+qty+'</td>' +
                        '<td>'+harga+'</td>' +
                        '<td>'+total+'</td>' +
                        '<td>' +
                            '<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-trash"></i></button>' +
                        '</td>' +
                    '</tr>';
            $('#detaildataspk').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN();
            Grandtotal();
        }

        function subtotal(){
            var table = document.getElementById('detailspk');
            var total = 0;
            if (table.rows.length == 1){
                $("#dpp").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string ="";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c==7) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",","").replace(",","").replace(",","").replace(",",""))
                        $("#dpp").val(formatRupiah(total.toString(),''));
                        
                    }
                }
            }
        }

        function PPN(){
            var dpp = $('#dpp').val().replace(",","").replace(",","").replace(",","").replace(",","");

            var hitungppn = (parseFloat(dpp.replace(",","").replace(",","").replace(",","").replace(",","")) * 10)/100;
            var roundppn = Math.round(hitungppn);
            $('#ppn').val(formatRupiah(roundppn.toString(),''));
        }

        function Grandtotal(){
            var dpp = $('#dpp').val().replace(",","").replace(",","").replace(",","").replace(",","");
            var ppn = $('#ppn').val().replace(",","").replace(",","").replace(",","").replace(",","");
            var total = parseInt($('#ppn').val().replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt($('#dpp').val().replace(",","").replace(",","").replace(",","").replace(",",""));
            $('#grandtotal').val(formatRupiah(total.toString(),''));
        }


        function cleardetail(){
            $('#detaildataspk').empty();
        }

        $(document).on('click','.hapus',function() {
            var id = $(this).attr("data-table");
            $('#'+id).remove();
            var table = document.getElementById('detaildataspk');
            subtotal();
            PPN();
            Grandtotal();
        });

        $(document).on('click','.edit',function() {
            
            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode = _row.closest("tr").find("td:eq(2)").text();
            var nama = _row.closest("tr").find("td:eq(3)").text();
            var jenis = _row.closest("tr").find("td:eq(4)").text();
            var qty = _row.closest("tr").find("td:eq(5)").text();
            var harga = _row.closest("tr").find("td:eq(6)").text();
            var subtotal = _row.closest("tr").find("td:eq(7)").text();
            $('#kode').val(kode);
            $('#nama').val(nama);
            $('#jenis_detail').val(jenis);
            $('#qty').val(qty);
            $('#harga').val(harga);
            $('#total').val(subtotal);

            document.getElementById('jenis_detail').disabled = true;
            document.getElementById('add_detail').disabled = true;
            document.getElementById('edit_detail').disabled = false;
            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        function ambildatadetail(){
            var table = document.getElementById('detailspk');
            var arr2 =[];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string ="";
                for (var c = 1, m = table.rows[r].cells.length; c < m-1; c++) {
                    if (c==1) {
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

// ---------- CALCULATE ---------------------------------------------

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

        $('#qty').on('change', function() {
            var harga = $('#harga').val().replace(",","").replace(",","").replace(",","").replace(",","");
            var qty = $('#qty').val();

            var hitungtotal = parseFloat(harga.replace(",","").replace(",","").replace(",","").replace(",","")) * parseFloat(qty.replace(",","").replace(",","").replace(",","").replace(",",""));
            $('#total').val(formatRupiah(hitungtotal.toString(),''));

        });

// ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault(); 
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var nosn = $('#nomorsn').val();
            var nomor_customer = $('#nocustomer').val();
            var kategori = $('#kode_kategori').val();
            var tipe = $('#kode_tipe').val();
            //var garansi = $('#warranty').val();
            var garansi = $("input[name='warranty']:checked").val();
            var jenisservice = $('#jenis').val();
            var tanggal= $('.tanggal').val();
            var keterangan= $('#keterangan').val();
            var pic= $('#pic').val();
            var nohppic= $('#nohp').val();
            var dpp= $('#dpp').val();
            var ppn= $('#ppn').val();
            var grandtotal= $('#grandtotal').val();
                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('spk/entry_spk/Save'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                            nomor : nomor,
                            nosn : nosn,
                            nomor_customer : nomor_customer,
                            kategori : kategori,
                            tipe : tipe,
                            garansi : garansi,
                            jenisservice : jenisservice,
                            tanggal : tanggal,
                            keterangan : keterangan,
                            pic : pic,
                            nohppic : nohppic,
                            dpp : dpp,
                            ppn : ppn,
                            grandtotal : grandtotal,
                            detailspk : datadetail
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

// ---------- ON BUTTON FIND ---------------------------------------------
        document.getElementById("find").addEventListener("click", function(event) {
                event.preventDefault(); 
                $('.popup7').css('visibility','visible');
                var pemakai = "test";
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
                            "url":"<?php echo base_url('spk/entry_spk/CariDataFind'); ?>",  
                            "method":"POST",
                            "data":{
                                    nmtb:"trnt_wo",
                                    field:{nomor:"nomor",nosn:"nosn",nomor_customer:"nomor_customer",kategori:"kategori",tipe:"tipe"},
                                    sort:"nomor",
                                    where:{nomor:"nomor",nosn:"nosn",nomor_customer:"nomor_customer",kategori:"kategori",tipe:"tipe"},
                                    value:"pemakai = '"+pemakai+"'"
                                    },  
                    }
                });
            }, false);
                    
            //Close Pop UP Search
            document.getElementById("closesearch").addEventListener("click", function(event) {
                event.preventDefault();
                $('.popup7').css('visibility','hidden');
                    // location.reload(true);
            }, false);

            $(document).on('click', ".searchok", function() {
                var result = $(this).attr("data-id");
                var nomor = result.trim();
                $.ajax({  
                url:"<?php echo base_url('01_SPK/ENTRY_SPK/Find'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{nomor:nomor},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#nomor').val(data[i].nomor.trim());
                            $('#nomorsn').val(data[i].nosn.trim());
                            $('#nocustomer').val(data[i].nomor_customer.trim());
                            $('#keluhan').val(data[i].keluhan.trim());
                            $('#kode_kategori').val(data[i].kategori.trim());
                            $('#kode_tipe').val(data[i].tipe.trim());
                            if (data[i].garansi == 'true'){                        
                                $('input:radio[name="warranty"][value="true"]').prop('checked', true);
                            }
                            else{
                                $('input:radio[name="warranty"][value="false"]').prop('checked', true);
                            }
                            $('#jenis').val(data[i].jenisservice.trim());
                            $('#tanggal').val(formatDate(data[i].tanggal));
                            $('#keterangan').val(data[i].keterangan.trim());
                            $('#pic').val(data[i].pic.trim());
                            $('#nohp').val(data[i].nohppic.trim());
                            $('#dpp').val(data[i].dpp.trim());
                            $('#ppn').val(data[i].ppn.trim());
                            $('#grandtotal').val(data[i].grandtotal.trim());
                            $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                            $('#nama_teknisi').val(data[i].nama_teknisi.trim());

                            DataCustomer(data[i].nomor_customer.trim());
                            DataTipe(data[i].tipe.trim());
                            DataProduct(data[i].kategori.trim());


                            FindDataDetail(data[i].nomor.trim());
                        }
                        FindData();
                    }
                }, false);
                $('.popup7').css('visibility','hidden');
            });
            // -- END FIND --


// ---------- ON BUTTON UPDATE ---------------------------------------------
            document.getElementById("update").addEventListener("click", function(event) {
                event.preventDefault();
                //var datadetail = ambildatadetail();
                var nomor = $('#nomor').val();
                var garansi = $("input[name='warranty']:checked").val();
                var tanggal= $('.tanggal').val();
                var keterangan= $('#keterangan').val();
                var pic = $('#pic').val();
                var nohppic = $('#nohp').val();
                var dpp= $('#dpp').val();
                var ppn= $('#ppn').val();
                var grandtotal= $('#grandtotal').val();
                

                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('spk/entry_spk/Update'); ?>",  
                        method:"POST", 
                        dataType: "json",
                        async : true,
                        data:{
                                nomor:nomor,
                                garansi:garansi,
                                tanggal:tanggal,
                                keterangan : keterangan,
                                pic:pic,
                                nohppic:nohppic,
                                dpp : dpp,
                                ppn : ppn,
                                grandtotal : grandtotal,
                                //detailspk:datadetail
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
                    });
                } 
            });

// ---------- ON BUTTON CANCEL ---------------------------------------------
            document.getElementById("cancel").addEventListener("click", function(event) {
                event.preventDefault();
                var nomor = $('#nomor').val();
                if(CekValidasi() == true){
                    $.confirm({
                        title: 'Info..',
                        content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Apakah anda yakin ?</label>' +
                        '<input type="text" placeholder="Masukkan Alasan Pembatalan" class="alasan form-control" required />' +
                        // '<textarea class="Alamat form-control" placeholder="alasan"  required />' +
                        '</div>' +
                        '</form>',
                        buttons: {
                            formSubmit: {
                                text: 'Ok',
                                btnClass: 'btn-red',
                                action: function () {
                                    var alasan = this.$content.find('.alasan').val();
                                    if(!alasan){
                                        $.alert('Alasan belum diisi');
                                        return false;
                                    }
                                    $.ajax({  
                                            url:"<?php echo base_url('spk/entry_spk/Cancel'); ?>",  
                                            method:"POST", 
                                            dataType: "json",
                                            async : true,
                                            data:{
                                                    nomor:nomor,
                                                    alasan:alasan
                                                },  
                                            success:function(data){ 
                                                if(data.error == true) {
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
                                                else{
                                                    $.alert({
                                                            title: 'Info..',
                                                            content: data.message,
                                                            buttons: {
                                                            formSubmit: {
                                                                text: 'OK',
                                                                btnClass: 'btn-red',
                                                                keys: ['enter', 'shift'],
                                                                action: function(){
                                                                    BersihkanLayar()
                                                                    }
                                                                }
                                                            }                                                 
                                                    });                                            
                                                }
                                            }                                                    
                                        });  
                                    }
                            },
                            cancel: function () {
                                //close
                            },
                            
                        },
                        onContentReady: function () {
                            // bind to events
                            var jc = this;
                            this.$content.find('form').on('submit', function (e) {
                                // if the user submits the form by pressing enter in the field.
                                e.preventDefault();
                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                            });                    
                        }
                    });
                }
            });










    });
</script>