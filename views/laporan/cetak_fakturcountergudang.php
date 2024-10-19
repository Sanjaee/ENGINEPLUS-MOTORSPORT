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
            font-family: helvetica;
            /** Extra personal styles **/
            color: BLACK;
            text-align: center;
            font-size: 10px;
            line-height: 1em;
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
            /* page-break-before: always; */
        }

        .content-detail {
            color: BLACK;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 1em;
            /* page-break-inside: always; */
        }

        .footer {

            /** Extra personal styles **/
            font-family: helvetica;
            color: BLACK;
            text-align: center;
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
    <!--- header --->
    <div class="nav-bar">
        <table width="100%" style="padding-bottom: 10px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <?php foreach ($counter as $cell) : ?>
                    <?php if ($cell->kode_cabang == 'WKS' || $cell->kode_cabang == 'UPS' || $cell->kode_cabang == 'CAD') { ?>
                        <td width="70%" style="vertical-align: top;">
                            <img src="./assets/img/logo_egp.png" style="width: 250px; height: auto;">
                        </td>
                    <?php } else { ?>
                        <td width="70%" style="vertical-align: top;">
                            <img src="./assets/img/logo_egp2.png" style="width: 250px; height: auto;">
                        </td>
                    <?php } ?>
                    <td width="30%" style="vertical-align: top;">
                        <span style="color: #000000; font-size: 14px; font-weight: bold; display: block;"> <?php echo $cell->nama ?> </span>
                        <span><?php echo $cell->alamat ?></span>
                    <?php endforeach ?>
                    </td>
            </tr>
        </table>

        <table width="100%" style="padding-top: 5px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <td width="100%" style="vertical-align: top; text-align: center;">
                    <span style="font-weight: bold; font-size: 14;">INVOICE PART GUDANG</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">

        <div>
            <table width="100%">
                <tr>
                    <?php foreach ($counter as $cell) : ?>
                        <?php if ($cell->kode_cabang == 'WKS') { ?>
                            <td width="50%" style="vertical-align: top;">
                                <table width="100%" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                    <tr>
                                        <td style="width: 95px;">
                                            <span style="font-weight: bold">No Invoice</span>
                                        </td>

                                        <td style="width: 200px;">
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->nomor ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 95px;">
                                            <span style="font-weight: bold">Tgl Invoice</span>
                                        </td>

                                        <td style="width: 200px;">
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->tanggal ?></span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="width: 70px;">
                                            <span style="font-weight: bold">Nomor Order</span>
                                        </td>

                                        <td style="width: 100px;">
                                            <span style="font-weight: normal;"><?php echo $cell->nomor_order ?></span>
                                        </td>

                                    </tr>
                                </table>

                            </td>
                            <td width="50%" style="vertical-align: top;">
                                <table width="100%" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                    <tr>
                                        <td style="width: 95px;">
                                            <span style="font-weight: bold">Nama Customer</span>
                                        </td>
                                        <td colspan="2">
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->nama_customer ?></span>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td style="width: 95px;">
                                            <span style="font-weight: bold">Alamat</span>
                                        </td>
                                        <td colspan="2">
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->alamat_customer ?></span>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td style="width: 95px;">
                                            <span style="font-weight: bold">No Telp / No HP</span>
                                        </td>
                                        <td colspan="2">
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->notelp ?> / <?php echo $cell->nohp ?></span>
                                        </td>

                                    </tr>
                                </table>
                            </td>
                        <?php } else { ?>
                            <td width="50%" style="vertical-align: top;">
                                <table width="100%" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                    <tr>
                                        <td style="width: 95px;">
                                            <span style="font-weight: bold">Customer</span>
                                        </td>
                                        <td colspan="2">
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->nama_customer ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 70px;">
                                            <span style="font-weight: bold">Nomor Order</span>
                                        </td>

                                        <td style="width: 100px;">
                                            <span style="font-weight: normal;"><?php echo $cell->nomor_order ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="50%" style="vertical-align: top;">
                                <table width="100%" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                                    <tr>
                                        <td style="width: 95px;">
                                            <span style="font-weight: bold">No Invoice</span>
                                        </td>

                                        <td style="width: 200px;">
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->nomor ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 95px;">
                                            <span style="font-weight: bold">Tgl Invoice</span>
                                        </td>

                                        <td style="width: 200px;">
                                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->tanggal ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        <?php } ?>
                    <?php endforeach ?>
                </tr>
            </table>
        </div>
        <div class="content-detail">
            <!-- <table width="100%">
                <tr>
                    <td width="100%" style="vertical-align: top;"> -->
            <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                <tr style="background-color: rgba(141, 181, 237);">
                    <th style="width: 20px; text-align: center;">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: left;width: 130px;">
                        <span style="font-weight: bold">Kode Part</span>
                    </th>
                    <th style="text-align: left;width: auto;">
                        <span style="font-weight: bold">Nama Part</span>
                    </th>
                    <th style="text-align: center;width: 30px;">
                        <span style="font-weight: bold">Qty</span>
                    </th>
                    <th style="text-align: center;width: 80px;">
                        <span style="font-weight: bold">Stock akhir</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($counterdetail as $row) : ?>

                    <tr>
                        <td style="width: 20px; text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>
                        <td style="text-align: left; border-bottom: thin dashed #cccccc;width: 130px;">
                            <span style="font-weight: normal"><?php echo $row->kode_parts ?></span>
                        </td>
                        <td style="text-align: left; border-bottom: thin dashed #cccccc;width: auto;">
                            <span style="font-weight: normal"><?php echo $row->nama ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->qty ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo $row->stockakhir ?></span>
                        </td>
                    </tr>

                <?php endforeach ?>

            </table>
        </div>
    </div>
</body>