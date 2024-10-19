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

<style> .str{ mso-number-format:\@; } </style>
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
                <span style="font-weight: bold">Nama Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Polisi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tipe</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Mobil</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Faktur</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl Faktur</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">PM</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total Jasa</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total Parts</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nilai Piutang</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nilai Pelunasan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nilai DP</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">0 - 7</span>
            </th>
            <th style="text-align: center; " class="str">
                <span style="font-weight: bold" class="str">8 - 14</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">15 - 21</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">22 - 31</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">32 - 38</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">39 - 60</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">61- 90</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">> 90</span>
            </th>
        </tr>

        <?php $no = 1;
        foreach ($report_spk as $row) : ?>

            <tr style="line-height: 0.5 cm; ">
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namacustomer ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nocustomer ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namatipe ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->jenismobil ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nofaktur ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tglfaktur ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nomorwo ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tglwo ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->projectmanager ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totaljasa) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalpart) ?></span>
                </td>
                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaipiutang) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaipenerimaan) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->jtsampai7) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->jtsampai14) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->jtsampai21) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->jtsampai31) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->jtsampai38) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->jtsampai60) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->jtsampai90) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->jtlebih90) ?></span>
                </td>

            </tr>

        <?php endforeach ?>

    </tbody>
</table>