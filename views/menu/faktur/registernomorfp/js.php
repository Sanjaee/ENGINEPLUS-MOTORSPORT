<script type="text/javascript">
    $(document).ready(function() {
        var _row = null;

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
        };

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0].substring(0),
                month = getbulan(parseInt(datePart[1])),
                day = datePart[2];
            return day + ' ' + month + ' ' + year;
        };

        function BersihkanLayarBaru() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;

            $('#nomulai').val("");
            $('#noakhir').val("");
            $('#nomorfp').val("");
            $('#noinvoice').val("");
            $('#namacustomer').val("");
            $('#statusfp').val("");
            $("#aktif").prop("checked", "true");
            $('#tablesearchtampil').css('visibility', 'hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('remove').disabled = true;
            GetDataFP();
        };
        $("#loading").hide();

        function formatNpwp(value) {
            if (typeof value === 'string') {
                return value.replace(/(\d{3})(\d{2})(\d{3})(\d{3})/, '$1-$2.$3$4');
            }
        }

        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };

        $("#nomulai").keypress(function(data) {
            return angka(data);
        });

        $("#noakhir").keypress(function(data) {
            return angka(data);
        });

        function DataFP(nomorfp) {
            $.ajax({
                url: "<?php echo base_url('faktur/Registernomorfp/GetDataFP'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomorfp: nomorfp
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorfp').val(data[i].nomor_fakturpajak.trim());
                        $('#noinvoice').val(data[i].nomorinv.trim());
                        $('#namacustomer').val(data[i].nama.trim());
                        $('#statusfp').val(data[i].statufp.trim());
                        if (data[i].statufp == 'Belum Terpakai') {
                            document.getElementById('remove').disabled = false;
                        } else {
                            document.getElementById('remove').disabled = true;
                        }
                    }
                }
            });
        };

        function GetDataFP() {
            var kode_cabang = $('#scabang').val();
            var groupcabang = $('#groupcabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('faktur/Registernomorfp/CariDataFP'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_datafp",
                        field: {
                            nomor_fakturpajak: "nomor_fakturpajak",
                            tglfp: "tglfp",
                            statufp: "statufp",
                            nomorinv: "nomorinv",
                            nama: "nama"
                        },
                        sort: "nomor_fakturpajak",
                        where: {
                            nomor_fakturpajak: "nomor_fakturpajak",
                            statufp: "statufp",
                            nomorinv: "nomorinv",
                            nama: "nama"
                        },
                        value: "kodecompany = '" + kodecompany + "' and kodegroupcabang = '" + groupcabang + "'"
                    },
                }
            });
        }

        $(document).on('click', ".searchod", function() {
            _row = $(this);
            //var id = $(this).attr("data-yes");
            var nomorfp = _row.closest("tr").find("td:eq(1)").text();
            var statusfp = _row.closest("tr").find("td:eq(3)").text();
            var nomorinv = _row.closest("tr").find("td:eq(4)").text();
            var nama = _row.closest("tr").find("td:eq(5)").text();
            $('#nomorfp').val(nomorfp);

            DataFP(nomorfp);
            document.getElementById('remove').disabled = true;
        });

        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility', 'hidden');

        //------------------validasi ---------------------------
        function CekValidasi() {
            if ($('#nomulai').val() == '' || $('#noakhir').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nomor Faktur Pajak Tidak Boleh kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kode').focus();
                var result = false;
            } else if ($('#nomulai').val() > $('#noakhir').val()) {
                $.alert({
                    title: 'Info..',
                    content: 'Range Nomor Registrasi Faktur Pajak Salah',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomulai').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function CekValidasiUpdate() {
            if ($('#nomorfp').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Nomor Faktur Pajak dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomorfp').focus();
                var result = false;
                // } else if($('#nomulai').val() > $('#noakhir').val()){
                //     $.alert({
                //         title: 'Info..',
                //         content: 'Range Nomor Registrasi Faktur Pajak Salah',
                //         buttons: {
                //         formSubmit: {
                //             text: 'OK',
                //             btnClass: 'btn-red'
                //         }
                //         }
                //     });   
                //     $('#nomulai').focus();
                //     var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        // ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var nomulai = formatNpwp($('#nomulai').val());
            var noakhir = formatNpwp($('#noakhir').val());

            var kodecabang = $('#scabang').val();
            var groupcabang = $('#groupcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('faktur/Registernomorfp/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomulai: nomulai,
                        noakhir: noakhir,
                        kodecabang: kodecabang,
                        groupcabang: groupcabang,
                        kodecompany: kodecompany
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
                        if (data.kode != "") {
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
                            // $('#kode').val(data.kode);   
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
                        BersihkanLayarBaru();
                    },
                    // error: function() {
                    //     $.alert({
                    //         title: 'Info..',
                    //         content: 'Data gagal disimpan!',
                    //         buttons: {
                    //             formSubmit: {
                    //                 text: 'ok',
                    //                 btnClass: 'btn-red'
                    //             }
                    //         }
                    //     });
                    // }
                }, false);
            }
        });
        // // ---------- On Button Remove --------------------------------------
        document.getElementById("remove").addEventListener("click", function(event) {
            event.preventDefault();
            var nomorfp = $('#nomorfp').val();
            if (CekValidasiUpdate() == true) {
                $.ajax({
                    url: "<?php echo base_url('faktur/Registernomorfp/Remove'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomorfp: nomorfp
                    },
                    success: function(data) {
                        if (data.kode != "") {
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
                            $('#kode').val(data.kode);
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
                        BersihkanLayarBaru();
                    }
                }, false);
            }
        });
        // ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);

        });
    });
</script>
