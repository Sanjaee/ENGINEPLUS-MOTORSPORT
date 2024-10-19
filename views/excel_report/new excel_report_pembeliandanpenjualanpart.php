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
            <th colspan="19"><?php echo $title ?></th>
        </tr>
        <tr>
            <th colspan="19">Periode tanggal <?php echo $tglmulai ?> </th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <th colspan="19"></th>
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
                        <span style="font-weight: bold">Kode Part</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Nama Part</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Awal</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty P.list In</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty P.list Out</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Beli</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Retur Beli</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Pbebanan In</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Pbebanan Out</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>
                    
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Jual</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Retur Jual</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Opname</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Rupiah</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Qty Akhir</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Price Varian Beli</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Price Varian Jual</span>
                    </th>

                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Total</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($report_rekapitulasistockpart as $row) : ?>
                    <tr style="line-height: 0.25 cm; ">
                        <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->kode_parts ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nama_parts ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtyawal ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_awal) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pickinglistin ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pickinglistin) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pickinglistout ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pickinglistout) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pembelian ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pembelian) ?></span>
                        </td>


                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_returpembelian ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_returpembelian) ?></span>
                        </td>


                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypembebananin ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpembebananin) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypembebananout ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpembebananout) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypenjualan ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_penjualan) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_returpenjualan ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_returpenjualan) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_opname ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_opname) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_akhir ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->pricevariance) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->price_variancesales * -1) ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_akhir) ?></span>
                        </td>
                    </tr>
                <?php endforeach ?>

                <tr>
                    <td colspan="3" style="text-align: center;">
                        <span style="font-weight: bold;">Grand Total </span>
                    </td>

                    <?php
                    $kodecabang = $this->session->userdata('mycabang');
                    $kodecompany = $this->session->userdata('mycompany');
                    $detail = $this->db->query("SELECT SUM(qtyawal) as qtyawal,SUM(total_awal) as total_awal,SUM(qty_pickinglistin) as qty_pickinglistin, 
                    SUM(total_pickinglistin) as total_pickinglistin, SUM(qty_pickinglistout) as qty_pickinglistout, SUM(total_pickinglistout) as total_pickinglistout,
                    SUM(qty_pembelian) as qty_pembelian, 
                    SUM(total_pembelian) as total_pembelian,SUM(qty_returpembelian) as qty_returpembelian,
                    SUM(total_returpembelian) as total_returpembelian, 
                    SUM(qtypembebananin) as qtypembebananin,SUM(totalpembebananin) as totalpembebananin,
                    SUM(qtypembebananout) as qtypembebananout,SUM(totalpembebananout) as totalpembebananout,
                    SUM(qtypenjualan) as qtypenjualan,SUM(total_penjualan) as total_penjualan,
                    SUM(qty_returpenjualan) as qty_returpenjualan,SUM(total_returpenjualan) as total_returpenjualan,  SUM(qty_opname) as qty_opname,SUM(total_opname) as total_opname,
                    SUM(qty_akhir) as qty_akhir,SUM(total_akhir) as total_akhir, SUM(pricevariance) as pricevariance,SUM(price_variancesales)*-1 as price_variancesales
                    FROM acc_vw_laporanpenjualandanpembelianpartbasegudang
                    WHERE kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND bln= '" . date('m', strtotime($tglmulai)) . "' AND thn = '" . date('Y', strtotime($tglmulai)) . "' ")->result();
                    ?>
                    <?php foreach ($detail as $row) : ?>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qtyawal ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_awal) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pickinglistin ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pickinglistin) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qty_pickinglistout ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->total_pickinglistout) ?></span>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_pembelian ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_pembelian) ?></span>
                        </td>

                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_returpembelian ?></span>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_returpembelian) ?></span>
                        </td>
                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypembebananin ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpembebananin) ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->qtypembebananout ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo rupiah($row->totalpembebananout) ?></span>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qtypenjualan ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_penjualan) ?></span>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_returpenjualan ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_returpenjualan) ?></span>
                        </td>

                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_opname ?></span>
                        </td>
                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_opname) ?></span>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo $row->qty_akhir ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->pricevariance) ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->price_variancesales) ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="font-weight: bold"><?php echo rupiah($row->total_akhir) ?></span>
                        </td>

                    <?php endforeach ?>
                </tr>
            </tbody>
        </table>