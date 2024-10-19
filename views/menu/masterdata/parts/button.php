<script type="text/javascript">
    $(document).ready(function() {
        $('#tablesearchtampil').css('visibility', 'hidden');
        //disable tombol update
        $('#update').prop('disabled', true);
        $("#aktif").prop("checked", true);
        $('#hargabeli').val("0");
        $('#hargajual').val("0");
        $('#cogs').val("0");
        $('#minstock').val("0");
        $('#lokasi').val("");

        // -- Validasi --
        function CekValidasi() {
            if ($('#kode').val() == 0 || $('#kode').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kode Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kode').focus();
                var result = false;
            } else if ($('#nama').val() == 0 || $('#nama').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nama Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nama').focus();
                var result = false;
            } else if ($('#hargabeli').val() == 0 || $('#hargabeli').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Harga Beli Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#hargabeli').focus();
                var result = false;
            } else if ($('#hargajual').val() == 0 || $('#hargajual').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Harga Jual Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#hargajual').focus();
                var result = false;
            } else if ($('#scabang').val() == 'WKS') {
                if ($('#jenis_detail').val() == '0' || $('#jenis_detail').val() == '') {
                    $.alert({
                        title: 'Info..',
                        content: 'Pilih Jenis Part tersebut',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#jenis_detail').focus();
                    var result = false;
                } else {
                    var result = true;
                }
            } else if ($('#scabang').val() == 'SPT') {
                if ($('#kategoripart').val() == '0' || $('#kategoripart').val() == '') {
                    $.alert({
                        title: 'Info..',
                        content: 'Pilih Kategori Part tersebut',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#kategoripart').focus();
                    var result = false;
                } else {
                    var result = true;
                }
            } else if ($('#satuan').val() == '-' || $('#satuan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Satuan Parts',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#satuan').focus();
                var result = false;
            } else if ($('#lokasi').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Lokasi Sparepart',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#lokasi').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function FindData() {
            document.getElementById('kode').disabled = true;
            document.getElementById('nama').disabled = true;
            document.getElementById('hargabeli').disabled = true;
            document.getElementById('hargajual').disabled = true;
            document.getElementById('aktif').disabled = true;
            $('#save').prop('disabled', true);
            $('#update').prop('disabled', false);

        }
        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var kode = $('#kode').val();
            var nama = $('#nama').val();
            var hargabeli = $('#hargabeli').val();
            var hargajual = $('#hargajual').val();
            var jenis = $('#jenis_detail').val();
            var kategoripart = $('#kategoripart').val();
            var satuan = $('#satuan').val();
            var lokasi = $('#lokasi').val();
            var aktif = $("input[name='aktif']:checked").val();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var minstock = $('#minstock').val();
            var keterangan = $('#keterangan').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/parts/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kode: kode,
                        nama: nama,
                        hargabeli: hargabeli,
                        hargajual: hargajual,
                        jenis: jenis,
                        satuan: satuan,
                        lokasi: lokasi,
                        kategoripart: kategoripart,
                        kode_cabang: kode_cabang,
                        kodecompany: kodecompany,
                        minstock:minstock,
                        keterangan:keterangan,
                        aktif: aktif
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
                            FindData();
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
                    }
                }, false);
            }
        });
        // -- END SAVE --

        // -- NEW --
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayar();
        });
        // -- END NEW --
        function BersihkanLayar() {
            location.reload(true);
        };


        // -- FIND --
        document.getElementById("find").addEventListener("click", function(event) {
            // $('#tablesearchtampil').css('visibility', 'visible');
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#scabang').val();
            event.preventDefault();
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                // "scrollX": true,
                "scrollY": true,
                "ordering": true,

                // "order":[0,1,2],  
                "ajax": {
                    "url": "<?php echo base_url('masterdata/parts/finddata'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "find_partandstock",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            hargabeli: "hargabeli",
                            hargajual: "hargajual",
                            qtyakhir: "qtyakhir"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "kodecompany = '" + kodecompany + "' and kodecabang = '" + kodecabang + "'"
                    },
                },
            });
        }, false);

        //Close Pop UP Search
        // document.getElementById("closesearch").addEventListener("click", function(event) {
        //     event.preventDefault();
        //     $('#tablesearchtampil').css('visibility', 'hidden');
        //     // location.reload(true);
        // }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('masterdata/parts/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kode_cabang: kode_cabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode').val(data[i].kode.trim());
                        $('#nama').val(data[i].nama.trim());
                        $('#jenis_detail').val(data[i].kategori);
                        $('#kategoripart').val(data[i].kategorips);
                        $('#satuan').val(data[i].satuan.trim());
                        $('#save').prop('disabled', true);
                        $('#update').prop('disabled', false);
                        if (data[i].aktif == 't') {
                            $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                        }
                        $('#hargabeli').val(formatRupiah(data[i].hargabeli.trim(), ''));
                        $('#hargajual').val(formatRupiah2(data[i].hargajual.trim(), ''));
                        $('#cogs').val(formatRupiah2(data[i].cogs.trim(), ''));
                        $('#lokasi').val(data[i].lokasi.trim());
                        $('#minstock').val(data[i].minstock.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                        DataStock(data[i].kode.trim());
                    }
                    document.getElementById('kode').disabled = true;
                    document.getElementById('nama').disabled = true;
                }
            });
            $('#tablesearchtampil').css('visibility', 'hidden');
        });

        function DataDetail(kodepart) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#hargabeli').val("0");
            $('#hargajual').val("0");
            $('#lokasi').val("");
            $.ajax({
                url: "<?php echo base_url('masterdata/parts/GetDataPart'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kodepart: kodepart,
                    kode_cabang: kode_cabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#hargabeli').val(formatRupiah(data[i].hargabeli.trim(), ''));
                        $('#hargajual').val(formatRupiah2(data[i].hargajual.trim(), ''));
                        $('#cogs').val(formatRupiah2(data[i].cogs.trim(), ''));
                        $('#lokasi').val(data[i].lokasi.trim());
                    }
                }
            });
        };

        function DataStock(kodepart) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('masterdata/parts/GetDataStock'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kodepart: kodepart,
                    kode_cabang: kode_cabang,
                    kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#stock').val(data[i].stock.trim());
                    }
                }
            });
        };
        // -- END FIND --

        // -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            // console.log('111111');
            var kode = $('#kode').val();
            var nama = $('#nama').val();
            var hargabeli = $('#hargabeli').val();
            var hargajual = $('#hargajual').val();
            var jenis = $('#jenis_detail').val();
            var kategoripart = $('#kategoripart').val();
            var satuan = $('#satuan').val();
            var lokasi = $('#lokasi').val();
            var aktif = $("input[name='aktif']:checked").val();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            var minstock = $('#minstock').val();
            var keterangan = $('#keterangan').val();
            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/parts/update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kode: kode,
                        nama: nama,
                        hargabeli: hargabeli,
                        hargajual: hargajual,
                        satuan: satuan,
                        lokasi: lokasi,
                        jenis: jenis,
                        kategoripart: kategoripart,
                        kode_cabang: kode_cabang,
                        kodecompany: kodecompany,
                        minstock:minstock,
                        keterangan:keterangan,
                        aktif: aktif
                    },
                    success: function(data) {
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
                }, false);
            }
        });
        // -- END UPDATE -- 
        $("#hargabeli").keypress(function(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
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

        var nominal = document.getElementById('hargabeli');
        nominal.addEventListener('keyup', function(e) {
            nominal.value = formatRupiah(this.value, '');
        });


        $("#hargajual").keypress(function(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        });

        $("#kode").keypress(function(data) {
            if ((data.which < 97 || data.which > 122) && (data.which < 45 || data.which > 45) && (data.which < 48 || data.which > 57) && (data.which < 65 || data.which > 90)) {
                return false;
            }
        });

        function formatRupiah2(angka2, prefix2) {
            var number_string2 = angka2.replace(/[^.\d]/g, '').toString(),
                split2 = number_string2.split('.'),
                sisa2 = split2[0].length % 3,
                rupiah2 = split2[0].substr(0, sisa2),
                ribuan2 = split2[0].substr(sisa2).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan2) {
                separator2 = sisa2 ? ',' : '';
                rupiah2 += separator2 + ribuan2.join(',');
            }

            rupiah2 = split2[1] != undefined ? rupiah2 + '.' + split2[1] : rupiah2;
            return prefix2 == undefined ? rupiah2 : (rupiah2 ? rupiah2 : '');
        };

        var nominal2 = document.getElementById('hargajual');
        nominal2.addEventListener('keyup', function(e) {
            nominal2.value = formatRupiah2(this.value, '');
        });

        document.getElementById("excel").addEventListener("click", function(event) {
            var kodecabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();

            window.open(
                "<?php echo base_url('export_excel/report/masterpart/') ?>" + kodecabang + ":" + kodecompany
            );

        });
    });
</script>