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
                newDate = month + ' ' + year;
            $('#tglclosing').val(newDate);
            $('#tanggal').datepicker({
                format: "MM yyyy",
                autoclose: true
            });
            $("#part").prop("checked", "true");
            $('#tablesearchtampil').css('visibility', 'hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('update').disabled = true;
            document.getElementById('tglclosing').disabled = false;
            GetDataClosing();


        };

        
        document.getElementById("part").addEventListener("change", function(event) {
            event.preventDefault();
            var part = $("#part").val();
            if (part == "1") {
                GetDataClosing();
            }
        });

        document.getElementById("kasir").addEventListener("change", function(event) {
            event.preventDefault();
            var kasir = $("#kasir").val();
            if (kasir == "2") {
                GetDataClosing();
            }
        });

        function DataClosing(periode, jenis) {
            var grupcabang = $('#grupcabang').val();
            console.log(periode);
            $.ajax({
                url: "<?php echo base_url('masterdata/closing_accounting/GetDataClosing'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    periode: periode,
                    jenis: jenis,
                    grupcabang
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#tglclosing').val(data[i].periode.trim());
                        if (data[i].jenis == '1') {
                            $('input:radio[name="jenis"][value="1"]').prop('checked', true);
                        } else {
                            $('input:radio[name="jenis"][value="2"]').prop('checked', true);
                        }
                    }
                }
            });
        };

        function GetDataClosing() {
            var grupcabang = $('#grupcabang').val();
            var jenis = $("input[name='jenis']:checked").val();
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('masterdata/closing_accounting/CariDataClosing'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "vw_caristatusclosing",
                        field: {
                            periode: "periode",
                            jenis: "jenis",
                            kode_cabang: "kode_cabang",
                            kodegrup: "kodegrup",
                            statusclosing: "statusclosing"
                        },
                        sort: "periode",
                        where: {
                            periode: "periode",
                            kode_cabang: "kode_cabang",
                            kodegrup: "kodegrup",
                            statusclosing: "statusclosing"
                        },
                        value: "kodegrup = '" + grupcabang + "' and jenis = '" + jenis + "' "
                    },
                }
            });
        }

        $(document).on('click', ".searchod", function() {
            _row = $(this);
            var periode = _row.closest("tr").find("td:eq(1)").text();
            var jenis = _row.closest("tr").find("td:eq(2)").text();
            var kode_cabang = _row.closest("tr").find("td:eq(3)").text();
            var status = _row.closest("tr").find("td:eq(4)").text();


            DataClosing(periode, jenis);
            document.getElementById('tglclosing').disabled = true;
            document.getElementById('save').disabled = true;
            document.getElementById('update').disabled = false;
        });

        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

        //------------------validasi ---------------------------
        function CekValidasi() {
            // if($('#kode').val() == '' || $('#grup').val() == ''){
            //     $.alert({
            //         title: 'Info..',
            //         content: 'Group Tidak Boleh Kosong',
            //         buttons: {
            //         formSubmit: {
            //             text: 'OK',
            //             btnClass: 'btn-red'
            //         }
            //         }
            //     });   
            //     $('#kode').focus();
            //     var result = false;
            // } else if($('#module').val() == '0' || $('#module').val() == ''){
            //     $.alert({
            //         title: 'Info..',
            //         content: 'Pilih Kategori Disc Terlebih Dahulu',
            //         buttons: {
            //         formSubmit: {
            //             text: 'OK',
            //             btnClass: 'btn-red'
            //         }
            //         }
            //     });   
            //     $('#module').focus();
            //     var result = false;
            // }
            // else{
            //     var result = true;
            // }
            // return result;
            var result = true;
            return result;
        };
        // ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var periode = $('#tglclosing').val();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodesubcabang = $('#subcabang').val();
            var grupcabang = $('#grupcabang').val();
            var jenis = $("input[name='jenis']:checked").val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/closing_accounting/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        periode: periode,
                        kode_cabang: kode_cabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        grupcabang: grupcabang,
                        jenis: jenis
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
                        // BersihkanLayarBaru();
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
        // ---------- On Button Update --------------------------------------
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var periode = $('#tglclosing').val();
            var kode_cabang = $('#scabang').val();
            var jenis = $("input[name='jenis']:checked").val();
            var kodecompany = $('#kodecompany').val();
            var kodesubcabang = $('#subcabang').val();
            var grupcabang = $('#grupcabang').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/closing_accounting/Update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        periode: periode,
                        kode_cabang: kode_cabang,
                        kodesubcabang: kodesubcabang,
                        kodecompany: kodecompany,
                        grupcabang: grupcabang,
                        jenis: jenis
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
                        // BersihkanLayarBaru();
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