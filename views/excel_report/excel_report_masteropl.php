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
            <th style="width: 100px; font-weight: bold;">Kode OPL</th>
            <th style="width: 100px; font-weight: bold;">Nama OPL</th>
            <th style="width: 100px; font-weight: bold;">Harga Beli</th>
            <th style="width: 100px; font-weight: bold;">Harga Jual</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($masteropl as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: left;">
                    <?php echo $row->kode ?>
                </td>
                <td style="text-align: left;">
                    <?php echo $row->nama ?>
                </td>
                <td style="text-align: right;">
                    <?php echo $row->hargabeli ?>
                </td>
                <td style="text-align: right;">
                    <?php echo $row->hargajual ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>