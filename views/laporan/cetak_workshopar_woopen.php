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
        <table width="100%" style="border-radius: 4px; border: thin solid grey; margin-top: 5px;">
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <table width="100%" style="text-align: center; padding: 3px; ">

                        <tr>
                            <td>
                                <span style="font-size: 10; font-weight: bold">LAPORAN TOOLS CONTROL SO OPEN</span>
                            </td>
                        </tr>

                        <tr>
                            <!-- <td>
                                <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?> &nbsp; </span>
                            </td> -->
                        </tr>

                    </table>
                </td>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; border: thin solid grey; border-radius: 4px;">
            <tbody>
                <tr style="background-color: rgba(242, 242, 242, 0.74); ">
                    <th style="width: 30px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nomor WO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Polisi</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Customer</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tipe</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Teknisi</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Foreman</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Estimasi Part</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Estimasi Jasa</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Estimasi OPL</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total Estimasi</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nilai Uang Muka</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Sisa</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status WO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Project Manager</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Posisi Kendaraan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">umur WO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status Kendaraan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jenis Customer</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Indikator Summary</span>
                    </th>

                </tr>

                <?php $no = 1;
                $totalsisaar = 0;
                foreach ($workshopar_woopen as $row) : ?>
                    <?php $sisaar = intval($row->sisaum) ?>
                    <tr style="line-height: 0.25 cm; ">
                        <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nospk ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tanggal)); ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->customer ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tipe ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nama_teknisi ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nama_foreman ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpart) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totaljasa) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalopl) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaispk) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->sisaum) ?></span>
                        </td>


                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statuswo ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->projectmanager ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statuskendaraan ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->umur ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statuspekerjaanmobil ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->jeniscustomer ?></span>
                        </td>
                <?php if ($row->statussum == 'Tunggu Dikerjakan') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: red;">&bull;</span>
                    </td>
                <?php } else if ($row->statussum == 'Sedang Dikerjakan') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: yellow;">&bull;</span>
                    </td>
                <?php } else if ($row->statussum == 'Selesai Dikerjakan') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: green;">&bull;</span>
                    </td>
                <?php } else if ($row->statussum == 'Batal') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: grey;">&bull;</span>
                    </td>
                <?php } ?>
                    </tr>
                <?php
                    $totalsisaar += $sisaar;

                // $diff  = date_diff($akhir, $awal);
                endforeach ?>

                <tr>
                    <td colspan="13" style="text-align: center;">
                        <span style="font-weight: bold;">Total Sisa AR </span>
                    </td>

                    <?php
                    // foreach ($totalsuminventorystock as $cell) : 
                    ?>
                    <td style="text-align: center;">
                        <span style="color: #000000; font-weight: bold;"><?php echo rupiah($totalsisaar) ?></span>
                    </td>

                    <!-- <td style="text-align: center;">
                            <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->totalnilai) ?>,-</span>
                        </td>

                        <td style="text-align: center;">
                            <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->grandtotal) ?>,-</span>
                        </td> -->
                    <?php
                    // endforeach 
                    ?>
                </tr>
            </tbody>
        </table>

        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Pembuat</span>
                                </th>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Memeriksa</span>
                                </th>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Menyetujui</span>
                                </th>
                            </tr>


                            <tr>
                                <td style="line-height: 2.5cm; text-align: center; ">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                                <td style="line-height: 2.5cm; text-align: center;">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                                <td style="line-height: 2.5cm; text-align: center;">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>