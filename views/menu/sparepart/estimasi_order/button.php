<script type="text/javascript">
    $(document).ready(function() {
        $('#tablesearchtampil').css('visibility', 'hidden');
        // $('#approve').prop('disabled', true);
        $('#cancel').prop('disabled', true);

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
        $nama_menu = 'Ordering Sparepartxx';

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
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#nomor').val("EO" + yr + mt + "00000");
            $('#tanggalorder').val(newDate);
            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#kurs').val("0");
            $('#biayaberat').val("0");
            $('#totalbea').val("0");
            $('#shipping').val("0");
            $('#totalshipping').val("0");
            $('#qty').val("0");
            $('#hargausd').val("0");
            $('#hargasatuan').val("0");
            $('#hargatotal').val("0");
            $('#hargabeli').val("0");
            $('#hargajual').val("0");
            $('#biayaberatsatuan').val("0");
            $('#beratsatuan').val("0");

            $('#shipsatuan').val("0");
            $('#hargamodal').val("0");
            $('#margin').val("0");
            $('#harganormal').val("0");
            $('#sparemargin').val("0");
            $('#hargajualest').val("0");
            document.getElementById('cancel').disabled = true;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;

            $('#detaildatasparepart').empty();
        };
        BersihkanLayar();
        $("#loading").hide();

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = datePart[1],
                day = datePart[2];
            return day + '-' + month + '-' + year;
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
            if (data.which != 8 && data.which != 0 && (data.which < 48 && data.which != 46 || data.which > 57)) {
                return false;
            }
        };

        $("#kurs").keypress(function(data) {
            return angka(data);
        });

        $("#biayaberat").keypress(function(data) {
            return angka(data);
        });

        $("#shipping").keypress(function(data) {
            return angka(data);
        });

        $("#totalshipping").keypress(function(data) {
            return angka(data);
        });

        $("#qty").keypress(function(data) {
            return angka(data);
        });

        $("#hargausd").keypress(function(data) {
            return angka(data);
        });

        $("#hargasatuan").keypress(function(data) {
            return angka(data);
        });

        $("#hargatotal").keypress(function(data) {
            return angka(data);
        });

        $("#hargabeli").keypress(function(data) {
            return angka(data);
        });

        $("#hargabeli").keypress(function(data) {
            return angka(data);
        });

        $("#hargajual").keypress(function(data) {
            return angka(data);
        });

        $("#beratsatuan").keypress(function(data) {
            return angka(data);
        });

        $("#biayaberatsatuan").keypress(function(data) {
            return angka(data);
        });

        $("#shipsatuan").keypress(function(data) {
            return angka(data);
        });

        $("#hargamodal").keypress(function(data) {
            return angka(data);
        });

        $("#margin").keypress(function(data) {
            return angka(data);
        });

        $("#sparemargin").keypress(function(data) {
            return angka(data);
        });

        $("#kurs").keyup(function() {
            var qty = this.value;
            return HitungKurs();
        });

        $("#shipping").keyup(function() {
            var qty = this.value;
            return HitungShipping();
        });

        $("#hargausd").keyup(function() {
            var qty = this.value;
            return HitungKurs();
        });

        $("#beratsatuan").keyup(function() {
            var qty = this.value;
            return HitungBeratSatuan();
        });

        $("#qty").keyup(function() {
            var qty = this.value;
            return HitungBeratSatuan();
        });


        $("#margin").keyup(function() {
            var qty = this.value;
            return HitungMargin();
        });


        $("#sparemargin").keyup(function() {
            var qty = this.value;
            return HitungSpareMargin();
        });

        var biayaberat = document.getElementById('biayaberat');
        biayaberat.addEventListener('keyup', function(e) {
            biayaberat.value = formatRupiah(this.value, '');
        });

        var nominal = document.getElementById('kurs');
        nominal.addEventListener('keyup', function(e) {
            nominal.value = formatRupiah(this.value, '');
        });


        var totalbea = document.getElementById('totalbea');
        totalbea.addEventListener('keyup', function(e) {
            totalbea.value = formatRupiah(this.value, '');
        });

        function HitungKurs() {
            var kurs = $('#kurs').val();
            var hargausd = $('#hargausd').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty = $('#qty').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = Math.round(parseFloat(hargausd.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(kurs.replace(",", "").replace(",", "").replace(",", "").replace(",", "")));
            $('#hargasatuan').val(formatRupiah(total.toString(), ''));
            var hargatotal = Math.round(parseFloat(total) * parseFloat(qty));
            $('#hargatotal').val(formatRupiah(hargatotal.toString(), ''));
            var shipping = $('#shipping').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalshp = Math.round((parseFloat(kurs.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(shipping.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))));
            $('#totalshipping').val(formatRupiah(totalshp.toString(), ''));
            HitungShipping();
        }

        function HitungShipping() {
            var kurs = $('#kurs').val();
            var shipping = $('#shipping').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = Math.round(parseFloat(kurs.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(shipping.replace(",", "").replace(",", "").replace(",", "").replace(",", "")));
            $('#totalshipping').val(formatRupiah(total.toString(), ''));
            HitungBeratSatuan();

        }

        function HitungBeratSatuan() {
            var beratsatuan = $('#beratsatuan').val();
            var biayaberat = $('#biayaberat').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty = $('#qty').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = Math.round((parseFloat(beratsatuan) * parseFloat(biayaberat)) / parseFloat(qty));
            $('#biayaberatsatuan').val(formatRupiah(total.toString(), ''));
            var totalshipping = $('#totalshipping').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalbea = $('#totalbea').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalship = Math.round((parseFloat(total) / parseFloat(totalbea)) * parseFloat(totalshipping));
            $('#shipsatuan').val(formatRupiah(totalship.toString(), ''));
            HitungTotalJual();
        }

        function HitungTotalJual() {
            var shipsatuan = $('#shipsatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var biayaberatsatuan = $('#biayaberatsatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");

            var hargamodal = Math.round((parseFloat(shipsatuan) + parseFloat(biayaberatsatuan)) + parseFloat(hargasatuan));
            $('#hargamodal').val(formatRupiah(hargamodal.toString(), ''));
            HitungMargin();
        }

        function HitungMargin() {
            var margin = $('#margin').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hargamodal = $('#hargamodal').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");

            var hjnormal = Math.round((parseFloat(hargamodal)) + (parseFloat(hargamodal) * parseFloat(margin) / 100));
            $('#harganormal').val(formatRupiah(hjnormal.toString(), ''));
            HitungSpareMargin();
        }

        function HitungSpareMargin() {
            var sparemargin = $('#sparemargin').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var harganormal = $('#harganormal').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");

            var hjestimasi = Math.round((parseFloat(harganormal)) + (parseFloat(harganormal) * parseFloat(sparemargin) / 100));
            $('#hargajualest').val(formatRupiah(hjestimasi.toString(), ''));

            var nomor = $('#nomor').val();
            HitungUlang(nomor);
        }


        $("#biayaberat").keyup(function() {
            var biayaberat = this.value;
            var nomor = $('#nomor').val();
            return HitungUlang(nomor);
        });


        $("#totalbea").keyup(function() {
            var totalbea = this.value;
            var nomor = $('#nomor').val();
            return HitungUlang(nomor);
        });

        function HitungUlang(nomor) {
            var kurs = $('#kurs').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var biayaberat = $('#biayaberat').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalbea = $('#totalbea').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var shipping = $('#shipping').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalshipping = $('#totalshipping').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            $.ajax({
                url: "<?php echo base_url('sparepart/estimasi_order/finddetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#' + data[i].kodepart.replace("/", "").replace("/", "").replace("/", "").replace("/", "").replace("-", "").replace("-", "").replace("-", "").replace("-", "")).remove();
                        var kodesparepart = data[i].kodepart;
                        var namasparepart = data[i].namapart;
                        var qty = data[i].qty;
                        var hargabeli = data[i].hargabeli;
                        var hargajual = data[i].hargajual;
                        var hargausd = data[i].hargausd;
                        var hargasatuan = parseInt(data[i].hargausd) * parseInt(kurs);
                        var hargatotal = parseInt(hargasatuan) * parseInt(data[i].qty);
                        var beratsatuan = data[i].beratsatuan;
                        var biayaberatsatuan = (parseFloat(beratsatuan) * parseFloat(biayaberat)) / parseFloat(data[i].qty);
                        var shipsatuan = Math.round((parseInt(biayaberatsatuan) / parseInt(totalbea)) * parseInt(totalshipping));
                        var hargamodal = parseInt(hargasatuan) + parseInt(biayaberatsatuan) + parseInt(shipsatuan);
                        var margin = data[i].marginjual;
                        var harganormal = Math.round(parseFloat(hargamodal) + (parseFloat(hargamodal) * parseFloat(data[i].marginjual) / 100));
                        var sparemargin = data[i].sparemargin;
                        var hargajualest = Math.round(parseInt(harganormal) + (parseInt(harganormal) * parseInt(data[i].sparemargin) / 100));
                        inserttable(kodesparepart, namasparepart, qty, hargabeli, hargajual, hargausd, hargasatuan, hargatotal,
                            beratsatuan, biayaberatsatuan, shipsatuan, hargamodal, margin, harganormal, sparemargin, hargajualest, "");
                    }
                }
            });
        };


        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            var table = document.getElementById('detaildatasparepart');
            if ($('#kurs').val() == '' || $('#kurs').val() == '0') {
                $.alert({
                    title: 'Info..',
                    content: 'Kurs Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kurs').focus();
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
                $('#detaildatasparepart').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };


        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('carisparepart').disabled = true;
            document.getElementById('add-row').disabled = true;
            $('.hapus').prop("disabled", true);
        };

        $("#add-row").click(function() {
            if ($('#kodesparepart').val() == '' || $('#namasparepart').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih data Sparepart terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#carisparepart').focus();
            } else if ($('#qty').val() == 0 || $('#qty').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'QTY Tidak Boleh Kosong atau 0',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#qty').focus();
                var result = false;
            } else if ($('#hargausd').val() == 0 || $('#hargausd').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Harga USD Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#hargausd').focus();
                var result = false;
            } else if ($('#beratsatuan').val() == 0 || $('#beratsatuan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Berat satuan Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#beratsatuan').focus();
                var result = false;
            } else {
                var kodesparepart = $("#kodesparepart").val();
                var namasparepart = $("#namasparepart").val();
                var qty = $("#qty").val();
                var hargabeli = $("#hargabeli").val();
                var hargajual = $("#hargajual").val();
                var hargausd = $("#hargausd").val();
                var hargasatuan = $("#hargasatuan").val();
                var hargatotal = $("#hargatotal").val();
                var beratsatuan = $("#beratsatuan").val();
                var biayaberatsatuan = $("#biayaberatsatuan").val();
                var shipsatuan = $("#shipsatuan").val();
                var hargamodal = $("#hargamodal").val();
                var margin = $("#margin").val();
                var harganormal = $("#harganormal").val();
                var sparemargin = $("#sparemargin").val();
                var hargajualest = $("#hargajualest").val();

                if (cekdouble() == true) {
                    $('#' + kodesparepart.replace("/", "").replace("/", "").replace("/", "").replace("/", "").replace("-", "").replace("-", "").replace("-", "").replace("-", "")).remove();
                    inserttable(kodesparepart, namasparepart, qty, hargabeli, hargajual, hargausd, hargasatuan, hargatotal,
                        beratsatuan, biayaberatsatuan, shipsatuan, hargamodal, margin, harganormal, sparemargin, hargajualest, "")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $('#qty').val("0");
                    $('#hargausd').val("0");
                    $('#hargasatuan').val("0");
                    $('#hargatotal').val("0");
                    $('#hargabeli').val("0");
                    $('#hargajual').val("0");
                    $('#biayaberatsatuan').val("0");
                    $('#beratsatuan').val("0");
                    $('#shipsatuan').val("0");
                    $('#hargamodal').val("0");
                    $('#margin').val("0");
                    $('#harganormal').val("0");
                    $('#sparemargin').val("0");
                    $('#hargajualest').val("0");
                } else {
                    $.confirm({
                        title: 'Info !',
                        content: 'Data sudah ada di list, Apakah ingin menggantinya ?',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                action: function(data) {
                                    $('#' + kodesparepart.replace("/", "").replace("/", "").replace("/", "").replace("/", "").replace("-", "").replace("-", "").replace("-", "").replace("-", "")).remove();
                                    inserttable(kodesparepart, namasparepart, qty, hargabeli, hargajual, hargausd, hargasatuan, hargatotal,
                                        beratsatuan, biayaberatsatuan, shipsatuan, hargamodal, margin, harganormal, sparemargin, hargajualest, "")
                                    $("#kodesparepart").val("");
                                    $("#namasparepart").val("");
                                    $('#qty').val("0");
                                    $('#hargausd').val("0");
                                    $('#hargasatuan').val("0");
                                    $('#hargatotal').val("0");
                                    $('#hargabeli').val("0");
                                    $('#hargajual').val("0");
                                    $('#biayaberatsatuan').val("0");
                                    $('#beratsatuan').val("0");
                                    $('#shipsatuan').val("0");
                                    $('#hargamodal').val("0");
                                    $('#margin').val("0");
                                    $('#harganormal').val("0");
                                    $('#sparemargin').val("0");
                                    $('#hargajualest').val("0");
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

        function inserttable(kodesparepart, namasparepart, qty, hargabeli, hargajual, hargausd, hargasatuan, hargatotal,
            beratsatuan, biayaberatsatuan, shipsatuan, hargamodal, margin, harganormal, sparemargin, hargajualest, find) {
            var row = "";
            row =
                '<tr id="' + kodesparepart.replace("/", "").replace("/", "").replace("/", "").replace("/", "").replace("-", "").replace("-", "").replace("-", "").replace("-", "") + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + qty + '</td>' +
                '<td style="text-align:right">' + formatRupiah(hargabeli.toString(), '') + '</td>' +
                '<td style="text-align:right">' + formatRupiah(hargajual.toString(), '') + '</td>' +
                '<td style="text-align:right">' + formatRupiah(hargausd.toString(), '') + '</td>' +
                '<td style="text-align:right">' + formatRupiah(hargasatuan.toString(), '') + '</td>' +
                '<td style="text-align:right">' + formatRupiah(hargatotal.toString(), '') + '</td>' +
                '<td>' + beratsatuan + '</td>' +
                '<td style="text-align:right">' + formatRupiah(biayaberatsatuan.toString(), '') + '</td>' +
                '<td style="text-align:right">' + formatRupiah(shipsatuan.toString(), '') + '</td>' +
                '<td style="text-align:right">' + formatRupiah(hargamodal.toString(), '') + '</td>' +
                '<td>' + margin + '</td>' +
                '<td style="text-align:right">' + formatRupiah(harganormal.toString(), '') + '</td>' +
                '<td>' + sparemargin + '</td>' +
                '<td style="text-align:right">' + formatRupiah(hargajualest.toString(), '') + '</td>' +
                '<td>' +
                // '<button data-table="' + kodesparepart + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                '<button data-table="' + kodesparepart + '" class="edit btn btn-danger"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
        }

        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kodesparepart = _row.closest("tr").find("td:eq(0)").text();
            var namasparepart = _row.closest("tr").find("td:eq(1)").text();
            var qty = _row.closest("tr").find("td:eq(2)").text();
            var hargabeli = _row.closest("tr").find("td:eq(3)").text();
            var hargajual = _row.closest("tr").find("td:eq(4)").text();
            var hargausd = _row.closest("tr").find("td:eq(5)").text();
            var hargasatuan = _row.closest("tr").find("td:eq(6)").text();
            var hargatotal = _row.closest("tr").find("td:eq(7)").text();
            var beratsatuan = _row.closest("tr").find("td:eq(8)").text();
            var biayaberatsatuan = _row.closest("tr").find("td:eq(9)").text();
            var shipsatuan = _row.closest("tr").find("td:eq(10)").text();
            var hargamodal = _row.closest("tr").find("td:eq(11)").text();
            var margin = _row.closest("tr").find("td:eq(12)").text();
            var harganormal = _row.closest("tr").find("td:eq(13)").text();
            var sparemargin = _row.closest("tr").find("td:eq(14)").text();
            var hargajualest = _row.closest("tr").find("td:eq(15)").text();
            $("#kodesparepart").val(kodesparepart);
            $("#namasparepart").val(namasparepart);
            $('#qty').val(qty);
            $('#hargausd').val(hargausd);
            $('#hargasatuan').val(hargasatuan);
            $('#hargatotal').val(hargatotal);
            $('#hargabeli').val(hargabeli);
            $('#hargajual').val(hargajual);
            $('#biayaberatsatuan').val(biayaberatsatuan);
            $('#beratsatuan').val(beratsatuan);
            $('#shipsatuan').val(shipsatuan);
            $('#hargamodal').val(hargamodal);
            $('#margin').val(margin);
            $('#harganormal').val(harganormal);
            $('#sparemargin').val(sparemargin);
            $('#hargajualest').val(hargajualest);

            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        function cekdouble() {
            var kodesparepart = $("#kodesparepart").val().replace("/", "").replace("/", "").replace("/", "").replace("/", "").replace("-", "").replace("-", "").replace("-", "").replace("-", "");
            var table = document.getElementById('detailsparepart');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.replace("/", "").replace("/", "").replace("/", "").replace("/", "").replace("-", "").replace("-", "").replace("-", "").replace("-", "") === kodesparepart) {
                    result = false;
                }
            }
            return result;
        }

        function cleardetail() {
            $('#detaildatasparepart').empty();
        }

        // CARI DATA SPAREPART --------------------------------------------------------------------
        document.getElementById("carisparepart").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchsparepart').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('sparepart/estimasi_order/caridatasparepart'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            qtyakhir: "qtyakhir",
                            kodecabang: "kodecabang",
                            lokasi: "lokasi",
                            keterangan: "keterangan"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            kodecabang: "kodecabang",
                            lokasi: "lokasi"
                        },
                        value: "aktif = true and kodecabang = '" + kode_cabang + "' and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchsparepart", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/estimasi_order/getdatasparepart'); ?>",
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
                        $('#kodesparepart').val(data[i].kode.trim());
                        $('#namasparepart').val(data[i].nama.trim());
                        $('#hargabeli').val(formatRupiah(data[i].hargabeli.trim(), ''));
                        $('#hargajual').val(formatRupiah(data[i].hargajual.trim(), ''));
                        // DataDetail(data[i].kode.trim());
                    }
                }
            });
        });


        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayar();
            location.reload(true);
        });
        // -- END NEW -- 

        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var tanggalorder = $('.tanggalorder').val();
            var kurs = $('#kurs').val();
            var biayaberat = $('#biayaberat').val();
            var totalbea = $('#totalbea').val();
            var shipping = $('#shipping').val();
            var totalshipping = $('#totalshipping').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/estimasi_order/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        tanggalorder: tanggalorder,
                        kurs: kurs,
                        biayaberat: biayaberat,
                        totalbea: totalbea,
                        shipping: shipping,
                        totalshipping: totalshipping,
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
                            FindData();
                            $('#nomor').val(data.nomor);
                            window.open(
                                "<?php echo base_url('form/form/cetak_estimasiorder/') ?>" + data.nomor
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


        function ambildatadetail() {
            // $("#cek").click(function(){
            var table = document.getElementById('detailsparepart');

            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 0) {
                        string = "{" + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(" ", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(" ", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }

                string = string + "}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
                //console.log(arr2);
            }
            return arr2;
        }

        // -- FIND --
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
                    "url": "<?php echo base_url('sparepart/estimasi_order/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_estimasiorder",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor"
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
                url: "<?php echo base_url('sparepart/estimasi_order/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#tanggalorder').val(formatDate(data[i].tanggal));
                        $('#kurs').val(formatRupiah(data[i].kurs.trim(), ''));
                        $('#shipping').val(formatRupiah(data[i].shipping.trim(), ''));
                        $('#totalshipping').val(formatRupiah(data[i].totalshipping.trim(), ''));
                        $('#biayaberat').val(formatRupiah(data[i].biayaberatkg.trim(), ''));
                        $('#totalbea').val(formatRupiah(data[i].totalbeamasuk.trim(), ''));
                        FindDataDetail(data[i].nomor.trim());
                    }
                    FindData();
                }
            }, false);
        });
        // -- END FIND --

        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/estimasi_order/finddetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kodesparepart = data[i].kodepart.trim();
                        var namasparepart = data[i].namapart.trim();
                        var qty = data[i].qty.trim();
                        var hargabeli = data[i].hargabeli.trim();
                        var hargajual = data[i].hargajual.trim();
                        var hargausd = data[i].hargausd.trim();
                        var hargasatuan = data[i].hargasatuan.trim();
                        var hargatotal = data[i].hargatotal.trim();
                        var beratsatuan = data[i].beratsatuan.trim();
                        var biayaberatsatuan = data[i].biayaberat.trim();
                        var shipsatuan = data[i].shippingsatuan.trim();
                        var hargamodal = data[i].hargamodal.trim();
                        var margin = data[i].marginjual.trim();
                        var harganormal = data[i].harganormal.trim();
                        var sparemargin = data[i].sparemargin.trim();
                        var hargajualest = data[i].hargajualest.trim();
                        inserttable(kodesparepart, namasparepart, qty, hargabeli, hargajual, hargausd, hargasatuan, hargatotal,
                            beratsatuan, biayaberatsatuan, shipsatuan, hargamodal, margin, harganormal, sparemargin, hargajualest, "");
                    }
                }
            });
        };

        // -- Cancel --
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
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
                                    url: "<?php echo base_url('sparepart/estimasi_order/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
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
            }
        });

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_estimasiorder/') ?>" + nomor
            );
        });

        // ---------- ON BUTTON UPDATE ---------------------------------------------
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var kurs = $('#kurs').val();
            var biayaberat = $('#biayaberat').val();
            var totalbea = $('#totalbea').val();
            var shipping = $('#shipping').val();
            var totalshipping = $('#totalshipping').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/estimasi_order/update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        kurs: kurs,
                        biayaberat: biayaberat,
                        totalbea: totalbea,
                        shipping: shipping,
                        totalshipping: totalshipping,
                        datadetail: datadetail
                    },
                    beforeSend: function(data) {
                        $("#loading").show();
                        $("#update").hide();
                    },
                    complete: function(data) {
                        $("#loading").hide();
                        $("#update").show();
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

    });
</script>