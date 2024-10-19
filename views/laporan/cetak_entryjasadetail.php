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
            line-height: 0.5cm;
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
                <?php foreach ($enrtyjasa as $cell) : ?>
                    <?php if ($cell->nama == 'AUTOBOT TOWING CAR') { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_atb.png" style="width: 200px; height: auto;">
                        </td>
                    <?php } else if ($cell->nama == 'KARYA SINAR SEMESTA') { ?>
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
                <?php foreach ($enrtyjasa as $cell) : ?>
                    <td width="75%">
                        <span style="font-weight: bold; font-size: 12;">No. Work Order&nbsp;<?php echo $cell->no_wo ?></span>
                    </td>

                    <td width="25%">
                        <span style="font-weight: bold">Tanggal</span>
                        &nbsp;&nbsp;&nbsp;
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->tglsimpan ?></span>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>

        <?php foreach ($enrtyjasa as $cell) : ?>
            <div>
                <table width="100%" style="margin-top: -5px; vertical-align: top;">
                    <tr>
                        <td width="60%" style="vertical-align: top;">
                            <table width="100%" style="padding-left: 10px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                <tr>
                                    <td style="width: 100px;">
                                        <span style="font-weight: bold;">No. Polisi </span><br>
                                        <span style="font-weight: bold;">Nomor Customer </span><br>
                                        <span style="font-weight: bold;">Nama Customer </span><br>
                                        <span style="font-weight: bold;">Tipe </span><br>
                                    </td>
                                    <td width="1%">
                                        <span>:</span><br>
                                        <span>:</span><br>
                                        <span>:</span><br>
                                        <span>:</span><br>
                                    </td>
                                    <td style="width: 300px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nopolisi ?></span><br>
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nomor_customer ?></span><br>
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nama_customer ?></span><br>
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nama_tipe ?></span><br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endforeach ?>
    </div>
    <!-- EndContent Data -->

    <!-- Content Detail Jasa -->
    <div class="content-jasa">
        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Jasa Detail</span>
                                </th>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 30px; text-align: center;">
                                    <span style="font-weight: bold">No.</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Kode Jasa</span>
                                </th>
                                <th style="width: 500px; text-align: center;">
                                    <span style="font-weight: bold">Nama Jasa</span>
                                </th>
                            </tr>

                            <?php $no = 1;
                            foreach ($enrtyjasadetail as $row) : ?>

                                <tr style="line-height: 1cm;">
                                    <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $no++ ?></span>
                                    </td>
                                    <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->kode_jasa ?></span>
                                    </td>
                                    <td style="width: 500px; text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->nama_jasa ?></span>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>