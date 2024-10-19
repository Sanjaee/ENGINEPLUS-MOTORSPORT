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
                    <span style="font-size: 10; font-weight: bold">LAPORAN FAKTUR PARTCOUNTER</span>
                </td>

            </tr>
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?> &nbsp; s/d &nbsp; <?php echo $tglakhir ?> </span>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px; margin-top: 5px; border: thin solid grey;">
            <tbody>
                <tr style="background-color: rgba(242, 242, 242, 0.74);">
                    <th style="width: 30px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Faktur</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Order</span>
                    </th>
                    <!-- <th style="text-align: center; ">
                        <span style="font-weight: bold">No Polisi</span>
                    </th> -->
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Customer</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Kategori Part</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jenis Detail</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tipe Penjualan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Telp</span>
                    </th>
                    <th style="text-align: center; ;">
                        <span style="font-weight: bold">No HP</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">DPP</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">PPN</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Ongkir</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Kode Parts</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Parts</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Harga</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">% Disc</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Discount/Item</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Subtotal</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">COGS</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Margin</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Down Payment</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status Pembayaran</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl Lunas</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($report_faktur as $row) : ?>
                    <tr style="line-height: 1 em; ">
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
                            <span style="font-weight: normal"><?php echo $row->nomor_order ?></span>
                        </td>
                        
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tglorder ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nama_customer ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->kategorips ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->jenisdetail ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tipejual ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->notelp ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nohp ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->dpp) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->ppn) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->ongkir) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->kode_parts ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->namapart ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->persendiscperitem ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->discountperitem) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->cogs) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->margin) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statusbayar ?></span>
                        </td>
                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tgllunas ?></span>
                        </td>
                    </tr>
            </tbody>

        <?php endforeach ?>

        </table>

        <table width="100%" style="margin-top: 5px;">
            <td width="70%" style="vertical-align: top;">

            </td>

            <td width="30%" style="vertical-align: top;">
                <table width="100%" style="font-size: 10; padding: 5px; margin-top: 5px; border: thin solid grey;">
                    <tr>
                        <td>
                            <span style="font-weight: normal">Grand Total Faktur :</span>
                        </td>

                        <?php foreach ($totalsum as $cell) : ?>

                            <td>
                                <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->totalfaktur) ?>,-</span>
                            </td>
                            <!-- <?php endforeach ?> -->
                    </tr>
                </table>
            </td>
        </table>

    </div>
</body>