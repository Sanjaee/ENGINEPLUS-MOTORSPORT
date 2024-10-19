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
            <th colspan="12"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="12">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="12"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">Jenis Transaksi</th>
            <th style="width: 100px; font-weight: bold;">Nomor</th>
            <th style="width: 100px; font-weight: bold;">Tanggal</th>
            <th style="width: 100px; font-weight: bold;">Nomor Referensi</th>
            <th style="width: 100px; font-weight: bold;">Kode Part</th>
            <th style="width: 100px; font-weight: bold;">Nama Part</th>
            <th style="width: 150px; font-weight: bold;">Qty</th>
            <th style="width: 150px; font-weight: bold;">Harga</th>
            <th style="width: 150px; font-weight: bold;">Disc</th>
            <th style="width: 150px; font-weight: bold;">Subtotal</th>
            <th style="width: 150px; font-weight: bold;">No Invoice</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($history_sparepart as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->jenistransaksi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor ?>
                </td>
                <td style="text-align: center;">
                    <!-- <//?php echo date('d-m-Y', strtotime($row->tanggal)) ?> -->
                    <?php echo $row->tanggal ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor_referensi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kodepart ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->qty ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->harga ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->discountperitem ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->subtotal ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->noinvoice ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

    <thead>
        <tr>
            <th colspan="11" style="text-align: right; font-weight: bold;">Total Stock Part</th>
            <?php foreach ($totalsum as $row) :?>
                <td style="font-weight: bold; text-align: right;"><?php echo $row->totalqty ?> Pcs</td>
            <?php endforeach ?>
        </tr>
    </thead>

</table>