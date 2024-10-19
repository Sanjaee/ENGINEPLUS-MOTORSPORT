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

        // $('#tgl').datepicker({
        //     format: "dd MM yyyy",
        //     autoclose: true,
        //     todayHighlight: true,
        //     startDate: ambiltanggalkonfigurasi()
        // });

        // function ambiltanggalkonfigurasi() {
        //     var tglservice = "";
        //     $.ajax({
        //         url: "<?php echo base_url('masterdata/history_penjualan/ambiltanggalkonfigurasi'); ?>",
        //         method: "POST",
        //         dataType: "json",
        //         async: false,
        //         data: {},
        //         success: function(data) {
        //             if (!data.length == 0) {
        //                 for (var i = 0; i < data.length; i++) {
        //                     tglservice = data[i].tglservice;
        //                 }
        //             }
        //         }
        //     });
        //     return tglservice
        // }

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
            $('#jenisfaktur').val("-");
            $('#jenispencairan').val("-");
            $('#pencairan').val("");
            $('#nowo').val("");
            $('#tglwo').val(newDate);
            $('#nofaktur').val("");
            $('#tglfaktur').val(newDate);
            $('#namasa').val("");
            $('#tglpass').val(newDate);
            $('#nofakturpajak').val("");
            $('#tglfakturpajak').val(newDate);
            $('#nopolisi').val("");
            $('#norangka').val("");
            $('#nomesin').val("");
            $('#tahunpembuatan').val("");
            $('#transmisi').val("");
            $('#odometer').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#kode_warna').val("");
            $('#nama_warna').val("");
            $('#nocustomer').val("");
            $('#nama_customer').val("");
            $('#alamat_customer').val("");
            $('#kelurahan_customer').val("");
            $('#kecamatan_customer').val("");
            $('#kota_customer').val("");
            $('#kodepos_customer').val("");
            $('#noktp').val("");
            $('#tgllahir').val(newDate);
            $('#agama').val("");
            $('#npwp').val("");
            $('#nppkp').val("");
            $('#nohp').val("");
            $('#nopolis').val("");
            $('#tglpolis').val(newDate);
            $('#namaasuransi').val("");
            $('#alamatasuransi').val("");
            $('#upasuransi').val("");
            $('#totaljasa').val("0");
            $('#totalsparepart').val("0");
            $('#totalbahan').val("0");
            $('#totalopl').val("0");
            $('#subtotal').val("0");
            $('#persen').val("0");
            $('#discount').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#grandtotal').val("0");
            $('#uangmuka').val("0");
            $('#pelunasan').val("0");
            $('#pencairanar').val("0");
            $('#sisaar').val("0");
            $('#totaldetailjasa').val("0");
            $('#totaldetailjasatambahan').val("0");
            $('#totaldetailsparepart').val("0");
            $('#totaldetailpembebananpart').val("0");
            $('#totaldetailpembebananpartbatal').val("0");
            $('#totaldetailbahan').val("0");
            $('#totaldetailpembebananbahan').val("0");
            $('#totaldetailpembebananbahanbatal').val("0");
            $('#totaldetailopl').val("0");
            $('#totaldetailhistoryopl').val("0");
            $('#totaldetailhistoryoplbatal').val("0");
            $('#totaldetailpenerimaankasir').val("0");
            $('#totaldetailpembatalanpenerimaankasir').val("0");
            $('#nopolisihistorywo').val("");
            $('#norangkahistorywo').val("");

            $('#detaildatahistoryar').empty();
            $('#detaildatajasa').empty();
            $('#detaildatajasatambahan').empty();
            $('#detaildatasparepart').empty();
            $('#detaildatapembebananpart').empty();
            $('#detaildatapembebananpartbatal').empty();
            $('#detaildatabahan').empty();
            $('#detaildatapembebananbahan').empty();
            $('#detaildatapembebananbahanbatal').empty();
            $('#detaildataopl').empty();
            $('#detaildatahistoryopl').empty();
            $('#detaildatahistoryoplbatal').empty();
            $('#detaildatapenerimaankasir').empty();
            $('#detaildatahistorypembatalanpenerimaankasir').empty();
            $('#detaildatahistorybatal').empty();
            $('#detaildatahistoryretur').empty();
        };
        BersihkanLayarBaru();

        function ResetDetailHistoryAR() {

            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            $('#nowo').val("");
            $('#tglwo').val(newDate);
            $('#nofaktur').val("");
            $('#tglfaktur').val(newDate);
            $('#namasa').val("");
            $('#tglpass').val(newDate);
            $('#nofakturpajak').val("");
            $('#tglfakturpajak').val(newDate);
            $('#nopolisi').val("");
            $('#norangka').val("");
            $('#nomesin').val("");
            $('#tahunpembuatan').val("");
            $('#transmisi').val("");
            $('#odometer').val("");
            $('#kode_tipe').val("");
            $('#nama_tipe').val("");
            $('#kode_warna').val("");
            $('#nama_warna').val("");
            $('#nocustomer').val("");
            $('#nama_customer').val("");
            $('#alamat_customer').val("");
            $('#kelurahan_customer').val("");
            $('#kecamatan_customer').val("");
            $('#kota_customer').val("");
            $('#kodepos_customer').val("");
            $('#noktp').val("");
            $('#tgllahir').val(newDate);
            $('#agama').val("");
            $('#npwp').val("");
            $('#nppkp').val("");
            $('#nohp').val("");
            $('#nopolis').val("");
            $('#tglpolis').val(newDate);
            $('#namaasuransi').val("");
            $('#alamatasuransi').val("");
            $('#upasuransi').val("");
            $('#totaljasa').val("0");
            $('#totalsparepart').val("0");
            $('#totalbahan').val("0");
            $('#totalopl').val("0");
            $('#subtotal').val("0");
            $('#persen').val("0");
            $('#discount').val("0");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#grandtotal').val("0");
            $('#uangmuka').val("0");
            $('#pelunasan').val("0");
            $('#pencairanar').val("0");
            $('#sisaar').val("0");
            $('#totaldetailjasa').val("0");
            $('#totaldetailjasatambahan').val("0");
            $('#totaldetailsparepart').val("0");
            $('#totaldetailpembebananpart').val("0");
            $('#totaldetailpembebananpartbatal').val("0");
            $('#totaldetailbahan').val("0");
            $('#totaldetailpembebananbahan').val("0");
            $('#totaldetailpembebananbahanbatal').val("0");
            $('#totaldetailopl').val("0");
            $('#totaldetailhistoryopl').val("0");
            $('#totaldetailhistoryoplbatal').val("0");
            $('#totaldetailpenerimaankasir').val("0");
            $('#totaldetailpembatalanpenerimaankasir').val("0");
            $('#nopolisihistorywo').val("");
            $('#norangkahistorywo').val("");

            $('#detaildatajasa').empty();
            $('#detaildatajasatambahan').empty();
            $('#detaildatasparepart').empty();
            $('#detaildatapembebananpart').empty();
            $('#detaildatapembebananpartbatal').empty();
            $('#detaildatabahan').empty();
            $('#detaildatapembebananbahan').empty();
            $('#detaildatapembebananbahanbatal').empty();
            $('#detaildataopl').empty();
            $('#detaildatahistoryopl').empty();
            $('#detaildatahistoryoplbatal').empty();
            $('#detaildatapenerimaankasir').empty();
            $('#detaildatahistorypembatalanpenerimaankasir').empty();
            $('#detaildatahistorybatal').empty();
            $('#detaildatahistoryretur').empty();
        };

        document.getElementById("jenisfaktur").addEventListener("change", function(event) {
            event.preventDefault();
            var jenisfaktur = $('#jenisfaktur').val();
            console.log(jenisfaktur);
            if ($('#jenisfaktur').val() == 2) {
                $("#noorder").show();
                $("#nopol").hide();
                $("#norang").hide();
            } else if ($('#jenisfaktur').val() == 3) {
                $("#noorder").show();
                $("#nopol").hide();
                $("#norang").hide();
            } else if ($('#jenisfaktur').val() == 4) {
                $("#noorder").show();
                $("#nopol").hide();
                $("#norang").hide();
            } else if ($('#jenisfaktur').val() == 0) {
                $("#noorder").hide();
                $("#nopol").show();
                $("#norang").show();
            } else if ($('#jenisfaktur').val() == 1) {
                $("#noorder").hide();
                $("#nopol").show();
                $("#norang").show();
            }
        });

        // --- Validasi ---
        function CekValidasi() {
            var table = document.getElementById('detaildatapencairankartu');
            if ($('#jenisfaktur').val() == '-') {
                $.alert({
                    title: 'INFO',
                    content: 'Pilih Jenis Faktur Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenisfaktur').focus();
                var result = false;
            }
            else if ($('#jenispencairan').val() == '-') {
                $.alert({
                    title: 'INFO',
                    content: 'Pilih Jenis Pencairan Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jenispencairan').focus();
                var result = false;
            } 
            else {
                var result = true;
            }
            return result;
        };
        // --- END VALIDASI ---

        // --- FUNGSI FORMAT RUPIAH DAN ANGKA ---
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

        document.getElementById("query_data").addEventListener("click", function(event) {
            var jenisfaktur = $('#jenisfaktur').val();
            var jenispencairan = $('#jenispencairan').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#kodesubcabang').val();
            var kodegrupcabang = $('#kodegrupcabang').val();
            var kodecompany = $('#kodecompany').val();
            var pencairan = $('#pencairan').val();

            HistoryPenjualan(jenisfaktur, jenispencairan, pencairan, kodecabang, kodecompany, kodesubcabang, kodegrupcabang);
        });

        function HistoryPenjualan(jenisfaktur, jenispencairan, pencairan, kodecabang, kodecompany, kodesubcabang, kodegrupcabang) {
            cleardetail();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/history_penjualan/tampilhistoryar'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        jenisfaktur: jenisfaktur,
                        jenispencairan: jenispencairan,
                        pencairan: pencairan,
                        kodecabang: kodecabang,
                        kodecompany: kodecompany,
                        kodesubcabang: kodesubcabang,
                        kodegrupcabang: kodegrupcabang
                    },
                    success: function(data) {
                        // console.log(data);
                        for (var i = 0; i < data.length; i++) {
                            var nomorfaktur = data[i].nomorfaktur.trim();
                            var tglfaktur = formatDate(data[i].tglfaktur.trim());
                            var nomororder = data[i].nomororder.trim();
                            var nopolisi = data[i].nopolisi.trim();
                            var namacustomer = data[i].nmcust.trim();
                            var status = data[i].status.trim();
                            InsertDataHistoryPenjualan(nomorfaktur, tglfaktur, nomororder, nopolisi, namacustomer, status);
                        }
                    }
                });
            };
        };

        function cleardetail() {
            $('#detaildatahistoryar').empty();
        }

        function InsertDataHistoryPenjualan(nomorfaktur, tglfaktur, nomororder, nopolisi, namacustomer, status) {
            var row = "";
            row =
                '<tr id="' + nomorfaktur + '">' +
                '<td>' + nomorfaktur + '</td>' +
                '<td>' + tglfaktur + '</td>' +
                '<td>' + nomororder + '</td>' +
                '<td>' + nopolisi + '</td>' +
                '<td>' + namacustomer + '</td>' +
                '<td>' + status + '</td>' +
                '<td style="text-align: center; padding-top: 3px; padding-bottom: 4px;">' +
                '<button data-table="' + nomororder + '" data-table1="' + nomorfaktur + '" class="detail-history btn btn-search btn-light" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#finddetailhistoryar" style="cursor: pointer; margin-bottom: 0rem;"><i class="fa fa-book-open"></i>&nbsp; History</button>' +
                '</td>' +
                '</tr>';
            $('#detaildatahistoryar').append(row);
        };

        $(document).on('click', '.detail-history', function() {
            var jenisfaktur = $('#jenisfaktur').val();
            var nomororder = $(this).attr("data-table");
            var nomorfaktur = $(this).attr("data-table1");
            DetailSummaryHistoryPenjualan(jenisfaktur, nomororder, nomorfaktur);
        });

        function DetailSummaryHistoryPenjualan(jenisfaktur, nomororder, nomorfaktur) {
            ResetDetailHistoryAR();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/getdetailhistoryar'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    jenisfaktur: jenisfaktur,
                    nomororder: nomororder,
                    nomorfaktur: nomorfaktur,
                },
                success: function(data) {
                    // console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        $('#nowo').val(data[i].nomororder.trim());
                        $('#tglwo').val(formatDate(data[i].tglwo));
                        $('#nofaktur').val(data[i].nomorfaktur.trim());
                        $('#tglfaktur').val(formatDate(data[i].tglfaktur));
                        $('#namasa').val(data[i].pemakai.trim());
                        $('#projectmanager').val(data[i].projectmanager.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#norangka').val(data[i].norangka.trim());
                        $('#nomesin').val(data[i].nomesin.trim());
                        $('#tahunpembuatan').val(data[i].tahunpembuatan.trim());
                        $('#transmisi').val(data[i].transmisi.trim());
                        $('#odometer').val(formatRupiah(data[i].odemeter.trim().toString(), ''));
                        $('#nama_tipe').val(data[i].jenismobil.trim());
                        $('#kode_warna').val(data[i].kodewarna.trim());
                        $('#nama_warna').val(data[i].namawarna.trim());
                        $('#nocustomer').val(data[i].nocust.trim());
                        $('#nama_customer').val(data[i].nmcust.trim());
                        $('#alamat_customer').val(data[i].almcust.trim());
                        $('#kelurahan_customer').val(data[i].kelcust.trim());
                        $('#kecamatan_customer').val(data[i].keccust.trim());
                        $('#kota_customer').val(data[i].ktcust.trim());
                        $('#kodepos_customer').val(data[i].kpcust.trim());
                        $('#npwp').val(data[i].npwpcust.trim());
                        $('#nohp').val(data[i].nohp.trim());
                        $('#totaljasa').val(formatRupiah(data[i].totaljasa.trim().toString(), ''));
                        $('#totalsparepart').val(formatRupiah(data[i].totalpart.trim().toString(), ''));
                        $('#subtotal').val(formatRupiah(data[i].dpp.trim().toString(), ''));
                        $('#dpp').val(formatRupiah(data[i].dpp.trim().toString(), ''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim().toString(), ''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim().toString(), ''));

                        var uangmuka = data[i].um - data[i].batalum;
                        var pelunasan = data[i].pelunasan - data[i].batalpelunasan;
                        var sisaar = (parseFloat(data[i].grandtotal) - (parseFloat((data[i].um - data[i].batalum)) + parseFloat((data[i].pelunasan - data[i].batalpelunasan)) + parseFloat(data[i].pencairanar)));
                        $('#uangmuka').val(formatRupiah(uangmuka.toString(), ''));
                        $('#pelunasan').val(formatRupiah(pelunasan.toString(), ''));
                        $('#pencairanar').val(formatRupiah(data[i].pencairanar.trim().toString(), ''));
                        $('#sisaar').val(formatRupiah(sisaar.toString(), ''));

                        $('#noorderhistorywo').val(data[i].nomororder.trim());
                        $('#nopolisihistorywo').val(data[i].nopolisi.trim());
                        $('#norangkahistorywo').val(data[i].norangka.trim());

                        GetDetailHistoryJasa(data[i].nomorfaktur.trim(), jenisfaktur);
                        GetDetailHistorySparepart(data[i].nomorfaktur.trim(), jenisfaktur);
                        GetDetailPembebananSparepart(data[i].nomororder.trim(), jenisfaktur);
                        GetDetailHistoryOPL(data[i].nomorfaktur.trim(), jenisfaktur);
                        GetHistoryOPL(data[i].nomororder.trim(), jenisfaktur);
                        GetHistoryPenerimaanKasir(data[i].nomorfaktur.trim(), data[i].nomororder.trim());
                        GetHistoryPembatalanPenerimaanKasir(data[i].nomorfaktur.trim(), data[i].nomororder.trim());
                        GetHistoryWO(data[i].nomororder.trim(), jenisfaktur);
                    }
                }
            });
        };

        // --- GET DETAIL HISTORY DATA JASA ---
        function GetDetailHistoryJasa(nofaktur, jenisfaktur) {
            cleardetailhistoryjasa();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/getdetailhistoryjasa'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nofaktur: nofaktur,
                    jenisfaktur: jenisfaktur
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode_tasklist = data[i].kodereferensi.trim();
                        var nama_tasklist = data[i].namareferensi.trim();
                        var jam = data[i].qty.trim();
                        var frt = formatRupiah(data[i].harga.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        var persendiscperitem = data[i].persendiscperitem.trim();
                        var discperitem = data[i].discperitem.trim();
                        inserttabledetailhistoryjasa(kode_tasklist, nama_tasklist, jam, frt, subtotal, persendiscperitem, discperitem, "");
                    }
                }
            });
        };

        function cleardetailhistoryjasa() {
            $('#detaildatajasa').empty();
        }

        function inserttabledetailhistoryjasa(kode_tasklist, nama_tasklist, jam, frt, subtotal, persendiscperitem, discperitem, find) {
            var row = "";
            row =
                '<tr id="' + kode_tasklist + '">' +
                '<td>' + kode_tasklist + '</td>' +
                '<td>' + nama_tasklist + '</td>' +
                '<td>' + jam + '</td>' +
                '<td style="text-align: right;">' + frt + '</td>' +
                '<td>' + persendiscperitem + '</td>' +
                '<td style="text-align: right;">' + discperitem + '</td>' +
                '<td style="text-align: right;">' + subtotal + '</td>' +
                '</tr>';
            $('#detaildatajasa').append(row);
            SubtotalDetailHistoryJasa();
        }

        function SubtotalDetailHistoryJasa() {
            var table = document.getElementById('detailjasa');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totaldetailjasa").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[6].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                $("#totaldetailjasa").val(formatRupiah(total.toString(), ''));
            }
        }

        // --- GET DETAIL HISTORY DATA SPAREPART ---
        function GetDetailHistorySparepart(nofaktur, jenisfaktur) {
            cleardetailhistorysparepart();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/getdetailhistorysparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nofaktur: nofaktur,
                    jenisfaktur: jenisfaktur
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode_tasklist = data[i].kodereferensi.trim();
                        var nama_tasklist = data[i].namareferensi.trim();
                        var jam = data[i].qty.trim();
                        var frt = formatRupiah(data[i].harga.trim().toString(), '');
                        var persen = data[i].persendiscperitem.trim();;
                        var discount = formatRupiah(data[i].discperitem.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        inserttabledetailhistorysparepart(kode_tasklist, nama_tasklist, jam, frt, persen, discount, subtotal, "");
                    }
                }
            });
        };

        function cleardetailhistorysparepart() {
            $('#detaildatasparepart').empty();
        }

        function inserttabledetailhistorysparepart(kode_tasklist, nama_tasklist, jam, frt, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode_tasklist + '">' +
                '<td>' + kode_tasklist + '</td>' +
                '<td>' + nama_tasklist + '</td>' +
                '<td>' + jam + '</td>' +
                '<td style="text-align: right;">' + frt + '</td>' +
                '<td style="text-align: right;">' + persen + '</td>' +
                '<td style="text-align: right;">' + discount + '</td>' +
                '<td style="text-align: right;">' + subtotal + '</td>' +
                '</tr>';
            $('#detaildatasparepart').append(row);
            SubtotalDetailHistorySparepart();
        }

        function SubtotalDetailHistorySparepart() {
            var table = document.getElementById('detailsparepart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totaldetailsparepart").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[6].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                $("#totaldetailsparepart").val(formatRupiah(total.toString(), ''));
            }
        }

        // --- GET DETAIL PEMBEBANAN DATA SPAREPART ---
        function GetDetailPembebananSparepart(nopo, jenisfaktur) {
            cleardetailpembebanansparepart();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/getdetailpembebanansparepart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopo: nopo,
                    jenisfaktur: jenisfaktur
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var nomor = data[i].nomor.trim();
                        var tanggal = formatDate(data[i].tanggal.trim());
                        var kode_parts = data[i].nomor_parts.trim();
                        var nama_parts = data[i].nama_parts.trim();
                        var qty = data[i].qty.trim();
                        var hargasatuan = formatRupiah(data[i].hargajual.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        if (data[i].batal == 't') {
                            var status = 'Batal';
                        } else {
                            var status = 'Tidak Batal';
                        }
                        var user = data[i].pemakai.trim();
                        inserttabledetailpembebanansparepart(nomor, tanggal, kode_parts, nama_parts, qty, hargasatuan, subtotal, status, user, "");
                    }
                }
            });
        };

        function cleardetailpembebanansparepart() {
            $('#detaildatapembebananpart').empty();
        }

        function inserttabledetailpembebanansparepart(nomor, tanggal, kode_parts, nama_parts, qty, hargasatuan, subtotal, status, user, find) {
            var row = "";
            row =
                '<tr id="' + nomor + '">' +
                '<td>' + nomor + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + kode_parts + '</td>' +
                '<td>' + nama_parts + '</td>' +
                '<td>' + qty + '</td>' +
                '<td style="text-align: right;">' + hargasatuan + '</td>' +
                '<td style="text-align: right;">' + subtotal + '</td>' +
                '<td style="text-align: center;">' + status + '</td>' +
                '<td style="text-align: center;">' + user + '</td>' +
                '</tr>';
            $('#detaildatapembebananpart').append(row);
            SubtotalDetailPembebananSparepart();
        }

        function SubtotalDetailPembebananSparepart() {
            var table = document.getElementById('detailpembebananpart');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totaldetailpembebananpart").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[6].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                $("#totaldetailpembebananpart").val(formatRupiah(total.toString(), ''));
            }
        }

        // --- GET DETAIL HISTORY DATA OPL ---
        function GetDetailHistoryOPL(nofaktur, jenisfaktur) {
            cleardetailhistoryopl();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/getdetailhistoryopl'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nofaktur: nofaktur,
                    jenisfaktur: jenisfaktur
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode_tasklist = data[i].kodereferensi.trim();
                        var nama_tasklist = data[i].namareferensi.trim();
                        var jam = data[i].qty.trim();
                        var frt = formatRupiah(data[i].harga.trim().toString(), '');
                        var persen = data[i].persendiscperitem.trim();;
                        var discount = formatRupiah(data[i].discperitem.trim().toString(), '');
                        var subtotal = formatRupiah(data[i].subtotal.trim().toString(), '');
                        inserttabledetailhistoryopl(kode_tasklist, nama_tasklist, jam, frt, persen, discount, subtotal, "");
                    }
                }
            });
        };

        function cleardetailhistoryopl() {
            $('#detaildataopl').empty();
        }

        function inserttabledetailhistoryopl(kode_tasklist, nama_tasklist, jam, frt, persen, discount, subtotal, find) {
            var row = "";
            row =
                '<tr id="' + kode_tasklist + '">' +
                '<td>' + kode_tasklist + '</td>' +
                '<td>' + nama_tasklist + '</td>' +
                '<td>' + jam + '</td>' +
                '<td style="text-align: right;">' + frt + '</td>' +
                '<td style="text-align: right;">' + persen + '</td>' +
                '<td style="text-align: right;">' + discount + '</td>' +
                '<td style="text-align: right;">' + subtotal + '</td>' +
                '</tr>';
            $('#detaildataopl').append(row);
            SubtotalDetailHistoryOPL();
        }

        function SubtotalDetailHistoryOPL() {
            var table = document.getElementById('detailopl');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totaldetailopl").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[6].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                $("#totaldetailopl").val(formatRupiah(total.toString(), ''));
            }
        }

        // --- GET HISTORY DATA OPL ---
        function GetHistoryOPL(nopo, jenisfaktur) {
            clearhistoryopl();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/gethistoryopl'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopo: nopo,
                    jenisfaktur: jenisfaktur
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var noorder = data[i].nomor.trim();
                        var tanggal = formatDate(data[i].tanggal.trim());
                        var kode_tasklist = data[i].kode_pekerjaan.trim();
                        var nama_tasklist = data[i].nama_opl.trim();
                        var jam = 1;
                        var frt = formatRupiah(data[i].hargajual.trim().toString(), '');
                        var persen = 0;
                        var discount = 0;
                        var subtotal = formatRupiah(data[i].hargajual.trim().toString(), '');
                        if (data[i].batal == 't') {
                            var status = 'Batal';
                        } else {
                            var status = 'Tidak Batal';
                        }
                        var user = data[i].pemakai.trim();
                        inserttablehistoryopl(noorder, tanggal, kode_tasklist, nama_tasklist, jam, frt, persen, discount, subtotal, status, user, "");
                    }
                }
            });
        };

        function clearhistoryopl() {
            $('#detaildatahistoryopl').empty();
        }

        function inserttablehistoryopl(noorder, tanggal, kode_tasklist, nama_tasklist, jam, frt, persen, discount, subtotal, status, user, find) {
            var row = "";
            row =
                '<tr id="' + noorder + '">' +
                '<td>' + noorder + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + kode_tasklist + '</td>' +
                '<td>' + nama_tasklist + '</td>' +
                '<td>' + jam + '</td>' +
                '<td style="text-align: right;">' + frt + '</td>' +
                '<td style="text-align: right;">' + persen + '</td>' +
                '<td style="text-align: right;">' + discount + '</td>' +
                '<td style="text-align: right;">' + subtotal + '</td>' +
                '<td style="text-align: center;">' + status + '</td>' +
                '<td style="text-align: center;">' + user + '</td>' +
                '</tr>';
            $('#detaildatahistoryopl').append(row);
            SubtotalHistoryOPL();
        }

        function SubtotalHistoryOPL() {
            var table = document.getElementById('detailhistoryopl');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totaldetailhistoryopl").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[8].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                $("#totaldetailhistoryopl").val(formatRupiah(total.toString(), ''));
            }
        }

        // --- GET HISTORY DATA PENERIMAAN UANG ---
        function GetHistoryPenerimaanKasir(nofaktur, nomororder) {
            clearhistorypenerimaankasir();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/gethistorypenerimaankasir'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nofaktur: nofaktur,
                    nomororder: nomororder
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var nopenerimaan = data[i].nomor.trim();
                        var tglpenerimaan = formatDate(data[i].tanggal.trim());
                        var nilaipenerimaan = formatRupiah(data[i].nilaipenerimaan.trim().toString(), '');
                        var namaaccount = data[i].namacoa.trim();
                        var nilaialokasi = formatRupiah(data[i].nilaialokasi.trim().toString(), '');
                        var namaalokasi = data[i].namaalokasi.trim();
                        var jenispenerimaan = data[i].jenisterima.trim();
                        var jenistransaksi = data[i].jenistransaksi.trim();
                        var keterangan = data[i].keterangan.trim();
                        inserttablehistorypenerimaankasir(nopenerimaan, tglpenerimaan, nilaipenerimaan, namaaccount, nilaialokasi, namaalokasi, jenispenerimaan, jenistransaksi, keterangan, "");
                    }
                }
            });
        };

        function clearhistorypenerimaankasir() {
            $('#detaildatapenerimaankasir').empty();
        }

        function inserttablehistorypenerimaankasir(nopenerimaan, tglpenerimaan, nilaipenerimaan, namaaccount, nilaialokasi, namaalokasi, jenispenerimaan, jenistransaksi, keterangan, find) {
            var row = "";
            row =
                '<tr id="' + nopenerimaan + '">' +
                '<td>' + jenistransaksi + '</td>' +
                '<td>' + nopenerimaan + '</td>' +
                '<td>' + tglpenerimaan + '</td>' +
                '<td style="text-align: right;">' + nilaipenerimaan + '</td>' +
                '<td>' + namaaccount + '</td>' +
                '<td>' + nilaialokasi + '</td>' +
                '<td>' + namaalokasi + '</td>' +
                '<td>' + jenispenerimaan + '</td>' +
                '<td>' + keterangan + '</td>' +
                '</tr>';
            $('#detaildatapenerimaankasir').append(row);
            SubtotalHistoryPenerimaanKasir();
        }

        function SubtotalHistoryPenerimaanKasir() {
            var table = document.getElementById('detailpenerimaankasir');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totaldetailpenerimaankasir").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[3].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                $("#totaldetailpenerimaankasir").val(formatRupiah(total.toString(), ''));
            }
        }

        // --- GET HISTORY DATA PEMBATALAN PENERIMAAN UANG ---
        function GetHistoryPembatalanPenerimaanKasir(nofaktur, nomororder) {
            clearhistorypembatalanpenerimaankasir();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/gethistorypembatalanpenerimaankasir'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nofaktur: nofaktur,
                    nomororder: nomororder
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var nopenerimaan = data[i].nomor.trim();
                        var tglpenerimaan = formatDate(data[i].tanggal.trim());
                        var nilaipenerimaan = formatRupiah(data[i].nilaipenerimaan.trim().toString(), '');
                        var namaaccount = data[i].namacoa.trim();
                        var nilaialokasi = formatRupiah(data[i].nilaialokasi.trim().toString(), '');
                        var namaalokasi = data[i].namaalokasi.trim();
                        var jenispenerimaan = data[i].jenisterima.trim();
                        var jenistransaksi = data[i].jenistransaksi.trim();
                        var keterangan = data[i].keterangan.trim();
                        var statusbatal = data[i].statusbatal.trim();
                        var tglbatal = data[i].tglbatal.trim();
                        var userbatal = data[i].userbatal.trim();
                        inserttablehistorypembatalanpenerimaankasir(nopenerimaan, tglpenerimaan, nilaipenerimaan, namaaccount, nilaialokasi, namaalokasi, jenispenerimaan, jenistransaksi, keterangan, statusbatal, tglbatal, userbatal, "");
                    }
                }
            });
        };

        function clearhistorypembatalanpenerimaankasir() {
            $('#detaildatahistorypembatalanpenerimaankasir').empty();
        }

        function inserttablehistorypembatalanpenerimaankasir(nopenerimaan, tglpenerimaan, nilaipenerimaan, namaaccount, nilaialokasi, namaalokasi, jenispenerimaan, jenistransaksi, keterangan, statusbatal, tglbatal, userbatal, find) {
            var row = "";
            row =
                '<tr id="' + nopenerimaan + '">' +
                '<td>' + jenistransaksi + '</td>' +
                '<td>' + nopenerimaan + '</td>' +
                '<td>' + tglpenerimaan + '</td>' +
                '<td style="text-align: right;">' + nilaipenerimaan + '</td>' +
                '<td>' + namaaccount + '</td>' +
                '<td>' + nilaialokasi + '</td>' +
                '<td>' + namaalokasi + '</td>' +
                '<td>' + jenispenerimaan + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + statusbatal + '</td>' +
                '<td>' + tglbatal + '</td>' +
                '<td>' + userbatal + '</td>' +
                '</tr>';
            $('#detaildatahistorypembatalanpenerimaankasir').append(row);
            SubtotalHistoryPembatalanPenerimaanKasir();
        }

        function SubtotalHistoryPembatalanPenerimaanKasir() {
            var table = document.getElementById('detailhistorypembatalanpenerimaankasir');
            var total = 0;
            if (table.rows.length == 1) {
                $("#totaldetailpembatalanpenerimaankasir").val("0");
            }
            for (var r = 1, n = table.rows.length; r < n; r++) {
                total = total + parseInt((table.rows[r].cells[3].innerHTML).replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", ""))
                $("#totaldetailpembatalanpenerimaankasir").val(formatRupiah(total.toString(), ''));
            }
        }

        // --- GET HISTORY DATA WO ---
        function GetHistoryWO(nopo, jenisfaktur) {
            clearhistorywo();
            $.ajax({
                url: "<?php echo base_url('masterdata/history_penjualan/gethistorywo'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nopo: nopo,
                    jenisfaktur: jenisfaktur
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var nowo = data[i].nomor_spk.trim();
                        var tglfaktur = formatDate(data[i].tanggal.trim());
                        var nomorfaktur = data[i].nofaktur.trim();
                        var nopolisi = data[i].nopolisi.trim();
                        var nama = data[i].nama.trim();
                        var nilaifaktur = formatRupiah(data[i].grandtotal.trim().toString(), '');
                        var alasanbatal = data[i].keteranganbatal.trim();
                        var tglbatal = formatDate(data[i].tglbatal.trim());
                        var userbatal = data[i].userbatal.trim();

                        // $('#nopolisihistorywo').val(data[i].nopolisi.trim());
                        // $('#norangkahistorywo').val(data[i].norangka.trim());
                        inserttablehistorywo(nowo, tglfaktur, nomorfaktur, nopolisi, nama, nilaifaktur, alasanbatal, tglbatal, userbatal, "");
                    }
                }
            });
        };

        function clearhistorywo() {
            $('#detaildatahistorybatal').empty();
        }

        function inserttablehistorywo(nowo, tglfaktur, nomorfaktur, nopolisi, nama, nilaifaktur, alasanbatal, tglbatal, userbatal, find) {
            var row = "";
            row =
                '<tr id="' + nomorfaktur + '">' +
                '<td>' + nomorfaktur + '</td>' +
                '<td>' + tglfaktur + '</td>' +
                '<td>' + nowo + '</td>' +
                '<td>' + nopolisi + '</td>' +
                '<td>' + nama + '</td>' +
                '<td style="text-align: right;">' + nilaifaktur + '</td>' +
                '<td style="text-align: center;">' + alasanbatal + '</td>' +
                '<td style="text-align: center;">' + tglbatal + '</td>' +
                '<td style="text-align: center;">' + userbatal + '</td>' +
                '</tr>';
            $('#detaildatahistorybatal').append(row);
        }

        // -- NEW -- 
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);
        });
        // -- END NEW -- 
    });
</script>