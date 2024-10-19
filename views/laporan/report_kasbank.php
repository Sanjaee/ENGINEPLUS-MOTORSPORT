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

<body>
    <div class="content">
        <table width="100%" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: thin solid grey;">
            <tr style="text-align: center;">
                <td>
                    <span style="font-size: 12; font-weight: bold;">LAPORAN KAS & BANK</span>
                </td>

            </tr>

            <tr style="text-align: center;">
                <td>
                    <span style="font-size: 10; font-weight: normal;">Periode &nbsp; : &nbsp; <?php echo $tglawal ?> &nbsp; s/d &nbsp; <?php echo $tglakhir ?> </span>
                </td>
            </tr>

            <tr style="text-align: center;">
                <td>
                    <span style="font-size: 10; font-weight: normal; padding-right: 20px;">COA  : <?php echo $nomor ?> </span>
                    <span style="font-size: 10; font-weight: normal;"><?php echo $nama ?>  </span>
                    
                </td>
            </tr>

            <tr style="text-align: center;">
                <td>
                    <span style="font-size: 10; font-weight: normal;">Tanggal Print &nbsp; : &nbsp; <?php echo date("d-m-Y"); ?> </span>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px; margin-top: 5px;">

            <tbody style="border: thin solid grey;">
                <tr style="background-color: rgba(242, 242, 242, 0.74); border-radius: 4px;">
                    <th style="width: 40px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Jenis</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">No. Voucher</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Keterangan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Debit</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Kredit</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($report_kas_bank as $row) : ?>
                    <tr style="line-height: 0.5 cm; ">
                        <td style="width: 40px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->jenis ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nomorbon ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo "Rp " . number_format($row->debit, 0, ',', '.') ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo "Rp " .  number_format($row->kredit, 0, ',', '.') ?></span>
                        </td>
                    </tr>
                <?php endforeach ?>

                <tr>
                    <td colspan="5" style="text-align: right;">
                        <span style="font-weight: bold;">Total </span>
                    </td>

                    <?php foreach ($sumkasbank as $r) : ?>
                        <td style="text-align: right;">
                            <span style="color: #000000; font-weight: bold;"><?php echo "Rp " . number_format($r->debit, 0, ',', '.') ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="color: #000000; font-weight: bold;"><?php echo "Rp " . number_format($r->kredit, 0, ',', '.') ?></span>
                        </td>
                    <?php endforeach ?>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: right;">
                        <span style="font-weight: bold;">Saldo Akhir </span>
                    </td>

                    <?php foreach ($sumkasbank as $rx) : ?>
                        <td style="text-align: right;">
                            <span style="color: #000000; font-weight: bold;"><?php echo "Rp " . number_format($rx->debit - $rx->kredit, 0, ',', '.') ?></span>
                        </td>
                    <?php endforeach ?>
                </tr>
            </tbody>
        </table>

        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <td style="vertical-align: top; padding-right: 10px;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Pembuat</span>
                            </th>
                        </tr>

                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                                <span style="font-weight: normal;"><?php echo $this->session->userdata('myusername'); ?></span>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top; padding-right: 10px;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Pemeriksa</span>
                            </th>
                        </tr>

                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top; ">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Menyetujui</span>
                            </th>
                        </tr>

                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
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