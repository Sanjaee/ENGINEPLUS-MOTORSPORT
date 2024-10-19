<script>
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
                $('#tglakhir').val($.datepicker.formatDate('yyyy-mm-dd', date));
            }
        });

        $('#tanggal_akhir').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
            // todayHighlight: true,
            // startDate: new Date()
        });

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


        $(document).on('click', '#new', function() {
            location.reload(true);
        });


        $(document).on('change', '#jenisfaktur', function() {
            var jenisfaktur = $('#jenisfaktur').val();
            $("#totalar").val("0");
            $('#headerworkshopAR').empty();
            $('#detaildatalistworkshopar').empty();
            if (jenisfaktur == '0' || jenisfaktur == '1' || jenisfaktur == '2' || jenisfaktur == '3') {
                var row = '<tr>' +
                    '<th>Nomor Invoice</th>' +
                    '<th>Nama Customer</th>' +
                    '<th>Tipe</th>' +
                    '<th>Jumlah AR</th>' +
                    '<th>Uang Muka</th>' +
                    '<th>Pelunasan</th>' +
                    '<th>Sisa AR</th>' +
                    '<th>Status</th>' +
                    // <!-- <th>Umur AR</th> -->
                    // '<th>Teknisi</th>' +
                    '<th>Project Manager</th>' +
                    '<th>Jenis Customer</th>' +
                    '<th style="text-align: center;">Action</th>' +
                    '</tr>';
                $('#headerworkshopAR').append(row);
            } else if (jenisfaktur == '2' || jenisfaktur == '3') {
                var row = '<tr>' +
                    '<th>Nomor Invoice</th>' +
                    '<th>Nama Customer</th>' +
                    '<th>Tipe</th>' +
                    '<th>Jumlah AR</th>' +
                    '<th>Uang Muka</th>' +
                    '<th>Pelunasan</th>' +
                    '<th>Sisa AR</th>' +
                    '<th>Status</th>' +
                    // <!-- <th>Umur AR</th> -->
                    // '<th>Teknisi</th>' +
                    '<th>Project Manager</th>' +
                    '<th style="text-align: center;">Action</th>' +
                    '</tr>';
                $('#headerworkshopAR').append(row);
            } else if (jenisfaktur == '4' || jenisfaktur == '5') {
                var row = '<tr>' +
                    '<th>Nomor WO</th>' +
                    '<th>No Polisi</th>' +
                    '<th>Customer</th>' +
                    '<th>Tipe</th>' +
                    '<th>Total Estimasi</th>' +
                    '<th>Nilai UM</th>' +
                    '<th>Sisa</th>' +
                    '<th>Umur WO</th>' +
                    '<th>Indikator Status</th>' +
                    '<th style="text-align: center;">Action</th>' +
                    '</tr>';
                $('#headerworkshopAR').append(row);
            }
        });

        document.getElementById("query_data").addEventListener("click", function(event) {
            var jenisfaktur = $('#jenisfaktur').val();
            $("#totalar").val("0");
            if (jenisfaktur == "-") {
                $.alert({
                    title: "INFO..",
                    content: "Silakan pilih jenis faktur terlebih dulu !",
                    buttons: {
                        formSubmit: {
                            text: "OK",
                            btnClass: "btn-red"
                        }
                    }
                });
            } else {
                // var jenispencairan = $('#jenispencairan').val();
                var kodecabang = $('#scabang').val();
                var kodesubcabang = $('#kodesubcabang').val();
                var kodegrupcabang = $('#kodegrupcabang').val();
                var kodecompany = $('#kodecompany').val();
                var pencairan = $('#pencairan').val();

                var tglmulai = $('#tglmulai').val();
                var tglakhir = $('#tglakhir').val();

                if (jenisfaktur == 0 || jenisfaktur == 1 || jenisfaktur == 2 || jenisfaktur == 3) {
                    tampilworkshopAR(jenisfaktur, pencairan, kodecabang, kodecompany, kodesubcabang, kodegrupcabang, tglmulai, tglakhir);
                } else if (jenisfaktur == 4 || jenisfaktur == 5) {
                    tampilworkshopAR_WOOpen(jenisfaktur, pencairan, kodecabang, kodecompany, kodesubcabang, kodegrupcabang);
                }
            }

        });

        function tampilworkshopAR(jenisfaktur, pencairan, kodecabang, kodecompany, kodesubcabang, kodegrupcabang, tglmulai, tglakhir) {
            $('#detaildatalistworkshopar').empty();
            // if (CekValidasi() == true) {
            $.ajax({
                url: "<?php echo base_url('masterdata/workshopAR/tampilworkshopAR'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    jenisfaktur: jenisfaktur,
                    pencairan: pencairan,
                    kodecabang: kodecabang,
                    kodecompany: kodecompany,
                    kodesubcabang: kodesubcabang,
                    kodegrupcabang: kodegrupcabang,
                    tglmulai: tglmulai,
                    tglakhir: tglakhir
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (jenisfaktur == '0' || jenisfaktur == '1') {
                            var nomorfaktur = data[i].nofaktur.trim();
                            var namacustomer = data[i].customer.trim();
                            var tipe = data[i].tipe.trim();
                            var nilaifaktur = (data[i].nilaifaktur.trim());
                            var nilaiuangmuka = (data[i].nilaiuangmuka.trim());
                            var jumlahpelunasan = (data[i].nilaipenerimaan.trim());
                            var hitungsisa = parseInt(nilaifaktur.replace(",", "").replace(",", "")) - (parseInt(nilaiuangmuka.replace(",", "").replace(",", "")) + parseInt(jumlahpelunasan.replace(",", "").replace(",", "")));
                            var sisapiutang = (hitungsisa);
                            var status = data[i].statusbayar.trim();
                            // var sa = data[i].nama_teknisi.trim();
                            var projectmanager = data[i].projectmanager.trim();
                            var jeniscustomer = data[i].jeniscustomer.trim();
                            // window.open(
                            //     "<?php echo base_url('form/form/cetak_workshopAR_GR/') ?>" + pencairan
                            // );
                        } else if (jenisfaktur == '2' || jenisfaktur == '3') {
                            var nomorfaktur = data[i].nofaktur.trim();
                            var namacustomer = data[i].nama_customer.trim();
                            var tipe = data[i].tipejual.trim();
                            var nilaifaktur = data[i].total.trim();
                            var nilaiuangmuka = data[i].nilaiuangmuka.trim();
                            var jumlahpelunasan = data[i].nilaipenerimaan.trim();
                            var sisapiutang = parseInt(nilaifaktur) - (parseInt(nilaiuangmuka) + parseInt(jumlahpelunasan));
                            var status = data[i].statusbayar.trim();
                            // var sa = "-";
                            var projectmanager = "-";
                            var jeniscustomer = "";
                            // window.open(
                            //     "<?php echo base_url('form/form/cetak_workshopAR_PartCounter/') ?>" + pencairan
                            // );
                        }

                        insertdataworkshopAR(nomorfaktur, namacustomer, tipe, nilaifaktur, nilaiuangmuka, jumlahpelunasan, sisapiutang, status, projectmanager, jeniscustomer);
                        // var nomororder = data[i].nomororder.trim();
                    }
                }
            });
            // };
        };


        function insertdataworkshopAR(nomorfaktur, namacustomer, tipe, nilaifaktur, nilaiuangmuka, jumlahpelunasan, sisapiutang, status, projectmanager, jeniscustomer) {
            var row = "";
            if (sisapiutang >= 0) {
                var sisapiu = formatRupiah(sisapiutang.toString(), '')
            } else {
                var sisapiu = "-" + formatRupiah(sisapiutang.toString(), '')
            }
            row =
                '<tr id="' + nomorfaktur + '">' +
                '<td>' + nomorfaktur + '</td>' +
                '<td>' + namacustomer + '</td>' +
                '<td>' + tipe + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(nilaifaktur.toString(), '') + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(nilaiuangmuka.toString(), '') + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(jumlahpelunasan.toString(), '') + '</td>' +
                '<td style="text-align:right;">' + sisapiu + '</td>' +
                '<td>' + status + '</td>' +
                '<td>' + projectmanager + '</td>' +
                '<td>' + jeniscustomer + '</td>' +
                '<td style="text-align: center; padding-top: 3px; padding-bottom: 4px;">' +
                '<button data-table1="' + nomorfaktur + '" class="detail-history btn btn-search btn-warning" style="cursor: pointer; margin-bottom: 0rem;"><i class="fa fa-book-open"></i>&nbsp; Detail</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatalistworkshopar').append(row);
            TotalAR();
        };

        $(document).on('click', '.detail-history', function() {
            var jenisfaktur = $('#jenisfaktur').val();
            var nomorfaktur = $(this).attr("data-table1");

            if (jenisfaktur == 0 || jenisfaktur == 1) {
                window.open(
                    "<?php echo base_url('form/form/cetak_faktur/') ?>" + nomorfaktur
                );
            } else {
                window.open(
                    "<?php echo base_url('form/form/cetak_fakturpartcounter/') ?>" + nomorfaktur
                );
            }
        });

        function TotalAR() {
            var table = document.getElementById('detaildatalistworkshopar');
            var total = 0;
            var jenisfaktur = $('#jenisfaktur').val();
            if (jenisfaktur == 0 || jenisfaktur == 2) {
                for (var r = 0, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[5].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                }
            } else {
                for (var r = 0, n = table.rows.length; r < n; r++) {
                    total = total + parseInt((table.rows[r].cells[6].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                }
            }
            $("#totalar").val(formatRupiah(total.toString(), ''));
        }

        function tampilworkshopAR_WOOpen(jenisfaktur, pencairan, kodecabang, kodecompany, kodesubcabang, kodegrupcabang) {
            $('#detaildatalistworkshopar').empty();
            // if (CekValidasi() == true) {
            $.ajax({
                url: "<?php echo base_url('masterdata/workshopAR/tampilworkshopAR_WOOpen'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    jenisfaktur: jenisfaktur,
                    // jenispencairan: jenispencairan,
                    pencairan: pencairan,
                    kodecabang: kodecabang,
                    kodecompany: kodecompany,
                    kodesubcabang: kodesubcabang,
                    kodegrupcabang: kodegrupcabang
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var nospk = data[i].nospk.trim();
                        var customer = data[i].customer.trim();
                        var tipe = data[i].tipe.trim();
                        var nopolisi = data[i].nopolisi.trim();
                        var total_estimasi = data[i].nilaispk.trim();
                        var nilaiuangmuka = data[i].nilaiuangmuka.trim();
                        var sisauangmuka = data[i].sisaum.trim();
                        var umurwo = data[i].umur.trim();
                        var statussum = data[i].statussum.trim();

                        insertdataworkshopAR_WOOpen(nospk, customer, tipe, nopolisi,total_estimasi, nilaiuangmuka, sisauangmuka, statussum, umurwo);

                        // window.open(
                        //     "<?php echo base_url('form/form/cetak_workshopAR_WOOpen/') ?>" + pencairan
                        // );
                    }
                    // var nomororder = data[i].nomororder.trim();
                }
            });
            // };
        };


        function insertdataworkshopAR_WOOpen(nospk, customer, tipe, nopolisi,total_estimasi, nilaiuangmuka, sisauangmuka, statussum, umurwo) {
            var row = "";

            if (sisauangmuka >= 0) {
                var sisaum = formatRupiah(sisauangmuka.toString(), '')
            } else {
                var sisaum = "-" + formatRupiah(sisauangmuka.toString(), '')
            }
            if (statussum == 'Tunggu Dikerjakan') {
                indikatorstatus = '<span style = "text-align: center; font-weight: bold; font-size: 40px; color: red;"> &bull; </span>';
            } else if (statussum == 'Sedang Dikerjakan') {
                indikatorstatus = '<span style = "text-align: center; font-weight: bold; font-size: 40px; color: yellow;"> &bull; </span>';
            } else if (statussum == 'Selesai Dikerjakan') {
                indikatorstatus = '<span style = "text-align: center; font-weight: bold; font-size: 40px; color: green;"> &bull; </span>';
            } else if (statussum == 'Batal') {
                indikatorstatus = '<span style = "text-align: center; font-weight: bold; font-size: 40px; color: grey;"> &bull; </span>';
            }
            row =
                '<tr id="' + nospk + '">' +
                '<td>' + nospk + '</td>' +
                '<td>' + nopolisi + '</td>' +
                '<td>' + customer + '</td>' +
                '<td>' + tipe + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(total_estimasi.toString(), '') + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(nilaiuangmuka.toString(), '') + '</td>' +
                '<td style="text-align:right;">' + sisaum + '</td>' +
                '<td style="text-align:right;">' + umurwo + '</td>' +
                '<td style="text-align:left;">' + indikatorstatus + '</td>' +
                '<td style="text-align: center; padding-top: 3px; padding-bottom: 4px;">' +
                '<button data-table1="' + nospk + '" class="detail-wo btn btn-search btn-warning" style="cursor: pointer; margin-bottom: 0rem;"><i class="fa fa-book-open"></i>&nbsp; Detail</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatalistworkshopar').append(row);
            TotalWO();
        };

        $(document).on('click', '.detail-wo', function() {
            var jenisfaktur = $('#jenisfaktur').val();
            var nomorfaktur = $(this).attr("data-table1");
            window.open(
                "<?php echo base_url('form/form/cetak_closewo/') ?>" + nomorfaktur
            );
            window.open(
                "<?php echo base_url('form/form/cetak_statuspekerjaan/') ?>" + nomorfaktur
            );
        });

        function TotalWO() {
            var jenisfaktur = $('#jenisfaktur').val();
            var table = document.getElementById('detaildatalistworkshopar');
            var total = 0;
            for (var r = 0, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[6].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
            }
            if (jenisfaktur == '4') {
                $("#totalar").val(formatRupiah(total.toString(), ''));
            } else {
                $("#totalar").val("-" + formatRupiah(total.toString(), ''));
            }
        }

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("print").addEventListener("click", function(event) {
            var pencairan = $('#pencairan').val();
            var jenisfaktur = $('#jenisfaktur').val();
            var tglmulai = $('#tglmulai').val();
            var tglakhir = $('#tglakhir').val();
            if (jenisfaktur == '0' || jenisfaktur == '1') {
                window.open(
                    "<?php echo base_url('form/form/cetak_workshopAR_GR/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            } else if (jenisfaktur == '2' || jenisfaktur == '3') {
                window.open(
                    "<?php echo base_url('form/form/cetak_workshopAR_PartCounter/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            } else {
                window.open(
                    "<?php echo base_url('form/form/cetak_workshopAR_WOOpen/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            }
        });

        document.getElementById("export").addEventListener("click", function(event) {
            var pencairan = $('#pencairan').val();
            var jenisfaktur = $('#jenisfaktur').val();
            var tglmulai = $('#tglmulai').val();
            var tglakhir = $('#tglakhir').val();
            if (jenisfaktur == '0' || jenisfaktur == '1') {
                window.open(
                    "<?php echo base_url('export_excel/report/cetak_workshopAR_GR/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            } else if (jenisfaktur == '2' || jenisfaktur == '3') {
                window.open(
                    "<?php echo base_url('export_excel/report/cetak_workshopAR_PartCounter/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            } else {
                window.open(
                    "<?php echo base_url('export_excel/report/cetak_workshopAR_WOOpen/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            }
        });
    });
</script>