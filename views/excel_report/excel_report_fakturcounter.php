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
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">No Faktur</th>            
            <th style="width: 100px; font-weight: bold;">Tgl Faktur</th>
            <th style="width: 100px; font-weight: bold;">No Order</th>
            <th style="width: 100px; font-weight: bold;">Tgl Order</th>
            <th style="width: 100px; font-weight: bold;">No Polisi</th>
            <th style="width: 100px; font-weight: bold;">Customer</th>
            <th style="width: 100px; font-weight: bold;">Kategori Part</th>
            <th style="width: 100px; font-weight: bold;">Jenis Detail</th>
            <th style="width: 100px; font-weight: bold;">Tipe Penjualan</th>
            <th style="width: 100px; font-weight: bold;">No Telp</th>
            <th style="width: 100px; font-weight: bold;">No HP</th>
            <th style="width: 150px; font-weight: bold;">DPP</th>
            <th style="width: 150px; font-weight: bold;">PPN</th>
            <th style="width: 150px; font-weight: bold;">ongkir</th>
            <th style="width: 150px; font-weight: bold;">Total</th>
            <th style="width: 100px; font-weight: bold;">Keterangan</th>
            <th style="width: 100px; font-weight: bold;">Kode Parts</th>
            <th style="width: 100px; font-weight: bold;">Nama Parts</th>
            <th style="width: 100px; font-weight: bold;">Qty</th>
            <th style="width: 100px; font-weight: bold;">Harga</th>
            <th style="width: 100px; font-weight: bold;">% Disc</th>
            <th style="width: 150px; font-weight: bold;">Discount/Item</th>
            <th style="width: 150px; font-weight: bold;">Subtotal</th>
            <th style="width: 150px; font-weight: bold;">COGS</th>
            <th style="width: 150px; font-weight: bold;">Margin</th>
            <th style="width: 150px; font-weight: bold;">Down Payment</th>
            <th style="width: 150px; font-weight: bold;">Status Pembayaran</th>
            <th style="width: 150px; font-weight: bold;">Tgl Lunas</th>
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
                    <!-- <//?php echo date('d-m-Y', strtotime($row->tanggal)) ?> -->
                    <?php echo $row->tanggal ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor_order ?>
                </td>
                
                <td style="text-align: center;">
                    <!-- <//?php echo date('d-m-Y', strtotime($row->tanggal)) ?> -->
                    <?php echo $row->tglorder ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nopolisi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama_customer ?>
                </td>
                <td style="text-align: center;">
                    <span style="font-weight: normal"><?php echo $row->kategorips ?></span>
                </td>
                <td style="text-align: center;">
                    <span style="font-weight: normal"><?php echo $row->jenisdetail ?></span>
                </td>
                <td style="text-align: center;">
                    <span style="font-weight: normal"><?php echo $row->tipejual ?></span>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->notelp ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nohp ?>
                </td>
                <td style="text-align: center;">
                    <?php echo rupiah($row->dpp) ?>
                </td>
                <td style="text-align: center;">
                    <?php echo rupiah($row->ppn) ?>
                </td>
                <td style="text-align: right;">
                    <span style="font-weight: normal"><?php echo rupiah($row->ongkir) ?></span>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->total ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->keterangan ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kode_parts ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->namapart ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->qty ?>
                </td>
                <td style="text-align: center;">
                    <?php echo rupiah($row->harga) ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->persendiscperitem ?>%
                </td>
                <td style="text-align: center;">
                    <?php echo rupiah($row->discountperitem) ?>
                </td>
                <td style="text-align: right;">
                    <?php echo rupiah($row->subtotal) ?>
                </td>
                <td style="text-align: right;">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogs) ?></span>
                </td>
                <td style="text-align: right;">
                    <span style="font-weight: normal"><?php echo rupiah($row->margin) ?></span>
                </td>
                <td style="text-align: right;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>
                <td style="text-align: right;">
                    <span style="font-weight: normal"><?php echo $row->statusbayar ?></span>
                </td>
                <td style="text-align: right;">
                    <span style="font-weight: normal"><?php echo $row->tgllunas ?></span>
                </td>
            </tr>
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