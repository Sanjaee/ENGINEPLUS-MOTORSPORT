<script type="text/javascript">
    $(document).ready(function() {

        // ---------- Other Function ----------------------------------------

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
                newDate = day + ' ' + month + ' ' + year;
            newDate2 = year + ' ' + month + ' ' + day;
            var kode_cabang = $('#scabang').val();
            $('#jenis_report').val("- Pilih Jenis Report -");
            $('#tglmulai').val(newDate2);
            $('#tglakhir').val(newDate2);


        }

        $('#tanggal_mulai').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
            // todayHighlight: true,
            // startDate: new Date()
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

        function cleardetail() {
            $('#tableExport tr').detach();
            // $('#tableExport').draw();
        };

        // ------------ Insert Data SPK Table -------------------
        function SPKDataDetail(tglmulai, tglakhir, kodecabang, kodecompany) {
            // cleardetail();
            $.ajax({
                url: "<?php echo base_url('form/report/SPKDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    tglmulai: tglmulai,
                    tglakhir: tglakhir,
                    kodecabang: kodecabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    // console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        // var jenis = data[i].jenis.trim();
                        var statuswo = data[i].statuswo.trim();
                        var nomorwo = data[i].nomorwo.trim();
                        var tanggal = data[i].tanggal.trim();
                        var nopolisi = data[i].nopolisi.trim();
                        var norangka = data[i].norangka.trim();
                        var nomesin = data[i].nomesin.trim();
                        var tipe = data[i].tipe.trim();
                        var namawarna = data[i].namawarna.trim();
                        var nama = data[i].nama.trim();
                        var alamat = data[i].alamat.trim();
                        var keluhan = data[i].keluhan.trim();
                        var pic = data[i].pic.trim();
                        var nohppic = data[i].nohppic.trim();
                        var nohp = data[i].nohp.trim();
                        var notlp = data[i].notlp.trim();
                        var email = data[i].email.trim();
                        var pemakai = data[i].pemakai.trim();
                        var jenisservice = data[i].jenisservice.trim();
                        var teknisi = data[i].teknisi.trim();
                        var garansi = data[i].garansi.trim();
                        var returnjob = data[i].returnjob.trim();
                        var inventaris = data[i].inventaris.trim();
                        var booking = data[i].booking.trim();
                        var nomorbooking = data[i].nomorbooking.trim();
                        var nofaktur = data[i].nofaktur.trim();
                        var tglfaktur = data[i].tglfaktur.trim();
                        var dpp = formatRupiah(data[i].dpp.trim().toString(), '');
                        var ppn = formatRupiah(data[i].ppn.trim().toString(), '');
                        var grandtotal = formatRupiah(data[i].grandtotal.trim().toString(), '');
                        var kodereferensi = data[i].kodereferensi.trim();
                        var namareferensi = data[i].namareferensi.trim();
                        var harga = formatRupiah(data[i].harga.trim().toString(), '');
                        var qty = data[i].qty.trim();
                        var discperitem = formatRupiah(data[i].discperitem.trim().toString(), '');
                        var persendiscperitem = data[i].persendiscperitem.trim();
                        var keterangan = data[i].keterangan.trim();
                        var nilaipiutang = formatRupiah(data[i].nilaipiutang.trim().toString(), '');
                        var nilaiuangmuka = formatRupiah(data[i].nilaiuangmuka.trim().toString(), '');
                        var nilaipenerimaan = formatRupiah(data[i].nilaipenerimaan.trim().toString(), '');
                        var sisapiutang = formatRupiah(data[i].sisapiutang.trim().toString(), '');
                        InsertDataSPK(statuswo, nomorwo, tanggal, nopolisi, norangka, nomesin, tipe, namawarna, keluhan, nama, alamat, pic, nohppic, nohp, notlp, email,
                            pemakai, jenisservice, teknisi, garansi, returnjob, inventaris, booking, nomorbooking, nofaktur, tglfaktur, dpp, ppn, grandtotal, kodereferensi,
                            namareferensi, harga, qty, discperitem, persendiscperitem, keterangan, nilaipiutang, nilaiuangmuka, nilaipenerimaan, sisapiutang);
                    }
                }
            });
        };

        function InsertDataSPK(statuswo, nomorwo, tanggal, nopolisi, norangka, nomesin, tipe, namawarna, keluhan, nama, alamat, pic, nohppic, nohp, notlp, email,
            pemakai, jenisservice, teknisi, garansi, returnjob, inventaris, booking, nomorbooking, nofaktur, tglfaktur, dpp, ppn, grandtotal, kodereferensi,
            namareferensi, harga, qty, discperitem, persendiscperitem, keterangan, nilaipiutang, nilaiuangmuka, nilaipenerimaan, sisapiutang) {
            var row = "";
            row =
                '<tr>' +
                '<td>' + statuswo + '</td>' +
                '<td>' + nomorwo + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + nopolisi + '</td>' +
                '<td>' + norangka + '</td>' +
                '<td>' + nomesin + '</td>' +
                '<td>' + tipe + '</td>' +
                '<td>' + namawarna + '</td>' +
                '<td>' + keluhan + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + alamat + '</td>' +
                '<td>' + pic + '</td>' +
                '<td>' + nohppic + '</td>' +
                '<td>' + nohp + '</td>' +
                '<td>' + notlp + '</td>' +
                '<td>' + email + '</td>' +
                '<td>' + pemakai + '</td>' +
                '<td>' + jenisservice + '</td>' +
                '<td>' + teknisi + '</td>' +
                '<td>' + garansi + '</td>' +
                '<td>' + returnjob + '</td>' +
                '<td>' + inventaris + '</td>' +
                '<td>' + booking + '</td>' +
                '<td>' + nomorbooking + '</td>' +
                '<td>' + nofaktur + '</td>' +
                '<td>' + tglfaktur + '</td>' +
                '<td>' + dpp + '</td>' +
                '<td>' + ppn + '</td>' +
                '<td>' + grandtotal + '</td>' +
                '<td>' + kodereferensi + '</td>' +
                '<td>' + namareferensi + '</td>' +
                '<td>' + harga + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + discperitem + '</td>' +
                '<td>' + persendiscperitem + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + nilaipiutang + '</td>' +
                '<td>' + nilaiuangmuka + '</td>' +
                '<td>' + nilaipenerimaan + '</td>' +
                '<td>' + sisapiutang + '</td>' +
                '</tr>';
            // '<tbody>';
            $('#detaildata').append(row);
        };

        // ------------ Insert Data AR Table -------------------
        function ARDataDetail(kodecabang, kodecompany) {
            // cleardetail();
            $.ajax({
                url: "<?php echo base_url('form/report/ARdetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kodecabang: kodecabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    // console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        // var jenis = data[i].jenis.trim();
                        var nofaktur = data[i].nofaktur.trim();
                        var tglfaktur = data[i].tglfaktur.trim();
                        var nomorwo = data[i].nomorwo.trim();
                        var tglwo = data[i].tglwo.trim();
                        var nocustomer = data[i].nocustomer.trim();
                        var namacustomer = data[i].namacustomer.trim();
                        var totalpart = formatRupiah(data[i].totalpart.trim().toString(), '');
                        var totaljasa = formatRupiah(data[i].totaljasa.trim().toString(), '');
                        var nilaipiutang = formatRupiah(data[i].nilaipiutang.trim().toString(), '');
                        var nilaipenerimaan = formatRupiah(data[i].nilaipenerimaan.trim().toString(), '');
                        var nilaiuangmuka = formatRupiah(data[i].nilaiuangmuka.trim().toString(), '');
                        var sisapiutang = (data[i].sisapiutang.trim());
                        var umur = data[i].umur.trim();
                        var nopolisi = data[i].nopolisi.trim();
                        var namatipe = data[i].namatipe.trim();
                        var jenismobil = data[i].jenismobil.trim();
                        var projectmanager = data[i].projectmanager.trim();
                        InsertDataAR(nofaktur, tglfaktur, nomorwo, tglwo, nocustomer, namacustomer, totalpart, totaljasa, nilaipiutang, nilaipenerimaan, nilaiuangmuka, sisapiutang, umur, nopolisi, namatipe, jenismobil,projectmanager);
                    }
                }
            });
        };

        function InsertDataAR(nofaktur, tglfaktur, nomorwo, tglwo, nocustomer, namacustomer, totalpart, totaljasa, nilaipiutang, nilaipenerimaan, nilaiuangmuka, sisapiutang, umur, nopolisi, namatipe, jenismobil,projectmanager) {
            var row = "";
            row =
                '<tr>' +
                '<td>' + nopolisi + '</td>' +
                '<td>' + namatipe + '</td>' +
                '<td>' + jenismobil + '</td>' +
                '<td>' + nofaktur + '</td>' +
                '<td>' + tglfaktur + '</td>' +
                '<td>' + nomorwo + '</td>' +
                '<td>' + tglwo + '</td>' +
                '<td>' + nocustomer + '</td>' +
                '<td>' + namacustomer + '</td>' +
                '<td style="text-align: right;">' + totalpart + '</td>' +
                '<td style="text-align: right;">' + totaljasa + '</td>' +
                '<td style="text-align: right;">' + nilaipiutang + '</td>' +
                '<td style="text-align: right;">' + nilaipenerimaan + '</td>' +
                '<td style="text-align: right;">' + nilaiuangmuka + '</td>' +
                '<td style="text-align: right;">' + sisapiutang + '</td>' +
                '<td style="text-align: right;">' + umur + '</td>' +
                '<td>' + projectmanager + '</td>' +
                '</tr>';
            $('#detaildata').append(row);
        };

        // ------------ Insert Data AR Table -------------------
        function APDataDetail(kodecabang, kodecompany) {
            // cleardetail();
            $.ajax({
                url: "<?php echo base_url('form/report/APdetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kodecabang: kodecabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    // console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        // var jenis = data[i].jenis.trim();
                        var nomor = data[i].nomor.trim();
                        var noinvoice = data[i].noinvoice.trim();
                        var tglinvoice = data[i].tglinvoice.trim();
                        var nosupplier = data[i].nosupplier.trim();
                        var namasupplier = data[i].namasupplier.trim();
                        var nilaihutang = formatRupiah(data[i].nilaihutang.trim().toString(), '');
                        var nilaipembayaran = formatRupiah(data[i].nilaipembayaran.trim().toString(), '');
                        var sisahutang = (data[i].sisahutang.trim());
                        var umur = data[i].umur.trim();
                        InsertDataAP(nomor, noinvoice, tglinvoice, nosupplier, namasupplier, nilaihutang, nilaipembayaran, sisahutang, umur);
                    }
                }
            });
        };

        function InsertDataAP(nomor, noinvoice, tglinvoice, nosupplier, namasupplier, nilaihutang, nilaipembayaran, sisahutang, umur) {
            var row = "";
            row =
                '<tr>' +
                '<td>' + nomor + '</td>' +
                '<td>' + noinvoice + '</td>' +
                '<td>' + tglinvoice + '</td>' +
                '<td>' + nosupplier + '</td>' +
                '<td>' + namasupplier + '</td>' +
                '<td style="text-align: right;">' + nilaihutang + '</td>' +
                '<td style="text-align: right;">' + nilaipembayaran + '</td>' +
                '<td style="text-align: right;">' + sisahutang + '</td>' +
                '<td style="text-align: right;">' + umur + '</td>' +
                '</tr>';
            $('#detaildata').append(row);
        };



        // ------------ Insert Header Table -------------------
        function InsertHeaderSPK() {
            var tglmulai = $('#tglmulai').val();
            var tglakhir = $('#tglakhir').val();
            var row = "";
            row =
                '<tr style="width:auto; ">' +
                '<th style="text-align: center; width:auto;" colspan="40">Data WO dan FAKTUR</th>' +
                '</tr>' +
                '<tr style="width:auto; ">' +
                '<th style="text-align: center; width:auto;" colspan="40">Periode ' + tglmulai + ' s/d ' + tglakhir + '</th>' +
                '</tr>' +
                '<tr class = "thead-dark" style="line-height: 0.5 cm; width:auto;">' +
                '<th>Status WO</th>' +
                '<th>Nomor WO</th>' +
                '<th>Tgl WO</th>' +
                '<th>No Polisi</th>' +
                '<th>No Rangka</th>' +
                '<th>No Mesin</th>' +
                '<th>Tipe</th>' +
                '<th>Warna</th>' +
                '<th>Keluhan</th>' +
                '<th>Nama Cust</th>' +
                '<th>Alamat</th>' +
                '<th>PIC</th>' +
                '<th>No HP PIC</th>' +
                '<th>No HP Cust</th>' +
                '<th>No Tlp Cust</th>' +
                '<th>Email</th>' +
                '<th>Pemakai</th>' +
                '<th>Jenis Service</th>' +
                '<th>Teknisi</th>' +
                '<th>Garansi</th>' +
                '<th>Return Job</th>' +
                '<th>Inventaris</th>' +
                '<th>Booking</th>' +
                '<th>No Booking</th>' +
                '<th>No Faktur</th>' +
                '<th>Tgl Faktur</th>' +
                '<th>DPP</th>' +
                '<th>PPN</th>' +
                '<th>Grandtotal</th>' +
                '<th>Kode Ref</th>' +
                '<th>Nama Ref</th>' +
                '<th>Harga Satuan</th>' +
                '<th>Qty</th>' +
                '<th>Disc Peritem</th>' +
                '<th>Persen Disc</th>' +
                '<th>Keterangan</th>' +
                '<th>Nilai AR</th>' +
                '<th>Nilai DP</th>' +
                '<th>Nilai Pelunasan</th>' +
                '<th>Sisa AR</th>' +
                '</tr>';
            $('#tableExport').append(row);
        };

        function InsertHeaderAR() {
            var row = "";
            row = '<tr style="line-height: 0.5 cm; ">' +
                '<th style="text-align: center;" colspan="13">Data Outstanding AR</th>' +
                '</tr>' +
                '<tr class = "thead-dark" style="line-height: 0.5 cm; ">' +
                '<th>No Polisi</th>' +
                '<th>Tipe</th>' +
                '<th>Jenis Mobil</th>' +
                '<th>No Faktur</th>' +
                '<th>Tgl Faktur</th>' +
                '<th>Nomor WO</th>' +
                '<th>Tgl WO</th>' +
                '<th>No Customer</th>' +
                '<th>Nama Customer</th>' +
                '<th>Total Part</th>' +
                '<th>Total Jasa</th>' +
                '<th>Nilai Piutang</th>' +
                '<th>Nilai Pelunasan</th>' +
                '<th>Nilai DP</th>' +
                '<th>Sisa Piutang</th>' +
                '<th>Umur Piutang</th>' +
                '<th>PM</th>' +
                '</tr>';
            $('#tableExport').append(row);
        };

        function InsertHeaderAP() {
            var row = "";
            row = '<tr style="line-height: 0.5 cm; ">' +
                '<th style="text-align: center;" colspan="9">Data Outstanding AP</th>' +
                '</tr>' +
                '<tr class = "thead-dark" style="line-height: 0.5 cm; ">' +
                '<th>No Faktur</th>' +
                '<th>No Invoice</th>' +
                '<th>Tgl Invoice</th>' +
                '<th>No Supplier</th>' +
                '<th>Nama Supplier</th>' +
                '<th>Nilai Hutang</th>' +
                '<th>Nilai Pembayaran</th>' +
                '<th>Sisa Hutang</th>' +
                '<th>Umur</th>' +
                '</tr>';
            $('#tableExport').append(row);
        };


        document.getElementById("jenis_data").addEventListener("change", function(event) {
            event.preventDefault();

            var tglmulai = $('#tglmulai').val();
            var tglakhir = $('#tglakhir').val();
            var jenis = $('#jenis_data').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();

            if (jenis == 1) {
                cleardetail();
                InsertHeaderSPK();
                SPKDataDetail(tglmulai, tglakhir, kodecabang, kodecompany);
                $('#judul').val('Data WO Detail');
            } else if (jenis == 2) {
                cleardetail();
                InsertHeaderAR();
                ARDataDetail(kodecabang, kodecompany);
                $('#judul').val('Data Outstanding AR');
            } else if (jenis == 3) {
                cleardetail();
                InsertHeaderAP();
                APDataDetail(kodecabang, kodecompany);
                $('#judul').val('Data Outstanding AP');
            } else if (jenis == 4) {
                cleardetail();
                InsertHeaderPenerimaan();
                PenerimaanDataDetail(tglmulai, tglakhir);
                PenerimaanDataSUMDetail(tglmulai, tglakhir);
                $('#judul').val('Data Penerimaan');
            }

        });

        document.getElementById("export").addEventListener("click", function(event) {
            event.preventDefault();

            var tglmulai = $('#tglmulai').val().replace("-", "").replace("-", "");
            var tglakhir = $('#tglakhir').val().replace("-", "").replace("-", "");
            var judul = $('#judul').val();
            // function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var filename = judul + ' (' + tglmulai + '-' + tglakhir + ')';
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById('tableExport');
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
            // }
        });

    });
</script>