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
            <th colspan="18"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="18">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Faktur</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal Faktur</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Order</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal Order</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nopolisi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">ID Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tipe Penjualan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Telp</span>
            </th>
            <th style="text-align: center; ;">
                <span style="font-weight: bold">No HP</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Discount</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">DPP</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">PPN</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Ongkir</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Grandtotal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">COGS</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Margin</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Down Payment</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Pelunasan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Sisa Piutang</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Pembayaran</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl Lunas</span>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1;
        foreach ($report_faktur as $row) : ?>
            <tr>
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nofaktur ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->noorder ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tglorder ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nomor_customer ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama_customer ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tipejual ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->notelp ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nohp ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->totalpart ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->totaldisc ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->dpp) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->ppn) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->ongkir) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogs) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->margin) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>
                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaipenerimaan) ?></span>
                </td>
                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaipiutang) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statusbayar ?></span>
                </td>
                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tgllunas ?></span>
                </td>
            </tr>
        <?php endforeach ?>

</table>