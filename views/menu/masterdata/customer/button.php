<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('kode').disabled = true;
        document.getElementById('kelurahan').disabled = true;
        document.getElementById('kecamatan').disabled = true;
        document.getElementById('kota').disabled = true;
        document.getElementById('provinsi').disabled = true;
        document.getElementById('kodepos').disabled = true;

        $('.popup1').css('visibility', 'hidden');
        $('.popup2').css('visibility', 'hidden');
        $('#update').prop('disabled', true);
        $("#pkp").prop("checked", true);
        $("#aktif").prop("checked", true);
        $('input[name=pkp]').change(function() {
            if (this.value == 'true') {
                document.getElementById('npwp').disabled = false;
                document.getElementById('namanpwp').disabled = false;
                document.getElementById('alamatnpwp').disabled = false;
            } else if (this.value == 'false') {
                document.getElementById('npwp').disabled = true;
                document.getElementById('namanpwp').disabled = true;
                document.getElementById('alamatnpwp').disabled = true;
            }
        });

        // -- Validasi --
        function CekValidasi() {
            if ($('#nama').val() == 0 || $('#nama').val() == '') {
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
            } else if ($('#alamat').val() == 0 || $('#alamat').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Alamat Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#alamat').focus();
                var result = false;
            } else if ($('#nohp').val() == 0 || $('#nohp').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'No. HP Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nohp').focus();
                var result = false;
            } else if ($('#kreditlimit').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kredit Limit tidak boleh kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kreditlimit').focus();
                var result = false;
            } else if ($('#top').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'TOP Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#top').focus();
                var result = false;
            } else if ($('#notlp').val() == 0 || $('#notlp').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'No. Tlp Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#notlp').focus();
                var result = false;
            } else if ($('#email').val() == 0 || $('#email').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'E-mail Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#email').focus();
                var result = false;
            } else if ($('#kelurahan').val() == 0 || $('#kelurahan').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kelurahan Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kelurahan').focus();
                var result = false;
            } else if ($("input[name='pkp']:checked").val() == "true") {
                var result = true;
                if ($('#npwp').val() == 0 || $('#npwp').val() == '') {
                    $.alert({
                        title: 'Info..',
                        content: 'NPWP Tidak Boleh Kosong',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#npwp').focus();
                    var result = false;
                } else if ($('#namanpwp').val() == 0 || $('#namanpwp').val() == '') {
                    $.alert({
                        title: 'Info..',
                        content: 'Nama NPWP Tidak Boleh Kosong',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#namanpwp').focus();
                    var result = false;
                } else if ($('#alamatnpwp').val() == 0 || $('#alamatnpwp').val() == '') {
                    $.alert({
                        title: 'Info..',
                        content: 'Alamat NPWP Tidak Boleh Kosong',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    });
                    $('#alamatnpwp').focus();
                    var result = false;
                }
            } else if ($('#jeniscustomer').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Customer Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jeniscustomer').focus();
                var result = false;
            } else if ($('#kategoricustomer').val() == '-') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Kategori Customer Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kategoricustomer').focus();
                var result = false;
            } else if ($('#jeniscustomer2').val() == '-'  || $('#jeniscustomer2').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih Jenis Customer Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#jeniscustomer2').focus();
                var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function FindData() {
            document.getElementById('nama').disabled = true;
            document.getElementById('nohp').disabled = true;
            document.getElementById('notlp').disabled = true;
            document.getElementById('alamat').disabled = true;
            document.getElementById('email').disabled = true;
            document.getElementById('kode').disabled = true;
            document.getElementById('kelurahan').disabled = true;
            document.getElementById('kecamatan').disabled = true;
            document.getElementById('kota').disabled = true;
            document.getElementById('provinsi').disabled = true;
            document.getElementById('kodepos').disabled = true;
            document.getElementById('kreditlimit').disabled = true;
            document.getElementById('top').disabled = true;
            document.getElementById('pkp').disabled = true;
            document.getElementById('npwp').disabled = true;
            document.getElementById('namanpwp').disabled = true;
            document.getElementById('alamatnpwp').disabled = true;
            document.getElementById('aktif').disabled = true;
            $('#save').prop('disabled', true);
            $('#update').prop('disabled', false);

        }
        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var nohp = $('#nohp').val();
            var notlp = $('#notlp').val();
            var email = $('#email').val();
            var kode = $('#kode').val();
            var kelurahan = $('#kelurahan').val();
            var kecamatan = $('#kecamatan').val();
            var kota = $('#kota').val();
            var provinsi = $('#provinsi').val();
            var kodepos = $('#kodepos').val();
            var top = $('#top').val();
            var kreditlimit = $('#kreditlimit').val();
            var pkp = $("input[name='pkp']:checked").val();
            var npwp = $('#npwp').val();
            var namanpwp = $('#namanpwp').val();
            var alamatnpwp = $('#alamatnpwp').val();
            var aktif = $("input[name='aktif']:checked").val();
            var titlecustomer = $('#jeniscustomer').val();
            var kategoricustomer = $('#kategoricustomer').val();
            var jeniscustomer = $('#jeniscustomer2').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/customer/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nama: nama,
                        alamat: alamat,
                        nohp: nohp,
                        notlp: notlp,
                        email: email,
                        kode: kode,
                        kelurahan: kelurahan,
                        kecamatan: kecamatan,
                        kota: kota,
                        provinsi: provinsi,
                        kodepos: kodepos,
                        top: top,
                        kreditlimit: kreditlimit,
                        pkp: pkp,
                        npwp: npwp,
                        namanpwp: namanpwp,
                        alamatnpwp: alamatnpwp,
                        aktif: aktif,
                        titlecustomer: titlecustomer,
                        kategoricustomer: kategoricustomer,
                        jeniscustomer:jeniscustomer
                    },
                    success: function(data) {
                        if (data.nomor != "") {
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
                            $('#nomor').val(data.nomor);
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
            $('.popup2').css('visibility', 'visible');
            event.preventDefault();
            var kodecompany = $('#kodecompany').val();
            var kodecabang = $('#scabang').val();
            var kodegrup = $('#kodegrupcabang').val();
            // if (kodecabang == "SPT" || kodecabang == "WKS") { //TAM
            //     values = "aktif = true and kodecompany = '" + kodecompany + "' and kode_cabang in ('WKS','SPT')"
            // } else {
                values = "kode_cabang = '" + kodecabang + "'"
            // }
            $('#tablesearch').DataTable({
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
                    "url": "<?php echo base_url('caridata/caridataaktif'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_customer",
                        // field:{kode:"kode",nama:"nama",nama2:"nama2",nama3:"nama3"}
                        field: {
                            nomor: "nomor",
                            nama: "nama",
                            alamat: "alamat",
                            notlp: "notlp",
                            nohp: "nohp",
                            email: "email"
                        },
                        sort: "nomor,nama",
                        where: {
                            nomor: "nomor",
                            nama: "nama",
                            alamat: "alamat",
                            notlp: "notlp",
                            nohp: "nohp",
                            email: "email"
                        },
                        // value:"aktif = true"
                        value: values
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearch").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup2').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/customer/find'); ?>",
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
                        $('#alamat').val(data[i].alamat.trim());
                        $('#nohp').val(data[i].nohp.trim());
                        $('#notlp').val(data[i].notlp.trim());
                        $('#email').val(data[i].email.trim());
                        $('#kode').val(data[i].kode.trim());
                        $('#kelurahan').val(data[i].kelurahan.trim());
                        $('#kecamatan').val(data[i].kecamatan.trim());
                        $('#kota').val(data[i].kota.trim());
                        $('#provinsi').val(data[i].provinsi.trim());
                        $('#kodepos').val(data[i].kodepos.trim());
                        $('#top').val(data[i].top.trim());
                        $('#kreditlimit').val(data[i].kreditlimit.trim());
                        $('#npwp').val(data[i].npwp.trim());
                        $('#namanpwp').val(data[i].namanpwp.trim());
                        $('#alamatnpwp').val(data[i].alamatnpwp.trim());
                        $('#jeniscustomer').val(data[i].title.trim());
                        $('#kategoricustomer').val(data[i].kategoricustomer.trim());
                        $('#jeniscustomer2').val(data[i].jeniscustomer.trim());
                        $('#save').prop('disabled', true);
                        $('#update').prop('disabled', false);
                        if (data[i].pkp == 't') {
                            document.getElementById('npwp').disabled = false;
                            document.getElementById('namanpwp').disabled = false;
                            document.getElementById('alamatnpwp').disabled = false;
                            $('input:radio[name="pkp"][value="true"]').prop('checked', true);
                        } else {
                            document.getElementById('npwp').disabled = true;
                            document.getElementById('namanpwp').disabled = true;
                            document.getElementById('alamatnpwp').disabled = true;
                            $('input:radio[name="pkp"][value="false"]').prop('checked', true);
                        }
                        if (data[i].aktif == 't') {
                            $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                        }

                    }

                    document.getElementById('kode').disabled = true;
                    $('#save').prop('disabled', true);
                    $('#update').prop('disabled', false);
                    $('#carikodepos').prop('disabled', false);
                }
            });


            $('.popup2').css('visibility', 'hidden');
        });
        // -- END FIND --

        // -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var nohp = $('#nohp').val();
            var notlp = $('#notlp').val();
            var email = $('#email').val();
            var kode = $('#kode').val();
            var kelurahan = $('#kelurahan').val();
            var kecamatan = $('#kecamatan').val();
            var kota = $('#kota').val();
            var provinsi = $('#provinsi').val();
            var kodepos = $('#kodepos').val();
            var top = $('#top').val();
            var kreditlimit = $('#kreditlimit').val();
            var pkp = $("input[name='pkp']:checked").val();
            var npwp = $('#npwp').val();
            var namanpwp = $('#namanpwp').val();
            var alamatnpwp = $('#alamatnpwp').val();
            var aktif = $("input[name='aktif']:checked").val();
            var titlecustomer = $('#jeniscustomer').val();
            var kategoricustomer = $('#kategoricustomer').val();
            var jeniscustomer = $('#jeniscustomer2').val();

            if (CekValidasi() == true) {
                $.ajax({

                    url: "<?php echo base_url('masterdata/customer/update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nama: nama,
                        alamat: alamat,
                        nohp: nohp,
                        notlp: notlp,
                        email: email,
                        kode: kode,
                        kelurahan: kelurahan,
                        kecamatan: kecamatan,
                        kota: kota,
                        provinsi: provinsi,
                        kodepos: kodepos,
                        top: top,
                        kreditlimit: kreditlimit,
                        pkp: pkp,
                        npwp: npwp,
                        namanpwp: namanpwp,
                        alamatnpwp: alamatnpwp,
                        aktif: aktif,
                        titlecustomer: titlecustomer,
                        kategoricustomer: kategoricustomer,
                        jeniscustomer:jeniscustomer
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
        // --END UPDATE --
        $("#nohp").keypress(function(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        });
        $("#notlp").keypress(function(data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                return false;
            }
        });

        document.getElementById("carikodepos").addEventListener("click", function(event) {
            $('.popup1').css('visibility', 'visible');
            event.preventDefault();
            $('#tablesearchkodepos').DataTable({
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
                    "url": "<?php echo base_url('masterdata/customer/caridatakodepos'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_kodepos",
                        field: {
                            kode: "kode",
                            kelurahan: "kelurahan",
                            kecamatan: "kecamatan",
                            kota: "kota",
                            provinsi: "provinsi",
                            kodepos: "kodepos"
                        },
                        sort: "kode,kelurahan",
                        where: {
                            kode: "kode",
                            kelurahan: "kelurahan",
                            kecamatan: "kecamatan",
                            kota: "kota",
                            provinsi: "provinsi",
                            kodepos: "kodepos"
                        },
                        value: "aktif = true"
                    },

                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchkodepos").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchkodepos", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/customer/getKelurahan'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode').val(data[i].kode.trim());
                        $('#kelurahan').val(data[i].kelurahan.trim());
                        $('#kecamatan').val(data[i].kecamatan.trim());
                        $('#kota').val(data[i].kota.trim());
                        $('#provinsi').val(data[i].provinsi.trim());
                        $('#kodepos').val(data[i].kodepos.trim());
                    }
                }
            });
            $('.popup1').css('visibility', 'hidden');
        });

        document.getElementById("export").addEventListener("click", function(event) {
            window.open(
                "<?php echo base_url('export_excel/report/mastercustomer/') ?>"
            );

        });

    });
</script>