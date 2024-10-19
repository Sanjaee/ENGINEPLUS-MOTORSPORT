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
        $nama_menu = 'Penerimaan Uang';

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
            $('#nomor').val(kode_cabang + "-XX" + yr + mt + "00000");
            $('#tglpenerimaan').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#keterangan').val("");
            $('#kodetransaksi').val("");
            $('#namatransaksi').val("");
            $('#noreferensi').val("");
            $("#nomorkasiraccount").val("");
            $("#namakasiraccount").val("");
            $('#namareferensi').val("");
            $('#noinvoice').val("");
            $('#nilaifaktur').val("0");
            $('#nilaisudahterima').val("0");
            $('#nilaisisa').val("0");
            $('#nilaipenerimaan').val("0");
            $('#nilaialokasi').val("0");
            $('#noaccount').val("");
            $('#memo').val("");
            $('#departemen').css('visibility', 'hidden');
            $('#keterangan').prop("disabled", false);
            $('#memo').prop("disabled", false);
            document.getElementById('carinomorkasiraccount').disabled = false;
            document.getElementById('carinomoraccountpenghapusan').disabled = false;
            document.getElementById('carinoinvoice').disabled = false;
            document.getElementById('carijenistransaksi').disabled = false;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('new-row').disabled = false;
            document.getElementById('add-row').disabled = false;
            document.getElementById('remove-row').disabled = false;
            document.getElementById('tglpenerimaan').disabled = false;

            enableadd()
        }

        $('#tanggal').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
            // todayHighlight: true,
            // startDate: new Date()
        });
        Bersihkanlayarbaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');
        // // CARI Nomor BOOKING
        document.getElementById("carijenistransaksi").addEventListener("click", function(event) {
            var grup = $('#sgroup').val();
            //var grup = $this->session->userdata('mygrup');	
            event.preventDefault();
            $('#tablesearchjenistransaksi').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/penerimaankasir/cariJenisTransaksi'); ?>",
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
                        value: "aktif = true and jenis = 0 and grup = '" + grup + "'"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchkodetransaksi", function() {
            var result = $(this).attr("data-id");
            $('#kodetransaksi').val(result.trim());
            if (result == "TUF02" || result == "TUF04" || result == "TUF05") {
                if (result == "TUF99") {
                    $('#departemen').css('visibility', 'visible');
                } else {
                    $('#departemen').css('visibility', 'hidden');
                }
                $('#tampilalokasi').css('visibility', 'visible');
                $('#tampilpemotonganalokasi').css('visibility', 'visible');
                $('#tampillabel').css('visibility', 'visible');
            } else {
                if (result == "TUF99") {
                    $('#departemen').css('visibility', 'visible');
                } else {
                    $('#departemen').css('visibility', 'hidden');
                }
                $('#tampillabel').css('visibility', 'hidden');
                $('#tampilalokasi').css('visibility', 'hidden');
                $('#tampilpemotonganalokasi').css('visibility', 'hidden');
            }
            $('#kodedepartemen').val("");
            $('#namadepartemen').val("");
            loadkodetransaksi(result.trim());
        });

        function loadkodetransaksi(kode) {
            $.ajax({
                url: "<?php echo base_url('finance/penerimaankasir/jenispenerimaan'); ?>",
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

        document.getElementById("caridepartemen").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchdepartemen').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/penerimaankasir/caridepartemen'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_departement",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        // sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchkodedepartemen", function() {
            var result = $(this).attr("data-id");
            $('#kodedepartemen').val(result.trim());
            loadkodedepartemen(result.trim());
        });

        function loadkodedepartemen(kode) {
            $.ajax({
                url: "<?php echo base_url('finance/penerimaankasir/departemen'); ?>",
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

        function validasicariinvoice() {
            if ($('#kodetransaksi').val() == '' || $('#namatransaksi').val() == '') {
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
            } else if ($('#kodetransaksi').val() == 'TUF99' && ($('#kodedepartemen').val() == '' || $('#namadepartemen').val() == '')) {
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
        document.getElementById("carinoinvoice").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecompany2 = $('#kodecompany').val();
            if (validasicariinvoice() == true) {
                if ($('#kodetransaksi').val() == "TUF99") {
                    $('#judulpencarian').empty();
                    row =
                        '<tr>' +
                        '<th width = "5"></th>' +
                        '<th width = "25">Nomor</th>' +
                        '<th width = "70">Nama</th>' +
                        '</tr>';
                    $('#judulpencarian').append(row);

                    $('#tablesearchinvoice').DataTable({
                        "destroy": true,
                        "searching": true,
                        "processing": true,
                        "serverSide": true,
                        "lengthChange": false,
                        "order": [],
                        "ajax": {
                            "url": "<?php echo base_url('finance/penerimaankasir/cariinvoice'); ?>",
                            "method": "POST",
                            "data": {
                                nmtb: "glbm_accountlainlain",
                                field: {
                                    kode: "nomor",
                                    nama: "nama"
                                },
                                // sort: "kode",
                                where: {
                                    kode: "nomor",
                                    nama: "nama"
                                },
                                value: "aktif = true and  kodecompany = '" + kodecompany2 + "'"
                            },
                        }
                    });

                } else {
                    $('#judulpencarian').empty();
                    kode_cabang = $('#scabang').val();
                    // if (kode_cabang == "HO") {
                    //     values = "jenistransaksi = '" + $('#kodetransaksi').val() + "'"
                    // } else {
                    //     values = "kode_cabang = '" + kode_cabang + "' and jenistransaksi = '" + $('#kodetransaksi').val() + "'"
                    // }
                    var kodesubcabang = $('#subcabang').val();
                    var kodecompany = $('#kodecompany').val();
                    //console.log(kode_cabang);
                    if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                        values = "jenistransaksi = '" + $('#kodetransaksi').val() + "' and kodecompany = '" + kodecompany + "'"
                    } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                        values = "jenistransaksi = '" + $('#kodetransaksi').val() + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                    } else {
                        values = "jenistransaksi = '" + $('#kodetransaksi').val() + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
                    }
                    row =
                        '<tr>' +
                        '<th width = "5"></th>' +
                        '<th width = "25">Nomor</th>' +
                        '<th width = "70">Nama Customer</th>' +
                        '<th width = "70">Keterangan</th>' +
                        '<th width = "20">Harga</th>' +
                        '<th width = "20">Penerimaan</th>' +
                        '<th width = "20">Sisa</th>' +
                        '</tr>';
                    $('#judulpencarian').append(row);
                    $('#tablesearchinvoice').DataTable({
                        "destroy": true,
                        "searching": true,
                        "processing": true,
                        "serverSide": true,
                        "lengthChange": false,
                        "order": [],
                        "ajax": {
                            "url": "<?php echo base_url('finance/penerimaankasir/cariinvoice'); ?>",
                            "method": "POST",
                            "data": {
                                nmtb: "caridatapenerimaankasir",
                                field: {
                                    nomor: "nomor",
                                    namacustomer: "namacustomer",
                                    keterangan: "keterangan",
                                    harga: "harga",
                                    nilaipenerimaan: "nilaipenerimaan",
                                    sisa: "sisa"
                                },
                                // sort: "kode",
                                where: {
                                    nomor: "nomor",
                                    namacustomer: "namacustomer",
                                    keterangan: "keterangan"
                                },
                                value: values
                            },
                        }
                    });
                }
            }

        }, false);

        $(document).on('click', ".searchinvoice", function() {
            var result = $(this).attr("data-id");
            $('#noinvoice').val(result.trim());
            kodetransaksi = $('#kodetransaksi').val();
            loaddatainvoice(result.trim(), kodetransaksi);
            document.getElementById('carijenistransaksi').disabled = true;
        });

        function loaddatainvoice(nomor, jenis) {
            if (jenis == "TUF99") {
                $.ajax({
                    url: "<?php echo base_url('finance/penerimaankasir/datacoa'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor
                    },
                    success: function(data) {
                        for (var i = 0; i < data.length; i++) {
                            setvalue();
                            $('#noreferensi').val(data[i].nomor.trim());
                            $('#namareferensi').val(data[i].nama.trim());
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "<?php echo base_url('finance/penerimaankasir/caridatapenerimaan'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor
                    },
                    success: function(data) {
                        for (var i = 0; i < data.length; i++) {
                            setvalue();
                            $('#noreferensi').val(data[i].nomorcustomer.trim());
                            $('#namareferensi').val(data[i].namacustomer.trim());
                            $('#nilaifaktur').val(formatRupiah(data[i].harga, ""));
                            $('#nilaisudahterima').val(formatRupiah(data[i].nilaipenerimaan, ""));
                            $('#nilaisisa').val(formatRupiah(data[i].sisa, ""));
                            $('#nilaipenerimaan').val(formatRupiah(data[i].sisa, ""));
                            $('#scabang').val(data[i].kode_cabang.trim());
                        }
                    }
                });
            }
        }

        document.getElementById("carinomoraccountpenghapusan").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchcoapenghapusan').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/penerimaankasir/caricoapenghapusan'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_accountlainlain",
                        field: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        // sort: "kode",
                        where: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        value: "aktif = true  and  kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchcoapenghapusan", function() {
            var result = $(this).attr("data-id");
            $('#noaccount').val(result.trim());

        });

        document.getElementById("carinomorkasiraccount").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchkasiraccount').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/penerimaankasir/carikasiraccount'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_account",
                        field: {
                            nomor: "nomor",
                            nama: "nama",
                            norekening: "norekening"
                        },
                        // sort: "kode",
                        where: {
                            nomor: "nomor",
                            nama: "nama",
                            norekening: "norekening"
                        },
                        value: "aktif = true and  kodecompany = '" + kodecompany + "' and (kode_cabang  = '" + kodecabang + "' or kode_cabang  = 'ALL')"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchkasiraccount", function() {
            var result = $(this).attr("data-id");
            $('#nomorkasiraccount').val(result.trim());
            loadnamaaccountkasir(result.trim());
        });

        function loadnamaaccountkasir(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/penerimaankasir/accountpenerima'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#namakasiraccount').val(data[i].nama.trim());
                    }
                }
            });
        }

        function setvalue() {
            $('#noreferensi').val("");
            $('#namareferensi').val("");
            $('#nilaifaktur').val(0);
            $('#nilaisudahterima').val(0);
            $('#nilaisisa').val(0);
            $('#nilaipenerimaan').val(0);
            $('#nilaialokasi').val(0);
            $('#noaccount').val("");
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
        $("#nilaialokasi").keypress(function(data) {
            return angka(data);
        });
        $("#nilaipenerimaan").keypress(function(data) {
            return angka(data);
        });

        // var nilaialokasi = document.getElementById('nilaialokasi');
        // nilaialokasi.addEventListener('keyup', function(e) {
        //     nilaialokasi.value = formatRupiah(this.value, '');
        //     // hitungOngkos();
        // });

        var nilaipenerimaan = document.getElementById('nilaipenerimaan');
        var nilaisisa = document.getElementById('nilaisisa');
        var kodetransaksi = document.getElementById('kodetransaksi');
        nilaipenerimaan.addEventListener('keyup', function(e) {
            nilaipenerimaan.value = formatRupiah(this.value, '');
            if (kodetransaksi == 'TUF02' || kodetransaksi == 'TUF04') {
                nilaix = parseInt(nilaisisa.value.replace(",", "").replace(",", "").replace(",", "")) - parseInt(nilaipenerimaan.value.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                $("#nilaialokasi").val((nilaix));
            }
        });


        $("#remove-row").click(function() {
            var nomor = $('#noinvoice').val();
            if (nomor != "") {
                $('#' + nomor).remove();
            }

            var table = document.getElementById('detailtable');
            if (table.rows.length == 0) {
                $('#noinvoice').val("");
                $('#memo').val("");
                setvalue();
                enableadd();
            }
        });

        $("#new-row").click(function() {
            setvalue();
            $('#noinvoice').val("");
            $('#memo').val("");

        });

        // function cekdouble(noinvoice) {
        //     var table = document.getElementById('tablelistdata');
        //     for (var r = 1, n = table.rows.length; r < n; r++) {
        //         var string = "";
        //         for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
        //             if (c == 0) {
        //                 if (table.rows[r].cells[c].innerHTML.trim() == noinvoice) {
        //                     return false;
        //                 } else {
        //                     return true;
        //                 }
        //             }
        //         }
        //     }
        //     return true;
        // }

        function cekdouble(noinvoice) {
            var table = document.getElementById('tablelistdata');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.trim() === noinvoice.trim()) {
                    result = false;
                }
            }
            return result;
        }

        $("#add-row").click(function() {
            if ($('#noinvoice').val() == '' || $('#noreferensi').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Invoice terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carinoinvoice').focus();
            } else if ($('#nomorkasiraccount').val() == '' || $('#namakasiraccount').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih No Account terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carinomorkasiraccount').focus();
            } else if (($('#nilaialokasi').val() != 0) && ($('#noaccount').val() == '')) {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Account Penghapusan Terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#noaccount').focus();
            } else {
                var invoice = $("#noinvoice").val();
                var kode = $("#noreferensi").val();
                var nama = $("#namareferensi").val();
                var penerima = $("#nilaipenerimaan").val();
                var account = $("#nomorkasiraccount").val();
                var namaaccount = $("#namakasiraccount").val();
                var nilaialokasi = $("#nilaialokasi").val();
                var accalokasi = $("#noaccount").val();
                var memo = $("#memo").val();
                var total = 0;
                if (cekdouble(invoice) == true) {
                    inserttable(invoice, kode, nama, penerima, account, namaaccount, nilaialokasi, accalokasi, memo);
                    $("#noinvoice").val("");
                    $("#noreferensi").val("");
                    $("#namareferensi").val("");
                    $("#nilaipenerimaan").val(0);
                    $("#nilaialokasi").val("");
                    $("#noaccount").val("");
                    $("#memo").val("");
                    setvalue();
                    disbaleadd();
                } else {
                    $.confirm({
                        title: 'Info !',
                        content: 'Data sudah ada di list, Apakah ingin menggantinya ?',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                action: function(data) {
                                    // console.log(formSubmit);
                                    $('#' + invoice).remove();
                                    inserttable(invoice, kode, nama, penerima, account, namaaccount, nilaialokasi, accalokasi, memo)
                                    $("#noinvoice").val("");
                                    $("#noreferensi").val("");
                                    $("#namareferensi").val("");
                                    $("#nilaipenerimaan").val(0);
                                    $("#nilaialokasi").val("");
                                    $("#noaccount").val("");
                                    $("#memo").val("");
                                    setvalue();
                                    disbaleadd();
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
                subtotal();
            }
        });

        function inserttable(invoice, kode, nama, penerima, account, namaaccount, nilaialokasi, accalokasi, memo) {
            var kode_cabang = $('#scabang').val();
            var row = "";
            row =
                '<tr id="' + invoice + '">' +
                '<td>' + invoice + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + penerima + '</td>' +
                '<td>' + account + '</td>' +
                '<td>' + namaaccount + '</td>' +
                '<td>' + nilaialokasi + '</td>' +
                '<td>' + accalokasi + '</td>' +
                '<td>' + memo + '</td>' +
                '<td>' + kode_cabang + '</td>' +
                '<td>' +
                '<button data-table="' + invoice + '" class="edit btn-danger"><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detailtable').append(row);
            // subtotal();
        }

        function enableadd() {
            document.getElementById('carijenistransaksi').disabled = false;
            document.getElementById('carinomorkasiraccount').disabled = false;
            $('#nomorkasiraccount').val("");
            $('#namakasiraccount').val("");
        }

        function disbaleadd() {
            document.getElementById('carijenistransaksi').disabled = true;
            document.getElementById('carinomorkasiraccount').disabled = true;
        }

        $(document).on('click', '.edit', function() {

            _row = $(this);
            var noinvoice = _row.closest("tr").find("td:eq(0)").text();
            $('#noinvoice').val(_row.closest("tr").find("td:eq(0)").text());
            $('#noreferensi').val(_row.closest("tr").find("td:eq(1)").text());
            $('#namareferensi').val(_row.closest("tr").find("td:eq(2)").text());
            $('#nilaipenerimaan').val(_row.closest("tr").find("td:eq(3)").text());
            $('#nomorkasiraccount').val(_row.closest("tr").find("td:eq(4)").text());
            $('#namakasiraccount').val(_row.closest("tr").find("td:eq(5)").text());
            $('#nilaialokasi').val(_row.closest("tr").find("td:eq(6)").text());
            $('#noaccount').val(_row.closest("tr").find("td:eq(7)").text());
            $('#memo').val(_row.closest("tr").find("td:eq(8)").text());

            $.ajax({
                url: "<?php echo base_url('finance/penerimaankasir/caridatapenerimaan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: noinvoice
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nilaifaktur').val(formatRupiah(data[i].harga.trim(), ""));
                        $('#nilaisudahterima').val(formatRupiah(data[i].nilaipenerimaan.trim(), ""));
                        $('#nilaisisa').val(formatRupiah(data[i].sisa.trim(), ""));
                    }
                }
            });


        });

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
            var tglpenerimaan = $('#tglpenerimaan').val();
            var kodetransaksi = $('#kodetransaksi').val();
            var jenistransaksi = "";
            var kodecabang = $('#scabang').val();
            var keterangan = $('#keterangan').val();
            var kodedepartemen = $('#kodedepartemen').val();
            var nomorkasiraccount = $('#nomorkasiraccount').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            switch (kodetransaksi) {
                case "TUF01":
                    // uang muka service
                    jenistransaksi = "01";
                    break;
                case "TUF02":
                    // pelunasan service
                    jenistransaksi = "51";
                    break;
                case "TUF03":
                    // uang muka part counter
                    jenistransaksi = "02";
                    break;
                case "TUF04":
                    //Faktur part counter
                    jenistransaksi = "52";
                    break;
                case "TUF05":
                    //Faktur part counter
                    jenistransaksi = "53";
                    break;
                case "TUF06":
                    //Pengembalian Uang Muka Pembelian part
                    jenistransaksi = "54";
                    break;
                case "TUF99":
                    // Lainlain
                    jenistransaksi = "99";
                    break;
            }
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('finance/penerimaankasir/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        tglpenerimaan: tglpenerimaan,
                        jenistransaksi: jenistransaksi,
                        kodecabang: kodecabang,
                        nomorkasiraccount: nomorkasiraccount,
                        keterangan: keterangan,
                        kodedepartemen: kodedepartemen,
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
                            window.open(
                                "<?php echo base_url('form/form/cetak_penerimaan/') ?>" + data.nomor
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



        function FindData() {
            document.getElementById('carijenistransaksi').disabled = true;
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('caridepartemen').disabled = true;
            document.getElementById('carinomorkasiraccount').disabled = true;
            document.getElementById('carinomoraccountpenghapusan').disabled = true;
            document.getElementById('carinoinvoice').disabled = true;
            document.getElementById('new-row').disabled = true;
            document.getElementById('add-row').disabled = true;
            document.getElementById('remove-row').disabled = true;
            document.getElementById('tglpenerimaan').disabled = true;
            $('#keterangan').prop("disabled", true);
            $('#memo').prop("disabled", true);
        };

        // function detaildata(nomor) {
        //     $.ajax({
        //         url: "<?php echo base_url('finance/penerimaankasir/datadetail'); ?>",
        //         method: "POST",
        //         dataType: "json",
        //         async: true,
        //         data: {
        //             nomor: nomor
        //         },
        //         success: function(data) {
        //             for (var i = 0; i < data.length; i++) {
        //                 $('#nobooking').val(data[i].nomor.trim());
        //                 $('#nopolisi').val(data[i].nopolisi.trim());
        //                 $('#norangka').val(data[i].norangka.trim());
        //                 $('#nomorcustomer').val(data[i].nomorcustomer.trim());
        //                 $('#namacustomer').val(data[i].namacustomer.trim());
        //                 $('#kodetujuan').val(data[i].kodetujuan.trim());
        //                 $('#namatujuan').val(data[i].namatujuan.trim());
        //                 $('#tglberangkat').val(formatDate(data[i].tglberangkat.trim()));
        //                 $('#lamaperjalanan').val(data[i].lamaperjalanan.trim());
        //                 $('#harga').val(formatRupiah(data[i].harga.trim(), ""));
        //                 $('#ongkos').val(formatRupiah(data[i].totalongkos.trim(), ""));
        //                 $('#bbm').val(formatRupiah(data[i].bbm.trim(), ""));
        //                 $('#toll').val(formatRupiah(data[i].toll.trim(), ""));
        //                 hitungOngkos();
        //             }
        //         }
        //     });
        // };

        // function detaildatafind(nomor) {
        //     $.ajax({
        //         url: "<?php echo base_url('finance/penerimaankasir/datadetail'); ?>",
        //         method: "POST",
        //         dataType: "json",
        //         async: true,
        //         data: {
        //             nomor: nomor
        //         },
        //         success: function(data) {
        //             for (var i = 0; i < data.length; i++) {
        //                 $('#nobooking').val(data[i].nomor.trim());
        //                 $('#nopolisi').val(data[i].nopolisi.trim());
        //                 $('#norangka').val(data[i].norangka.trim());
        //                 $('#nomorcustomer').val(data[i].nomorcustomer.trim());
        //                 $('#namacustomer').val(data[i].namacustomer.trim());
        //                 $('#kodetujuan').val(data[i].kodetujuan.trim());
        //                 $('#namatujuan').val(data[i].namatujuan.trim());
        //                 $('#tglberangkat').val(formatDate(data[i].tglberangkat.trim()));
        //                 $('#lamaperjalanan').val(data[i].lamaperjalanan.trim());
        //                 $('#harga').val(formatRupiah(data[i].harga.trim(), ""));
        //             }
        //         }
        //     });
        // };

        function detaildatalist(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/penerimaankasir/datadetaillist'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        inserttable(data[i].noreferensi.trim(), data[i].kodecustomer.trim(),
                            data[i].namacustomer.trim(), formatRupiah(data[i].nilaipenerimaan.trim(), ""),
                            data[i].kodeaccount.trim(), data[i].namaaccount.trim(), formatRupiah(data[i].nilaialokasi.trim(), ""),
                            data[i].accountalokasi.trim(), data[i].memo.trim(), data[i].kode_cabang.trim(),
                        );
                    }
                }
            });
            subtotal();
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
                    "url": "<?php echo base_url('finance/penerimaankasir/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_penerimaan",
                        // field:{kode:"kode",nama:"nama",nama2:"nama2",nama3:"nama3"}
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            keterangan: "keterangan",
                            kode_cabang: "kode_cabang"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
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
                url: "<?php echo base_url('finance/penerimaankasir/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#tglpenerimaan').val(formatDate(data[i].tanggal));
                        $('#keterangan').val(data[i].keterangan.trim());
                        switch (data[i].jenistransaksi.trim()) {
                            case "01":
                                // Uang Muka Service
                                jenistransaksi = "TUF01";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "51":
                                // Pelunasan Service
                                jenistransaksi = "TUF02";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "02":
                                // Uang Muka Part
                                jenistransaksi = "TUF03";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "52":
                                // Pelunasan Part
                                jenistransaksi = "TUF04";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "53":
                                // Retur part
                                jenistransaksi = "TUF05";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "54":
                                // Pengembalian uang muka pembelian part
                                jenistransaksi = "TUF06";
                                $('#kodetransaksi').val(jenistransaksi);
                                loadkodetransaksi(jenistransaksi);
                                break;
                            case "99":
                                // Lainlain
                                jenistransaksi = "TUF99";
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
            var jenistransaksi = "";
            var kodetransaksi = $('#kodetransaksi').val();
            switch (kodetransaksi) {
                case "TUF01":
                    // Uang Muka Service
                    jenistransaksi = "01";
                    break;
                case "TUF02":
                    // Pelunasan Service
                    jenistransaksi = "51";
                    break;
                case "TUF03":
                    // Uang Muka Part
                    jenistransaksi = "02";
                    break;
                case "TUF04":
                    // Pelunasan Service
                    jenistransaksi = "52";
                    break;
                case "TUF05":
                    // Retur Part
                    jenistransaksi = "53";
                    break;
                case "TUF06":
                    // Pengembalian uang muka pembelian part
                    jenistransaksi = "54";
                    break;
                case "TUF99":
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
                                    url: "<?php echo base_url('finance/penerimaankasir/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        alasan: alasan,
                                        jenistransaksi: jenistransaksi,
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
                "<?php echo base_url('form/form/cetak_penerimaan/') ?>" + nomor
            );
            window.open(
                "<?php echo base_url('form/form/cetak_kwitansiterima/') ?>" + nomor
            );
        });

    });
</script>