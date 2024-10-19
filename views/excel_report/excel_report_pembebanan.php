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
            <th colspan="6"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="6">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="6"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">No Pembebanan</th>
            <th style="width: 100px; font-weight: bold;">Tanggal</th>
            <th style="width: 100px; font-weight: bold;">No WO</th>
            <th style="width: 100px; font-weight: bold;">No Polisi</th>
            <th style="width: 100px; font-weight: bold;">Customer</th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kategori</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kode Part</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Part</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga Satuan</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Total</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Total Cogs/Hargabeli</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status WO</span>
            </th>
        </tr>
    </thead>

    <?php $no = 1;
    foreach ($report_pembebanan as $row) : ?>
        <tbody>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor ?>
                </td>

                <td style="text-align: center;">
                    <!-- <//?php echo date('d-m-Y', strtotime($row->tanggal)) ?> -->
                    <?php echo $row->tanggal ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomorwo ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nopolisi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama ?>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->kategori ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->kodepart ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->namapart ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->qty ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->hargasatuan) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogs * $row->qty) ?></span>
                </td>
                
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo ($row->statuswo) ?></span>
                </td>
            </tr>
        </tbody>
    <?php endforeach ?>

</table>