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

        .content-detail {
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            page-break-inside: always;
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

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " BELAS";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " PULUH" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " SERATUS" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " RATUS" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " SERIBU" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " RIBU" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " JUTA" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " MILYAR" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " TRILYUN" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "MINUS " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
?>

<body>
    <!-- header -->
    <div class="nav-bar">
        <table width="100%" style="padding-bottom: 10px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <?php foreach ($pencairan as $cell) : ?>
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
                <?php foreach ($pencairan as $cell) : ?>
                    <td width="75%">
                        <span style="font-weight: bold; font-size: 12;">Bukti Terima Uang No.</span><br>
                        <span style="font-weight: bold; font-size: 12;"><?php echo $cell->nomor ?></span>
                    </td>

                    <td width="25%">
                        <span style="font-weight: bold">Tanggal</span>
                        &nbsp;&nbsp;&nbsp;
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->tanggal ?></span>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>

        <div>
            <table width="100%" style="margin-top: -5px; vertical-align: top;">
                <tr>
                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="padding-left: 10px; padding-top: 10px; padding-bottom: 10px;margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr>
                                <td style="width: 150px;">
                                    <span style="font-size: 10; font-weight: normal">Telah Terima Di :</span>
                                </td>

                                <?php foreach ($pencairan as $cell) : ?>
                                    <td colspan="3">
                                        <span style="color: #000000; font-size: 12; font-weight: bold;"><?php echo $cell->nama ?></span>
                                    </td>


                            </tr>
                            <tr>
                                <td style="width: 150px;">
                                    <span style="font-size: 8; font-weight: normal">Jumlah Uang</span>
                                </td>

                                <td style="width: 100px;">
                                    <span style="color: #000000; font-size: 8; font-weight: bold;"><?php echo rupiah($cell->totalpencairan) ?></span>
                                </td>

                            </tr>

                            <tr>
                                <td style="width: 150px;">
                                    <span style="font-size: 8; font-weight: normal"></span>
                                </td>

                                <td colspan="2">
                                    <span style="color: #000000; font-size: 8; font-weight: bold;"># <?php echo terbilang($cell->totalpencairan) ?> RUPIAH #</span>
                                </td>
                                <!-- <?php endforeach ?> -->

                            </tr>

                            <tr>
                                <td style="width: 150px;">
                                    <span style="font-weight: normal; font-size: 8;">Jenis Pencairan</span>
                                </td>

                                <td colspan="2">
                                    <span style="color: #000000; font-size: 8; font-weight: bold;">
                                        <?php if ($cell->jenispenerimaan == "3") {
                                            echo "PENCAIRAN KARTU KREDIT";
                                        } else if ($cell->jenispenerimaan == "4") {
                                            echo "PENCAIRAN KARTU DEBIT";
                                        } else if ($cell->jenispenerimaan == "5") {
                                            echo "MARKET PLACE";
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>

                        </table>
                    </td>

                </tr>
            </table>

        </div>

    </div>

    <div class="content-detail">
        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">

                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 30px; text-align: center;">
                                    <span style="font-weight: bold">No.</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">No Piutang KD</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">No Invoice</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Nama Customer</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Nomor Batch</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Jumlah (Rp)</span>
                                </th>
                            </tr>

                            <?php $no = 1;
                            foreach ($detail as $row) : ?>

                                <tr style="line-height: 0.5cm;">
                                    <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $no++ ?></span>
                                    </td>
                                    <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->noreferensi ?></span>
                                    </td>
                                    <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->nomordokumen ?></span>
                                    </td>
                                    <td style="width: 200px; text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->namacustomer ?></span>
                                    </td>
                                    <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->norekening ?></span>
                                    </td>
                                    <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo rupiah($row->nilaipenerimaan) ?></span>
                                    </td>
                                </tr>

                            <?php endforeach ?>



                        </table>
                    </td>
                </tr>

            </table>

        </div>

        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                <tr>
                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Account</span>
                                </th>

                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Nomor Rek</span>
                                </th>

                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Tanggal</span>
                                </th>
                            </tr>

                            <tr>
                                <?php $no = 1;
                                foreach ($pencairan as $cell) : ?>

                                    <td style="text-align: center;">
                                        <span style="font-weight: normal"><?php echo $cell->nama ?></span>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style="font-weight: normal"><?php echo $cell->norekening ?></span>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style="font-weight: normal"><?php echo $cell->tanggal ?></span>
                                    </td>
                                <?php endforeach ?>
                            </tr>

                        </table>
                    </td>


                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr>
                                <td style="text-align: right;">
                                    <span style="font-weight: bold">Bank Charge</span>
                                </td>
                                <?php $no = 1;
                                foreach ($detail as $row) : ?>

                                    <td style="text-align: right;">
                                        <span style="font-weight: bold"><?php echo rupiah($row->bankcharge) ?></span>
                                    </td>

                                    <!-- <?php endforeach ?>  -->
                            </tr>
                            <tr>
                                <td style="text-align: right;">
                                    <span style="font-weight: bold">Total</span>
                                </td>
                                <?php $no = 1;
                                foreach ($pencairan as $row) : ?>

                                    <td style="text-align: right;">
                                        <span style="font-weight: bold"><?php echo rupiah($row->totalpencairan - $row->bankcharge) ?></span>
                                    </td>

                                    <!-- <?php endforeach ?>  -->
                            </tr>

                        </table>
                    </td>

                </tr>

                </td>



                </tr>



            </table>

        </div>

        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">

                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Kasir</span>
                                </th>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Keuangan</span>
                                </th>
                            </tr>


                            <tr>

                                <?php foreach ($detail as $cell) ?>
                                <td style="line-height: 2.5cm; text-align: center; ">
                                    <span style="font-weight: normal"><?php echo $cell->pemakai ?></span>
                                </td>
                                <td style="line-height: 2.5cm; text-align: center;">
                                    <span style="font-weight: normal"></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                </td>
                <tr>



            </table>

        </div>

    </div>

</body>