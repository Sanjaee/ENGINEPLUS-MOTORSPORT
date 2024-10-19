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
                                <span style="font-size: 10; font-weight: bold">LAPORAN STATUS PEKERJAAN</span>
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
                        <span style="font-weight: bold">Nomor WO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Polisi</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Customer</span>
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
                        <span style="font-weight: bold">Teknisi</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Foreman</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Kode Jasa</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Jasa</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jam</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Estimasi Harga</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status Pekerjaan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Indikator Pekerjaan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Indikator Summary</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($report_spk as $row) : ?>

                    <tr style="line-height: 0.5 cm; ">
                        <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->status ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->namacustomer ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->jenismobil ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->namatipe ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->keluhan ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nama_teknisi ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nama_foreman ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->namareferensi ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statuspekerjaan ?></span>
                        </td>
                        
                        <?php if ($row->statuspekerjaan == 'TUNGGU DIKERJAKAN') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: bold; font-size: 40px; color: red;">&bull;</span>
                            </td>
                        <?php } else if ($row->statuspekerjaan == 'SEDANG DIKERJAKAN') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: bold; font-size: 40px; color: yellow;">&bull;</span>
                            </td>
                        <?php } else if ($row->statuspekerjaan == 'SELESAI DIKERJAKAN') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: bold; font-size: 40px; color: green;">&bull;</span>
                            </td>
                        <?php } else if ($row->statuspekerjaan == 'BATAL') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: bold; font-size: 40px; color: grey;">&bull;</span>
                            </td>
                        <?php } ?>
                        
                        <!-- <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statussum ?></span>
                        </td> -->

                        <?php if ($row->statussum == 'Tunggu Dikerjakan') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: bold; font-size: 40px; color: red;">&bull;</span>
                            </td>
                        <?php } else if ($row->statussum == 'Sedang Dikerjakan') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: bold; font-size: 40px; color: yellow;">&bull;</span>
                            </td>
                        <?php } else if ($row->statussum == 'Selesai Dikerjakan') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: bold; font-size: 40px; color: green;">&bull;</span>
                            </td>
                        <?php } else if ($row->statussum == 'Batal') { ?>
                            <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: bold; font-size: 40px; color: grey;">&bull;</span>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>