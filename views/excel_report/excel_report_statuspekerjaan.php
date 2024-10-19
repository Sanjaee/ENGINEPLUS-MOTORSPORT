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
<table width="100%" style="margin-top: 5px; ">
    <tbody style="border: thin solid grey; border-radius: 4px;">
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
                <span style="font-weight: bold">Status</span>
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
                <span style="font-weight: bold">Kode Jasa</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Nama Jasa</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Jam</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Estimasi Harga</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Status Pekerjaan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Indikator Pekerjaan</span>
            </th>
            <th style="text-align: center; ">
                <span style="font-weight: bold">Indikator Summary</span>
            </th>
        </tr>

        <?php $no = 1;
        foreach ($report_spk as $row) : ?>

            <tr style="line-height: 0.5 cm; ">
                <td style="width: 30px; text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nomor ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->status ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                </td>

                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namacustomer ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->jenismobil ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namatipe ?></span>
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
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->kodereferensi ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->namareferensi ?></span>
                </td>
                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->qty ?></span>
                </td>

                <td style="text-align: right; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo rupiah($row->subtotal) ?></span>
                </td>
                <td style="text-align: center; border-bottom: thin solid grey;">
                    <span style="font-weight: normal"><?php echo $row->statuspekerjaan ?></span>
                </td>

                <?php if ($row->statuspekerjaan == 'TUNGGU DIKERJAKAN') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: red;">&bull;</span>
                    </td>
                <?php } else if ($row->statuspekerjaan == 'SEDANG DIKERJAKAN') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: yellow;">&bull;</span>
                    </td>
                <?php } else if ($row->statuspekerjaan == 'SELESAI DIKERJAKAN') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: green;">&bull;</span>
                    </td>
                <?php } else if ($row->statuspekerjaan == 'BATAL') { ?>
                    <td style="width: 80px;  text-align: center; border-bottom: thin solid grey;">
                        <span style="font-weight: bold; font-size: 40px; color: grey;">&bull;</span>
                    </td>
                <?php } ?>
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
        <?php endforeach ?>
    </tbody>
</table>