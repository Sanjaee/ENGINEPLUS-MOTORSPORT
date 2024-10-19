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

        function BersihkanLayarBaru() {
            var date = new Date(),
                yr = (date.getFullYear().toString()).substring(2, 4),
                mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                year = date.getFullYear(),
                bulan = date.getMonth() + 1,
                month = getbulan(bulan),
                day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                newDate = day + ' ' + month + ' ' + year;

            $('#jasaheadkode').val("");
            $('#jasaheadnama').val("");
            $('#kodejasadetail').val("");
            $('#namajasadetail').val("");
            $('#tablesearchtampil').css('visibility', 'hidden');

            document.getElementById('save').disabled = false;
            $('#detaildata').empty();
        };
        BersihkanLayarBaru();
        $('#tablesearchtampil').css('visibility', 'hidden');


        function cleardetail() {
            $('#detaildata').empty();
        }

        function clearjasa() {
            $('#kodejasadetail').val("");
            $('#namajasadetail').val("");
            document.getElementById('kodejasadetail').disabled = false;
            document.getElementById('namajasadetail').disabled = false;
        }

        $("#new_detail").click(function() {
            $('#kodejasadetail').val("");
            $('#namajasadetail').val("");
            document.getElementById('kodejasadetail').disabled = false;
            document.getElementById('namajasadetail').disabled = false;
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

        //------------------validasi ---------------------------
        function CekValidasi() {
            var table = document.getElementById('detaildata');
            if ($('#jasaheadkode').val() == '' || $('#jasaheadnama').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Jasa Head Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jasaheadnama').focus();
                var result = false;
            } else if (table.rows.length == 0) {
                $.alert({
                    title: 'Info..',
                    content: 'Detail tidak boleh kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jasaheadkode').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        // ---------- OnLookUp SPK --------------------------------------
        document.getElementById("carijasahead").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility', 'visible');
            $('#tablesearchjasahead').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // "ordering": true,
                "order":[],
                "ajax": {
                    "url": "<?php echo base_url('masterdata/jasadetail/CariJasaHead'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_jasa",
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

        //Close Pop UP Search
        document.getElementById("closesearchjasahead").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchhead", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/jasadetail/GetJasaHead'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#jasaheadkode').val(data[i].kode.trim());
                        $('#jasaheadnama').val(data[i].nama.trim());
                        DataDetail(data[i].kode.trim());
                    }
                }
            }, false);
            $('.popup1').css('visibility', 'hidden');
        });

        // ---------- Get Data --------------------------------------
        function DataDetail(kode) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('masterdata/jasadetail/Getdetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var kode_jasahead = data[i].kode_jasahead.trim();
                        var kode_jasa = data[i].kode_jasa.trim();
                        var nama_jasa = data[i].nama_jasa.trim();
                        insertdetaildata(kode_jasahead, kode_jasa, nama_jasa, "");
                    }
                }
            });
        };

        // ---------- OnLookUp Jasa Detail --------------------------------------

        document.getElementById("carijasadetail").addEventListener("click", function(event) {
            $('.popup2').css('visibility', 'visible');
            clearjasa();
            event.preventDefault();
            $('#tablesearchjasadetail').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // "ordering": true,
                "order":[],
                "ajax": {
                    "url": "<?php echo base_url('masterdata/jasadetail/CariJasaDetail'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_jasadetail",
                        field: {
                            kode_jasa: "kode_jasa",
                            nama_jasa: "nama_jasa"
                        },
                        sort: "kode_jasa",
                        where: {
                            kode_jasa: "kode_jasa",
                            nama_jasa: "nama_jasa"
                        }
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchjasadetail").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup2').css('visibility', 'hidden');
        }, false);

        $(document).on('click', ".searchjasadetail", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/jasadetail/GetJasaDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodejasadetail').val(data[i].kode_jasa.trim());
                        $('#namajasadetail').val(data[i].nama_jasa.trim());
                        document.getElementById('kodejasadetail').disabled = true;
                        document.getElementById('namajasadetail').disabled = true;
                    }
                }
            }, false);
            $('.popup2').css('visibility', 'hidden');
        });


        // ---------- ADD DETAIL TABLE ----------------------------------
        function ValidasiAdd() {
            var kode = $("#nama").val();
            var table = document.getElementById('detail');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 1) {
                        if (table.rows[r].cells[c].innerHTML == kode) {
                            alert("data sudah pernah diinput")
                            return "gagal";
                        }
                    }
                }
            }
            return "sukses";
        }

        function cekdouble(kode_jasa) {
            var table = document.getElementById('detail');
            var result = true;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                if (table.rows[r].cells[1].innerHTML.trim() === kode_jasa.trim()) {
                    result = false;
                }
            }
            return result;
        }

        $("#add_detail").click(function() {
            if ($('#kodejasadetail').val() == '' || $('#namajasadetail').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih atau Isi Jasa Detail Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#namajasadetail').focus();
            } else if ($('#jasaheadkode').val() == '' || $('#jasaheadnama').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jasa Head Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jasaheadnama').focus();
            } else {
                var kode_jasahead = $("#jasaheadkode").val();
                var kode_jasa = $("#kodejasadetail").val();
                var nama_jasa = $("#namajasadetail").val();

                if (cekdouble(kode_jasa) == true) {
                    insertdetaildata(kode_jasahead, kode_jasa, nama_jasa, "")
                    clearjasa();
                } else {
                    $.confirm({
                        title: 'Info !',
                        content: 'Data sudah ada di list, Apakah ingin menggantinya ?',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                action: function(data) {
                                    // console.log(KODE_JASA);
                                    $('#' + kode_jasa).remove();
                                    insertdetaildata(kode_jasahead, kode_jasa, nama_jasa, "")
                                    clearjasa();
                                }
                            },

                            cancel: function() {
                                //close
                            },
                        },
                        onContentReady: function() {
                            // bind to events
                            var jc = this;
                            this.$content.find('form').on('submit', function(e) {
                                // if the user submits the form by pressing enter in the field.                                                

                                e.preventDefault();
                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                            });
                        }
                    });
                }
            }
        });

        // ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var jasaheadkode = $('#jasaheadkode').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/jasadetail/Save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        jasaheadkode: jasaheadkode,
                        datadetail: datadetail
                    },
                    success: function(data) {
                        if (data.kode != "") {
                            $.alert({
                                title: 'Info..',
                                content: data.message,
                                buttons: {
                                    formSubmit: {
                                        text: 'OK',
                                        btnClass: 'btn-red'
                                    }
                                }
                            });
                            $('#kode').val(data.kode);
                        } else {
                            $.alert({
                                title: 'Info..',
                                content: data.message,
                                buttons: {
                                    formSubmit: {
                                        text: 'OK',
                                        btnClass: 'btn-red'
                                    }
                                }
                            });
                        }
                        BersihkanLayarBaru();
                    }
                }, false);
            }
        });

        function insertdetaildata(kode_jasahead, kode_jasa, nama_jasa, find) {
            var row = "";
            row =
                '<tr id="' + kode_jasa + '">' +
                '<td>' + kode_jasahead + '</td>' +
                '<td>' + kode_jasa + '</td>' +
                '<td>' + nama_jasa + '</td>' +
                '<td>' +
                '<button data-table="' + kode_jasa + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
                // '<button data-yes="'+ jenis +'" class="edit btn btn-new"><i class="fa fa-pencil-square-o"></i>Edit</button>' +
                '</td>' +
                '</tr>';
            $('#detaildata').append(row);

        }

        function ambildatadetail() {
            var table = document.getElementById('detail');
            var arr2 = [];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 0) {
                        string = "{" + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML + "'";
                    }
                }
                string = string + "}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            return arr2;
        }

        $(document).on('click', '.hapus', function() {
            var id = $(this).attr("data-table");
            console.log(id);
            $('#' + id).remove();
            var table = document.getElementById('detaildata');
        });


        // ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);

        });



        document.getElementById("excel").addEventListener("click", function(event) {

            window.open(
                "<?php echo base_url('export_excel/report/masterjasadetail/') ?>"
            );

        });
    });
</script>