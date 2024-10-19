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
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nomor OPL</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Supplier</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Polisi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kategori Jasa Part</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Kode Referensi</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Referensi</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">% Discount</span>
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
                <span style="font-weight: bold">Total</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">COGS</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Margin</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Invoice</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Invoice</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Bayar</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl Lunas</span>
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
                    <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->namasupplier ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nomor_wo ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nama ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->kategori ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->kode_pekerjaan ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nama_pekerjaan ?></span>
                </td>

                <td style="text-align: left; ">
                    <span style="font-weight: normal"><?php echo $row->jenis ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->qty ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->persendiscperitem ?>%</span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->discperitem) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->dpp) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->ppn) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogs) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->margin) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->statuswo) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->statusinv) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->nofaktur) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->statusbayar) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->tgllunas) ?></span>
                </td>
            </tr>
        </tbody>
    <?php endforeach ?>

</table>