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
        $nama_menu = 'Entry Faktur';

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
            $('#nomor').val("SV-" + kode_cabang + "-" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            $('#tgljttempo').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#nopolisi').val("");
            $('#nomorspk').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#kode_kategori').val("");
            $('#nama_kategori').val("");
            $('#pic').val("");
            $("#nocustomer").val("");
            $("#namacustomer").val("");
            $('#nohp').val("");
            $('#keluhan').val("");
            $('#jenis').val("0");
            $('#kode_teknisi').val("");
            $('#nama_teknisi').val("");
            $('#jenis_detail').val("0");
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
            $('#harga_jasa').val("0");
            $('#harga_opl').val("0");
            $('#total_part').val("0");
            $('#total_jasa').val("0");
            $('#total_opl').val("0");
            $('#grandtotal').val("0");
            $('#persen_part').val("0");
            $('#persen_jasa').val("0");
            $('#persen_opl').val("0");
            $('#discount_part').val("0");
            $('#discount_jasa').val("0");
            $('#discount_opl').val("0");
            $('#keterangan').val("");
            $('#total_jasa').val("0");
            $('#total_jasaa').val("0");
            $('#total_opl').val("0");
            $('#totall_opl').val("0");
            $('#total_sparepart').val("0");
            $('#summarytotal_jasa').val("0");
            $('#summarytotal_sparepart').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#uangmuka').val("0");
            $('#jenis').val("-");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);
            // $("#caritask").hide();
            // $("#cariparts").hide();
            // $("#edit_detail").hide();
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildataopl').empty();

            $("#returnjob").prop("checked", "true");
            $("#inventaris").prop("checked", "true");
            $('#detaildatafaktur').empty();
            $('#tgltempo').datepicker({
                format: "dd MM yyyy",
                autoclose: true,
                todayHighlight: true
            });
            document.getElementById('nama_part').disabled = true
            document.getElementById('nama_jasa').disabled = true
            document.getElementById('nama_opl').disabled = true
            document.getElementById('qty_part').disabled = true;
            document.getElementById('qty_jasa').disabled = true;
            document.getElementById('qty_opl').disabled = true;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('carispk').disabled = false;
            document.getElementById('returnjob').disabled = true;
            document.getElementById('nonreturnjob').disabled = true;
            document.getElementById('remove_part').disabled = true;
            document.getElementById('remove_jasa').disabled = true;
            document.getElementById('remove_opl').disabled = true;
            document.getElementById('add_detailpart').disabled = false;
            document.getElementById('add_detailjasa').disabled = false;
            document.getElementById('add_detailopl').disabled = false;
            document.getElementById('caritask').disabled = false;
            document.getElementById('discount_part').disabled = false;
            document.getElementById('discount_jasa').disabled = false;
            document.getElementById('discount_opl').disabled = false;
            document.getElementById('persen_part').disabled = false;
            document.getElementById('persen_jasa').disabled = false;
            document.getElementById('persen_opl').disabled = false;
            document.getElementById('total_part').disabled = true;
            document.getElementById('total_jasa').disabled = true;
            document.getElementById('total_opl').disabled = true;
            document.getElementById('detailkategori_part').disabled = true;
            document.getElementById('detailkategori_jasa').disabled = true;
            document.getElementById('detailkategori_opl').disabled = true;
            $("#caricust").hide();
            loadppnkonfigurasi();
        };
        BersihkanLayarBaru();
        $("#loading").hide();

        //------------- Turn Disable -------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
        });

        $('#billto').change(function() {
            if (this.checked) {
                $("#caricust").show();
            } else {
                $("#caricust").hide();
            }
            $('#billto').val(this.checked)
        });

        $('#tablesearchtampil').css('visibility', 'hidden');

        var _row = null;


        $("#removeparts").click(function() {
            var nomor = $('#kode').val().replace("/", "").replace("/", "").replace("/", "").replace("/", "");
            if (nomor != "") {
                $('#' + nomor).remove();
            }
            subtotalb();
            PPN();
            Grandtotal();
        });

        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#nomorspk').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nomor SPK Tidak Boleh Kosong',
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

        // ----- END Validasi -----


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

        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 && data.which != 46 || data.which > 57)) {
                return false;
            }
        };

        // $('#qty').on('change', function() {
        //     var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
        //     var qty = $('#qty').val();

        //     var hitungsubtotal = parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
        //     //$('#subtotal').val(formatRupiah(hitungsubtotal.toString(),''));
        //     $('#total').val(formatRupiah(hitungsubtotal.toString(), ''));
        // });

        $("#persen_part").keypress(function(data) {
            return angka(data);
        });

        $("#persen_jasa").keypress(function(data) {
            return angka(data);
            return HitungTotal3();
        });

        $("#persen_opl").keypress(function(data) {
            return angka(data);
        });

        $("#qty_part").keypress(function(data) {
            return angka(data);
        });

        $("#qty_jasa").keypress(function(data) {
            return angka(data);
        });

        $("#qty_opl").keypress(function(data) {
            return angka(data);
        });

        $('#persen').keyup(function() {
            var persen = this.value;
            return HitungTotal3();
        });

        // $("#discount_part").keypress(function(data) {
        //     return angka(data);
        // });

        $("#discount_jasa").keypress(function(data) {
            return angka(data);
        });

        $("#discount_opl").keypress(function(data) {
            return angka(data);
        });

        $('#discount').keyup(function() {
            var discount = this.value;
            return HitungTotal4();
        });

        $("#total").keypress(function(data) {
            return angka(data);
        });

        $("#total").keyup(function() {
            var total = this.value;
            return HitungTotalx();
        });

        function HitungTotalx() {
            var total = $('#total').val();
            var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty = parseFloat(total.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) / parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            var qtys = parseFloat(qty).toFixed(2);
            $('#qty').val(formatRupiah(qtys.toString(), ''));
            $('#totalx').val(formatRupiah(total.toString(), ''));
            $("#persen").val("0");
            $("#discount").val("0");
        }

        // var disc_part = document.getElementById('discount_part');
        // disc_part.addEventListener('keyup', function(e) {
        //     disc_part.value = formatRupiah(this.value, '');
        // });

        var disc_jasa = document.getElementById('discount_jasa');
        disc_jasa.addEventListener('keyup', function(e) {
            disc_jasa.value = formatRupiah(this.value, '');
        });

        var disc_opl = document.getElementById('discount_opl');
        disc_opl.addEventListener('keyup', function(e) {
            disc_opl.value = formatRupiah(this.value, '');
        });

        $('#qty').keyup(function() {
            var qty = this.value;
            return HitungTotal();
        });

        function HitungTotal2() {
            var qtyterima = $('#qty').val();
            var hargasatuan = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = $('#totalx').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var jenis = $('#jenis_detail').val();
            if (jenis == '1') {
                var total = (parseFloat(hargasatuan) * parseFloat(qtyterima)) - parseFloat(discount) * parseFloat(qtyterima);
            } else {
                var total = (parseFloat(total) - parseFloat(discount));
            }
            // if (jenis != '1'){
            //     var total = (parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) - parseFloat(discount.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            // }else{
            // var total = (parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) - parseFloat(discount.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            // }        
            var totalx = Math.round(total);
            $('#total').val(formatRupiah(totalx.toString(), ''));
            //$('#total').val(total.toString());
        }

        function HitungTotal() {
            var qty = $('#qty').val();
            var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            var totalx = Math.round(total);
            $('#total').val(formatRupiah(totalx.toString(), ''));
            $('#totalx').val(formatRupiah(totalx.toString(), ''));
        }

        function HitungTotal3() {
            var persen = $('#persen').val();
            var qtyterima = $('#qty').val();
            var hargasatuan = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = $('#totalx').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            // var discount = (parseFloat(persen.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * (parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", "")))) / 100;
            var jenis = $('#jenis_detail').val();
            if (jenis == '1') {
                var discount = (parseFloat(persen) * parseFloat(hargasatuan)) / 100;
            } else {
                var discount = (parseFloat(persen) * (parseFloat(total)) / 100);
            }
            var discountr = Math.round(discount);
            $('#discount').val(formatRupiah(discountr.toString(), ''));
            HitungTotal2();
        }

        function HitungTotal4() {
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qtyterima = $('#qty').val();
            var hargasatuan = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            // var persen = (parseFloat(discount) / (parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) ) * 100;
            // var pesenfix = Math.round(persen)/100;
            var total = $('#totalx').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var jenis = $('#jenis_detail').val();
            if (jenis == '1') {
                var persen = ((parseFloat(discount) * parseFloat(qtyterima)) / (parseFloat(hargasatuan) * parseFloat(qtyterima))) * 100;
            } else {
                var persen = (parseFloat(discount) / parseFloat(total)) * 100;
            }
            var pesenfix = persen.toFixed(2);
            $('#persen').val(pesenfix.toString());
            HitungTotal2();
        }

        function subtotalb() {
            var table = document.getElementById('detailfaktur');
            var total = 0;
            //console.log(table.rows.length);
            if (table.rows.length == 1) {
                $("#dpp").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {

                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 8) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#dpp").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }

        // ---------- ON LOOKUP CUSTOMER ------------------------------------
        document.getElementById("caricust").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#scabang').val();
            var kodegrup = $('#kodegrupcabang').val();
            // if (kodecabang == "SPT" || kodecabang == "WKS") { //TAM
            //     values = "aktif = true and kodecompany = '" + kodecompany + "' and kode_cabang in ('WKS','SPT')"
            // } else {
                values = "aktif = true and kode_cabang = '" + kodecabang + "'"
            // }
            $('#tablesearchcust').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('faktur/faktur/CariDataCustomer'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_customer",
                        field: {
                            nomor: "nomor",
                            nama: "nama",
                            alamat: "alamat",
                            nohp: "nohp"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nama: "nama",
                            alamat: "alamat",
                            nohp: "nohp"
                        },
                        // value:"aktif = true"
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchcustomer", function() {
            var result = $(this).attr("data-id");
            $('#nocustomer').val(result.trim());
            DataCustomer(result.trim());
        });

        function DataCustomer(nocustomer) {
            $.ajax({
                url: "<?php echo base_url('faktur/faktur/GetDataCustomer'); ?>",
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

        // ---------- FIND ON LOOKUP SPK ----------------------------------
        document.getElementById("carispk").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = false and status = 1"
            // } else {
            //     values = "batal = false and status = 1 and kode_cabang = '" + kode_cabang + "'"
            // }
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = 1 and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = 1 and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and status = 1 and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
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
                    "url": "<?php echo base_url('faktur/faktur/CariDataSPK'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_wo",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_customer: "nomor_customer",
                            tipe: "tipe"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_customer: "nomor_customer",
                            tipe: "tipe"
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

        // ---------- DATA SPK --------------------------------------
        function DataSPK(nomorspk) {
            $.ajax({
                url: "<?php echo base_url('faktur/faktur/GetDataSPK'); ?>",
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
                        $('#uangmuka').val(formatRupiah(data[i].nilaiuangmuka.trim().toString(), ''));
                        $('#summarytotal_sparepart').val(formatRupiah(data[i].totalpart.trim().toString(), ''));
                        $('#summarytotal_jasa').val(formatRupiah(data[i].totaljasa.trim().toString(), ''));
                        $('#dpp').val(formatRupiah(data[i].dpp.trim().toString(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim().toString(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim().toString(), ''));
                        if (data[i].returnjob == 'true') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }

                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());
                        DataProduct(data[i].kategori.trim());
                        //DataPembebananParts(data[i].nomorspk.trim());
                        CariDataDetail(data[i].nomorspk.trim());

                    }
                }
            });
        };

        function CariDataDetail(nomor) {
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildataopl').empty();
            $.ajax({
                url: "<?php echo base_url('faktur/faktur/GetDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = data[i].jenis.trim();
                        var kode = data[i].kodepart.trim();
                        var nama = data[i].nama.trim();
                        var kategori = data[i].kategoridetail.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var persen = '0';
                        var discount = '0';
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        if (jenis == '1') {
                            inserttablepart(kode, nama, kategori, qty, harga, persen, discount, subtotal, "");
                        } else if (jenis == '2' || jenis == '4') {
                            inserttablejasa(kode, nama, kategori, jenis, qty, harga, persen, discount, subtotal, "");
                        } else if (jenis == '3') {
                            inserttableopl(kode, nama, kategori, qty, harga, persen, discount, subtotal, "");
                        }

                    };
                }
            });

        };

        // ------------------------------------- TAB SPAREPART -------------------------------------
        function inserttablepart(kode, nama, kategori, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode.replace(/[^\w\s]/gi, '') + '">' +
                '<td style="display:none;">' + kode.replace(/[^\w\s]/gi, '') + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td style="text-align:center" >' + qty + '</td>' +
                '<td style="text-align:right" >' + harga + '</td>' +
                '<td style="text-align:right" >' + persen + '</td>' +
                '<td style="text-align:right" >' + discount + '</td>' +
                '<td style="text-align:right" >' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode.replace(/[^\w\s]/gi, '') + '" class="edit_part btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            subtotalpart();
            DPP();
            PPN();
            Grandtotal();
            HitungTotalParts()
        }

        $(document).on('click', '.edit_part', function() {
            $('#qty_part').prop('disabled', false);
            $('#detailkategori_part').prop('disabled', false);

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode_part = _row.closest("tr").find("td:eq(1)").text();
            var nama_part = _row.closest("tr").find("td:eq(2)").text();
            var kategori_part = _row.closest("tr").find("td:eq(3)").text();
            var qty_part = _row.closest("tr").find("td:eq(4)").text();
            var harga_part = _row.closest("tr").find("td:eq(5)").text();
            var persen_part = _row.closest("tr").find("td:eq(6)").text();
            var discount_part = _row.closest("tr").find("td:eq(7)").text();
            var subtotal_part = _row.closest("tr").find("td:eq(8)").text();
            var subtotalx = _row.closest("tr").find("td:eq(8)").text();
            $('#kode_part').val(kode_part);
            $('#nama_part').val(nama_part);
            $('#jenisdetail_part').val("PART");
            $('#detailkategori_part').val(kategori_part);
            $('#qty_part').val(qty_part);
            $('#harga_part').val(harga_part);
            $('#persen_part').val(persen_part);
            $('#discount_part').val(discount_part);
            $('#total_part').val(subtotal_part);
            $('#totalx').val(subtotalx);

            // if (jenis == 2 || jenis == 4) {
            //     document.getElementById('qty').disabled = false;
            //     document.getElementById('total').disabled = false;
            // }else{
            //     document.getElementById('qty').disabled = true;
            //     document.getElementById('total').disabled = true;
            // }

            // if (jenis == 4) {
            //     document.getElementById('removeparts').disabled = false;
            // }else{
            //     document.getElementById('removeparts').disabled = true;
            // }

            // document.getElementById('jenis_detail').disabled = true;
            // document.getElementById('nama').disabled = true
            // document.getElementById('kategoridetail').disabled = false;
            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        $(document).on('keyup', '#qty_part', function() {
            var harga_part = $('#harga_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty_part = $('#qty_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var persen_part = $('#persen_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hasildisc = parseFloat(qty_part) * parseFloat(harga_part);
            var discount_part = $('#discount_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalharga_part = (parseFloat(hasildisc) - (parseFloat(discount_part) * parseFloat(qty_part)));
            $('#total_part').val(formatRupiah(Math.round(totalharga_part).toString(), ''));
        });

        $(document).on('keyup', '#persen_part', function() {
            var harga_part = $('#harga_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var persen_part = $('#persen_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty_part = $('#qty_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hasildisc = ((parseFloat(persen_part) / 100) * parseFloat(harga_part));
            $('#discount_part').val(formatRupiah(Math.round(hasildisc).toString(), ''));
            var totalakhir = (parseFloat(harga_part) - parseFloat(hasildisc)) * parseFloat(qty_part);
            $('#total_part').val(formatRupiah(Math.round(totalakhir).toString(), ''));
        });

        $(document).on('keyup', '#discount_part', function() {
            var harga_part = $('#harga_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount_part = $('#discount_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty_part = $('#qty_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hasildisc = ((parseFloat(discount_part) / parseFloat(harga_part)) * 100);
            $('#persen_part').val(formatRupiah(Math.round(hasildisc).toString(), ''));
            var totalakhir = (parseFloat(harga_part) - parseFloat(discount_part)) * parseFloat(qty_part);
            $('#total_part').val(formatRupiah(Math.round(totalakhir).toString(), ''));
        });


        function subtotalpart() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            //console.log(table.rows.length);
            if (table.rows.length == 1) {
                $("#total_sparepart").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    // console.log(table.rows[r].cells[c].innerHTML);
                    if (c == 8) {
                        total = total + parseInt((table.rows[r].cells[8].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#total_sparepart").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }

        // ---------- ADD DETAIl PART---------------------------------------------
        $("#add_detailpart").click(function() {
            var mgrup = $('#mgrup').val();
            var modul = '1';
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
                $('#kode_part').focus();
            } else if (validasidisc(mgrup, modul, $('#persen_part').val()) == true) {
                $.alert({
                    title: 'Info..',
                    content: 'Discount anda melebihi kapasitas',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#persen_part').focus();
            } else {

                var jenis = $("#jenisdetail_part").val();
                var kode = $("#kode_part").val();
                var nama = $("#nama_part").val();
                var harga = $("#harga_part").val();
                var qty = $("#qty_part").val();
                var kategoridetail = $("#detailkategori_part").val();
                var persen = $("#persen_part").val();
                var discount = $("#discount_part").val();
                var total = $("#total_part").val();

                if (cekdoublepart(kode.replace(/[^\w\s]/gi, '')) == true) {
                    inserttablepart(kode, nama, kategoridetail, qty, harga, persen, discount, total, find)
                    $("#kode_part").val("");
                    $("#nama_part").val("");
                    $("#harga_part").val("0");
                    $("#detailkategori_part").val("");
                    $("#qty_part").val("0");
                    // $("#subtotal").val("0");
                    $("#persen_part").val("0");
                    $("#discount_part").val("0");
                    $('#jenisdetail_part').val(0);
                    $("#total_part").val("0");
                    document.getElementById('detailkategori_part').disabled = true;
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
                                    $('#' + kode.replace(/[^\w\s]/gi, '')).remove();
                                    inserttablepart(kode, nama, kategoridetail, qty, harga, persen, discount, total, find)
                                    $("#kode_part").val("");
                                    $("#nama_part").val("");
                                    $("#harga_part").val("0");
                                    $("#detailkategori_part").val("");
                                    $("#qty_part").val("0");
                                    // $("#subtotal").val("0");
                                    $("#persen_part").val("0");
                                    $("#discount_part").val("0");
                                    $('#jenisdetail_part').val(0);
                                    $("#total_part").val("0");
                                    document.getElementById('detailkategori_part').disabled = true;
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

        function cekdoublepart(kode) {
            var table = document.getElementById('detailsparepart');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.replace(/[^\w\s]/gi, '') === kode) {
                    result = false;
                }
            }
            return result;
        }
        // ------------------------------------- END TAB SPAREPART -------------------------------------



        // ------------------------------------- TAB JASA  -------------------------------------
        document.getElementById("caritask").addEventListener("click", function(event) {
            var model = $('#kode_kategori').val();
            $('#kode_jasa').val("");
            $('#nama_jasa').val("");
            $('#qty_jasa').val("0");
            $('#harga_jasa').val("0");
            $('#total_jasa').val("0");
            $('#persen_jasa').val("0");
            $('#discount_jasa').val("0");
            event.preventDefault();
            $('#tablesearchtask').DataTable({
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
                    "url": "<?php echo base_url('faktur/faktur/CariDataTask'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_jasa",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            harga: "harga"
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
            var model = $('#kode_kategori').val();
            $.ajax({
                url: "<?php echo base_url('faktur/faktur/GetDataTask'); ?>",
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
                        } else {
                            $('#nama_jasa').val(data[i].nama.trim());
                            document.getElementById('nama_jasa').disabled = true
                        }
                        $('#nama_jasa').val(data[i].nama.trim());
                        $('#harga_jasa').val(formatRupiah(data[i].frt.trim(), ''));
                        $('#total_jasa').val(formatRupiah(data[i].harga.trim(), ''));
                        $('#qty_jasa').val(data[i].jam.trim());
                        $('#kodejenisdetail_jasa').val(4);
                        $('#jenisdetail_jasa').val("JASA TAMBAHAN");
                    }
                    document.getElementById('qty_jasa').disabled = false;
                }
            });
        };

        function inserttablejasa(kode, nama, kategori, jenis, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode.replace(/[^\w\s]/gi, '') + '">' +
                '<td style="display:none;">' + kode.replace(/[^\w\s]/gi, '') + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td style="display:none;">' + jenis + '</td>' +
                '<td style="text-align:center" >' + qty + '</td>' +
                '<td style="text-align:right" >' + harga + '</td>' +
                '<td style="text-align:right" >' + persen + '</td>' +
                '<td style="text-align:right" >' + discount + '</td>' +
                '<td style="text-align:right" >' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode.replace(/[^\w\s]/gi, '') + '" class="edit_jasa btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatajasa').append(row);
            // $('#bebas').html(row);
            subtotaljasa();
            HitungSummaryJasa();
            DPP();
            PPN();
            Grandtotal();
        }

        $(document).on('click', '.edit_jasa', function() {
            $('#qty_jasa').prop('disabled', false);
            $('#detailkategori_jasa').prop('disabled', false);

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode_jasa = _row.closest("tr").find("td:eq(1)").text();
            var nama_jasa = _row.closest("tr").find("td:eq(2)").text();
            var kategori_jasa = _row.closest("tr").find("td:eq(3)").text();
            var jenis_jasa = _row.closest("tr").find("td:eq(4)").text();
            var qty_jasa = _row.closest("tr").find("td:eq(5)").text();
            var harga_jasa = _row.closest("tr").find("td:eq(6)").text();
            var persen_jasa = _row.closest("tr").find("td:eq(7)").text();
            var discount_jasa = _row.closest("tr").find("td:eq(8)").text();
            var subtotal_jasa = _row.closest("tr").find("td:eq(9)").text();
            // var subtotalx = _row.closest("tr").find("td:eq(8)").text();
            var subtotaljasa = _row.closest("tr").find("td:eq(9)").text().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discountjasa = _row.closest("tr").find("td:eq(8)").text().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var subtotalx = parseFloat(subtotaljasa) + parseFloat(discountjasa);
            if (jenis_jasa == '2') {
                $('#kodejenisdetail_jasa').val(2);
                $('#jenisdetail_jasa').val("JASA");
            } else if (jenis_jasa == '4') {
                $('#kodejenisdetail_jasa').val(4);
                $('#jenisdetail_jasa').val("JASA TAMBAHAN");
            }
            $('#kode_jasa').val(kode_jasa);
            $('#nama_jasa').val(nama_jasa);
            $('#detailkategori_jasa').val(kategori_jasa);
            $('#qty_jasa').val(qty_jasa);
            $('#harga_jasa').val(harga_jasa);
            $('#persen_jasa').val(persen_jasa);
            $('#discount_jasa').val(discount_jasa);
            $('#total_jasa').val(subtotal_jasa);
            $('#totaljasa').val(subtotalx);


            // if (jenis == 2 || jenis == 4) {
            //     document.getElementById('qty').disabled = false;
            //     document.getElementById('total').disabled = false;
            // }else{
            //     document.getElementById('qty').disabled = true;
            //     document.getElementById('total').disabled = true;
            // }

            // if (jenis == 4) {
            //     document.getElementById('removeparts').disabled = false;
            // }else{
            //     document.getElementById('removeparts').disabled = true;
            // }

            // document.getElementById('jenis_detail').disabled = true;
            // document.getElementById('nama').disabled = true
            // document.getElementById('kategoridetail').disabled = false;
            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });


        function subtotaljasa() {
            var table = document.getElementById('detailjasa');
            var total = 0;
            //console.log(table.rows.length);
            if (table.rows.length == 1) {
                $("#total_jasaa").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    // console.log(table.rows[r].cells[c].innerHTML);
                    if (c == 9) {
                        total = total + parseInt((table.rows[r].cells[9].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#total_jasaa").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }

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
                    if (c == 9) {
                        totalsummary_jasa = totalsummary_jasa + parseInt((tablejasa.rows[r].cells[9].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            for (var r = 1, n = tableopl.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tableopl.rows[r].cells.length; c < m; c++) {
                    if (c == 8) {
                        totalsummary_opl = totalsummary_opl + parseInt((tableopl.rows[r].cells[8].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            var totalsummaryjasa = parseInt(totalsummary_jasa) + parseInt(totalsummary_opl);
            $("#summarytotal_jasa").val(formatRupiah(totalsummaryjasa.toString(), ''));

        }

        // ---------- ADD DETAIl JASA ---------------------------------------------
        $("#add_detailjasa").click(function() {
            var mgrup = $('#mgrup').val();
            var modul = '1';
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
                $('#kode_jasa').focus();
            } else if (validasidisc(mgrup, modul, $('#persen_jasa').val()) == true) {
                $.alert({
                    title: 'Info..',
                    content: 'Discount anda melebihi kapasitas',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#persen_jasa').focus();
            } else {

                var jenis = $("#kodejenisdetail_jasa").val();
                var kode = $("#kode_jasa").val();
                var nama = $("#nama_jasa").val();
                var harga = $("#harga_jasa").val();
                var qty = $("#qty_jasa").val();
                var kategoridetail = $("#detailkategori_jasa").val();
                var persen = $("#persen_jasa").val();
                var discount = $("#discount_jasa").val();
                var total = $("#total_jasa").val();

                if (cekdoublejasa(kode.replace(/[^\w\s]/gi, '')) == true) {
                    inserttablejasa(kode, nama, kategoridetail, jenis, qty, harga, persen, discount, total, find)
                    $("#kode_jasa").val("");
                    $("#nama_jasa").val("");
                    $("#harga_jasa").val("0");
                    $("#detailkategori_jasa").val("");
                    $("#qty_jasa").val("0");
                    // $("#subtotal").val("0");
                    $("#persen_jasa").val("0");
                    $("#discount_jasa").val("0");
                    $('#kodejenisdetail_jasa').val("");
                    $('#jenisdetail_jasa').val("");
                    $("#total_jasa").val("0");
                    $("#totaljasa").val("0");
                    document.getElementById('detailkategori_jasa').disabled = true;
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
                                    $('#' + kode.replace(/[^\w\s]/gi, '')).remove();
                                    inserttablejasa(kode, nama, kategoridetail, jenis, qty, harga, persen, discount, total, find)
                                    $("#kode_jasa").val("");
                                    $("#nama_jasa").val("");
                                    $("#harga_jasa").val("0");
                                    $("#detailkategori_jasa").val("");
                                    $("#qty_jasa").val("0");
                                    // $("#subtotal").val("0");
                                    $("#persen_jasa").val("0");
                                    $("#discount_jasa").val("0");
                                    $('#jenisdetail_jasa').val("");
                                    $('#kodejenisdetail_jasa').val("");
                                    $("#total_jasa").val("0");
                                    $("#totaljasa").val("0");
                                    document.getElementById('detailkategori_jasa').disabled = true;
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

        function cekdoublejasa(kode) {
            var table = document.getElementById('detailjasa');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.replace(/[^\w\s]/gi, '') === kode) {
                    result = false;
                }
            }
            return result;
        }

        $(document).on('keyup', '#qty_jasa', function() {
            var harga_jasa = $('#harga_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty_jasa = $('#qty_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount_jasa = $('#discount_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalharga_jasa = (parseFloat(harga_jasa) * parseFloat(qty_jasa)) - parseFloat(discount_jasa);
            $('#total_jasa').val(formatRupiah(totalharga_jasa.toString(), ''));
            $('#totaljasa').val(formatRupiah(totalharga_jasa.toString(), ''));
        });

        $(document).on('keyup', '#persen_jasa', function() {
            var harga_jasa = $('#harga_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var persen_jasa = $('#persen_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");

            var totaljasa = $('#totaljasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hasildisc = ((parseFloat(persen_jasa) / 100) * parseFloat(totaljasa));
            $('#discount_jasa').val(formatRupiah(hasildisc.toString(), ''));
            var totalakhir = (parseFloat(totaljasa)) - parseFloat(hasildisc);
            $('#total_jasa').val(formatRupiah(totalakhir.toString(), ''));
        });

        $(document).on('keyup', '#discount_jasa', function() {
            var harga_jasa = $('#harga_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount_jasa = $('#discount_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totaljasa = $('#totaljasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hasildisc = ((parseFloat(discount_jasa) / parseFloat(totaljasa)) * 100);
            $('#persen_jasa').val(formatRupiah(Math.round(hasildisc).toString(), ''));
            var totalakhir = (parseFloat(totaljasa) - parseFloat(discount_jasa));
            $('#total_jasa').val(formatRupiah(totalakhir.toString(), ''));
        });

        // ------------------------------------- END TAB JASA -------------------------------------



        // ------------------------------------- TAB OPL -------------------------------------


        function inserttableopl(kode, nama, kategori, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode.replace(/[^\w\s]/gi, '') + '">' +
                '<td style="display:none;">' + kode.replace(/[^\w\s]/gi, '') + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td style="text-align:center" >' + qty + '</td>' +
                '<td style="text-align:right" >' + harga + '</td>' +
                '<td style="text-align:right" >' + persen + '</td>' +
                '<td style="text-align:right" >' + discount + '</td>' +
                '<td style="text-align:right" >' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode.replace(/[^\w\s]/gi, '') + '" class="edit_opl btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildataopl').append(row);
            // $('#bebas').html(row);
            subtotalopl();
            HitungSummaryJasa();
            DPP();
            PPN();
            Grandtotal();
        }

        function subtotalopl() {
            var table = document.getElementById('detailopl');
            var total = 0;
            //console.log(table.rows.length);
            if (table.rows.length == 1) {
                $("#totall_opl").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    // console.log(table.rows[r].cells[c].innerHTML);
                    if (c == 8) {
                        total = total + parseInt((table.rows[r].cells[8].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#totall_opl").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }

        $(document).on('click', '.edit_opl', function() {
            
            $('#detailkategori_opl').prop('disabled', false);

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode_opl = _row.closest("tr").find("td:eq(1)").text();
            var nama_opl = _row.closest("tr").find("td:eq(2)").text();
            var kategori_opl = _row.closest("tr").find("td:eq(3)").text();
            var qty_opl = _row.closest("tr").find("td:eq(4)").text();
            var harga_opl = _row.closest("tr").find("td:eq(5)").text();
            var persen_opl = _row.closest("tr").find("td:eq(6)").text();
            var discount_opl = _row.closest("tr").find("td:eq(7)").text();
            var subtotal_opl = _row.closest("tr").find("td:eq(8)").text();
            var subtotalx = _row.closest("tr").find("td:eq(8)").text();
            $('#kode_opl').val(kode_opl);
            $('#nama_opl').val(nama_opl);
            $('#jenisdetail_opl').val("OPL");
            $('#detailkategori_opl').val(kategori_opl);
            $('#qty_opl').val(qty_opl);
            $('#harga_opl').val(harga_opl);
            $('#persen_opl').val(persen_opl);
            $('#discount_opl').val(discount_opl);
            $('#total_opl').val(subtotal_opl);
            $('#totalx').val(subtotalx);

            // if (jenis == 2 || jenis == 4) {
            //     document.getElementById('qty').disabled = false;
            //     document.getElementById('total').disabled = false;
            // }else{
            //     document.getElementById('qty').disabled = true;
            //     document.getElementById('total').disabled = true;
            // }

            // if (jenis == 4) {
            //     document.getElementById('removeparts').disabled = false;
            // }else{
            //     document.getElementById('removeparts').disabled = true;
            // }

            // document.getElementById('jenis_detail').disabled = true;
            // document.getElementById('nama').disabled = true
            // document.getElementById('kategoridetail').disabled = false;
            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        $(document).on('keyup', '#qty_opl', function() {
            var harga_opl = $('#harga_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty_opl = $('#qty_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hasildisc = parseFloat(qty_opl) * parseFloat(harga_opl);
            var discount_opl = $('#discount_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalharga_opl = (parseFloat(hasildisc) - (parseFloat(discount_opl) * parseFloat(qty_opl)));
            $('#total_opl').val(formatRupiah(Math.round(totalharga_opl).toString(), ''));
        });

        $(document).on('keyup', '#persen_opl', function() {
            var harga_opl = $('#harga_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var persen_opl = $('#persen_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty_opl = $('#qty_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hasildisc = ((parseFloat(persen_opl) / 100) * parseFloat(harga_opl));
            $('#discount_opl').val(formatRupiah(hasildisc.toString(), ''));
            var totalakhir = (parseFloat(harga_opl) - parseFloat(hasildisc)) * parseFloat(qty_opl);
            $('#total_opl').val(formatRupiah(totalakhir.toString(), ''));
        });

        $(document).on('keyup', '#discount_opl', function() {
            var harga_opl = $('#harga_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount_opl = $('#discount_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty_opl = $('#qty_opl').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hasildisc = ((parseFloat(discount_opl) / parseFloat(harga_opl)) * 100);
            $('#persen_opl').val(formatRupiah(Math.round(hasildisc).toString(), ''));
            var totalakhir = (parseFloat(harga_opl) - parseFloat(discount_opl)) * parseInt(qty_opl);
            $('#total_opl').val(formatRupiah(totalakhir.toString(), ''));
        });

        // ---------- ADD DETAIl JASA ---------------------------------------------
        $("#add_detailopl").click(function() {
            var mgrup = $('#mgrup').val();
            var modul = '1';
            if ($('#kode_opl').val() == '' || $('#nama_opl').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih OPL terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#kode_opl').focus();
            } else if (validasidisc(mgrup, modul, $('#persen_opl').val()) == true) {
                $.alert({
                    title: 'Info..',
                    content: 'Discount anda melebihi kapasitas',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#persen_opl').focus();
            } else {

                var jenis = $("#kodejenisdetail_opl").val();
                var kode = $("#kode_opl").val();
                var nama = $("#nama_opl").val();
                var harga = $("#harga_opl").val();
                var qty = $("#qty_opl").val();
                var kategoridetail = $("#detailkategori_opl").val();
                var persen = $("#persen_opl").val();
                var discount = $("#discount_opl").val();
                var total = $("#total_opl").val();

                if (cekdoubleopl(kode.replace(/[^\w\s]/gi, '')) == true) {
                    inserttableopl(kode, nama, kategoridetail, qty, harga, persen, discount, total, find)
                    $("#kode_opl").val("");
                    $("#nama_opl").val("");
                    $("#harga_opl").val("0");
                    $("#detailkategori_opl").val("");
                    $("#qty_opl").val("0");
                    // $("#subtotal").val("0");
                    $("#persen_opl").val("0");
                    $("#discount_opl").val("0");
                    $('#kodejenisdetail_opl').val("");
                    $('#jenisdetail_opl').val("");
                    $("#total_opl").val("0");
                    document.getElementById('detailkategori_opl').disabled = true;
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
                                    $('#' + kode.replace(/[^\w\s]/gi, '')).remove();
                                    inserttableopl(kode, nama, kategoridetail, qty, harga, persen, discount, total, find)
                                    $("#kode_opl").val("");
                                    $("#nama_opl").val("");
                                    $("#harga_opl").val("0");
                                    $("#detailkategori_opl").val("");
                                    $("#qty_opl").val("0");
                                    // $("#subtotal").val("0");
                                    $("#persen_opl").val("0");
                                    $("#discount_opl").val("0");
                                    $('#jenisdetail_opl').val("");
                                    $('#kodejenisdetail_opl').val("");
                                    $("#total_opl").val("0");
                                    document.getElementById('detailkategori_opl').disabled = true;
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

        function cekdoubleopl(kode) {
            var table = document.getElementById('detailopl');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.replace(/[^\w\s]/gi, '') === kode) {
                    result = false;
                }
            }
            return result;
        }

        // ----------------------------------------- END TAB OPL -----------------------------------------




        function DPP() {
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
                    if (c == 8) {
                        dpp_part = dpp_part + parseInt((tablepart.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            for (var r = 1, n = tablejasa.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tablejasa.rows[r].cells.length; c < m; c++) {
                    if (c == 9) {
                        dpp_jasa = dpp_jasa + parseInt((tablejasa.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            for (var r = 1, n = tableopl.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tableopl.rows[r].cells.length; c < m; c++) {
                    if (c == 8) {
                        dpp_opl = dpp_opl + parseInt((tableopl.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            var dpp = parseInt(dpp_part) + parseInt(dpp_jasa) + parseInt(dpp_opl);
            $("#dpp").val(formatRupiah(dpp.toString(), ''));
        }

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
        }

        function Grandtotal() {
            var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ppn = $('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseInt($('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "")) + parseInt($('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#grandtotal').val(formatRupiah(total.toString(), ''));
        }




        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('faktur/faktur/GetDataTipe'); ?>",
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
                url: "<?php echo base_url('faktur/faktur/GetDataProduct'); ?>",
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
                url: "<?php echo base_url('faktur/faktur/GetDataCustomer'); ?>",
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

        function validasidisc(mgrup, modul, persen) {
            var result = false;
            $.ajax({
                url: "<?php echo base_url('faktur/faktur/CekDisc'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    mgrup: mgrup,
                    modul: modul,
                    persen: persen
                },
                success: function(data) {
                    result = data.error;
                }
            });
            return result;
        }



        function TurnDisable() {
            document.getElementById('cancel').disabled = false;
            document.getElementById('save').disabled = true;
            document.getElementById('carispk').disabled = true;
            document.getElementById('billto').disabled = true;
            document.getElementById('discount_part').disabled = true;
            document.getElementById('discount_jasa').disabled = true;
            document.getElementById('discount_opl').disabled = true;
            document.getElementById('persen_part').disabled = true;
            document.getElementById('persen_opl').disabled = true;
            document.getElementById('persen_jasa').disabled = true;
            document.getElementById('add_detailpart').disabled = true;
            document.getElementById('add_detailjasa').disabled = true;
            document.getElementById('add_detailopl').disabled = true;
            document.getElementById('caritask').disabled = true;
        };


        function ambildatadetailpart() {
            var table = document.getElementById('detailsparepart');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";

                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
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
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";

                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
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
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";

                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
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
            var datadetailpart = ambildatadetailpart();
            var datadetailjasa = ambildatadetailjasa();
            var datadetailopl = ambildatadetailopl();
            var nomor = $('#nomor').val();
            var nopolisi = $('#nopolisi').val();
            var nomorspk = $('#nomorspk').val();
            var nomor_customer = $('#nocustomer').val();
            var tanggal = $('#tanggal').val();
            var keterangan = $('#keterangan').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var kode_teknisi = $('#kode_teknisi').val();
            var kodecabang = $('#scabang').val();
            var uangmuka = $('#uangmuka').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var tgljttempo = $('#tgljttempo').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('faktur/faktur/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nopolisi: nopolisi,
                        nomorspk: nomorspk,
                        nomor_customer: nomor_customer,
                        tanggal: tanggal,
                        keterangan: keterangan,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        kode_teknisi: kode_teknisi,
                        kodecabang: kodecabang,
                        uangmuka: uangmuka,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        tgljttempo: tgljttempo,
                        detailpart: datadetailpart,
                        detailjasa: datadetailjasa,
                        detailopl: datadetailopl,
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
                            TurnDisable();
                            $('#nomor').val(data.nomor);
                            window.open(
                                "<?php echo base_url('form/form/cetak_faktur/') ?>" + data.nomor
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
            BersihkanLayarBaru();
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
                    "url": "<?php echo base_url('faktur/faktur/CariDataFaktur'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_faktur",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_spk: "nomor_spk",
                            nomor_customer: "nomor_customer"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_spk: "nomor_spk",
                            nomor_customer: "nomor_customer"
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
                url: "<?php echo base_url('faktur/faktur/FindFaktur'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#nomorspk').val(data[i].nomor_spk.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        $('#nama_tipe').val(data[i].namatipe.trim());
                        $('#kode_kategori').val(data[i].kategori.trim());
                        $('#nama_kategori').val(data[i].namakategori.trim());
                        $('#nocustomer').val(data[i].nocustomer.trim());
                        $('#namacustomer').val(data[i].nama.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].nama_teknisi.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));

                        if (data[i].returnjob == 'true') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }

                        $('#uangmuka').val(formatRupiah(data[i].nilaiuangmuka.trim().toString(), ''));
                        $('#dpp').val(formatRupiah(data[i].dpp.trim().toString(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim().toString(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim().toString(), ''));

                        FindFakturDetail(data[i].nomor.trim());
                    }
                    TurnDisable();
                }
            }, false);
        });

        function FindFakturDetail(nomor) {
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildataopl').empty();
            $.ajax({
                url: "<?php echo base_url('faktur/faktur/FindFakturDetail'); ?>",
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
                        var kategori = data[i].kategoridetail.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var persen = data[i].persendiscperitem.trim();
                        var discount = formatRupiah(data[i].discperitem.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        if (jenis == '1') {
                            inserttablefindpart(kode_referensi, nama_referensi, kategori, qty, harga, persen, discount, subtotal, "");
                        } else if (jenis == '2' || jenis == '4') {
                            inserttablefindjasa(kode_referensi, nama_referensi, kategori, jenis, qty, harga, persen, discount, subtotal, "");
                        } else if (jenis == '3') {
                            inserttablefindopl(kode_referensi, nama_referensi, kategori, qty, harga, persen, discount, subtotal, "");
                        }
                    }
                }
            });
        };
        // -- END FIND --


        function inserttablefindpart(kode, nama, kategori, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td hidden>' + kode + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td style="text-align:center" >' + qty + '</td>' +
                '<td style="text-align:right" >' + harga + '</td>' +
                '<td style="text-align:right" >' + persen + '</td>' +
                '<td style="text-align:right" >' + discount + '</td>' +
                '<td style="text-align:right" >' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ jenis +'" class="edit btn btn-success" '+find+'><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            subtotalpart();
            HitungTotalParts();
        }

        function inserttablefindjasa(kode, nama, kategori, jenis, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td hidden>' + kode + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td hidden>' + jenis + '</td>' +
                '<td style="text-align:center" >' + qty + '</td>' +
                '<td style="text-align:right" >' + harga + '</td>' +
                '<td style="text-align:right" >' + persen + '</td>' +
                '<td style="text-align:right" >' + discount + '</td>' +
                '<td style="text-align:right" >' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ jenis +'" class="edit btn btn-success" '+find+'><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatajasa').append(row);
            // $('#bebas').html(row);
            subtotaljasa();
            HitungSummaryJasa();
            HitungTotalParts();
        }

        function inserttablefindopl(kode, nama, kategori, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td hidden>' + kode + '</td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td style="text-align:center" >' + qty + '</td>' +
                '<td style="text-align:right" >' + harga + '</td>' +
                '<td style="text-align:right" >' + persen + '</td>' +
                '<td style="text-align:right" >' + discount + '</td>' +
                '<td style="text-align:right" >' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ jenis +'" class="edit btn btn-success" '+find+'><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildataopl').append(row);
            // $('#bebas').html(row);
            subtotalopl();
            HitungSummaryJasa();
            HitungTotalParts();
        }

        function HitungTotalParts() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#summarytotal_sparepart").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[8].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                }
                $("#summarytotal_sparepart").val(formatRupiah(total.toString(), ''));
            }
        }

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
                                url: "<?php echo base_url('faktur/faktur/Cancel'); ?>",
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



        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_faktur/') ?>" + nomor
            );
        });

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("excel").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('export_excel/report/cetak_faktur/') ?>" + nomor
            );
        });


        // function inserttabledisc(kode, nama, jenis, qty, harga, persen, discount, total, find) {

        //     _row.closest("tr").find("td").remove();

        //     _row.closest("tr").find("td:eq(0)").text(kode);
        //     _row.closest("tr").find("td:eq(1)").text(nama);
        //     _row.closest("tr").find("td:eq(2)").text(jenis);
        //     _row.closest("tr").find("td:eq(3)").text(qty);
        //     _row.closest("tr").find("td:eq(4)").text(harga);
        //     _row.closest("tr").find("td:eq(5)").text(persen);
        //     _row.closest("tr").find("td:eq(6)").text(discount);
        //     _row.closest("tr").find("td:eq(7)").text(total);

        //     subtotal();
        //     PPN();
        //     Grandtotal();
        // }

        // function cleardetail() {
        //     $('#detaildatafaktur').empty();
        // }

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table").replace("/", "").replace("/", "").replace("/", "").replace("/", "");
            $('#' + id).remove();
            var table = document.getElementById('detaildatafaktur');
            subtotal();
        });

        // ---------- ON FILTER ------------------------------------
        document.getElementById("jenis_detail").addEventListener("change", function(event) {
            event.preventDefault();

        });
    });
    // });
</script>