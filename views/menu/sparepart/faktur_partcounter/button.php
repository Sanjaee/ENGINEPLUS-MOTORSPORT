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
        $nama_menu = 'Faktur Part Counter';

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
            $('#nomor').val("CF-" + kode_cabang + "-" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#nopolisi').val("");
            $('#nomororder').val("");
            $('#notlp').val("");
            $("#nocustomer").val("");
            $("#namacustomer").val("");
            $('#nohp').val("");
            $('#alamat').val("");
            $('#kode').val("");
            $('#nama').val("");
            $('#qty').val("0");
            $('#harga').val("0");
            $('#total').val("0");
            $('#grandtotal').val("0");
            $('#persen').val("0");
            $('#discount').val("0");
            $('#keterangan').val("");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#uangmuka').val("0");
            $('#ongkir').val("0");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);
            $('#detaildatafaktur').empty();

            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('ongkir').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('cariorder').disabled = false;
            loadppnkonfigurasi();
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');



        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            var table = document.getElementById('detaildatafaktur');
            if ($('#nomororder').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nomor Order Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#cariorder').focus();
                var result = false;
            } else if (table.rows.length == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Data Detail Tidak Boleh Kosong!',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#detaildatafaktur').focus();
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
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };
        $('#qty').on('change', function() {
            var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty = $('#qty').val();

            var hitungsubtotal = parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            //$('#subtotal').val(formatRupiah(hitungsubtotal.toString(),''));
            $('#total').val(formatRupiah(hitungsubtotal.toString(), ''));
        });

        $("#persen").keypress(function(data) {
            return angka(data);
        });

        $("#ongkir").keypress(function(data) {
            return angka(data);
        });

        $('#persen').keyup(function() {
            var persen = this.value;
            return HitungTotal3();
        });

        $("#discount").keypress(function(data) {
            return angka(data);
        });

        $('#discount').keyup(function() {
            var discount = this.value;
            return HitungTotal4();
        });

        $('#ongkir').keyup(function() {
            var ongkir = this.value;
            return HitungOngkir();
        });

        function HitungTotal2() {
            var qtyterima = $('#qty').val();
            var hargasatuan = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = (parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) - parseFloat(discount.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total').val(formatRupiah(total.toString(), ''));
            //$('#total').val(total.toString());
        }

        function HitungTotal3() {
            var persen = $('#persen').val();
            var hargasatuan = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = (parseFloat(persen.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) / 100;
            $('#discount').val(formatRupiah(discount.toString(), ''));
            HitungTotal2();
        }

        function HitungTotal4() {
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qtyterima = $('#qty').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hargasatuan = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var persen = ((parseFloat(discount) * parseFloat(qtyterima)) / (parseFloat(hargasatuan) * parseFloat(qtyterima))) * 100;
            // var pesenfix = Math.round(persen)/100;
            var pesenfix = persen.toFixed(2);
            $('#persen').val(pesenfix.toString());
            HitungTotal2();
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

        function HitungOngkir() {
            var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ppn = $('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ongkir = $('#ongkir').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseInt(dpp) + parseInt(ppn) + parseInt(ongkir);
            $('#grandtotal').val(formatRupiah(total.toString(), ''));
            $('#ongkir').val(formatRupiah(ongkir.toString(), ''));
        }

        function Grandtotal() {
            var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ppn = $('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ongkir = $('#ongkir').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseInt(dpp) + parseInt(ppn) + parseInt(ongkir);
            $('#grandtotal').val(formatRupiah(total.toString(), ''));
        }

        function subtotal() {
            var table = document.getElementById('detailfaktur');
            var total = 0;
            //console.log(table.rows.length);
            if (table.rows.length == 1) {
                $("#dpp").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {

                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    //console.log('NGENTOT');
                    if (c == 7) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#dpp").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
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

                    // console.log(table.rows[r].cells[c].innerHTML);
                    if (c == 7) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#dpp").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }

        // ---------- FIND ON LOOKUP ORDER ----------------------------------
        document.getElementById("cariorder").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //         values = "batal = false and statusfaktur = false"
            //     } else {
            //         values = "batal = false and statusfaktur = false and kode_cabang = '" + kode_cabang + "'"
            //     }
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and statusfaktur = false and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and statusfaktur = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and statusfaktur = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchorder').DataTable({
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
                    "url": "<?php echo base_url('sparepart/faktur_partcounter/CariDataOrder'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_partcounterorder",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer",
                            nohp: "nohp",
                            notelp: "notelp"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer",
                            nohp: "nohp",
                            notelp: "notelp"
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchorder", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/faktur_partcounter/GetDataOrder'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomororder').val(data[i].nomor.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].nama_customer.trim());
                        $('#alamat').val(data[i].alamat_customer.trim());
                        $('#nohp').val(data[i].nohp.trim());
                        $('#notlp').val(data[i].notelp.trim());
                        $('#uangmuka').val(formatRupiah(data[i].nilaiuangmuka.trim().toString(), ''));
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#ongkir').val(formatRupiah(data[i].ongkir.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim(), ''));
                        CariDataDetail(data[i].nomor.trim());
                    }
                }
            }, false);
        });

        function CariDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/faktur_partcounter/GetDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode = data[i].kode_parts.trim();
                        var nama = data[i].nama.trim();
                        var jenisdetail = data[i].jenisdetail.trim();
                        var qty = data[i].qty.trim();
                        // var harga = formatRupiah(data[i].hargajual.trim().toString(), '');
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        // var harga = DataSparepart(data[i].kode_parts.trim(), true);
                        var persen = data[i].persendiscperitem.trim();;
                        var discount = formatRupiah(data[i].discountperitem.trim().toString(), '');;
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        inserttableorder(kode, nama, jenisdetail, qty, harga, persen, discount, subtotal, "");

                    };
                }
            });
            $.alert({
                title: 'Info..',
                content: 'Pastikan Harga Master Part Sesuai Jika Ada Perbedaan Harga!',
                buttons: {
                    formSubmit: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                }
            });
        };

        function DataSparepart(kode, find) {
            var returnValue;
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/getdatasparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    kode: kode,
                    kode_cabang: kode_cabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (find == true) {
                            returnValue = formatRupiah(data[i].hargajual.trim().toString(), '');
                        } else {
                            $('#harga').val(data[i].hargajual.trim());
                            returnValue = false;
                        }
                    }
                }
            })
            return returnValue;
        };

        function inserttableorder(kode, nama, jenisdetail, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenisdetail + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + subtotal + '</td>' +
                // '<td>' + formatRupiah((harga.replace(",", "").replace(",", "").replace(",", "") * qty).toString(),'') + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode + '" class="edit btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatafaktur').append(row);
            // $('#bebas').html(row);
            // subtotalb();
            // PPN();
            // Grandtotal();
        }

        // ---------- ADD DETAIl ---------------------------------------------
        $("#add_detail").click(function() {
            var mgrup = $('#mgrup').val();
            var modul = '2';
            if ($('#kode').val() == '' || $('#nama').val() == '') {
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
                $('#kode').focus();
            } else if (validasidisc(mgrup, modul, $('#persen').val()) == true) {
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
                $('#persen').focus();
            } else if ($('#jenisdetail').val() == '' || $('#jenisdetail').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Jenis Detail Part Tidak Boleh Kosong!',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenisdetail').focus();
                var result = false;
            } else {

                var kode = $("#kode").val();
                var nama = $("#nama").val();
                var jenisdetail = $("#jenisdetail").val();
                var harga = $("#harga").val();
                var qty = $("#qty").val();
                var persen = $("#persen").val();
                var discount = $("#discount").val();
                var total = $("#total").val();


                inserttabledisc(kode, nama, jenisdetail, qty, harga, persen, discount, total, find)
                $("#kode").val("");
                $("#nama").val("");
                $("#harga").val("0");
                $("#qty").val("0");
                $("#subtotal").val("0");
                $("#persen").val("0");
                $("#discount").val("0");
                $('#jenisdetail').val("-");
                $("#total").val("0");
            }
        });

        function inserttabledisc(kode, nama, jenisdetail, qty, harga, persen, discount, total, find) {

            //_row.closest("tr").find("td").remove();

            _row.closest("tr").find("td:eq(0)").text(kode);
            _row.closest("tr").find("td:eq(1)").text(nama);
            _row.closest("tr").find("td:eq(2)").text(jenisdetail);
            _row.closest("tr").find("td:eq(3)").text(qty);
            _row.closest("tr").find("td:eq(4)").text(harga);
            _row.closest("tr").find("td:eq(5)").text(persen);
            _row.closest("tr").find("td:eq(6)").text(discount);
            _row.closest("tr").find("td:eq(7)").text(total);

            subtotal();
            PPN();
            Grandtotal();
        }

        function inserttable(kode, nama, jenisdetail, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenisdetail + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode + '" class="edit btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatafaktur').append(row);
            // $('#bebas').html(row);
            subtotalb();
            PPN();
            Grandtotal();
        }

        function inserttablefind(kode, nama, jenisdetail, qty, harga, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenisdetail + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + subtotal + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ jenis +'" class="edit btn btn-success" '+find+'><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatafaktur').append(row);
            // $('#bebas').html(row);
            // subtotalb();
            // PPN();
            // Grandtotal();
        }

        function validasidisc(mgrup, modul, persen) {
            var result = false;
            $.ajax({
                url: "<?php echo base_url('sparepart/faktur_partcounter/CekDisc'); ?>",
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

        function cleardetail() {
            $('#detaildatafaktur').empty();
        }

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildatafaktur');
            subtotal();
        });

        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode = _row.closest("tr").find("td:eq(0)").text();
            var nama = _row.closest("tr").find("td:eq(1)").text();
            var jenisdetail = _row.closest("tr").find("td:eq(2)").text();
            var qty = _row.closest("tr").find("td:eq(3)").text();
            var harga = _row.closest("tr").find("td:eq(4)").text();
            var persen = _row.closest("tr").find("td:eq(5)").text();
            var discount = _row.closest("tr").find("td:eq(6)").text();
            var subtotal = _row.closest("tr").find("td:eq(7)").text();
            $('#kode').val(kode);
            $('#nama').val(nama);
            $('#jenisdetail').val(jenisdetail);
            $('#qty').val(qty);
            $('#harga').val(harga);
            $('#persen').val(persen);
            $('#discount').val(discount);
            $('#total').val(subtotal);

            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

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
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }

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
                    "url": "<?php echo base_url('sparepart/faktur_partcounter/CariDataFaktur'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_partcounterfaktur",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_order: "nomor_order",
                            nama_customer: "nama_customer"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_order: "nomor_order",
                            nama_customer: "nama_customer"
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
                url: "<?php echo base_url('sparepart/faktur_partcounter/FindFaktur'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nomororder').val(data[i].nomor_order.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].nama_customer.trim());
                        $('#alamat').val(data[i].alamat_customer.trim());
                        $('#nohp').val(data[i].nohp.trim());
                        $('#notlp').val(data[i].notelp.trim());
                        $('#uangmuka').val(formatRupiah(data[i].nilaiuangmuka.trim().toString(), ''));
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#dpp').val(formatRupiah(data[i].dpp.trim().toString(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim().toString(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim().toString(), ''));
                        $('#ongkir').val(formatRupiah(data[i].ongkir.trim().toString(), ''));

                        FindFakturDetail(data[i].nomor.trim());
                    }
                    TurnDisable();
                }
            }, false);
        });

        function FindFakturDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/faktur_partcounter/FindFakturDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode_referensi = data[i].kode_parts.trim();
                        var nama_referensi = data[i].nama.trim();
                        var jenisdetail = data[i].jenisdetail.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var persen = data[i].persendiscperitem.trim();
                        var discount = formatRupiah(data[i].discountperitem.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        inserttablefind(kode_referensi, nama_referensi, jenisdetail, qty, harga, persen, discount, subtotal, "");
                    }
                }
            });
        };
        // -- END FIND --

        // ---------- ON BUTTON CANCEL ---------------------------------------------
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var nomororder = $('#nomororder').val();
            var datadetail = ambildatadetail();
            var kodecabang = $('#scabang').val();

            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
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
                                url: "<?php echo base_url('sparepart/faktur_partcounter/Cancel'); ?>",
                                method: "POST",
                                dataType: "json",
                                async: true,
                                data: {
                                    nomor: nomor,
                                    nomororder: nomororder,
                                    kodecabang: kodecabang,
                                    alasan: alasan,
                                    kodesubcabang: kodesubcabang,
                                    kodecompany: kodecompany,
                                    datadetail: datadetail
                                },
                                beforeSend: function(data) {
                                    $("#loading").show();
                                    $("#cancel").hide();
                                },
                                complete: function(data) {
                                    $("#loading").hide();
                                    $("#cancel").show();
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
                                },
                                error: function() {
                                    $.alert({
                                        title: 'Info..',
                                        content: 'Data gagal dibatalkan!',
                                        buttons: {
                                            formSubmit: {
                                                text: 'ok',
                                                btnClass: 'btn-red'
                                            }
                                        }
                                    });
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
            BersihkanLayarBaru();
            location.reload(true);
        });
        //------------- Turn Disable -------------------
        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            document.getElementById('ongkir').disabled = true;
            document.getElementById('cariorder').disabled = true;
        };

        function TurnDisable() {
            document.getElementById('cancel').disabled = false;
            document.getElementById('save').disabled = true;
            document.getElementById('cariorder').disabled = true;
            document.getElementById('ongkir').disabled = true;
        };
        // ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var nopolisi = $('#nopolisi').val();
            var nomororder = $('#nomororder').val();
            var nomor_customer = $('#nocustomer').val();
            var namacustomer = $('#namacustomer').val();
            var tanggal = $('#tanggal').val();
            var alamat = $('#alamat').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var notlp = $('#notlp').val();
            var nohp = $('#nohp').val();
            var kodecabang = $('#scabang').val();
            var uangmuka = $('#uangmuka').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var ongkir = $('#ongkir').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/faktur_partcounter/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nopolisi: nopolisi,
                        nomororder: nomororder,
                        nomor_customer: nomor_customer,
                        namacustomer: namacustomer,
                        tanggal: tanggal,
                        alamat: alamat,
                        notlp: notlp,
                        nohp: nohp,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        kodecabang: kodecabang,
                        uangmuka: uangmuka,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        ongkir: ongkir,
                        detailfaktur: datadetail
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
                                "<?php echo base_url('form/form/cetak_fakturpartcounter/') ?>" + data.nomor
                            );
                            window.open(
                                "<?php echo base_url('form/form/cetak_fakturpartcountergudang/') ?>" + data.nomor
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


    });

    function TurnDisable() {
        document.getElementById('cancel').disabled = false;
    };
    // ---------- ON BUTTON CETAK ---------------------------------------------
    document.getElementById("cetak").addEventListener("click", function(event) {
        var nomor = $('#nomor').val();
        window.open(
            "<?php echo base_url('form/form/cetak_fakturpartcounter/') ?>" + nomor
        );
    });

    // ---------- ON BUTTON CETAK ---------------------------------------------
    document.getElementById("excel").addEventListener("click", function(event) {
        var nomor = $('#nomor').val();
        window.open(
            "<?php echo base_url('export_excel/report/cetak_fakturpartcounter/') ?>" + nomor
        );
    });

    
    document.getElementById("cetakgd").addEventListener("click", function(event) {
        var nomor = $('#nomor').val();
        window.open(
            "<?php echo base_url('form/form/cetak_fakturpartcountergudang/') ?>" + nomor
        );
    });

    // });
</script>