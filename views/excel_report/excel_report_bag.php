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
            <th colspan="9"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="9">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">No BAG</th>
            <th style="width: 100px; font-weight: bold;">Tanggal</th>
            <th style="width: 100px; font-weight: bold;">Jenis</th>
            <th style="width: 100px; font-weight: bold;">Keterangan</th>
            <th style="width: 100px; font-weight: bold;">Kode Parts</th>
            <th style="width: 100px; font-weight: bold;">Nama Parts</th>
            <th style="width: 100px; font-weight: bold;">Qty</th>
            <th style="width: 100px; font-weight: bold;">COGS</th>
            <th style="width: 100px; font-weight: bold;">Total COGS</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1;
        foreach ($report_faktur as $row) : ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->tanggal ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->jenis ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->keterangan ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kodepart ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->namapart ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->qty ?>
                </td>
                <td style="text-align: center;">
                    <?php echo rupiah($row->cogs) ?>
                </td><td style="text-align: center;">
                    <?php echo rupiah($row->cogs * $row->qty) ?>
                </td>
            </tr>
        <?php endforeach ?>

        <!-- <thead>
            <tr>
                <th colspan="17" style="text-align: right; font-weight: bold;">Grand Total Faktur</th>
                <?php foreach ($totalsum as $row) : ?>
                    <td style="font-weight: bold; text-align: right;"><?php echo $row->totalfaktur ?></td>
                <?php endforeach ?>
            </tr>
        </thead> -->

</table>