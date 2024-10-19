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
            
            $('#kodemodel').val("");
            $('#namamodel').val("");
            $('#kodejasa').val("");
            $('#namajasa').val("");
            $('#frt').val("0");
            $('#jam').val("0");
            $('#harga').val("0");
            $('#tablesearchtampil').css('visibility','hidden');

            document.getElementById('save').disabled = false;
            $('#detaildata').empty();
        };
        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility','hidden');
        
    
        function cleardetail(){
            $('#detaildata').empty();
        }
        
        function clearjasa(){
            $('#kodejasa').val("");
            $('#namajasa').val("");
            //$('#frt').val("0");
            $('#jam').val("0");
            $('#harga').val("0");
        }

        $("#new_detail").click(function() {
            $('#kodejasa').val("");
            $('#namajasa').val("");
            //$('#frt').val("0");
            $('#jam').val("0");
            $('#harga').val("0");
        });

        $("#jam").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<46 || data.which>57))
            {
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

        $("#jam").keyup(function(){
            var jam = this.value ;
            return HitungHarga();
        });

        function HitungHarga(){
            var jam = $('#jam').val();
            var frt = $('#frt').val().replace(",","").replace(",","").replace(",","").replace(",","");
            var total = parseFloat(frt.replace(",","").replace(",","").replace(",","").replace(",","")) * parseFloat(jam.replace(",","").replace(",","").replace(",","").replace(",",""));
            var totalx = Math.round(total);
            $('#harga').val(formatRupiah(totalx.toString(),''));
        }

//------------------validasi ---------------------------
    function CekValidasi() {
        if($('#kodemodel').val() == '' || $('#namamodel').val() == ''){
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
            $('#kodemodel').focus();
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
                url:"<?php echo base_url('masterdata/jasatipe/Getdetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                    for(var i = 0; i < data.length; i++)
                    { 
                        var KODE_JASA = data[i].kode.trim();
                        var NAMA_JASA = data[i].nama.trim();
                        var KODE_MODEL = data[i].kodeproduct.trim();
                        var NAMA_MODEL = data[i].namamodel.trim();
                        var FRT = formatRupiah(data[i].frt.trim(),"");
                        var JAM = data[i].jam.trim();
                        var HARGA_JASA = formatRupiah(data[i].harga.trim(),"");
                        insertdetaildata(KODE_JASA,NAMA_JASA,KODE_MODEL,NAMA_MODEL,FRT,JAM,HARGA_JASA,"");
                    }
                }  
            });  
        };

// ----------------------- DETAIL JASA ------------------------------------
        function JasaDetail(kode) {
            var kodeproduct = $('#kodemodel').val();
            $.ajax({
                url: "<?php echo base_url('masterdata/jasatipe/CariJasaDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode, kodeproduct:kodeproduct
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                       // $('#frt').val(formatRupiah(data[i].frt.trim(),""));
                        $('#jam').val(data[i].jam.trim());
                        $('#harga').val(formatRupiah(data[i].harga.trim(),""));
                    }
                }
            });
        }


// ---------- OnLookUp SPK --------------------------------------
        document.getElementById("carimodel").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility','visible');
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
                    "url":"<?php echo base_url('masterdata/jasatipe/Carimodel'); ?>",  
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
        
            //Close Pop UP Search
        document.getElementById("closesearchmodel").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchmodel", function() {
            var result = $(this).attr("data-id");
                var kode = result.trim();
                $.ajax({  
                url:"<?php echo base_url('masterdata/jasatipe/Carimodeldetail'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#kodemodel').val(data[i].kode.trim());
                            $('#namamodel').val(data[i].nama.trim());
                            $('#frt').val(formatRupiah(data[i].frt.trim(),""));
                            DataDetail(data[i].kode.trim());
                        }
                    }
                }, false);
            $('.popup1').css('visibility','hidden');
        });
// ---------- OnLookUp Parts --------------------------------------

        document.getElementById("carijasa").addEventListener("click", function(event) {
            $('.popup2').css('visibility','visible');
            clearjasa();
            event.preventDefault();
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
                    "url":"<?php echo base_url('masterdata/jasatipe/Carijasa'); ?>",  
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
        document.getElementById("closesearchjasa").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup2').css('visibility','hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchjasa", function() {
            var result = $(this).attr("data-id");
                var kode = result.trim();
                //var kodeproduct = $('#kodemodel').val();
                $.ajax({  
                url:"<?php echo base_url('masterdata/jasatipe/CariJasaHead'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                //data:{kode:kode,kodeproduct:kodeproduct},  
                data:{kode:kode},  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){                    
                            $('#kodejasa').val(data[i].kode.trim());
                            $('#namajasa').val(data[i].nama.trim());
                            JasaDetail(data[i].kode.trim());
                            // $('#frt').val(data[i].frt.trim());
                            // $('#jam').val(data[i].jam.trim());
                            // $('#harga').val(data[i].harga.trim());
                        }
                    }
                }, false);
            $('.popup2').css('visibility','hidden');
        });

// ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault(); 
            var datadetail = ambildatadetail();
            var kode = $('#kodemodel').val();
                if(CekValidasi() == true){
                    $.ajax({  
                        url:"<?php echo base_url('masterdata/jasatipe/Save'); ?>",  
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

        function cekdouble(KODE_JASA) {
            var table = document.getElementById('detail');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.trim() === KODE_JASA.trim()) {
                    result = false;
                }
            }
            return result;
        }

        $("#add_detail").click(function(){
            if($('#kodejasa').val() == '' || $('#namajasa').val() == ''){
                $.alert({
                title: 'Info..',
                content: 'Pilih Jasa Terlebih Dahulu',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                        }
                    }
                });   
                // alert('Pilih personil terlebih dahulu');
                $('#carijasa').focus();
            } else if
                ($('#kodemodel').val() == '' || $('#namamodel').val() == ''){
                $.alert({
                title: 'Info..',
                content: 'Pilih Model Terlebih Dahulu',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                        }
                    }
                });   
                // alert('Pilih personil terlebih dahulu');
                $('#carimodel').focus();
            } else if
                ($('#harga').val() == '' || $('#harga').val() == 0){
                $.alert({
                title: 'Info..',
                content: 'Harga tidak boleh kosong',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                        }
                    }
                });   
                // alert('Pilih personil terlebih dahulu');
                $('#carijasa').focus();
            } 
            else
            {
                var KODE_JASA = $("#kodejasa").val();
                var NAMA_JASA = $("#namajasa").val();
                var KODE_MODEL = $("#kodemodel").val();
                var NAMA_MODEL = $("#namamodel").val();
                var FRT = $("#frt").val();
                var JAM = $("#jam").val();
                var HARGA_JASA = $("#harga").val();

                if (cekdouble(KODE_JASA) == true) {
                insertdetaildata(KODE_JASA,NAMA_JASA,KODE_MODEL,NAMA_MODEL,FRT,JAM,HARGA_JASA,"")
                clearjasa();
                } else {
                    $.confirm({
                        title: 'Info !',
                        content: 'Data sudah ada di list, Apakah ingin menggantinya ?',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                action: function(data) {
                                    // console.log(KODE_JASA);
                                    $('#' + KODE_JASA).remove();
                                    insertdetaildata(KODE_JASA,NAMA_JASA,KODE_MODEL,NAMA_MODEL,FRT,JAM,HARGA_JASA,"")
                                    clearjasa();
                                }
                            },

                            cancel: function() {
                                //close
                            },
                        },
                        onContentReady: function() {
                            // bind to events
                            var jc = this;
                            this.$content.find('form').on('submit', function(e) {
                                // if the user submits the form by pressing enter in the field.                                                

                                e.preventDefault();
                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                            });
                        }
                    });
                }
            }
        });

        function insertdetaildata(KODE_JASA,NAMA_JASA,KODE_MODEL,NAMA_MODEL,FRT,JAM,HARGA_JASA,find){
            var row = "";
                row = 
                        '<tr id="'+ KODE_JASA +'">' +
                        '<td>'+KODE_JASA+'</td>' +
                        '<td>'+NAMA_JASA+'</td>' +
                        '<td>'+KODE_MODEL+'</td>' +
                        '<td>'+NAMA_MODEL+'</td>' +
                        '<td>'+FRT+'</td>' +
                        '<td>'+JAM+'</td>' +
                        '<td>'+HARGA_JASA+'</td>' +
                        '<td>' +
                            '<button data-table="'+ KODE_JASA +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
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
                        string = "{" + table.rows[0].cells[c].innerHTML.toLowerCase().replace("_", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                    else{
                        string = string + ", " + table.rows[0].cells[c].innerHTML.toLowerCase().replace("_", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";          
                    }
                }
                string = string+"}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
                // console.log(arr);
            }
            
            // console.log(arr2);
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
        
        document.getElementById("excel").addEventListener("click", function(event) {
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();

            window.open(
                "<?php echo base_url('export_excel/report/masterjasatipe/') ?>" + kodecabang + ":" + kodecompany
            );

        });
});
</script>