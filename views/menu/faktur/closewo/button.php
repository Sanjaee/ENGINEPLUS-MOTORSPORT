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
        $nama_menu = 'Close WO';

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
            $('#nomor').val("QC" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#kode_kategori').val("");
            $('#nama_kategori').val("");
            $('#total_sparepart').val("0");
            $('#total_jasaa').val("0");
            $('#totall_opl').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#grandtotal').val("0");
            $('#kode_teknisi').val("");
            $('#nama_teknisi').val("");
            $("#nocustomer").val("");
            $("#namacustomer").val("");
            $('#keterangan').val("");
            $('#nopolisi').val("");
            $('#nomorspk').val("");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);
            $('#txtdpp').hide();
            $("#nonreturnjob").prop("checked", "true");
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('returnjob').disabled = true;
            document.getElementById('nonreturnjob').disabled = true;
            document.getElementById('keterangan').disabled = false;
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildataopl').empty();
            var _row = null;
            $("#loading").hide();
            loadppnkonfigurasi();
        };
        BersihkanLayarBaru();

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


        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#nomorspk').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih SPK Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carispk').focus();
                var result = false;
            } else if ($('#keterangan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Keterangan pengerjaan tidak boleh kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#keterangan').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function DataOPL(nomorspk) {
            //var nomor_pembebanan = "";
            $('#detaildataopl').empty();
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetDataOPL'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomorspk: nomorspk
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = '3';
                        var kode = data[i].kode_pekerjaan.trim();
                        var nama = data[i].nama_pekerjaan.trim();
                        var qty = '1';
                        var harga = formatRupiah(data[i].hargajual.trim().toString(), '');
                        var persen = '0';
                        var discount = '0';
                        var subtotal = formatRupiah(data[i].hargajual.trim().toString(), '');

                        inserttableopl(kode, nama, jenis, qty, harga, persen, discount, subtotal, "");
                    }
                }
            });
        };

        function PembebananPartsDetail(nomor) {
            $('#detaildatasparepart').empty();
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetDataPembebananPartsDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = '1';
                        var kode = data[i].kodepart.trim();
                        var nama = data[i].namapart.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].hargasatuan.trim().toString(), '');
                        var persen = '0';
                        var discount = '0';
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');

                        inserttableparts(kode, nama, jenis, qty, harga, persen, discount, subtotal, "");
                    }
                }
            });
        };

        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetDataTipe'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode_tipe: kode_tipe
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_tipe').val(data[i].nama.trim());
                        $('#kode_kategori').val(data[i].kodekategori.trim());

                        DataProduct(data[i].kodekategori.trim());
                    }
                }
            });
        };

        function DataProduct(kode) {
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetDataProduct'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_kategori').val(data[i].nama.trim());
                    }
                }
            });
        };

        function DataCustomer(nocustomer) {
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetDataCustomer'); ?>",
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

        function DataParts(kode) {
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetDataParts'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama').val(data[i].nama.trim());
                        $('#harga').val(formatRupiah(data[i].hargajual.trim(), ''));
                        $('#jenis_detail').val(1);
                    }
                }
            });
        };

        function DataTask(kode) {
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetDataTask'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama').val(data[i].nama.trim());
                        $('#harga').val(formatRupiah(data[i].hargajual.trim(), ''));
                        $('#jenis_detail').val(2);
                    }
                }
            });
        };


        // ---------LOOKUP SPK ----------------------------------
        document.getElementById("carispk").addEventListener("click", function(event) {
            event.preventDefault();
            kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "status = 0 and batal = false"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and status = 0 and batal = false"
            // }
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
                // // "scrollX": true,
                // "scrollY": true,
                // // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('faktur/closewo/CariDataSPK'); ?>",
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


        $(document).on('click', ".searchspk", function() {
            var result = $(this).attr("data-id");
            $('#nomorspk').val(result.trim());
            DataSPK(result.trim());
        });

        // ---------- GET DATA --------------------------------------
        function DataSPK(nomorspk) {
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetDataSPK'); ?>",
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
                        $('#kode_kategori').val(data[i].kategori.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].nama_teknisi.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        // $('#summarytotal_sparepart').val(formatRupiah(data[i].totalpart.trim().toString(), ''));
                        // $('#summarytotal_jasa').val(formatRupiah(data[i].totaljasa.trim().toString(), ''));
                        $('#dpp').val(formatRupiah(data[i].dpp.trim().toString(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim().toString(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim().toString(), ''));
                        if (data[i].returnjob == 'true') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="nonreturnjob"][value="false"]').prop('checked', true);
                        }
                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());
                        DataProduct(data[i].kategori.trim());
                        FindSpkDetail(data[i].nomorspk.trim());
                        PembebananPartsDetail(data[i].nomorspk.trim());
                        DataOPL(data[i].nomorspk.trim());
                    }
                }
            });
        };


        function FindSpkDetail(nomor) {
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildataopl').empty();
            $.ajax({
                url: "<?php echo base_url('faktur/closewo/GetSPKDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = data[i].jenis.trim();
                        var kode = data[i].kodereferensi.trim();
                        var nama = data[i].namareferensi.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var persen = data[i].persendiscperitem.trim();
                        var discount = formatRupiah(data[i].discperitem.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        var status = data[i].statuspekerjaan.trim();
                        inserttablewo(kode, nama, jenis, qty, harga, persen, discount, subtotal, status, "");

                    }
                }
            });
        };
        // ---------- CALCULATE ---------------------------------------------



        // ---------- ADD DETAIl ---------------------------------------------
        function inserttableparts(kode, nama, jenis, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + jenis + '">' +
                '<td style="display:none;"></td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new" '+find+'><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            HitungTotalParts();
        }


        function HitungTotalParts() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#total_sparepart").val(0);
                $("#summarytotal_sparepart").val(0);
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[8].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                }
                $("#total_sparepart").val(formatRupiah(total.toString(), ''));
                $("#summarytotal_sparepart").val(formatRupiah(total.toString(), ''));
            }
            subtotal();
        }

        function inserttablewo(kode, nama, jenis, qty, harga, persen, discount, subtotal, status, find) {
            var button = "";
            if (status == '0') {
                button = '<span class="btn btn-light">Waiting</span>';
            } else if (status == '1') {
                button = '<span class="btn btn-warning">Progress</span>';
            } else if (status == '2') {
                button = '<span class="btn btn-success">Done</span>';
            } else if (status == '3') {
                button = '<span class="btn btn-danger">Batal</span>';
            }

            var row = "";
            row =
                '<tr id="' + jenis + '">' +
                '<td style="display:none;"></td>' +
                '<td style="text-align:left;">' + kode + '</td>' +
                '<td style="text-align:left;">' + nama + '</td>' +
                '<td style="text-align:center;">' + jenis + '</td>' +
                '<td style="text-align:center;">' + qty + '</td>' +
                '<td style="text-align:right;">' + harga + '</td>' +
                '<td style="text-align:center;">' + persen + '</td>' +
                '<td style="text-align:center;">' + discount + '</td>' +
                '<td style="text-align:right;">' + subtotal + '</td>' +
                '<td style="text-align:center;">' + button + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new" '+find+'><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatajasa').append(row);
            // $('#bebas').html(row);
            HitungTotalJasa();
        }

        function HitungTotalJasa() {
            var table = document.getElementById('detailjasa');
            var total = 0;
            if (table.rows.length == 1) {
                $("#total_jasaa").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[8].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                }

                $("#summarytotal_jasa").val(formatRupiah(total.toString(), ''));
                $("#total_jasaa").val(formatRupiah(total.toString(), ''));
            }
            subtotal();
        }

        function inserttableopl(kode, nama, jenis, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + jenis + '">' +
                '<td style="display:none;"></td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new" '+find+'><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildataopl').append(row);
            // $('#bebas').html(row);
            HitungTotalOPL();
        }

        function HitungTotalOPL() {
            var table = document.getElementById('detailopl');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totall_opl").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[8].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                }

                $("#totall_opl").val(formatRupiah(total.toString(), ''));
                $("#summarytotal_opl").val(formatRupiah(total.toString(), ''));
            }
            subtotal();
        }


        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildatafaktur');
            // subtotal();
        });


        // ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var nomorspk = $('#nomorspk').val();
            var kode_tipe = $('#kode_tipe').val();
            var tanggal = $('#tanggal').val();
            var nocustomer = $('#nocustomer').val();
            var keterangan = $('#keterangan').val();
            var nopolisi = $('#nopolisi').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('faktur/closewo/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nomorspk: nomorspk,
                        tanggal: tanggal,
                        nocustomer: nocustomer,
                        kode_tipe: kode_tipe,
                        nopolisi: nopolisi,
                        kodecabang: kodecabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        keterangan: keterangan
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
                            var nomor = $('#nomorspk').val();
                            window.open(
                                "<?php echo base_url('form/form/cetak_closewo/') ?>" + nomor
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
            kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = false"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and batal = false"
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
                    "url": "<?php echo base_url('faktur/Closewo/CariDataFaktur'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_closewo",
                        field: {
                            nomor: "nomor",
                            nomorwo: "nomorwo",
                            nopolisi: "nopolisi"

                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nomorwo: "nomorwo",
                            nopolisi: "nopolisi"
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
                url: "<?php echo base_url('faktur/closewo/FindCloseWO'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nomorspk').val(data[i].nomorwo.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());
                        DataSPK(data[i].nomorwo.trim());
                        // FindSpkDetail(data[i].nomorwo.trim());
                        // DataPembebananParts(data[i].nomorwo.trim());     
                        // FindSpkDetail(data[i].nomorwo.trim());
                        // DataPembebananParts(data[i].nomorwo.trim());  
                        // DataOPL(data[i].nomorwo.trim());
                    }
                    TurnDisable();
                }
            }, false);
        });
        // -- END FIND --

        // ---------- ON BUTTON CANCEL ---------------------------------------------
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var nomorspk = $('#nomorspk').val();
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
                                url: "<?php echo base_url('faktur/closewo/Cancel'); ?>",
                                method: "POST",
                                dataType: "json",
                                async: true,
                                data: {
                                    nomor: nomor,
                                    nomorspk: nomorspk,
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
        });



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


        function PPN() {
            if (getppn == '1') {
                var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");

                // var hitungppn = (parseFloat(dpp.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * 10) / 100;
                var hitungppn = (parseFloat(dpp.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(ppnkonfigurasi)) / 100;
                var roundppn = Math.round(hitungppn);
                $('#ppn').val(formatRupiah(roundppn.toString(), ''));
            } else {
                $('#ppn').val(0);
            }
            Grandtotal();
        }

        function Grandtotal() {
            var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ppn = $('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseInt($('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "")) + parseInt($('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#grandtotal').val(formatRupiah(total.toString(), ''));
        }

        function subtotal() {
            var table = document.getElementById('detailfaktur');
            var totalopl = $('#summarytotal_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totaljasa = $('#summarytotal_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalpart = $('#summarytotal_sparepart').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseInt(totalopl) + parseInt(totaljasa) + parseInt(totalpart);
            $('#dpp').val(formatRupiah(total.toString(), ''));
            PPN();
        }

        function ambildatadetailpart() {
            var table = document.getElementById('detailsparepart');
            var arr2 = [];
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

        function ambildatadetailjasa() {
            var table = document.getElementById('detailjasa');
            var arr2 = [];
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

        function ambildatadetailopl() {
            var table = document.getElementById('detailopl');
            var arr2 = [];
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

        // ---------- ON FILTER ------------------------------------
        // document.getElementById("jenis_detail").addEventListener("change", function(event) {
        //     event.preventDefault();

        // });

        //------------- Turn Disable -------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
        });
        //------------- Turn Disable -------------------
        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            document.getElementById('carispk').disabled = true;
        };

        function TurnDisable() {
            document.getElementById('cancel').disabled = false;
            document.getElementById('save').disabled = true;
            document.getElementById('carispk').disabled = true;
            document.getElementById('keterangan').disabled = true;
        }

    });

    // ---------- ON BUTTON CETAK ---------------------------------------------
    document.getElementById("cetak").addEventListener("click", function(event) {
        var nomor = $('#nomorspk').val();
        window.open(
            "<?php echo base_url('form/form/cetak_closewo/') ?>" + nomor
        );
    });

    // ---------- ON BUTTON CETAK ---------------------------------------------
    document.getElementById("excel").addEventListener("click", function(event) {
        var nomor = $('#nomorspk').val();
        window.open(
            "<?php echo base_url('export_excel/report/cetak_closewo/') ?>" + nomor
        );
    });
</script>