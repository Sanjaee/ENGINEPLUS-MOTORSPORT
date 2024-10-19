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

        document.getElementById('cariwo').addEventListener('click', function(event) {
            event.preventDefault();
            
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchwo').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "lengthChange": false,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/statuspekerjaan/cariWO'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_wo_statuspekerjaan",
                        field: {
                            nomor: "nomor",
                            tanggal: "tanggal",
                            nopolisi: "nopolisi",
                            namacustomer: "namacustomer",
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            namacustomer: "namacustomer",
                        },
                        value: "status = 0 and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
                    }
                }
            });
        });


        $(document).on('click', '.datacariWO', function() {
            var result = $(this).attr('data-id');
            // console.log(result);
            getDataWO(result);
            getDataWODetail(result);
        });

        function getDataWO(nomor) {
            $.ajax({
                url: "<?php echo base_url('spk/statuspekerjaan/getWO'); ?>",
                method: "POST",
                dataType: "JSON",
                async: true,
                data: {
                    nomor: nomor,
                },
                success: function(data) {
                    for (var i = 0; i <= data.length; i++) {
                        $('#nomor_wo').val(data[i].nomor);
                        $('#tanggal_wo').val(formatDate(data[i].tanggal));
                        $('#nopolisi').val(data[i].nopolisi);
                        $('#kodeforeman').val(data[i].kode_foreman);
                        $('#namaforeman').val(data[i].nama_foreman);
                        $('#keluhan').val(data[i].keluhan);
                        $('#nocustomer').val(data[i].nomor_customer);
                        $('#namacustomer').val(data[i].namacustomer);
                    }
                }
            });
        }

        function getDataWODetail(nomor) {
            $('#tabledatastatuspekerjaan').empty();
            $.ajax({
                url: "<?php echo base_url('spk/statuspekerjaan/getWODetail'); ?>",
                method: "POST",
                dataType: "JSON",
                async: true,
                data: {
                    nomor: nomor,
                },
                success: function(data) {
                    for (var i = 0; i <= data.length; i++) {
                        inserttablewodetail(data[i].kodereferensi, data[i].namareferensi, data[i].qty, data[i].harga, data[i].persendiscperitem, data[i].discperitem, data[i].subtotal, data[i].statuspekerjaan);
                    }
                }
            });
        }

        function inserttablewodetail(kodereferensi, namareferensi, qty, harga, persendiscitem, discount, subtotal, status) {
            var button = "";
            if (status == '0') {
                button = '<span class="btn btn-danger">Waiting</span>';
            } else if (status == '1') {
                button = '<span class="btn btn-warning">Progress</span>';
            } else if (status == '2') {
                button = '<span class="btn btn-done">Done</span>';
            } else if (status == '3') {
                button = '<span class="btn btn-light">Batal</span>';
            }
            var row = "";
            row = '<tr id="' + kodereferensi + '">' +
                '<td style="text-align:left;">' + kodereferensi + '</td>' +
                '<td style="text-align:left;">' + namareferensi + '</td>' +
                '<td style="text-align:center;">' + qty + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(harga) + '</td>' +
                '<td style="text-align:center;">' + persendiscitem + '</td>' +
                '<td style="text-align:center;">' + formatRupiah(discount) + '</td>' +
                '<td style="text-align:right;">' + formatRupiah(subtotal) + '</td>' +
                '<td style="text-align:center;">' + button + '</td>' +
                '<td style="text-align:center;">' +
                '<button class="klikproses btn btn-primary" data-kode = "' + kodereferensi + '"><i class="fa fa-check"></i></button>' + ' ' +
                '<button class="klikbatal btn btn-danger" data-kode = "' + kodereferensi + '"><i class="fa fa-times"></i></button>' +
                '</td>' +
                '</tr>';
            $('#tabledatastatuspekerjaan').append(row);
        }

        $(document).on('click', '.klikproses', function() {
            var kode = $(this).attr('data-kode');
            $.confirm({
                title: "INFO..",
                // content: "Anda ingin mengubah status pengerjaan, Lanjutkan ?",
                content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Silakan pilih status pengerjaan</label>' +
                    '<select name="select" id="statuspekerjaan" class="form-control">' +
                    '<option value="">Pilih Status Pekerjaan</option>' +
                    '<option value="0">Tunggu Dikerjakan</option>' +
                    '<option value="1">Sedang Dikerjakan</option>' +
                    '<option value="2">Selesai Dikerjakan</option>' +
                    '</select>' +
                    // '<textarea class="Alamat form-control" placeholder="alasan"  required />' +
                    '</div>' +
                    '</form>',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red",
                        action: function() {
                            var statuspekerjaan = this.$content.find('#statuspekerjaan').val();
                            updateStatus(kode, statuspekerjaan);
                        }
                    },
                    cancel: function() {

                    }
                }
            });
        });

        function updateStatus(kode, statuspekerjaan) {
            var nomor = $('#nomor_wo').val();
            var nopolisi = $('#nopolisi').val();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodegrupcabang = $('#kodegrupcabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('spk/statuspekerjaan/updateStatus'); ?>",
                method: "POST",
                dataType: "JSON",
                async: true,
                data: {
                    nomor: nomor,
                    kode: kode,
                    statuspekerjaan: statuspekerjaan,
                    nopolisi: nopolisi,
                    kode_cabang: kode_cabang,
                    kodesubcabang: kodesubcabang,
                    kodegrupcabang: kodegrupcabang,
                    kodecompany: kodecompany,
                },
                success: function(data) {
                    if (data.nomor != '') {
                        $.alert({
                            title: "INFO...",
                            content: data.message,
                            buttons: {
                                formSubmit: {
                                    text: "OK",
                                    btnClass: "btn-red"
                                }
                            }
                        });
                        getDataWODetail(data.nomor);
                    } else {
                        $.alert({
                            title: "INFO...",
                            content: data.message,
                            buttons: {
                                formSubmit: {
                                    text: "OK",
                                    btnClass: "btn-red"
                                }
                            }
                        });
                    }
                }
            });
        }

        $(document).on('click', '.klikbatal', function() {
            var kode = $(this).attr('data-kode');
            $.confirm({
                title: "INFO..",
                content: '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Apakah anda yakin ?</label>' +
                    '<input type="text" placeholder="Masukkan Alasan Pembatalan" class="alasan form-control" required />' +
                    '</div>' +
                    '</form>',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red",
                        action: function() {
                            var alasan = this.$content.find('.alasan').val();
                            if (!alasan) {
                                $.alert('Alasan belum diisi');
                                return false;
                            }
                            var statuspekerjaan = this.$content.find('#statuspekerjaan').val();
                            var nomor = $('#nomor_wo').val();
                            var nopolisi = $('#nopolisi').val();
                            var kode_cabang = $('#scabang').val();
                            var kodesubcabang = $('#subcabang').val();
                            var kodegrupcabang = $('#kodegrupcabang').val();
                            var kodecompany = $('#kodecompany').val();
                            $.ajax({
                                url: "<?php echo base_url('spk/statuspekerjaan/cancelStatus'); ?>",
                                method: "POST",
                                dataType: "JSON",
                                async: true,
                                data: {
                                    nomor: nomor,
                                    kode: kode,
                                    statuspekerjaan: 3,
                                    nopolisi: nopolisi,
                                    kode_cabang: kode_cabang,
                                    kodesubcabang: kodesubcabang,
                                    kodegrupcabang: kodegrupcabang,
                                    kodecompany: kodecompany,
                                    alasan:alasan
                                },
                                success: function(data) {
                                    if (data.nomor != '') {
                                        $.alert({
                                            title: "INFO...",
                                            content: data.message,
                                            buttons: {
                                                formSubmit: {
                                                    text: "OK",
                                                    btnClass: "btn-red"
                                                }
                                            }
                                        });
                                        $('#' + kode).remove();
                                    } else {
                                        $.alert({
                                            title: "INFO...",
                                            content: data.message,
                                            buttons: {
                                                formSubmit: {
                                                    text: "OK",
                                                    btnClass: "btn-red"
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    },
                    cancel: function() {

                    }
                }
            });
        });

        function cancelStatus(kode, statuspekerjaan) {
            var nomor = $('#nomor_wo').val();
            var nopolisi = $('#nopolisi').val();
            var kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodegrupcabang = $('#kodegrupcabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('spk/statuspekerjaan/cancelStatus'); ?>",
                method: "POST",
                dataType: "JSON",
                async: true,
                data: {
                    nomor: nomor,
                    kode: kode,
                    statuspekerjaan: 3,
                    nopolisi: nopolisi,
                    kode_cabang: kode_cabang,
                    kodesubcabang: kodesubcabang,
                    kodegrupcabang: kodegrupcabang,
                    kodecompany: kodecompany,
                },
                success: function(data) {
                    if (data.nomor != '') {
                        $.alert({
                            title: "INFO...",
                            content: data.message,
                            buttons: {
                                formSubmit: {
                                    text: "OK",
                                    btnClass: "btn-red"
                                }
                            }
                        });
                        $('#' + kode).remove();
                    } else {
                        $.alert({
                            title: "INFO...",
                            content: data.message,
                            buttons: {
                                formSubmit: {
                                    text: "OK",
                                    btnClass: "btn-red"
                                }
                            }
                        });
                    }
                }
            });
        }

        document.getElementById("cetak").addEventListener("click", function(event) {
            var nomorwo = $('#nomor_wo').val();
            window.open(
                "<?php echo base_url('form/form/cetak_statuspekerjaan/') ?>" + nomorwo
            );
        });

        //-------------------history SPK-------------------------------------
        document.getElementById("history").addEventListener("click", function(event) {
            event.preventDefault();
            var nomorwo = $('#nomor_wo').val();
            $('#tablesearchspk').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('spk/statuspekerjaan/historyspk'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "vw_historypencatatan",
                        field: {
                            nomor_wo: "nomor_wo",
                            nopolisi: "nopolisi",
                            kodereferensi: "kodereferensi",
                            nama: "nama"
                        },
                        sort: "nomor_wo",
                        where: {
                            nomor_wo: "nomor_wo",
                            nopolisi: "nopolisi",
                            kodereferensi: "kodereferensi",
                            nama: "nama"
                        },
                        value: "nomor_wo = '" + nomorwo + "'"
                    },
                }
            });
        }, false);


    });
</script>