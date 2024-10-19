<script type="text/javascript">
	$(document).ready(function() {
		$('#carijenisreport').prop('disabled', true)
		// $("#excel").css('visibility', 'hidden'); 
		$("#grup_part").css('visibility', 'hidden');
		$("#bulanan").css('visibility', 'hidden');
		$("#grup_customer").css('visibility', 'hidden');
		var status = false;
		Bersihkanlayarbaru();

		// ---------- Validasi----------------------------------------
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
			return year + ' ' + month + ' ' + day;
		}

		function Bersihkanlayarbaru() {
			var date = new Date(),
				yr = (date.getFullYear().toString()).substring(2, 4),
				mt = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
				year = date.getFullYear(),
				bulan = date.getMonth() + 1,
				month = getbulan(bulan),
				day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
				newDate = year + ' ' + month + ' ' + day;
			var kode_cabang = $('#scabang').val();
			$('#jenis_report').val("-- Pilih Report --");
			// $('#tglmulai').val(newDate);
			// $('#tglakhir').val(newDate);
		}

		$('#tanggal_mulai').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true,
			// todayHighlight: true,
			// startDate: new Date()
			minDate: '+1d',
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yyyy-mm-dd',
			onSelect: function(dateStr) {
				var date = $(this).datepicker('getDate');
				date.setMonth(date.getMonth() + 1, 0);
				$('#tanggal_akhir').val($.datepicker.formatDate('yyyy-mm-dd', date));
			}
		});

		$('#tanggal_akhir').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
			// todayHighlight: true,
			// startDate: new Date()
		});

		$('#bulan_mulai').datepicker({
			format: "yyyy-mm",
			autoclose: true,
			todayHighlight: true
			// todayHighlight: true,
			// startDate: new Date()
		});

		document.getElementById("jenis_report").addEventListener("change", function(event) {
			event.preventDefault();
			$('#viewname').val();
			$('#reportname').val();
			$('#reportlocation').val();
			var nmrp = $('#jenis_report').val();
			var gruplogin = $('#gruplogin').val();
			// console.log(gruplogin);
			// cek Apakah report menggunakan inputan tgl
			if (cekstatustanggal($('#jenis_report').val(), gruplogin) == true) {
				$("#cetak").css('visibility', 'visible');
				if ($('#jenis_report').val() == 'History Spareparts') {
					$("#tanggalinput").css('visibility', 'visible');
					$("#grup_part").css('visibility', 'visible');
					$("#bulanan").css('visibility', 'hidden');
					$("#grup_customer").css('visibility', 'hidden');
				} else if ($('#jenis_report').val() == 'Laporan Outstanding AR' || $('#jenis_report').val() == 'Laporan Outstanding AP') {
					$("#tanggalinput").css('visibility', 'hidden');
					$("#grup_part").css('visibility', 'hidden');
					$("#bulanan").css('visibility', 'hidden');
					// $("#cetak").css('visibility', 'hidden');
					$("#grup_customer").css('visibility', 'hidden');
				} else if ($('#jenis_report').val() == 'Kartu Piutang Customer') {
					$("#tanggalinput").css('visibility', 'hidden');
					$("#grup_part").css('visibility', 'hidden');
					$("#bulanan").css('visibility', 'hidden');
					// $("#cetak").css('visibility', 'hidden');
					$("#grup_customer").css('visibility', 'visible');
				} else {
					$("#tanggalinput").css('visibility', 'visible');
					$("#grup_part").css('visibility', 'hidden');
					$("#bulanan").css('visibility', 'hidden');
					$("#grup_customer").css('visibility', 'hidden');
				}
			} else if (cekstatustanggal($('#jenis_report').val(), gruplogin) == false) {
				$("#tanggalinput").css('visibility', 'hidden');
				$("#grup_part").css('visibility', 'hidden');
				$("#bulanan").css('visibility', 'visible');
				$("#grup_customer").css('visibility', 'hidden');
			}
		});

        document.getElementById("jenis_report").addEventListener("change", function(event) {
            event.preventDefault();
            $('#viewname').val();
            $('#reportname').val();
            $('#reportlocation').val();
            var nmrp = $('#jenis_report').val();
            var gruplogin = $('#gruplogin').val();
            // console.log(gruplogin);
            // cek Apakah report menggunakan inputan tgl
            if (cekstatustanggal($('#jenis_report').val(), gruplogin) == true) {
                $("#cetak").css('visibility', 'visible');
                if ($('#jenis_report').val() == 'History Spareparts') {
                    $("#tanggalinput").css('visibility', 'visible');
                    $("#grup_part").css('visibility', 'visible');
                    $("#bulanan").css('visibility', 'hidden');
                    $("#grup_customer").css('visibility', 'hidden');
                } else if ($('#jenis_report').val() == 'Laporan Outstanding AR' || $('#jenis_report').val() == 'Laporan Outstanding AP' || $('#jenis_report').val() == 'Laporan Daftar Umur Piutang' || $('#jenis_report').val() == 'Laporan Daftar Umur Hutang' || $('#jenis_report').val() == 'Laporan PO dan OPL Belum Invoice Receive') {
                    $("#tanggalinput").css('visibility', 'hidden');
                    $("#grup_part").css('visibility', 'hidden');
                    $("#bulanan").css('visibility', 'hidden');
                    // $("#cetak").css('visibility', 'hidden');
                    $("#grup_customer").css('visibility', 'hidden');
                } else if ($('#jenis_report').val() == 'Kartu Piutang Customer') {
                    $("#tanggalinput").css('visibility', 'hidden');
                    $("#grup_part").css('visibility', 'hidden');
                    $("#bulanan").css('visibility', 'hidden');
                    // $("#cetak").css('visibility', 'hidden');
                    $("#grup_customer").css('visibility', 'visible');
                } else {
                    $("#tanggalinput").css('visibility', 'visible');
                    $("#grup_part").css('visibility', 'hidden');
                    $("#bulanan").css('visibility', 'hidden');
                    $("#grup_customer").css('visibility', 'hidden');
                }
            } else if (cekstatustanggal($('#jenis_report').val(), gruplogin) == false) {
                $("#tanggalinput").css('visibility', 'hidden');
                $("#grup_part").css('visibility', 'hidden');
                $("#bulanan").css('visibility', 'visible');
                $("#grup_customer").css('visibility', 'hidden');
            }
        });
		function cekstatustanggal(namareport, gruplogin) {
			$.ajax({
				url: "<?php echo base_url('form/report/cekstatustanggal'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					namareport: namareport,
					gruplogin: gruplogin
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#viewname').val(data[i].viewname.trim());
						$('#reportname').val(data[i].nama_report.trim());
						$('#reportlocation').val(data[i].url_report.trim());
						$('#filereport').val(data[i].reportname.trim());
						if (data[i].rangetanggal == "t") {
							status = true;
						} else {
							status = false;
						}
						// console.log(`status tgl:`, status);
					}
				}
			});
			return status;
		}

		function cekexport(namareport, gruplogin) {
			$.ajax({
				url: "<?php echo base_url('form/report/cekstatustanggal'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					namareport: namareport,
					gruplogin: gruplogin
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#viewname').val(data[i].viewname.trim());
						$('#reportname').val(data[i].nama_report.trim());
						$('#reportlocation').val(data[i].url_report.trim());
						$('#filereport').val(data[i].reportname.trim());
						if (data[i].export == "t") {
							statusx = true;
					} else {
							statusx = false;
						}
						console.log(`status ex:`, statusx);

					}
				}
			});
			return statusx;
		}

		// cari jenis report
		$('#pilihjenis_report').change(() => {
			$.ajax({
				url: "<?php echo base_url('form/report/getIdReport'); ?>",
				method: "POST",
				dataType: "json",
				async: true,
				data: {
					jenis: $('#pilihjenis_report').val(),
				},
				success: function(data) {
					$('#idjenisreport').val(data.id)
					$('#carijenisreport').prop('disabled', false)
				}
			});
		})


		document.getElementById("carijenisreport").addEventListener("click", function(event) {
			event.preventDefault();
			let id_jenis_report = $('#idjenisreport').val()
			$('#tablesearchjenisreport').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": false,
				"order": [],
				"ajax": {
					"url": "<?php echo base_url('form/report/carijenisreport'); ?>",
					"method": "POST",
					"data": {
						nmtb: "stpm_report",
						field: {
							nama_report: "nama_report",
							aktif: "aktif"
						},
						where: {
							nama_report: "nama_report"
						},
						sort: "nama_report",
						value: "jenis='" + id_jenis_report + "' and aktif=true and grup='" + $('#grup').val() + "'"
					},
				}
			});
		}, false);

		$(document).on('click', ".searchjenisreport", function() {
			$('#jenis_report').prop('disabled', false)

			var result = $(this).attr("data-id");
			// console.log(result)
			$('#jenis_report').val(result.trim());

			event.preventDefault();
			$('#viewname').val();
			$('#reportname').val();
			$('#reportlocation').val();
			var nmrp = $('#jenis_report').val();
			var gruplogin = $('#gruplogin').val();
			// console.log(gruplogin);
			// cek Apakah report menggunakan inputan tgl
			if (cekstatustanggal($('#jenis_report').val(), gruplogin) == true) {
				$("#cetak").css('visibility', 'visible');
				if ($('#jenis_report').val() == 'History Spareparts') {
					$("#tanggalinput").css('visibility', 'visible');
					$("#grup_part").css('visibility', 'visible');
					$("#bulanan").css('visibility', 'hidden');
					$("#grup_customer").css('visibility', 'hidden');
				} else if ($('#jenis_report').val() == 'Laporan Outstanding AR' || $('#jenis_report').val() == 'Laporan Outstanding AP') {
					$("#tanggalinput").css('visibility', 'hidden');
					$("#grup_part").css('visibility', 'hidden');
					$("#bulanan").css('visibility', 'hidden');
					// $("#cetak").css('visibility', 'hidden');
					$("#grup_customer").css('visibility', 'hidden');
				} else if ($('#jenis_report').val() == 'Kartu Piutang Customer') {
					$("#tanggalinput").css('visibility', 'hidden');
					$("#grup_part").css('visibility', 'hidden');
					$("#bulanan").css('visibility', 'hidden');
					// $("#cetak").css('visibility', 'hidden');
					$("#grup_customer").css('visibility', 'visible');
				} else {
					$("#tanggalinput").css('visibility', 'visible');
					$("#grup_part").css('visibility', 'hidden');
					$("#bulanan").css('visibility', 'hidden');
					$("#grup_customer").css('visibility', 'hidden');
				}
			} else if (cekstatustanggal($('#jenis_report').val(), gruplogin) == false) {
				$("#tanggalinput").css('visibility', 'hidden');
				$("#grup_part").css('visibility', 'hidden');
				$("#bulanan").css('visibility', 'visible');
				$("#grup_customer").css('visibility', 'hidden');
			}
		});

		// ---------- ON LOOKUP PARTS ------------------------------------
		document.getElementById("cariparts").addEventListener("click", function(event) {
			event.preventDefault();
			$('#tablesearchparts').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": false,
				"order": [],
				"ajax": {
					"url": "<?php echo base_url('spk/entry_spk/CariDataParts'); ?>",
					"method": "POST",
					"data": {
						nmtb: "glbm_parts",
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

		$(document).on('click', ".searchparts", function() {
			var result = $(this).attr("data-id");
			$('#kode_part').val(result.trim());
			// DataParts(result.trim());
		});

		//------------------lookup customer---------------------------------------

		document.getElementById("caricustomer").addEventListener("click", function(event) {
			event.preventDefault();
			var kode_cabang = $('#scabang').val();
			var kodecompany = $('#kodecompany').val();
			var kodegrup = $('#kodegrupcabang').val();
			$('#tablesearchcustomer').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": false,
				"order": [],
				"ajax": {
					"url": "<?php echo base_url('spk/entry_datakendaraan/CariDataCustomer'); ?>",
					"method": "POST",
					"data": {
						nmtb: "glbm_customer",
						field: {
							nomor: "nomor",
							nama: "nama"
						},
						sort: "nomor",
						where: {
							nomor: "nomor",
							nama: "nama"
						},
						value: "aktif = true and kodecompany = '" + kodecompany + "' and (kodecabang = '" + kode_cabang + "' or kodecabang in (select kode from glbm_cabang where kodegrup = '" + kodegrup + "'))"
					},
				}
			});
		}, false);

		$(document).on('click', ".searchcustomer", function() {
			var result = $(this).attr("data-id");
			$('#kodecustomer').val(result.trim());
			// DataParts(result.trim());
		});

		document.getElementById("cetak").addEventListener("click", function(event) {
			var tglmulai = $('#tglmulai').val();
			var tglakhir = $('#tglakhir').val();
			var jenis = $('#jenis_report').val();
			var kodepart = $('#kode_part').val();
			var nomorcustomer = $('#kodecustomer').val();
			var kodecabang = $('#scabang').val();
			var kodesubcabang = $('#subcabang').val();
			var kodecompany = $('#kodecompany').val();

			var viewname = $('#viewname').val();
			var reportname = $('#reportname').val();
			var filereport = $('#filereport').val();
			var reportlocation = $('#reportlocation').val();
			var kodecabang = $('#scabang').val();

			var bulan = $('#bulan').val();

			let data = {
				"tglmulai": tglmulai,
				"tglakhir": tglakhir,
				"jenis": jenis,
				"kodepart": kodepart,
				"nomorcustomer": nomorcustomer,
				"viewname": viewname,
				"reportname": reportname,
				"filereport": filereport,
				"reportlocation": reportlocation,
				"kodecabang": kodecabang,
				"kodesubcabang": kodesubcabang,
				"kodecompany": kodecompany,
			}
			// console.log(data)

			if (status == true && jenis == 'History Spareparts') {
				if (kodepart == "") {
					$.alert({
						title: 'Info..',
						content: 'Silahkan Pilih Kode Part Terlebih Dahulu',
						buttons: {
							formSubmit: {
								text: 'OK',
								btnClass: 'btn-red'
							}
						}
					});
					$('#kode_part').focus();
					var result = false;
				} else {
					window.open(
						"<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + kodepart + ":" + tglmulai + ":" + tglakhir
					);
				}
			} else if (status == true && jenis == 'Kartu Piutang Customer') {
				if (nomorcustomer == "") {
					$.alert({
						title: 'Info..',
						content: 'Silahkan Pilih Nomor Customer Terlebih Dahulu',
						buttons: {
							formSubmit: {
								text: 'OK',
								btnClass: 'btn-red'
							}
						}
					});
					$('#kodecustomer').focus();
					var result = false;
				} else {
					window.open(
						"<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + nomorcustomer
					);
				}
			} else if (status == true) {
				if (reportlocation == 'report/report_periodetgl') {
					window.open(
						"<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + tglmulai + ":" + tglakhir + ":" + kodesubcabang + "/" + filereport
					);
				} else {
					window.open(
						"<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + tglmulai + ":" + tglakhir
					);
				}
			} else if (status == false) {
				window.open(
					"<?php echo base_url('form/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + bulan
				);
				// } else if (status == false) {
				//     $.alert({
				//         title: 'Info..',
				//         content: 'Silahkan Pilih Jenis Report Terlebih Dahulu',
				//         buttons: {
				//             formSubmit: {
				//                 text: 'OK',
				//                 btnClass: 'btn-red'
				//             }
				//         }
				//     });
				//     $('#jenis_report').focus();
				//     var result = false;
			};
		});

		document.getElementById("excel").addEventListener("click", function(event) {
			var tglmulai = $('#tglmulai').val();
			var tglakhir = $('#tglakhir').val();
			var jenis = $('#jenis_report').val();
			var kodepart = $('#kode_part').val();
			var kodecabang = $('#scabang').val();
			var kodesubcabang = $('#subcabang').val();
			var kodecompany = $('#kodecompany').val();

			var nomorcustomer = $('#kodecustomer').val();
			var viewname = $('#viewname').val();
			var reportname = $('#reportname').val();
			var filereport = $('#filereport').val();
			var reportlocation = $('#reportlocation').val();
			var kodecabang = $('#scabang').val();
			var bulan = $('#bulan').val();
			if (status == true && jenis == 'History Spareparts') {
				if (kodepart == "") {
					$.alert({
						title: 'Info..',
						content: 'Silahkan Pilih Kode Part Terlebih Dahulu',
						buttons: {
							formSubmit: {
								text: 'OK',
								btnClass: 'btn-red'
							}
						}
					});
					$('#kode_part').focus();
					var result = false;
				} else {
					window.open(
						"<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + kodepart + ":" + tglmulai + ":" + tglakhir
					);
				}
			} else if (status == true && jenis == 'Kartu Piutang Customer') {
				if (nomorcustomer == "") {
					$.alert({
						title: 'Info..',
						content: 'Silahkan Pilih Nomor Customer Terlebih Dahulu',
						buttons: {
							formSubmit: {
								text: 'OK',
								btnClass: 'btn-red'
							}
						}
					});
					$('#kodecustomer').focus();
					var result = false;
				} else {
					window.open(
						"<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + nomorcustomer
					);
				}
			} else if (status == true) {
				if (reportlocation == 'report/report_periodetgl') {
					window.open(
						"<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + tglmulai + ":" + tglakhir + ":" + kodesubcabang + "/" + filereport
					);
				} else {
					window.open(
						"<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + tglmulai + ":" + tglakhir
					); 
				}
			} else if (status == false) {
				window.open(
					"<?php echo base_url('export_excel/') ?>" + reportlocation + "/" + viewname + ":" + reportname + ":" + filereport + ":" + kodecabang + ":" + kodecompany + ":" + bulan
				);
				// $.alert({
				//     title: 'Info..',
				//     content: 'Silahkan Pilih Jenis Report Terlebih Dahulu',
				//     buttons: {
				//         formSubmit: {
				//             text: 'OK',
				//             btnClass: 'btn-red'
				//         }
				//     }
				// });
				// $('#jenis_report').focus();
				// var result = false;
			};
		});
	});
</script>
