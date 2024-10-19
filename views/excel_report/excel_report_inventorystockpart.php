<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<style>
    .str{ mso-number-format:\@; } 
</style>

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
            <th colspan="8"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="8">Periode : <?php echo $tglmulai ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="8"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">

    <tbody>
        <tr style="background-color: rgba(242, 242, 242, 0.74);">
            <th>No.</th>
            <th style="width: 100px;">Kode Barang</th>
            <th style="width: 150px;">Nama Barang</th>
            <th style="width: 150px;">Kategori Workshop</th>
            <th style="width: 150px;">Kategori Partshop</th>
            <th style="width: 100px;">Satuan</th>
            <th style="width: 100px;">Lokasi</th>
            <th style="width: 100px;">Qty Stock</th>
            <th style="width: 100px;">Nilai</th>
            <th style="width: 100px;">Harga Beli</th>
            <th style="width: 100px;">Harga Jual</th>
            <th style="width: 100px;">Total Ammount</th>
        </tr>

        <?php $no = 1;
        foreach ($report_inventorystockpart as $row) : ?>

            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td class="str" style="text-align: center;">
                    <?php echo $row->kodepart ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kategoripart ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kategorips ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->satuanparts ?>
                </td>
                
                <td style="text-align: center;">
                    <?php echo $row->lokasi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->qty ?>
                </td>
                <td style="text-align: right;">
                    <?php echo rupiah($row->harga) ?>
                </td>
                <td style="text-align: right;">
                    <?php echo rupiah($row->hargabeli) ?>
                </td>
                <td style="text-align: right;">
                    <?php echo rupiah($row->hargajual) ?>
                </td>
                <td style="text-align: right;">
                    <?php echo rupiah($row->subtotal) ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>