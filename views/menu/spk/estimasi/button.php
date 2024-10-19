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
            return day + ' ' + month + ' ' + year;
        }

        // ------------- Otorisasi Pembatalan -------------
        <?php

        $grup = $this->session->userdata('mygrup');
        $nama_menu = 'Entry Data Kendaraan';

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
        // console.log(getppn);
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
            $('#nomor').val("WE-" + kode_cabang + "-" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            // $("#tanggal").prop("disabled", true);
            $('#nomorsn').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#pic').val("");
            $("#nocustomer").val("");
            $("#namacustomer").val("");
            $('#nohp').val("");
            $('#keluhan').val("");
            $('#jenis').val("-");

            $('#jenis_detail').val("-");
            $('#kode_part').val("");
            $('#kode_jasa').val("");
            $('#kode_opl').val("");
            $('#nama_part').val("");
            $('#nama_jasa').val("");
            $('#nama_opl').val("");
            $('#qty_part').val("0");
            $('#qty_jasa').val("0");
            $('#qty_opl').val("0");
            $('#harga_part').val("0");
            $('#harga_jasa').val("0");
            $('#harga_opl').val("0");
            $('#grandtotal').val("0");
            $('#keterangan').val("");
            $("#jenisdetail").val("");
            $("#detailkategori").val("");
            $('#koderegular').val("");
            $('#namaregular').val("");
            $('#total_jasa').val("0");
            $('#total_sparepart').val("0");
            $('#total_opl').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#satuan').val("");
            $('#jenis').val("-");
            $('#total_sparepart').val(0);
            $('#total_jasaa').val(0);
            $('#totall_opl').val(0);
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);
            // $("#caritask").hide();
            // $("#cariparts").hide();
            // $("#cariopl").hide();
            $('#satuan').hide();
            $("#edit_detail").hide();
            $("#nonreturnjob").prop("checked", "false");
            $("#nonwarranty").prop("checked", "false");
            $("#noninventaris").prop("checked", "false");
            // $('#detaildataparts').empty();
            // $('#detaildatatask').empty();
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildataopl').empty();
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;

            $('#nomorsn').prop("disabled", false);
            $('#nomorsn').prop("readOnly", false);
            // document.getElementById('nomorsn').disabled = false;
            document.getElementById('nama_part').disabled = true
            document.getElementById('nama_jasa').disabled = true
            document.getElementById('nama_opl').disabled = true
            document.getElementById('total_part').disabled = true
            document.getElementById('total_jasa').disabled = true
            document.getElementById('total_opl').disabled = true
            document.getElementById('namacustomer').readOnly = true;
            document.getElementById('keluhan').readOnly = false;
            document.getElementById('jenisdetail_part').disabled = false;
            document.getElementById('jenisdetail_jasa').disabled = false;
            document.getElementById('jenisdetail_opl').disabled = false;
            document.getElementById('returnjob').disabled = false;
            document.getElementById('inventaris').disabled = false;
            document.getElementById('noninventaris').disabled = false;
            document.getElementById('nonreturnjob').disabled = false;
            document.getElementById('pic').disabled = false;
            document.getElementById('nohp').disabled = false;
            loadppnkonfigurasi();
        };
        $("#loading").hide();
        BersihkanLayarBaru();
        getdatakendaraan($('#nopolisi').val());
        $('#tablesearchtampil').css('visibility', 'hidden');



        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#nomorsn').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nomor SN Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carisn').focus();
                var result = false;
            } else if ($('#kode_tipe').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Tipe Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caritipe').focus();
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
            } else if ($('#nocustomer').val() == '' || $('#namacustomer').val() == '' || $('#pic').val() == '' || $('#nohp').val() == '' || $('#nohp').val() == 0) {
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
            } else {
                var result = true;
            }
            return result;
        };

        // ---------- FIND Data ----------------------------------------

        function getdatakendaraan(nopol) {
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/getdatamobil'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopol: nopol
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#norangka').val(data[i].norangka.trim());
                        $('#kode_tipe').val(data[i].kodetipe.trim());
                        $('#nama_tipe').val(data[i].namatipe.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].nama.trim());
                        $('#pic').val(data[i].namapic.trim());
                        $('#nohp').val(data[i].nohppic.trim());
                        $('#odemeter').val(data[i].odmeterakhir.trim());
                        $('#model').val(data[i].model.trim());
                    }
                }
            });
        };

        function DataCustomer(nocustomer) {
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/GetDataCustomer'); ?>",
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

        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/GetDataTipe'); ?>",
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

        function TurnDisable() {
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
            document.getElementById('cancel').disabled = false;
            document.getElementById('namacustomer').readOnly = true;
            document.getElementById('jenis').disabled = true;
            document.getElementById('returnjob').disabled = true;
            document.getElementById('inventaris').disabled = true;
            document.getElementById('noninventaris').disabled = true;
            document.getElementById('nonreturnjob').disabled = true;
            document.getElementById('warranty').disabled = true;
            document.getElementById('nonwarranty').disabled = true;
            document.getElementById('pic').disabled = true;
            document.getElementById('nohp').disabled = true;
        };

        function FindDisable() {
            document.getElementById('save').disabled = true;
            // document.getElementById('update').disabled = false;
            // document.getElementById('cancel').disabled = false;
            document.getElementById('namacustomer').readOnly = true;
            document.getElementById('jenis').disabled = true;
            document.getElementById('returnjob').disabled = false;
            document.getElementById('inventaris').disabled = false;
            document.getElementById('noninventaris').disabled = false;
            document.getElementById('nonreturnjob').disabled = false;
            document.getElementById('warranty').disabled = false;
            document.getElementById('nonwarranty').disabled = false;
            document.getElementById('pic').disabled = true;
            document.getElementById('nohp').disabled = true;
        };

        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/FindDetail'); ?>",
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
                        if (jenis == '1') {
                            insertdetailparts(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '2') {
                            insertdetailjasa(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        } else if (jenis == '3') {
                            insertdetailopl(kode_referensi, nama_referensi, kategori, jenis, qty, harga, subtotal, "");
                        }



                    }
                }
            });
        };

        function DetailRegularCheck(kode) {
            var kodemodel = $('#model').val();
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/GetDataRegularDetail'); ?>",
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
        // ----------END FIND Data ----------------------------------------

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
                    "url": "<?php echo base_url('spk/estimasi/CariDataParts'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            hargajual: "hargajual",
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
            $('#kode_part').val(result.trim());
            DataParts(result.trim());
            // DataDetail(result.trim());
        });

        function DataParts(kode) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/GetDataParts'); ?>",
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
                        $('#nama_part').val(data[i].nama.trim());
                        $('#jenisdetail_part').val(data[i].kategoripart.trim());
                        $('#satuan_part').val(data[i].satuan.trim());
                        // $('#jenis_detail').val(1);
                        $('#harga_part').val(formatRupiah(data[i].hargajual.trim(), ''));
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

        $("#qty_part").keypress(function(data) {
            return angka(data);
        });

        $("#qty_part").keyup(function() {
            var qty = this.value;
            return HitungTotalPart();
        });

        function HitungTotalPart() {
            var qty_part = $('#qty_part').val();
            var harga_part = $('#harga_part').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total_part = parseFloat(harga_part.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty_part.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total_part').val(formatRupiah(total_part.toString(), ''));
        }



        function ValidasiAddParts() {
            var kode = $("#kode_part").val();
            var table = document.getElementById('detailsparepart');
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

        // ---------- ADD DETAIL TABLE SPAREPART ----------------------------------
        $("#add_detailpart").click(function() {
            if ($('#kode_part').val() == '' || $('#nama_part').val() == '') {
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
            } else if ($('#qty_part').val() == 0 || $('#qty_part').val() == '') {
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
                $('#qty_part').focus();
            } else if ($('#total_part').val() == 0 || $('#total_part').val() == '') {
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
                $('#total_part').focus();
            } else if ($('#detailkategori_part').val() == '' || $('#jenisdetail_part').val() == '') {
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
                $('#detailkategori_part').focus();
            } else {
                var jenisdetail_part = $("#jenisdetail_part").val();
                var kode_part = $("#kode_part").val();
                var nama_part = $("#nama_part").val();
                var harga_part = $("#harga_part").val();
                var kategori_part = $("#detailkategori_part").val();
                var qty_part = $("#qty_part").val();
                var total_part = $("#total_part").val();

                if (ValidasiAddParts() == "sukses") {
                    insertdetailparts(kode_part, nama_part, kategori_part, jenisdetail_part, qty_part, harga_part, total_part, "")
                    $("#kode_part").val("");
                    $("#nama_part").val("");
                    $("#harga_part").val("0");
                    $("#qty_part").val("0");
                    $("#detailkategori_part").val("");
                    $("#jenisdetail_part").val("");
                    $('#jenis_detailpart').val(0);
                    $("#total_part").val("0");
                    // $("#cariparts").hide();
                    // $('#satuan_part').hide();
                    document.getElementById('total_part').disabled = true
                }
            }
        });


        function insertdetailparts(kode, nama, kategori, jenis, qty, harga, total, find) {
            var row = "";
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
                '<button data-table="' + kode + '" class="hapus_part btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#detaildataparts').append(row);
            subtotal();
            PPN();
            Grandtotal();
            HitungTotalParts();
        }

        $(document).on('click', '.hapus_part', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            // var table_part = document.getElementById('detailsparepart');
            HitungTotalPart();
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


        function HitungTotalParts() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#total_sparepart").val("0");
                $("#summarytotal_sparepart").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[7].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                }

                $("#total_sparepart").val(formatRupiah(total.toString(), ''));
                $("#summarytotal_sparepart").val(formatRupiah(total.toString(), ''));
            }
        }


        // ---------------------------------------- ON LOOKUP TASK ------------------------------------
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
                    "url": "<?php echo base_url('spk/estimasi/CariDataTask'); ?>",
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
            $('#kode_jasa').val(result.trim());
            DataTask(result.trim());
        });


        function DataTask(kode) {
            var model = $('#model').val();
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/GetDataTask'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    model: model
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].nama.trim() == '') {
                            document.getElementById('nama_jasa').disabled = false
                            document.getElementById('total_jasa').disabled = false
                        } else {
                            $('#nama_jasa').val(data[i].nama.trim());
                            document.getElementById('nama_jasa').disabled = true
                            document.getElementById('total_jasa').disabled = false
                        }
                        $('#harga_jasa').val(formatRupiah(data[i].frt.trim(), ''));
                        $('#jenisdetail_jasa').val(data[i].kategori.trim());
                        $('#qty_jasa').val(data[i].jam.trim());
                        $('#total_jasa').val(formatRupiah(data[i].harga.trim(), ''));
                        // $('#jenis_detailjasa').val(2);
                    }
                }
            });
        };


        $("#qty_jasa").keypress(function(data) {
            return angka(data);
        });

        $("#qty_jasa").keyup(function() {
            var qty = this.value;
            return HitungTotaljasa();
        });

        function HitungTotaljasa() {
            var qty_jasa = $('#qty_jasa').val();
            var harga_jasa = $('#harga_jasa').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total_jasa = parseFloat(harga_jasa.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty_jasa.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total_jasa').val(formatRupiah(total_jasa.toString(), ''));
        }




        function ValidasiAddJasa() {
            var kode = $("#kode_jasa").val();
            var table = document.getElementById('detailjasa');
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

        // ---------- ADD DETAIL TABLE JASA ----------------------------------
        $("#add_detailjasa").click(function() {
            if ($('#kode_jasa').val() == '' || $('#nama_jasa').val() == '') {
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
            } else if ($('#qty_jasa').val() == 0 || $('#qty_jasa').val() == '') {
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
                $('#qty_jasa').focus();
            // } else if ($('#total_jasa').val() == 0 || $('#total_jasa').val() == '') {
            //     $.alert({
            //         title: 'Info..',
            //         content: 'Total Tidak Boleh Kosong',
            //         buttons: {
            //             formSubmit: {
            //                 text: 'OK',
            //                 btnClass: 'btn-red'
            //             }
            //         }
            //     });
            //     // alert('Pilih personil terlebih dahulu');
            //     $('#total_jasa').focus();
            } else if ($('#detailkategori_jasa').val() == '' || $('#jenisdetail_jasa').val() == '') {
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
                $('#detailkategori_jasa').focus();
            } else {
                var jenisdetail_jasa = $("#jenisdetail_jasa").val();
                var kode_jasa = $("#kode_jasa").val();
                var nama_jasa = $("#nama_jasa").val();
                var harga_jasa = $("#harga_jasa").val();
                var kategori_jasa = $("#detailkategori_jasa").val();
                var qty_jasa = $("#qty_jasa").val();
                var total_jasa = $("#total_jasa").val();

                if (ValidasiAddJasa() == "sukses") {
                    insertdetailjasa(kode_jasa, nama_jasa, kategori_jasa, jenisdetail_jasa, qty_jasa, harga_jasa, total_jasa, "")
                    $("#kode_jasa").val("");
                    $("#nama_jasa").val("");
                    $("#harga_jasa").val("0");
                    $("#qty_jasa").val("0");
                    $("#detailkategori_jasa").val("");
                    $("#jenisdetail_jasa").val("");
                    $('#jenis_detailjasa').val(0);
                    $("#total_jasa").val("0");
                    // $("#caritask").hide();
                    // $('#satuan_jasa').hide();
                    document.getElementById('total_jasa').disabled = true
                }
            }
        });


        function insertdetailjasa(kode, nama, kategori, jenis, qty, harga, total, find) {
            var row = "";
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
                '<button data-table="' + kode + '" class="hapus_jasa btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatajasa').append(row);
            // $('#detaildataparts').append(row);
            subtotal();
            PPN();
            Grandtotal();
            HitungTotalJasa();
        }

        $(document).on('click', '.hapus_jasa', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            // var table_part = document.getElementById('detailsparepart');
            // TotalParts();
            //TotalTask();
            HitungTotalJasa();
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


        function HitungTotalJasa() {
            var table = document.getElementById('detailjasa');
            var total = 0;
            var total_opl = $('#totall_opl').val();
            if (table.rows.length == 1) {
                $("#total_jasaa").val("0");
                $("#summarytotal_jasa").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[7].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                    totalsummary = parseInt(total) + parseInt(total_opl.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                }

                $("#total_jasaa").val(formatRupiah(total.toString(), ''));
                $("#summarytotal_jasa").val(formatRupiah(totalsummary.toString(), ''));
            }
        }


        // ------------------------------------ ON LOOKUP OPL ------------------------------------
        document.getElementById("cariopl").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchopl').DataTable({
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
                    "url": "<?php echo base_url('spk/estimasi/CariDataOPL'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_jasaopl",
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

        $(document).on('click', ".searchopl", function() {
            var result = $(this).attr("data-id");
            $('#kode_opl').val(result.trim());
            DataOPL(result.trim());
        });


        function DataOPL(kode) {
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/GetDataOPL'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_opl').val(data[i].nama.trim());
                        $('#qty_opl').val(1);
                        $('#harga_opl').val(formatRupiah(data[i].hargajual.trim(), ''));
                        $('#total_opl').val(formatRupiah(data[i].hargajual.trim(), ''));
                        // $('#jenis_detailopl').val(3);
                    }
                    $('#qty_opl').prop('disabled', true);
                }
            });
        };


        function ValidasiAddOPL() {
            var kode = $("#kode_opl").val();
            var table = document.getElementById('detailopl');
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

        // ---------- ADD DETAIL TABLE JASA ----------------------------------
        $("#add_detailopl").click(function() {
            if ($('#kode_opl').val() == '' || $('#nama_opl').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih opl terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#caritask').focus();
            } else if ($('#qty_opl').val() == 0 || $('#qty_opl').val() == '') {
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
                $('#qty_opl').focus();
            } else if ($('#total_opl').val() == 0 || $('#total_opl').val() == '') {
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
                $('#total_opl').focus();
            } else if ($('#detailkategori_opl').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Detail Kategori Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                // alert('Pilih personil terlebih dahulu');
                $('#detailkategori_opl').focus();
            } else {
                var jenisdetail_opl = $("#jenisdetail_opl").val();
                var kode_opl = $("#kode_opl").val();
                var nama_opl = $("#nama_opl").val();
                var harga_opl = $("#harga_opl").val();
                var kategori_opl = $("#detailkategori_opl").val();
                var qty_opl = $("#qty_opl").val();
                var total_opl = $("#total_opl").val();

                if (ValidasiAddOPL() == "sukses") {
                    insertdetailopl(kode_opl, nama_opl, kategori_opl, jenisdetail_opl, qty_opl, harga_opl, total_opl, "")
                    $("#kode_opl").val("");
                    $("#nama_opl").val("");
                    $("#harga_opl").val("0");
                    $("#qty_opl").val("0");
                    $("#detailkategori_opl").val("");
                    $("#jenisdetail_opl").val("");
                    $('#jenis_detailopl').val(0);
                    $("#total_opl").val("0");
                    // $("#caritask").hide();
                    // $('#satuan_opl').hide();
                    document.getElementById('total_opl').disabled = true
                }
            }
        });


        function insertdetailopl(kode, nama, kategori, jenis, qty, harga, total, find) {
            var row = "";
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
                '<button data-table="' + kode + '" class="hapus_opl btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildataopl').append(row);
            // $('#detaildataparts').append(row);
            HitungTotalOPL();
            subtotal();
            PPN();
            Grandtotal();
        }

        $(document).on('click', '.hapus_opl', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            // var table_part = document.getElementById('detailsparepart');
            HitungTotalOPL();
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


        function HitungTotalOPL() {
            var table = document.getElementById('detailopl');
            var total = 0;
            var total_jasaa = $('#total_jasaa').val();
            if (table.rows.length == 1) {
                $("#totall_opl").val("0");
                $("#summarytotal_jasa").val("0");
            } else {
                for (var r = 1, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[7].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    totalsummary = parseInt(total) + parseInt(total_jasaa.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                }

                $("#totall_opl").val(formatRupiah(total.toString(), ''));
                $("#summarytotal_jasa").val(formatRupiah(totalsummary.toString(), ''));
            }
        }

        function subtotal() {
            var tablepart = document.getElementById('detailsparepart');
            var tablejasa = document.getElementById('detailjasa');
            var tableopl = document.getElementById('detailopl');
            var dpp_part = 0;
            var dpp_jasa = 0;
            var dpp_opl = 0;
            if (tablepart.rows.length == 1 && tablejasa.rows.length == 1 && tableopl.rows.length == 1) {
                $("#dpp").val("0");
            }
            for (var r = 1, n = tablepart.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tablepart.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        dpp_part = dpp_part + parseInt((tablepart.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            for (var r = 1, n = tablejasa.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tablejasa.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        dpp_jasa = dpp_jasa + parseInt((tablejasa.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            for (var r = 1, n = tableopl.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = tableopl.rows[r].cells.length; c < m; c++) {
                    if (c == 7) {
                        dpp_opl = dpp_opl + parseInt((tableopl.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
                    }
                }
            }

            var dpp = parseInt(dpp_part) + parseInt(dpp_jasa) + parseInt(dpp_opl);
            $("#dpp").val(formatRupiah(dpp.toString(), ''));
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


        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            //BersihkanLayarBaru();      
            location.reload(true);
        });

        function ambildatadetailPart() {
            var table = document.getElementById('detailsparepart');
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

        function ambildatadetailJasa() {
            var table = document.getElementById('detailjasa');
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

        function ambildatadetailOPL() {
            var table = document.getElementById('detailopl');
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

        // $('#qty').on('change', function() {
        //     var harga = $('#harga').val().replace(",","").replace(",","").replace(",","").replace(",","");
        //     var qty = $('#qty').val();

        //     var hitungtotal = parseFloat(harga.replace(",","").replace(",","").replace(",","").replace(",","")) * parseFloat(qty.replace(",","").replace(",","").replace(",","").replace(",",""));
        //     $('#total').val(formatRupiah(hitungtotal.toString(),''));
        // });
        
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 && data.which != 46 || data.which > 57)) {
                return false;
            }
        };

        // --------------------------- SVAE ----------------------------------
        // ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetailpart = ambildatadetailPart();
            var datadetailjasa = ambildatadetailJasa();
            var datadetailopl = ambildatadetailOPL();
            var nomor = $('#nomor').val();
            var nopolisi = $('#nopolisi').val();
            var norangka = $('#norangka').val();
            var nomor_customer = $('#nocustomer').val();
            var tipe = $('#kode_tipe').val();
            var namatipe = $('#nama_tipe').val();
            var returnjob = $("input[name='returnjob']:checked").val();
            var inventaris = $("input[name='inventaris']:checked").val();
            var warranty = $("input[name='warranty']:checked").val();
            var jenisservice = $('#jenis').val();
            var tanggal = $('#tanggal').val();
            var keterangan = $('#keterangan').val();
            var pic = $('#pic').val();
            var nohppic = $('#nohp').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var totalpart = $('#summarytotal_sparepart').val();
            var totaljasa = $('#summarytotal_jasa').val();
            var keluhan = $('#keluhan').val();
            var odemeter = $('#odemeter').val();
            var kodecabang = $('#scabang').val();
            var koderegular = $('#koderegular').val();
            var namaregular = $('#namaregular').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/estimasi/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nopolisi: nopolisi,
                        norangka: norangka,
                        nomor_customer: nomor_customer,
                        tipe: tipe,
                        namatipe: namatipe,
                        returnjob: returnjob,
                        inventaris: inventaris,
                        jenisservice: jenisservice,
                        tanggal: tanggal,
                        keterangan: keterangan,
                        pic: pic,
                        nohppic: nohppic,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        totalpart: totalpart,
                        totaljasa: totaljasa,
                        keluhan: keluhan,
                        odemeter: odemeter,
                        kodecabang: kodecabang,
                        namaregular: namaregular,
                        koderegular: koderegular,
                        warranty: warranty,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        detailpart: datadetailpart,
                        detailjasa: datadetailjasa,
                        detailopl: datadetailopl,
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
                                "<?php echo base_url('form/form/cetak_estimasi/') ?>" + data.nomor
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
                    "url": "<?php echo base_url('spk/estimasi/CariDataFind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_estimasiwo",
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

        $(document).on('click', ".searchok", function() {
            BersihkanLayarBaru();
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/estimasi/Find'); ?>",
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
                        $('#norangka').val(data[i].norangka.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#keluhan').val(data[i].keluhan.trim());
                        $('#kode_tipe').val(data[i].tipe.trim());
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
                        if (data[i].warranty == 't') {
                            $('input:radio[name="warranty"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="warranty"][value="false"]').prop('checked', true);
                        }
                        $('#jenis').val(data[i].jenisservice.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#pic').val(data[i].pic.trim());
                        $('#nohp').val(data[i].nohppic.trim());
                        $('#scabang').val(data[i].kode_cabang.trim());
                        $('#odemeter').val(data[i].odemeter.trim());
                        $('#model').val(data[i].kodekategori.trim());
                        if (data[i].status != '0') {
                            document.getElementById('update').disabled = true;
                            document.getElementById('cancel').disabled = true;
                        } else {
                            document.getElementById('update').disabled = false;
                            document.getElementById('cancel').disabled = false;
                        }
                        $('#koderegular').val(data[i].kode_regularcheck.trim());
                        $('#namaregular').val(data[i].nama_regularcheck.trim());
                        DataCustomer(data[i].nomor_customer.trim());
                        DataTipe(data[i].tipe.trim());
                        FindDataDetail(data[i].nomor.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim(), ''));
                        $('#total_sparepart').val(formatRupiah(data[i].totalpart.trim(), ''));
                        $('#total_jasa').val(formatRupiah(data[i].totaljasa.trim(), ''));
                    }
                    FindDisable();
                }
            }, false);
            $('.popup7').css('visibility', 'hidden');
        });
        // -- END FIND --


        // ---------- ON BUTTON UPDATE ---------------------------------------------
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetailpart = ambildatadetailPart();
            var datadetailjasa = ambildatadetailJasa();
            var datadetailopl = ambildatadetailOPL();
            var nomor = $('#nomor').val();
            var returnjob = $("input[name='returnjob']:checked").val();
            var warranty = $("input[name='warranty']:checked").val();
            var inventaris = $("input[name='inventaris']:checked").val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var keterangan = $('#keterangan').val();
            var keluhan = $('#keluhan').val();
            var totalpart = $('#total_sparepart').val();
            var totaljasa = $('#total_jasa').val();
            var koderegular = $('#koderegular').val();
            var namaregular = $('#namaregular').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/estimasi/Update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        returnjob: returnjob,
                        keluhan: keluhan,
                        inventaris: inventaris,
                        keterangan: keterangan,
                        totalpart: totalpart,
                        totaljasa: totaljasa,
                        warranty: warranty,
                        koderegular: koderegular,
                        namaregular: namaregular,
                        detailpart: datadetailpart,
                        detailjasa: datadetailjasa,
                        detailopl: datadetailopl,
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
                                    url: "<?php echo base_url('spk/estimasi/Cancel'); ?>",
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
                "<?php echo base_url('form/form/cetak_estimasi/') ?>" + nomor
            );
        });

        //-------------------history SPK-------------------------------------
        document.getElementById("history").addEventListener("click", function(event) {
            event.preventDefault();
            var nopolisi = $('#nopolisi').val();
            $('#tablesearchspk').DataTable({
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
                    "url": "<?php echo base_url('spk/estimasi/historyspk'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "history_sn",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nama: "nama",
                            keluhan: "keluhan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nama: "nama",
                            keluhan: "keluhan"
                        },
                        value: "nopolisi = '" + nopolisi + "'"
                    },
                }
            });
        }, false);


        document.getElementById("close").addEventListener("click", function(event) {
            window.open("<?php echo base_url('main/entry_datakendaraan') ?>", "_self");
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
                    "url": "<?php echo base_url('spk/estimasi/Cariregularcheck'); ?>",
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
                url: "<?php echo base_url('spk/estimasi/Getregularcheck'); ?>",
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



        function cleardetail() {
            $('#detaildatasparepart').empty();
            $('#detaildatajasa').empty();
            $('#detaildatajasa').empty();
            // $('#detaildataparts').empty();
            // $('#detaildatatask').empty();
            // TotalParts();
            //TotalTask();
            subtotal();
            PPN();
            Grandtotal();
        }


        $("#total").keyup(function() {
            var total = this.value;
            return HitungTotal2();
        });

        $("#total").keypress(function(data) {
            return angka(data);
        });

        var total = document.getElementById('total');
        total.addEventListener('keyup', function(e) {
            total.value = formatRupiah(this.value, '');
            // hitungOngkos();
        });


        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildataspk');
            TotalParts();
            //TotalTask();
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


        function HitungTotal() {
            var qty = $('#qty').val();
            var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total').val(formatRupiah(total.toString(), ''));
        }

        function HitungTotal2() {
            var total = $('#total').val();
            var harga = $('#harga').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var qty = parseFloat(total.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) / parseFloat(harga.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            var qtys = parseFloat(qty).toFixed(2);
            $('#qty').val(formatRupiah(qtys.toString(), ''));
        }

    });
</script>