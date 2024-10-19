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
            <th style="width: 150px;">No Customer</th>
            <th style="width: 150px;">Nama Customer</th>
            <th style="width: 150px;">Alamat</th>
            <th style="width: 150px;">Kelurahan</th>
            <th style="width: 150px;">Kecamatan</th>
            <th style="width: 150px;">Kota</th>
            <th style="width: 150px;">Provinsi</th>
            <th style="width: 150px;">Kode Pos</th>
            <th style="width: 150px;">No HP</th>
            <th style="width: 150px;">No Telp</th>
            <th style="width: 150px;">email</th>
            <th style="width: 150px;">NPWP</th>
            <th style="width: 150px;">Nama NPWP</th>
            <th style="width: 150px;">alamat NPWP</th>
            <th style="width: 150px;">Jenis Customer</th>
            <th style="width: 150px;">Kategori Cust</th>
            <th style="width: 150px;">Kode Cabang</th>
            <th style="width: 150px;">Status Aktif</th>
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
                <td style="text-align: center; text-transform: uppercase;">
                    <span style="text-transform: uppercase;">
                        <?php echo $row->nama ?> </span>
                </td>
                <td style="text-align: center; text-transform: uppercase;">
                    <span style="text-transform: uppercase;"> <?php echo $row->alamat ?> </span>
                </td>
                <td style="text-align: center; text-transform: uppercase;">
                    <?php echo $row->kelurahan ?>
                </td>
                <td style="text-align: center; text-transform: uppercase;">
                    <?php echo $row->kecamatan ?>
                </td>
                <td style="text-align: center; text-transform: uppercase;">
                    <?php echo $row->kota ?>
                </td>
                <td style="text-align: center; text-transform: uppercase;">
                    <?php echo $row->provinsi ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->kodepos ?>
                </td>
                <td style="text-align: right;" class="str">
                    <?php echo ($row->nohp) ?>
                </td>
                <td style="text-align: right;" class="str">
                    <?php echo ($row->notlp) ?>
                </td>
                <td style="text-align: center; text-transform: uppercase;">
                    <?php echo $row->email ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->npwp ?>
                </td>
                <td style="text-align: center; text-transform: uppercase;">
                    <span style="text-transform: uppercase;">
                    <?php echo $row->namanpwp ?> </span>
                </td>
                <td style="text-align: center; text-transform: uppercase;">

                    <span style="text-transform: uppercase;">
                        <?php echo $row->alamatnpwp ?> </span>
                </td>
                <td style="text-align: center; text-transform: uppercase;">
                    <?php echo $row->jeniscustomer ?>
                </td>
                <td style="text-align: center; text-transform: uppercase;" class="str">
                    <?php if ($row->kategoricustomer == "1") {
                        echo "WorkShop";
                    } else if ($row->kategoricustomer == "2") {
                        echo "Enduser";
                    } else if ($row->kategoricustomer == "3") {
                        echo "Reseller";
                    } ?>
                </td>
                <td style="text-align: center; text-transform: uppercase;" class="str">
                    <?php echo $row->kode_cabang ?>
                </td>
                <td style="text-align: center; text-transform: uppercase;" class="str">
                    <?php if ($row->aktif == "t") {
                        echo "Aktif";
                    } else if ($row->aktif == "f") {
                        echo "Non Aktif";
                    } ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>