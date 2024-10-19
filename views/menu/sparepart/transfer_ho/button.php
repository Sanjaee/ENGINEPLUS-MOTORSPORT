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
        $nama_menu = 'Transfer Part Ke HO';

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
            $('#nomortransfer').val("TH" + yr + mt + "00000");
            $('#tanggaltransfer').val(newDate);
            $('#keterangan').val("");
            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#qty').val("0");
            $('#qtytransfer').val("0");
            $('#tablesearchtampil').css('visibility', 'hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('carisparepart').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('keterangan').disabled = false;
            document.getElementById('add_detail').disabled = false;
            $('#detaildatasparepart').empty();
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#keterangan').val() == '') {
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
            } else {
                var result = true;
            }
            return result;
        };


        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('carisparepart').disabled = true;
            document.getElementById('qty').disabled = true;
            document.getElementById('qtytransfer').disabled = true;
            document.getElementById('keterangan').disabled = true;
            document.getElementById('add_detail').disabled = true;
        };

        function ClearPart() {
            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#qty').val("0");
            $('#qtytransfer').val("0");
        };

        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
        });
        // -- END NEW -- 


        // -- BROWSE ORDER --
        document.getElementById("carisparepart").addEventListener("click", function(event) {
            ClearPart();
            event.preventDefault();
            $('#tablesearchsparepart').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('sparepart/transfer_partho/caridatapart'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_parts",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            hargabeli: "hargabeli",
                            hargajual: "hargajual"
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

        $(document).on('click', ".searchokbro", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_partho/getdatasparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodesparepart').val(data[i].kode.trim());
                        $('#namasparepart').val(data[i].nama.trim());
                        stockpart(data[i].kode.trim());
                    }
                }
            }, false);
        });


        function stockpart(kode) {
            var kode_cabang = $('#scabang').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_partho/caristockpart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kode_cabang: kode_cabang
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#qty').val(data[i].sisa.trim());
                    }
                }
            });
        }
        // -- END browser --


        // ---------- ADD DETAIL ---------------------------------------------
        $("#add_detail").click(function() {
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
            } else if ($('#qtytransfer').val() > $('#qty').val()) {
                $.alert({
                    title: 'Info..',
                    content: 'QTY Transfer Tidak Boleh lebih besar dari Qty Stock',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#qtytransfer').focus();
                var result = false;
            } else if ($('#qtytransfer').val() == '0') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Qty Transfer Terlebih Dahulu',
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
                var qtytransfer = $("#qtytransfer").val();

                if (validasiadd() == "sukses") {
                    inserttable(kodesparepart, namasparepart, qty, qtytransfer, "disabled")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $("#qty").val("0");
                    $("#qtytransfer").val("0");
                }
            }
        });

        function inserttable(kodesparepart, namasparepart, qty, qtytransfer, find) {

            // _row.closest("tr").find("td").remove();


            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtytransfer + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-success"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
        }


        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kodesparepart = _row.closest("tr").find("td:eq(0)").text();
            var namasparepart = _row.closest("tr").find("td:eq(1)").text();
            var qty = _row.closest("tr").find("td:eq(2)").text();
            var qtytransfer = _row.closest("tr").find("td:eq(3)").text();
            $('#kodesparepart').val(kodesparepart);
            $('#namasparepart').val(namasparepart);
            $('#qty').val(qty);
            $('#qtytransfer').val(qtytransfer);

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

        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();

            var datadetail = ambildatadetail();
            var nomortransfer = $('#nomortransfer').val();
            var tanggaltransfer = $('#tanggaltransfer').val();
            var kode_cabang = $('#scabang').val();
            var keterangan = $('#keterangan').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/transfer_partho/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomortransfer: nomortransfer,
                        tanggaltransfer: tanggaltransfer,
                        keterangan: keterangan,
                        kode_cabang: kode_cabang,
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
                                "<?php echo base_url('form/form/cetak_transfertoho/') ?>" + data.nomor
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

        $("#qtytransfer").keypress(function(data) {
            return angka(data);
        });

        //-----end here-----//


        //----------FIND DATA---------
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            if (kode_cabang == "HO") {
                values = "batal = false"
            } else {
                values = "kode_cabang = '" + kode_cabang + "' and batal = false"
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
                    "url": "<?php echo base_url('sparepart/transfer_partho/caridatapenerimaan'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_transferpartstoho",
                        field: {
                            nomor: "nomor",
                            kode_cabang: "kode_cabang"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            kode_cabang: "kode_cabang"
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
                url: "<?php echo base_url('sparepart/transfer_partho/findpenerimaan'); ?>",
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
                        $('#keterangan').val(data[i].keterangan.trim());
                        FindPenerimaanDataDetail(data[i].nomor.trim());
                    }
                    FindData();
                }
            }, false);
        });

        //------detail 
        function FindPenerimaanDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_partho/findpenerimaandetail'); ?>",
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
                        var qty = "0";
                        var qtytransfer = data[i].qty.trim();
                        inserttable(data[i].kodepart, namasparepart, qty, qtytransfer, "disabled");
                    }
                }
            });
        };

        function DataSparepart(kode, find) {
            var returnValue;
            $.ajax({
                url: "<?php echo base_url('sparepart/transfer_partho/getdatasparepart'); ?>",
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
                            // hitungOngkoshari();  
                            returnValue = false;
                        }
                    }
                }
            })
            return returnValue;
        };

        // function inserttablefind(kodesparepart,namasparepart,qty,qtygr,qtytransfer,find){
        //     var row = "";
        //         row = 
        //             '<tr id="'+ kodesparepart +'">' +
        //                 '<td>'+kodesparepart+'</td>' +
        //                 '<td>'+namasparepart+'</td>' +
        //                 '<td>'+qty+'</td>' +
        //                 '<td>'+qtygr+'</td>' +
        //                 '<td>'+(qty - qtygr)+'</td>' +
        //                 '<td>' +
        //                     //'<button data-table="'+ kodesparepart +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
        //                     '<button data-yes="'+ kodesparepart +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
        //                 '</td>' +
        //             '</tr>';
        //     $('#detaildatasparepart').append(row);
        //}

        // -- END FIND --


        // -- Cancel --
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomortransfer').val();
            var datadetail = ambildatadetail();
            var kode_cabang = $('#scabang').val();
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
                                    url: "<?php echo base_url('sparepart/transfer_partho/cancel'); ?>",
                                    method: "POST",
                                    dataType: "json",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        kode_cabang: kode_cabang,
                                        alasan: alasan,
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

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomortransfer').val();
            window.open(
                "<?php echo base_url('form/form/cetak_transfertoho/') ?>" + nomor
            );
        });



    });
</script>