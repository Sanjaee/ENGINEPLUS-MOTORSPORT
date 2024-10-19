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
                    <?php if ($cell->kode_cabang == 'WKS' || $cell->kode_cabang == 'UPS' || $cell->kode_cabang == 'CAD' )  { ?>
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
                    <span style="font-weight: bold; font-size: 14;">INVOICE PART</span>
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
                    <th style="text-align: right;width: 80px;">
                        <span style="font-weight: bold">Harga</span>
                    </th>
                    <th style="text-align: right;width: 50px;">
                        <span style="font-weight: bold">Discount</span>
                    </th>
                    <!-- <th style="text-align: center;">
                                    <span style="font-weight: bold">Discount</span>
                                </th> -->
                    <th style="text-align: right;width: 80px;">
                        <span style="font-weight: bold">Subtotal</span>
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
                        <td style="text-align: right;width: 80px; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                        </td>
                        <td style="text-align: right;width: 50px; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo round($row->persendiscperitem) ?>%</span>
                        </td>
                        <!-- <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                        <span style="font-weight: normal"><?php echo rupiah($row->discountperitem) ?></span>
                                    </td> -->
                        <td style="text-align: right;width: 80px; border-bottom: thin dashed #cccccc;">
                            <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                        </td>
                    </tr>

                <?php endforeach ?>

            </table>
            <!-- </td>
                </tr>
            </table> -->
        </div>

        <?php foreach ($counter as $cell) : ?>

            <?php
            $detail = $this->db->query("
                SELECT nilaipenerimaan, to_char(p.tanggal,'DD Mon YYYY') as tanggal from trnt_penerimaan p 
                left join trnt_penerimaandetail pd on pd.nomorpenerimaan = p.nomor
                where p.jenistransaksi = '02' and p.batal = FALSE and noreferensi = '" . $cell->nomor_order . "'")->result();
            ?>
            <table width="100%" style="font-size: 10; padding: 5px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                <td width="50%" style="vertical-align: top; ">
                    <table width="100%">
                        <tr style="background-color: rgba(193, 193, 193);">
                            <th colspan="2" style="width: 100px; text-align: center;">
                                <span style="font-weight: bold;font-size: 11px;">Detail Uang Muka</span>
                            </th>
                        </tr>
                        <br>
                        <!-- <tr>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Tanggal</span>
                            </th>
                        
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Nilai Muka</span>
                            </th>
                        </tr> -->
                        <?php foreach ($detail as $rox) : ?>
                            <tr>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold;font-size: 11px;"><?php echo ($rox->tanggal) ?></span>
                                </th>
                                <th style="width: 100px; text-align: right;">
                                    <span style="font-weight: bold;font-size: 11px;">Rp. <?php echo number_format($rox->nilaipenerimaan) ?></span>
                                </th>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>
                <td width="50%" style="vertical-align: top;">
                    <table width="100%">
                        <tr style="background-color: rgba(193, 193, 193);">
                            <td colspan="2" style="text-align: right;">
                                <span style="font-weight: bold;font-size: 11px;">Total Invoice :</span>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td style="width: 70px;text-align: left;">
                                <span style="font-weight: bold;font-size: 11px;">DPP</span>
                            </td>
                            <td style="width: 50px;text-align: right;">
                                <span style="color: #000000; font-weight: bold; text-align: right;font-size: 11px;">Rp. <?php echo number_format($cell->dpp) ?>,-</span>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td style="width: 70px;text-align: left;">
                                <span style="font-weight: bold;font-size: 11px;">PPn (10%)</span>
                            </td>
                            <td style="width: 50px;text-align: right;">
                                <span style="color: #000000; font-weight: bold; text-align: right;font-size: 11px;">Rp. <?php echo number_format($cell->ppn) ?>,-</span>
                            </td>
                        </tr> -->

                        <tr>
                            <td style="width: 70px;text-align: left;">
                                <span style="font-weight: bold;font-size: 11px;">Total Uang Muka</span>
                            </td>
                            <td style="width: 50px;text-align: right;">
                                <span style="color: #000000; font-weight: bold; text-align: right;font-size: 11px;">Rp. <?php echo number_format($cell->nilaiuangmuka) ?>,-</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 70px;text-align: left;">
                                <span style="font-weight: bold;font-size: 11px;">Ongkir</span>
                            </td>
                            <td style="width: 50px;text-align: right;">
                                <span style="color: #000000; font-weight: bold; text-align: right;font-size: 11px;">Rp. <?php echo number_format($cell->ongkir) ?>,-</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 70px;text-align: left;">
                                <span style="vertical-align: top; font-weight: bold;font-size: 11px;">Grand Total</span>
                            </td>
                            <td style="width: 50px;text-align: right;">
                                <span style="color: #000000; font-weight: bold; text-align: right;font-size: 11px;">Rp. <?php echo number_format($cell->total) ?>,-</span>
                            </td>
                        </tr>
                        <?php if ($cell->kode_cabang == 'SPT') { ?>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <br>
                                    <span style="font-weight: bold; font-size: 11px;">BCA a/n OEY RENDI 4133043121</span>
                                </td>
                            </tr> 
                        <?php } else if ($cell->kode_cabang == 'UPS') { ?>
                            <td colspan="2" style="text-align: center;">
                                <br>
                                <span style="font-weight: bold; font-size: 11px;">Bank BCA 413-567-1313 a/n Oey Rendi</span>
                            </td>
                        <?php } else if ($cell->kode_cabang == 'WKS') { ?>
                            <td colspan="2" style="text-align: center;">
                                <br>
                                <span style="font-weight: bold; font-size: 11px;">Bank BCA 7167-005223 a/n Marcelina KCP Kota Kasablanka</span>
                            </td>
                        <?php } else { ?>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <br>
                                    <span style="font-weight: bold; font-size: 11px;">BCA PT Karya Berkat Semesta 6460-881313 KCP Griya Utama</span>
                                </td>
                            </tr>
                        <?php } ?>

                    </table>
                </td>
            <?php endforeach ?>
            </table>
    </div>

    <!-- <div class="footer">
        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(141, 181, 237);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Dibuat Oleh</span>
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
                        <tr style="background-color: rgba(141, 181, 237);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Diperiksa Oleh</span>
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
                        <tr style="background-color: rgba(141, 181, 237);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Diterima Oleh</span>
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
    </div> -->

</body>