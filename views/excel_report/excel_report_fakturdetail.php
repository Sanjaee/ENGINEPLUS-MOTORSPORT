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
        <tr>
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Faktur</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Polisi</span>
            </th>
            
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Model</span>
            </th>
            
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Tipe</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Mekanik</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Foreman</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kategori Jasa Part</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Kode Referensi</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Referensi</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis</span>
            </th>
            

            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga Satuan</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Qty</span>
            </th>
            
            <th style="text-align: center; ">
                <span style="font-weight: bold">Harga Total</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">% Discount</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Discount</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">DPP</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">PPN</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">COGS</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Margin</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Bayar</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">SA</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Project Manager</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Customer</span>
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
                    <span style="font-weight: normal"><?php echo $row->nomor_spk ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->jenismobil ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->namatipe ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nama ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nama_teknisi ?></span>
                </td>
                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->nama_foreman ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->kategori ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                </td>

                <td style="text-align: center; ">
                    <span style="font-weight: normal"><?php echo $row->namareferensi ?></span>
                </td>

                <td style="text-align: left; ">
                    <span style="font-weight: normal"><?php echo $row->jenisdetail ?></span>
                </td>                
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->harga) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->qty ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->hargadisc) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->persendiscperitem ?>%</span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->discperitem) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->ppnsubtotal) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->cogs) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal - $row->cogs) ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->statusbayar ?></span>
                </td>
                <td style="text-align: left; ">
                    <span style="font-weight: normal"><?php echo $row->pemakai ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->projectmanager ?></span>
                </td>
                <td style="text-align: right; ">
                    <span style="font-weight: normal"><?php echo $row->jeniscustomer ?></span>
                </td>
            </tr>
        </tbody>
    <?php endforeach ?>

</table>