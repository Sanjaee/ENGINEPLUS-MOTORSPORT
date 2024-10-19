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

        $(document).on('change', '#jenisfaktur', function() {
            var jenisfaktur = $('#jenisfaktur').val();
            $('#headerworkshopAP').empty();
            $('#datadetailworkshopap').empty();
            $("#totalar").val("0");
            if (jenisfaktur == '0' || jenisfaktur == '1') {
                var row = '<tr>' +
                    '<th>Nomor</th>' +
                    '<th>Tanggal</th>' +
                    '<th>Nomor Invoice</th>' +
                    '<th>Nama Supplier</th>' +
                    '<th>Nomor WO</th>' +
                    '<th>No Polisi</th>' +
                    '<th>Harga Beli</th>' +
                    '<th>Harga Jual</th>' +
                    '<th>Margin</th>' +
                    '<th>Status WO</th>' +
                    '<th>Invoice Receive</th>' +
                    '<th>Status Bayar</th>' +
                    '<th>Tgl Lunas</th>' +
                    '<th>Sisa AP</th>' +
                    '<th style="text-align: center;">Action</th>' +
                    '</tr>';
                $('#headerworkshopAP').append(row);
            } else if (jenisfaktur == '2' || jenisfaktur == '3' || jenisfaktur == '4') {
                var row = '<tr>' +
                    '<th>Nomor</th>' +
                    '<th>Tanggal</th>' +
                    '<th>Supplier</th>' +
                    '<th>Keterangan</th>' +
                    '<th>No Penerimaan</th>' +
                    '<th>Tgl Terima</th>' +
                    '<th>No Invoice</th>' +
                    '<th>Tgl Invoice</th>' +
                    '<th>Total Invoice</th>' +
                    '<th>Nilai Uang Muka</th>' +
                    '<th>Nilai Bayar</th>' +
                    '<th>Tgl Lunas</th>' +
                    '<th>Status Invoice</th>' +
                    '<th>Status PO</th>' +
                    '<th>Status Bayar</th>' +
                    '<th>Sisa Invoice</th>' +
                    '<th style="text-align: center;">Action</th>' +
                    '</tr>';
                $('#headerworkshopAP').append(row);
            }
        });

        document.getElementById("query_data").addEventListener("click", function(event) {
            $('#datadetailworkshopap').empty();
            var jenisfaktur = $('#jenisfaktur').val();
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

                tampilworkshopAP(jenisfaktur, pencairan, kodecabang, kodecompany, kodesubcabang, kodegrupcabang, tglmulai, tglakhir);
            }

        });


        function tampilworkshopAP(jenisfaktur, pencairan, kodecabang, kodecompany, kodesubcabang, kodegrupcabang, tglmulai, tglakhir) {
            $('#detaildatalistworkshopar').empty();
            // if (CekValidasi() == true) {
            $.ajax({
                url: "<?php echo base_url('masterdata/workshopAP/tampilworkshopAP'); ?>",
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
                    kodegrupcabang: kodegrupcabang,
                    tglmulai: tglmulai,
                    tglakhir: tglakhir
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        if (jenisfaktur == '0' || jenisfaktur == '1') {
                            var tanggal = formatDate(data[i].tanggal.trim());
                            var nomor = data[i].nomor.trim();
                            var namasupplier = data[i].namasupplier.trim();
                            var nomor_wo = data[i].nomor_wo.trim();
                            var nopolisi = data[i].nopolisi.trim();
                            // var kode_pekerjaan = data[i].kode_pekerjaan.trim();
                            // var nama_pekerjaan = data[i].nama_pekerjaan.trim();
                            var hargabeli = formatRupiah(data[i].cogs.trim().toString(), '');
                            var hargajual = formatRupiah(data[i].harga.trim().toString(), '');
                            var statuswo = data[i].statuswo.trim();
                            var statusinv = data[i].statusinv.trim();
                            var statusbayar = data[i].statusbayar.trim();
                            if (data[i].tgllunas == null) {
                                var tgllunas = "-";
                            } else {
                                var tgllunas = formatDate(data[i].tgllunas.trim());
                            }
                            var margin = data[i].margin.trim();
                            var sisaap = data[i].sisaap.trim();
                            var noinvoice = data[i].noinvoice.trim();
                            insertdataworkshopAP_OPL(nomor, tanggal,noinvoice, namasupplier, nomor_wo, nopolisi, hargabeli, hargajual, statuswo, statusinv, statusbayar, tgllunas, margin, sisaap);

                            // window.open(
                            //     "<?php echo base_url('form/form/cetak_workshopAP_OPL/') ?>" + pencairan
                            // );

                        } else if (jenisfaktur == '2' || jenisfaktur == '3' || jenisfaktur == '4') {
                            var nomor = data[i].nomor.trim();
                            var tanggal = formatDate(data[i].tanggal.trim());
                            if (data[i].namasupplier == "") {
                                var keterangan = "-";
                            } else {
                                var keterangan = data[i].namasupplier;
                            }

                            if (data[i].nopenerimaan == null) {
                                var nopenerimaan = ''
                            } else {
                                var nopenerimaan = data[i].nopenerimaan;
                            }
                            if (data[i].tglterima == null) {
                                var tglterima = ''
                            } else {
                                var tglterima = formatDate(data[i].tglterima);
                            }
                            if (data[i].noinvoice == null) {
                                var noinvoice = ''
                            } else {
                                var noinvoice = (data[i].noinvoice);
                            }
                            if (data[i].tglinvoice == null) {
                                var tglinvoice = ''
                            } else {
                                var tglinvoice = formatDate(data[i].tglinvoice);
                            }
                            if (data[i].nilaiuangmuka == null) {
                                var nilaiuangmuka = 0
                            } else {
                                var nilaiuangmuka = (data[i].nilaiuangmuka);
                            }
                            if (data[i].totaliv == null) {
                                var totaliv = 0
                            } else {
                                var totaliv = (data[i].totaliv);
                            }
                            if (data[i].nilaibayar == null) {
                                var nilaibayar = 0
                            } else {
                                var nilaibayar = data[i].nilaibayar;
                            }
                            if (data[i].tgllunas == null) {
                                var tgllunas = "-";
                            } else {
                                var tgllunas = formatDate(data[i].tgllunas);
                                // var nilaibayar = data[i].nilaibayar;
                            }

                            var statuspo = data[i].statuspo;
                            var statusiv = data[i].statusiv;
                            var statusbayar = data[i].statusbayar.trim();
                            var sisa = parseInt(totaliv) - (parseInt(nilaiuangmuka) + parseInt(nilaibayar));

                            if (parseInt(nilaibayar) > parseInt(totaliv)) {
                                var sisaiv = "-" + sisa;
                            } else {
                                var sisaiv = sisa;
                            }
                            var keterangan2 = data[i].keterangan;

                            insertdataworkshopAP_Part(nomor, tanggal, keterangan2, keterangan, nopenerimaan, tglterima, noinvoice, tglinvoice, totaliv, nilaiuangmuka, nilaibayar, tgllunas, statusiv, statuspo, statusbayar, sisaiv);

                            // window.open(
                            //     "<?php echo base_url('form/form/cetak_workshopAP_PartCounter/') ?>" + pencairan
                            // );
                        }
                        // var nomororder = data[i].nomororder.trim();
                    }
                }
            });
            // };
        };

        function insertdataworkshopAP_OPL(nomor, tanggal,noinvoice, namasupplier, nomor_wo, nopolisi, hargabeli, hargajual, statuswo, statusinv, statusbayar, tgllunas, margin, sisaap) {
            var row = "";
            if (sisaap >= 0) {
                var sisahutang = formatRupiah(sisaap.toString(), '')
            } else {
                var sisahutang = "-" + formatRupiah(sisaap.toString(), '')
            }
            if (margin >= 0) {
                var marginsistem = formatRupiah(margin.toString(), '')
            } else {
                var marginsistem = "-" + formatRupiah(margin.toString(), '')
            }
            row =
                '<tr id="' + nomor + '">' +
                '<td>' + nomor + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + noinvoice + '</td>' +
                '<td>' + namasupplier + '</td>' +
                '<td>' + nomor_wo + '</td>' +
                '<td>' + nopolisi + '</td>' +
                '<td style="text-align:right;">' + hargabeli + '</td>' +
                '<td style="text-align:right;">' + hargajual + '</td>' +
                '<td style="text-align:right;">' + marginsistem + '</td>' +
                '<td>' + statuswo + '</td>' +
                '<td>' + statusinv + '</td>' +
                '<td>' + statusbayar + '</td>' +
                '<td>' + tgllunas + '</td>' +
                '<td style="text-align:right;">' + sisahutang + '</td>' +
                '<td style="text-align: center; padding-top: 3px; padding-bottom: 4px;">' +
                '<button data-table1="' + nomor + '" class="detail-opl btn btn-search btn-warning" style="cursor: pointer; margin-bottom: 0rem;"><i class="fa fa-book-open"></i>&nbsp; Detail</button>' +
                '</td>' +
                '</tr>';
            $('#datadetailworkshopap').append(row);
            TotalAR();
        };

        $(document).on('click', '.detail-opl', function() {
            var nomorfaktur = $(this).attr("data-table1");
            window.open(
                "<?php echo base_url('form/form/cetak_opl/') ?>" + nomorfaktur
            );
        });

        function TotalAR() {
            var table = document.getElementById('datadetailworkshopap');
            var total = 0;
            for (var r = 0, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[13].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
            }
            $("#totalar").val(formatRupiah(total.toString(), ''));

        }

        function insertdataworkshopAP_Part(nomor, tanggal, keterangan2, keterangan, nopenerimaan, tglterima, noinvoice, tglinvoice, totalinv, nilaiuangmuka, nilaibayar, tgllunas, statusiv, statuspo, statusbayar, sisaiv) {
            var row = "";   
            if (sisaiv >= 0) {
                var sisair = formatRupiah(sisaiv.toString(), '')
            } else {
                var sisair = "-" + formatRupiah(sisaiv.toString(), '')
            }
            row =
                '<tr id="' + nomor + '">' +
                '<td>' + nomor + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + keterangan2 + '</td>' +
                '<td>' + nopenerimaan + '</td>' +
                '<td>' + tglterima + '</td>' +
                '<td>' + noinvoice + '</td>' +
                '<td>' + tglinvoice + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(totalinv.toString(), '') + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(nilaiuangmuka.toString(), '') + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(nilaibayar.toString(), '') + '</td>' +
                '<td>' + tgllunas + '</td>' +
                '<td>' + statusiv + '</td>' +
                '<td>' + statuspo + '</td>' +
                '<td>' + statusbayar + '</td>' +
                '<td style="text-align:right;">' + sisair + '</td>' +
                '<td style="text-align: center; padding-top: 3px; padding-bottom: 4px;">' +
                '<button data-table1="' + nomor + '" data-table="' + nopenerimaan + '" class="detail-part btn btn-search btn-warning" style="cursor: pointer; margin-bottom: 0rem;"><i class="fa fa-book-open"></i>&nbsp; Detail</button>' +
                '</td>' +
                '</tr>';
            $('#datadetailworkshopap').append(row);
            TotalApPart();
        };

        $(document).on('click', '.detail-part', function() {
            var nomorpo = $(this).attr("data-table1");
            var nopenerimaan = $(this).attr("data-table");
            window.open(
                "<?php echo base_url('form/form/cetak_penerimaanpart/') ?>" + nopenerimaan
            );
            window.open(
                "<?php echo base_url('form/form/cetak_orderpart/') ?>" + nomorpo
            );
        });

        function TotalApPart() {
            var table = document.getElementById('datadetailworkshopap');
            var total = 0;
            for (var r = 0, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[15].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
            }
            $("#totalar").val(formatRupiah(total.toString(), ''));
        }

        // ---------- ON BUTTON CETAK ---------------------------------------------
        document.getElementById("print").addEventListener("click", function(event) {
            var pencairan = $('#pencairan').val();
            var jenisfaktur = $('#jenisfaktur').val();
            var tglmulai = $('#tglmulai').val();
            var tglakhir = $('#tglakhir').val();
            if (jenisfaktur == '0' || jenisfaktur == '1') {
                window.open(
                    "<?php echo base_url('form/form/cetak_workshopAP_OPL/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            } else if (jenisfaktur == '2' || jenisfaktur == '3' || jenisfaktur == '4') {
                window.open(
                    "<?php echo base_url('form/form/cetak_workshopAP_PartCounter/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
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
                    "<?php echo base_url('export_excel/report/cetak_workshopAP_OPL/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            } else if (jenisfaktur == '2' || jenisfaktur == '3' || jenisfaktur == '4') {
                window.open(
                    "<?php echo base_url('export_excel/report/cetak_workshopAP_PartCounter/') ?>" + pencairan + ":" + tglmulai + ":" + tglakhir + ":" + jenisfaktur
                );
            }
        });
    });
</script>