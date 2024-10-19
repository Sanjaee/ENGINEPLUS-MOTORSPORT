<script type="text/javascript">
    $(document).ready(function() {
        $('#tablesearchtampil').css('visibility', 'hidden');
        //disable tombol update
        $('#update').prop('disabled', true);
        $("#aktif").prop("checked", true);

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
            } else if ($('#kode_cabang').val() == '' || $('#nama_cabang').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Cabang Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kode_cabang').focus();
                var result = false;
            } else if ($('#kode_foreman').val() == '' || $('#nama_foreman').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Foreman Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#kode_foreman').focus();
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
            document.getElementById('kode').disabled = true;
            document.getElementById('nama').disabled = true;
            document.getElementById('aktif').disabled = true;
            $('#save').prop('disabled', true);
            $('#cariaccount').prop('disabled', true);
            $('#update').prop('disabled', false);
        }

        //----------------------------------------- CARI CABANG ----------------------------------------------------------------
        document.getElementById("caricabang").addEventListener("click", function(event) {
            $('.popup2').css('visibility', 'visible');
            var kodecompany = $('#kodecompany').val();
            event.preventDefault();
            $('#tablesearchcabang').DataTable({
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
                    "url": "<?php echo base_url('masterdata/mekanik/caridatacabang'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_cabang",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode,nama",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchcabang").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup2').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchcabang", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/mekanik/getCabang'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode_cabang').val(data[i].kode.trim());
                        $('#nama_cabang').val(data[i].nama.trim());
                    }
                }
            });
            $('.popup2').css('visibility', 'hidden');
        });

        //----------------------------------------- CARI FOREMAN ----------------------------------------------------------------
        document.getElementById("cariforeman").addEventListener("click", function(event) {
            $('.popup3').css('visibility', 'visible');
            var kodecompany = $('#kodecompany').val();
            var kode_cabang = $('#kode_cabang').val();
            event.preventDefault();
            $('#tablesearchforeman').DataTable({
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
                    "url": "<?php echo base_url('masterdata/mekanik/caridataforeman'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_foreman",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode,nama",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        value: "aktif = true and kode_cabang = '" + kode_cabang + "' and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchforeman").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup3').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchforeman", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/mekanik/getforeman'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode_foreman').val(data[i].kode.trim());
                        $('#nama_foreman').val(data[i].nama.trim());
                    }
                }
            });
            $('.popup3').css('visibility', 'hidden');
        });


        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var kode = $('#kode').val();
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var kodecabang = $('#kode_cabang').val();
            var kodecompany = $('#kodecompany').val();
            var alamat = $('#alamat').val();
            var aktif = $("input[name='aktif']:checked").val();
            var kodeforeman = $('#kode_foreman').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/mekanik/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kode: kode,
                        nama: nama,
                        alamat: alamat,
                        kodecabang: kodecabang,
                        kodecompany: kodecompany,
                        kodeforeman: kodeforeman,
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
            $('#tablesearchtampil').css('visibility', 'visible');
            var kodecompany = $('#kodecompany').val();
            event.preventDefault();
            $('#tablesearch').DataTable({
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
                    "url": "<?php echo base_url('masterdata/mekanik/caridatafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_teknisi",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                        sort: "kode,nama",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat"
                        },
                         value: "kodecompany = '" + kodecompany + "'"
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
            $.ajax({
                url: "<?php echo base_url('masterdata/mekanik/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode').val(data[i].kode.trim());
                        $('#nama').val(data[i].nama.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        $('#kode_cabang').val(data[i].kode_cabang.trim());
                        namacabang(data[i].kode_cabang.trim());
                        $('#kode_foreman').val(data[i].kode_foreman.trim());
                        namaforeman(data[i].kode_foreman.trim());
                        $('#save').prop('disabled', true);
                        $('#update').prop('disabled', false);

                        if (data[i].aktif == 't') {
                            $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                        }

                    }
                    document.getElementById('kode').disabled = true;
                }
            });


            $('#tablesearchtampil').css('visibility', 'hidden');
        });
        // -- END FIND --
        function namacabang(params) {
            $.ajax({
                url: "<?php echo base_url('masterdata/mekanik/getcabang'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: params
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        // $('#nomoraccount').val(data[i].nomor.trim());
                        $('#nama_cabang').val(data[i].nama.trim());
                    }
                }
            });
        }
        
        function namaforeman(params) {
            $.ajax({
                url: "<?php echo base_url('masterdata/mekanik/getforeman'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: params
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        // $('#nomoraccount').val(data[i].nomor.trim());
                        $('#nama_foreman').val(data[i].nama.trim());
                    }
                }
            });
        }

        // -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var kode = $('#kode').val();
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var aktif = $("input[name='aktif']:checked").val();
            var kodecabang = $('#kode_cabang').val();
            var kodeforeman = $('#kode_foreman').val();

            if (CekValidasi() == true) {
                $.ajax({
                    url: "<?php echo base_url('masterdata/mekanik/update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kode: kode,
                        nama: nama,
                        alamat: alamat,
                        aktif: aktif,
                        kodecabang: kodecabang,
                        kodeforeman: kodeforeman
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