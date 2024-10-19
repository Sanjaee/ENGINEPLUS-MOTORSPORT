<script type="text/javascript">
    $(document).ready(function() {
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
        // ------------- Otorisasi Pembatalan -------------
        <?php

        $grup = $this->session->userdata('mygrup');	
        $nama_menu = 'Pencairan Kartu D & K';

        $get["otorisasi"] = $this->db->query("SELECT * FROM stpm_otorisasipembatalan
        WHERE grup = '".$grup."' AND nama_menu = '".$nama_menu."' AND otoritas_batal = 'YES' ")->result();

        if (!$get["otorisasi"]) {
            $result = 'NO';
        }
        else {
            $result = 'YES';
        }

        ?>

        var otoritas_batal = "<?php echo $result?>";

        if (otoritas_batal == 'YES') {
            $("#cancel").show();
        } else {
            $("#cancel").hide();
        }
        // -------------------------------------------

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            return day + ' ' + month + ' ' + year;
        }

        function Bersihkanlayarbaru() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            var kode_cabang = $('#scabang').val();
            $('#nomor').val(kode_cabang + "-CX" + yr + mt + "00000");
            $('#tglpelunasan').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#kodetransaksi').val("");
            $('#namatransaksi').val("");
            $('#noaccount').val("");
            $('#bankcharge').val("0");
            $('#totalterima').val("0");
            $('#jenis').val("-");
            // $('#tglpelunasan').prop("disabled", true);
            document.getElementById('carinomoraccount').disabled = false;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            $('#detailtable').empty();
          
        }

        $('#tanggal').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
            // todayHighlight: true,
            // startDate: new Date()
        });
        Bersihkanlayarbaru();
        datalist('-');
        $('#tablesearchtampil').css('visibility', 'hidden');


        document.getElementById("carinomoraccount").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchcoa').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/pencairankartu/caricoa'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_account",
                        field: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        // sort: "kode",
                        where: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        value: "aktif = true  and jenisaccount = 2  and  kodecompany = '" + kodecompany + "' and (kode_cabang  = '" + kodecabang + "' or kode_cabang  = 'ALL')"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchcoa", function() {
            var result = $(this).attr("data-id");
            $('#noaccount').val(result.trim());
            loadnamaaccountkasir(result.trim());

        });

        function loadnamaaccountkasir(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/pencairankartu/namaaccount'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#namaaccount').val(data[i].nama.trim());
                    }
                }
            });
        }


        function subtotal() {
            var table = document.getElementById('tablelistdata');
            var total = 0;
            if (table.rows.length == 1) {
                $("#total").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 6) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", ""))
                        $("#total").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {

            var number_string = angka.replace(/[^.\d]/g, '').toString(),
                split = number_string.split('.'),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? ',' : '';
                rupiah += separator + ribuan.join(',');
            }

            rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        };

        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };
        $("#bankcharge").keypress(function(data) {
            return angka(data);
        });

        $('#bankcharge').keyup(function() {
            var bankcharge = this.value;
            return HitungTotal();
        });
        
        function HitungTotal(){
            var bankcharge = $('#bankcharge').val();
            var total = parseInt($('#total').val().replace(",","").replace(",","").replace(",","").replace(",","")) - parseFloat(bankcharge.replace(",","").replace(",","").replace(",","").replace(",",""));
            $('#totalterima').val(formatRupiah(total.toString(),''));
            //$('#total').val(total.toString());
            
        }

        function ambildatadetail() {
            var table = document.getElementById('tablelistdata');
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

        //filter status 

        document.getElementById("jenis").addEventListener("change", function(event) {
            event.preventDefault();
            var jenis = $("#jenis").val();

            if (jenis == 3) {
                $('#detailtable').empty();
                datalist(jenis);
            }
            else if (jenis == 4) 
            {
                $('#detailtable').empty();
                datalist(jenis);
            }
            else if (jenis == 5) 
            {
                $('#detailtable').empty();
                datalist(jenis);
            }
            // console.log(jenis);
                  
        });
        //load data awal
        
        function datalist(jenis) {
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('finance/pencairankartu/datalist'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                //  className: 'select-checkbox',
                data: {
                    kode_cabang: kode_cabang, 
                    jenis : jenis, 
                    kodesubcabang: kodesubcabang, 
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        inserttable(
                            data[i].noreferensi.trim(), 
                            data[i].jenis.trim(),
                            data[i].nomor_kasiraccount.trim(),
                            data[i].nomor.trim(), 
                            data[i].tanggal.trim(), 
                            data[i].nomorpenerimaan.trim(), 
                            formatRupiah(data[i].nilaipiutang.trim(), ""),
                            data[i].nama.trim(), 
                            data[i].kode_cabang.trim(), '',
                        );
                    }
                }
            });
        };

        function inserttable(invoice, jenis, noaccount, nomorpiutang, tanggal, nopenerimaan, nilaipiutang, nama, kode_cabang,find) {
            //var kode_cabang = $('#scabang').val();
            var row = "";
            row =
                '<tr id="' + invoice + '">' +
                '<td>' + invoice + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + noaccount + '</td>' +
                '<td>' + nomorpiutang + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + nopenerimaan + '</td>' +
                '<td>' + nilaipiutang + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kode_cabang + '</td>' +
                '<td>' +
                        '<button data-table="'+ invoice +'" class="hapus btn btn-danger" '+find+'><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detailtable').append(row);
            subtotal();
            HitungTotal();
        }

        $(document).on('click','.hapus',function() {
            var id = $(this).attr("data-table");
            $('#'+id).remove();
            var table = document.getElementById('detailtable');
            subtotal();
            HitungTotal();
        });

        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            var table = document.getElementById('detailtable');
            if (table.rows.length == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Isi dahulu data yang ingin disimpan',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                        }
                    }
                });
                var result = false;
            } else if ($('#noaccount').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Account Pencairan Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                        }
                    }
                });
                $('#noaccount').focus();
                var result = false;
            }else if ($('#tglpelunasan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Tanggal tidak boleh kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                        }
                    }
                });
                $('#tglpelunasan').focus();
                var result = false;
            }else {
                var result = true;
            }
            return result;
        }
        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            location.reload(true);
        });
        // -- END NEW -- 

        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            // console.log(datadetail);
            // die();
            var tglpelunasan = $('#tglpelunasan').val();
            var kodecabang = $('#scabang').val();
            var bankcharge = $('#bankcharge').val();
            var nomorkasiraccount = $('#noaccount').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('finance/pencairankartu/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        tglpelunasan : tglpelunasan,
                        kodecabang : kodecabang,
                        nomorkasiraccount : nomorkasiraccount,
                        kodecabang : kodecabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        bankcharge : bankcharge,
                        datadetail : datadetail
                    },
                    success: function(data) {
                        // if (data.nomor != "" || !empty(data.nomor)) {
                            
                        if (data.error == false) {
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
                            window.open( 
                                "<?php echo base_url('form/form/cetak_pencairan/') ?>"+data.nomor
                            );
                        } else {
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



        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('carinomoraccount').disabled = true;
            document.getElementById('bankcharge').disabled = true;
            document.getElementById('jenis').disabled = true;
        };

        // -- FIND --
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            // console.log(kode_cabang);
            // if (kode_cabang == "HO") {
            //     values = "batal = false"
            // } else {
            //     values = "batal = false and kode_cabang = '" + kode_cabang + "'"
            // }
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // // "scrollX": true,
                // "scrollY": true,
                // // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('finance/pencairankartu/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_pencairanpiutangkartu",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            noreferensi: "noreferensi",
                            kode_cabang: "kode_cabang"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            noreferensi: "noreferensi",
                            kode_cabang: "kode_cabang"
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchok", function() {
            var nomor = $(this).attr("data-id");
            Bersihkanlayarbaru();
            $('#detailtable').empty();
            $.ajax({
                url: "<?php echo base_url('finance/pencairankartu/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#noaccount').val(data[i].nomor_kasiraccountcair.trim());
                        $('#namaaccount').val(data[i].nama.trim());
                        $('#tglpelunasan').val(data[i].tanggal.trim());
                        $('#bankcharge').val(data[i].bankcharge.trim());
                        $('#jenis').val(data[i].jenispenerimaan.trim());
                        finddetail(data[i].nomor.trim());
                        // detaildatafind(data[i].nomorbooking.trim());
                    }
                    FindData();
                }
            }, false);
        });

        function finddetail(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/pencairankartu/finddetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        inserttablefind(
                            data[i].noreferensi.trim(), 
                            data[i].jenis.trim(),
                            data[i].nomor_kasiraccount.trim(),
                            data[i].nomor.trim(), 
                            data[i].tanggal.trim(), 
                            data[i].nomorpenerimaan.trim(), 
                            formatRupiah(data[i].nilaipenerimaan.trim(), ""),
                            data[i].nama.trim(), 
                            data[i].kode_cabang.trim(), '',
                        );
                    }
                }
            });
        };

        function inserttablefind(invoice, jenis, noaccount, nomorpiutang, tanggal, nopenerimaan, nilaipiutang, nama, kode_cabang,find) {
            //var kode_cabang = $('#scabang').val();
            var row = "";
            row =
                '<tr id="' + invoice + '">' +
                '<td>' + invoice + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + noaccount + '</td>' +
                '<td>' + nomorpiutang + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + nopenerimaan + '</td>' +
                '<td>' + nilaipiutang + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kode_cabang + '</td>' +
                '<td>' +
                        //'<button data-table="'+ invoice +'" class="hapus btn btn-danger" '+find+'><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detailtable').append(row);
            subtotal();
            HitungTotal();
        }
        // -- END FIND --

        // -- Cancel --
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var datadetail = ambildatadetail();
           
            if (CekValidasi() == true) {
                $.confirm({
                    onOpen: function() {
                        $('#tanggalbatal').datepicker({
                            format: "dd MM yyyy",
                            autoclose: true,
                            todayHighlight: true,
                            endDate: new Date()
                        });
                    },
                    onClose: function() {
                        $("#tanggalbatal").datepicker("destroy");
                    },
                    title: 'Info..',
                    content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Apakah anda yakin ?</label> <br/>' +
                        '   <label for="nomor">Tanggal Batal</label>' +
                        '      <div class="input-group date" id="tanggalbatal">' +
                        '          <input type="text" id="tglbatal" class="tglbatal form-control" value="<?php echo date("d F Y"); ?>" readonly>' +
                        '          <div class="input-group-prepend">' +
                        '              <div class="input-group-text btn-primary">' +
                        '                  <span class="input-group-addon">' +
                        '                      <i class="fa fa-calendar"></i>' +
                        '                  </span>' +
                        '              </div>' +
                        '          </div>' +
                        '      </div>' +
                        '<input type="text" placeholder="Masukkan Alasan Pembatalan" class="alasan form-control" required />' +
                        '</div>' +
                        '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Ok',
                            btnClass: 'btn-red',
                            action: function() {
                                var alasan = this.$content.find('.alasan').val();
                                var tglbatal = this.$content.find('.tglbatal').val();
                                if (!alasan) {
                                    $.alert('Alasan belum diisi');
                                    return false;
                                }
                                $.ajax({
                                    url: "<?php echo base_url('finance/pencairankartu/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        alasan: alasan,
                                        tglbatal: tglbatal,
                                        datadetail: datadetail

                                    },
                                    success: function(data) {
                                        if (data.error == true) {
                                            $.alert({
                                                title: 'Info..',
                                                content: data.message,
                                                buttons: {
                                                    formSubmit: {
                                                        text: 'OK',
                                                        btnClass: 'btn-red',
                                                        keys: ['enter', 'shift'],
                                                    }
                                                }
                                            });
                                        } else {
                                            $.alert({
                                                title: 'Info..',
                                                content: data.message,
                                                buttons: {
                                                    formSubmit: {
                                                        text: 'OK',
                                                        btnClass: 'btn-red',
                                                        keys: ['enter', 'shift'],
                                                        action: function() {
                                                            location.reload(true);
                                                        }
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
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
        });

        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open( 
            "<?php echo base_url('form/form/cetak_pencairan/') ?>"+nomor
           );
        });

    });
</script>