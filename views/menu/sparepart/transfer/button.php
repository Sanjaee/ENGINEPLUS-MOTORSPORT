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
        $nama_menu = 'Transfer Sparepart';

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
            $('#nomortransfer').val("TS" + yr + mt + "00000");
            $('#tanggaltransfer').val(newDate);
            $('#nomorrequest').val("RC" + yr + mt + "00000");
            $('#tanggalrequest').val(newDate);
            $('#keterangan').val("");
            $('#keteranganreq').val("");
            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#qty').val("0");
            $('#qtytransfer').val("0");
            $('#qtygr').val("0");
            $('#cabang').val("");
            $('#tablesearchtampil').css('visibility', 'hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('keterangan').disabled = false;
            document.getElementById('keteranganreq').disabled = true;
            document.getElementById('cariorder').disabled = false;
            document.getElementById('add_detail').disabled = false;
            $('#detaildatasparepart').empty();
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

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
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };

        $("#qtytransfer").keypress(function(data) {
            return angka(data);
        });

        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#nomorrequest').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Request Part Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomorrequest').focus();
                var result = false;
            } else if ($('#keterangan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Keterangan Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#keterangan').focus();
                var result = false;
            } else if ($('#scabang').val() == $('#cabang').val()) {
                $.alert({
                    title: 'Info..',
                    content: 'Request Cabang Harus Berbeda Dengan Cabang User Login',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#cabang').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };



        function BrowseData() {
            document.getElementById('cancel').disabled = false;
            document.getElementById('cariorder').disabled = true;
            document.getElementById('qty').disabled = true;
        };

        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('cariorder').disabled = true;
            document.getElementById('qty').disabled = true;
            document.getElementById('qtytransfer').disabled = true;
            document.getElementById('keterangan').disabled = true;
            document.getElementById('add_detail').disabled = true;
        };




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
            var nomortransfer = $('#nomortransfer').val();
            var nomorrequest = $('#nomorrequest').val();
            var tanggaltransfer = $('#tanggaltransfer').val();
            var kode_cabangorder = $('#cabang').val();
            var kode_cabang = $('#scabang').val();
            var keterangan = $('#keterangan').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/transfer_sparepart/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomortransfer: nomortransfer,
                        nomorrequest: nomorrequest,
                        tanggaltransfer: tanggaltransfer,
                        keterangan: keterangan,
                        kode_cabang: kode_cabang,
                        kode_cabangorder: kode_cabangorder,
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
                            FindData();
                            $('#nomortransfer').val(data.nomor);
                            window.open(
                                "<?php echo base_url('form/form/cetak_transfercabang/') ?>" + data.nomor
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

        // -- BROWSE ORDER --
        document.getElementById("cariorder").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = false and close = false"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and batal = false and close = false"
            // }
            $('#tablesearchorder').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('sparepart/transfer_sparepart/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_ordertransferparts",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            kode_cabang: "kode_cabang"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            kode_cabang: "kode_cabang"
                        },
                        value: "kode_cabangtujuan = '" + kode_cabang + "'  and kodecompany = '" + kodecompany + "' and kodesubcabang = '" + kodesubcabang + "' and batal = false and close = false"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchokbro", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_sparepart/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorrequest').val(data[i].nomor.trim());
                        $('#tanggalrequest').val(formatDate(data[i].tanggal));
                        $('#keteranganreq').val(data[i].keterangan.trim());
                        $('#cabang').val(data[i].kode_cabang.trim());

                        FindDataDetail(data[i].nomor.trim());

                    }
                    BrowseData();
                }
            }, false);
        });
        // -- END browser --

        //--browse order detail
        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_sparepart/finddetail'); ?>",
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
                        var qty = data[i].qty.trim();
                        var qtygr = data[i].qtygr.trim();
                        var qtyterima = "0";
                        var hargabeli = DataSpareparts(data[i].kodepart.trim(), true);
                        var cogs = DataCOGSSparepart(data[i].kodepart.trim(), true);
                        inserttable(data[i].kodepart, namasparepart, qty, qtygr, qtyterima, hargabeli, cogs, "", "");
                    }
                }
            });
        };

        function DataSparepart(kode, find) {
            var returnValue;
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_sparepart/getdatasparepart'); ?>",
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
                            returnValue = false;
                        }
                    }
                }
            })
            return returnValue;
        };

        function DataSpareparts(kode, find) {
            var returnValue;
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_sparepart/getdatasparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (find == true) {
                            returnValue = formatRupiah(data[i].hargabeli.trim(), '');
                        } else {
                            $('#hargabeli').val(data[i].hargabeli.trim());
                            returnValue = false;
                        }
                    }
                }
            })
            return returnValue;
        };

        function DataCOGSSparepart(kode, find) {
            var returnValuex;
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_sparepart/getdatacogssparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    kode: kode,
                    kode_cabang: kode_cabang,
                    kodesubcabang: kodesubcabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (find == true) {
                            if (data[i].cogsstd.trim() == '') {
                                returnValuex = 0;
                            } else {
                                returnValuex = data[i].cogsstd.trim();
                            }
                        } else {
                            $('#hargabeli').val(data[i].cogsstd.trim());
                            returnValue = false;
                        }
                    }
                }
            })
            return returnValuex;
        };

        function inserttable(kodesparepart, namasparepart, qty, qtygr, qtyterima, hargabeli, cogs, find, del) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtygr + '</td>' +
                '<td>' + (qty - qtygr) + '</td>' +
                '<td>' + hargabeli + '</td>' +
                '<td>' + cogs + '</td>' +
                '<td>' +
                //'<button data-table="'+ kodesparepart +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-danger" ' + find + '><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-danger" ' + del + '><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
        }
        //------end here------



        function cleardetail() {
            $('#detaildatasparepart').empty();
        }


        function ambildatadetail() {
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
            }
            return arr2;
        }

        //-----calculate-----//
        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };


        $("#qty").keypress(function(data) {
            return angka(data);
        });

        $("#qtyterima").keypress(function(data) {
            return angka(data);
        });

        //-----end here-----//


        //----------FIND DATA---------
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "batal = false"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and batal = false"
            // }
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
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
                    "url": "<?php echo base_url('sparepart/transfer_sparepart/caridatapenerimaan'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_transferparts",
                        field: {
                            nomor: "nomor",
                            nomororder: "nomororder",
                            kode_cabangorder: "kode_cabangorder"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nomororder: "nomororder",
                            kode_cabangorder: "kode_cabangorder"
                        },
                        value: "kode_cabang = '" + kode_cabang + "'  and kodecompany = '" + kodecompany + "' and kodesubcabang = '" + kodesubcabang + "' and batal = false"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_sparepart/findpenerimaan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomortransfer').val(data[i].nomor.trim());
                        $('#tanggaltransfer').val(formatDate(data[i].tanggal));
                        $('#nomorrequest').val(data[i].nomororder.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#cabang').val(data[i].kode_cabangorder.trim());
                        findorder(data[i].nomororder.trim());
                        FindPenerimaanDataDetail(data[i].nomor.trim());

                    }
                    FindData();
                }
            }, false);
        });



        function findorder(nomororder) {
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_sparepart/getordering'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomororder: nomororder
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#tanggalrequest').val(formatDate(data[i].tanggal));
                        $('#keteranganreq').val(data[i].keterangan.trim());
                    }
                }
            });
        }

        //------detail 
        function FindPenerimaanDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_sparepart/findpenerimaandetail'); ?>",
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
                        var qty = data[i].qty.trim();
                        var qtygr = "0";
                        var qtytransfer = "0";
                        var hargabeli = formatRupiah(data[i].hargabeli.trim(), '');
                        var cogs = formatRupiah(data[i].cogs.trim(), '');
                        inserttablefind(data[i].kodepart, namasparepart, qty, qtygr, qtytransfer, hargabeli,cogs, "disabled", "disabled");
                    }
                }
            });
        };

        function inserttablefind(kodesparepart, namasparepart, qty, qtygr, qtytransfer, hargabeli,cogs, find, del) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtygr + '</td>' +
                '<td>' + (qty - qtygr) + '</td>' +
                '<td>' + hargabeli + '</td>' +
                '<td>' + cogs + '</td>' +
                '<td>' +
                //'<button data-table="'+ kodesparepart +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-danger" ' + del + '><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
        }

        // -- END FIND --


        // -- Cancel --
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomortransfer').val();
            var datadetail = ambildatadetail();
            var nomorrequest = $('#nomorrequest').val();
            var kode_cabangorder = $('#cabang').val();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
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
                                    url: "<?php echo base_url('sparepart/transfer_sparepart/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        nomorrequest: nomorrequest,
                                        kode_cabangorder: kode_cabangorder,
                                        kode_cabang: kode_cabang,
                                        alasan: alasan,
                                        kodesubcabang: kodesubcabang,
                                        kodecompany: kodecompany,
                                        datadetail: datadetail
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

        // ---------- ADD DETAIL ---------------------------------------------
        $("#add_detail").click(function() {
            var total = parseInt($('#qtytransfer').val()) + parseInt($('#qtygr').val());
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
                $('#carisparepart').focus();
                var result = false;
            } else if ($('#qty').val() < total) {
                $.alert({
                    title: 'Info..',
                    content: 'QTY Terima Tidak Boleh lebih besar dari Qty Order',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#qtytransfer').focus();
                var result = false;
            } else {

                var kodesparepart = $("#kodesparepart").val();
                var namasparepart = $("#namasparepart").val();
                var qty = $("#qty").val();
                var qtygr = $("#qtygr").val();
                var qtytransfer = $("#qtytransfer").val();
                var hargabeli = $("#hargabeli").val();
                var cogs = $("#cogs").val();

                if (validasiadd() == "sukses") {
                    inserttabledisc(kodesparepart, namasparepart, qty, qtygr, qtytransfer, hargabeli,cogs, "disabled", "disabled")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $("#qty").val("0");
                    $("#qtygr").val("0");
                    $("#qtytransfer").val("0");
                    $("#hargabeli").val("0");
                    $("#cogs").val("0");
                }
            }
        });

        function inserttabledisc(kodesparepart, namasparepart, qty, qtygr, qtytransfer, hargabeli,cogs, find, del) {

            _row.closest("tr").find("td").remove();


            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtygr + '</td>' +
                '<td>' + qtytransfer + '</td>' +
                '<td>' + hargabeli + '</td>' +
                '<td>' + cogs + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-success"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-danger" ' + del + '><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
        }


        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            $('#' + id).remove();
            var table = document.getElementById('detaildatasparepart');
        });

        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kodesparepart = _row.closest("tr").find("td:eq(0)").text();
            var namasparepart = _row.closest("tr").find("td:eq(1)").text();
            var qty = _row.closest("tr").find("td:eq(2)").text();
            var qtygr = _row.closest("tr").find("td:eq(3)").text();
            var qtytransfer = _row.closest("tr").find("td:eq(4)").text();
            var hargabeli = _row.closest("tr").find("td:eq(5)").text();
            var cogs = _row.closest("tr").find("td:eq(6)").text();
            $('#kodesparepart').val(kodesparepart);
            $('#namasparepart').val(namasparepart);
            $('#qty').val(qty);
            $('#qtygr').val(qtygr);
            $('#qtytransfer').val(qtytransfer);
            $('#hargabeli').val(hargabeli);
            $('#cogs').val(cogs);

            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });

        function validasiadd() {
            var kodesparepart = $("#kodesparepart").val();
            var table = document.getElementById('detailsparepart');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 0) {
                        if (table.rows[r].cells[c].innerHTML == kodesparepart) {

                            $('#' + kodesparepart).remove();
                            return "sukses";

                        }
                    }
                }
            }
            return "sukses";
        }

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomortransfer').val();
            window.open(
                "<?php echo base_url('form/form/cetak_transfercabang/') ?>" + nomor
            );
        });

    });
</script>