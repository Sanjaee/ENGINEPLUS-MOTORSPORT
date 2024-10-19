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
                <span style="font-weight: bold">No WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Nopolisi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Mobil</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Tipe</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">ID Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kategori</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kode Part & Jasa</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Cogs</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">SubTotal COGS</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">SubTotal Jual</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Customer</span>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($report_wobelumfaktur as $row) :
        ?>
            <tr>
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nospk ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->jenismobil ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namatipe ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nocustomer ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namacustomer ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->jenis ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->kodepart ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogs) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->qty) ?></span>
                </td>
                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogs * $row->qty) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->harga * $row->qty) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->status ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->jeniscustomer ?></span>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>