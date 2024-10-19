<!-- <script type="text/javascript">
    $(document).ready( function () {  
        $('#tglestimasi').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true,
            startDate: new Date()
        });
    });
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablesearchtampil').css('visibility', 'hidden');

        // ---------- Validasi----------------------------------------
        function CekValidasi() {

            if ($('#nomororder').val() == '' || $('#namasupplier').val() == '') {
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
                $('#nomororder').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function BersihkanLayar() {
            location.reload(true);
        };

        function BrowseData() {
            document.getElementById('cancel').disabled = false;
            document.getElementById('cariorder').disabled = true;
            document.getElementById('qty').disabled = true;
            $('.hapus').prop("disabled", true);
        };

        function FindData() {
            document.getElementById('save').disabled = true;
            document.getElementById('cancel').disabled = false;
            document.getElementById('cariorder').disabled = true;
            document.getElementById('qty').disabled = true;
            $('.hapus').prop("disabled", true);
        };

        function statusapprove(status) {
            if (status == "t") {
                document.getElementById('harga').disabled = true;
                document.getElementById('update').disabled = true;
                document.getElementById('approve').disabled = true;
            } else {
                document.getElementById('update').disabled = false;
                document.getElementById('approve').disabled = false;
            }

        }

        function DataSparepart(kode, find) {
            var returnValue;
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/getdatasparepart'); ?>",
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

        //--find detail
        function FindDataDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/finddetail'); ?>",
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
                        var hargasatuan = data[i].harga.trim();
                        var qty = data[i].qty.trim();
                        var qtygr = data[i].qtygr.trim();
                        var total = formatRupiah(data[i].total.trim().toString(), '');
                        var qtyterima = "0";
                        var persen = "0";
                        var discount = "0";
                        inserttable(data[i].kodepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, "disabled");
                    }
                }
            });
        };

        function inserttable(kodesparepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, find) {
            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + formatRupiah(hargasatuan.toString(), '') + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtygr + '</td>' +
                '<td>' + (qty - qtygr) + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + formatRupiah((hargasatuan * (qty - qtygr)).toString(), '') + '</td>' +
                '<td>' +
                //'<button data-table="'+ kodesparepart +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN();
            Grandtotal();
        }
        //------end here------

        function validasiadd() {
            console.log("aaaa");
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

        function subtotal() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#dpp").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 8) {
                        total = total + parseInt((table.rows[r].cells[c].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                        $("#dpp").val(formatRupiah(total.toString(), ''));

                    }
                }
            }
        }

        function PPN() {
            var dpp = $('#dpp').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");

            var hitungppn = (parseFloat(dpp.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * 10) / 100;
            var roundppn = Math.round(hitungppn);
            $('#ppn').val(formatRupiah(roundppn.toString(), ''));
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


        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = datePart[1],
                day = datePart[2];

            return day + '-' + month + '-' + year;
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

        $("#qtyterima").keypress(function(data) {
            return angka(data);
        });

        $("#qtyterima").keyup(function() {
            var qtyterima = this.value;
            return HitungTotal2();
        });

        $("#persen").keypress(function(data) {
            return angka(data);
        });

        $("#persen").keyup(function() {
            var persen = this.value;
            return HitungTotal3();
        });

        function HitungTotal() {
            var qty = $('#qty').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qty.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total').val(total.toString());
        }

        function HitungTotal2() {
            var qtyterima = $('#qtyterima').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = $('#discount').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var total = (parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) - parseFloat(discount.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(qtyterima.replace(",", "").replace(",", "").replace(",", "").replace(",", ""));
            $('#total').val(formatRupiah(total.toString(), ''));
            //$('#total').val(total.toString());
        }

        function HitungTotal3() {
            var persen = $('#persen').val();
            var hargasatuan = $('#hargasatuan').val().replace(",", "").replace(",", "").replace(",", "").replace(",", "");
            var discount = (parseFloat(persen.replace(",", "").replace(",", "").replace(",", "").replace(",", "")) * parseFloat(hargasatuan.replace(",", "").replace(",", "").replace(",", "").replace(",", ""))) / 100;
            $('#discount').val(formatRupiah(discount.toString(), ''));
            HitungTotal2();
        }


        //-----end here-----//

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


        var nominal = document.getElementById('hargasatuan');
        nominal.addEventListener('keyup', function(e) {
            nominal.value = formatRupiah(this.value, '');
        });

        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayar();
        });
        // -- END NEW -- 

        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();

            var datadetail = ambildatadetail();
            //ambildatadetail();

            var nomorpenerimaan = $('#nomorpenerimaan').val();
            var tanggalPenerimaan = $('.tanggalPenerimaan').val();
            var nomororder = $('#nomororder').val();
            var kodesupplier = $('#kodesupplier').val();
            var dpp = $('#dpp').val();
            var ppn = $('#ppn').val();
            var grandtotal = $('#grandtotal').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/penerimaan_sparepart/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomorpenerimaan: nomorpenerimaan,
                        tanggalPenerimaan: tanggalPenerimaan,
                        nomororder: nomororder,
                        kodesupplier: kodesupplier,
                        dpp: dpp,
                        ppn: ppn,
                        grandtotal: grandtotal,
                        detail: datadetail
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
                            $('#nomorpenerimaan').val(data.nomor);
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
                    }
                }, false);
            }
        });
        // -- END SAVE --

        // -- FIND --
        document.getElementById("cariorder").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility', 'visible');
            var cabang = "BDG";
            $('#tablesearchorder').DataTable({
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
                    "url": "<?php echo base_url('sparepart/penerimaan_sparepart/caridatafind'); ?>",
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
                            namasupplier: "namasupplier"
                        },
                        value: "batal = false and kode_cabang = '" + cabang + "'"
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchorder").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('sparepart/penerimaan_sparepart/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomororder').val(data[i].nomor.trim());
                        $('#tanggalorder').val(formatDate(data[i].tanggal));
                        $('#kodesupplier').val(data[i].kodesupplier.trim());
                        $('#namasupplier').val(data[i].namasupplier.trim());
                        $('#alamat').val(data[i].alamatsupplier.trim());
                        FindDataDetail(data[i].nomor.trim());
                        // statusapprove(data[i].approve);
                    }
                    BrowseData();
                }
            }, false);
            $('.popup1').css('visibility', 'hidden');
        });
        // -- END FIND --


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


        // document.getElementById("update").addEventListener("click", function(event) {
        //     event.preventDefault();
        //     var harga = $('#harga').val();
        //     var nomor = $('#nomor').val();
        //     if(CekValidasi() == true){
        //         $.ajax({  
        //             url:"<?php echo base_url('rental/booking_pariwisata/updateharga'); ?>",  
        //             method:"POST", 
        //             dataType: "json",
        //             async : true,
        //             data:{
        //                     nomor:nomor,
        //                     harga:harga
        //                 },  
        //             success:function(data){ 

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

        document.getElementById("approve").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('sparepart/ordering_sparepart/approve'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        approve: true,
                        nomor: nomor
                    },
                    success: function(data) {
                        statusapprove("t");
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

        // ---------- ADD DETAIL ---------------------------------------------
        $("#add_detail").click(function() {
            var total = parseInt($('#qtyterima').val()) + parseInt($('#qtygr').val());
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
                $('#qtyterima').focus();
                var result = false;
            } else {

                var kodesparepart = $("#kodesparepart").val();
                var namasparepart = $("#namasparepart").val();
                var hargasatuan = $("#hargasatuan").val();
                var qty = $("#qty").val();
                var qtygr = $("#qtygr").val();
                var qtyterima = $("#qtyterima").val();
                var persen = $("#persen").val();
                var discount = $("#discount").val();
                var total = $("#total").val();

                if (validasiadd() == "sukses") {
                    inserttabledisc(kodesparepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, "disabled")
                    $("#kodesparepart").val("");
                    $("#namasparepart").val("");
                    $("#hargasatuan").val("0");
                    $("#qty").val("0");
                    $("#qtygr").val("0");
                    $("#qtyterima").val("0");
                    $("#persen").val("0");
                    $("#discount").val("0");
                    $("#total").val("0");
                }
            }
        });

        function inserttabledisc(kodesparepart, namasparepart, hargasatuan, qty, qtygr, qtyterima, persen, discount, total, find) {

            _row.closest("tr").find("td").remove();


            var row = "";
            row =
                '<tr id="' + kodesparepart + '">' +
                '<td>' + kodesparepart + '</td>' +
                '<td>' + namasparepart + '</td>' +
                '<td>' + hargasatuan + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + qtygr + '</td>' +
                '<td>' + qtyterima + '</td>' +
                '<td>' + persen + '</td>' +
                '<td>' + discount + '</td>' +
                '<td>' + total + '</td>' +
                '<td>' +
                //'<button data-table="'+ jenis +'" class="hapus btn btn-close" '+find+'><i class="fa fa-times"></i></button>' +
                '<button data-yes="' + kodesparepart + '" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            // $('#bebas').html(row);
            subtotal();
            PPN();
            Grandtotal();
        }


        $(document).on('click', '.edit', function() {

            _row = $(this);
            //var id = $(this).attr("data-yes");
            var kodesparepart = _row.closest("tr").find("td:eq(0)").text();
            var namasparepart = _row.closest("tr").find("td:eq(1)").text();
            var hargasatuan = _row.closest("tr").find("td:eq(2)").text();
            var qty = _row.closest("tr").find("td:eq(3)").text();
            var qtygr = _row.closest("tr").find("td:eq(4)").text();
            var qtyterima = _row.closest("tr").find("td:eq(5)").text();
            var persen = _row.closest("tr").find("td:eq(6)").text();
            var discount = _row.closest("tr").find("td:eq(7)").text();
            var total = _row.closest("tr").find("td:eq(8)").text();
            $('#kodesparepart').val(kodesparepart);
            $('#namasparepart').val(namasparepart);
            $('#hargasatuan').val(hargasatuan);
            $('#qty').val(qty);
            $('#qtygr').val(qtygr);
            $('#qtyterima').val(qtyterima);
            $('#persen').val(persen);
            $('#discount').val(discount);
            $('#total').val(total);

            //Saat edit Hapus dulu yang lama pas add masukan yg baru

        });



    });
</script>