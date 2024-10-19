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
        $nama_menu = 'Retur Penerimaan Sparepart';

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

        // ------------ SET PPN --------------------
        <?php
            $setppn = $this->session->userdata('setppn');
        ?>
        var getppn =  "<?php echo $setppn ?>";
        var ppnkonfigurasi = 0;

        function loadppnkonfigurasi() {
            $.ajax({
                url: "<?php echo base_url('masterdata/konfigurasi/konfigurasippn');  ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    tanggal: $('#tanggalorder').val()
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        ppnkonfigurasi = data[i].nilaippn.trim();
                    }
                }
            }, false);
        }
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
            $('#noretur').val("PR" + yr + mt + "00000");
            $('#tglretur').val(newDate);
            $('#nomorpenerimaan').val("PP" + yr + mt + "00000");
            $('#tanggalpenerimaan').val(newDate);
            $('#nomorinvoice').val("");
            $('#tglinvoice').val(newDate);
            $('#tglppn').val(newDate);
            $('#nofakpajak').val("");
            $('#kodesupplier').val("");
            $('#namasupplier').val("");
            $('#alamat').val("");
            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#hargasatuan').val("0");
            $('#qty').val("0");
            $('#qtyterima').val("0");
            $('#persen').val("0");
            $('#discount').val("0");
            $('#total').val("0");
            $('#biayapinalti').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#grandtotal').val("0");
            $("#biayapinalti").val("0");
            $("#qtyretur").val("0");
            $("#totalpinalti").val("0");
            $("#keterangan").val("");
            

            document.getElementById('cancel').disabled = true;
            document.getElementById('caripenerimaan').disabled = false;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('qty').disabled = false;
            document.getElementById('keterangan').disabled = false;
            document.getElementById('biayapinalti').disabled = false;

            $('#detaildatasparepart').empty();
            loadppnkonfigurasi();
        };
        BersihkanLayar();
        $("#loading").hide();

        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#nomorpenerimaan').val() == '' || $('#namasupplier').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Penerimaan Sparepart nya Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomorpenerimaan').focus();
                var result = false;
            } else if ($('#keterangan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Silakan isi keterangan retur',
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



        function BrowseData() {
            document.getElementById('cancel').disabled = true;
            document.getElementById('caripenerimaan').disabled = true;
            document.getElementById('qty').disabled = false;
            $('.hapus').prop("disabled", false);
        };

        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('caripenerimaan').disabled = true;
            document.getElementById('qty').disabled = true;
            document.getElementById('keterangan').disabled = true;
            document.getElementById('biayapinalti').disabled = true;
            $('.hapus').prop("disabled", true);
        };

        function DataSparepart(kode, find) {
            var returnValue;
            $.ajax({
                url: "<?php echo base_url('sparepart/returpenerimaan_sparepart/getdatasparepart'); ?>",
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

        //--browse retur penerimaan detail
        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/returpenerimaan_sparepart/finddetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kodepart = data[i].kodepart.trim();
                        var namasparepart = DataSparepart(data[i].kodepart.trim(), true);
                        var hargasatuan = data[i].harga.trim();
                        var qtyterima = data[i].qtyterima.trim();
                        var qtyretur = data[i].qtyretur.trim();
                        var qty = data[i].qtyretur.trim();
                        var persen = data[i].persendiscperitem.trim();
                        var discount = data[i].discountperitem.trim();
                        var total = formatRupiah(data[i].total.trim().toString(), '');
                        var biayapenalti = formatRupiah(data[i].biayapenalti.trim().toString(), '');
                        inserttablefind(data[i].kodepart, namasparepart, hargasatuan, qtyterima, qty, qtyretur, persen, discount, total, biayapenalti, "disabled", "disabled");
                    }
                }
            });
        };

        function inserttablefind(kodesparepart, namasparepart, hargasatuan, qtyterima, qty, qtyretur, persen, discount, total, biayapenalti, find, del) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + formatRupiah(hargasatuan.toString(), '') + '</td>' +
                '<td>' + qtyterima + '</td>' +
                '<td>' + qtyretur + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + formatRupiah(total.toString(), '') + '</td>' +
                '<td>' + formatRupiah(biayapenalti.toString(), '') + '</td>' +
                '<td>' +
                //'<button data-table="'+ kodesparepart +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-danger" ' + del + '><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ kodesparepart +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            // totalbiaya();
            // subtotal();
            // PPN();
            // Grandtotal();
        }
        //------end here------

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildatasparepart');
            totalbiaya();
            subtotal();
            PPN();
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


        function totalbiaya() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totalpinalti").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 9) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#totalpinalti").val(formatRupiah(total.toString(), ''));

                    }
                }
            }
        }

        function PPN() {
            var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var totalpinalti = $('#totalpinalti').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var dpp2 = parseInt(dpp) - parseInt(totalpinalti)
            $('#dpp').val(formatRupiah(dpp2.toString(), ''));
            
            if (getppn == '1' ){
                // var hitungppn = (parseFloat(dpp2) * 10) / 100;
                var hitungppn = (parseFloat(dpp2) * parseFloat(ppnkonfigurasi)) / 100;
                var roundppn = Math.round(hitungppn);
                $('#ppn').val(formatRupiah(roundppn.toString(), ''));
            }else{
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

        //-----calculate-----//
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };

        $("#qty").keypress(function(data) {
            return angka(data);
        });

        $("#qty").keyup(function() {
            var qty = this.value;
            return HitungTotal();
        });

        $("#biayapinalti").keypress(function(data) {
            return angka(data);
        });

        $("#biayapinalti").keyup(function() {
            var qtyterima = this.value;
            // return HitungTotal2();
        });


        function HitungTotal() {
            var qty = $('#qty').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = $('#discount').val().replace(",","").replace(",","").replace(",","").replace(",","");
            var total = (parseFloat(hargasatuan.replace(",","").replace(",","").replace(",","").replace(",","")) * parseFloat(qty.replace(",","").replace(",","").replace(",","").replace(",",""))) - parseFloat(discount.replace(",","").replace(",","").replace(",","").replace(",","")) * parseFloat(qty.replace(",","").replace(",","").replace(",","").replace(",",""));
            $('#total').val(formatRupiah(total.toString(), ''));
        }

        //-----end here-----//

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
            var nomor = $('#noretur').val();
            var tglretur = $('#tglretur').val();
            var nomorpenerimaan = $('#nomorpenerimaan').val();
            var tanggalpenerimaan = $('#tanggalpenerimaan').val();
            var tglinvoice = $('#tglinvoice').val();
            var tglppn = $('#tglppn').val();
            var nomorinvoice = $('#nomorinvoice').val();
            var nofakpajak = $('#nofakpajak').val();
            var kodesupplier = $('#kodesupplier').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var totalpinalti = $('#totalpinalti').val();
            var kode_cabang = $('#scabang').val();
            var keterangan = $('#keterangan').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/returpenerimaan_sparepart/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor : nomor,
                        tglretur : tglretur,
                        nomorpenerimaan: nomorpenerimaan,
                        tanggalpenerimaan: tanggalpenerimaan,
                        kodesupplier: kodesupplier,
                        tglinvoice: tglinvoice,
                        nomorinvoice: nomorinvoice,
                        nofakpajak: nofakpajak,
                        tglppn: tglppn,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal : grandtotal,
                        totalpinalti : totalpinalti,
                        kode_cabang: kode_cabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        keterangan : keterangan,
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
                            FindData();
                            $('#noretur').val(data.nomor);
                            window.open(
                                "<?php echo base_url('form/form/cetak_returpart/') ?>" + data.nomor
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

        // -- BROWSE PENERIMAAN --
        document.getElementById("caripenerimaan").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = false and invoice = true"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and batal = false and invoice = true"
            // }

            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and invoice = true and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and invoice = true and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and invoice = true and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchpenerimaan').DataTable({
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
                    "url": "<?php echo base_url('sparepart/returpenerimaan_sparepart/caridatapenerimaan'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_penerimaanpart",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            namasupplier: "namasupplier",
                            noinvoice: "noinvoice"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            namasupplier: "namasupplier",
                            noinvoice: "noinvoice"
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
                url: "<?php echo base_url('sparepart/returpenerimaan_sparepart/getdatapenerimaan'); ?>",
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
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(),''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(),''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim(),''));
                        $('#nomorinvoice').val(data[i].noinvoice.trim());
                        if (data[i].tglinvoice == null) {
                            $('#tglinvoice').val(newDate);
                        } else {
                            $('#tglinvoice').val(formatDate(data[i].tglinvoice.trim()));
                        }
                        if (data[i].tglppn == null) {
                            $('#tglppn').val(newDate);
                        } else {
                            $('#tglppn').val(formatDate(data[i].tglppn.trim()));
                        }
                        $('#nofakpajak').val(data[i].nofakturpajak.trim());
                        GetPenerimaanDataDetail(data[i].nomor.trim());

                    }
                    BrowseData();
                }
            }, false);
        });
        // -- END browser --

        //----------FIND DATA---------
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
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
                values = "batal = false  and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchretur').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('sparepart/returpenerimaan_sparepart/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_returpenerimaansparepart",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            nomorpenerimaan: "nomorpenerimaan",
                            noinvoice: "noinvoice"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nomorpenerimaan: "nomorpenerimaan",
                            noinvoice: "noinvoice"
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
                url: "<?php echo base_url('sparepart/returpenerimaan_sparepart/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#noretur').val(data[i].nomor.trim());
                        $('#tglretur').val(formatDate(data[i].tanggal.trim()));
                        $('#nomorpenerimaan').val(data[i].nomorpenerimaan.trim());
                        $('#tanggalpenerimaan').val(formatDate(data[i].tanggalterima));
                        $('#kodesupplier').val(data[i].nomorsupplier.trim());
                        supplierdetail(data[i].nomorsupplier.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(),''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(),''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim(),''));
                        $('#totalpinalti').val(data[i].totalbiayapenalti.trim());
                        $('#nomorinvoice').val(data[i].noinvoice.trim());
                        if (data[i].tglinvoice == null) {
                            $('#tglinvoice').val(newDate);
                        } else {
                            $('#tglinvoice').val(formatDate(data[i].tglinvoice.trim()));
                        }
                        if (data[i].tglppn == null) {
                            $('#tglppn').val(newDate);
                        } else {
                            $('#tglppn').val(formatDate(data[i].tglppn.trim()));
                        }
                        $('#nofakpajak').val(data[i].nofakpajak.trim());
                        $('#keterangan').val(data[i].alasanretur.trim());
                        FindDataDetail(data[i].nomor.trim());

                    }
                     FindData();
                }
            }, false);
        });

        function supplierdetail(nomorsupplier) {
            $.ajax({
                url: "<?php echo base_url('sparepart/returpenerimaan_sparepart/getdatasupplier'); ?>",
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
                    }
                }
            });
        }

        //------detail 
        function GetPenerimaanDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/returpenerimaan_sparepart/getpenerimaandetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kodepart = data[i].kodepart.trim();
                        var namasparepart = DataSparepart(data[i].kodepart.trim(), true);
                        var hargasatuan = data[i].harga.trim();
                        var qty = "0"
                        var qtyretur = data[i].qtyretur.trim();
                        var total = formatRupiah(data[i].total.trim().toString(), '');
                        var qtyterima = data[i].qty.trim();
                        var persen = data[i].persendiscperitem.trim();
                        var discount = data[i].discountperitem.trim();
                        inserttablecari(data[i].kodepart, namasparepart, hargasatuan, qtyterima, qty, qtyretur, persen, discount, total, "0", "", "");
                    }
                }
            });
        };

        function inserttablecari(kodesparepart, namasparepart, hargasatuan, qtyterima, qty, qtyretur, persen, discount, total, pinalti, find, del) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + formatRupiah(hargasatuan.toString(), '') + '</td>' +
                '<td>' + qtyterima + '</td>' +
                '<td>' + qtyretur + '</td>' +
                '<td>' + (qtyterima - qtyretur) + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + formatRupiah(discount.toString(), '') + '</td>' +
                '<td>' + formatRupiah((((qtyterima - qtyretur) * hargasatuan) - (discount * (qtyterima - qtyretur))).toString(), '') + '</td>' +
                '<td>' + formatRupiah(pinalti.toString(), '') + '</td>' +
                '<td>' +
                //'<button data-table="'+ kodesparepart +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-close" ' + del + '><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ kodesparepart +'" class="edit btn btn-danger"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            // totalbiaya();
            // subtotal();
            // PPN();
            // Grandtotal();
        }

        // -- END FIND --


        // -- Cancel --
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#noretur').val();
            var nomorpenerimaan = $('#nomorpenerimaan').val();
            var datadetail = ambildatadetail();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
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
                                    url: "<?php echo base_url('sparepart/returpenerimaan_sparepart/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        nomorpenerimaan: nomorpenerimaan,
                                        alasan: alasan,
                                        kode_cabang: kode_cabang,
                                        kodesubcabang: kodesubcabang,
                                        kodecompany: kodecompany,   
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


        // ---------- ADD DETAIL ---------------------------------------------
        $("#add_detail").click(function() {
            var total = parseInt($('#qtyterima').val()) - parseInt($('#qtyretur').val());
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
            } else if ($('#qty').val() > total) {
                $.alert({
                    title: 'Info..',
                    content: 'QTY Tidak Boleh lebih besar dari Qty Terima',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#qty').focus();
                var result = false;
            } else {

                var kodesparepart = $("#kodesparepart").val();
                var namasparepart = $("#namasparepart").val();
                var hargasatuan = $("#hargasatuan").val();
                var qty = $("#qty").val();
                var qtyretur = $("#qtyretur").val();
                var qtyterima = $("#qtyterima").val();
                var persen = $("#persen").val();
                var discount = $("#discount").val();
                var total = $("#total").val();
                var pinalti = $("#biayapinalti").val();

                if (validasiadd() == "sukses") {
                    inserttableadd(kodesparepart, namasparepart, hargasatuan, qtyretur, qtyterima, qty, persen, discount, total, pinalti, "", "")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $("#hargasatuan").val("0");
                    $("#qty").val("0");
                    $("#qtygr").val("0");
                    $("#qtyterima").val("0");
                    $("#persen").val("0");
                    $("#discount").val("0");
                    $("#total").val("0");
                    $("#biayapinalti").val("0");
                }
            }
        });

        function inserttableadd(kodesparepart, namasparepart, hargasatuan, qtyretur, qtyterima, qty, persen, discount, total, pinalti, find, del) {

            _row.closest("tr").find("td").remove();


            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + formatRupiah(hargasatuan.toString(), '') + '</td>' +
                '<td>' + qtyterima + '</td>' +
                '<td>' + qtyretur + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + formatRupiah(discount.toString(), '') + '</td>' +
                '<td>' + formatRupiah(total.toString(), '') + '</td>' +
                '<td>' + formatRupiah(pinalti.toString(), '') + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-danger" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-close" ' + del + '><i class="fa fa-times"></i></button>' +
                //'<button data-yes="'+ kodesparepart +'" class="edit btn btn-danger"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            totalbiaya();
            subtotal();
            PPN();
            Grandtotal();
        }


        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kodesparepart = _row.closest("tr").find("td:eq(0)").text();
            var namasparepart = _row.closest("tr").find("td:eq(1)").text();
            var hargasatuan = _row.closest("tr").find("td:eq(2)").text();
            var qtyterima = _row.closest("tr").find("td:eq(3)").text();
            var qtyretur = _row.closest("tr").find("td:eq(4)").text();
            var qty = _row.closest("tr").find("td:eq(5)").text();
            var persen = _row.closest("tr").find("td:eq(6)").text();
            var discount = _row.closest("tr").find("td:eq(7)").text();
            var total = _row.closest("tr").find("td:eq(8)").text();
            var pinalti = _row.closest("tr").find("td:eq(9)").text();
            $('#kodesparepart').val(kodesparepart);
            $('#namasparepart').val(namasparepart);
            $('#hargasatuan').val(hargasatuan);
            $('#qtyterima').val(qtyterima);
            $('#qty').val(qty);
            $('#qtyretur').val(qtyretur);
            $('#persen').val(persen);
            $('#discount').val(discount);
            $('#total').val(total);
            $('#biayapinalti').val(pinalti);

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
                        if (table.rows[r].cells[c].innerHTML == kodesparepart) {

                            $('#' + kodesparepart).remove();
                            return "sukses";

                        }
                    }
                }
            }
            return "sukses";
        }

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#noretur').val();
            window.open(
                "<?php echo base_url('form/form/cetak_returpart/') ?>" + nomor
            );
        });

    });
</script>