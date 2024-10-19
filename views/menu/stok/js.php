<script type="text/javascript">
    $(document).ready(function() {

        function BersihkanLayar() {
            location.reload(true);
        };

        // -- Cari VA --
        document.getElementById("cetak").addEventListener("click", function(event) {
            event.preventDefault();
            // alert("hehe");
            var parts = $('#kodepart').val();
            var kodecompany = $('#kodecompany').val();
            var today = new Date();
            var b = (today.getMonth() + 1).toString()
            if (b.length < 2) {
                var t = today.getFullYear().toString() + '0' + b;
            } else {
                var t = today.getFullYear().toString() + '' + b;
            }
            console.log(t);
            $('#datastok').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "pageLength": 100,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('form/reportstok/datastok'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "report_stoksparepart",
                        field: {
                            periode: "periode",
                            // tanggal: "DateBilling",
                            kode_cabang: "kode_cabang",
                            namacabang: "namacabang",
                            kodepart: "kodepart",
                            namapart: "namapart",
                            hargajual: "hargajual",
                            qtyakhir: "qtyakhir"
                            // sisa : ""
                        },
                        sort: "periode",
                        where: {
                            // id: "id",
                            periode: "periode",
                            kodepart: "kodepart",
                            namapart: "namapart"
                        },
                        value: "periode = '" + t + "' and kodecompany = '" + kodecompany + "' and kodepart = '" + parts + "'"
                    },
                }
            });
        }, false);

        function parts(params) {
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $.ajax({
                url: "<?php echo base_url('form/reportstok/GetDataParts'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    kode: params,kodecompany:kodecompany
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodepart').val(data[i].kode.trim());
                        $('#namapart').val(data[i].nama.trim());

                    }
                }
            });
        };

        document.getElementById("caripart").addEventListener("click", function(event) {
            event.preventDefault();
            var kode_cabang = $('#scabang').val();
            var kodecompany = $('#kodecompany').val();
            $('#tablesearchpart').DataTable({
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
                    "url": "<?php echo base_url('spk/entry_spk/CariDataParts'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_parts",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            kodecabang: "kodecabang"

                        },
                        sort: "kode",
                        where: {
                            kode: "kode",nama: "nama",kodecabang: "kodecabang"
                        },
                        value: "aktif = true and kodecompany = '"+kodecompany+"'"
                    },
                }
            });
        }, false);

        $(document).on('click', ".searchparts", function() {
            var result = $(this).attr("data-id");
            // $('#noaccount').val(result.trim());
            parts(result.trim());
        });
        // END StokSparepart





    });
</script>