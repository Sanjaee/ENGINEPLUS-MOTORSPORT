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
        $nama_menu = 'Order Pekerjaan Luar';

        $get["otorisasi"] = $this->db->query("SELECT * FROM stpm_otorisasipembatalan
        WHERE grup = '" . $grup . "' AND nama_menu = '" . $nama_menu . "' AND otoritas_batal = 'YES' ")->result();

        if (!$get["otorisasi"]) {
            $result = 'NO';
        } else {
            $result = 'YES';
        }

        ?>

        var otoritas_batal = "<?php echo $result ?>";

        if (otoritas_batal == 'YES') {
            $("#cancel").show();
        } else {
            $("#cancel").hide();
        }
        // -------------------------------------------


        var grup = "<?php echo $grup ?>";
        if ((grup == 'sa')) {
            $("#Invoice").hide();
        } else {
            $("#Invoice").show();
        }

        // ------------ SET PPN --------------------
        <?php
        $setppn = $this->session->userdata('setppn');
        ?>
        var getppn = "<?php echo $setppn ?>";


        var ppnkonfigurasi = 0;

        function loadppnkonfigurasi() {
            $.ajax({
                url: "<?php echo base_url('masterdata/konfigurasi/konfigurasippn');  ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    tanggal: $('#tanggalinvoice').val()
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        ppnkonfigurasi = data[i].nilaippn.trim();
                    }
                }
            }, false);
            return ppnkonfigurasi;
        }
        //------------------------------------------

        function BersihkanLayar() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            //var kode_cabang = $('#scabang').val();
            $('#nomor').val("GL" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            $('#nomorspk').val("");
            $('#nopolisi').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#nocustomer').val("");
            $('#namacustomer').val("");
            $('#kode_teknisi').val("");
            $('#nama_teknisi').val("");
            $('#kodesupplier').val("");
            $('#namasupplier').val("");
            $('#alamatsupplier').val("");
            $("#hargabelix").val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#grandtotal').val("0");
            $('#noinvoice').val("");
            $('#detaildatafaktur').empty();
            $('#tablesearchtampil').css('visibility', 'hidden');
            var _row = null;

            document.getElementById('save').disabled = false;
            document.getElementById('Invoice').disabled = true;
            document.getElementById('carispk').disabled = false;
            document.getElementById('cariopl').disabled = false;
            document.getElementById('carisupp').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('remove-row').disabled = false;

            $('#tanggalinvoice').val(newDate);
            $('#tanggalinv').datepicker({
                format: "dd MM yyyy",
                autoclose: true
                // todayHighlight: true,
                // startDate: new Date()
            });

            loadppnkonfigurasi();
        };
        BersihkanLayar();
        $("#loading").hide();


        document.getElementById("tanggalinv").onchange = function() {
            var nilaippn = loadppnkonfigurasi();
            PPN(nilaippn);
            Grandtotal();
        };

        function statusselesai(invoice) {
            if (invoice == "t") {
                document.getElementById('Invoice').disabled = true;
                document.getElementById('noinvoice').disabled = true;
                document.getElementById('tanggalinvoice').disabled = true;
                document.getElementById('remove-row').disabled = true;
            } else {
                document.getElementById('Invoice').disabled = false;
                document.getElementById('noinvoice').disabled = false;
                document.getElementById('tanggalinvoice').disabled = false;
                document.getElementById('remove-row').disabled = true;
            }
        }

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            return day + ' ' + month + ' ' + year;
        }
        //----------------VALIDASI-----------------------------

        function CekValidasi() {
            var table = document.getElementById('detaildatafaktur');
            if ($('#nomorspk').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Silakan pilih data',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carispk').focus();
                var result = false;
            } else if (table.rows.length == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Detail tidak boleh kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carispk').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function CekValidasiInvoice() {
            var table = document.getElementById('detaildatafaktur');
            if ($('#nomorspk').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Silakan pilih data',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carispk').focus();
                var result = false;
            } else if (table.rows.length == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Detail tidak boleh kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carispk').focus();
                var result = false;
            } else if ($('#noinvoice').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Silakan Isi Nomor Invoice',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#noinvoice').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        //----------------END HERE------------------------------


        // ---------- FIND ON LOOKUP OPL ----------------------------------
        document.getElementById("cariopl").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchopl').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/order_pekerjaanluar/CariDataOPL'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_jasaopl",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            hargabeli: "hargabeli",
                            hargajual: "hargajual"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchopl", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/order_pekerjaanluar/getdataopl'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodeopl').val(data[i].kode.trim());
                        $('#namaopl').val(data[i].nama.trim());
                        $('#hargabeli').val(formatRupiah(data[i].hargabeli.toString(), ''));
                        $('#hargabelix').val(data[i].hargabeli.trim());
                        $('#hargajual').val(formatRupiah(data[i].hargajual.toString(), ''));
                    }
                }
            }, false);
        });

        // ---------- FIND ON LOOKUP SUPPLIER ----------------------------------
        document.getElementById("carisupp").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchsupplier').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/order_pekerjaanluar/CariDataSupp'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_supplier",
                        field: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        value: "aktif = true"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchsupp", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/order_pekerjaanluar/getdatasupp'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodesupplier').val(data[i].nomor.trim());
                        $('#namasupplier').val(data[i].nama.trim());
                        $('#alamatsupplier').val(data[i].alamat.trim());
                        $('#alamatsupplier').val(data[i].alamat.trim());
                        $('#pkpsupplier').val(data[i].pkp.trim());
                    }
                }
            }, false);
        });

        // ---------- FIND ON LOOKUP SPK ----------------------------------
        document.getElementById("carispk").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = 0 and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = 0 and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and status = 0 and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchspk').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/order_pekerjaanluar/CariDataSPK'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_wo",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_customer: "nomor_customer"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_customer: "nomor_customer"
                        },
                        // value:"kode_cabang = '"+kode_cabang+"'"
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchspk", function() {
            var result = $(this).attr("data-id");
            var nomorspk = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/order_pekerjaanluar/GetDataSPK'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomorspk: nomorspk
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorspk').val(data[i].nomorspk.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].nama_teknisi.trim());
                        $('#namacustomer').val(data[i].nama_customer.trim());
                        $('#nama_tipe').val(data[i].nama_tipe.trim());

                    }
                }
            });
        });


        // ---------- CALCULATE ---------------------------------------------
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };

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



        // ---------- ADD DETAIl ---------------------------------------------
        function inserttable(kode, nama, kategori, harga, hargajual, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td>' + formatRupiah(harga.toString(), '') + '</td>' +
                '<td>' + formatRupiah(hargajual.toString(), '') + '</td>' +
                '<td>' +
                // '<button data-table="'+ kode +'" class="hapus btn btn-danger" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode + '" class="edit btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatafaktur').append(row);
            // subtotal();  
        }

        function cleardetail() {
            $('#detaildatafaktur').empty();
        }

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildatafaktur');
            subtotal();

            PPN(ppnkonfigurasi);
            Grandtotal();
        });

        function subtotal() {
            var table = document.getElementById('detailfaktur');
            var total = 0;
            if (table.rows.length == 1) {
                $("#dpp").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 3) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#dpp").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }


        function PPN(ppnkonfigurasi) {
            var pkpsup = $("#pkpsupplier").val();
            if (getppn == '1') {
                if (pkpsup == 't') {
                    var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");

                    // var hitungppn = (parseFloat(dpp.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * 10) / 100;
                    var hitungppn = (parseFloat(dpp.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(ppnkonfigurasi)) / 100;
                    var roundppn = Math.round(hitungppn);
                    $('#ppn').val(formatRupiah(roundppn.toString(), ''));
                } else {
                    $('#ppn').val(0);
                }
            } else {
                $('#ppn').val(0);
            }
        }

        function Grandtotal() {
            var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ppn = $('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseInt($('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "")) + parseInt($('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#grandtotal').val(formatRupiah(total.toString(), ''));
        }



        function ambildatadetail() {
            var table = document.getElementById('detailfaktur');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";

                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 0) {
                        string = "{" + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }
                string = string + "}";
                // console.log(string);

                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }

        // ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var nomorspk = $('#nomorspk').val();
            var tanggal = $('#tanggal').val();
            var nopolisi = $('#nopolisi').val();
            var nocustomer = $('#nocustomer').val();
            var kodesupplier = $('#kodesupplier').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var total = $('#grandtotal').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            // echo(datadetail);
            //                 die();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/order_pekerjaanluar/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        tanggal: tanggal,
                        nomorspk: nomorspk,
                        nocustomer: nocustomer,
                        nopolisi: nopolisi,
                        kodecabang: kodecabang,
                        kodesupplier: kodesupplier,
                        dpp: dpp,
                        ppn: ppn,
                        total: total,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        detail: datadetail
                    },
                    beforeSend: function(data) {
                        $("#loading").show();
                        $("#save").hide();
                    },
                    complete: function(data) {
                        $("#loading").hide();
                        $("#save").show();
                    },
                    success: function(data) {
                        if (data.nomor != "") {
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
                            TurnDisableSave();
                            $('#nomor').val(data.nomor);
                            window.open(
                                "<?php echo base_url('form/form/cetak_opl/') ?>" + data.nomor
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
                    },
                    error: function() {
                        $.alert({
                            title: 'Info..',
                            content: 'Data gagal disimpan!',
                            buttons: {
                                formSubmit: {
                                    text: 'ok',
                                    btnClass: 'btn-red'
                                }
                            }
                        });
                    }
                }, false);
            }
        });
        // -- END SAVE --

        // ---------- ON BUTTON FIND ---------------------------------------------
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
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
                    "url": "<?php echo base_url('spk/order_pekerjaanluar/FindDataOPL'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "caridataopl",
                        field: {
                            nomor: "nomor",
                            nomor_wo: "nomor_wo",
                            nopolisi: "nopolisi",
                            statusselesai: "statusselesai",
                            kode_pekerjaan: "kode_pekerjaan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nomor_wo: "nomor_wo",
                            nopolisi: "nopolisi",
                            kode_pekerjaan: "kode_pekerjaan"
                        },
                        value: values
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/order_pekerjaanluar/FindOPL'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        supplierdetail(data[i].nomorsupplier.trim());
                        $('#nomor').val(data[i].nomor.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal.trim()));
                        $('#nomorspk').val(data[i].nomor_wo.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].nama_teknisi.trim());
                        $('#nocustomer').val(data[i].nomorcustomer.trim());
                        $('#namacustomer').val(data[i].namacustomer.trim());
                        $('#kodesupplier').val(data[i].nomorsupplier.trim());
                        $('#namasupplier').val(data[i].namasupplier.trim());
                        $('#alamatsupplier').val(data[i].alamatsupplier.trim());
                        $('#dpp').val(formatRupiah(data[i].dppbeli.trim().toString(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppnbeli.trim().toString(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim().toString(), ''));

                        $('#noinvoice').val(data[i].noinvoice.trim());
                        $('#tanggalinvoice').val(formatDate(data[i].tglselesai.trim()));
                        statusselesai(data[i].statusselesai.trim());
                        FindOPLDetail(data[i].nomor.trim());
                    }
                    TurnDisableSave();
                }
            }, false);
        });

        function supplierdetail(nomorsupplier) {
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/getdatasupplier'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomorsupplier: nomorsupplier
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#pkpsupplier").val(data[i].pkp.trim());
                    }
                }
            });
        }

        function FindOPLDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/order_pekerjaanluar/FindOPLDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode = data[i].kode_pekerjaan.trim();
                        var nama = data[i].nama_pekerjaan.trim();
                        var kategori = data[i].kategoridetail.trim();
                        var harga = formatRupiah(data[i].hargabeli.trim().toString(), '');
                        var hargajual = formatRupiah(data[i].hargajual.trim().toString(), '');
                        // console.log(harga);
                        inserttable(kode, nama, kategori, harga, hargajual, "");
                    }
                }
            });
        };

        // ----------------------------------- END FIND ----------------------------------------------

        // ---------- ON BUTTON CANCEL ---------------------------------------------
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var nomorspk = $('#nomorspk').val();
            var kodecabang = $('#scabang').val();
            var datadetail = ambildatadetail();
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
                        action: function() {
                            var alasan = this.$content.find('.alasan').val();
                            if (!alasan) {
                                $.alert('Alasan belum diisi');
                                return false;
                            }
                            $.ajax({
                                url: "<?php echo base_url('spk/order_pekerjaanluar/Cancel'); ?>",
                                method: "POST",
                                dataType: "json",
                                async: true,
                                data: {
                                    nomor: nomor,
                                    nomorspk: nomorspk,
                                    alasan: alasan,
                                    kodecabang: kodecabang,
                                    detail: datadetail
                                },
                                success: function(data) {
                                    if (data.error == true) {
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
        });
        //------------- Turn Disable -------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayar();
            location.reload(true);
        });
        //------------- Turn Disable -------------------
        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            document.getElementById('carispk').disabled = true;
            document.getElementById('carisupp').disabled = true;
            document.getElementById('cariopl').disabled = true;
            document.getElementById('cancel').disabled = false;
        };

        function TurnDisable() {
            document.getElementById('cancel').disabled = false;
        };

        //-----calculate-----//
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };

        $("#qty").keypress(function(data) {
            return angka(data);
        });


        //------edit
        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kodeopl = _row.closest("tr").find("td:eq(0)").text();
            var namaopl = _row.closest("tr").find("td:eq(1)").text();
            var kategori = _row.closest("tr").find("td:eq(2)").text();
            var hargabeli = _row.closest("tr").find("td:eq(3)").text();
            var hargajual = _row.closest("tr").find("td:eq(4)").text();
            $('#kodeopl').val(kodeopl);
            $('#namaopl').val(namaopl);
            $('#kategoridetail').val(kategori);
            $('#hargabeli').val(hargabeli);
            $('#hargajual').val(hargajual);

            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        function validasiadd() {
            var kode = $("#kodeopl").val();
            var table = document.getElementById('detaildatafaktur');
            var total = 0;
            for (var r = 0, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 0) {
                        if (table.rows[r].cells[c].innerHTML == kode) {

                            $('#' + kode).remove();
                            return "sukses";

                        }
                    }
                }
            }
            return "sukses";
        }

        $("#remove-row").click(function() {
            var kodeopl = $('#kodeopl').val();
            if (kodeopl != "") {
                $('#' + kodeopl.replace(" ", "").replace(" ", "")).remove();
            }

            subtotal();
            PPN(ppnkonfigurasi);
            Grandtotal();
        });

        // ---------- ADD DETAIL ---------------------------------------------
        $("#add_detail").click(function() {

            if ($('#kodeopl').val() == '' || $('#namaopl').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Data Supplier Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kodeopl').focus();
                var result = false;
            } else if ($('#kodesupplier').val() == '' || $('#namasupplier').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Data Supplier Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kodesupplier').focus();
                var result = false;
                // } else if ($('#hargabeli').val().replace(",", "") > $('#hargabelix').val().replace(",", "")) {
                //     $.alert({
                //         title: 'Info..',
                //         content: 'Harga Beli tidak boleh lebih besar dari master',
                //         buttons: {
                //             formSubmit: {
                //                 text: 'OK',
                //                 btnClass: 'btn-red'
                //             }
                //         }
                //     });
                //     $('#hargabeli').focus();
                //     var result = false;
            } else if ($('#kategoridetail').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Detail Kategori Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#kategoridetail').focus();
            } else {

                var kodeopl = $("#kodeopl").val();
                var namaopl = $("#namaopl").val();
                var detailkategori = $("#kategoridetail").val();
                var hargabeli = $("#hargabeli").val();
                var hargajual = $("#hargajual").val();

                if (validasiadd() == "sukses") {
                    inserttableqty(kodeopl, namaopl, detailkategori, hargabeli, hargajual, "")
                    $("#kodeopl").val("");
                    $("#namaopl").val("");
                    $("#kategoridetail").val("");
                    $("#hargabeli").val("0");
                    // $("#hargabelix").val("0");
                    $("#hargajual").val("0");
                }
            }
        });

        function inserttableqty(kodeopl, namaopl, detailkategori, hargabeli, hargajual, find) {

            // _row.closest("tr").find("td").remove();

            var row = "";
            row =
                '<tr id="' + kodeopl.replace(" ", "").replace(" ", "") + '">' +
                '<td>' + kodeopl + '</td>' +
                '<td>' + namaopl + '</td>' +
                '<td>' + detailkategori + '</td>' +
                '<td>' + formatRupiah(hargabeli.toString(), '') + '</td>' +
                '<td>' + formatRupiah(hargajual.toString(), '') + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodeopl + '" class="edit btn btn-danger" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatafaktur').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN(ppnkonfigurasi);
            Grandtotal();
        }

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_opl/') ?>" + nomor
            );
        });


        document.getElementById("Invoice").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var tanggalinvoice = $('#tanggalinvoice').val();
            var noinvoice = $('#noinvoice').val();
            var kodesupplier = $('#kodesupplier').val();
            var grandtotal = $('#grandtotal').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var datadetail = ambildatadetail();
            if (CekValidasiInvoice() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/order_pekerjaanluar/invoice'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        tanggalinvoice: tanggalinvoice,
                        noinvoice: noinvoice,
                        kodesupplier: kodesupplier,
                        kodecabang: kodecabang,
                        kodecompany: kodecompany,
                        kodesubcabang: kodesubcabang,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        datadetail: datadetail
                    },
                    success: function(data) {
                        // statusselesai("t");
                        // $.alert({
                        //     title: 'Info..',
                        //     content: data.message,
                        //     buttons: {
                        //         formSubmit: {
                        //             text: 'OK',
                        //             btnClass: 'btn-red'
                        //         }
                        //     }
                        // });

                        if (data.error == false) {
                            statusselesai("t");
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
                });
            }
        });

    });
</script>