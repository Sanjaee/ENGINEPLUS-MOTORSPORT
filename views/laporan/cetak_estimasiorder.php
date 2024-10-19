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

<?php
function rupiah($angka)
{

    $hasil_rupiah = number_format($angka);
    return $hasil_rupiah;
}
?>

<body>
    <!-- header -->
    <div class="nav-bar">
    <table width="100%" style="padding-bottom: 10px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <?php foreach ($order as $cell) : ?>
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
        <table width="100%" style="padding-top: 5px; padding-left: 10px; border-bottom: thin dashed #cccccc;">
            <tr>
                <?php foreach ($order as $cell) : ?>
                    <td width="75%">
                        <span style="font-weight: bold; font-size: 12;">No Estimasi Order&nbsp;&nbsp;&nbsp;<?php echo $cell->nomor ?></span>
                    </td>

                    <td width="25%">
                        <span style="font-weight: bold">Tanggal</span>
                        &nbsp;&nbsp;&nbsp;
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->tanggal ?></span>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>

        <?php foreach ($order as $cell) : ?>
            <div>
                <table width="100%" style="margin-top: 5px; vertical-align: top;">
                    <tr>
                        <td width="100%" style="vertical-align: top;">
                            <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                    <th style="width: 100px; text-align: center;">
                                        <span style="font-weight: bold; font-size: 12;">Estimasi Ordering Sparepart</span>
                                    </th>
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
                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                    <th style="width: 30px; text-align: center;">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Kode Sparepart</span>
                    </th>
                    <th style="width: 200px; text-align: center;">
                        <span style="font-weight: bold">Nama Sparepart</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Qty</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Kurs</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Shipping</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Total Shipping</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Biaya Berat/kg</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Total Bea Masuk</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Harga USD</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Harga Beli</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Harga Jual</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Harga Satuan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Total Satuan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Berat Satuan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Biaya Berat</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Shipping Satuan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Harga Modal</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Margin Jual</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Harga Normal</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Spare Margin</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Harga Estimasi Jual</span>
                    </th>

                </tr>

                <?php $no = 1;
                foreach ($detailorder as $row) : ?>

                    <tr style="line-height: 1em;">
                        <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->kodepart ?></span>
                        </td>
                        <td style="width: 200px; text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->namapart ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->qty ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->kurs) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->shipping) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalshipping) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->biayaberatkg) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalbeamasuk) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->hargausd) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->hargabeli) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->hargajual) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->hargasatuan) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->hargatotal) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->beratsatuan) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->biayaberat) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->shippingsatuan) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->hargamodal) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->marginjual) ?>%</span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->harganormal) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->sparemargin) ?>%</span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->hargajualest) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"></span>
                        </td>
                    </tr>

                <?php endforeach ?>
            </table>
        </div>

        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Partman</span>
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
                    <table width="100%" style="border-radius: 4px;">
                        <tr>
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">&nbsp;</span>
                            </th>
                        </tr>

                        <tr>
                            <td style="width: 100px; text-align: center;">
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Manager</span>
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