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

<table width="100%" style="margin-top: 5px; ">
    <tbody style="border: thin solid grey; border-radius: 4px;">
        <tr style="background-color: rgba(242, 242, 242, 0.74); ">
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Polisi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tipe</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kategori</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Keluhan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Keterangan</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Estimasi Part</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Estimasi Jasa</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total Estimasi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total UM</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Sisa UM</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Service</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">SA</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Pembebanan</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal Batal</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Keterangan Batal</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">User Batal</span>
            </th>
        </tr>

        <?php $no = 1;
        foreach ($report_spk as $row) : ?>

            <tr style="line-height: 0.5 cm; ">
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nospk ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->status ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->customer ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tipe ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->kategori ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->keluhan ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalpart) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totaljasa) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaispk) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->sisaum) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->jenisservice ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->pemakai ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->statuswo ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->statuspart ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->tglbatal ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->keteranganbatal ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->userbatal ?></span>
                </td>

            </tr>

        <?php endforeach ?>

    </tbody>
</table>

<table width="100%" style="margin-top: 5px;">
    <td width="70%" style="vertical-align: top;">

    </td>

    <td width="30%" style="vertical-align: top;">
        <table width="100%" style="font-size: 10; padding: 10px; margin-top: 5px; border-radius: 4px; border: thin solid grey;">
            <tr>
                <td>
                    <span style="font-weight: bold;">Total Nilai WO :</span>
                </td>

                <?php foreach ($totalsum as $cell) : ?>

                    <td>
                        <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->totalnilaispk) ?>,-</span>
                    </td>
                    <!-- <?php endforeach ?> -->
            </tr>
        </table>
    </td>
</table>