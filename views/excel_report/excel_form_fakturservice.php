<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<?php
function rupiah($angka)
{
    $hasil_rupiah = number_format($angka, 0, '.', ',');
    return $hasil_rupiah;
}
?>


<body>
    <div class="nav-bar">
        <table width="100%" style="border-radius: 4px; border-bottom: thin dashed #cccccc;">
            <tr>
                <td width="40%" style="vertical-align: top;">
                    <img src="./assets/img/logo_egp.png" style="width: 200px; height: auto;">
                </td>

                <td width="60%" style="vertical-align: top;">
                    <?php foreach ($faktur as $cell) : ?>
                        <br>
                        <span style="color: #000000; font-size: 14px; font-weight: bold; display: block;"> <?php echo $cell->perusahaan ?> </span>

                        <span style="color: #000000; font-size: 10px; font-weight: bold; display: block;"> <?php echo $cell->namapt ?> </span>

                        <span><?php echo $cell->alamatperusahaan ?></span>
                    <?php endforeach ?>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px;">
            <tr>
                <td width="100%" style="vertical-align: top; text-align: center;">
                    <span style="font-weight: bold; font-size: 14;">INVOICE SERVICE</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        <table width="100%" style="padding-left: 10px">
            <tr>
                <?php foreach ($faktur as $cell) : ?>
                    <td>
                        <span style="font-weight: bold; font-size: 10;">INVOICE NO. &nbsp; <?php echo $cell->nomor ?></span>
                    </td>

                    <td style="padding-left: 70px;"></td>

                    <td>
                        <span style="font-weight: bold">Tanggal</span>
                        &nbsp;&nbsp;&nbsp;
                        <span style="color: #000000; font-weight: bold;"><?php echo $cell->tanggal ?></span>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <?php foreach ($faktur as $cell) : ?>
                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="padding-left: 10px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr>
                                <td colspan="2">
                                    <span style="font-size: 10; font-weight: normal;">Dibebankan atas dokumen :</span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 10px;">
                                    <span style="font-weight: normal">Nomor WO</span>
                                </td>

                                <td style="width: 100px;">
                                    <span style="color: #000000;font-weight: normal;"><?php echo $cell->nomor_spk ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 10px;">
                                    <span style="font-weight: normal">Tanggal WO</span>
                                </td>

                                <td style="width: 100px;">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->tanggal_spk ?></span>
                                </td>
                            </tr>
                        </table>

                        <table width="100%" style="padding-left: 10px; padding-bottom: 3.3px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr>
                                <td style="width: 100px;">
                                    <span style="font-weight: normal">NoPol</span>
                                </td>

                                <td style="width: 200px;">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->nopolisi ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 100px;">
                                    <span style="font-weight: normal">Tipe/Model</span>
                                </td>
                                <td colspan="2">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->jenismobil ?></span>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc; padding-left: 10px;">
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
                                <td style="padding-bottom: 0px;">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->alamat ?></span>
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->kelurahan ?> , <?php echo $cell->kecamatan ?></span>
                                    ,
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->kota ?></span>
                                    ,
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->notlp ?></span>
                                    <br><br>
                                    <span style="font-weight: bold;">Nama PIC</span>
                                    <br>
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->pic ?></span>
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->nohppic ?></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>
    </div>


    <div class="footer">
        <?php foreach ($faktur as $cellx) : ?>
            <table width="100%" style="font-size: 9; text-align: right; border-radius: 2px; border: thin dashed #cccccc;">
                <tr style="text-align: Left;">
                    <td colspan="3">
                        <span style="font-weight: bold">Pekerjaan : </span>
                        <span style="font-weight: bold; font-size: 11px;"><?php echo $cellx->keterangan ?></span>
                    </td>
                </tr>
            </table>
        <?php endforeach ?>
    </div>

    <div class="content-jasa">
        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(141, 181, 237);">
                <th style="width: 100px; text-align: center;">
                    <span style="font-weight: normal">JASA</span>
                </th>
            </tr>
        </table>

        <table width="100%" style="border: thin dashed #cccccc;">
            <tr style="background-color: rgba(175, 200, 236); ">
                <th style="width: 20px; text-align: center;">
                    <span style="font-weight: normal"></span>
                </th>
                <!-- <th style="text-align: center;">
                    <span style="font-weight: normal">Kode Jasa</span>
                </th> -->
                <th style="text-align: center;">
                    <span style="font-weight: normal">Nama Jasa</span>
                </th>
                <th style="text-align: center; width: 30px; ">
                    <span style="font-weight: normal">Qty</span>
                </th>
                <th style="width: 100px;text-align: center;">
                    <span style="font-weight: normal">Harga</span>
                </th>
                <!-- <th style="text-align: center;">
                    <span style="font-weight: normal">Disc %</span>
                </th> -->
                <th style="width: 100px;text-align: center;">
                    <span style="font-weight: normal">Discount</span>
                </th>
                <th style="width: 100px;text-align: center;">
                    <span style="font-weight: normal">Subtotal</span>
                </th>
            </tr>

            <?php foreach ($subjasafaktur as $list) : ?>
                <tr>
                    <td width="100%" style="vertical-align: top;"></td>
                    <td style="text-align: left;" colspan="5">
                        <span style="font-weight: bold; text-transform: uppercase;"><?php echo $list->kategori ?></span>
                    </td>
                </tr>

                <?php $kategori = $list->kategori; ?>
                <?php $no = 1;
                foreach ($detailfaktur as $row) : ?>
                    <?php if ($row->kategori == $kategori) { ?>
                        <?php
                        $detail = $this->db->query("SELECT ejd.* FROM trnt_entryjasadetail ejd left join trnt_entryjasa ej on ej.no_wo = ejd.nomor WHERE ejd.nomor = '" . $row->nomor_spk . "' and ejd.kode_jasahead = '" . $row->kodereferensi . "' and ej.batal = false")->result();
                        ?>

                        <tr>
                            <td style="width: 20px; text-align: center;">
                                <span style="font-weight: normal">&bull;</span>
                            </td>
                            <!-- 
                            <td style="text-align: left;">
                                <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                            </td> -->

                            <td style="width: 320px; text-align: left;">
                                <span style="font-weight: normal"><?php echo $row->namareferensi ?> <?php if ($row->kategoridetail != '-') { ?> <?php echo $row->kategoridetail ?> <?php } ?></span>
                            </td>

                            <td style="text-align: center;">
                                <span style="font-weight: normal">1</span>
                            </td>

                            <td style="width: 100px;text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->subtotal + $row->discperitem) ?></span>
                            </td>

                            <!-- <td style="text-align: right;">
                                <span style="font-weight: normal"><?php echo $row->persendiscperitem ?></span>
                            </td> -->

                            <td style="width: 100px;text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->discperitem) ?></span>
                            </td>

                            <td style="width: 100px;text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                            </td>
                        </tr>

                        <?php foreach ($detail as $rox) : ?>
                            <tr>
                                <td style="text-align: right;" colspan="1">
                                    <span style="font-weight: normal"></span>
                                </td>
                                <td style="text-align: left;" colspan="5">
                                    <span style="font-weight: normal; font-size: 9px;">- <?php echo $rox->nama_jasa ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php } ?>
                <?php endforeach ?>
                <tr>
                    <td style="padding-bottom: 10px; font-style: italic; text-align: right; border-bottom: thin dashed #cccccc;" colspan="5">
                        <span style="font-weight: bold;  font-size: 10px;"><?php echo $list->kategori ?> Subtotal </span>
                    </td>
                    <td style="padding-bottom: 10px; font-style: italic; text-align: right; border-bottom: thin dashed #cccccc;" colspan="1">
                        <span style="font-weight: bold;  font-size: 10px;"><?php echo rupiah($list->total) ?></span>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>

    <div class="content-part">
        <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc; vertical-align: top;">
            <tr style="background-color: rgba(141, 181, 237);">
                <th style="width: 100px; text-align: center;">
                    <span style="font-weight: normal">PART</span>
                </th>
            </tr>
        </table>

        <table width="100%" style="margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
            <tr style="background-color: rgba(175, 200, 236); ">
                <th style="width: 20px; text-align: center;">
                    <span style="font-weight: normal"></span>
                </th>
                <!-- <th style="text-align: center;">
                    <span style="font-weight: normal">Kode Part</span>
                </th> -->
                <th style="width: 320px; text-align: center;">
                    <span style="font-weight: normal">Nama Part</span>
                </th>
                <th style="text-align: center; width: 30px; ">
                    <span style="font-weight: normal">Qty</span>
                </th>
                <th style="width: 95px;text-align: center;">
                    <span style="font-weight: normal">Harga</span>
                </th>
                <!-- <th style="text-align: center;">
                    <span style="font-weight: normal">Disc %</span>
                </th> -->
                <th style="width: 95px;text-align: center;">
                    <span style="font-weight: normal">Discount</span>
                </th>
                <th style="width: 95px;text-align: center;">
                    <span style="font-weight: normal">Subtotal</span>
                </th>
            </tr>

            <?php foreach ($subpartfaktur as $list) : ?>
                <tr>
                    <td width="100%" style="vertical-align: top;">
                    <td style="text-align: left;" colspan="5">
                        <span style="font-weight: bold; text-transform: uppercase;"><?php echo $list->kategoripart ?></span>
                    </td>
                </tr>

                <?php $kategoripart = $list->kategoripart; ?>
                <?php $no = 1;
                foreach ($detailfakturp as $row) : ?>
                    <?php if ($row->kategoripart == $kategoripart) { ?>
                        <tr>
                            <td style="width: 20px; text-align: center;">
                                <span style="font-weight: normal">&bull;</span>
                            </td>
                            <!-- <td style="text-align: left;">
                                <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                            </td> -->
                            <td style="width: 320px;text-align: left;">
                                <span style="font-weight: normal"><?php echo $row->namareferensi ?> <?php if ($row->kategoridetail != '-') { ?><?php echo $row->kategoridetail ?> <?php } ?></span>
                            </td>
                            <td style="text-align: center;width: 30px; ">
                                <span style="font-weight: normal"><?php echo $row->qty ?></span>
                            </td>
                            <td style="width: 95px; text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                            </td>
                            <!-- <td style="text-align: right;">
                                <span style="font-weight: normal"><?php echo $row->persendiscperitem ?></span>
                            </td> -->
                            <td style="width: 95px;text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->discperitem) ?></span>
                            </td>
                            <td style="width: 95px;text-align: right;">
                                <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                            </td>
                        </tr>
                    <?php } ?>
                <?php endforeach ?>

                <tr>
                    <td style="padding-bottom: 15px; font-style: italic; text-align: right; border-bottom: thin dashed #cccccc;" colspan="5">
                        <span style="font-weight: bold;  font-size: 10px;"><?php echo $list->kategoripart ?> Subtotal </span>
                    </td>

                    <td style="padding-bottom: 15px; font-style: italic; text-align: right; border-bottom: thin dashed #cccccc;" colspan="1">
                        <span style="font-weight: bold;  font-size: 10px;"><?php echo rupiah($list->total) ?></span>
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
                        <tr style="background-color: rgba(193, 193, 193);">
                            <th style="text-align: center;">
                                <span style="font-weight: bold">KATEGORI JASA</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">TOTAL</span>
                            </th>
                        </tr>

                        <?php foreach ($subjasafaktur as $cell) : ?>
                            <tr>
                                <td style="text-align: left;">
                                    <span style="font-weight: normal;  text-transform: uppercase;"><?php echo $cell->kategori ?></span>
                                </td>
                                <td style="text-align: right;">
                                    <span style="font-weight: normal;"><?php echo rupiah($cell->total) ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>

                <td width="50%" style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(193, 193, 193);">
                            <th style="text-align: center;">
                                <span style="font-weight: bold">KATEGORI PART</span>
                            </th>
                            <th style="text-align: center;">
                                <span style="font-weight: bold">TOTAL</span>
                            </th>
                        </tr>

                        <?php foreach ($subpartfaktur as $cellx) : ?>
                            <tr>
                                <td style="text-align: left;">
                                    <span style="font-weight: normal; text-transform: uppercase;"><?php echo $cellx->kategoripart ?></span>
                                </td>
                                <td style="text-align: right;">
                                    <span style="font-weight: normal"><?php echo rupiah($cellx->total) ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </td>
            </tr>
        </table>


        <table width="100%" style="margin-top: 3px;">
            <tr>
                <?php foreach ($faktur as $cell) : ?>
                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(193, 193, 193);">
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">TOTAL JASA</span>
                                </th>
                                <th style="text-align: right;">
                                    <span style="font-weight: bold"><?php echo rupiah($cell->totaljasa) ?></span>
                                </th>
                            </tr>
                        </table>
                    </td>

                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(193, 193, 193);">
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">TOTAL PART</span>
                                </th>
                                <th style="text-align: right;">
                                    <span style="font-weight: bold"><?php echo rupiah($cell->totalpart) ?></span>
                                </th>
                            </tr>
                        </table>
                    </td>
                <?php endforeach ?>
            </tr>
        </table>


        <table width="100%">
            <?php foreach ($faktur as $cell) : ?>
                <td width="50%" style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr>
                            <td style="width: 50px;">
                                <span style="font-weight: bold">Saran</span>
                            </td>
                            <td style="width: 150px; height:150px;">
                                <span style="color: #000000; font-weight: normal;"><?php echo $cell->keterangansaran ?></span>
                            </td>
                        </tr>
                    </table>
                </td>

                <td width="50%" style="vertical-align: top; ">
                    <table width="100%" style="font-size: 10; border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="text-align: center;">
                            <td colspan="3">
                                <span style="font-weight: bold;">Total Invoice Jasa dan Parts </span>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 70px;">
                                <span style="font-weight: bold;">DPP</span>
                            </td>
                            <td style="width: 60px;">
                                <span style="vertical-align: top; font-weight: bold;">:</span>
                            </td>
                            <td style="width: 100px;text-align: right; ">
                                <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->dpp) ?>,-</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 70px;">
                                <span style="font-weight: bold;">PPn (10%)</span>
                            </td>
                            <td style="width: 60px;">
                                <span style="vertical-align: top; font-weight: bold;">:</span>
                            </td>
                            <td style="width: 100px;text-align: right;">
                                <span style="color: #000000; font-weight: bold; "><?php echo rupiah($cell->ppn) ?>,-</span>
                            </td>
                        </tr>

                        <!-- <tr>
                            <td style="width: 70px;">
                                <span style="font-weight: bold;">Persen Disc</span>
                            </td>

                            <td style="width: 60px;">
                                <span style="vertical-align: top; font-weight: bold;">:</span>
                            </td>

                            <td style="width: 100px;">
                                <span style="color: #000000; font-weight: bold;"><?php echo ($cell->persen) ?>%</span>
                            </td>
                        </tr> -->

                        <tr>
                            <td style="width: 70px;">
                                <span style="font-weight: bold;">Discount</span>
                            </td>
                            <td style="width: 60px;">
                                <span style="vertical-align: top; font-weight: bold;">:</span>
                            </td>
                            <td style="width: 100px;text-align: right;">
                                <span style="color: #000000; font-weight: bold; "><?php echo rupiah($cell->totaldiscount) ?>,-</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 70px; ">
                                <span style="font-weight: bold;">DP</span>
                            </td>
                            <td style="width: 60px;">
                                <span style="vertical-align: top; font-weight: bold;">:</span>
                            </td>
                            <td style="width: 100px;text-align: right; ">
                                <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->nilaiuangmuka) ?>,-</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 70px;">
                                <span style="vertical-align: top; font-weight: bold;">Grand Total</span>
                            </td>
                            <td style="width: 60px;">
                                <span style="vertical-align: top; font-weight: bold;">:</span>
                            </td>
                            <td style="width: 100px;text-align: right; ">
                                <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->grandtotal - $cell->nilaiuangmuka) ?>,-</span>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="3">
                                <br>
                                <span style="font-weight: bold; font-size: 11px;">BCA PT Karya Berkat Semesta 6460-881313 KCP Griya Utama</span>
                            </td>
                        </tr>
                    </table>
                </td>
        </table>
    <?php endforeach ?>

    <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
        <tr>
            <td style="vertical-align: top;">
                <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                    <tr style="background-color: rgba(175, 200, 236);">
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
                    <tr style="background-color: rgba(175, 200, 236);">
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
                    <tr style="background-color: rgba(175, 200, 236);">
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
    </div>
</body>