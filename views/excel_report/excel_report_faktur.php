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
            <th colspan="14"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="14">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="14"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">No Faktur</th>
            <th style="width: 100px; font-weight: bold;">Tgl Faktur</th>
            <th style="width: 100px; font-weight: bold;">No WO</th>
            <th style="width: 100px; font-weight: bold;">Tgl WO</th>
            <th style="width: 100px; font-weight: bold;">No Polisi</th>
            <th style="width: 100px; font-weight: bold;">ID Customer</th>
            <th style="width: 100px; font-weight: bold;">Customer</th>
            <th style="width: 100px; font-weight: bold;">Tipe</th>
            <th style="width: 100px; font-weight: bold;">Jenis Service</th>
            <th style="width: 100px; font-weight: bold;">Keterangan</th>
            <th style="width: 100px; font-weight: bold;">Mekanik</th>
            <th style="width: 100px; font-weight: bold;">Foreman</th>
            <th style="width: 100px; font-weight: bold;">Total Jasa</th>
            <th style="width: 100px; font-weight: bold;">Discount Jasa</th>
            <th style="width: 100px; font-weight: bold;">DPP Jasa</th>
            <th style="width: 100px; font-weight: bold;">Total OPL</th>
            <th style="width: 100px; font-weight: bold;">Discount OPL</th>
            <th style="width: 100px; font-weight: bold;">DPP OPL</th>
            <th style="width: 100px; font-weight: bold;">Total Part</th>
            <th style="width: 100px; font-weight: bold;">Discount Part</th>
            <th style="width: 100px; font-weight: bold;">DPP Part</th>
            <th style="width: 150px; font-weight: bold;">DPP Jasa Part</th>
            <th style="width: 150px; font-weight: bold;">PPN</th>
            <th style="width: 150px; font-weight: bold;">Total Jasa Part</th>
            <th style="width: 150px; font-weight: bold;">COGS Part</th>
            <th style="width: 150px; font-weight: bold;">COGS OPL</th>
            <th style="width: 150px; font-weight: bold;">Margin</th>
            <th style="width: 150px; font-weight: bold;">DP</th>
            <th style="width: 150px; font-weight: bold;">Pelunasan</th>
            <th style="width: 150px; font-weight: bold;">Sisa AR</th>
            <th style="width: 150px; font-weight: bold;">Status</th>
            <th style="width: 150px; font-weight: bold;">Tgl Lunas</th>
            <th style="width: 150px; font-weight: bold;">SA</th>
            <th style="width: 150px; font-weight: bold;">Project Manager</th>
            <th style="width: 150px; font-weight: bold;">Jenis Customer</th>
        </tr>
    </thead>
    <?php $no = 1;
    foreach ($report_faktur as $row) : ?>


        <tbody>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nofaktur ?>
                </td>
                <td style="text-align: center;">
                    <!-- <//?php echo date('d-m-Y', strtotime($row->tanggal)) ?> -->
                    <?php echo $row->tanggal ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nospk ?>
                </td>
                <td style="text-align: center;">
                    <!-- <//?php echo date('d-m-Y', strtotime($row->tanggal)) ?> -->
                    <?php echo $row->tglwo ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nopolisi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nocustomer ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->customer ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->tipe ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->jenisservice ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->keterangan ?>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nama_teknisi ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nama_foreman ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->totaljasa + $row->discountjasa) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->discountjasa) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->totaljasa) ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalopl + $row->discountopl) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->discountopl) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalopl) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalpart + $row->discountpart) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->discountpart) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalpart) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->dpp) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->ppn) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaifaktur) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogspart) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogsopl) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->dpp - ($row->cogsopl + $row->cogspart)) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaipenerimaan) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaipiutang) ?></span>
                </td>
                <td style="text-align: left; ">
                    <span style="font-weight: normal"><?php echo ($row->statusbayar) ?></span>
                </td>
                <td style="text-align: left; ">
                    <span style="font-weight: normal"><?php echo ($row->tgllunas) ?></span>
                </td>
                <td style="text-align: left; ">
                    <span style="font-weight: normal"><?php echo ($row->pemakai) ?></span>
                </td>
                <td style="text-align: left; ">
                    <span style="font-weight: normal"><?php echo ($row->projectmanager) ?></span>
                </td>
                <td style="text-align: left; ">
                    <span style="font-weight: normal"><?php echo ($row->jeniscustomer) ?></span>
                </td>
            </tr>
        </tbody>
    <?php endforeach ?>

    <thead>
        <tr>
            <th colspan="17" style="text-align: right; font-weight: bold;">Grand Total Faktur</th>
            <?php foreach ($totalsum as $row) : ?>
                <td style="font-weight: bold; text-align: right;"><?php echo $row->totalfaktur ?></td>
            <?php endforeach ?>
        </tr>
    </thead>

</table>