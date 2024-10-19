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
            <th colspan="7"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="7">Periode tanggal <?php echo $tglmulai ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="7"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">

    <tbody>
        <tr style="background-color: rgba(242, 242, 242, 0.74); ">
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Kode Part</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Part</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Awal</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Rupiah</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Beli</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Rupiah</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Jual</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Rupiah</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Retur Jual</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Rupiah</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Retur Beli</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Rupiah</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Opname</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Rupiah</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Akhir</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Price Varian</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Total</span>
            </th>
        </tr>

        <?php $no = 1;
        foreach ($report_rekapitulasistockpart as $row) : ?>

            <tr style="line-height: 1 em; ">
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->kode_parts ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama_parts ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qtyawal ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total_awal) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qty_pembelian ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total_pembelian) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qtypenjualan ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total_penjualan) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qty_returpenjualan ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total_returpenjualan) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qty_returpembelian ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total_returpembelian) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qty_opname ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total_opname) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qty_akhir ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->pricevariance - $row->price_variancesales) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total_akhir) ?></span>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>