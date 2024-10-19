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
        $nama_menu = 'Ordering Sparepart';

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
            $('#kodesupplier').val("");
            $('#namasupplier').val("");
            $('#alamat').val("");
            $('#nomor').val("PO" + yr + mt + "00000");
            $('#tanggalorder').val(newDate);
            $('#kodesupplier').val("");
            $('#namasupplier').val("");
            $('#alamat').val("");
            $('#kodesparepart').val("");
            $('#satuan').val("");
            $('#namasparepart').val("");
            $('#hargasatuan').val("0");
            $('#qty').val("0");
            $('#total').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#grandtotal').val("0");
            $("#caricabang").hide();
            $("#nonjenis").prop("checked", "true");
            $('#keterangan').val("");
            $('#nomorestimasi').val("");
            $('#tglrealorder').val(newDate);
            $('#tanggalreal').datepicker({
                format: "dd MM yyyy",
                autoclose: true
            });
            $('#tanggalestimasidtng').val(newDate);
            $('#tglestimasidtng').datepicker({
                format: "dd MM yyyy",
                autoclose: true
            });
            $('#statusorder').val("-");
            document.getElementById('keterangan').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cariestimasi').disabled = false;
            document.getElementById('update').disabled = true;
            $('#detaildatasparepart').empty();
            loadppnkonfigurasi();
            getMinimStock();
        };
        BersihkanLayar();
        $("#loading").hide();
        $("input[name='jenis']").change(function() {
            if ($(this).val() == "true") {
                $("#carisupplier").hide();
                $("#caricabang").show();
                $('#kodesupplier').val("");
                $('#namasupplier').val("");
                $('#alamat').val("");
            } else if ($(this).val() == "false") {
                $("#carisupplier").show();
                $("#caricabang").hide();
                $('#kodesupplier').val("");
                $('#namasupplier').val("");
                $('#alamat').val("");
            }
        });

        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            var table = document.getElementById('detaildatasparepart');
            if ($('#kodesupplier').val() == '' || $('#namasupplier').val() == '') {
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
                $('#carisupplier').focus();
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
            } else if ($('#statusorder').val() == '-' || $('#statusorder').val() == '' || $('#statusorder').val() == undefined) {
                $.alert({
                    title: 'Info..',
                    content: 'Silakan Pilih Status Order!',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#statusorder').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };


        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('carisupplier').disabled = true;
            document.getElementById('carisparepart').disabled = true;
            document.getElementById('cariestimasi').disabled = true;
            document.getElementById('keterangan').disabled = true;
            document.getElementById('qty').disabled = true;
            document.getElementById('add-row').disabled = true;
            $('.hapus').prop("disabled", true);
        };

        function statusclose(status) {
            if (status == "t") {
                document.getElementById('cancel').disabled = true;
                document.getElementById('update').disabled = true;
            } else {
                document.getElementById('cancel').disabled = false;
                document.getElementById('update').disabled = false;
            }

        }

        function Supplier(kodesupplier) {
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/getdatasupplier'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kodesupplier: kodesupplier
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        // $('#nomoraccount').val(data[i].nomor.trim());                                                  
                        $('#namasupplier').val(data[i].nama.trim());
                        $('#alamat').val(data[i].alamat.trim());
                    }
                }
            });
        };


        function DataSparepart(kode, find) {
            var returnValue;
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/getdatasparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    kode: kode,
                    kode_cabang: kode_cabang,
                    kodecompany: kodecompany
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
            } else if ($('#hargasatuan').val() == 0 || $('#hargasatuan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Harga Beli Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#hargasatuan').focus();
                var result = false;
            } else {
                var kodesparepart = $("#kodesparepart").val();
                var namasparepart = $("#namasparepart").val();
                var hargasatuan = $("#hargasatuan").val();
                var qty = $("#qty").val();
                var total = $("#total").val();

                if (validasiadd() == "sukses") {
                    inserttable(kodesparepart, namasparepart, hargasatuan, qty, total, "")
                    $("#kodesparepart").val("");
                    $("#satuan").val("");
                    $("#namasparepart").val("");
                    $("#hargasatuan").val("0");
                    $("#qty").val("0");
                    $("#total").val("0");
                }
            }
        });

        function inserttable(kodesparepart, namasparepart, hargasatuan, qty, total, find) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + total + '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN();
            Grandtotal();
        }

        function inserttablefind(kodesparepart, namasparepart, hargasatuan, qty, total, find) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + total + '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            // subtotal();
            // PPN();
            // Grandtotal();
        }

        // $('div.jenis select').on('change', function() {
        //     $("#kodepersonil").val("");
        //     $("#namapersonil").val("");
        //     $("#ongkosharian").val("0");
        //     $("#ongkos").val("0");
        // });

        function validasiadd() {
            var kodesparepart = $("#kodesparepart").val();
            var table = document.getElementById('detailsparepart');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 0) {
                        if (table.rows[r].cells[c].innerHTML == kodesparepart) {
                            alert("data sudah pernah diinput")
                            return "gagal";
                        }
                    }
                }
            }
            return "sukses";
        }


        function subtotal() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#dpp").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 4) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#dpp").val(formatRupiah(total.toString(), ''));

                    }
                }
            }
        }

        function PPN() {
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

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detailsparepart');
            if (table.rows.length == 1) {
                document.getElementById('qty').disabled = false;
            }
            subtotal();
        });

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            return day + ' ' + month + ' ' + year;
        }

        function ambildatadetail(nomor) {

            // $("#cek").click(function(){
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
                //console.log(arr2);
            }
            return arr2;
        }


        function HitungTotal() {
            var qty = $('#qty').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total').val(formatRupiah(total.toString(), ''));
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

        $("#hargasatuan").keypress(function(data) {
            return angka(data);
        });

        $("#qty").keypress(function(data) {
            return angka(data);
        });

        $("#qty").keyup(function() {
            var qty = this.value;
            return HitungTotal();
        });

        var nominal = document.getElementById('hargasatuan');
        nominal.addEventListener('keyup', function(e) {
            nominal.value = formatRupiah(this.value, '');
        });

        // CARI DATA SUPPLIER
        document.getElementById("carisupplier").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchsupplier').DataTable({
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
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/caridatasupplier'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_supplier",
                        field: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        sort: "nomor,nama",
                        where: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        value: "aktif = true"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchsupplier", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/getdatasupplier'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodesupplier').val(data[i].nomor.trim());
                        $('#namasupplier').val(data[i].nama.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        $('#pkpsupplier').val(data[i].pkp.trim());
                    }
                }
            });
        });

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
                // // "scrollX": true,
                // "scrollY": true,
                // // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/caridatasparepart'); ?>",
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
                            lokasi: "lokasi",
                            keterangan: "keterangan"
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
                url: "<?php echo base_url('sparepart/ordering_sparepart/getdatasparepart'); ?>",
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
                        $('#hargasatuan').val(formatRupiah(data[i].hargabeli.trim(), ''));
                        $('#satuan').val(data[i].satuan.trim());
                        getMinStock(data[i].kode.trim());
                        // DataDetail(data[i].kode.trim());
                    }
                }
            });
        });

        // function DataDetail(kodepart) {
        //     var kode_cabang = $('#scabang').val();
        //     var kodecompany = $('#kodecompany').val();
        //     $("#hargasatuan").val("0");
        //     $('#qty').val("0");
        //     $('#total').val("0");
        //     $.ajax({
        //         url: "<?php echo base_url('masterdata/parts/GetDataPart'); ?>",
        //         method: "POST",
        //         dataType: "json",
        //         async: true,
        //         data: {
        //             kodepart: kodepart,
        //             kode_cabang: kode_cabang,
        //             kodecompany: kodecompany
        //         },
        //         success: function(data) {
        //             for (var i = 0; i < data.length; i++) {
        //                 $('#hargasatuan').val(formatRupiah(data[i].hargabeli.trim(), ''));
        //             }
        //         }
        //     });
        // };
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
            // ambildatadetail();
            var nomor = $('#nomor').val();
            var tanggalorder = $('.tanggalorder').val();
            var kodesupplier = $('#kodesupplier').val();
            var namasupplier = $('#namasupplier').val();
            var alamat = $('#alamat').val();
            // var tglestimasi = $('#tglestimasi').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var keterangan = $('#keterangan').val();
            var nomorestimasi = $('#nomorestimasi').val();
            var jenis = $("input[name='jenis']:checked").val();
            var tglrealorder = $('#tglrealorder').val();
            var statusorder = $('#statusorder').val();
            var tanggalestimasidtng = $('#tanggalestimasidtng').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/ordering_sparepart/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        tanggalorder: tanggalorder,
                        kodesupplier: kodesupplier,
                        namasupplier: namasupplier,
                        alamat: alamat,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        kodecabang: kodecabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        jenis: jenis,
                        keterangan: keterangan,
                        nomorestimasi: nomorestimasi,
                        tglrealorder: tglrealorder,
                        statusorder: statusorder,
                        tanggalestimasidtng: tanggalestimasidtng,
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
                            $('#nomor').val(data.nomor);
                            window.open(
                                "<?php echo base_url('form/form/cetak_orderpart/') ?>" + data.nomor
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

        // -- FIND --
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
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_orderingsparepart",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            namasupplier: "namasupplier",
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

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/find'); ?>",
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
                        $('#kodesupplier').val(data[i].kodesupplier.trim());
                        $('#namasupplier').val(data[i].namasupplier.trim());
                        $('#alamat').val(data[i].alamatsupplier.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim(), ''));
                        if (data[i].jenis == 't') {
                            $('input:radio[name="jenis"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="jenis"][value="false"]').prop('checked', true);
                        }
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#nomorestimasi').val(data[i].nomorestimasi.trim());
                        $('#tanggalestimasidtng').val(formatDate(data[i].tglestimasidtng.trim()));
                        $('#tglrealorder').val(formatDate(data[i].tglrealorder.trim()));
                        $('#statusorder').val((data[i].statusorder));
                        // $('#tglestimasi').val(formatDate(data[i].tglestimasi.trim()));
                        FindDataDetail(data[i].nomor.trim());
                        statusclose(data[i].close);
                    }
                    FindData();
                }
            }, false);
        });
        // -- END FIND --

        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/finddetail'); ?>",
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
                        var hargasatuan = formatRupiah(data[i].harga.trim().toString(), '');
                        var qty = data[i].qty.trim();
                        var total = formatRupiah(data[i].total.trim().toString(), '');
                        inserttablefind(data[i].kodepart, namasparepart, hargasatuan, qty, total, "disabled");
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
                                    url: "<?php echo base_url('sparepart/ordering_sparepart/cancel'); ?>",
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


        // CARI DATA CABANG --------------------------------------------------------------------
        document.getElementById("caricabang").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchcabang').DataTable({
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
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/caridatacabang'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_cabang",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "kode <> '" + kode_cabang + "' and kodecompany = '" + kodecompany + "' and aktif = True"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchcabang", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/getdatacabang'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodesupplier').val(data[i].kode.trim());
                        $('#namasupplier').val(data[i].nama.trim());
                        $('#alamat').val(data[i].alamat.trim());
                    }
                }
            });
        });

        // document.getElementById("approve").addEventListener("click", function(event) {
        //     event.preventDefault();
        //     var nomor = $('#nomor').val();
        //     if(CekValidasi() == true){
        //         $.ajax({  
        //             url:"<?php echo base_url('sparepart/ordering_sparepart/approve'); ?>",  
        //             method:"POST", 
        //             dataType: "json",
        //             async : true,
        //             data:{
        //                     approve:true,
        //                     nomor:nomor               
        //                 },  
        //             success:function(data){ 
        //                 statusapprove("t");              
        //                 $.alert({
        //                     title: 'Info..',
        //                     content: data.message,
        //                     buttons: {
        //                     formSubmit: {
        //                         text: 'OK',
        //                         btnClass: 'btn-red'
        //                         }                                                
        //                     }                                
        //                 });                                                 
        //             }                                                    
        //         }); 
        //     } 
        // });
        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_orderpart/') ?>" + nomor
            );
        });

        // ---- referensi order -------
        document.getElementById("reforder").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchref').DataTable({
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
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/caridataref'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_orderingsparepart",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            namasupplier: "namasupplier"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            namasupplier: "namasupplier",
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchref", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        CariDetailRef(data[i].nomor.trim());
                    }
                }
            }, false);
        });

        function CariDetailRef(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/finddetail'); ?>",
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
                        var hargasatuan = formatRupiah(data[i].harga.trim().toString(), '');
                        var qty = data[i].qty.trim();
                        var total = formatRupiah(data[i].total.trim().toString(), '');
                        inserttable(data[i].kodepart, namasparepart, hargasatuan, qty, total, "", "");

                    }
                }
            });
        };


        // -- FIND --
        document.getElementById("cariestimasi").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchest').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/caridataestimasi'); ?>",
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
                        value: "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and nomor not in (select nomorestimasi from trnt_orderingsparepart where batal = false)"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searcheo", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $('#nomorestimasi').val(nomor);
            DataEstimasiDetail(nomor);

        });
        // -- END FIND --

        function DataEstimasiDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_sparepart/getdataestimasi'); ?>",
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
                        var hargasatuan = formatRupiah(data[i].hargamodal.trim().toString(), '');
                        var total = parseInt(data[i].qty.trim()) * parseInt(data[i].hargamodal.trim());
                        inserttable(kodesparepart, namasparepart, qty, hargasatuan, formatRupiah(total.toString(), ''), "");
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

        function getMinimStock() {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $("#minimstock").click();
            $('#tablesearchmin').DataTable({
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
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/getminstock'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            qtyakhir: "qtyakhir",
                            minstock: "minstock"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                        },
                        value: "qtyakhir < minstock and aktif = true and kodecabang = '" + kode_cabang + "' and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }

        document.getElementById("minimstock").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchmin').DataTable({
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
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/getminstock'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            qtyakhir: "qtyakhir",
                            minstock: "minstock"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                        },
                        value: "qtyakhir < minstock and aktif = true and kodecabang = '" + kode_cabang + "' and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);

        // -- Update --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var tglrealorder = $('#tglrealorder').val();
            var statusorder = $('#statusorder').val();
            var tanggalestimasidtng = $('#tanggalestimasidtng').val();
            if (CekValidasi() == true) {
                $.confirm({
                    title: 'Info..',
                    content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Apakah anda yakin akan update status order?</label>' +
                        '</div>' +
                        '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Ok',
                            btnClass: 'btn-red',
                            action: function() {
                                $.ajax({
                                    url: "<?php echo base_url('sparepart/ordering_sparepart/update'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        tglrealorder: tglrealorder,
                                        statusorder: statusorder,
                                        tanggalestimasidtng: tanggalestimasidtng
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

    });
</script>