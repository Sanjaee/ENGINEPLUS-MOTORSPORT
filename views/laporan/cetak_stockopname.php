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

        .content-jasa {
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
            /* page-break-after: always; */
        }
        
        .content-part {
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
            /* page-break-inside: always; */
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

<body>
    <!-- header -->
    <div class="nav-bar">
        <div>
            <table width="100%" style="margin-top: 5px; border-radius: 4px; border-bottom: thin dashed #cccccc;">
                <tr>
                    <td width="60%" style="vertical-align: bottom;">

                        <!-- <img src="./assets/img/lenovo logo.jpg" style="position: absolute; width: 200px height: auto;"> -->
                        <?php foreach($opname as $cell):?>

                        <table width="100%" style="padding: 10px; margin-top: 5px;">
                            <tr>
                                <td colspan = "4">
                                    <span style= "font-weight: bold; font-size: 12;" >No SO  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </td>
                                <td colspan = "4">
                                    <span style="color: #000000; font-weight: bold; font-size: 14;"><?php echo $cell->nomor ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td colspan = "4">
                                    <span style="font-weight: bold">Tanggal</span>
                                </td>
                                <td colspan = "4">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->tanggal ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td colspan = "4">
                                    <span style="font-weight: bold">Keterangan</span>
                                </td>
                                    
                                <td colspan = "4">
                                    <span style="color: #000000; font-weight: normal;"><?php echo $cell->keterangan ?></span>
                                </td>
                            </tr>
                        </table>

                        
                    </td>

                    <td width="40%" style="vertical-align: top;">
                        <table width="100%" style="margin-top: 5px; ">
                            <tr>
                                <td style="padding-bottom: 20px; padding-left: 30px;">
                                    <span style="color: #000000; font-size: 12px; font-weight: bold; display: block;"> <?php echo $cell->nama ?> </span>
                                    <br>
                                    <div>
                                    <?php echo $cell->alamat ?>
                                        <!-- Green Lake City Rukan CBD Blok C No 77 <br>
                                        Gondrong - Cipondoh<br>
                                        Tanggerang 15146 
                                        I N D O N E S I A <br>
                                        <strong>Info Kontak : </strong><br>
                                        021 2985 9571 / 021 2252 9826 <br>
                                        021 2252 3393 <br>
                                        Fax - 021 2985 9889 <br> -->
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


<!-- Content Detail Jasa -->
    <div class="content-jasa">

        <div>
            <table width="100%" style="margin-top: 5px; vertical-align: top;">
                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="margin-bottom: 3px; border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 100px; text-align: center;">
                                    <span style="font-weight: bold">Stock Opname Sparepart</span>
                                </th>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td width="100%" style="vertical-align: top;">
                        <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74);">
                                <th style="width: 30px; text-align: center;">
                                    <span style="font-weight: bold">No.</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Kode Sparepart</span>
                                </th>
                                <th style="width: 200px; text-align: center;">
                                    <span style="font-weight: bold">Nama Sparepart</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Qty Fisik</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Qty System</span>
                                </th>
                                <th style="text-align: center;">
                                    <span style="font-weight: bold">Selisih</span>
                                </th>
                            </tr>

                            <?php $no = 1; foreach($opnamedetail as $row):?>

                            <tr style="line-height: 1cm;">
                                <td style="width: 30px; text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $no++ ?></span>
                                </td>
                                <td style="text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal"><?php echo $row->kodepart ?></span>
                                </td>
                                <td style="width: 200px; text-align: center; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal; text-align: center;"><?php echo $row->nama ?></span>
                                </td>
                                <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal;  text-align: center;"><?php echo $row->qty ?></span>
                                </td>
                                <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal;  text-align: center;"><?php echo $row->qtystock ?></span>
                                </td>
                                <td style="text-align: right; border-bottom: thin dashed #cccccc;">
                                    <span style="font-weight: normal;  text-align: center;"><?php echo $row->selisih ?></span>
                                </td>   
                            </tr>

                            <?php endforeach ?> 
                            
                        </table>
                    </td>
                </tr>

            </table>

        </div>

        <table width="100%" style="margin-top: 15px; border-radius: 4px; font-size: 12px; font-weight: bold;">
            <tr>
                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                    <tr style="background-color: rgba(242, 242, 242, 0.74);">
                        <th style="width: 100px; text-align: center;">
                            <span style="font-weight: bold">Partman</span>
                        </th>
                    </tr>

                    <tr>
                        <td style="width: 100px; text-align: center;">
                            <span><br></span>
                            <span><br></span>
                            <span><br></span>
                        </td>
                    </tr>
                    </table>
                </td>
                
                <td style="vertical-align: top;">
                    <table width="100%" style="border-radius: 4px; border: thin dashed #cccccc;">
                        <tr style="background-color: rgba(242, 242, 242, 0.74);">
                            <th style="width: 100px; text-align: center;">
                                <span style="font-weight: bold">Service Manager</span>
                            </th>
                        </tr>

                        <tr>
                            <td style="width: 100px; text-align: center;">
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

</html>