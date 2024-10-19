<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        <?php echo SITE_NAME . " : " . ucfirst($this->uri->segment(1)) . " - " . ucfirst($this->uri->segment(2)) ?>
    </title>

    <!-- Custom styles for this template -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

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
            /* position: fixed; */
            /* top: 0.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 3.1cm; */
            font-family: helvetica;
            /** Extra personal styles **/
            color: black;
            text-align: center;
            font-size: 10px;
            line-height: 0.4cm;
        }

        .header {
            margin-left: 300px;
        }

        /* .blank {
            top: 5cm;
        } */

        .content {
            /* position: fixed; */
            /* top: 5.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 3.1cm; */
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            line-height: 0.5cm;
            /* page-break-before: always; */
        }

        .content-detail {
            color: black;
            text-align: left;
            font-family: helvetica;
            font-size: 10px;
            page-break-inside: always;
        }

        .footer {
            /* position: fixed; */
            /* bottom: 0.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 2cm; */

            /** Extra personal styles **/
            font-family: helvetica;
            color: black;
            text-align: center;
            line-height: 0.5cm;
        }
    </style>
</head>

<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " BELAS";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." PULUH". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " SERATUS" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " RATUS" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " SERIBU" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " RIBU" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " JUTA" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " MILYAR" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " TRILYUN" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "MINUS ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
?>

<body>
<!-- header -->
    <div class="nav-bar">
        <div>
            <table width="100%" style="margin-top: 5px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
                <tr>
                    <td width="60%" style="vertical-align: bottom;">

                        <!-- <img src="./assets/img/lenovo logo.jpg" style="position: absolute; width: 200px height: auto;"> -->
                        <?php foreach($penerimaan as $cell):?>

                        <table width="100%" style="padding: 10px; margin-top: 5px;">
                            <tr>
                                <td colspan = "4">
                                    <span style= "font-weight: bold; font-size: 12;" >Kwitansi No. &nbsp;&nbsp;&nbsp;</span><br/><br/>
                                    <span style="color: #000000; font-weight: bold; font-size: 14;"><?php echo $cell->nomor ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span style="font-weight: bold">Tanggal</span>
                                </td>
                                <td>
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->tanggal ?></span>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td width="40%" style="vertical-align: top;">
                        <table width="100%" style="margin-top: 5px; ">
                            <tr>
                                <td style="padding-bottom: 20px; padding-left: 30px;">
                                    <span style="color: #000000; font-size: 11; font-weight: bold; display: block;"> <?php echo $cell->nama ?> </span>
                                    <br>
                                    <div>
                                    <?php echo $cell->alamat ?>
                                      
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <?php endforeach ?>
                    </td>

                </tr>
            </table>

        </div>
        
    </div>

