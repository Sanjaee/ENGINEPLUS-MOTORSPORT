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

        document.getElementById('new').addEventListener('click', function() {
            event.preventDefault();
            location.reload(true);
        });


        $('#tableapprovalpermohonan').DataTable({
            "destroy": true,
            "searching": true,
            "sorting": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('finance/approval_permohonanuang/getData'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "vw_ij_srvpart_data_approvepermohonanuang",
                    field: {
                        nomor: "nomor",
                        tanggal: "tanggal",
                        keterangan: "keterangan",
                        jenistransaksi: "jenistransaksi",
                        approve: "approve",
                    },
                    sort: "nomor",
                    where: {
                        nomor: "nomor",
                    },
                    value: "batal = false"

                },
            }
        });

        $(document).on('click', '.searchok', function() {
            var nomor = $(this).attr('data-id');
            console.log(nomor);
            getDataHeader(nomor);
            $('#tablepermohonanuang').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // "scrollX": true,
                // "scrollY": true,
                // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('finance/approval_permohonanuang/caridatadetail'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_cadanganpembayarandetail",
                        field: {
                            nomorcadangan: "nomorcadangan",
                            noreferensi: "noreferensi",
                            kodesupplier: "kodesupplier",
                            namasupplier: "namasupplier",
                            kodeaccount: "kodeaccount",
                            nilaipermohonan: "nilaipermohonan",
                            memo: "memo",
                        },
                        sort: "nomorcadangan",
                        where: {
                            nomorcadangan: "nomorcadangan",
                        },
                        value: "nomorcadangan = '" + nomor + "'"
                    },
                }
            });
        });

        function getDataHeader(nomor) {
            $.ajax({
                url: "<?php echo base_url('finance/approval_permohonanuang/getDataHeader'); ?>",
                method: "POST",
                dataType: "JSON",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomorheader').val(data[i].nomor.trim());
                        $('#statusheader').val(data[i].approve.trim());
                        if (data[i].jenistransaksi == '31') {
                            var jenistransaksi = 'Ongkos Biaya Perjalanan SHUTTLE';
                        } else if (data[i].jenistransaksi == '32') {
                            var jenistransaksi = 'Ongkos Biaya Perjalanan SHUTTLE';
                        } else if (data[i].jenistransaksi == '33') {
                            var jenistransaksi = 'Uang Muka Pembelian Part';
                        } else if (data[i].jenistransaksi == '34') {
                            var jenistransaksi = 'Memo Kelebihan Uang Muka Service';
                        } else if (data[i].jenistransaksi == '35') {
                            var jenistransaksi = 'Memo Kelebihan Uang Muka COunter';
                        } else if (data[i].jenistransaksi == '99') {
                            var jenistransaksi = 'Lain - lain';
                        } else {
                            var jenistransaksi = '';
                        }
                        $('#jenispembayaranheader').val(jenistransaksi);
                        $('#tanggalheader').val(formatDate(data[i].tanggal.trim()));
                        $('#keteranganheader').val(data[i].keterangan.trim());
                    }
                }
            });
        }

        document.getElementById('processingpermohonan').addEventListener('click', function(event) {
            event.preventDefault();
            var nomor = $('#nomorheader').val();
            var statusheader = $('#statusheader').val();

            if (statusheader == '0') {
                approvePermohonan(nomor, statusheader);
            } else if (statusheader == '1') {
                $('#findpermohonanuang').hide();
                rejectPermohonan(nomor, statusheader);
            }
        });


        function approvePermohonan(nomor, statusheader) {
            $.confirm({
                title: "INFO !!",
                content: "Apakah anda yakin ingin approve data ini, Lanjutkan ?",
                buttons: {
                    cancel: function() {},
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red",
                        action: function() {
                            $.ajax({
                                url: "<?php echo base_url('finance/approval_permohonanuang/approvePermohonan'); ?>",
                                method: "POST",
                                dataType: "JSON",
                                async: true,
                                data: {
                                    nomor: nomor,
                                    statusheader: statusheader,
                                },
                                success: function(data) {
                                    $.alert({
                                        title: "INFO !!",
                                        content: data.message,
                                        buttons: {
                                            formSubmit: {
                                                text: "OK",
                                                btnClass: "btn-red",
                                                action: function() {
                                                    location.reload(true);
                                                }
                                            }
                                        }
                                    });
                                }
                            });
                        }
                    },
                },
            });
        }

        function rejectPermohonan(nomor, statusheader) {
            $.confirm({
                title: "INFO !!",
                content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Apakah anda yakin ?</label>' +
                    '<textarea placeholder="Masukkan Alasan Pembatalan" id="alasan" class="alasan form-control" /></textarea>' +
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
                            } else {
                                $.ajax({
                                    url: "<?php echo base_url('finance/approval_permohonanuang/approvePermohonan'); ?>",
                                    method: "POST",
                                    dataType: "JSON",
                                    async: true,
                                    data: {
                                        nomor: nomor,
                                        statusheader: statusheader,
                                        alasan: alasan,
                                    },
                                    success: function(data) {
                                        $.alert({
                                            title: "INFO !!",
                                            content: data.message,
                                            buttons: {
                                                formSubmit: {
                                                    text: "OK",
                                                    btnClass: "btn-red",
                                                    action: function() {
                                                        location.reload(true);
                                                    }
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        },
                    },
                    cancel: function() {
                        $('#findpermohonanuang').show(nomor);
                    },
                },
            });
        }



        // ---------------------- APPROVE WO -------------------------
        $('#tableapprovalwo').DataTable({
            "destroy": true,
            "searching": true,
            "sorting": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('finance/approval_permohonanuang/getDataWO'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "vw_ij_srvpart_getdatakendaraan",
                    field: {
                        nopolisi: "nopolisi",
                        norangka: "norangka",
                        nomesin: "nomesin",
                        nama: "nama",
                        approve: "approve",
                    },
                    sort: "nopolisi",
                    where: {
                        nopolisi: "nopolisi",
                        nama: "nama",
                    },
                    value: "aktif = true"

                },
            }
        });

        $(document).on('click', '.searchwo', function() {
            var nopolisi = $(this).attr('data-id');
            var approve = $(this).attr('data-approve');
            $('#nopolisi_wo').val(nopolisi);
            $('#statusheader_wo').val(approve);
            $('#tabledatawo').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // "scrollX": true,
                // "scrollY": true,
                // "ordering":  true,
                "order": [],
                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('finance/approval_permohonanuang/caridatawo'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_wo",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            norangka: "norangka",
                            nomor_customer: "nomor_customer",
                            tipe: "tipe",
                            keterangan: "keterangan",
                            keluhan: "keluhan",
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                        },
                        value: "nopolisi = '" + nopolisi + "' AND status = 0"
                    },
                }
            });
        });

        document.getElementById('processingdatawo').addEventListener('click', function(event) {
            event.preventDefault();
            var nopolisi = $('#nopolisi_wo').val();
            var statusapprove = $('#statusheader_wo').val();
            var tabel = document.getElementById('tabledetailwo');
            var result = true;

            if (statusapprove == '0') {
                approveWO(nopolisi, statusapprove);
            } else if (statusapprove == '1') {
                $('#findpermohonanuang').hide();
                rejectWO(nopolisi, statusapprove);
            }
        });


        function approveWO(nopolisi, statusapprove) {
            $.confirm({
                title: "INFO !!",
                content: "Apakah anda yakin ingin approve data ini, Lanjutkan ?",
                buttons: {
                    cancel: function() {},
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red",
                        action: function() {
                            $.ajax({
                                url: "<?php echo base_url('finance/approval_permohonanuang/approveWO'); ?>",
                                method: "POST",
                                dataType: "JSON",
                                async: true,
                                data: {
                                    nopolisi: nopolisi,
                                    statusapprove: statusapprove,
                                },
                                success: function(data) {
                                    $.alert({
                                        title: "INFO !!",
                                        content: data.message,
                                        buttons: {
                                            formSubmit: {
                                                text: "OK",
                                                btnClass: "btn-red",
                                                action: function() {
                                                    location.reload(true);
                                                }
                                            }
                                        }
                                    });
                                }
                            });
                        }
                    },
                },
            });
        }

        function rejectWO(nopolisi, statusheader) {

            $.confirm({
                title: "INFO !!",
                content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Apakah anda yakin ?</label>' +
                    '<textarea placeholder="Masukkan Alasan Pembatalan" id="alasan" class="alasan form-control" /></textarea>' +
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
                            } else {
                                $.ajax({
                                    url: "<?php echo base_url('finance/approval_permohonanuang/approvePermohonan'); ?>",
                                    method: "POST",
                                    dataType: "JSON",
                                    async: true,
                                    data: {
                                        nopolisi: nopolisi,
                                        statusheader: statusheader,
                                        alasan: alasan,
                                    },
                                    success: function(data) {
                                        $.alert({
                                            title: "INFO !!",
                                            content: data.message,
                                            buttons: {
                                                formSubmit: {
                                                    text: "OK",
                                                    btnClass: "btn-red",
                                                    action: function() {
                                                        location.reload(true);
                                                    }
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        },
                    },
                    cancel: function() {
                        // $('#finddatawo').show(nomor);
                    },
                },
            });
        }
    });
</script>