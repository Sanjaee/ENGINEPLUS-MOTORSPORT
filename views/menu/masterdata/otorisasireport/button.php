<script type="text/javascript">
	$(document).ready(function() {
		$('#tablesearchtampil').css('visibility', 'hidden');
		$('#tablesearchreport').css('visibility', 'hidden');
		//disable tombol update
		$('#update').prop('disabled', true);
		$("#aktif").prop("checked", true);

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
				$('#kode').focus();
				var result = false;
			} else {
				var result = true;
			}
			return result;
		};

		function FindData() {
			document.getElementById('nama').disabled = true;
			$('#save').prop('disabled', true);
			$('#update').prop('disabled', false);

		}
		// -- SAVE --
		document.getElementById("save").addEventListener("click", function(event) {
			event.preventDefault();
			var nama = $('#nama').val();
			var aktif = $("input[name='aktif']:checked").val();
			if (CekValidasi() == true) {
				$.ajax({
					url: "<?php echo base_url('masterdata/jenis_report/save'); ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						nama: nama,
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
		document.getElementById("carireport").addEventListener("click", function(event) {
			$('#tablesearchreport').css('visibility', 'visible');
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
					"url": "<?php echo base_url('caridata/carireport'); ?>",
					"method": "POST",
					"data": {
						nmtb: "stpm_report",
						field: {
							nama_report: "nama_report",
							grup: "grup",
							aktif: "aktif",
						},
						sort: "nama_report",
						where: {
							nana_report: "nama_report"
						},
						value: "aktif=true and grup != 'empty'"
					},

				},
				"order": [],
			});
		}, false);


		// $(document).on('click', ".searchok", function() {
		// 	var result = $(this).attr("data-id");
		// 	var jenis = result.trim();
		// 	console.log(jenis)
		// 	$.ajax({
		// 		url: "<?php echo base_url('masterdata/jenis_report/getreport'); ?>",
		// 		method: "POST",
		// 		dataType: "json",
		// 		async: true,
		// 		data: {
		// 			jenis
		// 		},
		// 		success: function(data) {
		// 			for (var i = 0; i < data.length; i++) {
		// 				$('#id_jenis').val(data[i].id.trim());
		// 				$('#nama').val(data[i].jenis.trim());
		// 				$('#save').prop('disabled', true);
		// 				$('#update').prop('disabled', false);

		// 				if (data[i].aktif == 't') {
		// 					$('input:radio[name="aktif"][value="true"]').prop('checked', true);
		// 				} else {
		// 					$('input:radio[name="aktif"][value="false"]').prop('checked', true);
		// 				}

		// 			}
		// 		}
		// 	});
		// });

		$(document).on('click', ".searchok", function() {
			var result = $(this).attr("data-id");
			var nomor = result.trim();
			console.log(nomor)
			$.ajax({
				url: "<?php echo base_url('masterdata/jenis_report/getreport'); ?>",
				method: "POST",
				dataType: "json",
				async: true,
				data: {
					nomor: nomor
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {

					}
				}
			}, false);
		});
		// -- END FIND --


		// -- UPDATE --
		document.getElementById("update").addEventListener("click", function(event) {
			event.preventDefault();
			let id_jenis = $('#id_jenis').val()
			var nama = $('#nama').val();
			var aktif = $("input[name='aktif']:checked").val();

			if (CekValidasi() == true) {
				$.ajax({
					url: "<?php echo base_url('masterdata/jenis_report/update'); ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						id_jenis,
						nama,
						aktif
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
