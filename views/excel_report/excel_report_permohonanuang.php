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
                <span style="font-weight: bold">Nomor Permohonan</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Keterangan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Transaksi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Referensi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kode Supplier/Account</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Supplier/Account</span>
            </th>
            <th style="text-align: center; ;">
                <span style="font-weight: bold">Nilai Permohonan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Account Kas/bank</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Account Nama</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Nilai Penghapusan/UM</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Account Penghapusan</span>
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
                    <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->jenistransaksi ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->noreferensi   ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->kodesupplier ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->namasupplier ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaipermohonan) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->kodeaccount ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->nama) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaialokasi) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->accountalokasi) ?></span>
                </td>
            </tr>
        </tbody>
    <?php endforeach ?>

</table>