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

        // ------------- Otorisasi Pembatalan -------------
        <?php

        $grup = $this->session->userdata('mygrup');
        $nama_menu = 'Input Faktur Pajak';

        $get["otorisasi"] = $this->db->query("SELECT * FROM stpm_otorisasipembatalan
            WHERE grup = '" . $grup . "' AND nama_menu = '" . $nama_menu . "' AND otoritas_batal = 'YES' ")->result();

        if (!$get["otorisasi"]) {
            $result = 'NO';
        } else {
            $result = 'YES';
        }

        ?>

        var otoritas_batal = "<?php echo $result ?>";

        if (otoritas_batal == 'YES') {
            $("#cancel").show();
        } else {
            $("#cancel").hide();
        }
        // -------------------------------------------

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
            var kode_cabang = $('#scabang').val();
            $('#nomor').val("FP-" + kode_cabang + "-" + yr + mt + "00000");
            $('#tanggalfp').val(newDate);
            $('#tglppnx').val(newDate);
            $('#tglppn').datepicker({
                format: "dd MM yyyy",
                autoclose: true
            });
            $('#nomorfp').val("");
            $('#noinvoice').val("");
            $('#nocustomer').val("");
            $('#namacustomer').val("");
            $("#nopolisi").val("");
            $("#alamat").val("");
            $("#npwp").val("");
            $('#dpp').val("0");
            $('#ppn').val("0");
            $('#grandtotal').val("0");
            
            $('#tablesearchtampil').css('visibility', 'hidden');

            document.getElementById('save').disabled = false;
            document.getElementById('find').disabled = false;
            document.getElementById('cancel').disabled = true;
            document.getElementById('cariinvoice').disabled = false;
            // document.getElementById('carinomorfp').disabled = false;
            $('#detaildata').empty();
        };
        BersihkanLayarBaru();
        $("#loading").hide();
        $('#tablesearchtampil').css('visibility', 'hidden');

         /* Fungsi formatRupiah */
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

        // ---------- Validasi----------------------------------------
        function CekValidasi() {
            if ($('#nomorfp').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Isi Nomor Faktur Pajak Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#nomorfp').focus();
                var result = false;
            // } else if ($('#noinvoice').val() == '') {
            //     $.alert({
            //         title: 'Info..',
            //         content: 'Pilih No Invoice Terlebih Dahulu',
            //         buttons: {
            //             formSubmit: {
            //                 text: 'OK',
            //                 btnClass: 'btn-red'
            //             }
            //         }
            //     });
            //     $('#noinvoice').focus();
            //     var result = false;
            } else {
                var result = true;
            }
            return result;
        };

        function TurnDisableSave() {
            document.getElementById('save').disabled = true;
            document.getElementById('cariinvoice').disabled = true;
			// document.getElementById('carinomorfp').disabled = true;
            //$("#carispk").hide();
        };

        function TurnDisable() {
            document.getElementById('cancel').disabled = false;
            document.getElementById('save').disabled = true;
            // document.getElementById('carinomorfp').disabled = true;
            document.getElementById('cariinvoice').disabled = true;
        };

        function cleardetail() {
            $('#detaildata').empty();
        }

        // ---------- Get Invoice --------------------------------------
        function DataInvoice(nomor) {
            $.ajax({
                url: "<?php echo base_url('faktur/inputfakturpajak/GetDataInvoice'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#noinvoice').val(data[i].nomor.trim());
                        $('#tglppnx').val(formatDate(data[i].tanggal.trim()));
                        $('#nocustomer').val(data[i].nomor_customer.trim());
                        $('#namacustomer').val(data[i].namanpwp.trim());
                        $('#nopolisi').val(data[i].nopolisi.trim());
                        $('#alamat').val(data[i].alamatnpwp.trim());
                        $('#npwp').val(data[i].npwp.trim());
                        $('#dpp').val(formatRupiah(data[i].dpp.trim(),''));
                        $('#ppn').val(formatRupiah(data[i].ppn.trim(),''));
                        $('#grandtotal').val(formatRupiah(data[i].grandtotal.trim(),''));
                    }
                }
            });
        };

		// ---------- Get Nomor Faktur Pajak --------------------------------------
		// function DataNomorFakturPajak(nomor) {
        //     $.ajax({
        //         url: "<?php echo base_url('faktur/inputfakturpajak/GetDataNomorFakturPajak'); ?>",
        //         method: "POST",
        //         dataType: "json",
        //         async: true,
        //         data: {
        //             nomor: nomor
        //         },
        //         success: function(data) {
        //             for (var i = 0; i < data.length; i++) {
        //                 $('#nomorfp').val(data[i].nomor_fakturpajak.trim());
        //             }
        //         }
        //     });
        // };

        function DataFindDetail(nomor) {
            cleardetail();
            $.ajax({
                url: "<?php echo base_url('faktur/inputfakturpajak/GetDataDetail'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var nomorfp = data[i].nomor_fakturpajak.trim();
                        var noinvoice = data[i].nomor_penjualan.trim();
                        var tglppn =  formatDate(data[i].tglppn.trim());
                        var nocustomer = data[i].kode_customer.trim();
                        var namacustomer = data[i].nama.trim();
                        var npwp = data[i].npwp.trim();
                        insertdetail(noinvoice, tglppn, nocustomer, namacustomer,npwp, "disabled");
                    }
                }
            });
        };

        // ---------- OnLookUp Invoice --------------------------------------
        document.getElementById("cariinvoice").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            // if (kode_cabang == "HO") {
            //     values = "status = 0 and batal = false"
            // } else {
            //     values = "kode_cabang = '" + kode_cabang + "' and status = 0 and batal = false"
            // }
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            //console.log(kode_cabang);
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and nomor_fakturpajak = '' and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and nomor_fakturpajak = '' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and nomor_fakturpajak = '' and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearchinvoice').DataTable({
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
                    "url": "<?php echo base_url('faktur/inputfakturpajak/CariDataInvoice'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "cari_datafaktur",
                        field: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_spk: "nomor_spk",
                            namanpwp: "namanpwp"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nopolisi: "nopolisi",
                            nomor_spk: "nomor_spk",
                            namanpwp: "namanpwp"
                        },
                        value: values
                    },
                }
            });
        }, false);

		// ---------- OnLookUp Nomor Faktur Pajak --------------------------------------
		// document.getElementById("carinomorfp").addEventListener("click", function(event) {
        //     event.preventDefault();
        //     var values = 'status_fakturpajak = false';
        //     $('#tablesearchnomorfp').DataTable({
        //         "destroy": true,
        //         "searching": true,
        //         "processing": true,
        //         "serverSide": true,
        //         "lengthChange": false,
        //         // // "scrollX": true,
        //         // "scrollY": true,
        //         // // "ordering":  true,
        //         "order": [],
        //         // "order":[0,1,2],  
        //         "ajax": {
        //             "url": "<?php echo base_url('faktur/inputfakturpajak/CariDataNomorFakturPajak'); ?>",
        //             "method": "POST",
        //             "data": {
        //                 nmtb: "cari_datafakturpajak",
        //                 field: {
        //                     nomor_fakturpajak: "nomor_fakturpajak",
        //                 },
        //                 sort: "nomor_fakturpajak",
        //                 where: {
        //                     nomor_fakturpajak: "nomor_fakturpajak",
        //                 },
        //                 value: values
        //             },
        //         }
        //     });
        // }, false);

        $(document).on('click', ".searchinv", function() {
            var result = $(this).attr("data-id");
            $('#noinvoice').val(result.trim());
            DataInvoice(result.trim());
        });

		// $(document).on('click', ".searchfp", function() {
        //     var result = $(this).attr("data-id");
        //     $('#nomorfp').val(result.trim());
        //     DataNomorFakturPajak(result.trim());
        // });

        // ---------- OnLookUp Parts --------------------------------------

        // ---------- OnLookUp Find --------------------------------------
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            kode_cabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();
            if (kode_cabang == "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and kodecompany = '" + kodecompany + "'"
            } else if (kode_cabang != "ALL" && kodesubcabang == "ALL") {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "'"
            } else {
                values = "batal = false and kodecompany = '" + kodecompany + "' and kode_cabang = '" + kode_cabang + "' and kodesubcabang = '" + kodesubcabang + "'"
            }
            $('#tablesearch').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('faktur/inputfakturpajak/CariDataFP'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "trnt_fakturpajakstandard",
                        field: {
                            nomor: "nomor",
                            nomor_penjualan: "nomor_penjualan",
                            nomor_fakturpajak: "nomor_fakturpajak"
                        },
                        sort: "nomor",
                        where: {
                            nomor: "nomor",
                            nomor_penjualan: "nomor_penjualan",
                            nomor_fakturpajak: "nomor_fakturpajak"
                        },
                        value: values
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchok", function() {
            var result = $(this).attr("data-id");
            var nomor = result.trim();
            $.ajax({
                url: "<?php echo base_url('faktur/inputfakturpajak/GetDataFP'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].nomor.trim());
                        $('#nomorfp').val(data[i].nomor_fakturpajak.trim());
                        $('#tanggalfp').val(formatDate(data[i].tanggal.trim()));
                    }
                    DataFindDetail(nomor);
                    TurnDisable();
                }
            }, false);
        });
        // ---------- On Button Save --------------------------------------
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var datadetail = ambildatadetail();
            var nomor = $('#nomor').val();
            // var nomorfp = $('#nomorfp').val();
            var tanggalfp = $('#tanggalfp').val();
            var kodecabang = $('#scabang').val();
            var kodesubcabang = $('#subcabang').val();
            var kodecompany = $('#kodecompany').val();

			$.ajax({
				url: "<?php echo base_url('faktur/inputfakturpajak/Save'); ?>",
				method: "POST",
				dataType: "json",
				async: true,
				data: {
					nomor: nomor,
					// nomorfp: nomorfp,
					tanggalfp: tanggalfp,
					kodecabang: kodecabang,
					kodesubcabang: kodesubcabang,
					kodecompany: kodecompany,
					detailrequest: datadetail
				},
				beforeSend: function(data) {
					$("#loading").show();
					$("#save").hide();
				},
				complete: function(data) {
					$("#loading").hide();
					$("#save").show();
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
						TurnDisableSave();
						$('#nomor').val(data.nomor);
						$('#nomorfp').val(data.nomorfp);
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
				},
				error: function() {
					$.alert({
						title: 'Info..',
						content: 'Data gagal disimpan!',
						buttons: {
							formSubmit: {
								text: 'ok',
								btnClass: 'btn-red'
							}
						}
					});
				}
			}, false);
        });
        // ---------- ADD DETAIL TABLE ----------------------------------
        function ValidasiAdd() {
            var nomor = $("#noinvoice").val();
            var table = document.getElementById('detail');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string = "";
                for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                    if (c == 1) {
                        if (table.rows[r].cells[c].innerHTML == nomor) {
                            $.alert({
								title: 'Info..',
								content: 'Data sudah pernah di input',
								buttons: {
									formSubmit: {
										text: 'OK',
										btnClass: 'btn-red'
									}
								}
							});
							return false;
                        }
                    }
                }
            }
            return "sukses";
        }

        $("#add_detail").click(function() {
            // if ($('#nomorfp').val() == '') {
            //     $.alert({
            //         title: 'Info..',
            //         content: 'Isi Nomor Faktur Pajak Terlebih Dahulu',
            //         buttons: {
            //             formSubmit: {
            //                 text: 'OK',
            //                 btnClass: 'btn-red'
            //             }
            //         }
            //     });
            //     $('#nomorfp').focus();
            //     var result = false;
            // } else 
			if ($('#noinvoice').val() == '') {
                $.alert({
                    title: 'Info..',
                    content: 'Pilih No Invoice Terlebih Dahulu',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
                $('#noinvoice').focus();
                var result = false;
            } else {
				// var nomorfp = $('#nomorfp').val();
                var noinvoice = $("#noinvoice").val();
                var tglppn = $("#tglppnx").val();
                var nocustomer = $("#nocustomer").val();
                var namacustomer = $("#namacustomer").val();
                var npwp = $("#npwp").val();
                if (ValidasiAdd() == "sukses") {
                    insertdetail(noinvoice, tglppn, nocustomer, namacustomer,npwp,"")
                    $("#noinvoice").val("");
                    $("#tglppnx").val("");
                    $('#noinvoice').val("");
                    $('#nocustomer').val("");
                    $('#namacustomer').val("");
                    $("#nopolisi").val("");
                    $("#alamat").val("");
                    $("#npwp").val("");
                    $('#dpp').val("0");
                    $('#ppn').val("0");
                    $('#grandtotal').val("0");
                    document.getElementById('nomorfp').disabled = true;
                }
            }
        });

        function insertdetail(noinvoice, tglppn, nocustomer, namacustomer,npwp, find) {
            var row = "";
            row =
                '<tr id="' + noinvoice + '">' +
                '<td style="display:none;"></td>' +
                '<td>' + noinvoice + '</td>' +
                '<td>' + tglppn + '</td>' +
                '<td>' + nocustomer + '</td>' +
                '<td>' + namacustomer + '</td>' +
                '<td>' + npwp + '</td>' +
                '<td>' +
                '<button data-table="' + noinvoice + '" class="hapus btn btn-close" ' + find + '><i class="fa fa-times"></i></button>' +
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
                for (var c = 1, m = table.rows[r].cells.length; c < m - 1; c++) {
                    if (c == 1) {
                        string = "{" + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML.replace("'", "").replace(".", "") + "'";
                    } else {
                        string = string + ", " + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML.replace("'", "").replace(".", "") + "'";
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
            $('#' + id).remove();
            var table = document.getElementById('detaildata');
            if (table.rows.length == 1) {
                document.getElementById('qty').disabled = false;
            }
        });

        // ---------- Cancel ----------------------------------
        document.getElementById("cancel").addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
			var nomorfp = $('#nomorfp').val();
            var datadetail = ambildatadetail();

				console.log(datadetail);
            $.confirm({
                title: 'Info..',
                content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Apakah anda yakin ?</label>' +
                    '<input type="text" placeholder="Masukkan Alasan Pembatalan" class="alasan form-control" required />' +
                    // '<textarea class="Alamat form-control" placeholder="alasan"  required />' +
                    '</div>' +
                    '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Ok',
                        btnClass: 'btn-red',
                        action: function() {
                            var alasan = this.$content.find('.alasan').val();
                            if (!alasan) {
                                $.alert('Alasan belum diisi');
                                return false;
                            }
                            $.ajax({
                                url: "<?php echo base_url('faktur/inputfakturpajak/Cancel'); ?>",
                                method: "POST",
                                dataType: "json",
                                async: true,
                                data: {
                                    nomor: nomor,
                                    datadetail:datadetail,
                                    alasan: alasan,
									nomorfp: nomorfp
                                },
                                success: function(data) {
                                    if (data.error == true) {
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
                                                    btnClass: 'btn-red',
                                                    keys: ['enter', 'shift'],
                                                    action: function() {
                                                        BersihkanLayarBaru()
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }
                            });
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

        });

        // ---------- On Button New --------------------------------------
        document.getElementById("new").addEventListener("click", function(event) {
            event.preventDefault();
            BersihkanLayarBaru();
            location.reload(true);

        });
    });
</script>
