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

<table width="100%" style="border-radius: 4px; margin-top: 5px; border: thin solid grey;">
    <tbody>
        <tr style="background-color: rgba(242, 242, 242, 0.74);">
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Order</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Alamat</span>
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
                <span style="font-weight: bold">DPP</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">PPN</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kode Parts</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Parts</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">% Disc</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Discount/Item</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Subtotal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Down Payment</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Detail</span>
            </th>
        </tr>

        <?php $no = 1;
        foreach ($report_order as $row) : ?>
            <tr style="line-height: 1 em; ">
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama_customer ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->alamat_customer ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tipejualdesc ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->notelp ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nohp ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->dpp) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->ppn) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->kode_parts ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namapart ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qty ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->persendiscperitem ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->discountperitem) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>
                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->jenisdetaildesc ?></span>
                </td>
            </tr>
    </tbody>

<?php endforeach ?>

</table>