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
        $nama_menu = 'Penghapusan Piutang';

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

        var gruplogin = "<?php echo $grup ?>";

        if (gruplogin != 'SA' && gruplogin != 'kasir' && gruplogin != 'kapart2') {
            $("#approve").show();
        } else {
            $("#approve").hide();
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
            $('#nomor').val(kode_cabang + "-HP" + yr + mt + "00000");
            $('#tglpenghapusan').val(newDate);
            $('#nomorfaktur').val("");
            $('#namacustomer').val("");
            $('#noaccount').val("");
            $('#namaaccount').val("");
            $('#nilaipiutang').val("0");
            $('#nilaipenghapusan').val("0");
            $('#nilaipenerimaan').val("0");
            $('#keterangan').val("");
            $('#total').val("0");
            $('#jenis').val("0");
            $('#tgltransaksi').val("");
            $('#nomorcustomer').val("");
            // $('#tglpelunasan').prop("disabled", true);

            document.getElementById('save').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('carinomoraccount').disabled = false;
            document.getElementById('carinomorfaktur').disabled = false;
            document.getElementById('jenis').disabled = false;
            document.getElementById('add-row').disabled = false;
            document.getElementById('keterangan').disabled = false;
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
        $('#tablesearchtampil').css('visibility', 'hidden');

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
            if (data.which != 8 && data.which != 0 && (data.which < 44 || data.which > 57)) {
                return false;
            }
        };

        $("#nilaipenghapusan").keypress(function(data) {
            return angka(data);
        });

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
                "order": [0, 1],
                "ajax": {
                    "url": "<?php echo base_url('finance/penghapusanpiutang/caricoa'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_accountlainlain",
                        field: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        value: "aktif = true and  kodecompany = '" + kodecompany + "'"
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
                url: "<?php echo base_url('finance/penghapusanpiutang/namaaccount'); ?>",
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

        document.getElementById("carinomorfaktur").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var jenis = $('#jenis').val();
            $('#tablesearchfaktur').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('finance/penghapusanpiutang/carifaktur'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_penghapusanpiutang",
                        field: {
                            noreferensi: "noreferensi",
                            nama_customer: "nama_customer",
                            nilaipiutang: "nilaipiutang",
                            nilaipenerimaan: "nilaipenerimaan",
                            nilaipenghapusan: "nilaipenghapusan",
                        },
                        sort: "noreferensi",
                        where: {
                            noreferensi: "noreferensi",
                            nama_customer: "nama_customer"
                        },
                        value: "kode_cabang = '" + kodecabang + "' and jenistransaksi = '" + jenis + "' "
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchfaktur", function() {
            var result = $(this).attr("data-id");
            $('#nomorfaktur').val(result.trim());
            loaddatafaktur(result.trim());
        });

        function loaddatafaktur(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/penghapusanpiutang/datafaktur'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorfaktur').val(data[i].noreferensi.trim());
                        $('#namacustomer').val(data[i].nama_customer.trim());
                        $('#nilaipiutang').val(data[i].nilaipiutang.trim());
                        $('#nilaipenerimaan').val(data[i].nilaipenerimaan.trim());
                        $('#nilaipenghapusan').val(data[i].nilaipenghapusan.trim());

                        $('#nomorcustomer').val(data[i].nomor_customer.trim());
                        $('#tgltransaksi').val(formatDate(data[i].tgltransaksi.trim()));
                    }
                }
            });
        }


        //filter status 
        document.getElementById("jenis").addEventListener("change", function(event) {
            event.preventDefault();
            var jenis = $("#jenis").val();

            if (jenis == 0) {
                $('#detailtable').empty();
                $('#nomorfaktur').val("");
                $('#namacustomer').val("");
                $('#nilaipiutang').val("0");
                $('#nilaipenghapusan').val("0");
                $('#nilaipenerimaan').val("0");
                $('#keterangan').val("");
                $('#total').val("0");
                $('#tgltransaksi').val("");
                $('#nomorcustomer').val("");
            } else if (jenis == 51) {
                $('#detailtable').empty();
                $('#nomorfaktur').val("");
                $('#namacustomer').val("");
                $('#nilaipiutang').val("0");
                $('#nilaipenghapusan').val("0");
                $('#nilaipenerimaan').val("0");
                $('#keterangan').val("");
                $('#total').val("0");
                $('#tgltransaksi').val("");
                $('#nomorcustomer').val("");
            } else if (jenis == 52) {
                $('#detailtable').empty();
                $('#nomorfaktur').val("");
                $('#namacustomer').val("");
                $('#nilaipiutang').val("0");
                $('#nilaipenghapusan').val("0");
                $('#nilaipenerimaan').val("0");
                $('#keterangan').val("");
                $('#total').val("0");
                $('#tgltransaksi').val("");
                $('#nomorcustomer').val("");
            }
            // console.log(jenis);

        });
        //load data awal

        function cekdouble(nomorfaktur) {
            var table = document.getElementById('detailtable');
            var result = true;
            for (var r = 0, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.trim() === nomorfaktur.trim()) {
                    result = false;
                }
            }
            return result;
        }

        $("#add-row").click(function() {
            if ($('#jenis').val() == '0') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Piutang Terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenis').focus();
            } else if ($('#noaccount').val() == '' || $('#namaaccount').val() == '') {
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
                $('#noaccount').focus();
            } else if (($('#nomorfaktur').val() == '')) {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Data Faktur Terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomorfaktur').focus();
            } else if (($('#nilaipenghapusan').val() == '0') || ($('#nilaipenghapusan').val() == '')) {
                $.alert({
                    title: 'Info..',
                    content: 'Silahkan isi Nilai Penghapusan',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nilaipenghapusan').focus();
            } else {
                var nomorfaktur = $("#nomorfaktur").val();
                var namacustomer = $("#namacustomer").val();
                var nilaipiutang = $("#nilaipiutang").val();
                var nilaipenghapusan = $("#nilaipenghapusan").val();
                var nomorcustomer = $("#nomorcustomer").val();
                var tgltransaksi = $("#tgltransaksi").val();
                if (cekdouble(nomorfaktur) == true) {
                    inserttablex(nomorfaktur, namacustomer, nilaipiutang, nilaipenghapusan, nomorcustomer, tgltransaksi);
                    $('#nomorfaktur').val("");
                    $('#namacustomer').val("");
                    $('#nilaipiutang').val("0");
                    $('#nilaipenghapusan').val("0");
                    $('#nilaipenerimaan').val("0");
                    $('#tgltransaksi').val("");
                    $('#nomorcustomer').val("");
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
                                    $('#' + nomorfaktur).remove();
                                    inserttablex(nomorfaktur, namacustomer, nilaipiutang, nilaipenghapusan, nomorcustomer, tgltransaksi);
                                    $('#nomorfaktur').val("");
                                    $('#namacustomer').val("");
                                    $('#nilaipiutang').val("0");
                                    $('#nilaipenghapusan').val("0");
                                    $('#nilaipenerimaan').val("0");
                                    $('#tgltransaksi').val("");
                                    $('#nomorcustomer').val("");
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

        function inserttablex(nomorfaktur, namacustomer, nilaipiutang, nilaipenghapusan, nomorcustomer, tgltransaksi) {
            var row = "";
            row =
                '<tr id="' + nomorfaktur + '">' +
                '<td>' + nomorfaktur + '</td>' +
                '<td>' + namacustomer + '</td>' +
                '<td>' + nilaipiutang + '</td>' +
                '<td>' + nilaipenghapusan + '</td>' +
                '<td style="display:none;">' + nomorcustomer + '</td>' +
                '<td style="display:none;">' + tgltransaksi + '</td>' +
                '<td>' +
                '<button data-table="' + nomorfaktur + '" class="hapus btn-danger"><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detailtable').append(row);
            // subtotal();
        }

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detailtable');
            subtotal();
        });


        function subtotal() {
            var table = document.getElementById('tablelistdata');
            var total = 0;
            if (table.rows.length == 1) {
                $("#total").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 3) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", ""))
                        $("#total").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
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
                        string = string + ", " + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML.replace("'", "").replace("'", "") + "'";
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
            } else if ($('#noaccount').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Account Penghapusan Terlebih Dahulu',
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
            } else if ($('#tglpelunasan').val() == '') {
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
            } else if ($('#keterangan').val() == '' || $('#keterangan').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Keterangan Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                        }
                    }
                });
                $('#keterangan').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        }

        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            Bersihkanlayarbaru();
            location.reload(true);
        });

        // -- END NEW -- 

        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var tglpenghapusan = $('#tglpenghapusan').val();
            var noaccount = $('#noaccount').val();
            var keterangan = $('#keterangan').val();
            var jenis = $('#jenis').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('finance/penghapusanpiutang/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        tglpenghapusan: tglpenghapusan,
                        noaccount: noaccount,
                        keterangan: keterangan,
                        jenis: jenis,
                        kodecabang: kodecabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        datadetail: datadetail
                    },
                    success: function(data) {
                        if (data.nomor != "" || !empty(data.nomor)) {
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
                            $.alert({
                                title: 'Info..',
                                content: 'Harap data ini di Approve oleh Kabeng atau Accounting!',
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
                                "<?php echo base_url('form/form/cetak_penghapusanpiutang/') ?>" + data.nomor
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
            document.getElementById('carinomorfaktur').disabled = true;
            document.getElementById('jenis').disabled = true;
            document.getElementById('add-row').disabled = true;
            document.getElementById('keterangan').disabled = true;
        };

        // -- FIND --
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
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
                    "url": "<?php echo base_url('finance/penghapusanpiutang/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_penghapusanpiutang",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            noreferensi: "noreferensi",
                            kode_cabang: "kode_cabang",
                            approve: "approve"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            noreferensi: "noreferensi"
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
                url: "<?php echo base_url('finance/penghapusanpiutang/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#jenis').val(data[i].jenistransaksi.trim());
                        $('#tglpenghapusan').val(formatDate(data[i].tanggal.trim()));
                        $('#noaccount').val(data[i].nomoraccount.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                        if (data[i].approve == "t") {
                            document.getElementById('approve').disabled = true;
                        }else{
                            document.getElementById('approve').disabled = false;
                        }
                        loadnamaaccountkasir(data[i].nomoraccount.trim());
                        finddetail(data[i].nomor.trim());
                    }
                    FindData();
                }
            }, false);
        });

        function finddetail(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/penghapusanpiutang/finddetail'); ?>",
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
                            data[i].nilaipiutang.trim(),
                            data[i].nilaipenerimaan.trim(),
                            data[i].nama.trim(),
                            data[i].tgltransaksi.trim(),
                            data[i].nomor_customer.trim()
                        );
                    }
                }
            });
        };

        function inserttablefind(noreferensi, nilaipiutang, nilaipenerimaan, nama, tgltransaksi, nomor_customer) {
            //var kode_cabang = $('#scabang').val();
            var row = "";
            row =
                '<tr id="' + noreferensi + '">' +
                '<td>' + noreferensi + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + formatRupiah(nilaipiutang, '') + '</td>' +
                '<td>' + formatRupiah(nilaipenerimaan, '') + '</td>' +
                '<td style="display:none;">' + nomor_customer + '</td>' +
                '<td style="display:none;">' + tgltransaksi + '</td>' +
                '<td>' +
                //'<button data-table="'+ invoice +'" class="hapus btn btn-danger" '+find+'><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detailtable').append(row);
            subtotal();
        }
        // -- END FIND --

        // -- Cancel --
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var datadetail = ambildatadetail();

            if (CekValidasi() == true) {
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
                                    url: "<?php echo base_url('finance/penghapusanpiutang/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        alasan: alasan,
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
                "<?php echo base_url('form/form/cetak_penghapusanpiutang/') ?>" + nomor
            );
        });

        // --- Approve -----------------
        document.getElementById("approve").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            if (CekValidasi() == true) {
                $.confirm({
                    title: 'Info..',
                    content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Apakah anda yakin akan approve ?</label>' +
                        '</div>' +
                        '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Ok',
                            btnClass: 'btn-red',
                            action: function() {
                                $.ajax({
                                    url: "<?php echo base_url('finance/penghapusanpiutang/approve'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,

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