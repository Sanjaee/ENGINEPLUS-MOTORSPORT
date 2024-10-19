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

<style>
    .str {
        mso-number-format: \@;
    }
</style>
<table width="100%">
    <thead>
        <tr>
            <th colspan="14"><?php echo $title ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="14"></th>
        </tr>
    </tbody>

</table>
<table width="100%" style="margin-top: 5px; ">
    <tbody style="border: thin solid grey; border-radius: 4px;">
        <tr style="background-color: rgba(242, 242, 242, 0.74); ">
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Transaksi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nomor</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Supplier</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Order</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nilai</span>
            </th>
        </tr>

        <?php $no = 1;
        foreach ($report_spk as $row) : ?>

            <tr style="line-height: 0.5 cm; ">
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->jenis ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namasupplier ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nomororder ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>