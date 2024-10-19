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
    <!--- header --->
    <div class="nav-bar">
        <div>
            <table width="100%" style="margin-top: 5px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
                <tr>
                    <td width="50%" style="vertical-align: bottom;">

                        <!-- <img src="./assets/img/lenovo logo.jpg" style="position: absolute; width: 180px height: auto;"> -->
                        <?php foreach ($closewo as $cell) : ?>

                            <table width="100%" style="padding: 10px; margin-top: 5px;">

                                <tr>
                                    <td colspan="2">
                                        <span style="font-weight: normal; font-size: 10;">Data Dokumen Close WO</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">
                                        <span style="font-weight: bold; font-size: 14;">Nomor Dokumen. &nbsp;&nbsp;&nbsp;</span>
                                        <!-- <span style="color: #000000; font-weight: bold; font-size: 14;"><?php echo $cell->nomor ?></span> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <!-- <span style= "font-weight: bold; font-size: 14;" >Nomor Invoice. &nbsp;&nbsp;&nbsp;</span> -->
                                        <span style="color: #000000; font-weight: bold; font-size: 14;"><?php echo $cell->nomor ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 155px;">
                                        <span style="font-weight: bold">Tanggal</span>
                                    </td>
                                    <td colspan="2">
                                        <span style="color: #000000; font-weight: normal;"><?php echo $cell->tanggal ?></span>
                                    </td>
                                </tr>
                            </table>


                    </td>

                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="margin-top: 5px; ">
                            <tr>
                                <td style="padding-bottom: 20px; padding-left: 30px;">
                                    <span style="color: #000000; font-size: 12px; font-weight: bold; display: block;"> <?php echo $cell->perusahaan ?> </span>
                                    <br>
                                    <div>
                                        <?php echo $cell->alamatperusahaan ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    <?php endforeach ?>
                    </td>

                </tr>
            </table>

        </div>

    </div>
    <!-- separator -->

    <!-- <div style="border-radius: 4px; border-bottom: thin dashed #cccccc; margin: 7px 0;"></div> -->

    <!-- Content Data -->
    <div class="content-detail">
        <!-- 
        <table width="100%" style="margin-top: 5px;"> -->
        <?php foreach ($closewo as $cell) : ?>
            <!-- <td width="50%" style="vertical-align: top;"> -->

            <table width="100%" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
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
                <th style="width: 200px; text-align: center;">
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
                            <td style="width: 30px; text-align: center;">
                                <span style="font-weight: normal"><?php echo $no++ ?></span>
                            </td>

                            <td style="text-align: left;">
                                <span style="font-weight: normal"><?php echo $rox->kodepart ?></span>
                            </td>

                            <td style="width: 200px; text-align: left;">
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
                <th style="width: 200px; text-align: center;">
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
                        <td style="width: 30px; text-align: center;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: left;">
                            <span style="font-weight: normal"><?php echo $rox->kodepart ?></span>
                        </td>

                        <td style="width: 200px; text-align: left;">
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
                        <tr style="background-color: rgba(93, 93, 253, 0.5);">
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
            </tr>
        </table>
    </div>

</body>