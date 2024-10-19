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

        function loadtanggalkasbank() {
            var tanggal = "";
            $.ajax({
                url: "<?php echo base_url('masterdata/saldoawalkasbank/gettglsaldoawal'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {},
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        tanggal = formatDate(data[i].tglkasbank);
                    }
                }
            });
            return tanggal
        }

        function loaddatasaldoawal() {
            $.ajax({
                url: "<?php echo base_url('masterdata/saldoawalkasbank/saldoawalkasbank'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {},
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        insertdetaildata(data[i].coa.trim(), data[i].nama.trim(), formatDate(data[i].tanggal), formatRupiah(data[i].saldoawal, ""))
                    }
                }
            });
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

        function angka(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        };

        $("#nilai").keypress(function(data) {
            return angka(data);
        });


        var nilai = document.getElementById('nilai');
        nilai.addEventListener('keyup', function(e) {
            nilai.value = formatRupiah(this.value, '');
        });

        function BersihkanLayarBaru() {

            $('#tglkasbank').val(loadtanggalkasbank());
            $('#nomor').val("");
            $('#nama').val("");
            $('#nilai').val(0);
            cleardetail();
            loaddatasaldoawal();
        };
        BersihkanLayarBaru();

        function cleardetail() {
            $('#detaildata').empty();
        }

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

        // ---------- OnLookUp SPK --------------------------------------
        document.getElementById("cariaccount").addEventListener("click", function(event) {
            event.preventDefault();
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
                    "url": "<?php echo base_url('masterdata/saldoawalkasbank/cariaccount'); ?>",
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
                        value: "aktif = true"
                    },
                }
            });
        }, false);


        $(document).on('click', ".searchaccount", function() {
            var nomor = $(this).attr("data-id");
            $.ajax({
                url: "<?php echo base_url('masterdata/saldoawalkasbank/dataaccount'); ?>",
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


        function ValidasiAdd(nomor) {
            var table = document.getElementById('detail');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[0].innerHTML.trim() == nomor.trim()) {
                    result = false;
                }
            }
            return result;
        }



        $("#add_detail").click(function() {
            if ($('#nomor').val() == '' || $('#nama').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Menu nya terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#cariaccount').focus();
            } else {
                var nomor = $("#nomor").val();
                var nama = $("#nama").val();
                var tglkasbank = $("#tglkasbank").val();
                var nilai = $("#nilai").val();

                if (ValidasiAdd(nomor) == true) {
                    savedata(nomor, nama, tglkasbank, nilai);
                } else {
                    $.confirm({
                        title: 'Info !',
                        content: 'Data sudah ada di list, Apakah ingin menggantinya ?',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                action: function(data) {
                                    savedata(nomor, nama, tglkasbank, nilai);
                                    // location.reload(true);
                                }
                            },

                            cancel: function() {
                                //close
                            },
                        },
                    });
                }
            }

        });

        function savedata(coa, nama, tanggal, saldoawal) {
            $.ajax({
                url: "<?php echo base_url('masterdata/saldoawalkasbank/savedata'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    coa: coa,
                    nama: nama,
                    tanggal: tanggal,
                    saldoawal: saldoawal
                },
                success: function(data) {
                    $.alert({
                        type: 'red',
                        title: 'Info..',
                        content: data.message,
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                keys: ['enter', 'shift'],
                                action: function() {
                                    location.reload(true);
                                }
                            }
                        }
                    });
                }
            }, false);
        }

        function insertdetaildata(coa, nama, tanggal, saldoawal) {
            var row = "";
            row =
                '<tr id="' + coa + '">' +
                '<td>' + coa + '</td>' +
                '<td>' + nama + '</td>' +
                '<td>' + tanggal + '</td>' +
                '<td>' + saldoawal + '</td>' +
                '<td>' +
                '<button data-table="' + coa + '" class="ambil btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildata').append(row);

        }

        $(document).on('click', '.ambil', function() {
            _row = $(this);
            $('#nomor').val(_row.closest("tr").find("td:eq(0)").text());
            $('#nama').val(_row.closest("tr").find("td:eq(1)").text());
            $('#nilai').val(_row.closest("tr").find("td:eq(3)").text());
        });


        // ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            location.reload(true);

        });
    });
</script>