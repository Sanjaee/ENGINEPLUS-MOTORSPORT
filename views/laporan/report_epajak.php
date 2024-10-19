<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        <?php echo SITE_NAME . " : " . ucfirst($this->uri->segment(1)) . " - " . ucfirst($this->uri->segment(2)) ?>
    </title>

    <style>
        @page {
            margin: 1cm 1cm;
        }

        .body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        .nav-bar {
            font-family: helvetica;
            /** Extra personal styles **/
            color: BLACK;
            text-align: center;
            font-size: 10px;
            line-height: 0.4cm;
        }

        .header {
            margin-left: 300px;
        }

        .content {
            color: BLACK;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 0.5cm;
            /* page-break-inside: always; */
        }

        .content-detail {
            color: BLACK;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            /* page-break-inside: always; */
        }

        .footer {

            /** Extra personal styles **/
            font-family: helvetica;
            color: BLACK;
            text-align: center;
            line-height: 0.5cm;
        }
    </style>

    <style type="text/css">
        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }
    </style>
</head>

<?php
function rupiah($angka)
{
    $hasil_rupiah = number_format($angka,0,",",".");
    return $hasil_rupiah;
}
?>

<body>
    <div class="content">
        <table width="100%" style="text-align: center; padding: 5px; margin-top: 5px; border-radius: 4px; border: thin solid grey;">
            <tr>
                <td>
                    <span style="font-size: 10; font-weight: bold">LAPORAN E-PAJAK</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span style="font-size: 10; font-weight: normal">Periode &nbsp; : <?php echo $tglmulai ?> &nbsp; s/d &nbsp; <?php echo $tglakhir ?> </span>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px; margin-top: 5px; border: thin solid grey;">
            <tbody>
                <?php foreach ($reportcabang as $list) : ?>
                    <tr>
                        <td style="text-align: left;" colspan="5">
                            <span style="font-weight: bold; text-transform: uppercase;"><?php echo $list->kode . " - " . $list->nama ?></span>
                        </td>
                    </tr>
                    <tr style="background-color: rgba(242, 242, 242, 0.74);">
                        <th style="width: 30px; text-align: center; ">
                            <span style="font-weight: bold">No.</span>
                        </th>
                        <th style="text-align: center; ">
                            <span style="font-weight: bold">No Faktur pajak</span>
                        </th>
                        <th style="text-align: center;">
                            <span style="font-weight: bold">Nama Customer</span>
                        </th>
                        <th style="text-align: center;  width: 260px;">
                            <span style="font-weight: bold">Alamat</span>
                        </th>
                        <th style="text-align: center; ">
                            <span style="font-weight: bold">No Invoice</span>
                        </th>
                        <th style="text-align: center;">
                            <span style="font-weight: bold">Tanggal Invoice</span>
                        </th>
                        <th style="text-align: center; ">
                            <span style="font-weight: bold">Total Invoice</span>
                        </th>
                        <th style="text-align: center;">
                            <span style="font-weight: bold">No. NPWP / KTP</span>
                        </th>
                    </tr>
                    <?php $cabang = $list->kode; ?>
                    <?php $no = 1;
                    foreach ($report as $row) : ?>
                        <?php if ($row->kode_cabang == $cabang) { ?>
                            <tr style="line-height: 0.5 cm; ">
                                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                                </td>

                                <td style="text-align: center; border-bottom: thin solid grey;">
                                    <span style="font-weight: normal"><?php echo $row->nomor_fakturpajak ?></span>
                                </td>

                                <td style="text-align: center; border-bottom: thin solid grey;">
                                    <span style="font-weight: normal"><?php echo $row->namacustomer ?></span>
                                </td>

                                <td style="text-align: center; border-bottom: thin solid grey;">
                                    <span style="font-weight: normal"><?php echo $row->alamatcustomer ?></span>
                                </td>

                                <td style="text-align: center; border-bottom: thin solid grey;">
                                    <span style="font-weight: normal"><?php echo $row->nomor_transaksi ?></span>
                                </td>


                                <td style="text-align: center; border-bottom: thin solid grey;">
                                    <span style="font-weight: normal"><?php echo $row->tanggal_faktur_pajak ?></span>
                                </td>

                                <td style="text-align: center; border-bottom: thin solid grey;">
                                    <span style="font-weight: normal"><?php echo rupiah($row->hargatotal + $row->ppn) ?></span>
                                </td>

                                <td style="text-align: center; border-bottom: thin solid grey;">
                                    <span style="font-weight: normal"><?php echo $row->npwp ?></span>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php endforeach ?>

                <tr>
                    <td colspan="6" style="text-align: center;">
                        <span style="font-weight: bold;">Grand Total </span>
                    </td>
                    <?php
                    $kodecabang = $list->kode;
                    $kodecompany = $list->kodecompany;
                    $detail = $this->db->query("SELECT SUM(hargatotal+ppn) as grandtotal
                    FROM vw_FakturPajakKeluaran_ePajak
                    WHERE kode_cabang = '" . $kodecabang . "' AND kodecompany = '" . $kodecompany . "' AND tglfaktur >= '" . date('Ymd', strtotime($tglmulai)) . "' AND  tglfaktur <= '" . date('Ymd', strtotime($tglakhir)) . "' ")->result();
                    ?>
                    <?php foreach ($detail as $row) : ?>
                        <td style="text-align: center;">
                            <span style="font-weight: bold"><?php echo rupiah($row->grandtotal) ?>,-</span>
                        </td>

                        <td style="text-align: center;">
                            <span style="font-weight: bold">&nbsp;</span>
                        </td>
                    <?php endforeach ?>
                </tr>
                
                <?php endforeach ?>
            </tbody>
        </table>

        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Pembuat</span>
                                </th>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Pemeriksa</span>
                                </th>
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Menyetujui</span>
                                </th>
                            </tr>


                            <tr>
                                <td style="line-height: 2.5cm; text-align: center; ">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                                <td style="line-height: 2.5cm; text-align: center;">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                                <td style="line-height: 2.5cm; text-align: center;">
                                    <span style="font-weight: normal">( ............................ )</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>