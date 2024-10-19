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
        $nama_menu = 'Pembebanan Sparepart';

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

        function BersihkanLayar() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            //var kode_cabang = $('#scabang').val();
            $('#nomor').val("PS" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            $('#nomorspk').val("");
            $('#nopolisi').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#nocustomer').val("");
            $('#namacustomer').val("");
            $('#returnjob').val("");
            $('#keluhan').val("");
            $('#kode_teknisi').val("");
            $('#nama_teknisi').val("");
            $('#grandtotal').val("0");
            $('#hargasatuan').val("0");
            $('#qty').val("0");
            $('#qtystock').val("0");
            $('#total').val("0");
            $('#detaildatafaktur').empty();
            $('#tablesearchtampil').css('visibility', 'hidden');
            document.getElementById('returnjob').disabled = true;
            document.getElementById('total').disabled = true;
            document.getElementById('nonreturnjob').disabled = true;
            var _row = null;

            document.getElementById('save').disabled = false;
            document.getElementById('carispk').disabled = false;
            document.getElementById('cancel').disabled = true;
        };
        BersihkanLayar();
        $("#loading").hide();

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            return day + ' ' + month + ' ' + year;
        }

        //----------------VALIDASI-----------------------------

        function CekValidasi() {
            var table = document.getElementById('detaildatafaktur');
            if ($('#nomorspk').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Silakan pilih data',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carispk').focus();
                var result = false;
            } else if (table.rows.length == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Detail tidak boleh kosong',
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

        //----------------END HERE------------------------------


        // ---------- FIND ON LOOKUP SPK ----------------------------------
        // document.getElementById("carispk").addEventListener("click", function(event) {
        //     event.preventDefault();
        //     var kode_cabang = $('#scabang').val();
        //     //console.log(kode_cabang);
        //     // if (kode_cabang == "HO") {
        //     //     values = "qty > '0'"
        //     // } else {
        //     //     values = "kode_cabang = '" + kode_cabang + "' and qty > '0'"
        //     // }
        //     var kodesubcabang = $('#subcabang').val();
        //     var kodecompany = $('#kodecompany').val();
        //     //console.log(kode_cabang);
        //     // if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
        //     //     values = "qty > '0' and kodecompany = '" + kodecompany + "'"
        //     // } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
        //     //     values = "qty > '0' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
        //     // } else {
        //     //     values = "qty > '0' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
        //     // }
        //     if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
        //         values = "kodecompany = '" + kodecompany + "'"
        //     } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
        //         values = "kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
        //     } else {
        //         values = "kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
        //     }
        //     $('#tablesearchspk').DataTable({
        //         "destroy": true,
        //         "searching": true,
        //         "processing": true,
        //         "serverSide": true,
        //         "lengthChange": false,
        //         "order": [],
        //         "ajax": {
        //             "url": "<?php echo base_url('sparepart/pembebanan_sparepart/CariDataSPK'); ?>",
        //             "method": "POST",
        //             "data": {
        //                 nmtb: "cari_pembebananheader",
        //                 field: {
        //                     nospk: "nospk",
        //                     nopolisi: "nopolisi",
        //                     nama: "nama"
        //                 },
        //                 sort: "nospk",
        //                 where: {
        //                     nospk: "nospk",
        //                     nopolisi: "nopolisi",
        //                     nama: "nama"
        //                 },
        //                 // value:"kode_cabang = '"+kode_cabang+"'"
        //                 value: values
        //             },
        //         }
        //     });
        // }, false);
        document.getElementById("carispk").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = '0' and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and status = '0' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and status = '0' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchspk').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('sparepart/pembebanan_sparepart/CariDataSPK'); ?>",
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

        function DataSPK(nomorspk) {
            $.ajax({
                url: "<?php echo base_url('sparepart/pembebanan_sparepart/GetDataSPK'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomorspk: nomorspk
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorspk').val(data[i].nospk.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        $('#nocustomer').val(data[i].nocustomer.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].nama_teknisi.trim());
                        $('#namacustomer').val(data[i].nama.trim());
                        $('#nama_tipe').val(data[i].namatipe.trim());

                        if (data[i].returnjob == 'true') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }
                        FindSpkDetail(data[i].nospk.trim());
                    }
                }
            });
        };

        function FindSpkDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/pembebanan_sparepart/GetSPKDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode = data[i].kodepart.trim();
                        var nama = data[i].nama.trim();
                        var kategoripart = data[i].kategoripart.trim();
                        var kategoripartdetail = '';
                        var qty = data[i].qty.trim();
                        var qtystock = data[i].stockakhir.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        inserttable(kode, nama, kategoripart, kategoripartdetail, qty, qtystock, harga, subtotal, "", "");
                    }
                }
            });
        };


        // ---------- CALCULATE ---------------------------------------------
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 && data.which != 46 || data.which > 57)) {
                return false;
            }
        };

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



        // ---------- ADD DETAIl ---------------------------------------------
        function inserttable(kode, nama, kategori, kategoridetail, qty, qtystock, harga, subtotal, find, del) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td>' + kategoridetail + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtystock + '</td>' +
                '<td>' + formatRupiah(harga.toString(), '') + '</td>' +
                '<td>' + formatRupiah(subtotal.toString(), '') + '</td>' +
                '<td>' +
                // '<button data-table="'+ kode +'" class="hapus btn btn-danger" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode + '" class="edit btn btn-success" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                '<button data-table="' + kode + '" class="hapus btn btn-danger" ' + del + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ kode +'" class="edit btn btn-success" '+find+'><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatafaktur').append(row);
            // subtotal();  
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

        function subtotal() {
            var table = document.getElementById('detaildatafaktur');
            var total = 0;
            if (table.rows.length == 1) {
                $("#grandtotal").val("0");
            }
            for (var r = 0, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 5) {
                        total = parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#grandtotal").val(formatRupiah(total.toString(), ''));
                    }
                }
            }
        }


        function ambildatadetail() {
            var table = document.getElementById('detailfaktur');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";

                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 0) {
                        string = "{" + table.rows[0].cells[c].innerHTML.replace(" ", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML.replace(" ", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }
                string = string + "}";
                console.log(string);

                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }

        // ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var nomorspk = $('#nomorspk').val();
            var jenis = $("input[name='jenis']:checked").val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            // echo(datadetail);
            //                 die();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/pembebanan_sparepart/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nomorspk: nomorspk,
                        jenis: jenis,
                        kodecabang: kodecabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
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
                            TurnDisableSave();
                            $('#nomor').val(data.nomor);
                            window.open(
                                "<?php echo base_url('form/form/cetak_pembebanan/') ?>" + data.nomor
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
            //     values = "kode_cabang = '" + kode_cabang + "'and batal = false"
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
                    "url": "<?php echo base_url('sparepart/pembebanan_sparepart/CariDataPembebanan'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_pembebanan_sparepart",
                        field: {
                            nomor: "nomor",
                            nomorwo: "nomorwo",
                            nopolisi: "nopolisi",
                            nama: "nama"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nomorwo: "nomorwo",
                            nopolisi: "nopolisi",
                            nama: "nama"
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
                url: "<?php echo base_url('sparepart/pembebanan_sparepart/FindPembebanan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#nomorspk').val(data[i].nomorwo.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        $('#nama_tipe').val(data[i].namatipe.trim());
                        $('#nocustomer').val(data[i].nocustomer.trim());
                        $('#namacustomer').val(data[i].nama.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].nama_teknisi.trim());
                        if (data[i].jenis == 'true') {
                            $('input:radio[name="jenis"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="jenis"][value="false"]').prop('checked', true);
                        }
                        if (data[i].returnjob == 'true') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }

                        FindFakturDetail(data[i].nomor.trim());
                    }
                    TurnDisableSave();
                }
            }, false);
        });

        function FindFakturDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/pembebanan_sparepart/FindPembebananDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode = data[i].kodepart.trim();
                        var nama = data[i].namapart.trim();
                        var kategori = data[i].kategori.trim();
                        var kategoridetail = data[i].kategoridetail.trim();
                        var nama = data[i].namapart.trim();
                        var qty = data[i].qty.trim();
                        var qtystock = '0';
                        var harga = formatRupiah(data[i].hargasatuan.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');;
                        inserttable(kode, nama, kategori, kategoridetail, qty, qtystock, harga, subtotal, "disabled", "disabled");
                    }
                }
            });
        };

        // ----------------------------------- END FIND ----------------------------------------------

        // ---------- ON BUTTON CANCEL ---------------------------------------------
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var nomorspk = $('#nomorspk').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var datadetail = ambildatadetail();
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
                                url: "<?php echo base_url('sparepart/pembebanan_sparepart/Cancel'); ?>",
                                method: "POST",
                                dataType: "json",
                                async: true,
                                data: {
                                    nomor: nomor,
                                    nomorspk: nomorspk,
                                    alasan: alasan,
                                    kodecabang: kodecabang,
                                    kodesubcabang: kodesubcabang,
                                    kodecompany: kodecompany,
                                    detail: datadetail
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
        });
        //------------- Turn Disable -------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayar();
            location.reload(true);
        });
        //------------- Turn Disable -------------------
        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            document.getElementById('carispk').disabled = true;
            document.getElementById('cancel').disabled = false;
        };

        function TurnDisable() {
            document.getElementById('cancel').disabled = false;
        };

        //--------------------History Sparepart---------------------------------------
        document.getElementById("history").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomorspk').val();
            $('#tablesearchhistory').DataTable({
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
                    "url": "<?php echo base_url('sparepart/pembebanan_sparepart/HistoryPembebanan'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "history_pembebanan_sparepart_detail",
                        field: {
                            nomor: "nomor",
                            nomorwo: "nomorwo",
                            kodepart: "kodepart",
                            nama: "nama",
                            qty: "qty"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            kodepart: "kodepart",
                            nama: "nama"
                        },
                        value: "nomorwo = '" + nomor + "'"
                    },
                }
            });
        }, false);


        //-----calculate-----//
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 && data.which != 46 || data.which > 57)) {
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

        function HitungTotal() {
            var qty = $('#qty').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            var totalx = Math.round(total);
            $('#total').val(formatRupiah(totalx.toString(), ''));
        }


        //------edit
        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode = _row.closest("tr").find("td:eq(0)").text();
            var namasparepart = _row.closest("tr").find("td:eq(1)").text();
            var kategori = _row.closest("tr").find("td:eq(2)").text();
            var kategoridetail = _row.closest("tr").find("td:eq(3)").text();
            var qty = _row.closest("tr").find("td:eq(4)").text();
            var qtystock = _row.closest("tr").find("td:eq(5)").text();
            var hargasatuan = _row.closest("tr").find("td:eq(6)").text();
            var total = _row.closest("tr").find("td:eq(7)").text();
            $('#kodesparepart').val(kode);
            $('#namasparepart').val(namasparepart);
            $('#kategori').val(kategori);
            $('#kategoridetail').val(kategoridetail);
            $('#hargasatuan').val(hargasatuan);
            $('#qty').val(qty);
            $('#qtystock').val(qtystock);
            $('#total').val(total);
            if (kode == "PRTX-T" || kode == "BIO-S" || kode == "AVG" || kode == "VP" || kode == "PRTX-TB") {
                document.getElementById('total').disabled = false;
            } else {
                document.getElementById('total').disabled = true;
            }

            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        function validasiadd() {
            var kode = $("#kodesparepart").val();
            var table = document.getElementById('detailfaktur');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 0) {
                        if (table.rows[r].cells[c].innerHTML == kode) {

                            $('#' + kode).remove();
                            return "sukses";

                        }
                    }
                }
            }
            return "sukses";
        }

        // ---------- ADD DETAIL ---------------------------------------------
        $("#add_detail").click(function() {

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
                $('#kodesparepart').focus();
                var result = false;
            } else if ($('#qty').val() == '0' || parseInt($('#qty').val()) > parseInt($('#qtystock').val())) {
                $.alert({
                    title: 'Info..',
                    content: 'QTY Terima Tidak Boleh lebih besar dari 0 atau Melebihi Stock',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#qty').focus();
                var result = false;
            } else if ($('#total').val() == '0' || $('#total').val() == '') {
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
                $('#total').focus();
                var result = false;
            } else if ($('#detailkategori').val() == '' || $('#kategori').val() == '') {
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
                $('#detailkategori').focus();
            } else {

                var kode = $("#kodesparepart").val();
                var nama = $("#namasparepart").val();
                var kategori = $("#kategori").val();
                var kategoridetail = $("#kategoridetail").val();
                var qty = $("#qty").val();
                var qtystock = $("#qtystock").val();
                var hargasatuan = $("#hargasatuan").val();
                var total = $("#total").val();

                if (validasiadd() == "sukses") {
                    inserttableqty(kode, nama, kategori, kategoridetail, qty, qtystock, hargasatuan, total, "", "")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $("#kategori").val("");
                    $("#kategoridetail").val("");
                    $("#qty").val("0");
                    $("#qtystock").val("0");
                    $("#hargasatuan").val("0");
                    $("#total").val("0");
                    document.getElementById('total').disabled = true;
                }
            }
        });

        function inserttableqty(kode, nama, kategori, kategoridetail, qty, qtystock, hargasatuan, total, find, del) {

            //_row.closest("tr").find("td").remove();


            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td>' + kategoridetail + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtystock + '</td>' +
                '<td>' + formatRupiah(hargasatuan.toString(), '') + '</td>' +
                '<td>' + formatRupiah(total.toString(), '') + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kode + '" class="edit btn btn-danger" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-table="' + kode + '" class="hapus btn btn-danger" ' + del + '><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detaildatafaktur').append(row);
            // $('#bebas').html(row);
            subtotal();
            // PPN();
            // Grandtotal();
        }

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_pembebanan/') ?>" + nomor
            );
        });

        //---------------------REFERENSI BATAL---------------------------------------
        document.getElementById("refbatal").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = true"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "'and batal = true"
            // }
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = true and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = true and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = true and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchbatal').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('sparepart/pembebanan_sparepart/CariDataRefbatal'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_referensibatal",
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

        $(document).on('click', ".searchokref", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/pembebanan_sparepart/GetRefBatal'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        //  $('#nomor').val(data[i].nomor.trim());                  
                        $('#nomorspk').val(data[i].nomorwo.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        $('#nama_tipe').val(data[i].namatipe.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].namacustomer.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#kode_teknisi').val(data[i].kode_teknisi.trim());
                        $('#nama_teknisi').val(data[i].namamekanik.trim());
                        if (data[i].jenisservice == 'true') {
                            $('input:radio[name="jenis"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="jenis"][value="false"]').prop('checked', true);
                        }
                        if (data[i].returnjob == 'true') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }

                        FindRefBatalDetail(data[i].nomor.trim());
                    }
                    //TurnDisableSave();
                }
            }, false);
        });

        function FindRefBatalDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/pembebanan_sparepart/FindPembebananDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode = data[i].kodepart.trim();
                        var nama = data[i].namapart.trim();
                        var kategori = data[i].kategori.trim();
                        var kategoridetail = data[i].kategoridetail.trim();
                        var qty = data[i].qty.trim();
                        var qtystock = data[i].stock.trim();
                        var harga = formatRupiah(data[i].hargasatuan.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');;
                        inserttable(kode, nama, kategori, kategoridetail, qty, qtystock, harga, subtotal, "", "");
                    }
                }
            });
        };
        // ---------- ON LOOKUP PARTS ------------------------------------
        document.getElementById("caripart").addEventListener("click", function(event) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#hargasatuan').val("0");
            $('#qty').val("0");
            $('#qtystock').val("0");
            $('#total').val("0");
            event.preventDefault();
            $('#tablesearchpart').DataTable({
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
                    "url": "<?php echo base_url('sparepart/pembebanan_sparepart/CariDataParts'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            hargajual: "hargajual",
                            hargabeli: "hargabeli",
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
            $('#kodesparepart').val(result.trim());
            DataParts(result.trim());
            DataStock(result.trim());
            getMinStock(result.trim());
            // DataDetail(result.trim());
        });

        function DataDetail(kodepart) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $("#hargasatuan").val("0");
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
                        $('#hargasatuan').val(formatRupiah(data[i].hargajual.trim(), ''));
                    }
                }
            });
        };

        function DataParts(kode) {
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/pembebanan_sparepart/GetDataParts'); ?>",
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
                        $('#namasparepart').val(data[i].nama.trim());
                        $('#kategori').val(data[i].kategoripart.trim());
                        $('#hargasatuan').val(formatRupiah(data[i].hargajual.trim(), ''));
                        if (data[i].kode == "PRTX-TB" || data[i].kode == "PRTX-T" || data[i].kode == "BIO-S" || data[i].kode == "AVG" || data[i].kode == "VP") {
                            document.getElementById('total').disabled = false;
                        } else {
                            document.getElementById('total').disabled = true;
                        }
                    }
                }
            });
        };

        function DataStock(kode) {
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/pembebanan_sparepart/GetDataStock'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kodecabang: kodecabang,
                    kodesubcabang: kodesubcabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#qtystock').val(data[i].stockakhir.trim());
                        // $('#satuan').val(data[i].satuan.trim());
                    }
                }
            });
        };

        function getMinStock(kodepart) {
            $.ajax({
                url: "<?php echo base_url('masterdata/parts/getminstock'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kodepart: kodepart
                },
                success: function(data) {
                    if (!data.length == 0) {
                        for (var i = 0; i < data.length; i++) {
                            $("#munculpesan").click();
                            $("#saranservice").html(data[i].saran);
                        }
                    }
                }
            });
        }

        
        // ---------- ON BUTTON CETAK CLOSE WO ---------------------------------------------
        document.getElementById("cetakclosewo").addEventListener("click", function(event) {
            var nomorspk = $('#nomorspk').val();
            window.open(
                "<?php echo base_url('form/form/cetak_closewo/') ?>" + nomorspk
            );
        });

    });
</script>