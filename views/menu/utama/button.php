<script type="text/javascript">
    $(document).ready(function() {
        var tanggal = $('#tanggal').val();

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

        function rupiah($angka) {

            $hasil_rupiah = "Rp ".number_format($angka, 2, ',', '.');
            return $hasil_rupiah;

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

        // document.getElementById("param_hari").addEventListener("change", function(event) {
        //     event.preventDefault();

        //     var param_hari = $("#param_hari").val();

        //     window.open("<?php //echo base_url('main/dashboard/') 
                            ?>"+param_hari, "_self");

        // });

        function DataSumFaktur() {
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/GetDataSumFaktur'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    tanggal: tanggal
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#totalfaktur').val(formatRupiah(data[i].totalfaktur.trim().toString(), ''));
                    }
                }
            });
        };

        function DataSumPiutang() {
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/GetDataSumPiutang'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    tanggal: tanggal
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#totalpiutang').val(formatRupiah(data[i].totalpiutang.trim().toString(), ''));
                    }
                }
            });
        };

        function DataSumHutang() {
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/GetDataSumHutang'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    tanggal: tanggal
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#totalhutang').val(formatRupiah(data[i].totalhutang.trim().toString(), ''));
                    }
                }
            });
        };

        function DataSumPenerimaan() {
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/GetDataSumPenerimaan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    tanggal: tanggal
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#totalpenerimaan').val(formatRupiah(data[i].totalpenerimaan.trim().toString(), ''));
                    }
                }
            });
        };

        function DataSumPengeluaran() {
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/GetDataSumPengeluaran'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    tanggal: tanggal
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#totalpengeluaran').val(formatRupiah(data[i].totalpembayaran.trim().toString(), ''));
                    }
                }
            });
        };

        function DataSumPencairan() {
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/GetDataSumPencairan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    tanggal: tanggal
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#totalpencairan').val(formatRupiah(data[i].totalpencairan.trim().toString(), ''));
                    }
                }
            });
        };

        function loadLabelChart() {
            // var i = 0;
            var result = [];
            // if ($('#fafaf').val() == 0){
            //     i= 6;
            // }
            // else{
            //     i = $('#fafaf').val();
            // }
            // var date: i
            var date = 6;
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/loadDataSPKChart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    tanggal: date,

                },
                success: function(data) {
                    if (data.length != 0) {
                        // result = data
                        for (var i = 0; i < data.length; i++) {
                            result.push(data[i].tanggal);
                        }
                    } else {
                        result = [];
                    }

                }
            })
            return result;
        }

        function loadDataSPKChart() {
            // var i = 0;
            var result = [];
            // if ($('#fafaf').val() == 0){
            //     i= 6;
            // }
            // else{
            //     i = $('#fafaf').val();
            // }
            // var date: i
            var date = 6;
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/loadDataSPKChart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    tanggal: date,

                },
                success: function(data) {
                    if (data.length != 0) {
                        // result = data
                        for (var i = 0; i < data.length; i++) {
                            result.push(data[i].nomor);
                        }
                    } else {
                        result = [];
                    }

                }
            })
            return result;
        }

        function loadDataFakturChart() {
            // var i = 0;
            var result = [];
            // if ($('#fafaf').val() == 0){
            //     i= 6;
            // }
            // else{
            //     i = $('#fafaf').val();
            // }
            // var date: i
            var date = 6;
            $.ajax({
                url: "<?php echo base_url('dashboard/dashboard/loadDataFakturChart'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    tanggal: date,

                },
                success: function(data) {
                    if (data.length != 0) {
                        // result = data
                        for (var i = 0; i < data.length; i++) {
                            result.push(data[i].nomor);
                        }
                    } else {
                        result = [];
                    }

                }
            })
            return result;
        }

        function loadDashboard() {
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    // labels: loadlabel(),
                    labels: loadLabelChart(),
                    datasets: [{
                            label: 'WO',
                            data: loadDataSPKChart(),
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255,99,132,1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Faktur',
                            data: loadDataFakturChart(),
                            backgroundColor: 'rgba(54, 162, 235, 0.3)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100,
                                stepSize: 10,
                                // beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }

        function LayarBaru() {
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#kodecabang').val();
            // console.log(kodecompany);
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('dashboard/dashboard/CariDataSPK'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "dashboard_statusspk",
                        field: {
                            nomorspk: "nomorspk",
                            nosn: "nosn",
                            namakategori: "namakategori",
                            namatipe: "namatipe",
                            namacustomer: "namacustomer",
                            jenisservice: "jenisservice",
                            statuswo: "statuswo",
                            pemakai: "pemakai"
                        },
                        sort: "nomorspk",
                        where: {
                            nomorspk: "nomorspk",
                            nosn: "nosn",
                            namakategori: "namakategori",
                            namatipe: "namatipe",
                            namacustomer: "namacustomer",
                            jenisservice: "jenisservice",
                            statuswo: "statuswo",
                            pemakai: "pemakai"
                        },
                        // value: "kodecompany = '" + kodecompany + "'"
                        value: "kode_cabang = '" + kodecabang + "'"
                    },
                }
            });
        }
        
        $("#minimstock").hide();
        loadDashboard();
        LayarBaru();
        DataSumFaktur();
        DataSumPiutang();
        DataSumPenerimaan();
        DataSumPengeluaran();
        DataSumPencairan();
        DataSumHutang();
        DataAP();
        DataAR();
        getMinimStock();

        function DataAP() {
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#kodecabang').val();
            // console.log(kodecompany);
            $('#tablesearchap').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('dashboard/dashboard/CariDataAP'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "dashboard_ap",
                        field: {
                            nomor: "nomor",
                            noinvoice: "noinvoice",
                            tgl: "tgl",
                            namasupplier: "namasupplier",
                            sisahutang: "sisahutang"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            noinvoice: "noinvoice",
                            namasupplier: "namasupplier"
                        },
                        // value: "kodecompany = '" + kodecompany + "'"
                        value: "kode_cabang = '" + kodecabang + "'"
                    },
                }
            });
        }

        function DataAR() {
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#kodecabang').val();
            // console.log(kodecompany);
            $('#tablesearchar').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('dashboard/dashboard/CariDataAR'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "dashboard_ar",
                        field: {
                            nofaktur: "nofaktur",
                            tgl: "tgl",
                            namacustomer: "namacustomer",
                            sisapiutang: "sisapiutang"
                        },
                        sort: "nofaktur",
                        where: {
                            nofaktur: "nofaktur",
                            namacustomer: "namacustomer"
                        },
                        // value: "kodecompany = '" + kodecompany + "'"
                        value: "kode_cabang = '" + kodecabang + "'"

                    },
                }
            });
        }

        
        function getMinimStock() {
            var kode_cabang = $('#kodecabang').val();
            var kodecompany = $('#kodecompany').val();
            $("#minimstock").click();
            $('#tablesearchmin').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // "scrollX": true,
                // "scrollY": true,
                // // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('sparepart/ordering_sparepart/getminstock'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            qtyakhir: "qtyakhir",
                            minstock: "minstock"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                        },
                        value: "qtyakhir < minstock and aktif = true and kodecabang = '" + kode_cabang + "' and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }
    });
</script>