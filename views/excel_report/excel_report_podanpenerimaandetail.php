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
        <tr style="background-color: rgba(242, 242, 242, 0.74);">
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nomor PO</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl PO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Keterangan PO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Supplier</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kode Part</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Part</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Order</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga Order</span>
            </th>
            <th style="text-align: center; ;">
                <span style="font-weight: bold">Total Order</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Penerimaan</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl Penerimaan</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Outstanding</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty Terima</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga Terima</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Disc Terima</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Persen Disc Terima</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total Terima</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Invoice</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status invoice</span>
            </th>   
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Bayar</span>
            </th>                
        </tr>
    </thead>
    <?php $no = 1;
    foreach ($report_faktur as $row) : ?>


        <tbody>
            <tr style="line-height: 1 em; ">
                <td style="width: 30px; text-align: center; ">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->noorder ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->namasupplier ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo ($row->kodepart) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo ($row->nama)   ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo ($row->qtyorder) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nopenerimaan ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->tglterima) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->qtyost) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->qtyterima) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->hargaterima) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->discterima) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->persenterima) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->totalterima) ?></span>
                </td>                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->noinvoice) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->statusiv) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->statusbayar) ?></span>
                </td>
            </tr>
        </tbody>
    <?php endforeach ?>

</table>