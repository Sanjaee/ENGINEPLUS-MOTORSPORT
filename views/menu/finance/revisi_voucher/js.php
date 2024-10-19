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
            $('#tglawalp').val(newDate);
            $('#tglakhirp').val(newDate);
            $('#tgltransaksi').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#novoucher').val("");
            $('#kodetrx').val("");
            $('#namatrx').val("");
            $('#keterangan').val("");
            $('#kodedepartemen').val("");
            $('#namadepartemen').val("");
            $('#noinvoice').val("");
            $('#namainvoice').val("");
            $('#memo').val("");
            $('#subtotal').val("0");
            $('#noinvoice').val("");
            $('#namaaccount').val("");
            $('#noaccount').val("");
            $('#jenisaccount').val("");
            $('#total').val("0");
            $('#jenis').val("-");
            $('#noref').val("");
            $('#nomorcust').val("");
            $('#namacust').val("");
            // $('#tglpelunasan').prop("disabled", true);
            document.getElementById('carinomoraccount').disabled = false;
            document.getElementById('save').disabled = false;
            $('#headerdatavoucher').empty();
            $('#detaildatavoucher').empty();
            $('#departemen').css('visibility', 'hidden');
            $('#carinomoraccount').css('visibility', 'visible');
            $('#carinomoraccountlain').css('visibility', 'hidden');
        }

        function Bersihkanlayar() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            var kode_cabang = $('#scabang').val();
            $('#tglawalp').val(newDate);
            $('#tglakhirp').val(newDate);
            $('#tgltransaksi').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#novoucher').val("");
            $('#kodetrx').val("");
            $('#namatrx').val("");
            $('#keterangan').val("");
            $('#kodedepartemen').val("");
            $('#namadepartemen').val("");
            $('#noinvoice').val("");
            $('#namainvoice').val("");
            $('#memo').val("");
            $('#subtotal').val("0");
            $('#noinvoice').val("");
            $('#namaaccount').val("");
            $('#noaccount').val("");
            $('#jenisaccount').val("");
            $('#total').val("0");
            $('#noref').val("");
            $('#nomorcust').val("");
            $('#namacust').val("");
            // $('#tglpelunasan').prop("disabled", true);
            document.getElementById('carinomoraccount').disabled = false;
            document.getElementById('save').disabled = false;
            $('#headerdatavoucher').empty();
            $('#detaildatavoucher').empty();
            $('#departemen').css('visibility', 'hidden');
            $('#carinomoraccount').css('visibility', 'visible');
            $('#carinomoraccountlain').css('visibility', 'hidden');
        }

        function ClearEdit() {
            $('#noinvoice').val("");
            $('#noref').val("");
            $('#nomorcust').val("");
            $('#namacust').val("");
            $('#noaccount').val("");
            $('#namaaccount').val("");
            $('#noaccount').val("");
            $('#memo').val("");
            $('#subtotal').val("0");
            $('#jenisaccount').val("");
            $('#detaildatavoucher').empty();
        }

        $('#tglawal').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
            // todayHighlight: true,
            // startDate: new Date()
        });
        $('#tglakhir').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
            // todayHighlight: true,
            // startDate: new Date()
        });
        $('#tgltrans').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true,
            endDate: new Date()
            // todayHighlight: true,
            // startDate: new Date()
        });
        Bersihkanlayarbaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

        document.getElementById("jenis").addEventListener("change", function(event) {
            event.preventDefault();
            Bersihkanlayar();
        });

        //filter status 
        document.getElementById("query").addEventListener("click", function(event) {
            event.preventDefault();
            var jenis = $("#jenis").val();
            var tglawal = $("#tglawalp").val();
            var tglakhir = $("#tglakhirp").val();
            $('#headerdatavoucher').empty();
            datalist(jenis, tglawal, tglakhir);
            // console.log(jenis);

        });
        //load data awal

        function datalist(jenis, tglawal, tglakhir) {
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('finance/revisivoucher/datalist'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                //  className: 'select-checkbox',
                data: {
                    kodecompany: kodecompany,
                    jenis: jenis,
                    tglawal: tglawal,
                    tglakhir: tglakhir,
                    kode_cabang :kode_cabang
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        inserttable(
                            data[i].nomor.trim(),
                            formatDate(data[i].tanggal.trim()),
                            data[i].verifikasi.trim(),
                            data[i].jenistransaksi.trim(),
                            data[i].namatransaksi.trim(),
                            data[i].keterangan.trim(),
                            data[i].kode_departemen.trim(),
                            data[i].namadepartemen.trim()
                        );
                    }
                }
            });
        };

        function inserttable(nomor, tanggal, verifikasi, jenistransaksi, namatransaksi, keterangan, kode_departemen, namadepartemen, find) {
            var row = "";
            row =
                '<tr>' +
                '<td>' +
                '<button data-yes="' + nomor + '" class="edit btn btn-danger" ' + find + '><i class="fa fa-pencil-square-o"></i></button>' +
                '</td>' +
                '<td>' + nomor + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + verifikasi + '</td>' +
                '<td style="display:none;">' + jenistransaksi + '</td>' +
                '<td>' + namatransaksi + '</td>' +
                '<td style="display:none;">' + keterangan + '</td>' +
                '<td style="display:none;">' + kode_departemen + '</td>' +
                '<td>' + namadepartemen + '</td>' +

                '</tr>';
            $('#headerdatavoucher').append(row);
        }

        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");            
            var nomor = _row.closest("tr").find("td:eq(1)").text();
            var tanggal = _row.closest("tr").find("td:eq(2)").text();
            var verifikasi = _row.closest("tr").find("td:eq(3)").text();
            var jenistransaksi = _row.closest("tr").find("td:eq(4)").text();
            var namatransaksi = _row.closest("tr").find("td:eq(5)").text();
            var keterangan = _row.closest("tr").find("td:eq(6)").text();
            var kode_departemen = _row.closest("tr").find("td:eq(7)").text();
            var namadepartemen = _row.closest("tr").find("td:eq(8)").text();
            $('#novoucher').val(nomor);
            $('#tgltransaksi').val(tanggal);
            $('#jenis_detail').val(verifikasi);
            $('#kodetrx').val(jenistransaksi);
            $('#namatrx').val(namatransaksi);
            $('#keterangan').val(keterangan);
            $('#kodedepartemen').val(kode_departemen);
            $('#namadepartemen').val(namadepartemen);

            ClearEdit();
            if (jenistransaksi == 'TUF99' || jenistransaksi == 'KUF99') {
                $('#departemen').css('visibility', 'visible');
                $('#carinomoraccountlain').css('visibility', 'visible');
            } else {
                $('#departemen').css('visibility', 'hidden');
                $('#carinomoraccountlain').css('visibility', 'hidden');
            }
            datadetail(nomor)
        });

        function datadetail(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/revisivoucher/datadetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                //  className: 'select-checkbox',
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        inserttabledetail(
                            data[i].noinvoice.trim(),
                            data[i].noreferensi.trim(),
                            data[i].kodecust.trim(),
                            data[i].namacust.trim(),
                            data[i].kodeaccount.trim(),
                            data[i].namaacc.trim(),
                            data[i].memo.trim(),
                            data[i].nilai.trim(),
                            data[i].jenisaccount.trim()
                        );
                    }
                }
            });
        };

        function inserttabledetail(noinvoice, noreferensi, kodecust, namacust, kodeaccount, namaacc, memo, nilai, jenisaccount, find) {
            var row = "";
            row =
                '<tr id="' + noinvoice + noreferensi + '">' +
                '<td>' +
                '<button data-yes="' + noreferensi + '" class="edit2 btn btn-danger" ' + find + '><i class="fa fa-pencil-square-o"></i></button>' +
                '</td>' +
                '<td>' + noinvoice + '</td>' +
                '<td>' + noreferensi + '</td>' +
                '<td style="display:none;">' + kodecust + '</td>' +
                '<td>' + namacust + '</td>' +
                '<td style="display:none;">' + kodeaccount + '</td>' +
                '<td>' + namaacc + '</td>' +
                '<td style="display:none;">' + memo + '</td>' +
                '<td  style="text-align:right" >' + nilai + '</td>' +
                '<td style="display:none;">' + jenisaccount + '</td>' +
                '<td style="display:none;">' + noreferensi + '</td>' +
                '</tr>';
            $('#detaildatavoucher').append(row);
            subtotal();
        }

        function subtotal() {
            var table = document.getElementById('detailvoucher');
            var total = 0;
            if (table.rows.length == 1) {
                $("#total").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 8) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", ""))
                        $("#total").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }

        $(document).on('click', '.edit2', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");            
            var noinvoice = _row.closest("tr").find("td:eq(1)").text();
            var noreferensi = _row.closest("tr").find("td:eq(2)").text();
            var kodecust = _row.closest("tr").find("td:eq(3)").text();
            var namacust = _row.closest("tr").find("td:eq(4)").text();
            var kodeaccount = _row.closest("tr").find("td:eq(5)").text();
            var namaacc = _row.closest("tr").find("td:eq(6)").text();
            var memo = _row.closest("tr").find("td:eq(7)").text();
            var nilai = _row.closest("tr").find("td:eq(8)").text();
            var jenisaccount = _row.closest("tr").find("td:eq(9)").text();
            var norefx = _row.closest("tr").find("td:eq(10)").text();
            $('#noinvoice').val(noinvoice);
            $('#noref').val(noreferensi);
            $('#nomorcust').val(kodecust);
            $('#namacust').val(namacust);
            $('#noaccount').val(kodeaccount);
            $('#namaaccount').val(namaacc);
            $('#memo').val(memo);
            $('#subtotal').val(nilai);
            $('#jenisaccount').val(jenisaccount);
            $('#norefx').val(norefx);

            if (jenisaccount == '3' || jenisaccount == '4' || jenisaccount == '5') {
                $('#carinomoraccount').css('visibility', 'hidden');
            } else {
                $('#carinomoraccount').css('visibility', 'visible');
            }

        });

        document.getElementById("carinomoraccount").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchcoa').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/revisivoucher/caricoa'); ?>",
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
                        value: "aktif = true and jenisaccount in (1,2) and kodecompany = '" + kodecompany + "'"
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
                url: "<?php echo base_url('finance/revisivoucher/namaaccount'); ?>",
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

        document.getElementById("carinomoraccountlain").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchcoalain').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/revisivoucher/caricoalain'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_accountlainlain",
                        field: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        where: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        value: "aktif = true and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchcoalain", function() {
            var result = $(this).attr("data-id");
            $('#nomorcust').val(result.trim());
            loadnamaaccountkasirlain(result.trim());

        });

        function loadnamaaccountkasirlain(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/revisivoucher/namaaccountlain'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#noref').val(data[i].nomor.trim());
                        $('#namacust').val(data[i].nama.trim());
                    }
                }
            });
        }

        document.getElementById("caridepartemen").addEventListener("click", function(event) {
            var grup = "ADMIN";
            event.preventDefault();
            $('#tablesearchdepartemen').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/revisivoucher/caridept'); ?>",
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


        $(document).on('click', ".searchdept", function() {
            var result = $(this).attr("data-id");
            $('#kodedepartemen').val(result.trim());
            loadkodedepartemen(result.trim());
        });

        function loadkodedepartemen(kode) {
            $.ajax({
                url: "<?php echo base_url('finance/revisivoucher/departemen'); ?>",
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

        //-------- add - data-------------------
        $("#add-data").click(function() {
            if ($('#noaccount').val() == '' || $('#namaaccount').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Account Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#noaccount').focus();
            } else if ($('#noref').val() == '' || $('#noinvoice').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'No Voucher dan No Invoice Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#noref').focus();
            } else {
                var noinvoice = $("#noinvoice").val();
                var noreferensi = $("#noref").val();
                var nomorcust = $("#nomorcust").val();
                var namacust = $("#namacust").val();
                var noaccount = $("#noaccount").val();
                var namaaccount = $("#namaaccount").val();
                var memo = $("#memo").val();
                var subtotal = $("#subtotal").val();
                var jenisaccount = $("#jenisaccount").val();
                var norefx = $("#norefx").val();

                if (cekdouble(norefx) == true) {
                    inserttabledetailx(noinvoice, noreferensi, nomorcust, namacust, noaccount, namaaccount, memo, subtotal, jenisaccount, norefx, find)
                    $("#noinvoice").val("");
                    $("#noref").val("");
                    $("#nomorcust").val("");
                    $("#namacust").val("");
                    $("#noaccount").val("");
                    $("#namaaccount").val("");
                    $("#memo").val("");
                    $("#norefx").val("");
                    $("#subtotal").val("0");
                    $('#jenisaccount').val("0");
                } else {
                    $.confirm({
                        title: 'Info !',
                        content: 'Data sudah ada di list, Apakah ingin menggantinya ?',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                action: function(data) {
                                    // console.log(noinvoice);
                                    $('#' + noinvoice + norefx).remove();
                                    inserttabledetailx(noinvoice, noreferensi, nomorcust, namacust, noaccount, namaaccount, memo, subtotal, jenisaccount, norefx, find)
                                    $("#noinvoice").val("");
                                    $("#noref").val("");
                                    $("#nomorcust").val("");
                                    $("#namacust").val("");
                                    $("#noaccount").val("");
                                    $("#namaaccount").val("");
                                    $("#memo").val("");
                                    $("#norefx").val("");
                                    $("#subtotal").val("0");
                                    $('#jenisaccount').val("0");
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

        function cekdouble(norefx) {
            var table = document.getElementById('detailvoucher');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[10].innerHTML.trim() === norefx.trim()) {
                    result = false;
                }
            }
            return result;
        }

        function inserttabledetailx(noinvoice, noreferensi, kodecust, namacust, kodeaccount, namaacc, memo, nilai, jenisaccount, norefx, find) {
            var row = "";
            row =
                '<tr id="' + noinvoice + norefx + '">' +
                '<td>' +
                '<button data-yes="' + noreferensi + '" class="edit2 btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i></button>' +
                '</td>' +
                '<td>' + noinvoice + '</td>' +
                '<td>' + noreferensi + '</td>' +
                '<td style="display:none;">' + kodecust + '</td>' +
                '<td>' + namacust + '</td>' +
                '<td style="display:none;">' + kodeaccount + '</td>' +
                '<td>' + namaacc + '</td>' +
                '<td style="display:none;">' + memo + '</td>' +
                '<td  style="text-align:right" >' + nilai + '</td>' +
                '<td style="display:none;">' + jenisaccount + '</td>' +
                '<td style="display:none;">' + norefx + '</td>' +
                '</tr>';
            $('#detaildatavoucher').append(row);
            subtotal();
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

        function ambildatadetail() {
            var table = document.getElementById('detailvoucher');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 1, m = table.rows[r].cells.length; c < m - 0; c++) {
                    if (c == 1) {
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
            var table = document.getElementById('detailvoucher');
            if (table.rows.length == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Detail Data Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                        }
                    }
                });
                var result = false;
            } else if ($('#jenis').val() == '-' || $('#jenis').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Voucher Terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                        }
                    }
                });
                $('#jenis').focus();
                var result = false;
            } else if ($('#tgltransaksi').val() == '') {
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
                $('#tgltransaksi').focus();
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
            // console.log(datadetail);
            // die();
            var tgltransaksi = $('#tgltransaksi').val();
            var novoucher = $('#novoucher').val();
            var kodetrx = $('#kodetrx').val();
            var namatrx = $('#namatrx').val();
            var keterangan = $('#keterangan').val();
            var kodedepartemen = $('#kodedepartemen').val();
            var namadepartemen = $('#namadepartemen').val();
            var jenis = $('#jenis').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('finance/revisivoucher/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        tgltransaksi: tgltransaksi,
                        novoucher: novoucher,
                        kodetrx: kodetrx,
                        namatrx: namatrx,
                        keterangan: keterangan,
                        kodedepartemen: kodedepartemen,
                        namadepartemen: namadepartemen,
                        jenis: jenis,
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
                            $('#novoucher').val(data.nomor);
                            if (jenis == "1") {
                                window.open(
                                    "<?php echo base_url('form/form/cetak_penerimaan/') ?>" + data.nomor
                                );
                            } else if (jenis == "2") {
                                window.open(
                                    "<?php echo base_url('form/form/cetak_permohonanuang/') ?>" + data.nomor
                                );
                            } else {
                                window.open(
                                    "<?php echo base_url('form/form/cetak_pencairan/') ?>" + data.nomor
                                );
                            }
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

        document.getElementById("cetak").addEventListener("click", function(event) {
            var jenis = $('#jenis').val();
            var nomor = $('#novoucher').val();
            if (jenis == "1") {
                window.open(
                    "<?php echo base_url('form/form/cetak_penerimaan/') ?>" + nomor
                );
            } else if (jenis == "2") {
                window.open(
                    "<?php echo base_url('form/form/cetak_permohonanuang/') ?>" + nomor
                );
            } else {
                window.open(
                    "<?php echo base_url('form/form/cetak_pencairan/') ?>" + nomor
                );
            }
        });

    });
</script>