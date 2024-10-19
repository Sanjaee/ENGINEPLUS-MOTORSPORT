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
            line-height: 1.0em;
        }

        .header {
            margin-left: 300px;
        }

        .content {
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 1.0em;
            /* page-break-before: always; */
        }

        .content-detail {
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            page-break-inside: always;
        }

        .footer {

            /** Extra personal styles **/
            font-family: helvetica;
            color: black;
            text-align: center;
            line-height: 1.0em;
        }
    </style>
</head>

<body>
    <!--- header --->
    <div class="nav-bar">
        <table width="100%" style="padding-bottom: 10px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <?php foreach ($pembebanan as $cell) : ?>
                    <?php if ($cell->perusahaan == 'AUTOBOT TOWING CAR') { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_atb.png" style="width: 200px; height: auto;">
                        </td>
                    <?php } else if ($cell->perusahaan == 'KARYA SINAR SEMESTA') { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_kss.png" style="width: 120px; height: auto;">
                        </td>
                    <?php } else { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_egp.png" style="width: 200px; height: auto;">
                        </td>
                    <?php } ?>

                    <td width="40%" style="vertical-align: top;">
                        <span style="color: #000000; font-size: 12px; font-weight: bold; display: block;"> <?php echo $cell->perusahaan ?> </span>
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
                <?php foreach ($pembebanan as $cell) : ?>
                    <td width="75%">
                        <span style="font-weight: bold; font-size: 12;">No. Pembebanan : &nbsp;<?php echo $cell->nomor ?></span>
                    </td>

                    <td width="25%">
                        <span style="font-weight: bold">Tanggal</span>
                        &nbsp;&nbsp;&nbsp;
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->tanggal ?></span>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>

        <?php foreach ($pembebanan as $cell) : ?>
            <div>
                <table width="100%" style="margin-top: -5px; vertical-align: top;">
                    <tr>
                        <td width="50%" style="vertical-align: top;">
                            <table width="100%" style="padding-left: 10px; padding-top: 10px; padding-bottom: 10px;margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                <tr>
                                    <td colspan="2">
                                        <span style="font-size: 10; font-weight: normal">Dibebankan atas dokumen :</span>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="width: 100px;">
                                        <span style="font-size: 12; font-weight: bold">Nomor WO</span>
                                    </td>

                                    <td style="width: 100px;">
                                        <span style="color: #000000; font-size: 12; font-weight: bold;"><?php echo $cell->nomorwo ?></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td style="width: 100px;">
                                        <span style="font-weight: bold">Tanggal WO</span>
                                    </td>

                                    <td style="width: 100px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->tanggal_wo ?></span>
                                    </td>
                                </tr>

                            </table>
                        </td>

                        <td width="50%" style="vertical-align: top;">
                            <table width="100%" style="padding-left: 10px; padding-top: 10px; padding-bottom: 10px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                <tr>
                                    <td style="width: 95px;">
                                        <span style="font-weight: bold">NoPol</span>
                                    </td>

                                    <td style="width: 200px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nopolisi ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 95px;">
                                        <span style="font-weight: bold">Kategori</span>
                                    </td>

                                    <td style="width: 200px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->kategori ?> - <?php echo $cell->nama_kategori ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 95px;">
                                        <span style="font-weight: bold">Tipe</span>
                                    </td>

                                    <td style="width: 200px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->tipe ?> - <?php echo $cell->nama_tipe ?></span>
                                    </td>
                                </tr>

                            </table>
                        </td>

                    </tr>
                </table>
            </div>
        <?php endforeach ?>

    </div>

    <!-- Content Detail -->
    <div class="content-detail">

        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                <th style="width: 100px; text-align: center;">
                    <span style="font-weight: bold">DETAIL PEMBEBANAN SUKU CADANG</span>
                </th>
            </tr>
        </table>
        <table width="100%" style="margin-top: 5px; vertical-align: top;">
            <!-- <tr> -->
            <!-- <td width="100%" style="vertical-align: top;"> -->
            <!-- </td> -->
            <!-- </tr> -->

            <!-- <tr>
                <td width="100%" style="vertical-align: top;"> -->
            <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                    <th style="width: 30px; text-align: center;">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Kode Parts</span>
                    </th>
                    <th style="width: 200px; text-align: center;">
                        <span style="font-weight: bold">Nama Parts</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Qty</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Harga Satuan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Subtotal</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($detail as $row) : ?>

                    <tr style="line-height: 1.0em;">
                        <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->kodepart ?></span>
                        </td>
                        <td style="width: 200px; text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->namapart ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->qty ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->hargasatuan ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->subtotal ?></span>
                        </td>
                    </tr>

                <?php endforeach ?>



            </table>
            <!-- </td>
            </tr> -->

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
                                    <span style="font-weight: bold">Pemakai</span>
                                </th>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Teknisi</span>
                                </th>
                            </tr>

                            <?php $no = 1;
                            foreach ($pembebanan as $cell) : ?>
                                <tr>
                                    <td style="line-height: 2.5cm; text-align: center; ">
                                        <span style="font-weight: normal"><?php echo $cell->pemakai ?></span>
                                    </td>
                                    <td style="line-height: 2.5cm; text-align: center;">
                                        <span style="font-weight: normal"><?php echo $cell->nama_teknisi ?></span>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </td>
                </tr>

                </td>
                <tr>



            </table>

        </div>



    </div>




</body>