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
            margin: 0.5cm 0.5cm;
        }

        .body {
            margin-top: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
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
                    <table width="100%" style="text-align: center; padding: 3px; ">
                        <tr>
                            <td>
                                <span style="font-size: 10; font-weight: bold">LAPORAN PEMBELIAN DAN PENJUALAN PART </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?> &nbsp; </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; border: thin solid grey; border-radius: 4px;">
            <tbody>
                <tr style="background-color: rgba(242, 242, 242, 0.74); ">
                    <th style="width: 30px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Kode Part</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Part</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Awal</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty P.list In</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty P.list Out</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Beli</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Retur Beli</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Pbebanan In</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Pbebanan Out</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>
                    
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Jual</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Retur Jual</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Opname</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Akhir</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Price Varian Beli</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Price Varian Jual</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($report_rekapitulasistockpart as $row) : ?>
                    <tr style="line-height: 0.25 cm; ">
                        <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->kode_parts ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nama_parts ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtyawal ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_awal) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pickinglistin ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pickinglistin) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pickinglistout ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pickinglistout) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pembelian ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pembelian) ?></span>
                        </td>


                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_returpembelian ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_returpembelian) ?></span>
                        </td>


                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypembebananin ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpembebananin) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypembebananout ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpembebananout) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypenjualan ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_penjualan) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_returpenjualan ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_returpenjualan) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_opname ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_opname) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_akhir ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->pricevariance) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->price_variancesales * -1) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_akhir) ?></span>
                        </td>
                    </tr>
                <?php endforeach ?>

                <tr>
                    <td colspan="3" style="text-align: center;">
                        <span style="font-weight: bold;">Grand Total </span>
                    </td>

                    <?php
                    $kodecabang = $this->session->userdata('mycabang');
                    $kodecompany = $this->session->userdata('mycompany');
                    $detail = $this->db->query("SELECT SUM(qtyawal) as qtyawal,SUM(total_awal) as total_awal,SUM(qty_pickinglistin) as qty_pickinglistin, 
                    SUM(total_pickinglistin) as total_pickinglistin, SUM(qty_pickinglistout) as qty_pickinglistout, SUM(total_pickinglistout) as total_pickinglistout,
                    SUM(qty_pembelian) as qty_pembelian, 
                    SUM(total_pembelian) as total_pembelian,SUM(qty_returpembelian) as qty_returpembelian,
                    SUM(total_returpembelian) as total_returpembelian, 
                    SUM(qtypembebananin) as qtypembebananin,SUM(totalpembebananin) as totalpembebananin,
                    SUM(qtypembebananout) as qtypembebananout,SUM(totalpembebananout) as totalpembebananout,
                    SUM(qtypenjualan) as qtypenjualan,SUM(total_penjualan) as total_penjualan,
                    SUM(qty_returpenjualan) as qty_returpenjualan,SUM(total_returpenjualan) as total_returpenjualan,  SUM(qty_opname) as qty_opname,SUM(total_opname) as total_opname,
                    SUM(qty_akhir) as qty_akhir,SUM(total_akhir) as total_akhir, SUM(pricevariance) as pricevariance,SUM(price_variancesales)*-1 as price_variancesales
                    FROM acc_vw_laporanpenjualandanpembelianpartbasegudang
                    WHERE kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND bln= '" . date('m', strtotime($tglmulai)) . "' AND thn = '" . date('Y', strtotime($tglmulai)) . "' ")->result();
                    ?>
                    <?php foreach ($detail as $row) : ?>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qtyawal ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_awal) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pickinglistin ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pickinglistin) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pickinglistout ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pickinglistout) ?></span>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_pembelian ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_pembelian) ?></span>
                        </td>

                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_returpembelian ?></span>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_returpembelian) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypembebananin ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpembebananin) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypembebananout ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpembebananout) ?></span>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qtypenjualan ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_penjualan) ?></span>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_returpenjualan ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_returpenjualan) ?></span>
                        </td>

                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_opname ?></span>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_opname) ?></span>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_akhir ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->pricevariance) ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->price_variancesales) ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_akhir) ?></span>
                        </td>

                    <?php endforeach ?>
                </tr>
            </tbody>
        </table>

        <!-- <table width="100%" style="margin-top: 5px;">
            <td width="70%" style="vertical-align: top;">
            </td>

            <td width="30%" style="vertical-align: top;">
                <table width="100%" style="font-size: 8; padding: 5px; margin-top: 0px; border-radius: 4px; border: thin solid grey;">
                    <tr>
                        <td>
                            <span style="font-weight: bold;">Grand Total &nbsp; :</span>
                        </td>

                        <?php foreach ($totalsumrekapitulasistockpart as $cell) : ?>
                            <td>
                                <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->grandtotal) ?>,-</span>
                            </td>
                        <?php endforeach ?>
                    </tr>
                </table>
            </td>
        </table> -->

        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Pembuat</span>
                                </th>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Memeriksa</span>
                                </th>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Menyetujui</span>
                                </th>
                            </tr>


                            <tr>
                                <td style="line-height: 2.5cm; text-align: center; ">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                                <td style="line-height: 2.5cm; text-align: center;">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                                <td style="line-height: 2.5cm; text-align: center;">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>