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

<table border="1" width="100%">
    <thead>
        <tr style="background-color: rgba(242, 242, 242, 0.74);">
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nomor PO</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl PO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Keterangan PO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Supplier</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">DPP</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">PPN</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total PO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nomor Penerimaan</span>
            </th>
            <th style="text-align: center; ;">
                <span style="font-weight: bold">Tglterima</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Invoice</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tgl Invoice</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">DPP INV</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">PPn INV</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total INV</span>
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
                <span style="font-weight: bold">Status INV</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Bayar</span>
            </th>
            
            <th style="text-align: center; ">
                <span style="font-weight: bold">LT Invoice</span>
            </th>
        </tr>
    </thead>
    <?php $no = 1;
    foreach ($report_faktur as $row) : ?>


        <tbody>
            <tr style="line-height: 1 em; ">
                <td style="width: 30px; text-align: center; ">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->namasupplier ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->dpp) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->ppn)   ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->total) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nopenerimaan ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo ($row->tglterima) ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->noinvoice ?></span>
                </td>

                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->tglinvoice) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->dppiv) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->ppniv) ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->totaliv) ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaibayar) ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->tgllunas) ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->statuspo) ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->statusiv) ?></span>
                </td>
                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->statusbayar) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo ($row->leadtime_iv) ?></span>
                </td>
            </tr>
        </tbody>
    <?php endforeach ?>

</table>