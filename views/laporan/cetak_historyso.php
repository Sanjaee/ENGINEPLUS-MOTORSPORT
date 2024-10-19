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


                        <table width="100%" style="padding: 10px; margin-top: 5px;">
                            <tr>
                                <td colspan="4">
                                    <span style="font-weight: bold; font-size: 12;">History Service Order</span><br /><br />
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>

        </div>

    </div>

    <!-- Content Data -->
    <div class="content">
        <?php $no = 1;
        foreach ($so as $cell) : ?>
            <br><br>
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
                                    <span style="font-weight: bold">No Rangka</span>
                                </td>
                                <td colspan="2">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->norangka ?></span>
                                </td>

                            </tr>

                            <tr>
                                <td style="width: 95px;">
                                    <span style="font-weight: bold">Nama Customer</span>
                                </td>
                                <td colspan="2">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->nama ?></span>
                                </td>

                            </tr>


                        </table>


                    <td width="40%" style="vertical-align: top;">
                        <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc; padding-bottom: 20px; padding-left: 30px;">
                            <tr>
                                <td style="width: 95px;">
                                    <span style="font-weight: bold">No Service Order</span>
                                </td>
                                <td colspan="2">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->nomorso ?></span>
                                </td>

                            </tr>

                            <tr>
                                <td style="width: 95px;">
                                    <span style="font-weight: bold">No Invoice</span>
                                </td>
                                <td colspan="2">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->nomorfaktur ?></span>
                                </td>

                            </tr>

                            <tr>
                                <td style="width: 95px;">
                                    <span style="font-weight: bold">Tgl Invoice</span>
                                </td>
                                <td colspan="2">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->tglfaktur ?></span>
                                </td>

                            </tr>
                        </table>
                    </td>

                    <table width="100%" style="margin-top: 5px; padding-left: 10px; border-radius: 4px; border: thin dashed #cccccc;">

                        <tr>
                            <td style="width: 60px; padding-bottom: 20px;">
                                <span style="font-weight: bold">Keluhan</span>
                            </td>

                            <td style="width: 200px;">
                                <span style="color: #000000; font-weight: normal;"><?php echo $cell->nama_regularcheck ?> - <?php echo $cell->keluhan ?></span>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 60px; padding-bottom: 20px;">
                                <span style="font-weight: bold">Saran</span>
                            </td>

                            <td style="width: 200px;">
                                <span style="color: #000000; font-weight: normal;"><?php echo $cell->saran ?></span>
                            </td>
                        </tr>

                    </table>
                    </td>
                </tr>
            </table>


            <?php
            $detail = $this->db->query("SELECT * FROM trnt_fakturdetail WHERE nomorfaktur = '" . $cell->nomorfaktur . "' ")->result();
            ?>

            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Detail Pekerjaan</span>
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
                                    <span style="font-weight: bold">Kode Jasa/Part</span>
                                </th>
                                <th style="width: 200px; text-align: center;">
                                    <span style="font-weight: bold">Nama Jasa/Part</span>
                                </th>
                                <!-- <th style="text-align: center;">
                                        <span style="font-weight: bold">Harga</span>
                                    </th> -->
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Jam/Qty</span>
                                </th>
                                <!-- <th style="text-align: center;">
                                        <span style="font-weight: bold">Subtotal</span>
                                    </th> -->
                                <!-- <th style="text-align: center;">
                                        <span style="font-weight: bold">Paraf Atasan</span>
                                    </th> -->
                            </tr>

                            <?php $no = 1;
                            foreach ($detail as $row) : ?>

                                <tr>
                                    <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $no++ ?></span>
                                    </td>
                                    <td style="text-align: left; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                                    </td>
                                    <td style="width: 200px; text-align: left; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->namareferensi ?></span>
                                    </td>
                                    <!-- <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                            <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                                        </td> -->
                                    <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo $row->qty ?></span>
                                    </td>
                                    <!-- <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                            <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                                        </td>
                                        <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                            <span style="font-weight: normal"></span>
                                        </td> -->
                                </tr>

                            <?php endforeach ?>
                        </table>
                    <?php endforeach ?>
                    </td>
                </tr>
            </table>
    </div>


</body>

</html>