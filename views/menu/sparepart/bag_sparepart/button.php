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
            $('#nomor').val("BA" + yr + mt + "00000");
            $('#tanggal').val(newDate);
            $('#keterangan').val("");
            $('#kodesparepart').val("");
            $('#namasparepart').val("");
            $('#qty').val("0");
            $('#qtystock').val("0");
            $('#harga').val("0");
            $('#jenis_detail').val("-");
            $('#tablesearchtampil').css('visibility', 'hidden');
            $('#update').prop('disabled', true);
            $('#tampilharga').css('visibility', 'hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('keterangan').disabled = false;
            $('#detaildatasparepart').empty();
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

        $("#jenis_detail").change(function() {
            if ($("#jenis_detail").val() == 1) {
                $('#tampilharga').css('visibility', 'visible');
                $('#harga').prop("disabled", false);
                $('#harga').val("0");
                $('#detaildatasparepart').empty();
            } else {
                $('#tampilharga').css('visibility', 'hidden');
                $('#harga').prop("disabled", true);
                $('#harga').val("0");
                $('#detaildatasparepart').empty();
            }
        });

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
            } else if ($('#jenis_detail').val() == '0') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Transaksi Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenis_detail').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        // function BersihkanLayar(){
        //     location.reload(true);
        // };

        function FindData() {
            document.getElementById('save').disabled = true;
            //document.getElementById('cancel').disabled = false;
            document.getElementById('carisparepart').disabled = true;
            document.getElementById('qty').disabled = true;
            document.getElementById('keterangan').disabled = true;
            document.getElementById('add-row').disabled = true;
            document.getElementById('jenis_detail').disabled = true;
            $('.hapus').prop("disabled", true);
        };


        function DataSparepart(kode, find) {
            var returnValue;
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/bag_sparepart/getdatasparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data:{kode:kode,kode_cabang: kode_cabang,kodecompany: kodecompany},  
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
                $('#carisparepart').focus();
            } else if ($('#jenis_detail').val() == '-' || $('#jenis_detail').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Transaksi Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenis_detail').focus();
                var result = false;
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
            } else if ($('#jenis_detail').val() == 2 && parseInt($('#qtystock').val()) < parseInt($('#qty').val())) {
                $.alert({
                    title: 'Info..',
                    content: 'QTY Tidak Boleh Besar Dari Stock',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#qty').focus();
                var result = false;
            } else if ($('#jenis_detail').val() == 1 && ($('#harga').val() == 0 || $('#harga').val() == '')) {
                $.alert({
                    title: 'Info..',
                    content: 'Harga Tidak Boleh Kosong atau 0',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#harga').focus();
                var result = false;
            } else {
                var kodesparepart = $("#kodesparepart").val();
                var namasparepart = $("#namasparepart").val();
                var qty = $("#qty").val();
                var harga = $("#harga").val();
                $('#jenis_detail').prop("disabled", true);
                if (validasiadd() == "sukses") {
                    inserttable(kodesparepart, namasparepart, qty, harga, "")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $("#qty").val("0");
                    $("#harga").val("0");
                }
            }
        });

        function inserttable(kodesparepart, namasparepart, qty, harga, find) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' +
                '<button data-table="' + kodesparepart + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);

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
        });

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = datePart[1],
                day = datePart[2];

            return day + '-' + month + '-' + year;
        }

        function ambildatadetail(nomor) {
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

        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 && data.which != 46 || data.which > 57)) {
                return false;
            }
        };

        $("#qty").keypress(function(data) {
            return angka(data);
        });

        $("#harga").keypress(function(data) {
            return angka(data);
        });

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


        // CARI DATA SPAREPART --------------------------------------------------------------------
        document.getElementById("carisparepart").addEventListener("click", function(event) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
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
                    "url": "<?php echo base_url('sparepart/bag_sparepart/caridatasparepart'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            qtyakhir: "qtyakhir"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true and kodecabang = '"+kode_cabang+"' and kodecompany = '"+kodecompany+"'"
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
                url: "<?php echo base_url('sparepart/bag_sparepart/getdatasparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data:{kode:kode,kode_cabang:kode_cabang, kodecompany:kodecompany},   
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodesparepart').val(data[i].kode.trim());
                        $('#namasparepart').val(data[i].nama.trim());
                        stockpart(data[i].kode.trim());
                    }
                }
            });
        });

        function stockpart(kode) {
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('sparepart/bag_sparepart/caristockpart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kode_cabang: kode_cabang,
                    kodesubcabang: kodesubcabang,
                    kodecompany: kodecompany,
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#qtystock').val(data[i].sisa.trim());
                    }

                }
            });
        }

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
            // ambildatadetail();
            var nomor = $('#nomor').val();
            var tanggal = $('#tanggal').val();
            var jenis = $('#jenis_detail').val();
            var keterangan = $('#keterangan').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/bag_sparepart/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        tanggal: tanggal,
                        jenis: jenis,
                        keterangan: keterangan,
                        kodecabang: kodecabang,
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
                            $('#nomor').val(data.nomor);
                            window.open(
                                "<?php echo base_url('form/form/cetak_bag/') ?>" + data.nomor
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
                    "url": "<?php echo base_url('sparepart/bag_sparepart/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_BAGSparepart",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            keterangan: "keterangan"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
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
                url: "<?php echo base_url('sparepart/bag_sparepart/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#tanggal').val(formatDate(data[i].tanggal));
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#jenis_detail').val(data[i].jenis.trim());
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
                url: "<?php echo base_url('sparepart/bag_sparepart/finddetail'); ?>",
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
                        var harga = formatRupiah(data[i].cogs.trim());
                        inserttable(data[i].kodepart, namasparepart, qty, harga, "disabled");
                    }
                }
            });
        };
        // -- Cancel --
        // document.getElementById("cancel").addEventListener("click", function(event) {
        //     event.preventDefault();
        //     var nomor = $('#nomor').val();
        //     if(CekValidasi() == true){
        //         $.confirm({
        //             title: 'Info..',
        //             content: '' +
        //             '<form action="" class="formName">' +
        //             '<div class="form-group">' +
        //             '<label>Apakah anda yakin ?</label>' +
        //             '<input type="text" placeholder="Masukkan Alasan Pembatalan" class="alasan form-control" required />' +
        //             // '<textarea class="Alamat form-control" placeholder="alasan"  required />' +
        //             '</div>' +
        //             '</form>',
        //             buttons: {
        //                 formSubmit: {
        //                     text: 'Ok',
        //                     btnClass: 'btn-red',
        //                     action: function () {
        //                         var alasan = this.$content.find('.alasan').val();
        //                         if(!alasan){
        //                             $.alert('Alasan belum diisi');
        //                             return false;
        //                         }
        //                         $.ajax({  
        //                                 url:"<?php echo base_url('sparepart/bag_sparepart/cancel'); ?>",  
        //                                 method:"POST", 
        //                                 dataType: "json",
        //                                 async : true,
        //                                 data:{
        //                                         nomor:nomor,
        //                                         alasan:alasan
        //                                     },  
        //                                 success:function(data){ 
        //                                     if(data.error == true) {
        //                                         $.alert({
        //                                             title: 'Info..',
        //                                             content: data.message,
        //                                             buttons: {
        //                                             formSubmit: {
        //                                                 text: 'OK',
        //                                                 btnClass: 'btn-red'
        //                                                 }                                                
        //                                             }                                
        //                                         });                                      
        //                                     }
        //                                     else{
        //                                         $.alert({
        //                                                 title: 'Info..',
        //                                                 content: data.message,
        //                                                 buttons: {
        //                                                 formSubmit: {
        //                                                     text: 'OK',
        //                                                     btnClass: 'btn-red',
        //                                                     keys: ['enter', 'shift'],
        //                                                     action: function(){
        //                                                         BersihkanLayarBaru()
        //                                                         }
        //                                                     }
        //                                                 }                                                 
        //                                         });                                            
        //                                     }
        //                                 }                                                    
        //                             });  
        //                         }
        //                 },
        //                 cancel: function () {
        //                     //close
        //                 },

        //             },
        //             onContentReady: function () {
        //                 // bind to events
        //                 var jc = this;
        //                 this.$content.find('form').on('submit', function (e) {
        //                     // if the user submits the form by pressing enter in the field.
        //                     e.preventDefault();
        //                     jc.$$formSubmit.trigger('click'); // reference the button and click it
        //                 });                    
        //             }
        //         });
        //     }
        // });

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomor = $('#nomor').val();
            window.open(
                "<?php echo base_url('form/form/cetak_bag/') ?>" + nomor
            );
        });

    });
</script>