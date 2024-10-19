<?php
$judul = $title . "-" . date('Ymd');
header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<style> .str{ mso-number-format:\@; } </style>

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
            <th>FK</th>
            <th style="width: 150px;">KD_JENIS_TRANSAKSI</th>
            <th style="width: 150px;">FG_PENGGANTI</th>
            <th style="width: 150px;">NOMOR_FAKTUR</th>
            <th style="width: 150px;">MASA_PAJAK</th>
            <th style="width: 150px;">TAHUN_PAJAK</th>
            <th style="width: 150px;">TANGGAL_FAKTUR</th>
            <th style="width: 150px;">NPWP</th>
            <th style="width: 150px;">NAMA</th>
            <th style="width: 150px;">ALAMAT_LENGKAP</th>
            <th style="width: 150px;">JUMLAH_DPP</th>
            <th style="width: 150px;">JUMLAH_PPN</th>
            <th style="width: 150px;">JUMLAH_PPNBM</th>
            <th style="width: 150px;">ID_KETERANGAN_TAMBAHAN</th>
            <th style="width: 150px;">FG_UANG_MUKA</th>
            <th style="width: 150px;">UANG_MUKA_DPP</th>
            <th style="width: 150px;">UANG_MUKA_PPN</th>
            <th style="width: 150px;">UANG_MUKA_PPNBM</th>
            <th style="width: 150px;">REFERENSI</th>
            <th style="width: 150px;">KODE_DOKUMEN_PENDUKUNG</th>
        </tr>
    </thead>   

    <thead>
        <tr>
            <th>LT</th>
            <th style="width: 150px;">NPWP</th>
            <th style="width: 150px;">NAMA</th>
            <th style="width: 150px;">JALAN</th>
            <th style="width: 150px;">BLOK</th>
            <th style="width: 150px;">NOMOR</th>
            <th style="width: 150px;">RT</th>
            <th style="width: 150px;">RW</th>
            <th style="width: 150px;">KECAMATAN</th>
            <th style="width: 150px;">KELURAHAN</th>
            <th style="width: 150px;">KABUPATEN</th>
            <th style="width: 150px;">PROVINSI</th>
            <th style="width: 150px;">KODE_POS</th>
            <th style="width: 150px;">NOMOR_TELEPON</th>
        </tr>
    </thead> 

    <thead>
        <tr>
            <th>OF</th>
            <th style="width: 150px;">KODE_OBJEK</th>
            <th style="width: 150px;">NAMA</th>
            <th style="width: 150px;">HARGA_SATUAN</th>
            <th style="width: 150px;">JUMLAH_BARANG</th>
            <th style="width: 150px;">HARGA_TOTAL</th>
            <th style="width: 150px;">DISKON</th>
            <th style="width: 150px;">DPP</th>
            <th style="width: 150px;">PPN</th>
            <th style="width: 150px;">TARIF_PPNBM</th>
            <th style="width: 150px;">PPNBM</th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($report as $row) :
        $detail = $this->db->query("SELECT * FROM vw_FakturPajakKeluaran_ePajakSub WHERE nomor_fakturpajak = '".$row->nofakpajak."' AND nomor_transaksi = '".$row->nomor_transaksi."' ")->result();
        ?>
            <tr>
                <td style="text-align: center;">
                    FK
                </td>
                <td style="text-align: center; " class="str">
                    <?php echo $row->kode_jenis ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->penggantian ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->nomor_fakturpajak ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->bln ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->thn ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->tanggal_faktur_pajak ?>
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo $row->npwp ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->namacustomer ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->alamatcustomer ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->perolehan ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->ppn ?>
                </td>
                <td style="text-align: center;">
                    0
                </td>
                <td style="text-align: center;">
                    
                </td>
                <td style="text-align: center;">
                    <?php echo $row->fgum ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->dppuangmuka ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $row->ppnuangmuka ?>
                </td>
                <td style="text-align: center;">
                    0
                </td>
                <td style="text-align: center;">
                    <?php echo $row->nomor_referensi ?>
                </td>
                
            </tr>
        
    </tbody>
</table>

<table width="100%">

    <tbody>
        <?php
             foreach ($detail as $value):
        ?>
            <tr>
                <td style="text-align: center;">
                    OF
                </td>
                <td style="text-align: center;" class="str">
                    <?php echo "".$value->kode."" ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $value->keterangan ?>
                </td>
                <td style="text-align: center;">
                    <?php echo ROUND($value->hargatotal / $value->qty)  ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $value->qty ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $value->hargatotal ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $value->discount ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $value->perolehan ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $value->ppn ?>
                </td>
                <td style="text-align: center;">
                    0
                </td>
                <td style="text-align: center;">
                    0
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <?php endforeach ?>
</table>
