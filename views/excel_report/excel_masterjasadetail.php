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
            <th colspan="7"><?php echo $title ?></th>
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
            <th style="width: 100px; font-weight: bold;">Kode Jasa Head</th>
            <th style="width: 100px; font-weight: bold;">Nama Jasa Head</th>
            <th style="width: 100px; font-weight: bold;">Kode Jasa Detail</th>
            <th style="width: 100px; font-weight: bold;">Nama Jasa Detail</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($jasa as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kode_jasahead ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kode_jasa ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama_jasa ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>