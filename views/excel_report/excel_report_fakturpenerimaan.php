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
            <th colspan="13"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="13">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="13"></th>
        </tr>
    </tbody>

</table>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 100px; font-weight: bold;">Jenis Transaksi</th>
            <th style="width: 100px; font-weight: bold;">Nomor Referensi</th>
            <th style="width: 100px; font-weight: bold;">No Polisi</th>
            <th style="width: 100px; font-weight: bold;">Nama Customer</th>
            <th style="width: 100px; font-weight: bold;">Nilai Piutang</th>
            <th style="width: 150px; font-weight: bold;">Tunai</th>
            <th style="width: 150px; font-weight: bold;">Bank</th>
            <th style="width: 150px; font-weight: bold;">Debit</th>
            <th style="width: 150px; font-weight: bold;">Kredit</th>
            <th style="width: 150px; font-weight: bold;">Market Place</th>
            <th style="width: 150px; font-weight: bold;">Uang Muka</th>
            <th style="width: 150px; font-weight: bold;">Sisa Piutang</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($report_faktur as $row) :
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $no++ ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->jenis ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nopolisi ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->namacustomer ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nilaipiutang ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->tunai ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->bank ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->debit ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->kredit ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->marketplace ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nilaiuangmuka ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->sisapiutang ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

    <tbody>
        <tr>
            <th colspan="3" style="width: 150px;">Total Tunai</th>
            <th colspan="2" style="width: 150px;">Total Bank</th>
            <th colspan="3" style="width: 150px;">Total Debit</th>
            <th colspan="3" style="width: 150px;">Total Kredit</th>
            <th colspan="2" style="width: 150px;">Total Market Place</th>
        </tr>

        <?php foreach ($totalsum as $row) : ?>
            <tr>
                <td colspan="3" style="text-align: center; width: 100px;">
                    <?php $row->totaltunai ?>
                </td>
                <td colspan="2" style="text-align: center; width: 100px;">
                    <?php $row->totalbank ?>
                </td>
                <td colspan="3" style="text-align: center; width: 100px;">
                    <?php $row->totaldebit ?>
                </td>
                <td colspan="3" style="text-align: center; width: 100px;">
                    <?php $row->totalkredit ?>
                </td>
                <td colspan="2" style="text-align: center; width: 100px;">
                    <?php $row->totalmarketplace ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>
