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
        $nama_menu = 'Request Part Teknisi';

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
            $('#nomor').val("RT" + yr + mt + "00000");
            $('#tanggalorder').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#kode_kategori').val("");
            $('#nama_kategori').val("");
            $("#nocustomer").val("");
            $("#namacustomer").val("");
            $("#satuan").val("");
            $('#keterangan').val("");
            $('#nomorspk').val("");
            $('#kodemekanik').val("");
            $('#namamekanik').val("");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);

            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('keterangan').disabled = false;
            $('#detaildata').empty();
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            if ($('#kodemekanik').val() == '' || $('#namamekanik').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Mekanik Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kodemekanik').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            document.getElementById('carispk').disabled = true;
            //$("#carispk").hide();
        };

        function TurnDisable() {
            document.getElementById('cancel').disabled = false;
            document.getElementById('save').disabled = true;
            document.getElementById('keterangan').disabled = true;
            document.getElementById('carispk').disabled = true;
            document.getElementById('carimekanik').disabled = true;
            document.getElementById('cariparts').disabled = true;
        };

        function cleardetail() {
            $('#detaildata').empty();
        }
        // ---------- Get Data --------------------------------------
        function DataSPK(nomorspk) {
            $.ajax({
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataSPK'); ?>",
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
                        $('#kode_kategori').val(data[i].kategori.trim());

                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());
                        DataProduct(data[i].kategori.trim());
                    }
                }
            });
        };

        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataTipe'); ?>",
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
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataProduct'); ?>",
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
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataCustomer'); ?>",
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

        function DataRequestDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = "1";
                        var kode = data[i].kodepart.trim();
                        var nama = DataSparepart(data[i].kodepart.trim(), true);
                        var qty = data[i].qty.trim();
                        insertrequest(kode, nama, jenis, qty, "");
                    }
                }
            });
        };

        function DataSparepart(kode, find) {
            var returnValue;
            $.ajax({
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataParts'); ?>",
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
                            $('#satuan').val(data[i].satuan.trim());
                            // hitungOngkoshari();  
                            returnValue = false;
                        }
                    }
                }
            })
            return returnValue;
        };

        function DataParts(kode) {
            $.ajax({
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataParts'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama').val(data[i].nama.trim());
                        $('#satuan').val(data[i].satuan.trim());
                    }
                }
            });
        };

        // ---------- OnLookUp SPK --------------------------------------
        document.getElementById("carispk").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
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
                    "url": "<?php echo base_url('sparepart/requestpart_teknisi/CariDataSPK'); ?>",
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
            $('#nomorspk').val(result.trim());
            DataSPK(result.trim());
        });
        // ---------- OnLookUp Parts --------------------------------------

        document.getElementById("cariparts").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchparts').DataTable({
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
                    "url": "<?php echo base_url('sparepart/requestpart_teknisi/CariDataParts'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_parts",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchparts", function() {
            var result = $(this).attr("data-id");
            $('#kode').val(result.trim());
            DataParts(result.trim());
        });

        //------------ MEKANIK -----------------------------
        document.getElementById("carimekanik").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = false"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and batal = false"
            // }
            $('#tablesearchmekanik').DataTable({
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
                    "url": "<?php echo base_url('sparepart/requestpart_teknisi/CariDataMekanik'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_teknisi",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchokmek", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataMekanik'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodemekanik').val(data[i].kode.trim());
                        $('#namamekanik').val(data[i].nama.trim());
                    }
                    //TurnDisable();
                }
            }, false);
        });

        // ---------- OnLookUp Find --------------------------------------
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
                    "url": "<?php echo base_url('sparepart/requestpart_teknisi/CariDataRequest'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_requestpartspk",
                        field: {
                            nomor: "nomor",
                            nospk: "nospk",
                            keterangan: "keterangan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nospk: "nospk",
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
                url: "<?php echo base_url('sparepart/requestpart_teknisi/GetDataRequest'); ?>",
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
                        $('#tanggal').val(data[i].tanggal.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#kodemekanik').val(data[i].kode_mekanik.trim());
                        $('#namamekanik').val(data[i].nama_mekanik.trim());

                        DataSPK(data[i].nospk.trim());


                        DataRequestDetail(data[i].nomor.trim());
                    }
                    TurnDisable();
                }
            }, false);
        });
        // ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var nospk = $('#nomorspk').val();
            var tanggal = $('.tanggal').val();
            var keterangan = $('#keterangan').val();
            var kodecabang = $('#scabang').val();
            var kodemekanik = $('#kodemekanik').val();
            var namamekanik = $('#namamekanik').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/requestpart_teknisi/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nospk: nospk,
                        keterangan: keterangan,
                        tanggal: tanggal,
                        kodecabang: kodecabang,
                        kodemekanik: kodemekanik,
                        namamekanik: namamekanik,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        detailrequest: datadetail
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
        // ---------- ADD DETAIL TABLE ----------------------------------
        function ValidasiAdd() {
            var kode = $("#kode").val();
            var table = document.getElementById('detail');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 1) {
                        if (table.rows[r].cells[c].innerHTML == kode) {
                            alert("data sudah pernah diinput")
                            return "gagal";
                        }
                    }
                }
            }
            return "sukses";
        }

        $("#add_detail").click(function() {
            if ($('#kode').val() == '' || $('#nama').val() == '') {
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
                $('#cariparts').focus();
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
            } else {
                var jenis = "1";
                var kode = $("#kode").val();
                var nama = $("#nama").val();
                var qty = $("#qty").val();

                if (ValidasiAdd() == "sukses") {
                    insertdetail(kode, nama, jenis, qty, "")
                    $("#kode").val("");
                    $("#nama").val("");
                    $("#satuan").val("");
                    $("#qty").val("0");
                }
            }
        });

        function insertdetail(kode, nama, jenis, qty, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td style="display:none;"></td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' +
                '<button data-table="' + kode + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildata').append(row);

        }

        function insertrequest(kode, nama, jenis, qty, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td style="display:none;"></td>' +
                '<td>' + kode + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' +
                '<button data-table="' + kode + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildata').append(row);

        }

        function ambildatadetail() {
            var table = document.getElementById('detail');
            var arr2 = [];
            var qty = 0;
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

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildata');
            if (table.rows.length == 1) {
                document.getElementById('qty').disabled = false;
            }
        });

        // ---------- Cancel ----------------------------------
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
                                url: "<?php echo base_url('sparepart/requestpart_teknisi/Cancel'); ?>",
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

        // ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);

        });

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

    });
</script>