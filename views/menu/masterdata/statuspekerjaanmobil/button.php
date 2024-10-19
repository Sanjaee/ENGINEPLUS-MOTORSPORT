<script type="text/javascript">
	$(document).ready(function() {
		$('#kode').val('SP0000')
		$('#tablesearchtampil').css('visibility', 'hidden');
		$('#tablesearchreport').css('visibility', 'hidden');
        $("#aktif").prop("checked", true);
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
			$('#kode').prop('disabled', true);
			$('#save').prop('disabled', true);
			$('#update').prop('disabled', false);

		}
		// -- SAVE --
		document.getElementById("save").addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var nama = $('#nama').val();
            var aktif = $("input[name='aktif']:checked").val();
			if (CekValidasi() == true) {
				$.ajax({
					url: "<?php echo base_url('masterdata/statuspekerjaanmobil/save'); ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode,
						nama,
						aktif,
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
		document.getElementById("find").addEventListener("click", function(event) {
			$('#tablesearchtampil').css('visibility', 'visible');
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
					"url": "<?php echo base_url('caridata/cariprojectmanager'); ?>",
					"method": "POST",
					"data": {
						nmtb: "glbm_statuspekerjaanmobil",
						field: {
							kode: "kode",
							nama: "nama"
						},
						sort: "kode",
						where: {
							kode: "kode"
						},
						value: "kode=kode"
					},

				},
				"order": [],
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
				url: "<?php echo base_url('masterdata/statuspekerjaanmobil/find'); ?>",
				method: "POST",
				dataType: "json",
				async: true,
				data: {
					kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kode').val(data[i].kode.trim());
						$('#nama').val(data[i].nama.trim());
						$('#save').prop('disabled', true);
						$('#update').prop('disabled', false);

						if (data[i].aktif == 't') {
							$('input:radio[name="aktif"][value="true"]').prop('checked', true);
						} else {
							$('input:radio[name="aktif"][value="false"]').prop('checked', true);
						}

					}
				}
			});
			$('#tablesearchtampil').css('visibility', 'hidden');
		});
		// -- END FIND --


		// -- UPDATE --
		document.getElementById("update").addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var nama = $('#nama').val();
            var aktif = $("input[name='aktif']:checked").val();

			if (CekValidasi() == true) {
				$.ajax({
					url: "<?php echo base_url('masterdata/statuspekerjaanmobil/update'); ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode,
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
