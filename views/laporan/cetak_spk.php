<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        <?php echo SITE_NAME . " : " . ucfirst($this->uri->segment(1)) . " - " . ucfirst($this->uri->segment(2)) ?>
    </title>

    <style type="text/css">
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
            color: black;
            font-size: 11px;
            line-height: 0.4cm;
        }

        .header {
            margin-left: 300px;
        }

        .content {
            color: black;
            font-family: helvetica;
            font-size: 11px;
            line-height: 0.4cm;
        }

        .content-jasa {
            color: black;
            font-family: helvetica;
            font-size: 11px;
            line-height: 1.0em;
        }

        .content-part {
            color: black;
            font-family: helvetica;
            font-size: 11px;
            line-height: 1.0em;
        }

        .footer {
            font-family: helvetica;
            color: black;
            font-size: 11px;
            line-height: 1.0em;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
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
    <div class="nav-bar">
        <table width="100%" style="padding-bottom: 10px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <?php foreach ($spk as $cell) : ?>
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

    <div class="content">
        <table width="100%" style="padding-top: 5px; padding-left: 10px">
            <tr>
                <?php foreach ($spk as $cell) : ?>
                    <td width="70%">
                        <span style="font-weight: bold; font-size: 12;">Perintah Kerja Bengkel No.&nbsp;<?php echo $cell->nomorspk ?></span>
                    </td>

                    <td width="30%">
                        <span style="font-weight: bold">Tanggal Cetak</span>
                        &nbsp;&nbsp;&nbsp;
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->tanggal ?></span>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>

        <table width="100%" style="padding-top: 0px;">
            <tr style="border: 1px solid;">
                <?php foreach ($spk as $cell) : ?>
                    <td width="60%" style="vertical-align: top;">
                        <table width="100%" style="padding-left: 10px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr>
                                <td style="width: 90px;">
                                    <span style="font-weight: bold">No Pol</span>
                                </td>

                                <td style="width: 200px;">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->nopolisi ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 90px;">
                                    <span style="font-weight: bold">Model / Tipe</span>
                                </td>

                                <td style="width: 200px;">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->jenismobil ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 95px;">
                                    <span style="font-weight: bold">Tgl Estimasi Selesai</span>
                                </td>
                                <td style="width: 200px;">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->tglestimasi ?></span>
                                </td>

                            </tr>
                        </table>

                        <table width="100%" style="padding-left: 10px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr>
                                <td style="width: 60px;">
                                    <span style="font-weight: bold">Keluhan</span>
                                </td>

                                <td style="width: 50px;">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->keluhan ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 60px;">
                                    <span style="font-weight: bold">Teknisi</span>
                                </td>

                                <td style="width: 127px;">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->kode_teknisi ?> - <?php echo $cell->nama_teknisi ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 60px;">
                                    <span style="font-weight: bold">Jenis Service</span>
                                </td>

                                <td style="width: 127px;">
                                    <span style="color: #000000; font-weight: normal;">
                                        <?php if ($cell->jenisservice == "0") {
                                            echo "Service Berkala Int";
                                        } else if ($cell->jenisservice == "1") {
                                            echo "Service Berkala Ext";
                                        } else if ($cell->jenisservice == "2") {
                                            echo "General Repair";
                                        } else if ($cell->jenisservice == "3") {
                                            echo "Express Maintenance";
                                        } else if ($cell->jenisservice == "4") {
                                            echo "Custom";
                                        } else if ($cell->jenisservice == "5") {
                                            echo "Turbo Kit dan Balap";
                                        } else if ($cell->jenisservice == "6") {
                                            echo "Towing";
                                        } else if ($cell->jenisservice == "7") {
                                            echo "Outsource KSS";
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 60px;">
                                    <span style="font-weight: bold">Return Job</span>
                                </td>

                                <td style="width: 127px;">
                                    <span style="color: #000000; font-weight: normal;">
                                        <?php if ($cell->returnjob == "t") {
                                            echo "Yes";
                                        } else if ($cell->returnjob == "f") {
                                            echo "No";
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 60px;">
                                    <span style="font-weight: bold">Warranty</span>
                                </td>

                                <td style="width: 127px;">
                                    <span style="color: #000000; font-weight: normal;">
                                        <?php if ($cell->garansi == "t") {
                                            echo "Yes";
                                        } else if ($cell->garansi == "f") {
                                            echo "No";
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td width="40%" style="vertical-align: top;">
                        <table width="100%" style="height: 122px; border-radius: 4px; border: thin dashed #cccccc; padding-bottom: 20px; padding-left: 10px;">
                            <tr>
                                <td>
                                    <span style="font-weight: normal">Diterbitkan atas nama</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span style="font-weight: bold">Pemilik/Customer</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span style="color: #000000; font-weight: bold;"><?php echo $cell->nama_customer ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div>
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->alamat ?></span>
                                        <br>
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->pic ?></span> -
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->nohppic ?> / <?php echo $cell->notlp ?></span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>
    </div>

    <div class="content-jasa">
        <table width="100%" style="margin-top: 3px; border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(93, 93, 253, 0.5);">
                <th style="width: 100px; text-align: center;">
                    <span style="font-weight: bold;">ESTIMASI JASA</span>
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
                <th style="width: 180px; text-align: center;">
                    <span style="font-weight: bold">Nama Pekerjaan</span>
                </th>

                <th style="text-align: center;">
                    <span style="font-weight: bold">Qty</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Harga</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Subtotal</span>
                </th>
            </tr>

            <?php foreach ($spksub as $list) : ?>
                <tr>
                    <td width="100%" style="vertical-align: top;"></td>
                    <td style="text-align: left;" colspan="5">
                        <span style="font-weight: bold;  text-transform: uppercase;"><?php echo $list->kategori ?></span>
                    </td>
                </tr>

                <?php $kategori = $list->kategori; ?>
                <?php $no = 1;
                foreach ($spkjasa as $row) : ?>
                    <?php if ($row->kategorix == $kategori) { ?>
                        <?php
                        $detail = $this->db->query("SELECT ejd.* FROM trnt_entryjasadetail ejd left join trnt_entryjasa ej on ej.no_wo = ejd.nomor WHERE ejd.nomor = '" . $row->nomorwo . "' and ejd.kode_jasahead = '" . $row->kodereferensi . "' and ej.batal = false")->result();
                        ?>

                        <tr>
                            <td style="width: 30px; text-align: center;">
                                <span style="font-weight: normal"><?php echo $no++ ?></span>
                            </td>

                            <td style="text-align: left;">
                                <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                            </td>

                            <td style="width: 180px; text-align: left;">
                                <span style="font-weight: normal"><?php echo $row->namareferensi ?> <?php if ($row->kategori != '-') { ?> <?php echo $row->kategori ?> <?php } ?></span>
                            </td>

                            <td style="text-align: center;">
                                <span style="font-weight: normal">1</span>
                            </td>

                            <td style="text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                            </td>


                            <td style="text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                            </td>
                        </tr>

                        <?php foreach ($detail as $rox) : ?>
                            <tr>
                                <td style="text-align: right;" colspan="2">
                                    <span style="font-weight: normal">-</span>
                                </td>
                                <td style="text-align: left;" colspan="4">
                                    <span style="font-weight: normal"><?php echo $rox->nama_jasa ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
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

    <div class="content-part">
        <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(93, 93, 253, 0.5);">
                <th style="width: 100px; text-align: center;">
                    <span style="font-weight: bold;">ESTIMASI PART</span>
                </th>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(93, 93, 253, 0.2);">
                <th style="width: 30px; text-align: center;">
                    <span style="font-weight: bold">No.</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Kode Part</span>
                </th>
                <th style="width: 200px; text-align: center;">
                    <span style="font-weight: bold">Nama Part</span>
                </th>

                <th style="text-align: center;">
                    <span style="font-weight: bold">Qty</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Harga</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Subtotal</span>
                </th>
            </tr>

            <?php foreach ($spksubpart as $listx) : ?>
                <tr>
                    <td width="100%" style="vertical-align: top;"></td>
                    <td style="text-align: left;" colspan="5">
                        <span style="font-weight: bold; text-transform: uppercase;"><?php echo $listx->kategoripart ?></span>
                    </td>
                </tr>

                <?php $kategoripart = $listx->kategoripart; ?>
                <?php $no = 1;
                foreach ($spkpart as $row) : ?>
                    <?php if ($row->kategoripart == $kategoripart) { ?>
                        <tr>
                            <td style="width: 30px; text-align: center;">
                                <span style="font-weight: normal"><?php echo $no++ ?></span>
                            </td>

                            <td style="text-align: left;">
                                <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                            </td>

                            <td style="width: 200px; text-align: left;">
                                <span style="font-weight: normal"><?php echo $row->namareferensi ?> <?php echo $row->kategori ?></span>
                            </td>

                            <td style="text-align: center;">
                                <span style="font-weight: normal"><?php echo $row->qty ?></span>
                            </td>

                            <td style="text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                            </td>


                            <td style="text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                            </td>
                        </tr>
                    <?php } ?>
                <?php endforeach ?>

                <tr>
                    <td style="padding-bottom: 15px; font-style: italic; text-align: right; border-bottom: thin dashed #cccccc;" colspan="5">
                        <span style="font-weight: bold"><?php echo $listx->kategoripart ?> Subtotal </span>
                    </td>
                    <td style="padding-bottom: 15px; font-style: italic; text-align: right; border-bottom: thin dashed #cccccc;" colspan="1">
                        <span style="font-weight: bold"><?php echo rupiah($listx->total) ?></span>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>

    <div class="footer">
        <table width="100%" style="margin-top: 3px;">
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Kategori Jasa</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Total</span>
                            </th>
                        </tr>

                        <?php foreach ($spksub as $cell) : ?>
                            <tr>
                                <td style="text-align: left;">
                                    <span style="font-weight: bold"><?php echo $cell->kategori ?></span>
                                </td>
                                <td style="text-align: right;">
                                    <span style="font-weight: bold"><?php echo rupiah($cell->total) ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>

                <td width="50%" style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Kategori Part</span>
                            </th>
                            <th style="text-align: center;">
                                <span colspan="2" style="font-weight: bold">Total</span>
                            </th>
                        </tr>

                        <?php foreach ($spksubpart as $cellx) : ?>
                            <tr>
                                <td style="text-align: left;">
                                    <span style="font-weight: bold"><?php echo $cellx->kategoripart ?></span>
                                </td>
                                <td style="text-align: right;">
                                    <span colspan="2" style="font-weight: normal"><?php echo rupiah($cellx->total) ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
            <tr style="background-color: rgba(93, 93, 253, 0.5);">
                <th style="text-align: center; width: 50%;">
                    <span style="font-weight: bold">Total Jasa</span>
                </th>
                <th style="text-align: center;">
                    <span style="font-weight: bold">Total Part</span>
                </th>
            </tr>

            <?php foreach ($spk as $cell) : ?>
                <tr>
                    <td style="text-align: right;">
                        <span style="font-weight: bold"><?php echo rupiah($cell->totaljasa) ?></span>
                    </td>
                    <td style="text-align: right;">
                        <span style="font-weight: bold"><?php echo rupiah($cell->totalpart) ?></span>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>

        <table width="100%" style="vertical-align: top;">
            <tr>
                <td width="100%">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
                            <th style="width: 230px; text-align: center;">
                                <span style="font-weight: bold">DPP</span>
                            </th>
                            <th style="width: 230px; text-align: center;">
                                <span style="font-weight: bold">PPN</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">Grand Total</span>
                            </th>
                        </tr>

                        <?php $no = 1;
                        foreach ($spk as $cell) : ?>
                            <tr>
                                <td style="text-align: center;">
                                    <span style="font-weight: bold"><?php echo rupiah($cell->dpp) ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <span style="font-weight: bold"><?php echo rupiah($cell->ppn) ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <span style="font-weight: bold"><?php echo rupiah($cell->grandtotal) ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>
            </tr>
        </table>

        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Teknisi</span>
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
                                <span style="font-weight: bold">Service Advisor</span>
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
                                <span style="font-weight: bold">Customer</span>
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

</html>