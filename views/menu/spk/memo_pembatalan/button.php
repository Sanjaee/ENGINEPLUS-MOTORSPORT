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
        $nama_menu = 'Memo Pembatalan';

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
            $('#nomor').val("MP" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#kode_kategori').val("");
            $('#nama_kategori').val("");
            $('#pic').val("");
            $("#nocustomer").val("");
            $("#namacustomer").val("");
            $('#alasan').val("");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);

            $("#nonreturnjob").prop("checked", "true");
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('returnjob').disabled = true;
            document.getElementById('nonreturnjob').disabled = true;
            document.getElementById('alasan').disabled = false;
            $('#detaildataspk').empty();
        };
        $("#loading").hide();
        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility', 'hidden');



        function cleardetail() {
            $('#detaildata').empty();
        }

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

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = datePart[1],
                day = datePart[2];

            return day + '-' + month + '-' + year;
        };


        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
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
            } else if ($('#alasan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Alasan Pembatalan Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#alasan').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };


        function ValidasiAdd() {

        }
        // ---------- OnLookup SPK ----------------------------------------
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
                    "url": "<?php echo base_url('spk/pembatalan_spk/CariDataSPK'); ?>",
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
        // ---------- Get Data SPK ----------------------------------------
        function DataSPK(nomorspk) {
            $.ajax({
                url: "<?php echo base_url('spk/pembatalan_spk/GetDataSPK'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomorspk: nomorspk
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorspk').val(data[i].nomor.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        if (data[i].returnjob == 'true') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }
                        $('#tanggal').val(data[i].tanggal.trim());

                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());

                        FindSpkDetail(data[i].nomor.trim());
                    }
                }
            });
        };
        // ---------- Get Data SPK Detail ----------------------------------------
        function FindSpkDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/pembatalan_spk/GetSPKDetail'); ?>",
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
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        inserttable(kode, nama, jenis, qty, harga, subtotal, "");
                    }
                }
            });
        };
        // ---------- Get Data Customer ----------------------------------------
        function DataCustomer(nocustomer) {
            $.ajax({
                url: "<?php echo base_url('spk/pembatalan_spk/GetDataCustomer'); ?>",
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
        // ---------- Get Data Tipe ----------------------------------------
        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('spk/pembatalan_spk/GetDataTipe'); ?>",
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
        // ---------- Insert SPK Detail ----------------------------------------
        function inserttable(kode, nama, jenis, qty, harga, subtotal) {
            var row = "";
            row =
                '<tr id="' + jenis + '">' +
                '<td style="display:none;"></td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + subtotal + '</td>' +
                '</tr>';
            $('#detaildataspk').append(row);
            // $('#bebas').html(row);
            //subtotal();
        }
        // ---------- Button Save ----------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var nomorspk = $('#nomorspk').val();
            var tanggal = $('.tanggal').val();
            var alasan = $('#alasan').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/pembatalan_spk/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nomorspk: nomorspk,
                        tanggal: tanggal,
                        kodecabang: kodecabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        alasanpembatalan: alasan
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
        //------------- Turn Disable Save -------------------
        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            document.getElementById('carispk').disabled = true;
        };

        function TurnDisable() {
            document.getElementById('save').disabled = true;
            document.getElementById('carispk').disabled = true;
            document.getElementById('cancel').disabled = false;
        };
        // ---------- ON BUTTON FIND ---------------------------------------------
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            //console.log(kode_cabang);
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
                    "url": "<?php echo base_url('spk/pembatalan_spk/CariDataMemo'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_memopembatalanspk",
                        field: {
                            nomor: "nomor",
                            nospk: "nospk",
                            alasanpembatalan: "alasanpembatalan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nospk: "nospk",
                            alasanpembatalan: "alasanpembatalan"
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
                url: "<?php echo base_url('spk/pembatalan_spk/GetDataMemo'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nomorspk').val(data[i].nospk.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#alasan').val(data[i].alasanpembatalan.trim());

                        DataSPK(data[i].nospk.trim());

                        //FindSpkDetail(data[i].nospk.trim());
                    }
                    document.getElementById('alasan').disabled = true;
                    TurnDisable();
                }
            }, false);
        });


        // ---------- Cancel ----------------------------------
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
                                url: "<?php echo base_url('spk/pembatalan_spk/Cancel'); ?>",
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
    });
</script>