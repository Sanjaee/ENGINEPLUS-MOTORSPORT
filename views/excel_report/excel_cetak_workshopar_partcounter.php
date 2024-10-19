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
                        <span style="font-weight: bold">Tgl Invoice</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Invoice</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">No Polisi</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Customer</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tipe</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jumlah AR</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Uang Muka</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Jumlah Pelunasan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tgl Pelunasan</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Status</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Sisa AR</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Umur</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">SA</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Project Manager</span>
                    </th>

                </tr>

                <?php $no = 1;
                $totalsisaar = 0;
                foreach ($workshopardetail2 as $row) :
                ?>
                    <?php $sisaar = intval($row->total) - (intval($row->nilaiuangmuka) + intval($row->nilaipenerimaan)) ?>
                    <tr style="line-height: 0.25 cm; ">
                        <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tanggal)); ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nofaktur ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nama_customer ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tipejual ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->nilaipenerimaan) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tgllunas)) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->statusbayar ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($sisaar) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php
                                                                $today = new DateTime();
                                                                $tglinvoice =  new DateTime($row->tanggal);
                                                                $umur = 0;
                                                                $diff = $today->diff($tglinvoice)->days + 1;
                                                                if ($sisaar == 0) {
                                                                    echo $umur;
                                                                } else {
                                                                    echo $diff;
                                                                } ?>
                            </span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal">-</span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal">-</span>
                        </td>
                    </tr>
                <?php
                    $totalsisaar += $sisaar;

                // $diff  = date_diff($akhir, $awal);
                endforeach ?>

                <tr>
                    <td colspan="11" style="text-align: center;">
                        <span style="font-weight: bold;">Total Sisa AR </span>
                    </td>

                    <?php
                    // foreach ($totalsuminventorystock as $cell) : 
                    ?>
                    <td style="text-align: center;">
                        <span style="color: #000000; font-weight: bold;"><?php echo rupiah($totalsisaar) ?></span>
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