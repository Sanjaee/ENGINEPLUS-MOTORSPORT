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
        $nama_menu = 'Pengeluaran Uang';

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
            $('#nomor').val(kode_cabang + "-OX" + yr + mt + "00000");
            $('#tglpembayaran').val(newDate);

            $('#keterangan').val("");
            $('#kodetransaksi').val("");
            $('#nopermohonan').val("");
            $('#keterangan').prop("disabled", true);
            $('#namatransaksi').val("");
            document.getElementById('carinopermohonan').disabled = false;
            document.getElementById('carijenistransaksi').disabled = false;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('tglpembayaran').disabled = false;
             $('#detailtable').empty();
        }

        $('#tanggal').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
        });
        Bersihkanlayarbaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');
        // // CARI Nomor BOOKING
        document.getElementById("carijenistransaksi").addEventListener("click", function(event) {
            var grup = $('#sgroup').val();
            event.preventDefault();
            $('#tablesearchjenistransaksi').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/pengeluarankasir/cariJenisTransaksi'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "stpm_otorisasikasir",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        // sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true and jenis = 1 and grup = '" + grup + "'"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchkodetransaksi", function() {
            var result = $(this).attr("data-id");
            $('#kodetransaksi').val(result.trim());
            loadkodetransaksi(result.trim());
        });

        function loadkodetransaksi(kode) {
            $.ajax({
                url: "<?php echo base_url('finance/pengeluarankasir/jenispermohonanpengeluaran'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#namatransaksi').val(data[i].nama.trim());
                    }
                }
            });
        }

        function loadkodedepartemen(kode) {
            $.ajax({
                url: "<?php echo base_url('finance/pengeluarankasir/departemen'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#namadepartemen').val(data[i].nama.trim());
                    }
                }
            });
        }

        
        document.getElementById("carinopermohonan").addEventListener("click", function(event) {
            event.preventDefault();
                var kode_cabang = $('#scabang').val();
                var kodetransaksi = $('#kodetransaksi').val();
                var kodesubcabang = $('#subcabang').val();
                var kodecompany = $('#kodecompany').val();
                switch (kodetransaksi) {
                case "KUF01":
                    // OPL
                    jenistransaksi = "31";
                    break;
                case "KUF02":
                    // PART
                    jenistransaksi = "32";
                    break;
                case "KUF03":
                    // PART
                    jenistransaksi = "33";
                    break;
                case "KUF04":
                    // MEMO KELEBIHAN UM SERVICE
                    jenistransaksi = "34";
                    break;
                case "KUF05":
                    // MEMO KELEBIHAN UM PART
                    jenistransaksi = "35";
                    break;
                case "KUF99":
                    // Lainlain
                    jenistransaksi = "99";
                    break;
                }
                 //console.log(jenistransaksi);
                // if (kode_cabang == "HO") {
                //     values = "batal = false and pengeluaran = false and jenistransaksi = '" + jenistransaksi + "'"
                // } else {
                //     values = "batal = false and kode_cabang = '" + kode_cabang + "' and pengeluaran = false and jenistransaksi = '" + jenistransaksi + "'"
                // }

                //console.log(kode_cabang);
                if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                    values = "nomor not in (select nomorpermohonan from trnt_pembayaran where batal = false) and batal = false and pengeluaran = false and jenistransaksi = '" + jenistransaksi + "' and kodecompany = '" + kodecompany + "'"
                } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                    values = "nomor not in (select nomorpermohonan from trnt_pembayaran where batal = false) and batal = false and pengeluaran = false and jenistransaksi = '" + jenistransaksi + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                } else {
                    values = "nomor not in (select nomorpermohonan from trnt_pembayaran where batal = false) and batal = false and pengeluaran = false and jenistransaksi = '" + jenistransaksi + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
                }
                $('#tablesearchnopermohonan').DataTable({
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
                        "url": "<?php echo base_url('finance/pengeluarankasir/caridatapermohonan'); ?>",
                        "method": "POST",
                        "data": {
                            nmtb: "trnt_cadanganpembayaran",
                            // field:{kode:"kode",nama:"nama",nama2:"nama2",nama3:"nama3"}
                            field: {
                                nomor: "nomor",
                                tanggal: "tanggal",
                                keterangan: "keterangan",
                                kode_cabang: "kode_cabang",
                                // approve: "approve"
                            },
                            sort: "nomor",
                            where: {
                                nomor: "nomor",
                                keterangan: "keterangan",
                                kode_cabang: "kode_cabang",
                                // approve: "approve",
                            },
                            value: values
                        },
                    }
                });
          

        }, false);

        $(document).on('click', ".searchnopermohonan", function() {
            var result = $(this).attr("data-id");
            $('#nopermohonan').val(result.trim());
            kodetransaksi = $('#kodetransaksi').val();
            detaildatalistpermohonan(result);
            headerpermohonan(result);
            document.getElementById('carinopermohonan').disabled = true;
        });


        function subtotal() {
            var table = document.getElementById('detailtable');
            var total = 0;
            if (table.rows.length == 1) {
                $("#total").val("0");
            }
            for (var r = 0, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 3 || c == 6) {
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


        function inserttable(invoice, kode, nama, nilaipembayaran, account, namaaccount, nilaialokasi, accalokasi, memo) {
            var kode_cabang = $('#scabang').val();
            var row = "";
            row =
                '<tr id="' + invoice + '">' +
                '<td>' + invoice + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + nilaipembayaran + '</td>' +
                '<td>' + account + '</td>' +
                '<td>' + namaaccount + '</td>' +
                '<td>' + nilaialokasi + '</td>' +
                '<td>' + accalokasi + '</td>' +
                '<td>' + memo + '</td>' +
                '<td>' + kode_cabang + '</td>' +
                '</tr>';
            $('#detailtable').append(row);
            subtotal();
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
            } else if ($('#kodetransaksi').val() == '' || $('#namatransaksi').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Jenis Transaksi Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                        }
                    }
                });
                $('#carijenistransaksi').focus();
                var result = false;
            } else if ($('#kodetransaksi').val() == 'KUF99' && ($('#kodedepartemen').val() == '' || $('#namadepartemen').val() == '')) {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Departement Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                        }
                    }
                });
                $('#caridepartemen').focus();
                var result = false;
            } else {
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
            var tglpembayaran = $('#tglpembayaran').val();
            var kodetransaksi = $('#kodetransaksi').val();
            var jenistransaksi = "";
            var kodecabang = $('#scabang').val();
            var keterangan = $('#keterangan').val();
            var kodedepartemen = $('#kodedepartemen').val();
            var nomorkasiraccount = $('#nomorkasiraccount').val();
            var nopermohonan = $('#nopermohonan').val(); 
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            switch (kodetransaksi) {
                case "KUF01":
                    // OPL
                    jenistransaksi = "31";
                    break;
                case "KUF02":
                    // Part
                    jenistransaksi = "32";
                    break;
                case "KUF03":
                    // Part
                    jenistransaksi = "33";
                    break;
                case "KUF04":
                    // UM SErvice
                    jenistransaksi = "34";
                    break;
                case "KUF05":
                    // UM Part counter
                    jenistransaksi = "35";
                    break;
                case "KUF99":
                    // Lainlain
                    jenistransaksi = "99";
                    break;
            }
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('finance/pengeluarankasir/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        tglpembayaran: tglpembayaran,
                        jenistransaksi: jenistransaksi,
                        kodecabang: kodecabang,
                        nomorkasiraccount: nomorkasiraccount,
                        keterangan: keterangan,
                        kodedepartemen: kodedepartemen,
                        nopermohonan: nopermohonan,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        datadetail: datadetail
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



        function FindData() {
            document.getElementById('carijenistransaksi').disabled = true;
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('carinopermohonan').disabled = true;
            document.getElementById('tglpembayaran').disabled = true;
        };

        function detaildatalistpermohonan(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/pengeluarankasir/datadetaillistpermohonan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        inserttable(data[i].noreferensi.trim(), data[i].kodesupplier.trim(),
                            data[i].namasupplier.trim(), formatRupiah(data[i].nilaipermohonan.trim(), ""),
                            data[i].kodeaccount.trim(), data[i].namaaccount.trim(), formatRupiah(data[i].nilaialokasi.trim(), ""),
                            data[i].accountalokasi.trim(), data[i].memo.trim(), data[i].kode_cabang.trim(),
                        );
                    }
                }
            });
        };

        function headerpermohonan(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/pengeluarankasir/headerpermohonan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#kodedepartemen').val(data[i].kode_departemen.trim());
                        loadkodedepartemen(data[i].kode_departemen.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                    }
                }
            });
        }


        function detaildatalist(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/pengeluarankasir/datadetaillist'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        inserttable(data[i].noreferensi.trim(), data[i].kodesupplier.trim(),
                            data[i].namasupplier.trim(), formatRupiah(data[i].nilaipembayaran.trim(), ""),
                            data[i].kodeaccount.trim(), data[i].namaaccount.trim(), formatRupiah(data[i].nilaialokasi.trim(), ""),
                            data[i].accountalokasi.trim(), data[i].memo.trim(), data[i].kode_cabang.trim(),
                        );
                    }
                }
            });
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
            $('#tablesearchfind').DataTable({
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
                    "url": "<?php echo base_url('finance/pengeluarankasir/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "caripembayaran",
                        // field:{kode:"kode",nama:"nama",nama2:"nama2",nama3:"nama3"}
                        field: {
                            nomor: "nomor",
                            nomorpermohonan: "nomorpermohonan",
                            tanggal: "tanggal",
                            total: "total",
                            keterangan: "keterangan",
                            kode_cabang: "kode_cabang"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nomorpermohonan: "nomorpermohonan",
                            keterangan: "keterangan",
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
                url: "<?php echo base_url('finance/pengeluarankasir/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#tglpembayaran').val(formatDate(data[i].tanggal));
                        $('#nopermohonan').val(data[i].nomorpermohonan.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                        switch (data[i].jenistransaksi.trim()) {
                            case "31":
                                // Ongkos shuttle
                                jenistransaksi = "KUF01";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "32":
                                // ongkos pariwisata
                                jenistransaksi = "KUF02";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "33":
                                // ongkos pariwisata
                                jenistransaksi = "KUF03";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "34":
                                // ongkos pariwisata
                                jenistransaksi = "KUF04";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "35":
                                // ongkos pariwisata
                                jenistransaksi = "KUF05";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "99":
                                // Lainlain
                                jenistransaksi = "KUF99";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                        }
                        $('#kodedepartemen').val(data[i].kode_departemen.trim());
                        loadkodedepartemen(data[i].kode_departemen.trim());
                        $('#scabang').val(data[i].kode_cabang.trim());
                        detaildatalist(data[i].nomor.trim());
                        // detaildatafind(data[i].nomorbooking.trim());
                    }
                    FindData();
                }
            }, false);
        });
        // -- END FIND --

        // -- Cancel --
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var datadetail = ambildatadetail();
            var kodetransaksi = $('#kodetransaksi').val();
            var nopermohonan = $('#nopermohonan').val();
            switch (kodetransaksi) {
                case "KUF01":
                    // Ongkos Biaya Perjalanan SHUTTLE
                    jenistransaksi = "31";
                    break;
                case "KUF02":
                    // Ongkos Biaya Perjalanan SHUTTLE
                    jenistransaksi = "32";
                    break;
                case "KUF03":
                    // Ongkos Biaya Perjalanan SHUTTLE
                    jenistransaksi = "33";
                    break;
                case "KUF04":
                    // Ongkos Biaya Perjalanan SHUTTLE
                    jenistransaksi = "34";
                    break;
                case "KUF05":
                    // Ongkos Biaya Perjalanan SHUTTLE
                    jenistransaksi = "35";
                    break;
                case "KUF99":
                    // Lainlain
                    jenistransaksi = "99";
                    break;
            }
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
                                    url: "<?php echo base_url('finance/pengeluarankasir/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        alasan: alasan,
                                        jenistransaksi: jenistransaksi,
                                        nopermohonan: nopermohonan,
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

    });
</script>