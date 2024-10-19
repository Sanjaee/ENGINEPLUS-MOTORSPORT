<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        <?php echo SITE_NAME . " : " . ucfirst($this->uri->segment(1)) . " - " . ucfirst($this->uri->segment(2)) ?>
    </title>

    <style>
        @page {
            margin: 1cm 1cm;
        }

        .body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        .nav-bar {
            font-family: helvetica;
            /** Extra personal styles **/
            color: BLACK;
            text-align: center;
            font-size: 10px;
            line-height: 0.4cm;
        }

        .header {
            margin-left: 300px;
        }

        .content {
            color: BLACK;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 0.5cm;
            /* page-break-inside: always; */
        }

        .content-detail {
            color: BLACK;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            /* page-break-inside: always; */
        }

        .footer {

            /** Extra personal styles **/
            font-family: helvetica;
            color: BLACK;
            text-align: center;
            line-height: 0.5cm;
        }
    </style>

    <style type="text/css">
        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }
    </style>
</head>

<?php
function rupiah($angka)
{
    $hasil_rupiah = number_format($angka);
    return $hasil_rupiah;
}
?>

<body>
    <div class="content">
        <table width="100%" style="text-align: center; padding: 5px; margin-top: 5px; border-radius: 4px; border: thin solid grey;">
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: bold">LAPORAN MUTASI UANG MUKA PEMBELIAN</span>
                </td>

            </tr>
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?></span>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px; margin-top: 5px;">

            <tbody>

                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                    <th style="width: 30px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jenis Hutang</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nomor Order</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Supplier</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Saldo Awal</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Saldo Bayar DP</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Saldo Batal Bayar DP</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Saldo Alokasi</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Batal Alokasi</span>
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
                            <span style="font-weight: normal"><?php echo $row->jenishutang ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nomororder ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->tgltransaksi ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nama_supplier ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->saldoawal)   ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->bayardp) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->batalbayardp) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->alokasi) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->batalalokasi) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                        </td>
                    </tr>


                <?php endforeach ?>
                <tr>
                    <td colspan="5">
                        <span style="font-weight: bold;" >Total :</span>
                    </td>

                    <?php foreach ($totalreport as $cell) : ?>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($cell->saldoawal)   ?></span>
                        </td>                      

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($cell->bayardp) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($cell->batalbayardp) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($cell->alokasi) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($cell->batalalokasi) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($cell->total) ?></span>
                        </td>
                    <?php endforeach ?>
                </tr>

            </tbody>
        </table>
    </div>
</body>