<!-- Content Data -->
    <div class="content">
    
        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="50%" style="vertical-align: top;">
                        <table width="100%" style="padding-left: 10px; padding-top: 10px; padding-bottom: 10px;margin-top: 5px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr>
                                <td style="width: 150px;">
                                    <span style="font-size: 10; font-weight: normal">Telah Diterima Dari :</span>
                                </td>

                                <?php foreach($penerimaan as $cell):?>
                                <td colspan = "2">
                                    <span style="color: #000000; font-size: 12; font-weight: bold;"><?php echo $cell->namacustomer ?></span>
                                </td>
                                <?php endforeach ?>

                            </tr>
                            <tr>
                                <td style="width: 150px;">
                                    <span style="font-size: 8; font-weight: normal">Jumlah Uang</span>
                                </td>

                                <?php foreach($penerimaan as $cell):?>
                                <td style="width: 100px;">
                                    <span style="color: #000000; font-size: 8; font-weight: bold;"><?php echo rupiah ($cell->totalterima) ?></span>
                                </td>
                                <?php endforeach ?>

                            </tr>

                            <tr>
                                <td style="width: 150px;">
                                    <span style="font-size: 8; font-weight: normal"></span>
                                </td>

                                <?php foreach($penerimaan as $cell):?>
                                <td colspan = "2">
                                    <span style="color: #000000; font-size: 8; font-weight: bold;"># <?php echo terbilang ($cell->totalterima) ?> RUPIAH #</span>
                                </td>
                                <?php endforeach ?>

                            </tr>

                            <tr>
                                <td style="width: 150px;">
                                    <span style="font-weight: normal; font-size: 8;">Jenis Kwitansi</span>
                                </td>
                                <?php foreach($penerimaan as $cell):?>
                                <td colspan = "2">
                                    <span style="color: #000000; font-size: 8; font-weight: bold;">
                                        <?php echo $cell->jenistransaksi ?>
                                    </span>
                                </td>
                                <?php endforeach ?>
                            </tr>
                            
                        </table>
                    </td>

                    


                </tr>
            </table>
        
        </div>

    </div>

    <div class="content-detail">
        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 30px; text-align: center;">
                                    <span style="font-weight: bold">No.</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">No Invoice</span>
                                </th>
                                <th style="width: 200px; text-align: center;">
                                    <span style="font-weight: bold">No Polisi</span>
                                </th>
                                <!-- <th style="text-align: center;">
                                    <span style="font-weight: bold">Kategori</span>
                                </th> -->
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Tipe</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Jumlah (Rp)</span>
                                </th>
                            </tr>

                            <?php $no = 1; foreach($detail as $row):?>

                            <tr style="line-height: 0.5cm;">
                                <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                                </td>
                                <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->noreferensi ?></span>
                                </td>
                                <td style="width: 200px; text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->nopolisi ?></span>
                                </td>
                                <!-- <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->nama_kategori ?></span>
                                </td> -->
                                <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->tipe ?></span>
                                </td>
                                <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo rupiah ($row->nilaipenerimaan) ?></span>
                                </td>
                            </tr>

                            <?php endforeach ?> 

                            
                            
                        </table>
                    </td>
                </tr>

            </table>

        </div>

        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <tr>
                            <td width="100%" style="vertical-align: top;">
                                <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                                    <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                        <th style="width: 100px; text-align: center;">
                                            <span style="font-weight: bold">Pembayaran Via</span>
                                        </th>

                                        <th style="width: 100px; text-align: center;">
                                            <span style="font-weight: bold">Nomor Rek</span>
                                        </th>

                                        <th style="width: 100px; text-align: center;">
                                            <span style="font-weight: bold">Tanggal</span>
                                        </th>

                                        <th style="width: 100px; text-align: center;">
                                            <span style="font-weight: bold">Total</span>
                                        </th>
                                    </tr>

                                    <?php $no = 1; foreach($detail as $row):?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <span style="font-weight: normal"><?php echo $row->namaaccount ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <span style="font-weight: normal"><?php echo $row->norekening ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <span style="font-weight: normal"><?php echo $row->tanggal ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <span style="font-weight: bold"><?php echo rupiah ($cell->totalterima) ?></span>
                                        </td>
                                    </tr>
                                    <!-- <?php endforeach ?>  -->
                                </table>
                            </td>
                        </tr>
                       
                    </td>
                <tr>

                

            </table>

        </div>

        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <tr>
                            <td width="100%" style="vertical-align: top;">
                                <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                                    <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                        <th style="width: 100px; text-align: center;">
                                            <span style="font-weight: bold">Kasir</span>
                                        </th>
                                        <th style="width: 100px; text-align: center;">
                                            <span style="font-weight: bold">Customer</span>
                                        </th>
                                    </tr>

                                    <?php $no = 1; foreach($penerimaan as $cell):?>
                                    <tr>
                                        <td style="line-height: 2.5cm; text-align: center; ">
                                            <span style="font-weight: normal"><?php echo $cell->pemakai ?></span>
                                        </td>
                                        <td style="line-height: 2.5cm; text-align: center;">
                                            <span style="font-weight: normal"></span>
                                        </td>
                                    </tr>
                                    <!-- <?php endforeach ?>  -->
                                </table>
                            </td>
                        </tr>
                       
                    </td>
                <tr>

                

            </table>

        </div>

    </div>

</body>