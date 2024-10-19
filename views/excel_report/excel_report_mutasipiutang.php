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
            <th colspan="8"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="8">Periode : <?php echo $tglmulai ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="8"></th>
        </tr>
    </tbody>

</table>

<table width="100%" style="border-radius: 4px; margin-top: 5px;">

    <tbody>

        <tr style="background-color: rgba(242, 242, 242, 0.74);">
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Piutang</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nomor Faktur</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Saldo Awal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Saldo Jual</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Saldo Retur Jual</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Saldo Bayar</span>
            </th>
            <th style="text-align: center; ;">
                <span style="font-weight: bold">Batal Bayar</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Saldo ALokasi</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Batal Alokasi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Saldo Hapus AR</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Batal Hapus AR</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Saldo AkKhir</span>
            </th>
        </tr>
        <?php $no = 1;
        foreach ($report as $row) : ?>

            <tr style="line-height: 1 em; ">
                <td style="width: 30px; text-align: center; ">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->jenispiutang ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nomorfaktur ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->tgltransaksi ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nama_customer ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->saldoawal)   ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->jual) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->rjual) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->bayar) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->batalbayar) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->alokasi) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->batalalokasi) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->hapusar) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->batalhapusar) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                </td>
            </tr>


        <?php endforeach ?>
        <tr>
            <td colspan="5">
                <span style="font-weight: bold;">Total :</span>
            </td>

            <?php foreach ($totalreport as $cell) : ?>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->saldoawal)   ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->jual) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->rjual) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->bayar) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->batalbayar) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->alokasi) ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->batalalokasi) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->hapusar) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->batalhapusar) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($cell->total) ?></span>
                </td>
            <?php endforeach ?>
        </tr>

    </tbody>
</table>