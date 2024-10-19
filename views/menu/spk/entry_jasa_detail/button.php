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

        // --- OTORISASI CANCEL ---
        <?php
        $grup = $this->session->userdata('mygrup');

        $nama_menu = 'Entry Jasa Detail';

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
        // --- END OTORISASI CANCEL ---

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
            $('#no_wo').val("");
            $('#nopolisi').val("");
            $('#nomor_customer').val("");
            $('#nama_customer').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#detaildatajasa').empty();

            var _row = null;
            document.getElementById('save').disabled = false;
            document.getElementById('update').disabled = true;
            document.getElementById('carinowo').disabled = false;
            document.getElementById('carijasa').disabled = false;
            document.getElementById('cancel').disabled = true;
        };
        $("#loading").hide();
        BersihkanLayar();

        // --- VALIDASI ---
        function CekValidasi() {
            var table = document.getElementById('detaildatajasa');
            if ($('#no_wo').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Data Work Order Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carinowo').focus();
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
                $('#detailjasa').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };
        // --- END VALIDASI ---

        // --- FIND NOMOR WO ---
        document.getElementById("carinowo").addEventListener("click", function(event) {
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and kodecompany = '" + kodecompany + "' and nomorspk not in (select no_wo from trnt_entryjasa where batal = false)"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and nomorspk not in (select no_wo from trnt_entryjasa where batal = false)"
            } else {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "' and nomorspk not in (select no_wo from trnt_entryjasa where batal = false)"
            }
            event.preventDefault();
            $('#tablesearchwo').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/Entry_jasa_detail/CariDataNoWO'); ?>",
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

        $(document).on('click', ".searchnomorwo", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/Entry_jasa_detail/getDataWO'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#no_wo').val(data[i].nomor_wo.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#nomor_customer').val(data[i].nomor_customer.trim());
                        $('#nama_customer').val(data[i].nama_customer.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
                        $('#nama_tipe').val(data[i].nama_tipe.trim());
                    }
                }
            }, false);
        });
        // --- END FIND NOMOR WO ---

        // --- FIND JASA ---
        document.getElementById("carijasa").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchjasa').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                // "ordering": true,
                "ajax": {
                    "url": "<?php echo base_url('spk/Entry_jasa_detail/CariDataJasa'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_jasa",
                        field: {
                            kode_jasa: "kode",
                            nama_jasa: "nama"
                        },
                        sort: "kode",
                        where: {
                            kode_jasa: "kode",
                            nama_jasa: "nama",
                        },
                        value: "aktif = TRUE"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchjasa", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/Entry_jasa_detail/getDataJasa'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode_jasa').val(data[i].kode.trim());
                        $('#nama_jasa').val(data[i].nama.trim());
                        DetailJasa(data[i].kode.trim());
                    }
                }
            }, false);
        });
        // --- END FIND JASA ---

        function DetailJasa(kode) {
            // cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/Entry_jasa_detail/DataJasaDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode_jasahead = data[i].kode_jasahead.trim();
                        var kode_jasa = data[i].kode_jasa.trim();
                        var nama_jasa = data[i].nama_jasa.trim();
                        inserttable(kode_jasahead, kode_jasa, nama_jasa, "");
                    }
                }
            });
        };

        // --- FIND JASA DETAIL---
        document.getElementById("carijasadetail").addEventListener("click", function(event) {
            event.preventDefault();
            var head = $('#kode_jasa').val();
            $('#tablesearchjasadetail').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                // "ordering": true,
                "ajax": {
                    "url": "<?php echo base_url('spk/Entry_jasa_detail/CariDataJasaDetail'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_jasadetail",
                        field: {
                            kode_jasa: "kode_jasa",
                            nama_jasa: "nama_jasa"
                        },
                        sort: "kode_jasa",
                        where: {
                            kode_jasa: "kode_jasa",
                            nama_jasa: "nama_jasa",
                        },
                        value: "kode_jasahead = '" + head + "'"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchjasadetail", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/Entry_jasa_detail/getDataJasaDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode_jasadetail').val(data[i].kode_jasa.trim());
                        $('#nama_jasadetail').val(data[i].nama_jasa.trim());
                    }
                }
            }, false);
        });
        // --- END FIND JASA DETAIL ---

        // --- ADD DETAIl ---
        $("#add_detail").click(function() {
            if ($('#kode_jasa').val() == '' || $('#nama_jasa').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jasa Head terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carijasa').focus();
            } else if ($('#kode_jasadetail').val() == '' || $('#kode_jasadetail').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jasa Detail terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carijasa').focus();
            } else {
                var kode_jasa = $("#kode_jasa").val();
                var kode_jasadetail = $("#kode_jasadetail").val();
                var nama_jasadetail = $("#nama_jasadetail").val();
                if (validasiadd(kode_jasadetail) == true) {
                    inserttable(kode_jasa, kode_jasadetail,nama_jasadetail, "")
                    $("#kode_jasadetail").val("");
                    $("#nama_jasadetail").val("");
                } else {
                    $.confirm({
                        title: 'Info !',
                        content: 'Jasa tersebut sudah ada di list, Apakah ingin menggantinya ?',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                action: function(data) {
                                    // console.log(formSubmit);
                                    $('#' + kode_jasadetail).remove();
                                    inserttable(kode_jasa, kode_jasadetail,nama_jasadetail, "")
                                    $("#kode_jasadetail").val("");
                                    $("#nama_jasadetail").val("");
                                }
                            },
                            cancel: function() {
                                //close
                            },
                        },
                        onContentReady: function() {
                            var jc = this;
                            this.$content.find('form').on('submit', function(e) {
                                e.preventDefault();
                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                            });
                        }
                    });
                }
            }
        });

        function validasiadd(nopolisi) {
            var table = document.getElementById('detailjasa');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.trim() === nopolisi.trim()) {
                    result = false;
                }
            }
            return result;
        }

        function inserttable(kode_jasa, kode_jasadetail, nama_jasadetail, find) {
            var row = "";
            row =
                '<tr id="' + kode_jasadetail + '">' +
                '<td align="center">' + kode_jasa + '</td>' +
                '<td align="center">' + kode_jasadetail + '</td>' +
                '<td align="center">' + nama_jasadetail + '</td>' +
                '<td style="width: 10px;">' +
                '<button data-table="' + kode_jasadetail + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detaildatajasa').append(row);
        }

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildatajasa');
        });

        function cleardetail() {
            $('#detaildatajasa').empty();
        }

        $(document).on('click', '.edit', function() {
            _row = $(this);
            $('#kode_jasa').val(_row.closest("tr").find("td:eq(0)").text());
            $('#kode_jasadetail').val(_row.closest("tr").find("td:eq(1)").text());
            $('#nama_jasadetail').val(_row.closest("tr").find("td:eq(2)").text());
        });

        // $("#remove_detail").click(function() {
        //     var id = $('#kode_jasadetail').val();
        //     var table = document.getElementById('detailjasa');
        //     $('#' + id).remove();
        //     if (table.rows.length == 1) {
        //         document.getElementById('kode_jasadetail').disabled = false;
        //     }
        //     resettomboolnewrow();
        // });

        function resettomboolnewrow() {
            $('#kode_jasadetail').val("");
            $('#nama_jasadetail').val("");
        }

        function ambildatadetail() {
            var table = document.getElementById('detailjasa');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 0) {
                        string = "{" + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }
                string = string + "}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }
        // --- END ADD DETAIL ---

        // --- BUTTON SAVE ---
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var no_wo = $('#no_wo').val();
            var nopolisi = $('#nopolisi').val();
            var nomor_customer = $('#nomor_customer').val();
            var kode_tipe = $('#kode_tipe').val();
            var kode_jasa = $('#kode_jasa').val();
            var nama_jasa = $('#nama_jasa').val();
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodesubcabang = $('#subcabang').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/Entry_jasa_detail/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        no_wo: no_wo,
                        nopolisi: nopolisi,
                        nomor_customer: nomor_customer,
                        kode_tipe: kode_tipe,
                        kode_jasa: kode_jasa,
                        nama_jasa: nama_jasa,
                        kodecabang: kodecabang,
                        kodecompany: kodecompany,
                        kodesubcabang: kodesubcabang,
                        detailjasa: datadetail
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
                                "<?php echo base_url('form/form/cetak_entryjasadetail/') ?>" + data.nomor
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
        // --- END SAVE ---

        // -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var no_wo = $('#no_wo').val();
            var nopolisi = $('#nopolisi').val();
            var nomor_customer = $('#nomor_customer').val();
            var kode_tipe = $('#kode_tipe').val();
            var kode_jasa = $('#kode_jasa').val();
            var nama_jasa = $('#nama_jasa').val();
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodesubcabang = $('#subcabang').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/Entry_jasa_detail/Update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        no_wo: no_wo,
                        nopolisi: nopolisi,
                        nomor_customer: nomor_customer,
                        kode_tipe: kode_tipe,
                        kode_jasa: kode_jasa,
                        nama_jasa: nama_jasa,
                        kodecabang: kodecabang,
                        kodecompany: kodecompany,
                        kodesubcabang: kodesubcabang,
                        detailjasa: datadetail
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
        // -- END UPDATE -- 

        // --- ON BUTTON FIND ---
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodesubcabang = $('#subcabang').val();
            if (kodecabang == "ALL") {
                values = "batal = false and kodecompany = '" + kodecompany + "'"
            } else {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kodecabang + "'"
            }
            $('#tablesearchentryjasadetail').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/Entry_jasa_detail/FindEntryJasa'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_entryjasadetail",
                        field: {
                            nomor_wo: "no_wo",
                            nopolisi: "nopolisi",
                            nomor_customer: "nomor_customer",
                            nama_customer: "nama_customer",
                            kode_tipe: "kode_tipe",
                            nama_tipe: "nama_tipe",
                        },
                        sort: "no_wo",
                        where: {
                            no_wo: "no_wo",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer"
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var no_wo = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/Entry_jasa_detail/FindDataEntryJasa'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    no_wo: no_wo
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#no_wo').val(data[i].no_wo.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#nomor_customer').val(data[i].nomor_customer.trim());
                        $('#nama_customer').val(data[i].nama_customer.trim());
                        $('#kode_tipe').val(data[i].kode_tipe.trim());
                        $('#nama_tipe').val(data[i].nama_tipe.trim());
                        FindDataEntryJasaDetail(data[i].no_wo.trim());
                    }
                    TurnDisableSave();
                }
            }, false);
        });

        function FindDataEntryJasaDetail(no_wo) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/Entry_jasa_detail/FindDataEntryJasaDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    no_wo: no_wo
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode_jasa = data[i].kode_jasahead.trim();
                        var kode_jasadetail = data[i].kode_jasa.trim();
                        var nama_jasadetail = data[i].nama_jasa.trim();
                        inserttable(kode_jasa, kode_jasadetail, nama_jasadetail, "");
                    }
                }
            });
        };
        // --- END FIND ---

        // --- ON BUTTON CANCEL ---
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var no_wo = $('#no_wo').val();
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodesubcabang = $('#subcabang').val();
            var datadetail = ambildatadetail();
            $.confirm({
                title: 'Info..',
                content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Apakah anda yakin ?</label>' +
                    '<input type="text" placeholder="Masukkan Alasan Pembatalan" class="alasan form-control" required />' +
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
                                url: "<?php echo base_url('spk/Entry_jasa_detail/Cancel'); ?>",
                                method: "POST",
                                dataType: "json",
                                async: true,
                                data: {
                                    no_wo: no_wo,
                                    alasan: alasan,
                                    kodecabang: kodecabang,
                                    kodecompany: kodecompany,
                                    kodesubcabang: kodesubcabang,
                                    detailkendaraan: datadetail
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
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });
        // --- END CANCEL ---

        // --- NEW ---
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayar();
            location.reload(true);
        });
        // --- END NEW ---

        // --- Turn Disable ---
        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
            document.getElementById('carinowo').disabled = true;
            document.getElementById('carijasa').disabled = false;
            document.getElementById('cancel').disabled = false;
        };
        // --- END TURN DISABLE ---

        // --- CETAK ---
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#no_wo').val();
            window.open(
                "<?php echo base_url('form/form/cetak_entryjasadetail/') ?>" + nomor
            );
        });
        // --- END CETAK ---
    });
</script>