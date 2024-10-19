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
        $nama_menu = 'Order Part Counter';

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
            $('#nomor').val("CO-" + kode_cabang + "-" + yr + mt + "00000");
            $('#tanggalorder').val(newDate);
            $('#nocustomer').val("ONE TIME");
            $('#namacustomer').val("");
            $('#nopolisi').val("");
            $('#alamat').val("");
            $('#notlp').val("");
            $('#nohp').val("");

            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#satuan').val("");
            $('#qty').val("0");
            $('#hargasatuan').val("0");
            $('#persen').val("0");
            $('#discount').val("0");
            $('#total').val("0");
            $('#grandtotal').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#jenisdetail').val("-");
            $('#tipejual').val("-");
            $('#ongkir').val("0");

            $("#nonref").prop("checked", "false");
            $("#order").hide();
            $('#detaildatasparepart').empty();

            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('update').disabled = true;
            document.getElementById('ongkir').disabled = false;
            loadppnkonfigurasi();
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

        document.getElementById("ref").addEventListener("change", function(event) {
            event.preventDefault();
            var ref = $("#ref").val();
            if (ref == "true") {
                $("#order").show();
                $('#nomororder').val("");
                $('#nomororder').val("");
                $('#detaildatasparepart').empty();
                $('#grandtotal').val("0");
                $('#dpp').val("0");
                $('#ppn').val("0");
            }
        });

        document.getElementById("nonref").addEventListener("change", function(event) {
            event.preventDefault();
            var ref = $("#nonref").val();
            if (ref == "false") {
                $("#order").hide();
                $('#nomororder').val("");
                $('#detaildatasparepart').empty();
                $('#grandtotal').val("0");
                $('#dpp').val("0");
                $('#ppn').val("0");

            }
        });
        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            var table = document.getElementById('detaildatasparepart');
            if ($('#nocustomer').val() == '' || $('#namacustomer').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Customer Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caricustomer').focus();
                var result = false;
            } else if ($('#nohp').val() == '' || $('#nohp').val() == '0') {
                $.alert({
                    title: 'Info..',
                    content: 'No HP Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nohp').focus();
                var result = false;
            } else if ($('#tipejual').val() == '-' || $('#tipejual').val() == '0') {
                $.alert({
                    title: 'Info..',
                    content: 'Tipe Penjualan Tidak Boleh Kosong!',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#tipejual').focus();
                var result = false;
            } else if ($("input[name='ref']:checked").val() == 'true' && $('#nomororder').val() == '') {
                // console.log($("input[name='booking']:checked").val())
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Reference Order Terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#cariorder').focus();
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
            } else {
                var result = true;
            }
            return result;
        };

        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('caricustomer').disabled = true;
            document.getElementById('namacustomer').disabled = true;
            document.getElementById('alamat').disabled = true;
            document.getElementById('nopolisi').disabled = true;
            document.getElementById('nohp').disabled = true;
            document.getElementById('notlp').disabled = true;
        };

        function lockpencairan() {
            document.getElementById('namacustomer').disabled = true;
            document.getElementById('alamat').disabled = true;
        };

        function Supplier(kodesupplier) {
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_partcounter/getdatacustomer'); ?>",
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
                url: "<?php echo base_url('sparepart/ordering_partcounter/getdatasparepart'); ?>",
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
            } else if ($('#total').val() == 0 || $('#total').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Harga Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#total').focus();
                var result = false;
            } else if ($('#jenisdetail').val() == 0 || $('#jenisdetail').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Jenis Detail Part Tidak Boleh Kosong!',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenisdetail').focus();
                var result = false;
            } else {
                var kodesparepart = $("#kodesparepart").val();
                var namasparepart = $("#namasparepart").val();
                var hargasatuan = $("#hargasatuan").val();
                var qty = $("#qty").val();
                var persen = $("#persen").val();
                var discount = $("#discount").val();
                var total = $("#total").val();
                var jenisdetail = $("#jenisdetail").val();
                var keterangan = $("#keterangan").val();

                if (validasiadd() == "sukses") {
                    inserttable(kodesparepart, namasparepart, jenisdetail, hargasatuan, qty, persen, discount, total, keterangan, "")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $("#satuan").val("");
                    $("#jenisdetail").val("-");
                    $("#hargasatuan").val("0");
                    $("#qty").val("0");
                    $("#persen").val("0");
                    $("#discount").val("0");
                    $("#total").val("0");
                    $("#keterangan").val("");
                }
            }
        });

        function inserttable(kodesparepart, namasparepart, jenisdetail, hargasatuan, qty, persen, discount, total, keterangan, find) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + jenisdetail + '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + total + '</td>' +
                '<td>' + keterangan + '</td>' +
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

        function inserttablefind(kodesparepart, namasparepart, jenisdetail, hargasatuan, qty, persen, discount, total, keterangan, find) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + jenisdetail + '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + total + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td style="text-align: center;">' +
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
            var ongkir = $('#ongkir').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseInt(dpp) + parseInt(ppn) + parseInt(ongkir);
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
            PPN();
            Grandtotal();
        });

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
                        string = string + ", " + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML.replace("'", "").replace(",", "").replace("(", "").replace(")", "") + "'";
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
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = (parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) - parseFloat(discount.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total').val(formatRupiah(total.toString(), ''));
        }

        function HitungPersenDisc() {
            var persen = $('#persen').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = (parseFloat(persen.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) / 100;
            var rounddiscount = Math.round(discount);
            $('#discount').val(formatRupiah(rounddiscount.toString(), ''));
            HitungTotal();
        }

        function HitungDiscotomatis() {
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var persen = (parseFloat(discount) / parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) * 100;
            var pesenfix = persen.toFixed(0);
            $('#persen').val(pesenfix.toString());
            HitungTotal();
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

        $("#notlp").keypress(function(data) {
            return angka(data);
        });

        $("#nohp").keypress(function(data) {
            return angka(data);
        });

        $("#persen").keypress(function(data) {
            return angka(data);
        });

        $("#discount").keypress(function(data) {
            return angka(data);
        });

        $("#ongkir").keypress(function(data) {
            return angka(data);
        });

        $("#qty").keyup(function() {
            var qty = this.value;
            return HitungTotal();
        });

        $('#persen').keyup(function() {
            var persen = this.value;
            return HitungPersenDisc();
        });

        $('#discount').keyup(function() {
            var discount = this.value;
            return HitungDiscotomatis();
        });

        $('#ongkir').keyup(function() {
            var ongkir = this.value;
            return HitungOngkir();
        });

        var nominal = document.getElementById('hargasatuan');
        nominal.addEventListener('keyup', function(e) {
            nominal.value = formatRupiah(this.value, '');
        });

        var nominal = document.getElementById('discount');
        nominal.addEventListener('keyup', function(e) {
            nominal.value = formatRupiah(this.value, '');
        });

        function HitungOngkir() {
            var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ppn = $('#ppn').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var ongkir = $('#ongkir').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseInt(dpp) + parseInt(ppn) + parseInt(ongkir);
            $('#grandtotal').val(formatRupiah(total.toString(), ''));
            $('#ongkir').val(formatRupiah(ongkir.toString(), ''));
        }

        // CARI DATA customer
        document.getElementById("caricustomer").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#scabang').val();
            var kodegrup = $('#kodegrupcabang').val();
            // if (kodecabang == "SPT" || kodecabang == "WKS" || kodecabang == "UPS") { //TAM
            //     values = "aktif = true and kodecompany = '" + kodecompany + "' and kode_cabang in ('WKS','SPT','UPS')"
            // } else {
                values = "aktif = true and kode_cabang = '" + kodecabang + "'"
            // }
            $('#tablesearchcustomer').DataTable({
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
                    "url": "<?php echo base_url('sparepart/ordering_partcounter/caridatacustomer'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_customer",
                        field: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        sort: "nomor,nama",
                        where: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        // value: "aktif = true"
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchcustomer", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_partcounter/getdatacustomer'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nocustomer').val(data[i].nomor.trim());
                        $('#namacustomer').val(data[i].nama.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        $('#nohp').val(data[i].nohp.trim());
                        $('#notlp').val(data[i].notlp.trim());
                    }
                    lockpencairan();
                }
            });
        });

        // CARI DATA SPAREPART --------------------------------------------------------------------
        document.getElementById("carisparepart").addEventListener("click", function(event) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#hargasatuan').val("0");
            $('#qty').val("0");
            $('#qtystock').val("0");
            $('#total').val("0");
            event.preventDefault();
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
                    "url": "<?php echo base_url('sparepart/ordering_partcounter/caridatasparepart'); ?>",
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

        $(document).on('click', ".searchsparepart", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_partcounter/getdatasparepart'); ?>",
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
                        $('#satuan').val(data[i].satuan.trim());
                        // PartDetail(data[i].kode.trim(), false);
                        $('#hargasatuan').val(formatRupiah(data[i].hargajual.trim(), ''));
                        getMinStock(data[i].kode.trim());
                    }
                }
            });
        });
        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
        });
        // -- END NEW -- 

        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var nomororder = $('#nomororder').val();
            var tanggalorder = $('#tanggalorder').val();
            var nocustomer = $('#nocustomer').val();
            var namacustomer = $('#namacustomer').val();
            var alamat = $('#alamat').val();
            var nopolisi = $('#nopolisi').val();
            var nohp = $('#nohp').val();
            var notlp = $('#notlp').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var tipejual = $('#tipejual').val();
            var ongkir = $('#ongkir').val();
            // var nomororder = $('#nomororder').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/ordering_partcounter/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        tanggalorder: tanggalorder,
                        nocustomer: nocustomer,
                        namacustomer: namacustomer,
                        nopolisi: nopolisi,
                        nohp: nohp,
                        notlp: notlp,
                        alamat: alamat,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        kodecabang: kodecabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        nomororder: nomororder,
                        tipejual: tipejual,
                        ongkir:ongkir,
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
                                "<?php echo base_url('form/form/cetak_orderingpartcounter/') ?>" + data.nomor
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
                    "url": "<?php echo base_url('sparepart/ordering_partcounter/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_partcounterorder",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nama_customer: "nama_customer"
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
                url: "<?php echo base_url('sparepart/ordering_partcounter/find'); ?>",
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
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].nama_customer.trim());
                        $('#alamat').val(data[i].alamat_customer.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#notlp').val(data[i].notelp.trim());
                        $('#nohp').val(data[i].nohp.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim(), ''));
                        $('#nomororder').val(data[i].noreferensi.trim());
                        $('#tipejual').val(data[i].tipejual.trim());                        
                        $('#ongkir').val(formatRupiah(data[i].ongkir.trim().toString(), ''));
                        if (data[i].noreferensi != '') {
                            $('input:radio[name="ref"][value="true"]').prop('checked', true);
                            $("#order").show();
                        } else {
                            $('input:radio[name="ref"][value="false"]').prop('checked', true);
                            $("#order").hide();
                        }

                        if (data[i].statusfaktur == 't') {
                            document.getElementById('update').disabled = true;

                            document.getElementById('carisparepart').disabled = true;
                            document.getElementById('qty').disabled = true;
                            document.getElementById('add-row').disabled = true;
                            $('.hapus').prop("disabled", true);
                        } else {
                            document.getElementById('update').disabled = false;

                            document.getElementById('carisparepart').disabled = false;
                            document.getElementById('qty').disabled = false;
                            document.getElementById('add-row').disabled = false;
                            $('.hapus').prop("disabled", false);

                        }
                        FindDataDetail(data[i].nomor.trim());
                        // statusapprove(data[i].approve);
                    }
                    FindData();
                }
            }, false);
        });
        // -- END FIND --

        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_partcounter/finddetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kodepart = data[i].kode_parts.trim();
                        var namasparepart = DataSparepart(data[i].kode_parts.trim(), true);
                        var jenisdetail = data[i].jenisdetail.trim();
                        var hargasatuan = formatRupiah(data[i].harga.trim().toString(), '');
                        var qty = data[i].qty.trim();
                        var persen = data[i].persendiscperitem.trim();
                        var discount = data[i].discountperitem.trim();
                        var total = formatRupiah(data[i].subtotal.trim().toString(), '');
                        var keterangan = data[i].keterangan.trim();
                        inserttablefind(kodepart, namasparepart, jenisdetail, hargasatuan, qty, persen, discount, total, keterangan, "");
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
                                    url: "<?php echo base_url('sparepart/ordering_partcounter/cancel'); ?>",
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
                "<?php echo base_url('form/form/cetak_orderingpartcounter/') ?>" + nomor
            );
        });

        // ---------- CARI ORDER ---------------------------------------------
        document.getElementById("cariorder").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchop').DataTable({
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
                    "url": "<?php echo base_url('sparepart/ordering_partcounter/CariOrderPart'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_orderingsparepart",
                        field: {
                            nomor: "nomor",
                            namasupplier: "namasupplier",
                            kode_cabang: "kode_cabang"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            namasupplier: "namasupplier",
                            kode_cabang: "kode_cabang"
                        },
                        value: "batal = false and jenis = true and close = false and kodesupplier = '" + kode_cabang + "' and kodecompany = '" + kodecompany + "' and nomor not in (select noreferensi from trnt_partcounterorder where batal = false)"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchop", function() {
            var result = $(this).attr("data-id");
            $('#nomororder').val(result.trim());
            DataDetail(result.trim());;
        });

        function DataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_partcounter/GetDataOrderPart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kodesparepart = data[i].kodepart.trim();
                        var namasparepart = data[i].nama.trim();
                        var hargasatuan = PartDetail(data[i].kodepart.trim(), true);
                        var qty = data[i].qty.trim();
                        var total = formatRupiah(data[i].total.trim().toString(), '');
                        inserttableorder(kodesparepart, namasparepart, hargasatuan, qty, "", "");
                        //console.log(inserttable);
                    }
                }
            });
        };

        function PartDetail(kode, find) {
            var returnValue;
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $("#hargasatuan").val("0");
            $.ajax({
                url: "<?php echo base_url('masterdata/parts/getdatasparepart'); ?>",
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
                            returnValue = formatRupiah(data[i].hargajual.trim(), '');
                        } else {
                            $('#hargasatuan').val(formatRupiah(data[i].hargajual.trim(), ''));
                            returnValue = false;
                        }
                    }
                }
            })
            return returnValue;
        };

        function inserttableorder(kodesparepart, namasparepart, hargasatuan, qty, total, find) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + (hargasatuan) * qty + '</td>' +
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

        document.getElementById("refbatal").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
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
                // // "scrollX": true,
                // "scrollY": true,
                // // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('sparepart/ordering_partcounter/caridatarefbatal'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_partcounterorder",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nama_customer: "nama_customer"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nama_customer: "nama_customer"
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchbatal", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_partcounter/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].nama_customer.trim());
                        $('#alamat').val(data[i].alamat_customer.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#notlp').val(data[i].notelp.trim());
                        $('#nohp').val(data[i].nohp.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].total.trim(), ''));
                        $('#nomororder').val(data[i].noreferensi.trim());
                        $('#tipejual').val(data[i].tipejual.trim());
                        $('#ongkir').val(formatRupiah(data[i].ongkir.trim().toString(), ''));
                        if (data[i].noreferensi != '') {
                            $('input:radio[name="ref"][value="true"]').prop('checked', true);
                            $("#order").show();
                        } else {
                            $('input:radio[name="ref"][value="false"]').prop('checked', true);
                            $("#order").hide();
                        }
                        GetDataDetail(data[i].nomor.trim());
                        // statusapprove(data[i].approve);
                    }
                }
            }, false);
        });

        function GetDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/ordering_partcounter/finddetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kodepart = data[i].kode_parts.trim();
                        var namasparepart = DataSparepart(data[i].kode_parts.trim(), true);
                        var jenisdetail = data[i].jenisdetail.trim();
                        var hargasatuan = formatRupiah(data[i].harga.trim().toString(), '');
                        var qty = data[i].qty.trim();
                        var persen = data[i].persendiscperitem.trim();
                        var discount = data[i].discountperitem.trim();
                        var total = formatRupiah(data[i].subtotal.trim().toString(), '');
                        var keterangan = data[i].keterangan.trim();
                        inserttable(kodepart, namasparepart, jenisdetail, hargasatuan, qty, persen, discount, total, keterangan, '');
                    }
                }
            });
        };
        // -- END FIND --


        // ---------- ON BUTTON UPDATE ---------------------------------------------
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            var tipejual = $('#tipejual').val();
            var ongkir = $('#ongkir').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/ordering_partcounter/update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        tipejual: tipejual,
                        ongkir:ongkir,
                        detail: datadetail
                    },
                    beforeSend: function(data) {
                        $("#loading").show();
                        $("#update").hide();
                    },
                    complete: function(data) {
                        $("#loading").hide();
                        $("#update").show();
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

    });
</script>