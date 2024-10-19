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

<body>
    <div class="content">
        <table width="100%" style="border-radius: 4px; border: thin solid grey; margin-top: 5px;">
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <table width="100%" style="text-align: center; padding: 5px; ">

                        <tr>
                            <td>
                                <span style="font-size: 10; font-weight: bold">LAPORAN WO HARIAN OPEN</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?> &nbsp; s/d &nbsp; <?php echo $tglakhir ?> </span>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; ">
            <tbody style="border: thin solid grey; border-radius: 4px;">
                <tr style="background-color: rgba(242, 242, 242, 0.74); ">
                    <th style="width: 30px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No WO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Polisi</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Customer</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tipe</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Kategori</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Keluhan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Keterangan</span>
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
                        <span style="font-weight: bold">Total UM</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Sisa UM</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jenis Service</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">SA</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status WO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status Pembebanan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">PM</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Posisi Kendaraan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status Kendaraan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jenis Customer</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($report_spk as $row) : ?>

                    <tr style="line-height: 0.5 cm; ">
                        <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nospk ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->status ?></span>
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
                            <span style="font-weight: normal"><?php echo $row->kategori ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->keluhan ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpart) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totaljasa) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalopl) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaispk) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->sisaum) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal; "><?php echo $row->tanggal ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal; "><?php echo $row->jenisservice ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal; "><?php echo $row->pemakai ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal; "><?php echo $row->statuswo ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal; "><?php echo $row->statuspart ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal; "><?php echo $row->projectmanager ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal; "><?php echo $row->statuskendaraan ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statuspekerjaanmobil ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->jeniscustomer ?></span>
                        </td>

                    </tr>

                <?php endforeach ?>

            </tbody>
        </table>

        <table width="100%" style="margin-top: 5px;">
            <td width="70%" style="vertical-align: top;">

            </td>

            <td width="30%" style="vertical-align: top;">
                <table width="100%" style="font-size: 10; padding: 10px; margin-top: 5px; border-radius: 4px; border: thin solid grey;">
                    <tr>
                        <td>
                            <span style="font-weight: bold;">Total Nilai WO :</span>
                        </td>

                        <?php foreach ($totalsum as $cell) : ?>

                            <td>
                                <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->totalnilaispk) ?>,-</span>
                            </td>
                            <!-- <?php endforeach ?> -->
                    </tr>
                </table>
            </td>
        </table>

    </div>
</body>