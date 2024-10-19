<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<body>
    <div class="content">
        <table width="100%" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: thin solid grey;">
            <tr style="text-align: center;">
                <td>
                    <span style="font-size: 12; font-weight: bold;">LAPORAN KAS & BANK</span>
                </td>

            </tr>

            <tr style="text-align: center;">
                <td>
                    <span style="font-size: 10; font-weight: normal;">Periode &nbsp; : &nbsp; <?php echo $tglawal ?> &nbsp; s/d &nbsp; <?php echo $tglakhir ?> </span>
                </td>
            </tr>

            <tr style="text-align: center;">
                <td>
                    <span style="font-size: 10; font-weight: normal; padding-right: 20px;">COA  : <?php echo $nomor ?> </span>
                    <span style="font-size: 10; font-weight: normal;"><?php echo $nama ?>  </span>
                    
                </td>
            </tr>

            <tr style="text-align: center;">
                <td>
                    <span style="font-size: 10; font-weight: normal;">Tanggal Print &nbsp; : &nbsp; <?php echo date("d-m-Y"); ?> </span>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-radius: 4px; margin-top: 5px;">

            <tbody style="border: thin solid grey;">
                <tr style="background-color: rgba(242, 242, 242, 0.74); border-radius: 4px;">
                    <th style="width: 40px; text-align: center; ">
                        <span style="font-weight: bold">No.</span>
                    </th>
                    <th style="text-align: center; ">
                        <span style="font-weight: bold">Tanggal</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Jenis</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">No. Voucher</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">No. Permohonan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Keterangan</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Debit</span>
                    </th>
                    <th style="text-align: center;">
                        <span style="font-weight: bold">Kredit</span>
                    </th>
                </tr>

                <?php $no = 1;
                foreach ($report_kas_bank as $row) : ?>
                    <tr style="line-height: 0.5 cm; ">
                        <td style="width: 40px; text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $no++ ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->jenis ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nomorbon ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->nopermohonan ?></span>
                        </td>

                        <td style="text-align: center; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo "Rp " . number_format($row->debit, 0, ',', '.') ?></span>
                        </td>

                        <td style="text-align: right; border-bottom: thin solid grey;">
                            <span style="font-weight: normal"><?php echo "Rp " .  number_format($row->kredit, 0, ',', '.') ?></span>
                        </td>
                    </tr>
                <?php endforeach ?>

                <tr>
                    <td colspan="5" style="text-align: right;">
                        <span style="font-weight: bold;">Total </span>
                    </td>

                    <?php foreach ($sumkasbank as $r) : ?>
                        <td style="text-align: right;">
                            <span style="color: #000000; font-weight: bold;"><?php echo "Rp " . number_format($r->debit, 0, ',', '.') ?></span>
                        </td>

                        <td style="text-align: right;">
                            <span style="color: #000000; font-weight: bold;"><?php echo "Rp " . number_format($r->kredit, 0, ',', '.') ?></span>
                        </td>
                    <?php endforeach ?>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: right;">
                        <span style="font-weight: bold;">Saldo Akhir </span>
                    </td>

                    <?php foreach ($sumkasbank as $rx) : ?>
                        <td style="text-align: right;">
                            <span style="color: #000000; font-weight: bold;"><?php echo "Rp " . number_format($rx->debit - $rx->kredit, 0, ',', '.') ?></span>
                        </td>
                    <?php endforeach ?>
                </tr>
            </tbody>
        </table>

        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <td style="vertical-align: top; padding-right: 10px;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Pembuat</span>
                            </th>
                        </tr>

                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                                <span style="font-weight: normal;"><?php echo $this->session->userdata('myusername'); ?></span>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top; padding-right: 10px;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Pemeriksa</span>
                            </th>
                        </tr>

                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                                <span><br></span>
                            </td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top; ">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Menyetujui</span>
                            </th>
                        </tr>

                        <tr>
                            <td style="width: 100px; text-align: center;">
                                <span><br></span>
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