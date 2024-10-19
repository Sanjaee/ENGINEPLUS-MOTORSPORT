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

<table width="100%">
    <thead>
        <tr>
            <th colspan="14"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="14">Periode tanggal <?php echo $tglmulai ?> s.d <?php echo $tglakhir ?> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="14"></th>
        </tr>
    </tbody>

</table>

<table width="100%" style="margin-top: 5px; border: thin solid grey; border-radius: 4px;">
            <tbody>
                <tr style="background-color: rgba(242, 242, 242, 0.74); ">
                    <th style="width: 30px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nomor PO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal PO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Supplier</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Keterangan PO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total PO</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nomor Penerimaan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl Terima</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Invoice</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl Invoice</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total Invoice</span>
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
                        <span style="font-weight: bold">Status Invoice</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status Bayar</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Sisa AP</span>
                    </th>

                </tr>

                <?php $no = 1;
                $totalsisaap = 0;
                foreach ($workshopap_part as $row) :
                ?>
                    <?php
                    //  $sisaar = intval($row->total) - (intval($row->nilaiuangmuka) + intval($row->nilaipenerimaan)) 
                    ?>
                    <tr style="line-height: 0.25 cm; ">
                        <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tanggal)); ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->namasupplier ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nopenerimaan ?></span>
                        </td>                                         
                        <?php if ($row->tglterima == '' || $row->tglterima == null || date('d F Y', strtotime($row->tglterima)) == '01 January 1970' ) { ?>
                            <td style="text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: normal"></span>
                            </td>
                        <?php } else { ?>
                            <td style="text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tglterima)) ?></span>
                            </td>
                        <?php } ?>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->noinvoice ?></span>
                        </td>                        
                        <?php if ($row->tglinvoice == '' || $row->tglinvoice == null || date('d F Y', strtotime($row->tglinvoice)) == '01 January 1970' ) { ?>
                            <td style="text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: normal"></span>
                            </td>
                        <?php } else { ?>
                            <td style="text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tglinvoice)) ?></span>
                            </td>
                        <?php } ?>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totaliv) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaibayar) ?></span>
                        </td>
                        <?php if ($row->tgllunas == '' || $row->tgllunas == null || date('d F Y', strtotime($row->tgllunas)) == '01 January 1970' ) { ?>
                            <td style="text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: normal"></span>
                            </td>
                        <?php } else { ?>
                            <td style="text-align: center; border-bottom: thin solid grey;">
                                <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tgllunas)) ?></span>
                            </td>
                        <?php } ?>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statuspo ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statusiv ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statusbayar ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php
                                                                $sisaap = intval($row->totaliv) - (intval($row->nilaiuangmuka) + intval($row->nilaibayar));
                                                                echo rupiah($sisaap) ?>
                            </span>
                        </td>
                    </tr>
                <?php
                    $totalsisaap += intval($sisaap);
                endforeach ?>

                <tr>
                    <td colspan="16" style="text-align: center;">
                        <span style="font-weight: bold;">Total Sisa AP </span>
                    </td>

                    <?php
                    // foreach ($totalsuminventorystock as $cell) : 
                    ?>
                    <td style="text-align: center;">
                        <span style="color: #000000; font-weight: bold;"><?php echo rupiah($totalsisaap) ?></span>
                    </td>

                    <!-- <td style="text-align: center;">
                            <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->totalnilai) ?>,-</span>
                        </td>

                        <td style="text-align: center;">
                            <span style="color: #000000; font-weight: bold;"><?php echo rupiah($cell->grandtotal) ?>,-</span>
                        </td> -->
                    <?php
                    // endforeach 
                    ?>
                </tr>
            </tbody>
        </table>

