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
            line-height: 1em;
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
                    <span style="font-size: 10; font-weight: bold">LAPORAN FAKTUR SERVICE SUMMARY</span>
                </td>

            </tr>
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?> &nbsp; s/d &nbsp; <?php echo $tglakhir ?> </span>
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
                        <span style="font-weight: bold">No Faktur</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl Faktur</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No WO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl WO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Polisi</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Customer</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tipe</span>
                    </th>
                    <th style="text-align: center; ;">
                        <span style="font-weight: bold">Jenis Service</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Keterangan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Mekanik</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Foreman</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total Jasa</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Discount Jasa</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">DPP Jasa</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total Part</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Discount Part</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">DPP Part</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">DPP Jasa Part</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">PPN</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total Jasa Part</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">COGS Part</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">COGS OPL</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Margin</span>
                    </th>                    
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">DP</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl Lunas</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jenis Customer</span>
                    </th>
                </tr>
                <?php $no = 1;
                foreach ($report_faktur as $row) : ?>
                    <tr style="line-height: 1 em; ">
                        <td style="width: 30px; text-align: center; ">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nofaktur ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nospk ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->tglwo ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->customer ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->tipe ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->jenisservice ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                        </td>
                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nama_teknisi ?></span>
                        </td>
                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nama_foreman ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->totaljasa + $row->discountjasa) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->discountjasa) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->totaljasa) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpart + $row->discountpart) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->discountpart) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpart) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->dpp) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->ppn) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaifaktur) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->cogspart) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->cogsopl) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->dpp - ($row->cogsopl + $row->cogspart)) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                        </td>
                        <td style="text-align: left; ">
                            <span style="font-weight: normal"><?php echo ($row->statusbayar) ?></span>
                        </td>
                        <td style="text-align: left; ">
                            <span style="font-weight: normal"><?php echo ($row->tgllunas) ?></span>
                        </td>
                        <td style="text-align: left; ">
                            <span style="font-weight: normal"><?php echo ($row->jeniscustomer) ?></span>
                        </td>
                    </tr>

            </tbody>

        <?php endforeach ?>

        </table>

        <table width="100%" style="margin-top: 5px;">
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
                            <!-- <?php endforeach ?> -->
                    </tr>
                </table>
            </td>
        </table>

    </div>
</body>