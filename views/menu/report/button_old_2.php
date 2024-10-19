<script type="text/javascript">
    $(document).ready(function() {
        // $("#excel").css('visibility', 'hidden'); 
        $("#grup_part").hide();
        $("#bulanan").hide();
        $("#grup_customer").hide();
        $("#average").hide();
        var status = false;

        Bersihkanlayarbaru();

        // ---------- Validasi----------------------------------------
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
            return year + ' ' + month + ' ' + day;
        }

        function Bersihkanlayarbaru() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = year + ' ' + month + ' ' + day;
            var kode_cabang = $('#scabang').val();
            // $('#jenis_report').val("-- Pilih Jenis Report --");
            // $('#tglmulai').val(newDate);
            // $('#tglakhir').val(newDate);
        }

        $('#tanggal_mulai').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            // todayHighlight: true,
            // startDate: new Date()
            minDate: '+1d',
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yyyy-mm-dd',
            onSelect: function(dateStr) {
                var date = $(this).datepicker('getDate');
                date.setMonth(date.getMonth() + 1, 0);
                $('#tanggal_akhir').val($.datepicker.formatDate('yyyy-mm-dd', date));
            }
        });

        $('#tanggal_akhir').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
            // todayHighlight: true,
            // startDate: new Date()
        });

        $('#bulan_mulai').datepicker({
            format: "yyyy-mm",
            autoclose: true,
            todayHighlight: true
            // todayHighlight: true,
            // startDate: new Date()
        });

        function tampilpilihancabang() {
            var kode_cabangs = $('#scabang').val();
            var kodegrupcabangs = $('#kodegrupcabang').val();
            if ((kode_cabangs == kodegrupcabangs) || (kodegrupcabangs == 'ALL')) {
                $("#cabangs").show();
            } else {
                $("#cabangs").hide();
            }
        };
        tampilpilihancabang();

        // document.getElementById("jenis_report").addEventListener("change", function(event) {
        //     event.preventDefault();
        //     $('#viewname').val();
        //     $('#reportname').val();
        //     $('#reportlocation').val();
        //     var nmrp = $('#jenis_report').val();
        //     var gruplogin = $('#gruplogin').val();


        //     // cek Apakah report menggunakan inputan tgl
        //     if (cekstatustanggal($('#jenis_report').val(), gruplogin) == true) {
        //         $("#cetak").css('visibility', 'visible');
        //         if ($('#jenis_report').val() == 'History Spareparts') {
        //             $("#tanggalinput").css('visibility', 'visible');
        //             $("#grup_part").css('visibility', 'visible');
        //             $("#bulanan").css('visibility', 'hidden');
        //             $("#grup_customer").css('visibility', 'hidden');
        //             $("#average").css('visibility', 'hidden');
        //         } else if ($('#jenis_report').val() == 'Laporan Outstanding AR' || $('#jenis_report').val() == 'Laporan Outstanding AP' || $('#jenis_report').val() == 'Laporan Outstanding PO') {
        //             $("#tanggalinput").css('visibility', 'hidden');
        //             $("#grup_part").css('visibility', 'hidden');
        //             $("#bulanan").css('visibility', 'hidden');
        //             $("#grup_customer").css('visibility', 'hidden');
        //             $("#average").css('visibility', 'hidden');
        //         } else if ($('#jenis_report').val() == 'Kartu Piutang Customer') {
        //             $("#tanggalinput").css('visibility', 'hidden');
        //             $("#grup_part").css('visibility', 'hidden');
        //             $("#bulanan").css('visibility', 'hidden');
        //             $("#grup_customer").css('visibility', 'visible');
        //             $("#average").css('visibility', 'hidden');
        //         } else {
        //             $("#tanggalinput").css('visibility', 'visible');
        //             $("#grup_part").css('visibility', 'hidden');
        //             $("#bulanan").css('visibility', 'hidden');
        //             $("#grup_customer").css('visibility', 'hidden');
        //             $("#average").css('visibility', 'hidden');
        //         }
        //     } else if (cekstatustanggal($('#jenis_report').val(), gruplogin) == false) {
        //         $("#cetak").css('visibility', 'visible');
        //         if ($('#jenis_report').val() == 'Laporan Average Sparepart') {
        //             $("#tanggalinput").css('visibility', 'hidden');
        //             $("#grup_part").css('visibility', 'hidden');
        //             $("#bulanan").css('visibility', 'visible');
        //             $("#grup_customer").css('visibility', 'hidden');
        //             $("#average").css('visibility', 'visible');
        //         } else {
        //             $("#tanggalinput").css('visibility', 'hidden');
        //             $("#grup_part").css('visibility', 'hidden');
        //             $("#bulanan").css('visibility', 'visible');
        //             $("#grup_customer").css('visibility', 'hidden');
        //         }
        //     }
        // });

        // ---------- ON LOOKUP PARTS ------------------------------------
        document.getElementById("carireport").addEventListener("click", function(event) {
            event.preventDefault();
            var grup = $('#gruplogin').val();
            values = "aktif = true and menu = 'report' and grup = '" + grup + "'"
            $('#tablesearchreport').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [0, 1],
                "ajax": {
                    "url": "<?php echo base_url('form/report/CariDataReport'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "stpm_report",
                        field: {
                            nama_report: "nama_report"
                        },
                        sort: "index",
                        where: {
                            nama_report: "nama_report"
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchreport", function() {
            var result = $(this).attr("data-id");
            $('#jenis_report').val(result.trim());
            var gruplogin = $('#gruplogin').val();
            // cek Apakah report menggunakan inputan tgl
            if (cekstatustanggal($('#jenis_report').val(), gruplogin) == true) {
                $("#cetak").show();
                if ($('#jenis_report').val() == 'History Spareparts') {
                    $("#tanggalinput").show();
                    $("#grup_part").show();
                    $("#bulanan").hide();
                    $("#grup_customer").hide();
                    $("#average").hide();
                    // $("#jenisouts").hide();
                } else if ($('#jenis_report').val() == 'Laporan Outstanding AR' || $('#jenis_report').val() == 'Laporan Outstanding Penerimaan Transfer Part' || $('#jenis_report').val() == 'Laporan Outstanding AP' || $('#jenis_report').val() == 'Laporan Outstanding PO' || $('#jenis_report').val() == 'Laporan Outstanding Transaksi' || $('#jenis_report').val() == 'Laporan Potensial Customer') {
                    $("#tanggalinput").hide();
                    $("#grup_part").hide();
                    $("#bulanan").hide();
                    $("#grup_customer").hide();
                    $("#average").hide();
                    // $("#jenisouts").hide();
                } else if ($('#jenis_report').val() == 'Kartu Piutang Customer') {
                    $("#tanggalinput").hide();
                    $("#grup_part").hide();
                    $("#bulanan").hide();
                    $("#grup_customer").show();
                    $("#average").hide();
                    // $("#jenisouts").hide();
                } else {
                    $("#tanggalinput").show();
                    $("#grup_part").hide();
                    $("#bulanan").hide();
                    $("#grup_customer").hide();
                    $("#average").hide();
                    // $("#jenisouts").hide();
                }
            } else if (cekstatustanggal($('#jenis_report').val(), gruplogin) == false) {
                $("#cetak").show();
                if ($('#jenis_report').val() == 'Laporan Average Sparepart') {
                    $("#tanggalinput").hide();
                    $("#grup_part").hide();
                    $("#bulanan").show();
                    $("#grup_customer").hide();
                    $("#average").show();
                    // $("#jenisouts").hide();
                } else {
                    $("#tanggalinput").hide();
                    $("#grup_part").hide();
                    $("#bulanan").show();
                    $("#grup_customer").hide();
                    // $("#jenisouts").css('visibility', 'hidden');
                }
            }
        });

        function cekstatustanggal(namareport, gruplogin) {
            $.ajax({
                url: "<?php echo base_url('form/report/cekstatustanggal'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    namareport: namareport,
                    gruplogin: gruplogin,
                },
                success: function(data) {
					console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        $('#viewname').val(data[i].viewname.trim());
                        $('#reportname').val(data[i].nama_report.trim());
                        $('#reportlocation').val(data[i].url_report.trim());
                        $('#filereport').val(data[i].reportname.trim());
                        // $('#loadview').val(data[i].loadview.trim());
                        // $('#loadviewexcel').val(data[i].loadviewexcel.trim());

                        if (data[i].rangetanggal == "t") {
                            status = true;
                        } else {
                            status = false;
                        }

                        // console.log(`status tgl:`, status);
                    }
                }
            });
            return status;
        }

        //------------------ cari cabang
        document.getElementById("caricabang").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodegrupcabang = $('#kodegrupcabang').val();

            if (kode_cabang == "ALL" && kodesubcabang == "ALL" && kodegrupcabang == "ALL") { //TAM
                values = "kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang == kodegrupcabang && kodesubcabang == "ALL" && kodegrupcabang != "ALL") { //HO CABANG
                values = "kodecompany = '" + kodecompany + "' and kode in (select kode from glbm_cabang where kodegrup = '" + kodegrupcabang + "')"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") { //CABANG
                values = "kodecompany = '" + kodecompany + "' and kode = '" + kode_cabang + "'"
            } else { //SUBCABANG ATAU THS
                values = "kodecompany = '" + kodecompany + "' and kode = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }

            $('#tablesearchcabang').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('form/report/caridatacabang'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_cabang",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        // sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: values,
                        idrow: "searchcabang"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchcabang", function() {
            var result = $(this).attr("data-id");
            $('#cabang').val(result.trim());
            getcabang(result.trim());
        });

        function getcabang(kode) {
            var kodegrupcabang = $('#kodegrupcabang').val();
            $.ajax({
                url: "<?php echo base_url('form/report/getdatacabangreport'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kodegrupcabang: kodegrupcabang
                },
                success: function(data) {
					console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        $('#kodecabang').val(data[i].kode.trim());
                        $('#namacabang').val(data[i].nama.trim());
                    }
                }
            });
        }

        // ---------- ON LOOKUP PARTS ------------------------------------
        document.getElementById("cariparts").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchparts').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/entry_spk/CariDataParts'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_parts",
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

        $(document).on('click', ".searchparts", function() {
            var result = $(this).attr("data-id");
            $('#kode_part').val(result.trim());
            // DataParts(result.trim());
        });

        //------------------lookup customer---------------------------------------
        document.getElementById("caricustomer").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodegrup = $('#kodegrupcabang').val();
            $('#tablesearchcustomer').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/entry_datakendaraan/CariDataCustomer'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_customer",
                        field: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nama: "nama"
                        },
                        value: "aktif = true and kodecompany = '" + kodecompany + "' and (kodecabang = '" + kode_cabang + "' or kodecabang in (select kode from glbm_cabang where kodegrup = '" + kodegrup + "'))"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchcustomer", function() {
            var result = $(this).attr("data-id");
            $('#kodecustomer').val(result.trim());
            // DataParts(result.trim());
        });

        document.getElementById("cetak").addEventListener("click", function(event) {
            var tglmulai = $('#tglmulai').val();
            var tglakhir = $('#tglakhir').val();
            var bulan = $('#bulan').val();
            var jenis = $('#jenis_report').val();
            var kodepart = $('#kode_part').val();
            var nomorcustomer = $('#kodecustomer').val();
            // var scabang = $('#scabang').val();
            var kodegrupcabang = $('#kodegrupcabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodesubcabang = $('#subcabang').val();
            var MD = $('#md').val();
            var WD = $('#wd').val();

            var scabang = $('#kodecabang').val();
            // $('#scabang').val(cabang);

            var viewname = $('#viewname').val();
            var reportname = $('#reportname').val();
            var filereport = $('#filereport').val();
            var reportlocation = $('#reportlocation').val();
            var loadview = $('#loadview').val();
            // var kodecabang = btoa(scabang);
            var kodecabang = scabang;
            var kodegrup = btoa(kodegrupcabang);

            // Report Bertingkat  
            if (status == true && jenis == 'History Spareparts') {
                if (kodepart == "") {
                    $.alert({
                        title: 'Info..',
                        content: 'Silahkan Pilih Kode Sparepart Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#kode_part').focus();
                    var result = false;
                } else {
                    window.open(
                        "<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + kodepart + ":" + tglmulai + ":" + tglakhir + ":" + kodesubcabang + ":" + kodegrup + ":" + loadview
                    );
                }
            } else if (status == true && jenis == 'Kartu Piutang Customer') {
                if (nomorcustomer == "") {
                    $.alert({
                        title: 'Info..',
                        content: 'Silahkan Pilih Nomor Customer Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#kodecustomer').focus();
                    var result = false;
                } else {
                    window.open(
                        "<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + nomorcustomer + ":" + kodegrup + ":" + kodesubcabang + ":" + kodecabang + ":" + loadview
                    );
                }
            } else if (status == false && jenis == 'Laporan Average Sparepart') {
                if (MD == "") {
                    $.alert({
                        title: 'Info..',
                        content: 'Silahkan Isi MD Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#md').focus();
                    var result = false;
                } else if (WD == "") {
                    $.alert({
                        title: 'Info..',
                        content: 'Silahkan Isi WD Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('wd').focus();
                    var result = false;
                } else {
                    window.open(
                        "<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + bulan + ":" + MD + ":" + ":" + WD + ":" + kodesubcabang + ":" + kodegrup + ":" + loadview
                    );
                }
            } else if (status == true) {
                window.open(
                    "<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + tglmulai + ":" + tglakhir + ":" + kodesubcabang + ":" + kodegrup + ":" + loadview
                );
            } else if (status == false) {
                window.open(
                    "<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + bulan + ":" + kodesubcabang + ":" + kodegrup + ":" + loadview
                );
                // } else if (status == false) {
                //     $.alert({
                //         title: 'Info..',
                //         content: 'Silahkan Pilih Jenis Report Terlebih Dahulu',
                //         buttons: {
                //             formSubmit: {
                //                 text: 'OK',
                //                 btnClass: 'btn-red'
                //             }
                //         }
                //     });
                //     $('#jenis_report').focus();
                //     var result = false;
            };
        });

        document.getElementById("excel").addEventListener("click", function(event) {
            var tglmulai = $('#tglmulai').val();
            var tglakhir = $('#tglakhir').val();
            var bulan = $('#bulan').val();
            var jenis = $('#jenis_report').val();
            var kodepart = $('#kode_part').val();
            // var kodecabang = $('#scabang').val();
            // var kodecabang = "<?php echo $this->session->userdata('mycabang') ?>";
            var kodecabang = $('#kodecabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            var kodegrupcabang = $('#kodegrupcabang').val();
            var MD = $('#md').val();
            var WD = $('#wd').val();

            var nomorcustomer = $('#kodecustomer').val();
            var viewname = $('#viewname').val();
            var reportname = $('#reportname').val();
            var filereport = $('#filereport').val();
            var reportlocation = $('#reportlocation').val();
            var loadviewexcel = $('#loadviewexcel').val();

            if (status == true && jenis == 'History Spareparts') {
                if (kodepart == "") {
                    $.alert({
                        title: 'Info..',
                        content: 'Silahkan Pilih Kode Sparepart Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#kode_part').focus();
                    var result = false;
                } else {
                    window.open(
                        "<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + kodepart + ":" + tglmulai + ":" + tglakhir + ":" + kodesubcabang + ":" + kodegrupcabang + ":" + loadviewexcel
                    );
                }
            } else if (status == true && jenis == 'Kartu Piutang Customer') {
                if (nomorcustomer == "") {
                    $.alert({
                        title: 'Info..',
                        content: 'Silahkan Pilih Nomor Customer Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#kodecustomer').focus();
                    var result = false;
                } else {
                    window.open(
                        "<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + nomorcustomer + ":" + kodegrupcabang + ":" + kodesubcabang + ":" + kodecabang + ":" + loadviewexcel
                    );
                }
            } else if (status == true) {
                window.open(
                    "<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + tglmulai + ":" + tglakhir + ":" + kodesubcabang + ":" + kodegrupcabang + ":" + loadviewexcel
                );
            } else if (status == false && jenis == 'Laporan Average Sparepart') {
                if (MD == "") {
                    $.alert({
                        title: 'Info..',
                        content: 'Silahkan Isi MD Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#md').focus();
                    var result = false;
                } else if (WD == "") {
                    $.alert({
                        title: 'Info..',
                        content: 'Silahkan Isi WD Terlebih Dahulu',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('wd').focus();
                    var result = false;
                } else {
                    window.open(
                        "<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + bulan + ":" + MD + ":" + ":" + WD + ":" + kodesubcabang + ":" + kodegrupcabang + ":" + loadviewexcel
                    );
                }
            } else if (status == false) {
                window.open(
                    "<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + bulan + ":" + kodesubcabang + ":" + kodegrupcabang + ":" + loadviewexcel
                );
                // $.alert({
                //     title: 'Info..',
                //     content: 'Silahkan Pilih Jenis Report Terlebih Dahulu',
                //     buttons: {
                //         formSubmit: {
                //             text: 'OK',
                //             btnClass: 'btn-red'
                //         }
                //     }
                // });
                // $('#jenis_report').focus();
                // var result = false;
            };
        });
    });
</script>
