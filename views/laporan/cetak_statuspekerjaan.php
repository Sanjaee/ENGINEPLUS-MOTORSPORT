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
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>

<body>
    <!-- header -->
    <div class="nav-bar">
        <table width="100%" style="margin-top: 5px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <table width="100%" style="padding: 10px; margin-top: 5px;">
                        <tr>
                            <td>
                                <img src="./assets/img/logo_egp.png" style="width: 200px; height: auto;">
                            </td>
                        </tr>
                    </table>
                </td>

                <td width="50%" style="vertical-align: top;">
                    <?php foreach ($spk as $cell) : ?>
                        <table width="100%" style="margin-top: 5px; ">
                            <tr>
                                <td style="padding-bottom: 20px; padding-left: 30px;">
                                    <span style="color: #000000; font-size: 12px; font-weight: bold; display: block;"> <?php echo $cell->perusahaan ?> </span>
                                    <br>
                                    <div>
                                        <?php echo $cell->alamatperusahaan ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    <?php endforeach ?>
                </td>
            </tr>
        </table>

        <div>
            <table width="100%" style="margin-top: 5px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
                <tr>
                    <?php foreach ($spk as $cell) : ?>

                        <table width="100%" style="padding: 10px; margin-top: 5px;">
                            <tr>
                                <td>
                                    <span style="font-weight: bold; font-size: 12;">Status Perkerjaan No. &nbsp;&nbsp;&nbsp; <?php echo $cell->nomorspk ?></span>
                                </td>
                                <td>
                                    <span style="font-weight: bold">Tanggal</span>
                                </td>
                                <td>
                                    <span style="color: #000000; font-weight: bold;"><?php echo $cell->tanggal ?></span>
                                </td>
                            </tr>
                        </table>

                    <?php endforeach ?>
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
                        <td width="60%" style="vertical-align: top;">
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
                                        <span style="font-weight: bold">Model / Tipe</span>
                                    </td>
                                    <td colspan="2">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->jenismobil ?></span>
                                    </td>

                                </tr>
                            </table>

                            <table width="100%" style="margin-top: 5px; padding-left: 10px; border-radius: 4px; border: thin dashed #cccccc;">

                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">Keluhan</span>
                                    </td>

                                    <td style="width: 200px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->keluhan ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 60px;">
                                        <span style="font-weight: bold">Teknisi</span>
                                    </td>

                                    <td style="width: 200px;">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->kode_teknisi ?> - <?php echo $cell->nama_teknisi ?></span>
                                    </td>
                                </tr>
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

                                </tr>
                            </table>

                        </td>

                        <td width="40%" style="vertical-align: top;">
                            <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc; padding-bottom: 0px; padding-left: 30px;">
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
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->pic ?></span> -
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

        <div>
            <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                    <th style="width: 100px; text-align: center;">
                        <span style="font-weight: bold">Detail Pekerjaan</span>
                    </th>
                </tr>
            </table>

            <!-- <td width="100%" style="vertical-align: top;"> -->
            <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                    <th style="width: 30px; text-align: center;">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Jenis Data</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Kode Pekerjaan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Nama Pekerjaan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Status Pekerjaan</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($spkjasa as $row) : ?>

                    <tr>
                        <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>
                        <td style="width: 100px; text-align: left; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->status ?></span>
                        </td>
                        <td style="width: 100px; text-align: left; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                        </td>
                        <td style="text-align: left; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->namareferensi ?></span>
                        </td>
                        <?php if ($row->vstatus == '0') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin dashed #cccccc;">
                                <span style="font-weight: bold; font-size: large; color: red;">&bull;</span>
                            </td>
                        <?php } else if ($row->vstatus == '1') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin dashed #cccccc;">
                                <span style="font-weight: bold; font-size: large; color: yellow;">&bull;</span>
                            </td>
                        <?php } else if ($row->vstatus == '2') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin dashed #cccccc;">
                                <span style="font-weight: bold; font-size: large; color: green;">&bull;</span>
                            </td>
                        <?php } else if ($row->vstatus == '3') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin dashed #cccccc;">
                                <span style="font-weight: bold; font-size: large; color: grey;">&bull;</span>
                            </td>
                        <?php } ?>
                    </tr>

                <?php endforeach ?>

            </table>


            <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                <tr>
                    <td style="vertical-align: top;">
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
                    </td>

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

                    <!-- <td style="vertical-align: top;">
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
                    
                </td> -->



                    <td style="vertical-align: top;">
                        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Kepala Bengkel</span>
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