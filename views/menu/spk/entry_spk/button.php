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

        function formatDateEst(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            jam = datePart[3];
            menit = datePart[4];
            return day + ' ' + month + ' ' + year + ' ' + jam + ':' + menit;
        }

        // ------------- Otorisasi Pembatalan -------------
        <?php

        $grup = $this->session->userdata('mygrup');
        $nama_menu = 'Entry Data Kendaraan';

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
                async: true,
                data: {
                    tanggal: $('#tanggal').val()
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        ppnkonfigurasi = data[i].nilaippn.trim();
                    }
                }
            }, false);
        }
        //------------------------------------------

        // ---------- CALCULATE ---------------------------------------------
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

        // $('#qty').on('change', function() {
        //     var harga = $('#harga').val().replace(",","").replace(",","").replace(",","").replace(",","");
        //     var qty = $('#qty').val();

        //     var hitungtotal = parseFloat(harga.replace(",","").replace(",","").replace(",","").replace(",","")) * parseFloat(qty.replace(",","").replace(",","").replace(",","").replace(",",""));
        //     $('#total').val(formatRupiah(hitungtotal.toString(),''));
        // });
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 && data.which != 46 || data.which > 57)) {
                return false;
            }
        };

        $("#qty").keypress(function(data) {
            return angka(data);
        });

        $("#total").keypress(function(data) {
            return angka(data);
        });

        $("#qty").keyup(function() {
            var qty = this.value;
            return HitungTotal();
        });

        $("#total").keyup(function() {
            var total = this.value;
            return HitungTotal2();
        });

        // var total = document.getElementById('total');
        // total.addEventListener('keyup', function(e) {
        //     total.value = formatRupiah(this.value, '');
        //     // hitungOngkos();
        // });

        function HitungTotal() {
            var qty = $('#qty').val();
            var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total').val(formatRupiah(total.toString(), ''));
        }

        function HitungTotal2() {
            var total = $('#total').val();
            var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty = parseFloat(total.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) / parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            var qtys = parseFloat(qty).toFixed(2);
            $('#qty').val(formatRupiah(qtys.toString(), ''));
        }

        function cleardetail() {
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildataopl').empty();
            // $('#detaildataparts').empty();
            // $('#detaildatatask').empty();
            // TotalParts();
            //TotalTask();
            subtotal();
            PPN();
            Grandtotal();
        }

        function BersihkanLayarBaru() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            var kode_cabang = $('#scabang').val();
            $('#tanggalestimasi').val(newDate);
            $('#tanggalest').datetimepicker({
                format: "dd MM yyyy hh:ii",
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            });

            $('#tanggalmasuk').val(newDate);
            $('#tglmasuk').datepicker({
                format: "dd MM yyyy",
                autoclose: true,
                todayHighlight: true
                // startDate: new Date()
            });
            $('#tglkerjakan').val(newDate);
            $('#tanggalkerja').datepicker({
                format: "dd MM yyyy",
                autoclose: true,
                todayHighlight: true
                // startDate: new Date()
            });
            $('#nomor').val("WO-" + kode_cabang + "-" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#nomorsn').val("");
            $('#nomorbooking').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#pic').val("");
            $("#nocustomer").val("");
            $("#namacustomer").val("");
            $('#nohp').val("");
            $('#keluhan').val("");
            $('#jenis').val("-");
            $('#kode_teknisi').val("");
            $('#nama_teknisi').val("");
            $('#jenis_detail').val("-");
            $('#kode_part').val("");
            $('#kode_jasa').val("");
            $('#kode_opl').val("");
            $('#nama_part').val("");
            $('#nama_jasa').val("");
            $('#nama_opl').val("");
            $('#qty_part').val("0");
            $('#qty_jasa').val("0");
            $('#qty_opl').val("0");
            $('#harga_part').val("0");
            $('#harga_opl').val("0");
            $('#harga_jasa').val("0");
            $('#total_part').val("0");
            $('#total_opl').val("0");
            $('#total_jasa').val("0");
            $('#grandtotal').val("0");
            $('#keterangan').val("");
            $('#kode_foreman').val("");
            $('#nama_foreman').val("");
            $("#jenisdetail_part").val("");
            $("#jenisdetail_jasa").val("");
            $("#jenisdetail_opl").val("");
            $("#detailkategori_part").val("");
            $("#detailkategori_jasa").val("");
            $("#detailkategori_opl").val("");
            $("#statuskendaraan").val("-");
            $('#koderegular').val("");
            $('#namaregular').val("");
            $('#total_jasa').val("0");
            $('#total_sparepart').val("0");
            $('#total_opl').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#satuan').val("");
            $('#projectmanager').val("-");
            $('#jenis').val("-");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);
            // $("#caritask").hide();
            // $("#cariparts").hide();
            // $("#cariopl").hide();
            $("#book").hide();
            $('#satuan').hide();
            $("#edit_detail").hide();
            $("#nonbooking").prop("checked", "false");
            $("#nonwarranty").prop("checked", "false");
            $("#nonreturnjob").prop("checked", "false");
            $("#noninventaris").prop("checked", "false");
            $('#nilaiuangmuka').val(0);
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildataopl').empty();
            document.getElementById('cariteknisi').disabled = false;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;

            $('#nomorsn').prop("disabled", false);
            $('#nomorsn').prop("readOnly", false);
            // document.getElementById('nomorsn').disabled = false;
            document.getElementById('namacustomer').readOnly = true;
            document.getElementById('keluhan').readOnly = false;
            document.getElementById('jenis').disabled = false;
            document.getElementById('returnjob').disabled = false;
            document.getElementById('inventaris').disabled = false;
            document.getElementById('noninventaris').disabled = false;
            document.getElementById('nonreturnjob').disabled = false;
            document.getElementById('warranty').disabled = false;
            document.getElementById('nonwarranty').disabled = false;
            document.getElementById('pic').disabled = false;
            document.getElementById('nohp').disabled = false;
            document.getElementById('total_part').disabled = true;
            document.getElementById('total_jasa').disabled = true;
            document.getElementById('total_opl').disabled = true;
            document.getElementById('nama_part').disabled = true;
            document.getElementById('nama_jasa').disabled = true;
            document.getElementById('nama_opl').disabled = true;
            loadppnkonfigurasi();
            // console.log($('#nomorf').val());
        };
        $("#loading").hide();
        BersihkanLayarBaru();
        getdatakendaraan($('#nopolisi').val());
        getDataWO($('#nomorf').val());
        $('#tablesearchtampil').css('visibility', 'hidden');



        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#nomorsn').val() == '') {
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
            } else if ($('#kode_tipe').val() == '') {
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
            } else if ($('#statustunggu').val() == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Silahkan Pilih Status Tunggu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#statustunggu').focus();
                var result = false;
            } else if ($('#jenis').val() == '' || $('#jenis').val() == '-') {
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
            } else if ($('#nocustomer').val() == '' || $('#namacustomer').val() == '' || $('#pic').val() == '' || $('#nohp').val() == '' || $('#nohp').val() == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Customer dan Isi PIC Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caricustomer').focus();
                var result = false;
            } else if ($('#projectmanager').val() == '' || $('#projectmanager').val() == '-' || $('#projectmanager').val() == '0') {
                $.alert({
                    title: 'Info..',
                    content: 'Silakan isi nama project manager terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#projectmanager').focus();
                var result = false;
            } else if ($('#kode_teknisi').val() == '' || $('#nama_teknisi').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Teknisi Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#cariteknisi').focus();
                var result = false;
            } else if ($('#kode_foreman').val() == '' || $('#nama_foreman').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Foreman Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#cariforeman').focus();
                var result = false;
            } else if ($("input[name='booking']:checked").val() == 'true' && $('#nomorbooking').val() == '') {
                // console.log($("input[name='booking']:checked").val())
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Booking Terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caribooking').focus();
                var result = false;
            } else if ($('#statuskendaraan').val() == '-' || $('#statuskendaraan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Posisi Kendaraan Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#statuskendaraan').focus();
                var result = false;
            } else if ($('#stkendaraan').val() == '-' || $('#stkendaraan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Status Kendaraan Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#stkendaraan').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function ValidasiAdd() {
            var kode = $("#kode").val();
            var table = document.getElementById('detailspk');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 1) {
                        if (table.rows[r].cells[c].innerHTML == kode) {
                            alert("data sudah pernah diinput")
                            return "gagal";
                        }
                    }
                }
            }
            return "sukses";
        }

        // get nomor WO
        function getDataWO(nomorwo) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomorwo
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#norangka').val(data[i].norangka.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        if (data[i].returnjob == 't') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }
                        if (data[i].inventaris == 't') {
                            $('input:radio[name="inventaris"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="inventaris"][value="false"]').prop('checked', true);
                        }
                        if (data[i].booking == 't') {
                            $('input:radio[name="booking"][value="true"]').prop('checked', true);
                            $("#book").show();
                        } else {
                            $('input:radio[name="booking"][value="false"]').prop('checked', true);
                            $("#book").hide();
                        }
                        if (data[i].garansi == 't') {
                            $('input:radio[name="warranty"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="warranty"][value="false"]').prop('checked', true);
                        }
                        $('#jenis').val(data[i].jenisservice.trim());
                        $('#nomorbooking').val(data[i].nomorbooking.trim());
                        $('#noestimasi').val(data[i].nomorestimasi.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#pic').val(data[i].pic.trim());
                        $('#nohp').val(data[i].nohppic.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].nama_teknisi.trim());
                        $('#kode_foreman').val(data[i].kode_foreman.trim());
                        $('#nama_foreman').val(data[i].nama_foreman.trim());
                        $('#scabang').val(data[i].kode_cabang.trim());
                        $('#odemeter').val(data[i].odemeter.trim());
                        $('#model').val(data[i].kodekategori.trim());
                        if (data[i].status != '0') { 
                            document.getElementById('save').disabled = true;
                            document.getElementById('update').disabled = true;
                            document.getElementById('cancel').disabled = true;
                        } else {
                            document.getElementById('save').disabled = true;
                            document.getElementById('update').disabled = false;
                            document.getElementById('cancel').disabled = false;
                        }
                        $('#koderegular').val(data[i].kode_regularcheck.trim());
                        $('#namaregular').val(data[i].nama_regularcheck.trim());
                        $('#tanggalest').val(formatDateEst(data[i].tglestimasi.trim()));
                        $('#tanggalmasuk').val(formatDate(data[i].tanggalmasuk.trim()));
                        $('#tanggalkerja').val(formatDate(data[i].tanggalkerja.trim()));
                        $('#statustunggu').val(data[i].statustunggu.trim());
                        $('#statuskendaraan').val(data[i].statuskendaraan.trim());
                        $('#stkendaraan').val(data[i].statuspekerjaanmobil.trim());
                        $('#nilaiuangmuka').val(formatRupiah(data[i].nilaiuangmuka.trim(), ''));
                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());
                        FindDataDetail(data[i].nomor.trim());

                        $('#summarytotal_sparepart').val(formatRupiah(data[i].totalpart.trim(), ''));
                        $('#summarytotal_jasa').val(formatRupiah(data[i].totaljasa.trim(), ''));
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim(), ''));
                        $('#projectmanager').val(data[i].projectmanager.trim());
                    FindDisable();
                    }
                }
            });
        };
        // end get nomor WO


        // ---------- FIND Data ----------------------------------------

        function getdatakendaraan(nopol) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/getdatamobil'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopol: nopol
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#norangka').val(data[i].norangka.trim());
                        $('#kode_tipe').val(data[i].kodetipe.trim());
                        $('#nama_tipe').val(data[i].namatipe.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].nama.trim());
                        $('#pic').val(data[i].namapic.trim());
                        $('#nohp').val(data[i].nohppic.trim());
                        $('#odemeter').val(data[i].odmeterakhir.trim());
                        $('#model').val(data[i].model.trim());
                    FindEnable();
                    }
                }
            });
        };

        function DataCustomer(nocustomer) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataCustomer'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nocustomer: nocustomer
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#namacustomer').val(data[i].nama.trim());
                    }
                }
            });
        };

        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataTipe'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode_tipe: kode_tipe
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_tipe').val(data[i].nama.trim());
                    }
                }
            });
        };


        function DataTeknisi(kode) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataTeknisi'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_teknisi').val(data[i].nama.trim());
                    }
                }
            });
        };

        function DataTeknisi2(kode) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataTeknisi'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_teknisi2').val(data[i].nama.trim());
                    }
                }
            });
        };

        function DataTeknisi3(kode) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataTeknisi'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_teknisi3').val(data[i].nama.trim());
                    }
                }
            });
        };

        function DataTeknisi4(kode) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataTeknisi'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_teknisi4').val(data[i].nama.trim());
                    }
                }
            });
        };

        function DataForeman(kode) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataForeman'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_foreman').val(data[i].nama.trim());
                    }
                }
            });
        };

        function TurnDisable() {
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
            document.getElementById('cancel').disabled = false;
            document.getElementById('namacustomer').readOnly = true;
            document.getElementById('jenis').disabled = true;
            document.getElementById('cariteknisi').disabled = true;
            document.getElementById('returnjob').disabled = true;
            document.getElementById('inventaris').disabled = true;
            document.getElementById('noninventaris').disabled = true;
            document.getElementById('nonreturnjob').disabled = true;
            document.getElementById('pic').disabled = true;
            document.getElementById('nohp').disabled = true;
        };

        function FindDisable() {
            document.getElementById('save').disabled = true;
            // document.getElementById('update').disabled = false;
            // document.getElementById('cancel').disabled = false;
            document.getElementById('namacustomer').readOnly = true;
            // document.getElementById('jenis').disabled = true;
            document.getElementById('cariteknisi').disabled = false;
            document.getElementById('returnjob').disabled = false;
            document.getElementById('inventaris').disabled = false;
            document.getElementById('noninventaris').disabled = false;
            document.getElementById('caribooking').disabled = true;
            document.getElementById('booking').disabled = true;
            document.getElementById('nonbooking').disabled = true;
            document.getElementById('nonreturnjob').disabled = false;
            document.getElementById('pic').disabled = true;
            document.getElementById('nohp').disabled = true;
        };

        
        function FindEnable() {
            document.getElementById('save').disabled = false;
            // document.getElementById('update').disabled = false;
            // document.getElementById('cancel').disabled = false;
            document.getElementById('namacustomer').readOnly = true;
            // document.getElementById('jenis').disabled = false;
            document.getElementById('cariteknisi').disabled = false;
            document.getElementById('returnjob').disabled = false;
            document.getElementById('inventaris').disabled = false;
            document.getElementById('noninventaris').disabled = false;
            document.getElementById('caribooking').disabled = false;
            document.getElementById('booking').disabled = false;
            document.getElementById('nonbooking').disabled = false;
            document.getElementById('nonreturnjob').disabled = false;
            document.getElementById('pic').disabled = true;
            document.getElementById('nohp').disabled = true;
        };

        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/FindDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = data[i].jenis.trim();
                        var kode_referensi = data[i].kodereferensi.trim();
                        var nama_referensi = data[i].namareferensi.trim();
                        var kategori = data[i].kategori.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        var status = data[i].statuspekerjaan.trim();
                        if (jenis == '1') {
                            insertdetailparts(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '2') {
                            if (status == '1' || status == '2') {
                                insertdetailjasa(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, status, "disabled", "");
                            } else {
                                insertdetailjasa(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, status, "", "");
                            }
                        } else if (jenis == '3') {
                            insertdetailopl(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        }
                    }
                }

            });
        };

        function BookDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/BookDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = data[i].jenis.trim();
                        var kode_referensi = data[i].kodereferensi.trim();
                        var nama_referensi = data[i].namareferensi.trim();
                        var kategori = data[i].kategori.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        if (jenis == '1') {
                            insertdetailparts(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '2') {
                            insertdetailjasa(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '3') {
                            insertdetailopl(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        }
                    }
                }
            });
        };

        function EstDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/EstimasiDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = data[i].jenis.trim();
                        var kode_referensi = data[i].kodereferensi.trim();
                        var nama_referensi = data[i].namareferensi.trim();
                        var kategori = data[i].kategori.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        if (jenis == '1') {
                            insertdetailparts(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '2') {
                            insertdetailjasa(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '3') {
                            insertdetailopl(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        }
                    }
                }
            });
        };

        function DetailRegularCheck(kode) {
            var kodemodel = $('#model').val();
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataRegularDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kodemodel: kodemodel
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = data[i].jenis.trim();
                        var kode_referensi = data[i].kode_referensi.trim();
                        var nama_referensi = data[i].namaref.trim();
                        var kategori = '';
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        if (jenis == '1') {
                            insertdetailparts(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '2') {
                            insertdetailjasa(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '3') {
                            insertdetailopl(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        }
                    }
                }
            });
        };
        // ----------END FIND Data ----------------------------------------

        // ---------- ON LOOKUP TEKNISI ------------------------------------
        document.getElementById("cariteknisi").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kode_foreman = $('#kode_foreman').val();
            $('#tablesearchteknisi').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataTeknisi'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_teknisi",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        value: "aktif = true  and kode_foreman = '" + kode_foreman + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchteknisi", function() {
            var result = $(this).attr("data-id");
            $('#kode_teknisi').val(result.trim());
            DataTeknisi(result.trim());
        });

        document.getElementById("cariteknisi2").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kode_foreman = $('#kode_foreman').val();
            $('#tablesearchteknisi2').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataTeknisi2'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_teknisi",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        value: "aktif = true and kode_foreman = '" + kode_foreman + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchteknisi2", function() {
            var result = $(this).attr("data-id");
            $('#kode_teknisi2').val(result.trim());
            DataTeknisi2(result.trim());
        });

        document.getElementById("cariteknisi3").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kode_foreman = $('#kode_foreman').val();
            $('#tablesearchteknisi3').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataTeknisi3'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_teknisi",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        value: "aktif = true and kode_foreman = '" + kode_foreman + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchteknisi3", function() {
            var result = $(this).attr("data-id");
            $('#kode_teknisi3').val(result.trim());
            DataTeknisi3(result.trim());
        });

        document.getElementById("cariteknisi4").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kode_foreman = $('#kode_foreman').val();
            $('#tablesearchteknisi4').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataTeknisi4'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_teknisi",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        value: "aktif = true and kode_foreman = '" + kode_foreman + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchteknisi4", function() {
            var result = $(this).attr("data-id");
            $('#kode_teknisi4').val(result.trim());
            DataTeknisi4(result.trim());
        });

        // ---------- ON LOOKUP FOREMAN ------------------------------------
        document.getElementById("cariforeman").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchforeman').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataForeman'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_foreman",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        value: "aktif = true and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchforeman", function() {
            var result = $(this).attr("data-id");
            $('#kode_foreman').val(result.trim());
            DataForeman(result.trim());
        });


        // ---------- ON LOOKUP PARTS ------------------------------------
        document.getElementById("cariparts").addEventListener("click", function(event) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            event.preventDefault();
            $('#tablesearchparts').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataParts'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            hargajual: "hargajual",
                            qtyakhir: "qtyakhir",
                            lokasi: "lokasi",
                            keterangan: "keterangan"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true and kodecabang = '" + kode_cabang + "' and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchparts", function() {
            var result = $(this).attr("data-id");
            $('#kode_part').val(result.trim());
            DataParts(result.trim());
            // DataDetail(result.trim());            
            // document.getElementById('total').disabled = true;
        });

        function DataParts(kode) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataParts'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kode_cabang: kode_cabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_part').val(data[i].nama.trim());
                        $('#jenisdetail_part').val(data[i].kategoripart.trim());
                        $('#satuan_part').val(data[i].satuan.trim());
                        // $('#jenis_detail').val(1);
                        $('#harga_part').val(formatRupiah(data[i].hargajual.trim(), ''));
                        $('#total_part').val(formatRupiah(data[i].hargajual.trim(), ''));
                    }
                }
            });
        };

        function DataDetail(kodepart) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $("#harga").val("0");
            $.ajax({
                url: "<?php echo base_url('masterdata/parts/GetDataPart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kodepart: kodepart,
                    kode_cabang: kode_cabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#total_part').val(formatRupiah(data[i].hargajual.trim(), ''));
                    }
                }
            });
        };

        $("#qty_part").keypress(function(data) {
            return angka(data);
        });

        $("#qty_part").keyup(function() {
            var qty = this.value;
            return HitungTotalPart();
        });

        function HitungTotalPart() {
            var qty_part = $('#qty_part').val();
            var harga_part = $('#harga_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total_part = parseFloat(harga_part.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty_part.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total_part').val(formatRupiah(total_part.toString(), ''));
        }

        function ValidasiAddParts() {
            var kode = $("#kode_part").val();
            var table = document.getElementById('detailsparepart');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 1) {
                        if (table.rows[r].cells[c].innerHTML == kode) {
                            alert("data sudah pernah diinput")
                            return "gagal";
                        }
                    }
                }
            }
            return "sukses";
        }

        // ---------- ADD DETAIL TABLE SPAREPART ----------------------------------
        $("#add_detailpart").click(function() {
            if ($('#kode_part').val() == '' || $('#nama_part').val() == '') {
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
            } else if ($('#qty_part').val() == 0 || $('#qty_part').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Qty Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#qty_part').focus();
            } else if ($('#total_part').val() == 0 || $('#total_part').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Total Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#total_part').focus();
            } else if ($('#detailkategori_part').val() == '' || $('#jenisdetail_part').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kategori dan Detail Kategori Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#detailkategori_part').focus();
            } else {
                // var jenisdetail_part = $("#jenisdetail_part").val();
                var jenisdetail_part = 1;
                var kode_part = $("#kode_part").val();
                var nama_part = $("#nama_part").val();
                var harga_part = $("#harga_part").val();
                var kategori_part = $("#detailkategori_part").val();
                var qty_part = $("#qty_part").val();
                var total_part = $("#total_part").val();

                if (ValidasiAddParts() == "sukses") {
                    insertdetailparts(kode_part, nama_part, kategori_part, jenisdetail_part, qty_part, harga_part, total_part, "")
                    $("#kode_part").val("");
                    $("#nama_part").val("");
                    $("#harga_part").val("0");
                    $("#qty_part").val("0");
                    $("#detailkategori_part").val("");
                    $("#jenisdetail_part").val("");
                    $('#jenis_detailpart').val(0);
                    $("#total_part").val("0");
                    // $("#cariparts").hide();
                    // $('#satuan_part').hide();
                    document.getElementById('total_part').disabled = true
                }
            }
        });


        function insertdetailparts(kode, nama, kategori, jenis, qty, harga, total, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td style="display:none;"></td>' +
                '<td style="text-align:left;">' + kode + '</td>' +
                '<td style="text-align:left;">' + nama + '</td>' +
                '<td style="text-align:left;">' + kategori + '</td>' +
                '<td style="text-align:center;">' + jenis + '</td>' +
                '<td style="text-align:center;">' + qty + '</td>' +
                '<td style="text-align:right;">' + harga + '</td>' +
                '<td style="text-align:right;">' + total + '</td>' +
                '<td>' +
                '<button data-table="' + kode + '" class="hapus_part btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit_part btn btn-new"><i class="fa fa-pencil-square-o"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#detaildataparts').append(row);
            subtotal();
            PPN();
            Grandtotal();
            HitungTotalParts();
        }

        $(document).on('click', '.hapus_part', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            // var table_part = document.getElementById('detailsparepart');
            HitungTotalPart();
            HitungTotalParts();
            subtotal();
            PPN();
            Grandtotal();
        });

        $(document).on('click', '.edit_part', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode = _row.closest("tr").find("td:eq(1)").text();
            var nama = _row.closest("tr").find("td:eq(2)").text();
            var kategori = _row.closest("tr").find("td:eq(3)").text();
            var jenis = _row.closest("tr").find("td:eq(4)").text();
            var qty = _row.closest("tr").find("td:eq(5)").text();
            var harga = _row.closest("tr").find("td:eq(6)").text();
            var subtotal = _row.closest("tr").find("td:eq(7)").text();
            $('#kode_part').val(kode);
            $('#nama_part').val(nama);
            $('#jenisdetail_part').val(jenis);
            $('#detailkategori_part').val(kategori);
            $('#qty_part').val(qty);
            $('#harga_part').val(harga);
            $('#total_part').val(subtotal);

            document.getElementById('jenis_detail').disabled = true;
            document.getElementById('add_detail').disabled = true;
            document.getElementById('edit_detail').disabled = false;
            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });


        function HitungTotalParts() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#total_sparepart").val("0");
                $("#summarytotal_sparepart").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[7].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                }

                $("#total_sparepart").val(formatRupiah(total.toString(), ''));
                $("#summarytotal_sparepart").val(formatRupiah(total.toString(), ''));
            }
        }

        // -------------------------------------- END SPAREPART --------------------------------------


        // --------------------------------------- JASA ---------------------------------------

        // ---------- ON LOOKUP TASK ------------------------------------
        document.getElementById("caritask").addEventListener("click", function(event) {
            var model = $('#model').val();
            event.preventDefault();
            $('#tablesearchtask').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // // "scrollX": true,
                // "scrollY": true,
                "ordering": true,
                // "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('spk/entry_spk/CariDataTask'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_jasa",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true and kodeproduct = '" + model + "' "
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchtask", function() {
            var result = $(this).attr("data-id");
            $('#kode_jasa').val(result.trim());
            DataTask(result.trim());
            document.getElementById('total_jasa').disabled = false;
        });

        function DataTask(kode) {
            var model = $('#model').val();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataTask'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    model: model
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].nama.trim() == '') {
                            document.getElementById('nama_jasa').disabled = false
                            document.getElementById('total_jasa').disabled = false
                        } else {
                            $('#nama_jasa').val(data[i].nama.trim());
                            document.getElementById('nama_jasa').disabled = true
                            document.getElementById('total_jasa').disabled = false
                        }
                        $('#harga_jasa').val(formatRupiah(data[i].frt.trim(), ''));
                        $('#total_jasa').val(formatRupiah(data[i].harga.trim(), ''));
                        $('#jenisdetail_jasa').val(data[i].kategori.trim());
                        $('#qty_jasa').val(data[i].jam.trim());
                        $('#kodestatus').val(0);
                        // $('#jenis_detail').val(2);
                    }
                }
            });
        };


        $("#qty_jasa").keypress(function(data) {
            return angka(data);
        });

        $("#qty_jasa").keyup(function() {
            var qty = this.value;
            return HitungTotaljasa();
        });

        $("#total_jasa").keypress(function(data) {
            return angka(data);
        });

        $("#total_jasa").keyup(function() {
            var qty = this.value;
            return HitungTotalQty();
        });

        function HitungTotaljasa() {
            var qty_jasa = $('#qty_jasa').val();
            var harga_jasa = $('#harga_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total_jasa = parseFloat(harga_jasa.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty_jasa.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total_jasa').val(formatRupiah(total_jasa.toString(), ''));
        }

        function HitungTotalQty() {
            // var total = $('#qty_jasa').val();
            var total_jasa = $('#total_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var harga_jasa = $('#harga_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total_qty = parseFloat(total_jasa.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) / parseFloat(harga_jasa.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            var roundedString = total_qty.toFixed(2);
            $('#qty_jasa').val(roundedString.toString(), '');
        }

        function ValidasiAddJasa() {
            var kode = $("#kode_jasa").val();
            var table = document.getElementById('detailjasa');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 1) {
                        if (table.rows[r].cells[c].innerHTML == kode) {
                            alert("data sudah pernah diinput")
                            return "gagal";
                        }
                    }
                }
            }
            return "sukses";
        }

        // ---------- ADD DETAIL TABLE JASA ----------------------------------
        $("#add_detailjasa").click(function() {
            if ($('#kode_jasa').val() == '' || $('#nama_jasa').val() == '') {
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
                // } else if ($('#qty_jasa').val() == 0 || $('#qty_jasa').val() == '') {
                //     $.alert({
                //         title: 'Info..',
                //         content: 'Isi Qty Terlebih Dahulu',
                //         buttons: {
                //             formSubmit: {
                //                 text: 'OK',
                //                 btnClass: 'btn-red'
                //             }
                //         }
                //     });
                //     // alert('Pilih personil terlebih dahulu');
                //     $('#qty_jasa').focus();
                // } else if ($('#total_jasa').val() == 0 || $('#total_jasa').val() == '') {
                //     $.alert({
                //         title: 'Info..',
                //         content: 'Total Tidak Boleh Kosong',
                //         buttons: {
                //             formSubmit: {
                //                 text: 'OK',
                //                 btnClass: 'btn-red'
                //             }
                //         }
                //     });
                //     // alert('Pilih personil terlebih dahulu');
                //     $('#total_jasa').focus();
            } else if ($('#detailkategori_jasa').val() == '' || $('#jenisdetail_jasa').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kategori dan Detail Kategori Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#detailkategori_jasa').focus();
            } else {
                // var jenisdetail_jasa = $("#jenisdetail_jasa").val();
                var jenisdetail_jasa = 2;
                var kode_jasa = $("#kode_jasa").val();
                var nama_jasa = $("#nama_jasa").val();
                var harga_jasa = $("#harga_jasa").val();
                var kategori_jasa = $("#detailkategori_jasa").val();
                var qty_jasa = $("#qty_jasa").val();
                var total_jasa = $("#total_jasa").val();
                var kodestatus = $("#kodestatus").val();

                if (cekdouble(kode_jasa) == true) {
                    if (kodestatus == '1' || kodestatus == '2') {
                        insertdetailjasa(kode_jasa, nama_jasa, kategori_jasa, jenisdetail_jasa, qty_jasa, harga_jasa, total_jasa, kodestatus, "disabled", "")
                    } else {
                        insertdetailjasa(kode_jasa, nama_jasa, kategori_jasa, jenisdetail_jasa, qty_jasa, harga_jasa, total_jasa, kodestatus, "", "")
                    }
                    $("#kode_jasa").val("");
                    $("#nama_jasa").val("");
                    $("#harga_jasa").val("0");
                    $("#qty_jasa").val("0");
                    $("#detailkategori_jasa").val("");
                    $("#jenisdetail_jasa").val("");
                    $('#jenis_detailjasa').val(0);
                    $("#total_jasa").val("0");
                    $("#kodestatus").val("0");
                    // $("#caritask").hide();
                    // $('#satuan_jasa').hide();
                    document.getElementById('total_jasa').disabled = true
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
                                    $('#' + kode_jasa).remove();
                                    if (kodestatus == '1' || kodestatus == '2') {
                                        insertdetailjasa(kode_jasa, nama_jasa, kategori_jasa, jenisdetail_jasa, qty_jasa, harga_jasa, total_jasa, kodestatus, "disabled", "")
                                    } else {
                                        insertdetailjasa(kode_jasa, nama_jasa, kategori_jasa, jenisdetail_jasa, qty_jasa, harga_jasa, total_jasa, kodestatus, "", "")
                                    }
                                    $("#kode_jasa").val("");
                                    $("#nama_jasa").val("");
                                    $("#harga_jasa").val("0");
                                    $("#qty_jasa").val("0");
                                    $("#detailkategori_jasa").val("");
                                    $("#jenisdetail_jasa").val("");
                                    $('#jenis_detailjasa').val(0);
                                    $("#total_jasa").val("0");
                                    $("#kodestatus").val("0");
                                    // $("#caritask").hide();
                                    // $('#satuan_jasa').hide();
                                    document.getElementById('total_jasa').disabled = true
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

        function cekdouble(kode_jasa) {
            var table = document.getElementById('detaildatajasa');
            var result = true;
            for (var r = 0, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[1].innerHTML.trim() === kode_jasa.trim()) {
                    result = false;
                }
            }
            return result;
        }

        function insertdetailjasa(kode, nama, kategori, jenis, qty, harga, total, status, find, edit) {
            var button = "";
            if (status == '0') {
                button = '<span class="btn btn-danger">Waiting</span>';
            } else if (status == '1') {
                button = '<span class="btn btn-warning">Progress</span>';
            } else if (status == '2') {
                button = '<span class="btn btn-done">Done</span>';
            } else if (status == '3') {
                button = '<span class="btn btn-light">Batal</span>';
            }

            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td style="display:none;"></td>' +
                '<td style="text-align:left;">' + kode + '</td>' +
                '<td style="text-align:left;">' + nama + '</td>' +
                '<td style="text-align:left;">' + kategori + '</td>' +
                '<td style="text-align:center;">' + jenis + '</td>' +
                '<td style="text-align:center;">' + qty + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(harga) + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(total) + '</td>' +
                '<td hidden style="text-align:center;">' + status + '</td>' +
                '<td style="text-align:center;">' + button + '</td>' +
                '<td>' +
                // '<button data-table="' + kode + '" class="hapus_jasa btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode + '" class="edit  btn btn-success" ' + edit + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                '<button data-table="' + kode + '" class="hapus_jasa btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="' + kode + '" class="edit  btn btn-success" ' + edit + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatajasa').append(row);

            // $('#detaildataparts').append(row);
            subtotal();
            PPN();
            Grandtotal();
            HitungTotalJasa();
            HitungSummaryJasa();
        }

        $(document).on('click', '.hapus_jasa', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            HitungTotalJasa();
            subtotal();
            PPN();
            Grandtotal();
            HitungSummaryJasa();
        });

        $(document).on('click', '.edit', function() {
            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode = _row.closest("tr").find("td:eq(1)").text();
            var nama = _row.closest("tr").find("td:eq(2)").text();
            var kategori = _row.closest("tr").find("td:eq(3)").text();
            var jenis = _row.closest("tr").find("td:eq(4)").text();
            var qty = _row.closest("tr").find("td:eq(5)").text();
            var harga = _row.closest("tr").find("td:eq(6)").text();
            var subtotal = _row.closest("tr").find("td:eq(7)").text();
            var kodestatus = _row.closest("tr").find("td:eq(8)").text();
            $('#kode_jasa').val(kode);
            $('#nama_jasa').val(nama);
            $('#detailkategori_jasa').val(kategori);
            $('#jenisdetail_jasa').val(jenis);
            $('#qty_jasa').val(qty);
            $('#harga_jasa').val(harga);
            $('#total_jasa').val(subtotal);
            $('#kodestatus').val(kodestatus);
            //Saat edit Hapus dulu yang lama pas add masukan yg baru
            
            document.getElementById('total_jasa').disabled = false;

        });

        function HitungTotalJasa() {
            var table = document.getElementById('detailjasa');
            var total = 0;
            var total_opl = $('#totall_opl').val();
            if (table.rows.length == 1) {
                $("#total_jasaa").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[7].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                }

                $("#total_jasaa").val(formatRupiah(total.toString(), ''));
            }
        }

        // --------------------------------------- END JASA ---------------------------------------

        // --------------------------------------- OPL ---------------------------------------
        document.getElementById("cariopl").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchopl').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataOPL'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_jasaopl",
                        field: {
                            kode: "kode",
                            nama: "nama"
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
            $('#kode_opl').val(result.trim());
            DataOPL(result.trim());
            document.getElementById('total_opl').disabled = true;
        });



        function DataOPL(kode) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataOPL'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_opl').val(data[i].nama.trim());
                        $('#qty_opl').val(1);
                        $('#harga_opl').val(formatRupiah(data[i].hargajual.trim(), ''));
                        $('#total_opl').val(formatRupiah(data[i].hargajual.trim(), ''));
                        // $('#jenis_detail').val(3);
                    }
                    $('#qty_opl').prop('disabled', true);
                }
            });
        };


        function ValidasiAddOPL() {
            var kode = $("#kode_opl").val();
            var table = document.getElementById('detailopl');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 1) {
                        if (table.rows[r].cells[c].innerHTML == kode) {
                            alert("data sudah pernah diinput")
                            return "gagal";
                        }
                    }
                }
            }
            return "sukses";
        }

        // ---------- ADD DETAIL TABLE JASA ----------------------------------
        $("#add_detailopl").click(function() {
            if ($('#kode_opl').val() == '' || $('#nama_opl').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih opl terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#caritask').focus();
            } else if ($('#qty_opl').val() == 0 || $('#qty_opl').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Qty Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#qty_opl').focus();
            } else if ($('#total_opl').val() == 0 || $('#total_opl').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Total Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#total_opl').focus();
            } else if ($('#detailkategori_opl').val() == '') {
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
                $('#detailkategori_opl').focus();
            } else {
                // var jenisdetail_opl = $("#jenisdetail_opl").val();
                var jenisdetail_opl = 3;
                var kode_opl = $("#kode_opl").val();
                var nama_opl = $("#nama_opl").val();
                var harga_opl = $("#harga_opl").val();
                var kategori_opl = $("#detailkategori_opl").val();
                var qty_opl = $("#qty_opl").val();
                var total_opl = $("#total_opl").val();

                if (ValidasiAddOPL() == "sukses") {
                    insertdetailopl(kode_opl, nama_opl, kategori_opl, jenisdetail_opl, qty_opl, harga_opl, total_opl, "")
                    $("#kode_opl").val("");
                    $("#nama_opl").val("");
                    $("#harga_opl").val("0");
                    $("#qty_opl").val("0");
                    $("#detailkategori_opl").val("");
                    $("#jenisdetail_opl").val("");
                    $('#jenis_detailopl').val(0);
                    $("#total_opl").val("0");
                    // $("#caritask").hide();
                    // $('#satuan_opl').hide();
                    document.getElementById('total_opl').disabled = true
                }
            }
        });


        function insertdetailopl(kode, nama, kategori, jenis, qty, harga, total, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td style="display:none;"></td>' +
                '<td style="text-align:left;">' + kode + '</td>' +
                '<td style="text-align:left;">' + nama + '</td>' +
                '<td style="text-align:left;">' + kategori + '</td>' +
                '<td style="text-align:center;">' + jenis + '</td>' +
                '<td style="text-align:center;">' + qty + '</td>' +
                '<td style="text-align:right;">' + harga + '</td>' +
                '<td style="text-align:right;">' + total + '</td>' +
                '<td>' +
                '<button data-table="' + kode + '" class="hapus_opl btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildataopl').append(row);
            // $('#detaildataparts').append(row);
            HitungTotalOPL();
            subtotal();
            PPN();
            Grandtotal();
            HitungSummaryJasa();
        }

        $(document).on('click', '.hapus_opl', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            // var table_part = document.getElementById('detailsparepart');
            HitungTotalOPL();
            subtotal();
            PPN();
            Grandtotal();
            HitungSummaryJasa();
        });

        // $(document).on('click', '.edit', function() {

        //     _row = $(this);
        //     //var id = $(this).attr("data-yes");
        //     var kode = _row.closest("tr").find("td:eq(2)").text();
        //     var nama = _row.closest("tr").find("td:eq(3)").text();
        //     var jenis = _row.closest("tr").find("td:eq(4)").text();
        //     var qty = _row.closest("tr").find("td:eq(5)").text();
        //     var harga = _row.closest("tr").find("td:eq(6)").text();
        //     var subtotal = _row.closest("tr").find("td:eq(7)").text();
        //     $('#kode').val(kode);
        //     $('#nama').val(nama);
        //     $('#jenis_detail').val(jenis);
        //     $('#qty').val(qty);
        //     $('#harga').val(harga);
        //     $('#total').val(subtotal);

        //     document.getElementById('jenis_detail').disabled = true;
        //     document.getElementById('add_detail').disabled = true;
        //     document.getElementById('edit_detail').disabled = false;
        //     //Saat edit Hapus dulu yang lama pas add masukan yg baru

        // });


        function HitungTotalOPL() {
            var table = document.getElementById('detailopl');
            var total = 0;
            var total_jasaa = $('#total_jasaa').val();
            if (table.rows.length == 1) {
                $("#totall_opl").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[7].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                }

                $("#totall_opl").val(formatRupiah(total.toString(), ''));
            }
        }


        // --------------------------------------- END OPL ---------------------------------------


        function HitungSummaryJasa() {
            var tablejasa = document.getElementById('detailjasa');
            var tableopl = document.getElementById('detailopl');
            var totalsummary_jasa = 0;
            var totalsummary_opl = 0;

            if (tablejasa.rows.length == 1 && tableopl.rows.length == 1) {
                $("#summarytotal_jasa").val(0);
            }

            for (var r = 1, n = tablejasa.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tablejasa.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        totalsummary_jasa = totalsummary_jasa + parseInt((tablejasa.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            for (var r = 1, n = tableopl.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tableopl.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        totalsummary_opl = totalsummary_opl + parseInt((tableopl.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            var totalsummaryjasa = parseInt(totalsummary_jasa) + parseInt(totalsummary_opl);
            $("#summarytotal_jasa").val(formatRupiah(totalsummaryjasa.toString(), ''));

        }


        function subtotal() {
            var tablepart = document.getElementById('detailsparepart');
            var tablejasa = document.getElementById('detailjasa');
            var tableopl = document.getElementById('detailopl');
            var dpp_part = 0;
            var dpp_jasa = 0;
            var dpp_opl = 0;
            if (tablepart.rows.length == 1 && tablejasa.rows.length == 1 && tableopl.rows.length == 1) {
                $("#dpp").val("0");
            }

            for (var r = 1, n = tablepart.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tablepart.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        dpp_part = dpp_part + parseInt((tablepart.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            for (var r = 1, n = tablejasa.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tablejasa.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        dpp_jasa = dpp_jasa + parseInt((tablejasa.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            for (var r = 1, n = tableopl.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tableopl.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        dpp_opl = dpp_opl + parseInt((tableopl.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            var dpp = parseInt(dpp_part) + parseInt(dpp_jasa) + parseInt(dpp_opl);
            $("#dpp").val(formatRupiah(dpp.toString(), ''));
        }


        function PPN() {
            // console.log(getppn);
            // console.log(ppnkonfigurasi);

            if (getppn == '1') {
                var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");

                // var hitungppn = (parseFloat(dpp.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * 10) / 100;
                var hitungppn = (parseFloat(dpp.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(ppnkonfigurasi)) / 100;
                var roundppn = Math.round(hitungppn);
                $('#ppn').val(formatRupiah(roundppn.toString(), ''));
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




        //--------------------- Look up Regular Check ------------------------------

        document.getElementById("cariregular").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchregular').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/Cariregularcheck'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_regularchecklist",
                        field: {
                            kode: "kode",
                            nama: "nama"
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

        $(document).on('click', ".searchrc", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/Getregularcheck'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#koderegular').val(data[i].kode.trim());
                        $('#namaregular').val(data[i].nama.trim());
                        DetailRegularCheck(data[i].kode.trim());
                    }
                }
            }, false);
        });

        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            //BersihkanLayarBaru();      
            location.reload(true);
        });

        function ambildatadetailPart() {
            var table = document.getElementById('detailsparepart');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 1, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 1) {
                        string = "{" + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }
                string = string + "}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }

        function ambildatadetailJasa() {
            var table = document.getElementById('detailjasa');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 1, m = table.rows[r].cells.length; c < m - 2; c++) {
                    if (c == 1) {
                        string = "{" + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }
                string = string + "}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }

        function ambildatadetailOPL() {
            var table = document.getElementById('detailopl');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 1, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 1) {
                        string = "{" + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }
                string = string + "}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }


        // ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetailpart = ambildatadetailPart();
            var datadetailjasa = ambildatadetailJasa();
            var datadetailopl = ambildatadetailOPL();
            var nomor = $('#nomor').val();
            var nomorbooking = $('#nomorbooking').val();
            var booking = $("input[name='booking']:checked").val();
            var nopolisi = $('#nopolisi').val();
            var norangka = $('#norangka').val();
            var nomor_customer = $('#nocustomer').val();
            var tipe = $('#kode_tipe').val();
            var namatipe = $('#nama_tipe').val();
            var returnjob = $("input[name='returnjob']:checked").val();
            var inventaris = $("input[name='inventaris']:checked").val();
            var warranty = $("input[name='warranty']:checked").val();
            var jenisservice = $('#jenis').val();
            var tanggal = $('#tanggal').val();
            var keterangan = $('#keterangan').val();
            var pic = $('#pic').val();
            var nohppic = $('#nohp').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var totalpart = $('#summarytotal_sparepart').val();
            var totaljasa = $('#summarytotal_jasa').val();
            var kode_teknisi = $('#kode_teknisi').val();
            var nama_teknisi = $('#nama_teknisi').val();
            var kode_foreman = $('#kode_foreman').val();
            var nama_foreman = $('#nama_foreman').val();
            var keluhan = $('#keluhan').val();
            var odemeter = $('#odemeter').val();
            var kodecabang = $('#scabang').val();
            var koderegular = $('#koderegular').val();
            var namaregular = $('#namaregular').val();
            var noestimasi = $('#noestimasi').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var tglestimasi = $('#tanggalestimasi').val();
            var statustunggu = $('#statustunggu').val();
            var tanggalmasuk = $('#tanggalmasuk').val();
            var tanggalkerja = $('#tglkerjakan').val();
            var projectmanager = $('#projectmanager').val();
            var kode_teknisi2 = $('#kode_teknisi2').val();
            var kode_teknisi3 = $('#kode_teknisi3').val();
            var kode_teknisi4 = $('#kode_teknisi4').val();
            var statuskendaraan = $('#statuskendaraan').val();
            var stkendaraan = $('#stkendaraan').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/entry_spk/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nopolisi: nopolisi,
                        norangka: norangka,
                        nomor_customer: nomor_customer,
                        tipe: tipe,
                        namatipe: namatipe,
                        returnjob: returnjob,
                        inventaris: inventaris,
                        jenisservice: jenisservice,
                        tanggal: tanggal,
                        keterangan: keterangan,
                        pic: pic,
                        nohppic: nohppic,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        kode_teknisi: kode_teknisi,
                        nama_teknisi: nama_teknisi,
                        nama_foreman: nama_foreman,
                        kode_foreman: kode_foreman,
                        totalpart: totalpart,
                        totaljasa: totaljasa,
                        keluhan: keluhan,
                        odemeter: odemeter,
                        kodecabang: kodecabang,
                        booking: booking,
                        nomorbooking: nomorbooking,
                        namaregular: namaregular,
                        koderegular: koderegular,
                        warranty: warranty,
                        noestimasi: noestimasi,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        tglestimasi: tglestimasi,
                        statustunggu: statustunggu,
                        tanggalmasuk: tanggalmasuk,
                        tanggalkerja: tanggalkerja,
                        projectmanager: projectmanager,
                        kode_teknisi2: kode_teknisi2,
                        kode_teknisi3: kode_teknisi3,
                        kode_teknisi4: kode_teknisi4,
                        detailpart: datadetailpart,
                        detailjasa: datadetailjasa,
                        detailopl: datadetailopl,
                        statuskendaraan:statuskendaraan,
                        stkendaraan:stkendaraan
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
                                        btnClass: 'btn-red',
                                        action: function() {
                                            window.open(
                                                "<?php echo base_url('form/form/cetak_spk/') ?>" + data.nomor
                                            );
                                        }
                                    }
                                }
                            });
                            $('#nomor').val(data.nomor);
                            TurnDisable();
                            // window.open(
                            //     "<?php echo base_url('form/form/cetak_spk/') ?>" + data.nomor
                            // );
                        } else {
                            $.alert({
                                title: 'Info..',
                                content: data.message,
                                buttons: {
                                    formSubmit: {
                                        text: 'OK',
                                        btnClass: 'btn-red',
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






        //---------- Booking ------------------------------------
        document.getElementById("booking").addEventListener("change", function(event) {
            event.preventDefault();
            var book = $("#booking").val();
            if (book == "true") {
                $("#book").show();
                $('#nomorbooking').val("");
            }
        });
        document.getElementById("nonbooking").addEventListener("change", function(event) {
            event.preventDefault();
            var book = $("#nonbooking").val();
            if (book == "false") {
                $("#book").hide();
                $('#nomorbooking').val("");
                $('#keluhan').val("");
                // $('#detaildataparts').empty();
                // $('#detaildatatask').empty();
                $('#detaildataspk').empty();
                $('#grandtotal').val("0");
                $('#total_jasa').val("0");
                $('#total_sparepart').val("0");
                $('#dpp').val("0");
                $('#ppn').val("0");
                $("#nonreturnjob").prop("checked", "false");
                $("#noninventaris").prop("checked", "false");
            }
        });



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
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/entry_spk/CariDataFind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_wo",
                        field: {
                            nomorspk: "nomorspk",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nama_customer: "nama_customer",
                            jenismobil: "jenismobil"
                        },
                        sort: "nomorspk",
                        where: {
                            nomorspk: "nomorspk",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nama_customer: "nama_customer",
                            jenismobil: "jenismobil"
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchok", function() {
            BersihkanLayarBaru();
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/Find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#norangka').val(data[i].norangka.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        if (data[i].returnjob == 't') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }
                        if (data[i].inventaris == 't') {
                            $('input:radio[name="inventaris"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="inventaris"][value="false"]').prop('checked', true);
                        }
                        if (data[i].booking == 't') {
                            $('input:radio[name="booking"][value="true"]').prop('checked', true);
                            $("#book").show();
                        } else {
                            $('input:radio[name="booking"][value="false"]').prop('checked', true);
                            $("#book").hide();
                        }
                        if (data[i].garansi == 't') {
                            $('input:radio[name="warranty"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="warranty"][value="false"]').prop('checked', true);
                        }
                        $('#jenis').val(data[i].jenisservice.trim());
                        $('#nomorbooking').val(data[i].nomorbooking.trim());
                        $('#noestimasi').val(data[i].nomorestimasi.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#pic').val(data[i].pic.trim());
                        $('#nohp').val(data[i].nohppic.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].nama_teknisi.trim());
                        $('#kode_foreman').val(data[i].kode_foreman.trim());
                        $('#nama_foreman').val(data[i].nama_foreman.trim());
                        $('#scabang').val(data[i].kode_cabang.trim());
                        $('#odemeter').val(data[i].odemeter.trim());
                        $('#model').val(data[i].kodekategori.trim());
                        if (data[i].status != '0') {
                            document.getElementById('update').disabled = true;
                            document.getElementById('cancel').disabled = true;
                        } else {
                            document.getElementById('update').disabled = false;
                            document.getElementById('cancel').disabled = false;
                        }
                        $('#koderegular').val(data[i].kode_regularcheck.trim());
                        $('#namaregular').val(data[i].nama_regularcheck.trim());
                        $('#tanggalest').val(formatDateEst(data[i].tglestimasi.trim()));
                        $('#tanggalmasuk').val(formatDate(data[i].tanggalmasuk.trim()));
                        $('#tanggalkerja').val(formatDate(data[i].tanggalkerja.trim()));
                        $('#statustunggu').val(data[i].statustunggu.trim());
                        $('#statuskendaraan').val(data[i].statuskendaraan.trim());
                        $('#stkendaraan').val(data[i].statuspekerjaanmobil.trim());
                        $('#nilaiuangmuka').val(formatRupiah(data[i].nilaiuangmuka.trim(), ''));
                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());
                        FindDataDetail(data[i].nomor.trim());

                        $('#summarytotal_sparepart').val(formatRupiah(data[i].totalpart.trim(), ''));
                        $('#summarytotal_jasa').val(formatRupiah(data[i].totaljasa.trim(), ''));
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim(), ''));
                        $('#projectmanager').val(data[i].projectmanager.trim());
                    }
                    FindDisable();
                }
            }, false);
        });
        // -- END FIND --


        // ---------- ON BUTTON UPDATE ---------------------------------------------
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetailpart = ambildatadetailPart();
            var datadetailjasa = ambildatadetailJasa();
            var datadetailopl = ambildatadetailOPL();
            var nomor = $('#nomor').val();
            var returnjob = $("input[name='returnjob']:checked").val();
            var inventaris = $("input[name='inventaris']:checked").val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var keterangan = $('#keterangan').val();
            var keluhan = $('#keluhan').val();
            var totalpart = $('#summarytotal_sparepart').val();
            var totaljasa = $('#summarytotal_jasa').val();
            var kode_teknisi = $('#kode_teknisi').val();
            var nama_teknisi = $('#nama_teknisi').val();
            var kode_foreman = $('#kode_foreman').val();
            var nama_foreman = $('#nama_foreman').val();
            var koderegular = $('#koderegular').val();
            var namaregular = $('#namaregular').val();
            var warranty = $("input[name='warranty']:checked").val();
            var tglestimasi = $('#tanggalestimasi').val();
            var tanggalmasuk = $('#tanggalmasuk').val();
            var statustunggu = $('#statustunggu').val();
            var tanggalkerja = $('#tglkerjakan').val();
            var projectmanager = $('#projectmanager').val();
            var kode_teknisi2 = $('#kode_teknisi2').val();
            var kode_teknisi3 = $('#kode_teknisi3').val();
            var kode_teknisi4 = $('#kode_teknisi4').val();
            var statuskendaraan = $('#statuskendaraan').val();
            var stkendaraan = $('#stkendaraan').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/entry_spk/Update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        returnjob: returnjob,
                        keluhan: keluhan,
                        inventaris: inventaris,
                        keterangan: keterangan,
                        totalpart: totalpart,
                        totaljasa: totaljasa,
                        kode_teknisi: kode_teknisi,
                        nama_teknisi: nama_teknisi,
                        nama_foreman: nama_foreman,
                        kode_foreman: kode_foreman,
                        koderegular: koderegular,
                        namaregular: namaregular,
                        warranty: warranty,
                        tglestimasi: tglestimasi,
                        statustunggu: statustunggu,
                        tanggalmasuk: tanggalmasuk,
                        tanggalkerja: tanggalkerja,
                        projectmanager: projectmanager,
                        kode_teknisi2: kode_teknisi2,
                        kode_teknisi3: kode_teknisi3,
                        kode_teknisi4: kode_teknisi4,
                        detailpart: datadetailpart,
                        detailjasa: datadetailjasa,
                        detailopl: datadetailopl,
                        statuskendaraan:statuskendaraan,
                        stkendaraan:stkendaraan
                    },
                    success: function(data) {

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
            var noestimasi = $('#noestimasi').val();
            var booking = $("input[name='booking']:checked").val();
            var nomorbooking = $('#nomorbooking').val();
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
                                    url: "<?php echo base_url('spk/entry_spk/Cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        booking: booking,
                                        noestimasi: noestimasi,
                                        nomorbooking: nomorbooking,
                                        alasan: alasan
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
                                                            BersihkanLayarBaru()
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

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_spk/') ?>" + nomor
            );
        });

        document.getElementById("cetakpkb").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_spkpkb/') ?>" + nomor
            );
        });

        //-------------------history SPK-------------------------------------
        document.getElementById("history").addEventListener("click", function(event) {
            event.preventDefault();
            var nopolisi = $('#nopolisi').val();
            $('#tablesearchspk').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // "scrollX": true,
                // "scrollY": true,
                // // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('spk/entry_spk/historyspk'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "history_sn",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nama: "nama",
                            keluhan: "keluhan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nama: "nama",
                            keluhan: "keluhan"
                        },
                        value: "nopolisi = '" + nopolisi + "'"
                    },
                }
            });
        }, false);


        // ---------- CARI BOOKING ---------------------------------------------
        document.getElementById("caribooking").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var nopolisi = $('#nopolisi').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = 0 and nopolisi = '" + nopolisi + "' and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = 0 and nopolisi = '" + nopolisi + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and status = 0 and nopolisi = '" + nopolisi + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchbk').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataBooking'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_bookingservice",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer"
                        },
                        value: values
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchbk", function() {
            //BersihkanLayarBaru();
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataBooking'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorbooking').val(data[i].nomor.trim());
                        $('input:radio[name="booking"][value="true"]').prop('checked', true);
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#koderegular').val(data[i].kode_regularcheck.trim());
                        $('#namaregular').val(data[i].nama_regularcheck.trim());
                        if (data[i].returnjob == 't') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }
                        if (data[i].inventaris == 't') {
                            $('input:radio[name="inventaris"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="inventaris"][value="false"]').prop('checked', true);
                        }
                        BookDataDetail(data[i].nomor.trim());
                    }
                }
            }, false);
        });
        // -- END FIND --

        // ---------- CARI BOOKING ---------------------------------------------
        document.getElementById("cariestimasi").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var nopolisi = $('#nopolisi').val();
            var kodecompany = $('#kodecompany').val();
            var kodesubcabang = $('#subcabang').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = 0 and nopolisi = '" + nopolisi + "' and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = 0 and nopolisi = '" + nopolisi + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and status = 0 and nopolisi = '" + nopolisi + "' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchest').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataEstimasi'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_estimasiwo",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka"
                        },
                        value: values
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchest", function() {
            //BersihkanLayarBaru();
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/entry_spk/GetDataEstimasi'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#noestimasi').val(data[i].nomor.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#koderegular').val(data[i].kode_regularcheck.trim());
                        $('#namaregular').val(data[i].nama_regularcheck.trim());
                        if (data[i].returnjob == 't') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }
                        if (data[i].inventaris == 't') {
                            $('input:radio[name="inventaris"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="inventaris"][value="false"]').prop('checked', true);
                        }
                        if (data[i].garansi == 't') {
                            $('input:radio[name="warranty"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="warranty"][value="false"]').prop('checked', true);
                        }
                        $('#jenis').val(data[i].jenisservice.trim());
                        EstDataDetail(data[i].nomor.trim());
                    }
                }
            }, false);
        });
        // -- END FIND --


        function TotalParts() {
            var table = document.getElementById('detailspk');
            var total = 0;
            var total2 = 0;
            if (table.rows.length == 1) {
                $("#total_sparepart").val("0");
                $("#total_jasa").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var jn = 0;
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {

                    if (c == 6 && table.rows[r].cells[3].innerHTML == 1) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#total_sparepart").val(formatRupiah(total.toString(), ''));

                    } else if (c == 6 && (table.rows[r].cells[3].innerHTML == 2 || table.rows[r].cells[3].innerHTML == 3)) {
                        total2 = total2 + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#total_jasa").val(formatRupiah(total2.toString(), ''));
                    }
                }
            }
        }

        // function TotalTask(){
        //     var table = document.getElementById('detailtask');
        //     var total = 0;
        //     if (table.rows.length == 1){
        //         $("#total_jasa").val("0");
        //     }
        //     for (var r = 1, n = table.rows.length; r < n; r++) {
        //         var string ="";
        //         for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
        //             if (c==6) {
        //                 total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",","").replace(",","").replace(",","").replace(",",""))
        //                 $("#total_jasa").val(formatRupiah(total.toString(),''));

        //             }
        //         }
        //     }
        // }



        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildataspk');
            TotalParts();
            //TotalTask();
            subtotal();
            PPN();
            Grandtotal();
        });

    });
</script>