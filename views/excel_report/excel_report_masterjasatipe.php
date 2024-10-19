<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<?php
function rupiah($angka)
{
    $hasil_rupiah = number_format($angka, 0, '.', ',');
    return $hasil_rupiah;
}
?>

<table width="100%">
    <thead>
        <tr>
            <th colspan="10"><?php echo $title ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="10"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">Kode Tipe</th>
            <th style="width: 100px; font-weight: bold;">Nama Tipe</th>
            <th style="width: 100px; font-weight: bold;">Kode Jasa</th>
            <th style="width: 100px; font-weight: bold;">Nama Jasa</th>
            <th style="width: 100px; font-weight: bold;">Jam</th>
            <th style="width: 100px; font-weight: bold;">FRT</th>
            <th style="width: 100px; font-weight: bold;">Harga</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($masterjasatipe as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: left;">
                    <?php echo $row->kodeproduct ?>
                </td>
                <td style="text-align: left;">
                    <?php echo $row->namamodel ?>
                </td>
                <td style="text-align: left;">
                    <?php echo $row->kodejasa ?>
                </td>
                <td style="text-align: left;">
                    <?php echo $row->namajasa ?>
                </td>
                <td style="text-align: right;">
                    <?php echo $row->jam ?>
                </td>
                <td style="text-align: right;">
                    <?php echo $row->frt ?>
                </td>
                <td style="text-align: right;">
                    <?php echo $row->harga ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>