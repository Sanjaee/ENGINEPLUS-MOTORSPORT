<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        <?php echo SITE_NAME . " : " . ucfirst($this->uri->segment(1)) . " - " . ucfirst($this->uri->segment(2)) ?>
    </title>

    <!-- Custom styles for this template -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

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
            /* position: fixed; */
            /* top: 0.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 3.1cm; */
            font-family: helvetica;
            /** Extra personal styles **/
            color: black;
            text-align: center;
            font-size: 10px;
            line-height: 0.4cm;
        }

        .header {
            margin-left: 300px;
        }

        /* .blank {
            top: 5cm;
        } */

        .content {
            /* position: fixed; */
            /* top: 5.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 3.1cm; */
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 0.4cm;
            /* page-break-before: always; */
        }

        .content-jasa {
            /* position: fixed; */
            /* top: 5.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 3.1cm; */
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 0.5cm;
            /* page-break-after: always; */
        }

        .content-part {
            /* position: fixed; */
            /* top: 5.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 3.1cm; */
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 0.5cm;
            /* page-break-inside: always; */
        }

        .footer {
            /* position: fixed; */
            /* bottom: 0.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 2cm; */

            /** Extra personal styles **/
            font-family: helvetica;
            color: black;
            text-align: center;
            line-height: 0.5cm;
        }
    </style>
</head>

<body>
    <!-- header -->
    <div class="nav-bar">
        <table width="100%" style="padding-bottom: 10px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <?php foreach ($serahterimaunit as $cell) : ?>
                    <?php if ($cell->namaperusahaan == 'AUTOBOT TOWING CAR') { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_atb.png" style="width: 200px; height: auto;">
                        </td>
                    <?php } else if ($cell->namaperusahaan == 'KARYA SINAR SEMESTA') { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_kss.png" style="width: 120px; height: auto;">
                        </td>
                    <?php } else { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_egp.png" style="width: 200px; height: auto;">
                        </td>
                    <?php } ?>

                    <td width="40%" style="vertical-align: top;">
                        <span style="color: #000000; font-size: 12px; font-weight: bold; display: block;"> <?php echo $cell->namaperusahaan ?> </span>
                        <br>
                        <span><?php echo $cell->alamatperusahaan ?></span>
                    <?php endforeach ?>
                    </td>
            </tr>
        </table>
    </div>

    <!-- Content Data -->
    <div class="content">
        <table width="100%" style="padding-top: 5px; padding-left: 10px">
            <tr>
                <?php foreach ($serahterimaunit as $cell) : ?>
                    <td width="75%">
                        <span style="font-weight: bold; font-size: 12;">Detail Saran Perbaikan No.&nbsp;<?php echo $cell->nomor ?></span>
                    </td>

                    <td width="25%">
                        <span style="font-weight: bold">Tanggal</span>
                        &nbsp;&nbsp;&nbsp;
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->tanggal ?></span>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; vertical-align: top;">
            <tr>
                <td width="100%" style="vertical-align: top;">
                    <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Detail Saran Perbaikan</span>
                            </th>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <?php foreach ($serahterimaunit as $cell) : ?>
            <div>
                <table width="100%" style="margin-top: -8px; vertical-align: top;">
                    <tr>
                        <td width="100%" style="vertical-align: top;">
                            <table width="100%" style="padding-left: 10px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">No Referensi</span>
                                    </td>
                                    <td style="width: 350px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->noreferensi ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">Customer</span>
                                    </td>
                                    <td style="width: 350px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nama_customer ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">No Polisi</span>
                                    </td>
                                    <td style="width: 350px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nopolisi ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">Tipe</span>
                                    </td>
                                    <td style="width: 350px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->jenismobil ?></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endforeach ?>
    </div>
    <!-- End Content Data -->

    <div class="content">
        <?php foreach ($serahterimaunit as $cell) : ?>
            <div>
                <table width="100%" style="margin-top: -8px; vertical-align: top;">
                    <tr>
                        <td width="100%" style="vertical-align: top;">
                            <table width="100%" style="padding-left: 10px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">Keterangan</span>
                                    </td>
                                    <td style="width: 350px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo nl2br(htmlspecialchars($cell->keterangan)) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">&nbsp;</span>
                                    </td>
                                    <td style="width: 350px;">
                                        <span style="color: #000000; font-weight: normal;">&nbsp;</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endforeach ?>
    </div>

    <div class="content">
        <?php foreach ($serahterimaunit as $cell) : ?>
            <div>
                <table width="100%" style="margin-top: -8px; vertical-align: top;">
                    <tr>
                        <td width="100%" style="vertical-align: top;">
                            <table width="100%" style="padding-left: 10px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">Saran</span>
                                    </td>
                                    <!-- <td style="width: 60px;">
                                        <span>:</span>
                                    </td> -->
                                    <td style="width: 350px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo nl2br(htmlspecialchars($cell->saran)) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">&nbsp;</span>
                                    </td>
                                    <td style="width: 350px;">
                                        <span style="color: #000000; font-weight: normal;">&nbsp;</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endforeach ?>
    </div>

    <!-- Content Detail Jasa -->
    <div class="content-jasa">
        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Foreman</span>
                            </th>
                        </tr>
                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Service Advisor</span>
                            </th>
                        </tr>
                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Service Manager</span>
                            </th>
                        </tr>
                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>