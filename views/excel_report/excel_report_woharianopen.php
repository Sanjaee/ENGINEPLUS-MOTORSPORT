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
                <span style="font-weight: bold">No WO</span>
            </th>

            <th style="text-align: center; ">
                <span style="font-weight: bold">Tanggal</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">No Polisi</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">ID Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Customer</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Tipe</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Kategori</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Keluhan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Keterangan</span>
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
                <span style="font-weight: bold">Total UM</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Sisa</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jenis Service</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">SA</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status WO</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Pembebanan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">PM</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Posisi Kendaraan</span>
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
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($report_spk as $row) :
        ?>
            <tr>
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nospk ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->status ?></span>
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
                    <span style="font-weight: normal"><?php echo $row->kategori ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->keluhan ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->keterangan ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama_teknisi ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nama_foreman ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalpart) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totaljasa) ?></span>
                </td>
                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->totalopl) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaispk) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->nilaiuangmuka) ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->sisaum) ?></span>
                </td>


                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->jenisservice ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->pemakai ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->statuswo ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->statuspart ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal; "><?php echo $row->projectmanager ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statuskendaraan ?></span>
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
            </tr>
        <?php endforeach ?>
    </tbody>

    <thead>
        <tr>
            <th colspan="15" style="text-align: right; font-weight: bold;">Total Nilai WO</th>
            <?php foreach ($totalsum as $row) : ?>
                <td style="font-weight: bold; text-align: right;"><?php echo $row->totalnilaispk ?></td>
            <?php endforeach ?>
        </tr>
    </thead>

</table>