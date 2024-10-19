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

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            jam = datePart[3];
            menit = datePart[4];
            return day + ' ' + month + ' ' + year + ' ' + jam + ':' + menit;
        }

        // ------------- Otorisasi Pembatalan -------------
        <?php

        $grup = $this->session->userdata('mygrup');

        $nama_menu = 'Booking Service';

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
            $('#nomor').val("BKS-" + kode_cabang + "-" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            $('#tanggalbk').datetimepicker({
                format: "dd MM yyyy hh:ii",
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            });
            // $("#tanggal").prop("disabled", true);
            $('#nopolisi').val("");
            $('#kodetipe').val("");
            $('#namatipe').val("");
            $('#model').val("");
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
            $('#jenis_detail').val("-");
            $('#kode').val("");
            $('#nama').val("");
            $('#satuan').val("");
            $('#qty').val("0");
            $('#harga').val("0");
            $('#total').val("0");
            $('#grandtotal').val("0");
            $('#keterangan').val("");
            $('#total_jasa').val("0");
            $('#total_sparepart').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#jenis').val("-");
            $('#koderegular').val("");
            $('#namaregular').val("");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);
            $("#caritask").hide();
            $("#cariparts").hide();
            $('#satuan').hide();
            $("#edit_detail").hide();

            $("#jenisdetail").val("");
            $("#detailkategori").val("");
            $("#nonreturnjob").prop("checked", "false");
            $("#noninventaris").prop("checked", "false");
            // $('#detaildataparts').empty();
            // $('#detaildatatask').empty();
            $('#detaildataspk').empty();
            document.getElementById('carisn').disabled = false;
            document.getElementById('caricustomer').disabled = false;
            document.getElementById('save').disabled = false;
            document.getElementById('caritipe').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;

            $('#nopolisi').prop("disabled", false);
            $('#nopolisi').prop("readOnly", false);

            document.getElementById('carisn').disabled = false;
            document.getElementById('caricustomer').disabled = false;
            document.getElementById('namacustomer').disabled = false;
            document.getElementById('nopolisi').disabled = false;
            document.getElementById('keluhan').readOnly = false;
            document.getElementById('jenis').disabled = false;
            document.getElementById('returnjob').disabled = false;
            document.getElementById('inventaris').disabled = false;
            document.getElementById('noninventaris').disabled = false;
            document.getElementById('nonreturnjob').disabled = false;
            document.getElementById('pic').disabled = false;
            document.getElementById('nohp').disabled = false;
            loadppnkonfigurasi();
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            var tanggal = $('#tanggal').val();
            if ($('#nopolisi').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nomor Polisi Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carisn').focus();
                var result = false;
            } else if ($('#jenis').val() == '' || $('#jenis').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Jenis Service Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenis').focus();
                var result = false;
            } else if ($('#namacustomer').val() == '' || $('#pic').val() == '' || $('#nohp').val() == '' || $('#nohp').val() == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Customer dan Isi PIC Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caricustomer').focus();
                var result = false;
            } else if ($('#keluhan').val() == '' || $('#keluhan').val() == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Keluhan harus diisi',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#keluhan').focus();
                var result = false;
            } else if ($('#kodetipe').val() == '' || $('#namatipe').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Tipe Harus Dipilih',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caritipe').focus();
                var result = false;
            } else if (tanggal == newDate) {
                $.alert({
                    title: 'Info..',
                    content: 'Tanggal Booking Harus H+1..',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#tanggal').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function ValidasiAdd() {
            var kode = $("#kode").val();
            var table = document.getElementById('detailspk');
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
        // ---------- FIND Data ----------------------------------------
        function DataCustomer(nocustomer) {
            $.ajax({
                url: "<?php echo base_url('spk/booking/GetDataCustomer'); ?>",
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




        function DetailRegularCheck(kode) {
            var kodemodel = $('#model').val();
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/booking/GetDataRegularDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kodemodel: kodemodel
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var jenis = data[i].jenis.trim();
                        var kode_referensi = data[i].kode_referensi.trim();
                        var nama_referensi = data[i].namaref.trim();
                        var kategori = '';
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        insertdetail(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                    }
                }
            });
        };

        function TurnDisable() {
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
            document.getElementById('cancel').disabled = false;
            document.getElementById('carisn').disabled = true;
            document.getElementById('caricustomer').disabled = true;
            document.getElementById('nopolisi').readOnly = true;
            document.getElementById('namacustomer').readOnly = true;
            document.getElementById('keluhan').readOnly = true;
            document.getElementById('jenis').disabled = true;
            document.getElementById('returnjob').disabled = true;
            document.getElementById('inventaris').disabled = true;
            document.getElementById('noninventaris').disabled = true;
            document.getElementById('nonreturnjob').disabled = true;
            document.getElementById('pic').disabled = true;
            document.getElementById('nohp').disabled = true;
        };

        function FindDisable() {
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
            document.getElementById('cancel').disabled = false;
            document.getElementById('carisn').disabled = true;
            document.getElementById('caricustomer').disabled = true;
            document.getElementById('nopolisi').readOnly = true;
            document.getElementById('namacustomer').readOnly = true;
            document.getElementById('keluhan').readOnly = true;
            document.getElementById('jenis').disabled = true;
            document.getElementById('returnjob').disabled = false;
            document.getElementById('inventaris').disabled = false;
            document.getElementById('noninventaris').disabled = false;
            document.getElementById('nonreturnjob').disabled = false;
            document.getElementById('pic').disabled = true;
            document.getElementById('nohp').disabled = true;
        };

        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/booking/FindDetail'); ?>",
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
                        var kategori = data[i].kategori.trim();
                        var qty = data[i].qty.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        inserttable(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                    }
                }
            });
        };
        // ----------END FIND Data ----------------------------------------

        // ---------- ON LOOKUP SN ----------------------------------------
        document.getElementById("carisn").addEventListener("click", function(event) {
            event.preventDefault();               
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#scabang').val();
            var kodegrup = $('#kodegrupcabang').val();
            if (kodecabang == "SPT" || kodecabang == "WKS") { //TAM
                values = "kode_cabang in ('WKS','SPT')"
            } else {
                values = "kode_cabang = '" + kodecabang + "'"
            } 
            $('#tablesearchsn').DataTable({
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
                    "url": "<?php echo base_url('spk/booking/CariDataNopol'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_kendaraancustomer",
                        field: {
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nomesin: "nomesin",
                            nomor_customer: "nomor_customer"
                        },
                        sort: "nopolisi",
                        where: {
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nomesin: "nomesin",
                            nomor_customer: "nomor_customer"
                        },
                        // value: "kode_cabang = '" + kodecabang + "'"
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchsn", function() {
            var result = $(this).attr("data-id");
            var nopolisi = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/booking/GetDataNopol'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopolisi: nopolisi
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#pic').val(data[i].namapic.trim());
                        $('#nohp').val(data[i].nohppic.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#kodetipe').val(data[i].kodetipe.trim());
                        $('#namatipe').val(data[i].namatipe.trim());
                        $('#model').val(data[i].model.trim());
                        DataCustomer(data[i].nomor_customer.trim());
                        document.getElementById('carisn').disabled = true;
                        document.getElementById('caricustomer').disabled = true;
                        document.getElementById('namacustomer').disabled = true;
                        document.getElementById('nopolisi').disabled = true;
                    }
                }
            });
        });

        // ---------- ON LOOKUP CUSTOMER ------------------------------------
        document.getElementById("caricustomer").addEventListener("click", function(event) {
            event.preventDefault();   
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#scabang').val();
            var kodegrup = $('#kodegrupcabang').val();
            if (kodecabang == "SPT" || kodecabang == "WKS") { //TAM
                values = "aktif = true and kodecompany = '" + kodecompany + "' and kode_cabang in ('WKS','SPT')"
            } else {
                values = "aktif = true and kode_cabang = '" + kodecabang + "'"
            } 
            $('#tablesearchcustomer').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // // "scrollX": true,
                // "scrollY": true,
                "ordering": true,
                // "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('spk/booking/CariDataCustomer'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_customer",
                        field: {
                            nomor: "nomor",
                            nama: "nama",
                            nohp: "nohp",
                            email: "email"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nama: "nama",
                            nohp: "nohp",
                            email: "email"
                        },
                        // value: "aktif = true"
                        value:values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchcustomer", function() {
            var result = $(this).attr("data-id");
            $('#nocustomer').val(result.trim());
            DataCustomer(result.trim());
            document.getElementById('namacustomer').disabled = true;
        });

        // ---------- ON LOOKUP PARTS ------------------------------------
        document.getElementById("cariparts").addEventListener("click", function(event) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
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
                    "url": "<?php echo base_url('spk/booking/CariDataParts'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            hargajual: "hargajual",
                            qtyakhir: "qtyakhir"
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
            $('#kode').val(result.trim());
            DataParts(result.trim());
            // DataDetail(result.trim());
        });

        function DataParts(kode) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('spk/booking/GetDataParts'); ?>",
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
                        $('#nama').val(data[i].nama.trim());
                        $('#jenisdetail').val(data[i].kategoripart.trim());
                        $('#satuan').val(data[i].satuan.trim());
                        $('#jenis_detail').val(1);
                        $('#harga').val(formatRupiah(data[i].hargajual.trim(), ''));
                    }
                }
            });
        };

        function DataDetail(kodepart) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $("#harga").val("0");
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
                        $('#harga').val(formatRupiah(data[i].hargajual.trim(), ''));
                    }
                }
            });
        };

        // ---------- ON LOOKUP TASK ------------------------------------
        document.getElementById("caritask").addEventListener("click", function(event) {
            var model = $('#model').val();
            event.preventDefault();
            $('#tablesearchtask').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // // "scrollX": true,
                // "scrollY": true,
                "ordering": true,
                // "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('spk/booking/CariDataTask'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_jasa",
                        field: {
                            kode: "kode",
                            nama: "nama"
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
            $('#kode').val(result.trim());
            DataTask(result.trim());
        });


        function DataTask(kode) {
            var model = $('#model').val();
            $.ajax({
                url: "<?php echo base_url('spk/booking/GetDataTask'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    model: model
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama').val(data[i].nama.trim());
                        $('#harga').val(formatRupiah(data[i].frt.trim(), ''));
                        $('#total').val(formatRupiah(data[i].harga.trim(), ''));
                        $('#jenisdetail').val(data[i].kategori.trim());
                        $('#qty').val(data[i].jam.trim());
                        $('#jenis_detail').val(2);
                    }
                }
            });
        };

        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
        });

        //--------------------- Look up Regular Check ------------------------------

        document.getElementById("cariregular").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchregular').DataTable({
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
                    "url": "<?php echo base_url('spk/booking/Cariregularcheck'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_regularchecklist",
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

        $(document).on('click', ".searchrc", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/booking/Getregularcheck'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#koderegular').val(data[i].kode.trim());
                        $('#namaregular').val(data[i].nama.trim());
                        DetailRegularCheck(data[i].kode.trim());
                    }
                }
            }, false);
        });
        // ---------- ON JENIS TABLE ------------------------------------
        document.getElementById("jenis_detail").addEventListener("change", function(event) {
            event.preventDefault();
            var jenis = $("#jenis_detail").val();

            if (jenis == 1) {
                $("#caritask").hide();
                $("#cariparts").show();
                $('#satuan').show();
                $('#satuan').val("");
                $('#qty').val("0");
                $('#kode').val("");
                $('#nama').val("");
                $('#harga').val("0");
                $('#total').val("0");
                $("#jenisdetail").val("");
                $("#detailkategori").val("")

                document.getElementById('qty').readOnly = false;
            } else if (jenis == 2) {
                $("#caritask").show();
                $("#cariparts").hide();
                $('#satuan').val("");
                $('#satuan').hide();
                $('#qty').val("0");
                $('#kode').val("");
                $('#nama').val("");
                $('#harga').val("0");
                $('#total').val("0");
                $("#jenisdetail").val("");
                $("#detailkategori").val("")
                document.getElementById('qty').readOnly = false;
            } else {
                $("#caritask").hide();
                $("#cariparts").hide();
                $('#satuan').hide();
            }

        });
        // ---------- ADD DETAIL TABLE ----------------------------------
        $("#add_detail").click(function() {
            if ($('#jenis_detail').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Detail Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#jenis_detail').focus();

            } else if ($('#jenis_detail').val() == 1) {
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
                    $('#cariparts').focus();
                } else if ($('#qty').val() == 0 || $('#qty').val() == '') {
                    $.alert({
                        title: 'Info..',
                        content: 'Isi Qty Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    // alert('Pilih personil terlebih dahulu');
                    $('#qty').focus();
                } else if ($('#total').val() == 0 || $('#total').val() == '') {
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
                    // alert('Pilih personil terlebih dahulu');
                    $('#total').focus();
                } else if ($('#detailkategori').val() == '' || $('#jenisdetail').val() == '') {
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
                    var jenis = $("#jenis_detail").val();
                    var kode = $("#kode").val();
                    var nama = $("#nama").val();
                    var harga = $("#harga").val();
                    var kategori = $("#detailkategori").val();
                    var qty = $("#qty").val();
                    var total = $("#total").val();

                    if (ValidasiAdd() == "sukses") {
                        insertdetail(kode, nama, kategori, jenis, qty, harga, total, "")
                        $("#kode").val("");
                        $("#nama").val("");
                        $("#harga").val("0");
                        $("#qty").val("0");
                        $("#detailkategori").val("");
                        $("#jenisdetail").val("");
                        $('#jenis_detail').val(0);
                        $("#total").val("0");
                        $("#cariparts").hide();
                        $('#satuan').hide();
                        // document.getElementById('total').disabled = true
                    }
                }

            } else if ($('#jenis_detail').val() == 2) {
                if ($('#kode').val() == '' || $('#nama').val() == '') {
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
                    $('#caritask').focus();
                } else if ($('#qty').val() == 0 || $('#qty').val() == '') {
                    $.alert({
                        title: 'Info..',
                        content: 'Isi Qty Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    // alert('Pilih personil terlebih dahulu');
                    $('#qty').focus();
                } else if ($('#detailkategori').val() == '' || $('#jenisdetail').val() == '') {
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
                    var jenis = $("#jenis_detail").val();
                    var kode = $("#kode").val();
                    var nama = $("#nama").val();
                    var kategori = $("#detailkategori").val();
                    var harga = $("#harga").val();
                    var qty = $("#qty").val();
                    var total = $("#total").val();

                    insertdetail(kode, nama, kategori, jenis, qty, harga, total, "")
                    $("#kode").val("");
                    $("#nama").val("");
                    $("#detailkategori").val("");
                    $("#harga").val("0");
                    $("#qty").val("0");
                    $("#jenisdetail").val("");
                    $('#jenis_detail').val(0);
                    $("#total").val("0");
                    $('#satuan').hide();
                    $("#caritask").hide();
                    // document.getElementById('total').disabled = true
                }

            }
        });

        $("#edit_detail").click(function() {
            if ($('#jenis_detail').val() == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Detail Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#jenis_detail').focus();

            } else if ($('#jenis_detail').val() == 1) {
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
                    $('#cariparts').focus();
                } else {
                    var jenis = $("#jenis_detail").val();
                    var kode = $("#kode").val();
                    var nama = $("#nama").val();
                    var kategori = $("#detailkategori").val();
                    var harga = $("#harga").val();
                    var qty = $("#qty").val();
                    var total = $("#total").val();

                    _row.closest("tr").find("td").remove();

                    insertdetail(kode, nama, kategori, jenis, harga, qty, total, "")
                    $("#kode").val("");
                    $("#nama").val("");
                    $("#harga").val("0");
                    $("#qty").val("0");
                    $('#jenis_detail').val(0);
                    $("#total").val("0");
                    $("#detailkategori").val("");
                    $("#cariparts").hide();
                    $('#satuan').hide();

                    document.getElementById('jenis_detail').disabled = false;
                    document.getElementById('add_detail').disabled = false;
                    document.getElementById('edit_detail').disabled = true;
                }

            } else if ($('#jenis_detail').val() == 2) {
                if ($('#kode').val() == '' || $('#nama').val() == '') {
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
                    $('#caritask').focus();
                } else {
                    var jenis = $("#jenis_detail").val();
                    var kode = $("#kode").val();
                    var kategori = $("#detailkategori").val();
                    var nama = $("#nama").val();
                    var harga = $("#harga").val();
                    var qty = $("#qty").val();
                    var total = $("#total").val();

                    _row.closest("tr").find("td").remove();

                    insertdetail(kode, nama, kategori, jenis, harga, qty, total, "")
                    $("#kode").val("");
                    $("#nama").val("");
                    $("#detailkategori").val("");
                    $("#harga").val("0");
                    $("#qty").val("0");
                    $('#jenis_detail').val(0);
                    $("#total").val("0");
                    $("#jenisdetail").val("");
                    $("#cariparts").hide();
                    $('#satuan').hide();

                    document.getElementById('jenis_detail').disabled = false;
                    document.getElementById('add_detail').disabled = false;
                    document.getElementById('edit_detail').disabled = true;
                }

            }
        });

        function inserttable(kode_referensi, nama_referensi, jenis, qty, harga, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode + '">' +
                '<td style="display:none;"></td>' +
                '<td>' + kode_referensi + '</td>' +
                '<td>' + nama_referensi + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + subtotal + '</td>' +
                '<td>' +
                '<button data-table="' + kode + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildataspk').append(row);


        }

        function inserttable(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode_referensi + '">' +
                '<td style="display:none;"></td>' +
                '<td>' + kode_referensi + '</td>' +
                '<td>' + nama_referensi + '</td>' +
                '<td>' + kategori + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + subtotal + '</td>' +
                '<td>' +
                '<button data-table="' + kode_referensi + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildataspk').append(row);

        }

        function insertdetail(kode, nama, kategori, jenis, qty, harga, total, find) {
            var row = "";
            if (jenis == 1) {
                row =
                    '<tr id="' + kode + '">' +
                    '<td style="display:none;"></td>' +
                    '<td>' + kode + '</td>' +
                    '<td>' + nama + '</td>' +
                    '<td>' + kategori + '</td>' +
                    '<td>' + jenis + '</td>' +
                    '<td>' + qty + '</td>' +
                    '<td>' + harga + '</td>' +
                    '<td>' + total + '</td>' +
                    '<td>' +
                    '<button data-table="' + kode + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                    // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                    '</td>' +
                    '</tr>';
                $('#detaildataspk').append(row);
                // $('#detaildataparts').append(row);
                subtotal();
                PPN();
                Grandtotal();

            } else if ((jenis == 2)) {
                row =
                    '<tr id="' + kode + '">' +
                    '<td style="display:none;"></td>' +
                    '<td>' + kode + '</td>' +
                    '<td>' + nama + '</td>' +
                    '<td>' + kategori + '</td>' +
                    '<td>' + jenis + '</td>' +
                    '<td>' + qty + '</td>' +
                    '<td>' + harga + '</td>' +
                    '<td>' + total + '</td>' +
                    '<td>' +
                    '<button data-table="' + kode + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                    // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                    '</td>' +
                    '</tr>';
                $('#detaildataspk').append(row);
                // $('#detaildatatask').append(row);
                subtotal();
                PPN();
                Grandtotal();
            }
            TotalParts();
            //TotalTask();
        }

        function subtotal() {
            var table = document.getElementById('detailspk');
            var total = 0;
            if (table.rows.length == 1) {
                $("#dpp").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#dpp").val(formatRupiah(total.toString(), ''));

                    }
                }
            }
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

        function TotalParts() {
            var table = document.getElementById('detailspk');
            var total = 0;
            var total2 = 0;
            if (table.rows.length == 1) {
                $("#total_sparepart").val("0");
                $("#total_jasa").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var jn = 0;
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 6 && table.rows[r].cells[3].innerHTML == 1) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#total_sparepart").val(formatRupiah(total.toString(), ''));
                    } else if (c == 6 && (table.rows[r].cells[3].innerHTML == 2 || table.rows[r].cells[3].innerHTML == 3)) {
                        total2 = total2 + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#total_jasa").val(formatRupiah(total2.toString(), ''));
                    }
                }
            }
        }

        // function TotalTask(){
        //     var table = document.getElementById('detailtask');
        //     var total = 0;
        //     if (table.rows.length == 1){
        //         $("#total_jasa").val("0");
        //     }
        //     for (var r = 1, n = table.rows.length; r < n; r++) {
        //         var string ="";
        //         for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
        //             if (c==6) {
        //                 total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",","").replace(",","").replace(",","").replace(",",""))
        //                 $("#total_jasa").val(formatRupiah(total.toString(),''));

        //             }
        //         }
        //     }
        // }

        function cleardetail() {
            $('#detaildataspk').empty();
        }

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildataspk');
            TotalParts();
            // TotalTask();
            subtotal();
            PPN();
            Grandtotal();
        });

        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kode = _row.closest("tr").find("td:eq(2)").text();
            var nama = _row.closest("tr").find("td:eq(3)").text();
            var jenis = _row.closest("tr").find("td:eq(4)").text();
            var qty = _row.closest("tr").find("td:eq(5)").text();
            var harga = _row.closest("tr").find("td:eq(6)").text();
            var subtotal = _row.closest("tr").find("td:eq(7)").text();
            $('#kode').val(kode);
            $('#nama').val(nama);
            $('#jenis_detail').val(jenis);
            $('#qty').val(qty);
            $('#harga').val(harga);
            $('#total').val(subtotal);

            document.getElementById('jenis_detail').disabled = true;
            document.getElementById('add_detail').disabled = true;
            document.getElementById('edit_detail').disabled = false;
            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        function ambildatadetail() {
            var table = document.getElementById('detailspk');
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

        $("#qty").keypress(function(data) {
            return angka(data);
        });

        $("#qty").keyup(function() {
            var qty = this.value;
            return HitungTotal();
        });

        function HitungTotal() {
            var qty = $('#qty').val();
            var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total').val(formatRupiah(total.toString(), ''));
        }
        // ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var nopolisi = $('#nopolisi').val();
            var nomorcustomer = $('#nocustomer').val();
            var namacustomer = $('#namacustomer').val();
            var returnjob = $("input[name='returnjob']:checked").val();
            var inventaris = $("input[name='inventaris']:checked").val();
            var jenisservice = $('#jenis').val();
            var tanggal = $('#tanggal').val();
            var pic = $('#pic').val();
            var nohppic = $('#nohp').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var totalpart = $('#total_sparepart').val();
            var totaljasa = $('#total_jasa').val();
            var keluhan = $('#keluhan').val();
            var kodetipe = $('#kodetipe').val();
            var namatipe = $('#namatipe').val();
            var model = $('#model').val();
            var kodecabang = $('#scabang').val();
            var koderegular = $('#koderegular').val();
            var namaregular = $('#namaregular').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/booking/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nopolisi: nopolisi,
                        nomorcustomer: nomorcustomer,
                        namacustomer: namacustomer,
                        returnjob: returnjob,
                        inventaris: inventaris,
                        jenisservice: jenisservice,
                        tanggal: tanggal,
                        pic: pic,
                        nohppic: nohppic,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        totalpart: totalpart,
                        totaljasa: totaljasa,
                        keluhan: keluhan,
                        kodecabang: kodecabang,
                        kodetipe: kodetipe,
                        namatipe: namatipe,
                        model: model,
                        namaregular: namaregular,
                        koderegular: koderegular,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        detailspk: datadetail
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
                            $('#nomor').val(data.nomor);
                            TurnDisable();
                            window.open(
                                "<?php echo base_url('form/form/cetak_booking/') ?>" + data.nomor
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
        // ---------- ON BUTTON FIND ---------------------------------------------
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
                    "url": "<?php echo base_url('spk/booking/CariDataFind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_bookingservice",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer"
                        },
                        value: values
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchok", function() {
            BersihkanLayarBaru();
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/booking/Find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].nama_customer.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        if (data[i].returnjob == 't') {
                            $('input:radio[name="returnjob"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="returnjob"][value="false"]').prop('checked', true);
                        }
                        if (data[i].inventaris == 't') {
                            $('input:radio[name="inventaris"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="inventaris"][value="false"]').prop('checked', true);
                        }
                        $('#jenis').val(data[i].jenisservice.trim());
                        $('#tanggal').val(formatDate(data[i].tanggalbooking));
                        $('#pic').val(data[i].pic.trim());
                        $('#nohp').val(data[i].nohppic.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim(), ''));
                        $('#total_sparepart').val(formatRupiah(data[i].totalpart.trim(), ''));
                        $('#total_jasa').val(formatRupiah(data[i].totaljasa.trim(), ''));
                        $('#scabang').val(data[i].kode_cabang.trim());
                        $('#subcabang').val(data[i].kodesubcabang.trim());
                        $('#kodetipe').val(data[i].kodetipe.trim());
                        $('#namatipe').val(data[i].namatipe.trim());
                        $('#model').val(data[i].model.trim());
                        FindDataDetail(data[i].nomor.trim());
                        if (data[i].status != '0') {
                            document.getElementById('update').disabled = true;
                            document.getElementById('cancel').disabled = true;
                        }
                        $('#koderegular').val(data[i].kode_regularcheck.trim());
                        $('#namaregular').val(data[i].nama_regularcheck.trim());
                    }
                    FindDisable();
                }
            }, false);
        });
        // -- END FIND --


        // ---------- ON BUTTON UPDATE ---------------------------------------------
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var returnjob = $("input[name='returnjob']:checked").val();
            var inventaris = $("input[name='inventaris']:checked").val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var tanggalbooking = $('#tanggal').val();
            var totalpart = $('#total_sparepart').val();
            var totaljasa = $('#total_jasa').val();
            var koderegular = $('#koderegular').val();
            var namaregular = $('#namaregular').val();


            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/booking/Update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        returnjob: returnjob,
                        inventaris: inventaris,
                        tanggalbooking: tanggalbooking,
                        totalpart: totalpart,
                        totaljasa: totaljasa,
                        koderegular: koderegular,
                        namaregular: namaregular,
                        detailspk: datadetail
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
                                    url: "<?php echo base_url('spk/booking/Cancel'); ?>",
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
            }
        });

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_booking/') ?>" + nomor
            );
        });


        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('spk/booking/GetDataTipe'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode_tipe: kode_tipe
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#namatipe').val(data[i].nama.trim());
                        $('#model').val(data[i].kodekategori.trim());
                    }
                }
            });
        };

        // ---------- ON LOOKUP TIPE ----------------------------------------
        document.getElementById("caritipe").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchtipe').DataTable({
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
                    "url": "<?php echo base_url('spk/booking/CariDataTipe'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_tipe",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            kodekategori: "kodekategori"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            kodekategori: "kodekategori"
                        },
                        value: "aktif = true"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchtipe", function() {
            var result = $(this).attr("data-id");
            $('#kodetipe').val(result.trim());
            DataTipe(result.trim());
        });


    });
</script>