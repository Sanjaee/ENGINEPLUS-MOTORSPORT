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
            <th colspan="10"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="10">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="10"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">No Bookking</th>
            <th style="width: 100px; font-weight: bold;">No Polisi</th>
            <th style="width: 100px; font-weight: bold;">Tipe</th>
            <th style="width: 100px; font-weight: bold;">Tanggal Booking</th>
            <th style="width: 100px; font-weight: bold;">Nama Customer</th>
            <th style="width: 150px; font-weight: bold;">PIC</th>
            <th style="width: 100px; font-weight: bold;">No Hp</th>
            <th style="width: 150px; font-weight: bold;">Keluhan</th>
            <th style="width: 150px; font-weight: bold;">Paket Perawatan</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($report_booking as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nopolisi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->namatipe ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->tanggalbooking ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama_customer ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->pic ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nohppic ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->keluhan ?>
                </td>
                <td style="text-align: center;">
                    <!-- <//?php echo date('d-m-Y', strtotime($row->tanggal)) ?> -->
                    <?php echo $row->nama_regularcheck ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>