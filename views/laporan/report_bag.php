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

<!-- <div class="nav-bar">
        <div>
            <table width="100%" style="margin-top: 5px; border-radius: 4px; border-bottom: thin solid grey;">
                <tr>
                    <td width="20%" style="vertical-align: bottom;">

                        <img src="./assets/img/lenovo logo.jpg" style="position: absolute; width: 180px height: auto;">
                        
                    </td>

                    <td width="80%" style="vertical-align: top;">
                        <table width="100%" style="margin-top: 5px; ">
                            <tr>
                                <td style="padding-bottom: 20px; padding-left: 30px;">
                                    <span style="color: #000000; font-size: 11; font-weight: bold; display: block;"> INFRA HUTAMA SOLUSINDO </span>
                                    <br>
                                    <div>
                                        Green Lake City Rukan CBD Blok C No 77, Gondrong, Cipondoh Tanggerang 15146 - I N D O N E S I A <br>
                                        <strong>Info Kontak : </strong> 021 2985 9571 / 021 2252 9826 / 021 2252 3393 - Fax : 021 2985 9889 <br>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>

        </div>
    </div> -->

<body>
    <div class="content">
        <table width="100%" style="text-align: center; padding: 5px; margin-top: 5px; border-radius: 4px; border: thin solid grey;">
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: bold">LAPORAN BAG IN DAN BAG OUT</span>
                </td>

            </tr>
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?> &nbsp; s/d &nbsp; <?php echo $tglakhir ?> </span>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px; margin-top: 5px; border: thin solid grey;">
            <tbody>
                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                    <th style="width: 30px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No BAG</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jenis</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Keterangan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Kode Parts</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Parts</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Cogs</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total COGS</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($report_bag as $row) : ?>
                    <tr style="line-height: 0.5 cm; ">
                        <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->jenis ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->kodepart ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->namapart ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->cogs) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->cogs * $row->qty) ?></span>
                        </td>
                    </tr>
            </tbody>

        <?php endforeach ?>

        </table>

        <!-- <table width="100%" style="margin-top: 5px;">
            <td width="70%" style="vertical-align: top;">

            </td>

            <td width="30%" style="vertical-align: top;">
                <table width="100%" style="font-size: 10; padding: 5px; margin-top: 5px; border: thin solid grey;">
                    <tr>
                        <td>
                            <span style="font-weight: normal">Grand Total Faktur :</span>
                        </td>

                        <?php foreach ($totalsum as $cell) : ?>

                            <td>
                                <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->totalfaktur) ?>,-</span>
                            </td>
                            <?php endforeach ?>
                    </tr>
                </table>
            </td>
        </table> -->

    </div>
</body>