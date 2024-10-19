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
            <th style="text-align: center; width:100px;">
                <span style="font-weight: bold">Tanggal GL</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nomor GL</span>
            </th>
            <th style="text-align: center; width:150px;">
                <span style="font-weight: bold">Nama Supplier</span>
            </th>
            <th style="text-align: center; width:100px;">
                <span style="font-weight: bold">Nomor WO</span>
            </th>
            <th style="text-align: center; width:70px;">
                <span style="font-weight: bold">No Polisi</span>
            </th>
            <th style="text-align: center; width:70px;">
                <span style="font-weight: bold">No OPL</span>
            </th>
            <th style="text-align: center; width:150px;">
                <span style="font-weight: bold">Nama Pekerjaan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga Beli</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga Jual</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Invoice Receive</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl Lunas</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Bayar</span>
            </th>

        </tr>

        <?php $no = 1;
        $totalsisaap = 0;
        foreach ($workshopap_opl as $row) :
        ?>
            <tr style="line-height: 0.25 cm; ">
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tanggal)); ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namasupplier ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nomor_wo ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->kode_pekerjaan ?></span>
                </td>
                <td style="text-align: left; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama_pekerjaan ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogs) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statuswo; ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statusinv; ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tgllunas)) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statusbayar ?></span>
                </td>
            </tr>
        <?php
            $totalsisaap += intval($row->cogs);
        endforeach ?>
        <tr>
            <td colspan="8" style="text-align: center;">
                <span style="font-weight: bold;">Total Sisa AP </span>
            </td>

            <?php
            // foreach ($totalsuminventorystock as $cell) : 
            ?>
            <td style="text-align: center;">
                <span style="color: #000000; font-weight: bold;"><?php echo rupiah($totalsisaap)  ?></span>
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