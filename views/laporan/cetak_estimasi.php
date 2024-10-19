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
            margin-top: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
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
            line-height: 1em;
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
            line-height: 1em;
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
            line-height: 1em;
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
            line-height: 1em;
            /* page-break-inside: always; */
        }

        .footer {
            /* position: fixed; */
            /* bottom: 0.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 1cm; */

            /** Extra personal styles **/
            font-family: helvetica;
            color: black;
            text-align: center;
            font-size: 10px;
            line-height: 1em;
        }
    </style>
</head>
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>

<body>
    <!-- header -->
    <div class="nav-bar">
        <div>
            <table width="100%" style="margin-top: 5px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
                <tr>
                    <td width="60%" style="vertical-align: bottom;">

                        <!-- <img src="./assets/img/lenovo logo.jpg" style="position: absolute; width: 200px height: auto;"> -->
                        <?php foreach ($spk as $cell) : ?>

                            <table width="100%" style="padding: 10px; margin-top: 5px;">
                                <tr>
                                    <td colspan="4">
                                        <span style="font-weight: bold; font-size: 12;">Estimasi Pekerjaan No. &nbsp;&nbsp;&nbsp;</span><br /><br />
                                        <span style="color: #000000; font-weight: bold; font-size: 14;"><?php echo $cell->nomorest ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span style="font-weight: bold">Tanggal</span>
                                    </td>
                                    <td>
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->tanggal ?></span>
                                    </td>
                                </tr>
                            </table>


                    </td>

                    <td width="40%" style="vertical-align: top;">
                        <table width="100%" style="margin-top: 5px; ">
                            <tr>
                                <td style="padding-bottom: 20px; padding-left: 30px;">
                                    <span style="color: #000000; font-size: 12px; font-weight: bold; display: block;"> <?php echo $cell->perusahaan ?> </span>
                                    <br>
                                    <div>
                                        <?php echo $cell->alamatperusahaan ?>
                                        <!-- Green Lake City Rukan CBD Blok C No 77 <br>
                                        Gondrong - Cipondoh<br>
                                        Tanggerang 15146 
                                        I N D O N E S I A <br>
                                        <strong>Info Kontak : </strong><br>
                                        021 2985 9571 / 021 2252 9826 <br>
                                        021 2252 3393 <br>
                                        Fax - 021 2985 9889 <br> -->
                                    </div>
                                </td>
                            </tr>
                        </table>
                    <?php endforeach ?>
                    </td>

                </tr>
            </table>

        </div>

    </div>

    <!-- Content Data -->
    <div class="content">
        <?php foreach ($spk as $cell) : ?>
            <div>
                <table width="100%" style="margin-top: 5px; vertical-align: top;">
                    <tr>
                        <td width="50%" style="vertical-align: top;">
                            <table width="100%" style="padding-left: 10px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                <tr>
                                    <td style="width: 95px;">
                                        <span style="font-weight: bold">No Pol</span>
                                    </td>

                                    <td style="width: 200px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nopolisi ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 95px;">
                                        <span style="font-weight: bold">Model</span>
                                    </td>
                                    <td colspan="2">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->model ?></span>
                                    </td>

                                </tr>

                                <tr>
                                    <td style="width: 95px;">
                                        <span style="font-weight: bold">Tipe</span>
                                    </td>
                                    <td colspan="2">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->tipe ?> - <?php echo $cell->nama_tipe ?></span>
                                    </td>

                                </tr>
                            </table>

                            <table width="100%" style="margin-top: 5px; padding-left: 10px; border-radius: 4px; border: thin dashed #cccccc;">

                                <tr>
                                    <td style="width: 60px; padding-bottom: 20px;">
                                        <span style="font-weight: bold">Keluhan</span>
                                    </td>

                                    <td style="width: 200px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->keluhan ?></span>
                                    </td>
                                </tr>


                            </table>
                            <table width="100%" style="padding-left: 10px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">

                                <tr>
                                    <td style="width: 100px;">
                                        <span style="font-weight: bold">Jenis Service</span>
                                    </td>

                                    <td style="width: 70px;">
                                        <span style="color: #000000; font-weight: normal;">
                                            <?php if ($cell->jenisservice == "0") {
                                                echo "Service Berkala Int";
                                            } else if ($cell->jenisservice == "1") {
                                                echo "Service Berkala Ext";
                                            } else if ($cell->jenisservice == "2") {
                                                echo "General Repair";
                                            } else if ($cell->jenisservice == "3") {
                                                echo "Express Maintenance";
                                            } else if ($cell->jenisservice == "4") {
                                                echo "Custom";
                                            } else if ($cell->jenisservice == "5") {
                                                echo "Turbo Kit dan Balap";
                                            } else if ($cell->jenisservice == "6") {
                                                echo "Towing";
                                            } else if ($cell->jenisservice == "7") {
                                                echo "Outsource KSS";
                                            }
                                            ?>
                                        </span>
                                    </td>

                                    <td style="width: 70px;">
                                        <span style="font-weight: bold">Return Job</span>
                                    </td>

                                    <td style="width: 70px;">
                                        <span style="color: #000000; font-weight: normal;">
                                            <?php if ($cell->returnjob == "t") {
                                                echo "Yes";
                                            } else if ($cell->returnjob == "f") {
                                                echo "No";
                                            }
                                            ?>
                                        </span>
                                    </td>

                                    <td style="width: 70px;">
                                        <span style="font-weight: bold">Warranty</span>
                                    </td>

                                    <td style="width: 70px;">
                                        <span style="color: #000000; font-weight: normal;">
                                            <?php if ($cell->garansi == "t") {
                                                echo "Yes";
                                            } else if ($cell->garansi == "f") {
                                                echo "No";
                                            }
                                            ?>
                                        </span>
                                    </td>

                                </tr>

                            </table>

                        </td>

                        <td width="50%" style="vertical-align: top;">
                            <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc; padding-bottom: 20px; padding-left: 30px;">
                                <tr>
                                    <td>
                                        <span style="font-weight: normal">Diterbitkan atas nama</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-weight: bold">Pemilik/Customer</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->nama_customer ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->alamat ?></span>
                                            <br>
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->pic ?></span>
                                            <br>
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->nohppic ?> / <?php echo $cell->notlp ?></span>
                                        </div>
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
        <!-- <table width="100%" style="margin-top: 5px; vertical-align: top;">
            <tr>
                <td width="100%" style="vertical-align: top;"> -->
                    <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Estimasi Biaya jasa</span>
                            </th>
                        </tr>
                    </table>
                <!-- </td>
            </tr>
        </table> -->

        <!-- <table width="100%" style="margin-top: 5px; vertical-align: top;">
            <tr>
                <td width="100%" style="vertical-align: top;"> -->
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 30px; text-align: center;">
                                <span style="font-weight: bold">No.</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Kode Pekerjaan</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Nama Pekerjaan</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Kategori</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Qty</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Harga</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Subtotal</span>
                            </th>
                        </tr>

                        <?php $no = 1;
                        foreach ($spkjasa as $row) : ?>

                            <tr>
                                <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                                </td>
                                <td style=" border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                                </td>
                                <td style="border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->namareferensi ?></span>
                                </td>
                                <td style="border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->kategori ?></span>
                                </td>
                                <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal">1</span>
                                </td>

                                <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                                </td>
                                <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                                </td>
                            </tr>

                        <?php endforeach ?>

                    </table>
                <!-- </td>
            </tr>

        </table> -->

        <table width="100%" style="margin-top: 5px; vertical-align: top;">
   
                <!-- <td width="100%" style="vertical-align: top;"> -->
                    <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Estimasi Biaya Part</span>
                            </th>
                        </tr>
                    </table>
                <!-- </td> -->
        </table>
        <!-- <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <td width="100%" style="vertical-align: top;"> -->
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 30px; text-align: center;">
                                <span style="font-weight: bold">No.</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Kode Part</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Nama Part</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Kategori</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Qty</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Harga</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Subtotal</span>
                            </th>
                        </tr>

                        <?php $no = 1;
                        foreach ($spkpart as $row) : ?>

                            <tr>
                                <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                                </td>
                                <td style=" border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                                </td>
                                <td style="border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->namareferensi ?></span>
                                </td>
                                <td style="border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->kategori ?></span>
                                </td>
                                <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->qty ?></span>
                                </td>
                                <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                                </td>
                                <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                                </td>
                            </tr>

                        <?php endforeach ?>

                    </table>
                <!-- </td>

        </table> -->
    </div>


    <div class="footer">
        <table width="100%" style="margin-top: 5px; vertical-align: top;">
            <tr>
                <td width="100%" style="vertical-align: top;">
                    <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Total Sparepart</span>
                            </th>
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Total Jasa</span>
                            </th>
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Total</span>
                            </th>
                        </tr>

                        <?php $no = 1;
                        foreach ($spk as $cell) : ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span style="font-weight: normal"><?php echo rupiah($cell->totalpart) ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <span style="font-weight: normal"><?php echo rupiah($cell->totaljasa) ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <span style="font-weight: normal"><?php echo rupiah($cell->dpp) ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; vertical-align: top;">
            <tr>
                <td width="100%" style="vertical-align: top;">
            <tr>
                <td width="100%" style="vertical-align: top;">
                    <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 230px; text-align: center;">
                                <span style="font-weight: bold">DPP</span>
                            </th>

                            <th style="width: 230px; text-align: center;">
                                <span style="font-weight: bold">PPN</span>
                            </th>


                            <th Colspan="2" style="text-align: center;">
                                <span style="font-weight: bold">Total</span>
                            </th>
                        </tr>

                        <?php $no = 1;
                        foreach ($spk as $cell) : ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span style="font-weight: normal"><?php echo rupiah($cell->dpp) ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <span style="font-weight: normal"><?php echo rupiah($cell->ppn) ?></span>
                                </td>
                                <td Colspan="2" style="text-align: center;">
                                    <span style="font-weight: bold"><?php echo rupiah($cell->grandtotal) ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>
            </tr>

            </td>
            <tr>



        </table>


        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <!-- <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                    <tr style="background-color: rgba(242, 242, 242, 0.74);">
                        <th style="width: 100px; text-align: center;">
                            <span style="font-weight: bold">Teknisi</span>
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
                </td> -->

                <td style="vertical-align: top; text-align: center;">
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
                                <span style="font-weight: bold">Customer</span>
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