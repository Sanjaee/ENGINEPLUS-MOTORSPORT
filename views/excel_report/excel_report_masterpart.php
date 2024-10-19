<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<style> .str{ mso-number-format:\@; } </style>

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
            <th colspan="12"><?php echo $title ?></th>
        </tr>
        <tr>
            <!-- <th colspan="12">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th> -->
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="12"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">

    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px;">Kode</th>
            <th style="width: 100px;">Nama</th>
            <th style="width: 100px;">Kategori Workshop</th>
            <th style="width: 100px;">Kategori Web</th>
            <th style="width: 100px;">Harga Beli</th>
            <th style="width: 100px;">Harga Jual</th>
            <th style="width: 100px;">Lokasi</th>
            <th style="width: 100px;">Satuan</th>
            <th style="width: 100px;">Stock</th>
            <th style="width: 100px;">Aktif</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($masterpart as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->kodepart ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nama ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kategoripartworkshop ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kategorips ?>
                </td>
                <td style="text-align: center;">
                    <?php echo rupiah ($row->hargabeli) ?>
                </td>
                <td style="text-align: center;">
                    <?php echo rupiah ($row->hargajual) ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->lokasi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->satuan ?> 
                </td>
                
                <td style="text-align: center;">
                    <?php echo $row->stock ?> 
                </td>
                
                <td style="text-align: center;">
                    <?php echo $row->active ?> 
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>