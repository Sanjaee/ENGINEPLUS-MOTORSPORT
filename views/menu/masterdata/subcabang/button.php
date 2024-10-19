<script type="text/javascript">
    $(document).ready(function() {
        $('#tablesearchtampil').css('visibility', 'hidden');
        //disable tombol update
        $('#update').prop('disabled', true);
        $("#aktif").prop("checked", true);

        // -- Validasi --
        function CekValidasi() {
            if ($('#scabang').val() == 0 || $('#scabang').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kode Cabang Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#scabang').focus();
                var result = false;
            } else if ($('#kodesub').val() == 0 || $('#kodesub').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kode Sub Cabang Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kodesub').focus();
                var result = false;
            } else if ($('#namasub').val() == 0 || $('#namasub').val() == '') {
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
            } else {
                var result = true;
            }
            return result;
        };

        function FindData() {
            document.getElementById('kodesub').disabled = true;
            document.getElementById('kodesub').disabled = true;
            document.getElementById('alamat').disabled = true;
            document.getElementById('aktif').disabled = true;
            $('#save').prop('disabled', true);
            $('#update').prop('disabled', false);

        }
        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecabang = $('#scabang').val();
            var kodesub = $('#kodesub').val();
            var namasub = $('#namasub').val();
            var alamat = $('#alamat').val();
            var aktif = $("input[name='aktif']:checked").val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/subcabang/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kodecabang: kodecabang,
                        kodesub: kodesub,
                        namasub: namasub,
                        alamat: alamat,
                        aktif: aktif
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
                            $('#kodesub').val(data.nomor);
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
            $('#tablesearchtampil').css('visibility', 'visible');
            event.preventDefault();
            var kodecabang = $('#scabang').val();
            // console.log(kodecabang);
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('masterdata/subcabang/finddata'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_subcabang",
                        field: {
                            kodesub: "kodesub",
                            namasub: "namasub",
                            alamat: "alamat"
                        },
                        sort: "kodesub,namasub",
                        where: {
                            kodesub: "kodesub",
                            namasub: "namasub"
                        },
                        value: "aktif = true and kode_cabang = '" + kodecabang + "'"
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearch").addEventListener("click", function(event) {
            event.preventDefault();
            $('#tablesearchtampil').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            var kode_cabang = $('#scabang').val();
            $.ajax({
                url: "<?php echo base_url('masterdata/subcabang/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode_cabang: kode_cabang,
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodecabang').val(data[i].kode_cabang.trim());
                        $('#kodesub').val(data[i].kodesub.trim());
                        $('#namasub').val(data[i].namasub.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        $('#save').prop('disabled', true);
                        $('#update').prop('disabled', false);

                        if (data[i].aktif == 't') {
                            $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                        }

                    }
                    document.getElementById('kodesub').disabled = true;
                }
            });


            $('#tablesearchtampil').css('visibility', 'hidden');
        });
        // -- END FIND --

        // -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var kodecabang = $('#scabang').val();
            var kodesub = $('#kodesub').val();
            var namasub = $('#namasub').val();
            var alamat = $('#alamat').val();
            var aktif = $("input[name='aktif']:checked").val();

            if (kodecabang == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih data terlebih dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#scabang').focus();
            } else if (kodesub == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kode Sub Cabang Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kodesub').focus();
            } else if (alamat == '') {
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
            } else if (aktif == undefined) {
                $.alert({
                    title: 'Info..',
                    content: 'Jenis aktif harus dipilih',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#aktif').focus();
            } else {

                $.ajax({
                    url: "<?php echo base_url('masterdata/subcabang/update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kodecabang: kodecabang,
                        kodesub: kodesub,
                        namasub: namasub,
                        alamat: alamat,
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
    });
</script>