<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<style>
    .str {
        mso-number-format: \@;
    }
</style>
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
    </thead>

    <tbody>
        <tr>
            <th colspan="11"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">
    <thead>
        <tr style="background-color: Gainsboro;">
            <th>No.</th>
            <th style="width: 150px;">No Supplier</th>
            <th style="width: 150px;">Nama Supplier</th>
            <th style="width: 150px;">Alamat</th>
            <th style="width: 150px;">No HP</th>
            <th style="width: 150px;">No Telp</th>
            <th style="width: 150px;">NPWP</th>
            <th style="width: 150px;">Nama NPWP</th>
            <th style="width: 150px;">alamat NPWP</th>
            <th style="width: 150px;">No Rekening</th>
            <th style="width: 150px;">Nama Rekening</th>
            <th style="width: 150px;">Nama Bank</th>
            <!-- <th style="width: 150px;">Nomor Permohonan</th> -->
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($report as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->alamat ?>
                </td>
                <td style="text-align: right;" class="str">
                    <?php echo ($row->nohp) ?>
                </td>
                <td style="text-align: right;" class="str">
                    <?php echo ($row->notlp) ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->npwp ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->namanpwp ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->alamatnpwp ?>
                </td>
                <td style="text-align: center;"  class="str">
                    <?php echo $row->norekening ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->namarekening ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->namabank ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>