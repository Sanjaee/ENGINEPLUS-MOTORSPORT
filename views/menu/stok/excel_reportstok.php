<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

    <thead>

        <tr>

            <th>No</th>
            <th>Kode Cabang</th>
            <th>Nama Cabang</th>
            <th>Kode Part</th>
            <th>Nama</th>
            <th>Sisa Stock</th>

        </tr>

    </thead>

    <tbody>

        <?php $i = 1;
        foreach ($buku  as $buku) { ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $buku->kode_cabang; ?></td>
                <td><?php echo $buku->namacabang; ?></td>
                <td><?php echo $buku->kodepart; ?></td>
                <td><?php echo $buku->namapart; ?></td>
                <td><?php echo $buku->qtyakhir; ?></td>
            </tr>

        <?php $i++;
        } ?>

    </tbody>

</table>