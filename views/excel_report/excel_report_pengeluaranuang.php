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
            <th colspan="11"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="11">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="11"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">No Pengeluaran</th>
            <th style="width: 100px; font-weight: bold;">Jenis Pengeluaran</th>
            <th style="width: 100px; font-weight: bold;">No Permohonan</th>
            <th style="width: 100px; font-weight: bold;">No Referensi</th>
            <th style="width: 100px; font-weight: bold;">Nama Referensi</th>
            <th style="width: 100px; font-weight: bold;">No Account</th>
            <th style="width: 100px; font-weight: bold;">Account</th>
            <th style="width: 100px; font-weight: bold;">Debit</th>
            <th style="width: 150px; font-weight: bold;">Kredit</th>
            <th style="width: 100px; font-weight: bold;">Tanggal</th>
            <th style="width: 100px; font-weight: bold;">Memo</th>
            <th style="width: 100px; font-weight: bold;">Keterangan</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($report_pengeluaran as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nopembayaran ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->status ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nopermohonan ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->noreferensi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->namareferensi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->noaccount ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->namaaccount ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->debit ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kredit ?>
                </td>
                <td style="text-align: center;">
                    <!-- <//?php echo date('d-m-Y', strtotime($row->tanggal)) ?> -->
                    <?php echo $row->tglpengeluaran ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->memo ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->keterangan ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

    <thead>
        <tr>
            <th colspan="10" style="text-align: right; font-weight: bold;">Total Pengeluaran</th>
            <?php foreach ($totalsum as $row) :?>
                <td style="font-weight: bold; text-align: right;"><?php echo $row->totalpengeluaran ?></td>
            <?php endforeach ?>
        </tr>
    </thead>

</table>