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

        function setdefaulttanggal() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;
            return newDate;
        }

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

        $('#tanggalawal').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
        });

        $('#tanggalakhir').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
        });

        function BersihkanLayarBaru() {
            $('#tglawal').val(setdefaulttanggal());
            $('#tglakhir').val(setdefaulttanggal());

            var kodegrupcabang = $('#groupcabang').val();
            var gruplogin = $('#mgrup').val();
            if ((kodegrupcabang == "AIO") && (gruplogin == "teknisi" || gruplogin == "adminservice")) {
                document.getElementById('tglawal').disabled = true
                document.getElementById('tglakhir').disabled = true
            } else {
                document.getElementById('tglawal').disabled = false
                document.getElementById('tglakhir').disabled = false
            }
            $('#nomor').val("");
            $('#nama').val("");
        };
        BersihkanLayarBaru();

        //------------------validasi ---------------------------
        function CekValidasi() {
            if ($('#nomor').val() == '' || $('#nama').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Account Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#cariaccount').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        document.getElementById("cariaccount").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#kodecabang').val();
            $('#tablesearchaccount').DataTable({
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
                    "url": "<?php echo base_url('form/reportkasbank/cariaccount'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_account",
                        field: {
                            nomor: "nomor",
                            nama: "nama",
                            norekening: "norekening"
                        },
                        sort: "nomor",
                        where: {
                            kode: "nomor",
                            nama: "nama",
                            norekening: "norekening"
                        },
                        value: "aktif = true and kodecompany = '" + kodecompany + "' and (kode_cabang  = '" + kodecabang + "' or kode_cabang  = 'ALL')"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchaccount", function() {
            var nomor = $(this).attr("data-id");
            $.ajax({
                url: "<?php echo base_url('form/reportkasbank/dataaccount'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nama').val(data[i].nama.trim());
                    }
                }
            }, false);
        });

        document.getElementById("submit").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var tglawal = $('#tglawal').val();
            var tglakhir = $('#tglakhir').val();
            var kodecabang = $('#kodecabang').val();
            var kodecompany = $('#kodecompany').val();
            var nomor = $('#nomor').val();
            var nama = $('#nama').val();
            $('#detail').DataTable({
                "destroy": true,
                "searching": false,
                "orderable": false,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "pageLength": 50,
                fixedColumns: {
                    rightColumns: 0
                },
                // // "scrollX": true,
                // "scrollY": true,
                // // "ordering":  true,

                // "order": [],

                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('form/reportkasbank/tampillaporankasbank'); ?>",
                    "method": "POST",
                    "data": {
                        nomor: nomor,
                        tglawal: tglawal,
                        tglakhir: tglakhir,
                        kodecompany: kodecompany,
                        kodecabang: kodecabang,
                        field: {
                            tanggal: "tanggal",
                            jenis: "jenis",
                            // coa: "coa",
                            nomorbon: "nomorbon",
                            nopermohonan: "nopermohonan",
                            keterangan: "keterangan",
                            debit: "debit",
                            kredit: "kredit"
                        },
                    },
                }
            });
        }, false);

        // ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            location.reload(true);
        });

        // ---------- On Button Cetak --------------------------------------
        document.getElementById("cetak").addEventListener("click", function(event) {
            if ($('#nomor').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Account Kas & Bank terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomor').focus();
            } else {
                var nomor = $('#nomor').val();
                var nama = $('#nama').val().replace("(", "").replace(")", "");
                var tglawal = $('#tglawal').val();
                var tglakhir = $('#tglakhir').val();
                var kodecompany = $('#kodecompany').val();
                var kodecabang = $('#kodecabang').val();

                window.open(
                    "<?php echo base_url('form/reportkasbank/report_kasbank/') ?>" + ":" + nomor + ":" + tglawal + ":" + tglakhir + ":" + kodecompany + ":" + kodecabang + ":" + nama
                );
            }
        });


        document.getElementById("excel").addEventListener("click", function(event) {
            if ($('#nomor').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Account Kas & Bank terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomor').focus();
            } else {
                var nomor = $('#nomor').val();
                var nama = $('#nama').val().replace("(", "").replace(")", "");
                var tglawal = $('#tglawal').val();
                var tglakhir = $('#tglakhir').val();
                var kodecompany = $('#kodecompany').val();
                var kodecabang = $('#kodecabang').val();
                window.open(
                    "<?php echo base_url('form/reportkasbank/export/') ?>" + ":" + nomor + ":" + tglawal + ":" + tglakhir + ":" + kodecompany + ":" + kodecabang + ":" + nama
                );
            }

        });
    });
</script>