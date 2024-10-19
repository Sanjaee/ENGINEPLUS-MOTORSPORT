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
            // $("#tanggal").prop("disabled", true);
            $('#nopolisi').val("");
            $('#norangka').val("");
            $('#tahun').val("");
            $('#transmisi').val("-");
            $('#nomesin').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#kodewarna').val("");
            $('#namawarna').val("");
            $('#kode_kategori').val("");
            $('#nama_kategori').val("");
            $('#pic').val("");
            $("#nocustomer").val("C000000000");
            $("#namacustomer").val("");
            $('#nohppic').val("");
            $('#alamat').val("");
            $('#kelurahan').val("");
            $('#kecamatan').val("");
            $('#kota').val("");
            $('#provinsi').val("");
            $('#kodepos').val("");
            $('#nohp').val("");
            $('#npwp').val("");
            $('#email').val("");
            $('#odemeter').val("");
            $('#jenismobil').val("");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#entrywo').prop('disabled', true);

            $('#detaildataspk').empty();
            document.getElementById('carinopol').disabled = false;
            document.getElementById('caritipe').disabled = false;
            document.getElementById('cariwarna').disabled = false;
            document.getElementById('caricustomer').disabled = false;
            document.getElementById('carikodepos').disabled = false;
            document.getElementById('save').disabled = false;
            document.getElementById('entrywo').disabled = true;
            document.getElementById('estimasiwo').disabled = true;
            document.getElementById('gantinopol').disabled = true;
            document.getElementById('namacustomer').disabled = false;
            document.getElementById('nopolisi').disabled = false;
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

        document.getElementById("newcust").addEventListener("click", function(event) {
            event.preventDefault();
            $("#nocustomer").val("C000000000");
            $("#jeniscustomer").val("-");
            $("#namacustomer").val("");
            $('#alamat').val("");
            $('#kelurahan').val("");
            $('#kecamatan').val("");
            $('#kota').val("");
            $('#provinsi').val("");
            $('#kodepos').val("");
            $('#nohp').val("");
            $('#npwp').val("");
            $('#email').val("");
            document.getElementById('namacustomer').disabled = false;
        });

        // ---------- Validasi----------------------------------------
        function CekValidasi() {

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
                $('#carinopol').focus();
                var result = false;
            } else if ($('#norangka').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nomor Rangka Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#norangka').focus();
                var result = false;
            } else if ($('#nomesin').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'No Mesin Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomesin').focus();
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
            } else if ($('#kode_tipe').val() == '' || $('#kode_kategori').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Tipe dan Kategori Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caritipe').focus();
                var result = false;
            } else if ($('#kelurahan').val() == '' || $('#kecamatan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Kelurahan/Kecamatan Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carikodepos').focus();
                var result = false;
            } else if ($('#odemeter').val() == '' || $('#odemeter').val() == '0') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi KM Akhir Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#odemeter').focus();
                var result = false;
            } else if ($('#tahun').val() == '' || $('#transmisi').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Tahun dan Transmisi Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#tahun').focus();
                var result = false;
            } else if ($('#jeniscustomer').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Customer Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jeniscustomer').focus();
                var result = false;
            } else if ($('#jenismobil').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Tipe / Model Mobil Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenismobil').focus();
                var result = false;
            } else if ($('#jeniscustomer2').val() == '-' || $('#jeniscustomer2').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Customer Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jeniscustomer2').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };


        // ---------- Cari Data ----------------------------------------
        function DataCustomer(nocustomer) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_datakendaraan/GetDataCustomer'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nocustomer: nocustomer
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#jeniscustomer').val(data[i].title.trim());
                        $('#namacustomer').val(data[i].nama.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        $('#kelurahan').val(data[i].kelurahan.trim());
                        $('#kecamatan').val(data[i].kecamatan.trim());
                        $('#kota').val(data[i].kota.trim());
                        $('#provinsi').val(data[i].provinsi.trim());
                        $('#kodepos').val(data[i].kodepos.trim());
                        $('#npwp').val(data[i].npwp.trim());
                        $('#email').val(data[i].email.trim());
                        $('#nohp').val(data[i].nohp.trim());
                        $('#jeniscustomer2').val(data[i].jeniscustomer.trim());
                    }
                }
            });
        };

        function DataTipe(kode_tipe) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_datakendaraan/GetDataTipe'); ?>",
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
                url: "<?php echo base_url('spk/entry_datakendaraan/GetDataProduct'); ?>",
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

        function TurnDisable() {
            document.getElementById('entrywo').disabled = false;
            document.getElementById('carinopol').disabled = true;
            document.getElementById('namacustomer').disabled = true;
            document.getElementById('estimasiwo').disabled = false;
        };

        function FindTurnDisable() {
            document.getElementById('entrywo').disabled = true;
            document.getElementById('namacustomer').disabled = true;
            document.getElementById('nopolisi').disabled = true;
            document.getElementById('gantinopol').disabled = false;
            document.getElementById('estimasiwo').disabled = true;
        };


        // ---------- ON LOOKUP SN ----------------------------------------
        document.getElementById("carinopol").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#scabang').val();
            var kodegrup = $('#kodegrupcabang').val();
            // if (kodecabang == "SPT" || kodecabang == "WKS" || kodecabang == "UPS") { //TAM
            //     values = "kode_cabang in ('WKS','SPT','UPS','ATB')"
            // } else {
                values = "kode_cabang = '" + kodecabang + "'"
            // } 
            $('#tablesearchnopol').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/entry_datakendaraan/carinopol'); ?>",
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
                        value: values
                        // value: "kodecompany = '" + kodecompany + "' and (kode_cabang = '" + kodecabang + "' or kode_cabang in (select kode from glbm_cabang where kodegrup = '" + kodegrup + "'))"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchnopol", function() {
            var result = $(this).attr("data-id");
            $('#nopolisi').val(result.trim());
            DataSN(result.trim());;
        });

        function DataSN(nopolisi) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_datakendaraan/GetDataSN'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopolisi: nopolisi
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#norangka').val(data[i].norangka.trim());
                        $('#nomesin').val(data[i].nomesin.trim());
                        $('#tahun').val(data[i].tahunpembuatan.trim());
                        $('#transmisi').val(data[i].transmisi.trim());
                        $('#kodewarna').val(data[i].kodewarna.trim());
                        $('#namawarna').val(data[i].namawarna.trim());
                        $('#odemeter').val(data[i].odmeterakhir.trim());
                        $('#kode_tipe').val(data[i].kodetipe.trim());
                        $('#pic').val(data[i].namapic.trim());
                        $('#nohppic').val(data[i].nohppic.trim());
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#jenismobil').val(data[i].jenismobil.trim());
                        DataTipe(data[i].kodetipe.trim());
                        DataCustomer(data[i].nomor_customer.trim());
                        FindDataDetail(data[i].nopolisi.trim(), data[i].norangka.trim());
                        getSaranKendaraan(data[i].nopolisi.trim());
                    }
                    FindTurnDisable();
                }
            });
        };

        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };

        $("#nohp").keypress(function(data) {
            return angka(data);
        });

        $("#nohppic").keypress(function(data) {
            return angka(data);
        });

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
                    "url": "<?php echo base_url('spk/entry_datakendaraan/CariDataTipe'); ?>",
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
            $('#kode_tipe').val(result.trim());
            DataTipe(result.trim());
        });
        // ---------- ON LOOKUP CUSTOMER ------------------------------------
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
                    "url": "<?php echo base_url('spk/entry_datakendaraan/CariDataCustomer'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_customer",
                        field: {
                            nomor: "nomor",
                            nama: "nama",
                            alamat: "alamat",
                            nohp: "nohp",
                            email: "email"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nama: "nama",
                            alamat: "alamat",
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
        });

        //--------------------------kodepos--------------------------
        document.getElementById("carikodepos").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchpos').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_datakendaraan/caridatakodepos'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_kodepos",
                        field: {
                            kode: "kode",
                            kelurahan: "kelurahan",
                            kecamatan: "kecamatan",
                            kota: "kota",
                            provinsi: "provinsi",
                            kodepos: "kodepos"
                        },
                        sort: "kode,kelurahan",
                        where: {
                            kode: "kode",
                            kelurahan: "kelurahan",
                            kecamatan: "kecamatan",
                            kota: "kota",
                            provinsi: "provinsi",
                            kodepos: "kodepos"
                        },
                        value: "aktif = true"
                    },

                }
            });
        }, false);

        $(document).on('click', ".searchpos", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/entry_datakendaraan/getKelurahan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode').val(data[i].kode.trim());
                        $('#kelurahan').val(data[i].kelurahan.trim());
                        $('#kecamatan').val(data[i].kecamatan.trim());
                        $('#kota').val(data[i].kota.trim());
                        $('#provinsi').val(data[i].provinsi.trim());
                        $('#kodepos').val(data[i].kodepos.trim());
                    }
                }
            });
        });

        //-------------------- WARNA --------------------------------------
        document.getElementById("cariwarna").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchwarna').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/entry_datakendaraan/cariwarna'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_warna",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode,nama",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true"
                    },

                }
            });
        }, false);


        $(document).on('click', ".searchwarna", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('spk/entry_datakendaraan/getwarna'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodewarna').val(data[i].kode.trim());
                        $('#namawarna').val(data[i].nama.trim());
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


        function cleardetail() {
            $('#detaildataspk').empty();
        }

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

        // ---------- ON BUTTON SAVE ---------------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var nopolisi = $('#nopolisi').val();
            var tahun = $('#tahun').val();
            var transmisi = $('#transmisi').val();
            var norangka = $('#norangka').val();
            var nomesin = $('#nomesin').val();
            var kodetipe = $('#kode_tipe').val();
            var namatipe = $('#nama_tipe').val();
            var kodewarna = $("#kodewarna").val();
            var namawarna = $("#namawarna").val();
            var kode_kategori = $('#kode_kategori').val();
            var nama_kategori = $('#nama_kategori').val();
            var nocustomer = $('#nocustomer').val();
            var namacustomer = $('#namacustomer').val();
            var pic = $('#pic').val();
            var nohppic = $('#nohppic').val();
            var alamat = $('#alamat').val();
            var kelurahan = $('#kelurahan').val();
            var kecamatan = $('#kecamatan').val();
            var npwp = $('#npwp').val();
            var kota = $('#kota').val();
            var provinsi = $('#provinsi').val();
            var email = $('#email').val();
            var kodepos = $('#kodepos').val();
            var odemeter = $('#odemeter').val();
            var nohp = $('#nohp').val();
            var kodecabang = $('#scabang').val();
            var titlecustomer = $('#jeniscustomer').val();
            var jenismobil = $('#jenismobil').val();
            var jeniscustomer = $('#jeniscustomer2').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('spk/entry_datakendaraan/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nopolisi: nopolisi,
                        tahun: tahun,
                        transmisi: transmisi,
                        norangka: norangka,
                        nomesin: nomesin,
                        kodetipe: kodetipe,
                        namatipe: namatipe,
                        kodewarna: kodewarna,
                        namawarna: namawarna,
                        kode_kategori: kode_kategori,
                        nama_kategori: nama_kategori,
                        nocustomer: nocustomer,
                        namacustomer: namacustomer,
                        pic: pic,
                        nohppic: nohppic,
                        alamat: alamat,
                        kelurahan: kelurahan,
                        kecamatan: kecamatan,
                        npwp: npwp,
                        kota: kota,
                        provinsi: provinsi,
                        email: email,
                        kodepos: kodepos,
                        odemeter: odemeter,
                        nohp: nohp,
                        kodecabang: kodecabang,
                        titlecustomer: titlecustomer,
                        jenismobil: jenismobil,
                        jeniscustomer:jeniscustomer
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
                            //console.log(data.nomor_customer);
                            $('#nocustomer').val(data.nomor);
                            TurnDisable();
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

        function FindDataDetail(nopolisi, norangka) {
            cleardetail();            
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#scabang').val();
            var kodegrup = $('#kodegrupcabang').val();
            $.ajax({
                url: "<?php echo base_url('spk/entry_datakendaraan/FindDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopolisi: nopolisi,
                    norangka: norangka,
                    kodecompany: kodecompany,
                    kodecabang: kodecabang,
                    kodegrup: kodegrup
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var nomorwo = data[i].nomor.trim();
                        var tanggal = (formatDate(data[i].tanggal).trim());
                        var nama = data[i].nama.trim();
                        var jenis = data[i].jenis.trim();
                        var pemakai = data[i].pemakai.trim().toString();
                        var keluhan = data[i].keluhan.trim().toString();
                        var statuswo = data[i].statuswo.trim().toString();
                        var odemeter = data[i].odemeter.trim().toString();
                        inserttable(nomorwo, tanggal, nama, jenis, pemakai, statuswo, keluhan, odemeter);
                        //console.log(inserttable);
                    }
                }
            });
        };

        function inserttable(nomorwo, tanggal, nama, jenis, pemakai, statuswo, keluhan, odemeter) {
            var row = "";
            row =
                '<tr id="' + nomorwo + '">' +
                '<td>' + '<button class="klikwo btn btn-primary" datawo = "'+nomorwo+'"><i class="fa fa-hand-o-right"></i></button>' + '</td>' +
                '<td>' + nomorwo + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + pemakai + '</td>' +
                '<td>' + statuswo + '</td>' +
                '<td>' + keluhan + '</td>' +
                '<td>' + odemeter + '</td>' +
                '</tr>';
            $('#detaildataspk').append(row);
        }

        $(document).on('click','.klikwo', function(){
            var nomorwo = $(this).attr('datawo');
            // var nowo = $(this).attr("data-table");
            window.open("<?php echo base_url('main/entry_spkwo/') ?>" + btoa(nomorwo), "_self");
        });

        // ---------- ON BUTTON GANTI NOPOL ---------------------------------------------
        document.getElementById("gantinopol").addEventListener("click", function(event) {
            event.preventDefault();
            var nopollama = $('#nopolisi').val();
            if (CekValidasi() == true) {
                $.confirm({
                    title: 'Danger !!',
                    content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Apakah anda yakin akan mengubah no polisi ?</label>' +
                        '<input type="text" placeholder="No Polisi Baru" class="nopolbaru form-control" required />' +
                        '</div>' +
                        '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Ok',
                            btnClass: 'btn-red',
                            action: function() {
                                var nopolbaru = this.$content.find('.nopolbaru').val();
                                if (!nopolbaru) {
                                    $.alert('Nopol Baru belum diisi');
                                    return false;
                                }
                                $.ajax({
                                    url: "<?php echo base_url('spk/entry_datakendaraan/GantiNopol'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nopollama: nopollama,
                                        nopolbaru: nopolbaru
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

        // //-------------------history SPK-------------------------------------
        // document.getElementById("history").addEventListener("click", function(event) {
        //         event.preventDefault(); 
        //         var nopolisi = $('#nopolisi').val();
        //         var norangka = $('#norangka').val();
        //         $('#tablesearchspk').DataTable({ 
        //             "destroy": true,
        //             "searching": true,
        //             "processing":true,  
        //             "serverSide":true,
        //             "lengthChange": false,
        //             // "scrollX": true,
        //             // "scrollY": true,
        //             // // "ordering":  true,
        //             "order": [],
        //             // "order":[0,1,2],  
        //             "ajax":{  
        //                     "url":"<?php echo base_url('spk/entry_datakendaraan/historyspk'); ?>",  
        //                     "method":"POST",
        //                     "data":{
        //                             nmtb:"history_sn",
        //                             field:{nomor:"nomor",nopolisi:"nopolisi",norangka:"norangka",nama:"nama",keluhan:"keluhan"},
        //                             sort:"nomor",
        //                             where:{nomor:"nomor",nopolisi:"nopolisi",norangka:"norangka",nama:"nama",keluhan:"keluhan"},
        //                             value: "nopolisi = '" + nopolisi + "' OR norangka = '" + norangka + "'"
        //                             },  
        //             }
        //         });
        //     }, false);


        document.getElementById("entrywo").addEventListener("click", function(event) {
            var nopolisi = $('#nopolisi').val().toUpperCase();
            //var nopol = urlencode($nopolisi);
            window.open(
                "<?php echo base_url('main/entry_spk/') ?>" + nopolisi, "_self"
            );
        });

        document.getElementById("estimasiwo").addEventListener("click", function(event) {
            var nopolisi = $('#nopolisi').val().toUpperCase();
            //var nopol = urlencode($nopolisi);
            window.open(
                "<?php echo base_url('main/estimasiwo/') ?>" + nopolisi, "_self"
            );
        });

        function getSaranKendaraan(nopolisi) {
            $.ajax({
                url: "<?php echo base_url('spk/entry_datakendaraan/getSaranKendaraan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopolisi: nopolisi
                },
                success: function(data) {
                    if (!data.length == 0) {
                        for (var i = 0; i < data.length; i++) {
                            $("#munculpesan").click();
                            $("#saranservice").html(data[i].keterangan.trim());
                        }
                    }
                }
            });
        }
        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetakhistory").addEventListener("click", function(event) {
            var nopolisi = $('#nopolisi').val();
            var norangka = $('#norangka').val();
            window.open(
                "<?php echo base_url('form/form/cetak_historyso/') ?>" + nopolisi + ":" + norangka
            );
        });

    });
</script>