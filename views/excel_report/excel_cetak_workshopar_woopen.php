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
    </thead>
</table>

<table width="100%" style="margin-top: 5px; border: thin solid grey; border-radius: 4px;">
    <tbody>
        <tr style="background-color: rgba(242, 242, 242, 0.74); ">
            <th style="width: 30px; text-align: center; ">
                <span style="font-weight: bold">No.</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nomor WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Polisi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">ID Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tipe</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Teknisi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Foreman</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Estimasi Part</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Estimasi Jasa</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Estimasi OPL</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Total Estimasi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nilai Uang Muka</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Sisa</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Project Manager</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Posisi Kendaraan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">umur WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Kendaraan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Indikator Summary</span>
            </th>

        </tr>

        <?php $no = 1;
        $totalsisaar = 0;
        foreach ($workshopar_woopen as $row) : ?>
            <?php $sisaar = intval($row->sisaum) ?>
            <tr style="line-height: 0.25 cm; ">
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nospk ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo date('d F Y', strtotime($row->tanggal)); ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nocustomer ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->customer ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tipe ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama_teknisi ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama_foreman ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalpart) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totaljasa) ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalopl) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaispk) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->sisaum) ?></span>
                </td>


                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statuswo ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->projectmanager ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statuskendaraan ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->umur ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statuspekerjaanmobil ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->jeniscustomer ?></span>
                </td>
                <?php if ($row->statussum == 'Tunggu Dikerjakan') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: red;">&bull;</span>
                    </td>
                <?php } else if ($row->statussum == 'Sedang Dikerjakan') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: yellow;">&bull;</span>
                    </td>
                <?php } else if ($row->statussum == 'Selesai Dikerjakan') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: green;">&bull;</span>
                    </td>
                <?php } else if ($row->statussum == 'Batal') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: grey;">&bull;</span>
                    </td>
                <?php } ?>
            </tr>
        <?php
            $totalsisaar += $sisaar;

        // $diff  = date_diff($akhir, $awal);
        endforeach ?>

        <tr>
            <td colspan="13" style="text-align: center;">
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