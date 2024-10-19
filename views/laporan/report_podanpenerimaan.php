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
        <table width="100%" style="text-align: center; padding: 5px; margin-top: 5px; border-radius: 4px; border: thin solid grey;">
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: bold">LAPORAN PO dan PENERIMAAN SPAREPART</span>
                </td>

            </tr>
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?> &nbsp; s/d &nbsp; <?php echo $tglakhir ?> </span>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px; margin-top: 5px;">

            <tbody>

                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                    <th style="width: 30px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nomor PO</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl PO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Keterangan PO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Supplier</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">DPP</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">PPN</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total PO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nomor Penerimaan</span>
                    </th>
                    <th style="text-align: center; ;">
                        <span style="font-weight: bold">Tglterima</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Invoice</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl Invoice</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">DPP INV</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">PPn INV</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total INV</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Uang Muka</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nilai Pembayaran</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl Lunas</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status PO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status INV</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status Bayar</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">LT Invoice</span>
                    </th>
                </tr>
                <?php $no = 1;
                foreach ($report_faktur as $row) : ?>

                    <tr style="line-height: 1 em; ">
                        <td style="width: 30px; text-align: center; ">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                        </td>
                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->namasupplier ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->dpp) ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->ppn)   ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->nopenerimaan ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo ($row->tglterima) ?></span>
                        </td>

                        <td style="text-align: center; ">
                            <span style="font-weight: normal"><?php echo $row->noinvoice ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo ($row->tglinvoice) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->dppiv) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->ppniv) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->totaliv) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaibayar) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo ($row->tgllunas) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo ($row->statuspo) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo ($row->statusiv) ?></span>
                        </td>

                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo ($row->statusbayar) ?></span>
                        </td>
                        <td style="text-align: right; ">
                            <span style="font-weight: normal"><?php echo ($row->leadtime_iv) ?></span>
                        </td>
                    </tr>

            </tbody>

        <?php endforeach ?>

        </table>

    </div>
</body>