<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('kode_grup').disabled = true;
        document.getElementById('nama_grup').disabled = true;
        document.getElementById('kode_cabang').disabled = true;
        document.getElementById('nama_cabang').disabled = true;
        $('.popup1').css('visibility', 'hidden');
        $('.popup2').css('visibility', 'hidden');
        $('.popup3').css('visibility', 'hidden');
        $('#kodesub').val("ALL");
        $('#namasub').val("ALL");
        $('#kode_cabang').val("ALL");
        $('#nama_cabang').val("ALL");
        $("#caricabang").hide();
        
        
        $('#update').prop('disabled', true);
        $("#aktif").prop("checked", true);

        var kode = $('#kodecompany').val();
        DataCompany(kode);
        if (kode == 'ALL'){
            $("#caricompany").show();
        }else{
            $("#caricompany").hide();
        }

        var kodecabang = $('#scabang').val();
        if (kodecabang != 'ALL'){
            DataCabang(kodecabang);
            $("#caricabang").hide();
        } else {
            $("#caricabang").show();
        }

        function DataCabang(kodecabang) {
            $.ajax({  
                url:"<?php echo base_url('masterdata/user/getCabang'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{
                    kode:kodecabang
                },  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            $('#kode_cabang').val(data[i].kode.trim());
                            $('#nama_cabang').val(data[i].nama.trim());
                        }
                    }  
            });  
        };

        function DataCompany(kode) {
            $.ajax({  
                url:"<?php echo base_url('masterdata/user/getCompany'); ?>",  
                method:"POST", 
                dataType: "json",
                async : true,
                data:{
                    kode:kode
                },  
                success:function(data){  
                        for(var i = 0; i < data.length; i++){
                            $('#namacompany').val(data[i].nama.trim());
                        }
                    }  
            });  
        };

        //------------------------------GRUP----------------------------------------------        
        document.getElementById("carigrup").addEventListener("click", function(event) {
            $('.popup1').css('visibility', 'visible');
            event.preventDefault();
            $('#tablesearchgrup').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('masterdata/user/caridatagrup'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "stpm_grup",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode,nama",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchgrup").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup1').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchgroup", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/user/getGrup'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode_grup').val(data[i].kode.trim());
                        $('#nama_grup').val(data[i].nama.trim());
                    }
                }
            });
            $('.popup1').css('visibility', 'hidden');
        });
        //-----------------------------------------END Cari Grup ---------------------------------------------------------------
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
                    "url": "<?php echo base_url('masterdata/user/caridatacabang'); ?>",
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
                url: "<?php echo base_url('masterdata/user/getCabang'); ?>",
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
        //--------------------------------------------------------------END CARI CABANG----------------------------------------------

         //----------------------------------------- CARI SUB CABANG ----------------------------------------------------------------
         document.getElementById("carisubcabang").addEventListener("click", function(event) {
            $('.popup4').css('visibility', 'visible');
            event.preventDefault();
            var kodecabang = $('#kode_cabang').val();
            var kodecompany = $('#kodecompany').val();
            // console.log(kodecabang);
            $('#tablesearchsubcabang').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('masterdata/user/caridatasubcabang'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_subcabang",
                        field: {
                            kodesub: "kodesub",
                            namasub: "namasub"
                        },
                        sort: "kodesub,namasub",
                        where: {
                            kodesub: "kodesub",
                            namasub: "namasub"
                        },
                        value: "aktif = true and kode_cabang = '" + kodecabang + "' and kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchsubcabang").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup4').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchsubcabang", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            var kodecabang = $('#kode_cabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('masterdata/user/getSubcabang'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode, kodecabang: kodecabang, kodecompany: kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodesub').val(data[i].kodesub.trim());
                        $('#namasub').val(data[i].namasub.trim());
                    }
                }
            });
            $('.popup4').css('visibility', 'hidden');
        });
        //--------------------------------------------------------------END CARI SUB CABANG----------------------------------------------

        //----------------------------------------- CARI COMPANY ----------------------------------------------------------------
        document.getElementById("caricompany").addEventListener("click", function(event) {
            $('.popup5').css('visibility', 'visible');
            event.preventDefault();
            $('#tablesearchcompany').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('caridata/caridata'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "stpm_konfigurasi",
                        field: {
                            kode: "kode",
                            nama: "nama"
                        },
                        sort: "kode,nama",
                        where: {
                            kode: "kode",
                            nama: "nama"
                        },
                        // value: "aktif = true and kode_cabang = '" + kodecabang + "'"
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearchcompany").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup5').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var kode = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/user/getCompany'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodecompany').val(data[i].kode.trim());
                        $('#namacompany').val(data[i].nama.trim());
                    }
                }
            });
            $('.popup5').css('visibility', 'hidden');
        });

        // -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var login = $('#login').val();
            var password = $('#password').val();
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var kode_grup = $('#kode_grup').val();
            var nama_grup = $('#nama_grup').val();
            var kode_cabang = $('#kode_cabang').val();
            var nama_cabang = $('#nama_cabang').val();
            var kodesub = $('#kodesub').val();
            var kodecompany = $('#kodecompany').val();
            var aktif = $("input[name='aktif']:checked").val();

            if (login == '') {
                alert('Login Tidak Boleh Kosong');
                $('#login').focus();
            } else if (password == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Password Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#password').focus();
            } else if (nama == '') {
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
            } else if (kode_grup == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kode Grup Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carigrup').focus();
            } else if (nama_grup == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nama Grup Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carigrup').focus();
            } else if (kode_cabang == '') {
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
                $('#caricabang').focus();
            } else if (kode_cabang == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nama Cabang Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caricabang').focus();
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
                    url: "<?php echo base_url('masterdata/user/save'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        login: login,
                        password: password,
                        nama: nama,
                        alamat: alamat,
                        kode_grup: kode_grup,
                        nama_grup: nama_grup,
                        kode_cabang: kode_cabang,
                        nama_cabang: nama_cabang,
                        kodecompany: kodecompany,
                        kodesub: kodesub,
                        aktif: aktif
                    },
                    success: function(data) {
                        if (data.message == "Data berhasil disimpan") {
                            $('#save').prop('disabled', true);
                            $('#update').prop('disabled', false);
                            document.getElementById('login').disabled = true;
                            document.getElementById('password').disabled = true;
                            document.getElementById('nama').disabled = true;
                            document.getElementById('alamat').disabled = true;
                            document.getElementById('kode_grup').disabled = true;
                            document.getElementById('nama_grup').disabled = true;
                            document.getElementById('kode_cabang').disabled = true;
                            document.getElementById('nama_cabang').disabled = true;
                            document.getElementById('aktif').disabled = true;
                            document.getElementById('carigrup').disabled = true;
                            document.getElementById('caricabang').disabled = true;
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
            $('.popup3').css('visibility', 'visible');
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
                    "url": "<?php echo base_url('masterdata/user/caridataafind'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "stpm_users",
                        field: {
                            login: "login",
                            nama: "nama",
                            alamat: "alamat",
                            grup: "grup",
                            kode_cabang: "kode_cabang"
                        },
                        sort: "login,nama",
                        where: {
                            login: "login",
                            nama: "nama",
                            alamat: "alamat",
                            grup: "grup",
                            kode_cabang: "kode_cabang"
                        },
                         value: "kodecompany = '" + kodecompany + "'"
                    },
                }
            });
        }, false);

        //Close Pop UP Search
        document.getElementById("closesearch").addEventListener("click", function(event) {
            event.preventDefault();
            $('.popup3').css('visibility', 'hidden');
            // location.reload(true);
        }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var login = result.trim();
            $.ajax({
                url: "<?php echo base_url('masterdata/user/find'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    login: login
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#login').val(data[i].login.trim());
                        $('#nama').val(data[i].nama.trim());
                        $('#password').val(data[i].password.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        $('#kode_grup').val(data[i].grup.trim());
                        namagrup(data[i].grup.trim());
                        $('#kode_cabang').val(data[i].kode_cabang.trim());
                        namacabang(data[i].kode_cabang.trim());
                        $('#kodesub').val(data[i].kodesub.trim());
                        namasubcabang(data[i].kodesub.trim(),data[i].kode_cabang.trim());
                        if (data[i].aktif == 't') {
                            $('input:radio[name="aktif"][value="true"]').prop('checked', true);
                        } else {
                            $('input:radio[name="aktif"][value="false"]').prop('checked', true);
                        }
                        $('#kodecompany').val(data[i].kodecompany.trim());
                        namacompany(data[i].kodecompany.trim());

                        document.getElementById('login').disabled = true;
                        $('#save').prop('disabled', true);
                        $('#update').prop('disabled', false);
                        $('#cariaccount').prop('disabled', false);
                    }
                }
            });
            $('.popup3').css('visibility', 'hidden');
        });
        // -- END FIND --
        function namagrup(params) {
            $.ajax({
                url: "<?php echo base_url('masterdata/user/getGrup'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: params
                },
                success: function(data) {
                    // console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        $('#nama_grup').val(data[i].nama.trim());
                    }
                }
            });
        }

        function namacabang(params) {
            $.ajax({
                url: "<?php echo base_url('masterdata/user/getcabang'); ?>",
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

        function namasubcabang(kode,kodecabang) {
            $.ajax({
                url: "<?php echo base_url('masterdata/user/getSubcabang'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode,
                    kodecabang: kodecabang
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        // $('#nomoraccount').val(data[i].nomor.trim());
                        $('#namasub').val(data[i].namasub.trim());
                    }
                }
            });
        }

        function namacompany(kode) {
            $.ajax({
                url: "<?php echo base_url('masterdata/user/getCompany'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        // $('#nomoraccount').val(data[i].nomor.trim());
                        $('#namacompany').val(data[i].nama.trim());
                    }
                }
            });
        }

        // -- UPDATE --
        document.getElementById("update").addEventListener("click", function(event) {
            event.preventDefault();
            var login = $('#login').val();
            var password = $('#password').val();
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var kode_grup = $('#kode_grup').val();
            var nama_grup = $('#nama_grup').val();
            var kode_cabang = $('#kode_cabang').val();
            var nama_cabang = $('#nama_cabang').val();
            var aktif = $("input[name='aktif']:checked").val();
            var kodesub = $('#kodesub').val();
            var kodecompany = $('#kodecompany').val();

            if (login == '') {
                alert('Login Tidak Boleh Kosong');
                $('#login').focus();
            } else if (password == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Password Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#password').focus();
            } else if (nama == '') {
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
            } else if (kode_grup == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Kode Grup Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carigrup').focus();
            } else if (nama_grup == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nama Grup Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#carigrup').focus();
            } else if (kode_cabang == '') {
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
                $('#caricabang').focus();
            } else if (kode_cabang == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Nama Cabang Tidak Boleh Kosong',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#caricabang').focus();
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

                    url: "<?php echo base_url('masterdata/user/update'); ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        login: login,
                        password: password,
                        nama: nama,
                        alamat: alamat,
                        kode_grup: kode_grup,
                        nama_grup: nama_grup,
                        kode_cabang: kode_cabang,
                        nama_cabang: nama_cabang,
                        kodesub: kodesub,
                        kodecompany: kodecompany,
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
        // --END UPDATE --
    });
</script>