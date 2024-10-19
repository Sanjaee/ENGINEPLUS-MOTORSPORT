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
            /* line-height: 0.4cm; */
        }

        .header {
            margin-left: 300px;
        }

        .content {
            color: BLACK;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            /* line-height: 1.0em; */
            /* page-break-before: always; */
        }

        .content-detail {
            color: BLACK;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 0.9em;
            /* page-break-inside: always; */
        }

        .footer {

            /** Extra personal styles **/
            font-family: helvetica;
            color: BLACK;
            text-align: center;
            /* line-height: 0.5cm; */
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
                <?php foreach ($closewo as $cell) : ?>
                    <?php if ($cell->perusahaan == 'AUTOBOT TOWING CAR') { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_atb.png" style="width: 200px; height: auto;">
                        </td>
                    <?php } else if ($cell->perusahaan == 'KARYA SINAR SEMESTA') { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_kss.png" style="width: 120px; height: auto;">
                        </td>
                    <?php } else { ?>
                        <td width="60%" style="vertical-align: top;">
                            <img src="./assets/img/logo_egp.png" style="width: 200px; height: auto;">
                        </td>
                    <?php } ?>

                    <td width="40%" style="vertical-align: top;">
                        <span style="color: #000000; font-size: 12px; font-weight: bold; display: block;"> <?php echo $cell->perusahaan ?> </span>
                        <br>
                        <span><?php echo $cell->alamatperusahaan ?></span>
                    <?php endforeach ?>
                    </td>
            </tr>
        </table>
    </div>
    <!-- separator -->

    <div class="content">
        <table width="100%" style="padding-top: 5px; padding-left: 10px">
            <tr>
                <?php foreach ($closewo as $cell) : ?>
                    <td width="75%">
                        <span style="font-weight: bold; font-size: 12;">Dokumen Close WO No.&nbsp;<?php echo $cell->nomor ?></span>
                    </td>

                    <td width="25%">
                        <span style="font-weight: bold">Tanggal</span>
                        &nbsp;&nbsp;&nbsp;
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->tanggal ?></span>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>
    </div>


    <!-- Content Data -->
    <div class="content-detail">
        <?php foreach ($closewo as $cell) : ?>
            <table width="100%" style="padding: 5px; margin-top: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                <tr>
                    <td style="width: 95px;">
                        <span style="font-weight: bold">No Polisi</span>
                    </td>

                    <td style="width: 200px;">
                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nopolisi ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 95px;">
                        <span style="font-weight: bold">Tipe Mobil</span>
                    </td>

                    <td style="width: 200px;">
                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->jenismobil ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="font-weight: bold">Pemilik/Customer</span>
                    </td>
                    <td>
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->nama ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <div>
                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->alamat ?></span>
                            <br>
                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->nohp ?></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>

                        <span style="font-weight: bold;">Nama PIC</span>
                    </td>
                    <td>
                        <div>
                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->namapic ?></span>
                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->nohppic ?></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>

                        <span style="font-weight: bold;">Tanggal Masuk</span>
                    </td>
                    <td>
                        <div>
                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->tglmasuk ?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>

                        <span style="font-weight: bold;">Tanggal Dikerjakan</span>
                    </td>
                    <td>
                        <div>
                            <span style="color: #000000; font-weight: normal;"><?php echo $cell->tglkerja ?></span>
                        </div>
                    </td>
                </tr>
            </table>
            <!-- </td> -->
        <?php endforeach ?>
        <!-- </table> -->
    </div>

    <div class="content-detail">
        <table width="100%" style="margin-top: 3px; border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(93, 93, 253, 0.5);">
                <th style="width: 100px; text-align: center;">
                    <span style="font-weight: bold;">JASA</span>
                </th>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(93, 93, 253, 0.2); ">
                <th style="width: 30px; text-align: center;">
                    <span style="font-weight: bold">No.</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Kode Pekerjaan</span>
                </th>
                <th style="width: 300px; text-align: center;">
                    <span style="font-weight: bold">Nama Pekerjaan</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Harga</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Qty</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Subtotal</span>
                </th>
            </tr>

            <?php foreach ($detailwo as $list) : ?>
                <tr>
                    <td width="100%" style="vertical-align: top;"></td>
                    <td style="text-align: left;" colspan="5">
                        <span style="font-weight: bold;  text-transform: uppercase;"><?php echo $list->kategori ?></span>
                    </td>
                </tr>

                <?php $kategori = $list->kategori; ?>
                <?php
                $detail = $this->db->query("SELECT * FROM cari_dataspkuntukinvoice WHERE nospk = '" . $list->nospk . "' and kategori = '" . $kategori . "' and jenis <> 1 order by subtotal desc")->result();
                ?>
                <?php $no = 1;
                foreach ($detail as $rox) : ?>
                    <?php if ($rox->kategori == $kategori) { ?>
                        <?php
                        $detailx = $this->db->query("SELECT ejd.* FROM trnt_entryjasadetail ejd left join trnt_entryjasa ej on ej.no_wo = ejd.nomor WHERE ejd.nomor = '" . $rox->nospk . "' and ejd.kode_jasahead = '" . $rox->kodepart . "' and ej.batal = false")->result();
                        ?>
                        <tr>
                            <td style="width: 30px; text-align: center;vertical-align: top;">
                                <span style="font-weight: normal"><?php echo $no++ ?></span>
                            </td>

                            <td style="text-align: left; vertical-align: top;">
                                <span style="font-weight: normal"><?php echo $rox->kodepart ?></span>
                            </td>

                            <td style="width: 300px; text-align: left;">
                                <span style="font-weight: normal"><?php echo $rox->nama ?></span>
                            </td>

                            <td style="text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($rox->subtotal) ?></span>
                            </td>

                            <td style="text-align: center;">
                                <span style="font-weight: normal">1</span>
                            </td>

                            <td style="text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($rox->subtotal) ?></span>
                            </td>
                        </tr>

                        <?php foreach ($detailx as $roz) : ?>
                            <tr>
                                <td style="text-align: right;" colspan="2">
                                    <span style="font-weight: normal">-</span>
                                </td>
                                <td style="text-align: left;" colspan="4">
                                    <span style="font-weight: normal"><?php echo $roz->nama_jasa ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>

                        <?php if (!empty($detailx)) { ?>
                            <tr>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                            </tr>
                        <?php } ?>

                    <?php } ?>
                <?php endforeach ?>
                <tr>
                    <td style="padding-bottom: 15px; text-align: right; font-style: italic; border-bottom: thin dashed #cccccc;" colspan="5">
                        <span style="font-weight: bold"><?php echo $list->kategori ?> Subtotal </span>
                    </td>
                    <td style="padding-bottom: 15px; text-align: right; font-style: italic; border-bottom: thin dashed #cccccc;" colspan="1">
                        <span style="font-weight: bold"><?php echo rupiah($list->total) ?></span>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>

    <div class="content-detail">
        <table width="100%" style="margin-top: 3px; border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(93, 93, 253, 0.5);">
                <th style="width: 100px; text-align: center;">
                    <span style="font-weight: bold;">Spareparts</span>
                </th>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(93, 93, 253, 0.2); ">
                <th style="width: 30px; text-align: center;">
                    <span style="font-weight: bold">No.</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Kode Part</span>
                </th>
                <th style="width: 300px; text-align: center;">
                    <span style="font-weight: bold">Nama Part</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Harga</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Qty</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Subtotal</span>
                </th>
            </tr>

            <?php foreach ($detailpart as $list) : ?>
                <tr>
                    <td width="100%" style="vertical-align: top;"></td>
                    <td style="text-align: left;" colspan="5">
                        <span style="font-weight: bold;  text-transform: uppercase;"><?php echo $list->kategori ?></span>
                    </td>
                </tr>

                <?php $kategori = $list->kategori; ?>
                <?php
                $detail = $this->db->query("SELECT * FROM cari_dataspkuntukinvoice WHERE nospk = '" . $list->nospk . "' and kategori = '" . $kategori . "' and jenis = 1 order by subtotal desc ")->result();
                ?>
                <?php $no = 1;
                foreach ($detail as $rox) : ?>

                    <tr>
                        <td style="width: 30px; text-align: center;vertical-align: top;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: left;vertical-align: top;">
                            <span style="font-weight: normal"><?php echo $rox->kodepart ?></span>
                        </td>

                        <td style="width: 300px; text-align: left;">
                            <span style="font-weight: normal"><?php echo $rox->nama ?> <?php if ($rox->kategoridetail != '-') { ?><?php echo $rox->kategoridetail ?> <?php } ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: normal"><?php echo rupiah($rox->harga) ?></span>
                        </td>

                        <td style="text-align: center;">
                            <span style="font-weight: normal"><?php echo $rox->qty ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: normal"><?php echo rupiah($rox->subtotal) ?></span>
                        </td>
                    </tr>
                <?php endforeach ?>

                <tr>
                    <td style="padding-bottom: 15px; text-align: right; font-style: italic; border-bottom: thin dashed #cccccc;" colspan="5">
                        <span style="font-weight: bold"><?php echo $list->kategori ?> Subtotal </span>
                    </td>
                    <td style="padding-bottom: 15px; text-align: right; font-style: italic; border-bottom: thin dashed #cccccc;" colspan="1">
                        <span style="font-weight: bold"><?php echo rupiah($list->total) ?></span>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>


    <div class="content-detail">
        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
            <tr style="background-color: rgba(93, 93, 253, 0.5);">
                <th style="text-align:center;">
                    <span style="font-weight: bold">Total Jasa</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Total Part</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Grand Total</span>
                </th>
            </tr>

            <?php foreach ($totalwo as $cell) : ?>
                <tr>
                    <td style="text-align: right;">
                        <span style="font-weight: bold"><?php echo rupiah($cell->totaljasa) ?></span>
                    </td>
                    <td style="text-align: right;">
                        <span style="font-weight: bold"><?php echo rupiah($cell->totalpart) ?></span>
                    </td>
                    <td style="text-align: right;">
                        <span style="font-weight: bold"><?php echo rupiah($cell->totalpart + $cell->totaljasa) ?></span>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>

        <table width="100%" style="margin-top: 5px;">
            <?php foreach ($closewo as $cell) : ?>
                <td width="50%" style="vertical-align: top;">

                    <table width="100%" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                        <tr>
                            <td style="width: 50px;">
                                <span style="font-weight: bold">Keterangan</span>
                            </td>
                            <td style="width: 120px;">
                                <span style="color: #000000; font-weight: normal;"><?php echo $cell->keterangan ?></span>
                            </td>
                        </tr>
                    </table>
                </td>
            <?php endforeach ?>
        </table>

    </div>
    <div class="footer">
        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Dibuat Service Advisor</span>
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
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Check Sparepart</span>
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
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Check Foreman</span>
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
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Disetujui Pimpinan</span>
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