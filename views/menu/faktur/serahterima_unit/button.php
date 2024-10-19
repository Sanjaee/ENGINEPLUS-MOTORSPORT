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
        $nama_menu = 'Serah Terima Unit';

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
            $('#nomor').val("ST" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#kode_kategori').val("");
            $('#nama_kategori').val("");
            $("#nocustomer").val("");
            $("#namacustomer").val("");
            $('#keterangan').val("");
            $('#saran').val("");
            $('#nomor_dokumen').val("");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);

            $("#warranty").prop("checked", "true");
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('warranty').disabled = true;
            document.getElementById('nonwarranty').disabled = true;
            document.getElementById('keterangan').disabled = false;
            document.getElementById('carifaktur').disabled = false;
            document.getElementById('carispk').disabled = false;
            $('#detaildataspk').empty();
            $("#carispk").hide();
            $("#carifaktur").hide();
        };
        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility', 'hidden');

        $("input[name='dokumen']").change(function() {
            if ($(this).val() == "true") {
                $("#carispk").show();
                $("#carifaktur").hide();
            } else if ($(this).val() == "false") {
                $("#carispk").hide();
                $("#carifaktur").show();
            }
        });

        // ---------- On Function ------------------------------------
        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = datePart[1],
                day = datePart[2];

            return day + '-' + month + '-' + year;
        };

        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            $("#carispk").hide();
            $("#carifaktur").hide();
        };

        function TurnDisable() {
            document.getElementById('cancel').disabled = false;
            document.getElementById('save').disabled = true;
            document.getElementById('dokumentspk').disabled = true;
            document.getElementById('dokumentfaktur').disabled = true;
            document.getElementById('carifaktur').disabled = true;
            document.getElementById('carispk').disabled = true;
            $('#update').prop('disabled', false);
        };

        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            if ($('#nomor_dokumen').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nomor Dokumen Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomor_dokumen').focus();
                var result = false;
            } else if ($('#saran').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Saran Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#saran').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        // ---------- Get Data --------------------------------------
        function DataSPK(nomorspk) {
            $.ajax({
                url: "<?php echo base_url('faktur/serahterima_unit/GetDataSPK'); ?>",
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
                        // $('#kode_kategori').val(data[i].kategori.trim());
                        if (data[i].garansi == 'true') {
                            $('input:radio[name="warranty"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="warranty"][value="false"]').prop('checked', true);
                        }

                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());
                        // DataProduct(data[i].kategori.trim());
                    }
                }
            });
        };

        function DataFaktur(nomor) {
            $.ajax({
                url: "<?php echo base_url('faktur/serahterima_unit/GetDataFaktur'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor_dokumen').val(data[i].nomor.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());

                        DataCustomer(data[i].nomor_customer.trim());
                        DataSPK(data[i].nomor_spk.trim());
                        //DataProduct(data[i].kategori.trim());
                    }
                }
            });
        };

        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('faktur/serahterima_unit/GetDataTipe'); ?>",
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
                url: "<?php echo base_url('faktur/serahterima_unit/GetDataProduct'); ?>",
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
                url: "<?php echo base_url('faktur/serahterima_unit/GetDataCustomer'); ?>",
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

        // ---------- OnLookUp SPK --------------------------------------
        document.getElementById("carispk").addEventListener("click", function(event) {
            event.preventDefault();
            kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = true"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and batal = true"
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
                    "url": "<?php echo base_url('faktur/serahterima_unit/CariDataSPK'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_wo",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nomor_customer: "nomor_customer",
                            tipe: "tipe"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
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
            $('#nomor_dokumen').val(result.trim());
            DataSPK(result.trim());
        });

        // ---------- OnLookUp Faktur --------------------------------------
        document.getElementById("carifaktur").addEventListener("click", function(event) {
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
            $('#tablesearchfaktur').DataTable({
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
                    "url": "<?php echo base_url('faktur/serahterima_unit/CariDataFaktur'); ?>",
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

        $(document).on('click', ".searchfaktur", function() {
            var result = $(this).attr("data-id");
            $('#nomor_dokumen').val(result.trim());
            DataFaktur(result.trim());
        });

        // ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);

        });

        // ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var jenisserahterima = 1;
            var nomorreferensi = $('#nomor_dokumen').val();
            var keterangan = $('#keterangan').val();
            var saran = $('#saran').val();
            var tanggal = $('.tanggal').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('faktur/serahterima_unit/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        jenisserahterima: jenisserahterima,
                        nomorreferensi: nomorreferensi,
                        keterangan: keterangan,
                        saran: saran,
                        kodecabang: kodecabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        tanggal: tanggal
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
                            var nomor = $('#nomor').val();
                            window.open(
                                "<?php echo base_url('form/form/cetak_serahterimaunit/') ?>" + nomor
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
            //}        
        });
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
                    "url": "<?php echo base_url('faktur/serahterima_unit/CariDataSerahTerima'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_serahterimaunit",
                        field: {
                            nomor: "nomor",
                            noreferensi: "noreferensi",
                            keterangan: "keterangan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            noreferensi: "noreferensi",
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
                url: "<?php echo base_url('faktur/serahterima_unit/GetDataSerahTerima'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nomor_dokumen').val(data[i].noreferensi.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#saran').val((data[i].saran));
                        DataSPK(data[i].noreferensi.trim());
                        DataFaktur(data[i].noreferensi.trim());
                    }
                    TurnDisable();
                }
            });
        });

        // ---------- ON BUTTON UPDATE ---------------------------------------------
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var keterangan = $('#keterangan').val();
            var saran = $('#saran').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('faktur/serahterima_unit/Update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        keterangan: keterangan,
                        saran: saran
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
                                url: "<?php echo base_url('faktur/serahterima_unit/Cancel'); ?>",
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
                "<?php echo base_url('form/form/cetak_serahterimaunit/') ?>" + nomor
            );
        });
    });
</script>