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
        $nama_menu = 'Penerimaan Sparepart';

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

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            return day + ' ' + month + ' ' + year;
        }
        var date = new Date(),
            yr = (date.getFullYear().toString()).substring(2, 4),
            mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
            year = date.getFullYear(),
            bulan = date.getMonth() + 1,
            month = getbulan(bulan),
            day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
            newDate = day + ' ' + month + ' ' + year;

        function BersihkanLayar() {
            $('#tanggalinvoice').val(newDate);
            $('#tanggalinv').datepicker({
                format: "dd MM yyyy",
                autoclose: true
            });
            $('#tanggalppn').val(newDate);
            $('#tglppn').datepicker({
                format: "dd MM yyyy",
                autoclose: true
            });
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#nomorinvoice').val("");
            $('#nofakpajak').val("");
            $('#nomorpenerimaan').val("PP" + yr + mt + "00000");
            $('#tanggalpenerimaan').val(newDate);
            $('#nomororder').val("PO" + yr + mt + "00000");
            $('#tanggalorder').val(newDate);
            $('#kodesupplier').val("");
            $('#namasupplier').val("");
            $('#alamat').val("");
            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#hargasatuan').val("0");
            $('#qty').val("0");
            $('#qtyterima').val("0");
            $('#qtygr').val("0");
            $('#persen').val("0");
            $('#discount').val("0");
            $('#total').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#top').val("0");
            $('#grandtotal').val("0");
            $('#nilaiuangmuka').val("0");

            document.getElementById('cancel').disabled = true;
            document.getElementById('cariorder').disabled = false;
            document.getElementById('Invoice').disabled = true;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;

            document.getElementById('cetak').disabled = true;
            document.getElementById('closebo').disabled = true;
            $('#detaildatasparepart').empty();
            loadppnkonfigurasi();
        };
        BersihkanLayar();
        $("#loading").hide();

        document.getElementById("tanggalinv").onchange = function() {
            var nilaippn = loadppnkonfigurasi();
            PPN(nilaippn);
            Grandtotal();
        };
        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#nomororder').val() == '' || $('#namasupplier').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Supplier Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomororder').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };



        function BrowseData() {
            document.getElementById('cancel').disabled = true;
            document.getElementById('cariorder').disabled = true;
            document.getElementById('Invoice').disabled = true;
            document.getElementById('qty').disabled = true;

            document.getElementById('closebo').disabled = false;
            // $('.hapus').prop("disabled", true);
        };

        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('cariorder').disabled = true;
            document.getElementById('qty').disabled = true;
            document.getElementById('qtyterima').disabled = true;
            // document.getElementById('Invoice').disabled = false;

            // document.getElementById('add_detail').disabled = false;
            $('.hapus').prop("disabled", true);
        };

        function statusinvoice(invoice) {
            if (invoice == "t") {
                document.getElementById('Invoice').disabled = true;
                document.getElementById('nomorinvoice').disabled = true;
                document.getElementById('add_detail').disabled = true;
                document.getElementById('persen').disabled = true;
                document.getElementById('discount').disabled = true;
                document.getElementById('hargasatuan').disabled = true;
                document.getElementById('cetak').disabled = false;
            } else {
                document.getElementById('Invoice').disabled = false;
                document.getElementById('nomorinvoice').disabled = false;
                document.getElementById('add_detail').disabled = false;
                document.getElementById('persen').disabled = false;
                document.getElementById('discount').disabled = false;
                document.getElementById('hargasatuan').disabled = false;
                document.getElementById('cetak').disabled = true;
            }
        }

        function DataSparepart(kode, find) {
            var returnValue;
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/getdatasparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (find == true) {
                            returnValue = data[i].nama.trim();
                        } else {
                            $('#namasparepart').val(data[i].nama.trim());
                            // hitungOngkoshari();  
                            returnValue = false;
                        }
                    }
                }
            })
            return returnValue;
        };

        //--browse order detail
        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/finddetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kodepart = data[i].kodepart.trim();
                        var kodepartx = data[i].kodepart.trim().split(' ').join('').replace(/[^\w\s]/gi, '');
                        var namasparepart = DataSparepart(data[i].kodepart.trim(), true);
                        var hargasatuan = data[i].harga.trim();
                        var qty = data[i].qty.trim();
                        var qtygr = data[i].qtygr.trim();
                        var total = formatRupiah(data[i].total.trim().toString(), '');
                        var qtyterima = "0";
                        var persen = "0";
                        var discount = "0";
                        inserttablefind(kodepartx, data[i].kodepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, "", "");
                    }
                }
            });
        };

        function inserttablefind(kodesparepartx, kodesparepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, find, del) {
            var row = "";
            row =
                '<tr id="' + kodesparepartx.split(' ').join('').replace(/[^\w\s]/gi, '') + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + formatRupiah(hargasatuan.toString(), '') + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtygr + '</td>' +
                '<td>' + (qty - qtygr) + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + formatRupiah((hargasatuan * (qty - qtygr)).toString(), '') + '</td>' +
                '<td>' +
                //'<button data-table="'+ kodesparepart +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepartx + '" class="edit btn btn-success"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepartx + '" class="hapus btn btn-danger" ' + del + '><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ kodesparepart +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN(ppnkonfigurasi);
            Grandtotal();
        }

        function inserttable(kodesparepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, find, del) {
            var row = "";
            row =
                '<tr id="' + kodesparepart.split(' ').join('').replace(/[^\w\s]/gi, '') + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + formatRupiah(hargasatuan.toString(), '') + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtygr + '</td>' +
                '<td>' + (qty - qtygr) + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + formatRupiah((hargasatuan * (qty - qtygr)).toString(), '') + '</td>' +
                '<td>' +
                //'<button data-table="'+ kodesparepart +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-success"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-danger" ' + del + '><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ kodesparepart +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN(ppnkonfigurasi);
            Grandtotal();
        }
        //------end here------

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildatasparepart');
            subtotal();
            PPN(ppnkonfigurasi);
            Grandtotal();
        });


        function subtotal() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
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

        function cleardetail() {
            $('#detaildatasparepart').empty();
        }



        // function formatDate(input) {
        //     var datePart = input.match(/\d+/g),
        //     year = datePart[0].substring(0), 
        //     month = datePart[1], day = datePart[2];

        //     return day+'-'+month+'-'+year;
        // }

        function ambildatadetail() {
            var table = document.getElementById('detailsparepart');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";

                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 0) {
                        string = "{" + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML.replace("'", "").replace("'", "").replace('"', "").replace('"', "") + "'";
                    }
                }
                string = string + "}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                console.log(obj);
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
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


        var nominal = document.getElementById('hargasatuan');
        nominal.addEventListener('keyup', function(e) {
            nominal.value = formatRupiah(this.value, '');
        });

        //-----calculate-----//
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };

        $("#hargasatuan").keypress(function(data) {
            return angka(data);
        });

        $('#hargasatuan').keyup(function() {
            var hargasatuan = this.value;
            return HitungTotal3();
        });

        $("#qty").keypress(function(data) {
            return angka(data);
        });

        $("#qty").keyup(function() {
            var qty = this.value;
            return HitungTotal();
        });

        $("#discount").keypress(function(data) {
            return angka(data);
        });

        $('#discount').keyup(function() {
            var discount = this.value;
            return HitungTotal4();
        });

        var disc = document.getElementById('discount');
        disc.addEventListener('keyup', function(e) {
            disc.value = formatRupiah(this.value, '');
        });

        $("#qtyterima").keypress(function(data) {
            return angka(data);
        });

        $("#qtyterima").keyup(function() {
            var qtyterima = this.value;
            return HitungTotal2();
        });

        $("#persen").keypress(function(data) {
            return angka(data);
        });

        $("#persen").keyup(function() {
            var persen = this.value;
            return HitungTotal3();
        });

        function HitungTotal() {
            var qty = $('#qty').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            var totalx = Math.round(total);
            $('#total').val(totalx.toString());
        }

        function HitungTotal2() {
            var qtyterima = $('#qtyterima').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = (parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) - parseFloat(discount.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            var totalx = Math.round(total);
            $('#total').val(formatRupiah(totalx.toString(), ''));
            //$('#total').val(total.toString());
        }

        function HitungTotal3() {
            var persen = $('#persen').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = (parseFloat(persen.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) / 100;
            var discountx = Math.round(discount);
            $('#discount').val(formatRupiah(discountx.toString(), ''));
            HitungTotal2();
        }

        function HitungTotal4() {
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var persen = (parseFloat(discount) / parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) * 100;
            // var pesenfix = Math.round(persen)/100;
            var pesenfix = persen.toFixed(2);
            $('#persen').val(pesenfix.toString());
            HitungTotal2();
        }
        //-----end here-----//

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
            //ambildatadetail();

            var nomorpenerimaan = $('#nomorpenerimaan').val();
            var tanggalpenerimaan = $('#tanggalpenerimaan').val();
            var tanggalinvoice = $('#tanggalinvoice').val();
            var tanggalppn = $('#tanggalppn').val();
            var nomorinvoice = $('#nomorinvoice').val();
            var nofakpajak = $('#nofakpajak').val();
            var nomororder = $('#nomororder').val();
            var kodesupplier = $('#kodesupplier').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var nilaiuangmuka = $('#nilaiuangmuka').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/penerimaan_sparepart/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomorpenerimaan: nomorpenerimaan,
                        tanggalpenerimaan: tanggalpenerimaan,
                        nomororder: nomororder,
                        kodesupplier: kodesupplier,
                        tanggalinvoice: tanggalinvoice,
                        nomorinvoice: nomorinvoice,
                        nofakpajak: nofakpajak,
                        tanggalppn: tanggalppn,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        kode_cabang: kode_cabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        nilaiuangmuka: nilaiuangmuka,
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
                            $.alert({
                                title: 'Info..',
                                content: 'Pastikan Ubah Harga Master Part Jika Ada Perbedaan Harga!',
                                buttons: {
                                    formSubmit: {
                                        text: 'OK',
                                        btnClass: 'btn-red'
                                    }
                                }
                            });
                            FindData();
                            $('#nomorpenerimaan').val(data.nomor);
                            // window.open(
                            //     "<?php echo base_url('form/form/cetak_penerimaanpart/') ?>" + data.nomor
                            // );
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

        // -- BROWSE ORDER --
        document.getElementById("cariorder").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = false and close = false"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and batal = false and close = false"
            // }

            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and close = false and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and close = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and close = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
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
                    "url": "<?php echo base_url('sparepart/penerimaan_sparepart/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_orderingsparepart",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            namasupplier: "namasupplier",
                            total: "total",
                            keterangan: "keterangan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            namasupplier: "namasupplier",
                            keterangan: "keterangan"
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchokbro", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        supplierdetail(data[i].kodesupplier.trim());
                        $('#nomororder').val(data[i].nomor.trim());
                        $('#tanggalorder').val(formatDate(data[i].tanggal));
                        $('#kodesupplier').val(data[i].kodesupplier.trim());
                        $('#namasupplier').val(data[i].namasupplier.trim());
                        $('#alamat').val(data[i].alamatsupplier.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim(), ''));
                        $('#nilaiuangmuka').val(formatRupiah(data[i].sisaum.trim(), ''));
                        statusinvoice(data[i].invoice);
                        FindDataDetail(data[i].nomor.trim());
                    }
                    BrowseData();
                }
            }, false);
        });
        // -- END browser --

        //----------FIND DATA---------
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayar();
            var kode_cabang = $('#scabang').val();
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
                    "url": "<?php echo base_url('sparepart/penerimaan_sparepart/caridatapenerimaan'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "caridatapenerimaanpart",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            nomororder: "nomororder",
                            invoice: "invoice",
                            noinvoice: "noinvoice",
                            keterangan: "keterangan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nomororder: "nomororder",
                            noinvoice: "noinvoice",
                            keterangan: "keterangan"
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
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/findpenerimaan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorpenerimaan').val(data[i].nomor.trim());
                        $('#tanggalpenerimaan').val(formatDate(data[i].tanggal));
                        $('#kodesupplier').val(data[i].nomorsupplier.trim());
                        supplierdetail(data[i].nomorsupplier.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim(), ''));
                        $('#nomororder').val(data[i].nomororder.trim());
                        $('#nomorinvoice').val(data[i].noinvoice.trim());
                        if (data[i].invoice == 'f') {
                            $('#tanggalppn').val(newDate);
                            $('#tanggalinvoice').val(newDate);
                            findUM(data[i].nomororder.trim());
                        } else {
                            $('#tanggalinvoice').val(formatDate(data[i].tglinvoice.trim()));
                            $('#nilaiuangmuka').val(formatRupiah(data[i].nilaiuangmuka.trim(), ''));
                            $('#tanggalppn').val(formatDate(data[i].tglppn.trim()));
                        }
                        $('#nofakpajak').val(data[i].nofakturpajak.trim());
                        statusinvoice(data[i].invoice);
                        findorder(data[i].nomororder.trim());
                        FindPenerimaanDataDetail(data[i].nomor.trim());

                    }
                    FindData();
                }
            }, false);
        });



        function findorder(nomororder) {
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/getordering'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomororder: nomororder
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#tanggalorder').val(formatDate(data[i].tanggal.trim()));
                    }
                }
            });
        }

        function findUM(nomor) {
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nilaiuangmuka').val(formatRupiah(data[i].sisaum.trim(), ''));
                    }
                }
            });
        }

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
                        $('#namasupplier').val(data[i].nama.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        $('#top').val(data[i].top.trim());
                        $("#pkpsupplier").val(data[i].pkp.trim());
                    }
                }
            });
        }

        //------detail 
        function FindPenerimaanDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/findpenerimaandetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kodepart = data[i].kodepart.trim();
                        var kodepartx = data[i].kodepart.trim().split(' ').join('').replace(/[^\w\s]/gi, '');
                        var namasparepart = DataSparepart(data[i].kodepart.trim(), true);
                        var hargasatuan = data[i].harga.trim();
                        var qty = data[i].qty.trim();
                        var qtygr = "0";
                        var total = formatRupiah(data[i].total.trim().toString(), '');
                        var qtyterima = "0";
                        var persen = data[i].persendiscperitem.trim();
                        var discount = data[i].discountperitem.trim();
                        inserttablefind(kodepartx, data[i].kodepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, "disabled", "disabled");
                    }
                }
            });
        };

        // -- END FIND --


        // -- Cancel --
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomorpenerimaan').val();
            var nomororder = $('#nomororder').val();
            var datadetail = ambildatadetail();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var nilaiuangmuka = $('#nilaiuangmuka').val();
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
                                    url: "<?php echo base_url('sparepart/penerimaan_sparepart/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        nomororder: nomororder,
                                        alasan: alasan,
                                        kode_cabang: kode_cabang,
                                        kodesubcabang: kodesubcabang,
                                        kodecompany: kodecompany,
                                        nilaiuangmuka: nilaiuangmuka,
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
                                                            BersihkanLayar()
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
            }
        });


        //------------ invoice --------------------
        document.getElementById("Invoice").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomorpenerimaan').val();
            var tanggalinvoice = $('#tanggalinvoice').val();
            var tanggalppn = $('#tanggalppn').val();
            var nomorinvoice = $('#nomorinvoice').val();
            var nofakpajak = $('#nofakpajak').val();
            var kodesupplier = $('#kodesupplier').val();
            var kode_cabang = $('#scabang').val();
            var datadetail = ambildatadetail();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var nilaiuangmuka = $('#nilaiuangmuka').val();
            var nomororder = $('#nomororder').val();
            var tanggalpenerimaan = $('#tanggalpenerimaan').val();
            var top = $('#top').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/penerimaan_sparepart/invoice'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        invoice: true,
                        nomor: nomor,
                        tanggalinvoice: tanggalinvoice,
                        nomorinvoice: nomorinvoice,
                        nofakpajak: nofakpajak,
                        tanggalppn: tanggalppn,
                        kodesupplier: kodesupplier,
                        kode_cabang: kode_cabang,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        kodecompany: kodecompany,
                        kodesubcabang: kodesubcabang,
                        nilaiuangmuka: nilaiuangmuka,
                        nomororder: nomororder,
                        top: top,
                        tanggalpenerimaan: tanggalpenerimaan,
                        datadetail: datadetail
                    },
                    // success: function(data) {
                    // statusinvoice("t");
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
                    success: function(data) {
                        if (data.error == false) {
                            statusinvoice("t");
                            $.alert({
                                title: 'Info..',
                                content: data.message,
                                buttons: {
                                    formSubmit: {
                                        text: 'OK',
                                        btnClass: 'btn-red',
                                        action: function() {
                                            $.alert({
                                                title: 'Info..',
                                                content: 'Pastikan Harga Jual dan Harga Beli di master sudah di Update dengan Harga Baru!',
                                                buttons: {
                                                    formSubmit: {
                                                        text: 'OK',
                                                        btnClass: 'btn-red',
                                                        keys: ['enter', 'shift'],
                                                        action: function() {
                                                            window.open(
                                                                "<?php echo base_url('form/form/cetak_penerimaanpart/') ?>" + nomor
                                                            );
                                                        }
                                                    }
                                                }
                                            });
                                        }
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

        // ---------- ADD DETAIL ---------------------------------------------
        $("#add_detail").click(function() {
            var total = parseInt($('#qtyterima').val()) + parseInt($('#qtygr').val());
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
                $('#carisparepart').focus();
                var result = false;
            } else if ($('#qty').val() < total) {
                $.alert({
                    title: 'Info..',
                    content: 'QTY Terima Tidak Boleh lebih besar dari Qty Order',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#qtyterima').focus();
                var result = false;
            } else {

                var kodesparepart = $("#kodesparepart").val();
                var kodesparepartx = $("#kodesparepart").val().split(' ').join('').replace(/[^\w\s]/gi, '');
                var namasparepart = $("#namasparepart").val();
                var hargasatuan = $("#hargasatuan").val();
                var qty = $("#qty").val();
                var qtygr = $("#qtygr").val();
                var qtyterima = $("#qtyterima").val();
                var persen = $("#persen").val();
                var discount = $("#discount").val();
                var total = $("#total").val();

                if (validasiadd() == "sukses") {
                    inserttabledisc(kodesparepartx, kodesparepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, "", "")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $("#hargasatuan").val("0");
                    $("#qty").val("0");
                    $("#qtygr").val("0");
                    $("#qtyterima").val("0");
                    $("#persen").val("0");
                    $("#discount").val("0");
                    $("#total").val("0");
                }
            }
        });

        function inserttabledisc(kodesparepartx, kodesparepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, find, del) {

            _row.closest("tr").find("td").remove();


            var row = "";
            row =
                '<tr id="' + kodesparepartx + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtygr + '</td>' +
                '<td>' + qtyterima + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + total + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepartx + '" class="edit btn btn-danger" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepartx + '" class="hapus btn btn-close" ' + del + '><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ kodesparepart +'" class="edit btn btn-danger"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN(ppnkonfigurasi);
            Grandtotal();
        }


        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kodesparepart = _row.closest("tr").find("td:eq(0)").text();
            var namasparepart = _row.closest("tr").find("td:eq(1)").text();
            var hargasatuan = _row.closest("tr").find("td:eq(2)").text();
            var qty = _row.closest("tr").find("td:eq(3)").text();
            var qtygr = _row.closest("tr").find("td:eq(4)").text();
            var qtyterima = _row.closest("tr").find("td:eq(5)").text();
            var persen = _row.closest("tr").find("td:eq(6)").text();
            var discount = _row.closest("tr").find("td:eq(7)").text();
            var total = _row.closest("tr").find("td:eq(8)").text();
            $('#kodesparepart').val(kodesparepart);
            $('#namasparepart').val(namasparepart);
            $('#hargasatuan').val(hargasatuan);
            $('#qty').val(qty);
            $('#qtygr').val(qtygr);
            $('#qtyterima').val(qtyterima);
            $('#persen').val(persen);
            $('#discount').val(discount);
            $('#total').val(total);

            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        function validasiadd() {
            var kodesparepart = $("#kodesparepart").val();
            var table = document.getElementById('detailsparepart');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 0) {
                        if (table.rows[r].cells[c].innerHTML.split(' ').join('').replace(/[^\w\s]/gi, '') == kodesparepart.split(' ').join('').replace(/[^\w\s]/gi, '')) {

                            $('#' + kodesparepart.split(' ').join('').replace(/[^\w\s]/gi, '')).remove();
                            return "sukses";

                        }
                    }
                }
            }
            return "sukses";
        }

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomorpenerimaan').val();
            window.open(
                "<?php echo base_url('form/form/cetak_penerimaanpart/') ?>" + nomor
            );
        });


        document.getElementById("closebo").addEventListener("click", function(event) {
            event.preventDefault();
            var nomororder = $('#nomororder').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/penerimaan_sparepart/closebo'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomororder: nomororder
                    },
                    success: function(data) {
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
                });
            }
        });

    });
</script>